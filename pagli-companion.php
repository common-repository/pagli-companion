<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
 * Plugin Name: Pagli Companion
 * Plugin URI: http://www.paglithemes.com/pagli-companion
 * Description: A Plugin that provides the extra features for the pagli theme.
 * Version: 1.0.0
 * Author: PagliThemes
 * Author URI: http://paglithemes.com
 * Text Domain: pagli-companion
 * Domain Path: /languages/
 * License:GPLv2 or later
 * */

if(!class_exists('PGLI_Theme_Companion')) :
    class PGLI_Theme_Companion {

        protected $templates;

        /** Initializing Plugin Constructor **/
        function __construct() {
            /** Defining Necessary Constants **/
            $this->define_constants();

            /** Adding Image Sizes **/
            add_action( 'after_setup_theme', array($this, 'add_img_sizes'));

            /** Adding Custom Widgets **/
            add_filter( 'siteorigin_widgets_widget_folders', array($this, 'add_custom_widgets_collection'));
            add_filter('siteorigin_panels_widget_dialog_tabs', array($this, 'add_widget_tabs'));

            /** Registering Custom Post Types **/
            add_action( 'init', array($this, 'register_post_type'), 0 );

            $this->templates = array();

            // Add a filter to the wp 4.7 version attributes metabox
            add_filter('theme_page_templates', array( $this, 'add_new_template' ));

            // Add a filter to the save post to inject out template into the page cache
            add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );

            // Add a filter to the template include to determine if the page has our 
            // template assigned and return it's path
            add_filter( 'template_include', array( $this, 'view_project_template') );

            // Add your templates to this array.
            $this->templates = array( 'tpl-portfolio.php' => 'Projects',);

            // Single Portfolio Page
            add_filter('single_template', array( $this, 'load_single_pg_template'));
        }

        function add_custom_widgets_collection($folders){

            $folders[] = PGLI_COMPANION_PATH.'widgets/';
            return $folders;

        }

        function add_widget_tabs($tabs) {
            $tabs[] = array(
                'title' => __('Pagli Widgets', 'pagli-companion'),
                'filter' => array(
                    'groups' => array('pagli_widget_group')
                )
            );

            return $tabs;
        }

        /**
         * Declartion of necessary constants for plugin
         * 
         * Previously declare outside the class
         * 
         * @since 1.6.3
         * 
         * */ 
        function define_constants(){

            defined( 'PGLI_COMPANION_VERSION' ) or define( 'PGLI_COMPANION_VERSION', '1.0.0' ); //plugin version
            defined( 'PGLI_COMPANION_TD' ) or define( 'PGLI_COMPANION_TD', 'pagli-companion' ); //plugin's text domain
            defined( 'PGLI_COMPANION_JS_DIR' ) or define( 'PGLI_COMPANION_JS_DIR', plugin_dir_url( __FILE__ ) . 'js/' );  //plugin js directory
            defined( 'PGLI_COMPANION_CSS_DIR' ) or define( 'PGLI_COMPANION_CSS_DIR', plugin_dir_url( __FILE__ ) . 'css/' ); // plugin css dir
            defined( 'PGLI_COMPANION_PATH' ) or define( 'PGLI_COMPANION_PATH', plugin_dir_path( __FILE__ ) ); // plugin path
            defined( 'PGLI_COMPANION_LANG_DIR' ) or define( 'PGLI_COMPANION_LANG_DIR', plugin_dir_path( __FILE__ ) ); // plugin language directory

        }

        // Register Custom Post Type
        function register_post_type() {
            /** Portfolio Post Type **/
            require_once PGLI_COMPANION_PATH.'/post-types/portfolio-post-type.php';

            /** Testimonial Post Type **/
            require_once PGLI_COMPANION_PATH.'/post-types/testimonial-post-type.php';
        }

        // After Pagli Theme Setup
        function add_img_sizes () {

            /** Add Image Sizes for portfolio Posts **/
            add_image_size( 'pagli-companion-pfolio-grid1', 300, 200, true );
            add_image_size( 'pagli-companion-pfolio-grid2', 300, 400, true );
            add_image_size( 'pagli-companion-pfolio-grid3', 600, 200, true );

        }

        // Creating Page Tempaltes
        /**
         * Adds our template to the page dropdown for v4.7+
         *
         */
        public function add_new_template( $posts_templates ) {
            $posts_templates = array_merge( $posts_templates, $this->templates );
            return $posts_templates;
        }

        /**
         * Adds our template to the pages cache in order to trick WordPress
         * into thinking the template file exists where it doens't really exist.
         */
        public function register_project_templates( $atts ) {

            // Create the key used for the themes cache
            $cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

            // Retrieve the cache list. 
            // If it doesn't exist, or it's empty prepare an array
            $templates = wp_get_theme()->get_page_templates();
            if ( empty( $templates ) ) {
                $templates = array();
            } 

            // New cache, therefore remove the old one
            wp_cache_delete( $cache_key , 'themes');

            // Now add our template to the list of templates by merging our templates
            // with the existing templates array from the cache.
            $templates = array_merge( $templates, $this->templates );

            // Add the modified cache to allow WordPress to pick it up for listing
            // available templates
            wp_cache_add( $cache_key, $templates, 'themes', 1800 );

            return $atts;

        } 

        /**
         * Checks if the template is assigned to the page
         */
        public function view_project_template( $template ) {
            
            // Get global post
            global $post;

            // Return template if post is empty
            if ( ! $post ) {
                return $template;
            }

            // Return default template if we don't have a custom one defined
            if ( ! isset( $this->templates[get_post_meta( 
                $post->ID, '_wp_page_template', true 
            )] ) ) {
                return $template;
            } 

            $file = plugin_dir_path( __FILE__ ). get_post_meta( 
                $post->ID, '_wp_page_template', true
            );

            // Just to be safe, we check if the file exist first
            if ( file_exists( $file ) ) {
                return $file;
            } else {
                echo $file;
            }

            // Return template
            return $template;

        }

        function load_single_pg_template($template) {
            global $post;

            // Is this a "my-custom-post-type" post?
            if ($post->post_type == "portfolio"){

                //Your plugin path 
                $plugin_path = plugin_dir_path( __FILE__ );

                // The name of custom post type single template
                $template_name = 'single-portfolio.php';

                // A specific single template for my custom post type exists in theme folder? Or it also doesn't exist in my plugin?
                if($template === get_stylesheet_directory() . '/' . $template_name
                    || !file_exists($plugin_path . $template_name)) {

                    //Then return "single.php" or "single-my-custom-post-type.php" from theme directory.
                    return $template;
                }

                // If not, return my plugin custom post type template.
                return $plugin_path . $template_name;
            }

            //This is not my custom post type, do nothing with $template
            return $template;
        }
    }

    new PGLI_Theme_Companion;
endif;