$(document).ready(function() {
	// remove domain from url
	$('img').each(function () {
		const $this = $(this)
		$this.attr('src', $this.attr('src').replace('https://gostclub.com/ru', '').replace('https://gostclub.com/en', ''))
	})
})

// add active class to menu
document.querySelectorAll('.js-countries-menu').forEach((e) => {
	if (e.querySelector('.current-menu-item')) {
		e.classList.add('active')
	}
})

// toggle countries submenu
document.querySelectorAll('.js-countries-submenu-toggle').forEach((e) => {
	e.addEventListener('click', () => {
		document.documentElement.classList.toggle('countries_submenu_active')
	})
})

// show submeny
const $menuItem = document.querySelectorAll('.menu-item-has-children')

$menuItem.forEach((e) => {
	e.addEventListener('click', () => {
		$menuItem.forEach((el) => {
			el.classList.remove('active')
		})

		e.classList.add('active')
	})
})