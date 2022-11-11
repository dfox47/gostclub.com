$(document).ready(function() {
	const $categoryDesc = $('.js-category-desc')

	if ($categoryDesc) {
		// array of images to make a slider from them
		let categoryImages = ''

		$categoryDesc.find('img').each(function () {
			const $this         = $(this)
			const imgUrl        = $this.attr('src').replace('https://gostclub.com/ru', '').replace('https://gostclub.com/en', '')

			// check if there is a link to partner's page
			if ($this.parent('a').length) {
				const partnerLink = $this.parent('a').attr('href')

				categoryImages += '<a class="hero_slider__item" style="background-image: url(' + imgUrl + ');" href="' + partnerLink + '" target="_blank"></a>'
			}
			else {
				categoryImages += '<div class="hero_slider__item" style="background-image: url(' + imgUrl + ');"></div>'
			}
		})

		$categoryDesc.before('<div class="hero_slider"><div class="js-owl-carousel-auto owl-carousel">' + categoryImages + '</div></div>')
	}
})