// ( function ( document, window ) {
// 	function checkMa () {
// 		const input = document.getElementById( 'ma_so_thue' );
// 		input.addEventListener( 'input', (e) => {
// 			let value = e.target.value;
// 			console.log(value);
// 		} );
// 	}
// 	window.onload = function () {
// 		checkMa();
// 	}
// } ) ( document, window );

window.onload = function () {
	function checkMa () {
		const input = document.getElementById( 'ma_so_thue' );
		input.addEventListener( 'input', (e) => {
			let value = e.target.value;
			console.log(value);
		} );
	}

	let changeForm = () => {
		let select = document.getElementById( 'form-select' ),
			forms_wrapper = document.querySelectorAll( '.form-wrapper' );
		select.addEventListener( 'change', (e) => {
			let value = e.target.value,
				form = document.getElementById( value );
			forms_wrapper.forEach( form_wrapper => {
				form_wrapper.classList.remove( 'show' );
			} );
			form.classList.add( 'show' );
		} );
	}

	let addButton = () => {
		$(document).on( 'click', '.add-field', function() {
			let prev = $(this).prev(),
				clone = prev.find( '.cloneable' );
				clone.last().clone().appendTo( prev );
		} );
	}

	// checkMa();
	// changeForm();
	addButton();
}
