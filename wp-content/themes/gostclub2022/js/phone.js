
// allow only numbers at phone input
document.querySelectorAll('.js-phone').forEach((e) => {
	e.addEventListener('keypress', (event) => {
		let charCode = (event.which) ? event.which : event.keyCode

		if (String.fromCharCode(charCode).match(/[^0-9()\-+]/g)) {
			event.preventDefault()

			return false
		}
	})
})
