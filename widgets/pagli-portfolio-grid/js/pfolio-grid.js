/** Portfolio Grid / Filter Scripts **/

jQuery(document).ready(function ($) {

	var grid = $('.portfolio-grid').imagesLoaded( function() {
		grid.isotope({
			// options...
			itemSelector: '.portfolio-post',
			percentPosition: true,
			masonry: {
				columnWidth: '.grid1'
			}
		});
	});

	// filter items on button click
	$('.portfolio-filter').on( 'click', 'span', function() {
		$('.portfolio-filter span').removeClass('active');
		$(this).addClass('active')
		var filterValue = $(this).attr('data-filter');
		grid.isotope({ filter: filterValue });
	});

	$("[data-fancybox]").fancybox();
});