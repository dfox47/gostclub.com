// mobile menu toggle
document.querySelectorAll('.js-mobile-menu-toggle').forEach((btn) => {
	btn.addEventListener('click', () => {
		document.documentElement.classList.toggle('mobile_menu_active')
	})
})