
$(document).ready(function() {
	let $owlCarousel        = $('.js-owl-carousel')
	let $owlCarouselAuto    = $('.js-owl-carousel-auto')

	if ($owlCarousel.length) {
		// default owl carousel
		$owlCarousel.owlCarousel({
			dots:       false,
			items:      1,
			loop:       true,
			nav:        true,
			navText: ['', '']
		})

		// go to selected slide
		$('.js-go-to-slide').click(function () {
			$owlCarousel.trigger('to.owl.carousel', $(this).attr('data-slide'))
		})
	}

	if ($owlCarouselAuto.length) {
		$owlCarouselAuto.owlCarousel({
			autoplay: true,
			autoplayHoverPause: true,
			autoplayTimeout: 2000,
			dots: true,
			items: 1,
			loop: true,
			nav: true,
			navText: ['', '']
		})
	}
})
