// pure JS version
const changeImgSrc = () => {
	document.querySelectorAll('.js-img-scroll').forEach((e) => {
		if (window.pageYOffset + window.innerHeight > e.offsetTop) {
			e.classList.remove('js-img-scroll')
			e.src = e.dataset.src
		}
	})
}

changeImgSrc()

window.addEventListener('resize', function() {
	changeImgSrc()
})

window.addEventListener('scroll', function() {
	changeImgSrc()
})