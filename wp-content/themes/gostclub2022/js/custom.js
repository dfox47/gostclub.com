
// some special code here
$(document).ready(function() {
	// owl carousel at product page
	$('.js-owl-carousel').owlCarousel({
		dots:       false,
		items:      1,
		loop:       true,
		nav:        true,
		navText: ['', '']
	})

	$('.js-owl-carousel-auto').owlCarousel({
		autoplay:           true,
		autoplayHoverPause: true,
		autoplayTimeout:    4000,
		dots:               true,
		items:              1,
		loop:               true,
		nav:                false,
		navText:            ['', '']
	})

	// go to selected slide
	$('.js-go-to-slide').click(function () {
		let slideId = $(this).attr('data-slide')

		$('.js-owl-carousel').trigger('to.owl.carousel', slideId)
	})
})
