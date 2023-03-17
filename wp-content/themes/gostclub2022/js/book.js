$(document).ready(function() {
	$('#book').wowBook({
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
		height: 500,
		numberedPages: [1,-2],
		scaleToFit: "#main",
		thumbnailsPosition: 'bottom',
		turnPageDuration: 1000,
		width: 800
	})

	var book = $.wowBook("#features")

	function rebuildThumbnails() {
		book.destroyThumbnails()
		book.showThumbnails()

		let $thumbsHolder = $("#thumbs_holder")

		$thumbsHolder.css("marginTop", - $thumbsHolder.height() / 2)
	}

	$("#thumbs_position button").on("click", function() {
		var position = $(this).text().toLowerCase()

		if ($(this).data("customized")) {
			position = "top"
			book.opts.thumbnailsParent = "#thumbs_holder";
		}
		else {
			book.opts.thumbnailsParent = "body";
		}

		book.opts.thumbnailsPosition = position

		rebuildThumbnails()
	})

	$("#thumb_automatic").click(function() {
		book.opts.thumbnailsSprite = null
		book.opts.thumbnailWidth = null
		rebuildThumbnails();
	})

	$("#thumb_sprite").click(function() {
		book.opts.thumbnailsSprite = "images/thumbs.jpg"
		book.opts.thumbnailWidth = 136
		rebuildThumbnails()
	})

	$("#thumbs_size button").click(function() {
		var factor = 0.02 * ( $(this).index() ? -1 : 1 )

		book.opts.thumbnailScale = book.opts.thumbnailScale + factor

		rebuildThumbnails()
	})
})