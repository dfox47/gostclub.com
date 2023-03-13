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









// example https://codepen.io/captain_anonym0us/pen/ybVbpv
const jouranlsBook = () => {
	const pages = document.querySelector('.js-journal').getElementsByClassName('wp-block-image')

	console.log('x1')

	if (!pages) return

	console.log('x2')

	for (var i = 0; i < pages.length; i++) {
		let page = pages[i]

		if (i % 2 === 0) {
			page.style.zIndex = (pages.length - i)
		}
	}

	console.log('x3')

	document.addEventListener('DOMContentLoaded', function() {
		for (let i = 0; i < pages.length; i++) {
			pages[i].pageNum = i + 1

			pages[i].onclick=function() {
				if (this.pageNum % 2 === 0) {
					this.classList.remove('flipped')
					this.previousElementSibling.classList.remove('flipped')
				}
				else {
					this.classList.add('flipped')
					this.nextElementSibling.classList.add('flipped')
				}
			}
		}
	})

	console.log('x4')
}

jouranlsBook()