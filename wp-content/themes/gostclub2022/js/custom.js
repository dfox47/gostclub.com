$(document).ready(function() {
	// remove domain from url
	$('img').each(function () {
		const $this = $(this)
		$this.attr('src', $this.attr('src').replace('https://gostclub.com/ru', '').replace('https://gostclub.com/en', ''))
	})
})

// add active class to menu
document.querySelectorAll('.js-countries-menu').forEach((menu) => {
	if (menu.querySelector('.current-menu-item')) {
		menu.classList.add('active')
	}
})