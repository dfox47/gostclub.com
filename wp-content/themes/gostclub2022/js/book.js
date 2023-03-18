// more info | https://github.com/yapro/wowbook

$(document).ready(function() {
	$('.js-journal').wowBook({
		centeredWhenClosed: true,
		controls: {
			back:           '.js-book-back',
			first:          '#first',
			flipSound:      '#flipsound',
			fullscreen:     '#fullscreen',
			last:           '#last',
			next:           '.js-book-next',
			slideShow:      '#slideshow',
			thumbnails:     '#thumbs',
			zoomIn:         '#zoomin',
			zoomOut:        '#zoomout'
		},
		hardcovers: true,
		height: 840,
		numberedPages: [1,-2],
		scaleToFit: "#book_wrap",
		turnPageDuration: 1000,
		width: 1200,
		onResize: () => {
			console.log('xxxx')
		}
	})

	const $book = $.wowBook('.js-journal')

	$('.js-goto-page').on('click', function () {
		let page = $(this).attr('data-page')

		console.log('page | ', page)

		// $book.gotoPage(page)
		$book.gotoPage(page)
	})

	$('.js-book-next').on('click', function () {
		$book.advance()
	})

	$('.js-book-prev').on('click', function () {
		$book.back()
	})

	// alert("This book has "+book.pages.length+" pages.");
})