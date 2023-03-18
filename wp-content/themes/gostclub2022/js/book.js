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
		thumbnailsPosition: 'bottom',
		turnPageDuration: 1000,
		width: 1200
	})
})