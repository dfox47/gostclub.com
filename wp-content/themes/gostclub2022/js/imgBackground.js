$(window).on('load', function () {
	imgBackground()

	$(window).on('resize scroll', function() {
		imgBackground()
	})
})

function imgBackground() {
	$('img.js-img-background').each(function () {
		const $this = $(this)

		if ( (($(window).scrollTop() + $(window).innerHeight()) > $this.offset().top) && ($(window).scrollTop() < ($this.offset().top + $this.outerHeight())) ) {
			$this.removeClass('js-img-background').attr('src', $this.attr('data-src'))
		}
	})
}