
var $ = jQuery.noConflict()

// custom JS
$(window).bind('load', function() {
	let $owlCarousel = $('.js-owl-carousel')

	if ($owlCarousel.length) {
		$owlCarousel.owlCarousel({
			autoplay:           true,
			autoplayHoverPause: true,
			autoplayTimeout:    2500,
			dots:               true,
			items:              1,
			loop:               true,
			nav:                true,
			navText:            ["<span></span><span></span>", "<span></span><span></span>"]
		})
	}
})
