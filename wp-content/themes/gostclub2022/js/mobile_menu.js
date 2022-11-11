// mobile menu toggle
document.querySelectorAll('.js-mobile-menu-toggle').forEach((e) => {
	e.addEventListener('click', () => {
		document.documentElement.classList.toggle('mobile_menu_active')
	})
})