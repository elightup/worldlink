jQuery( function( $ ) {
	const $d = $( document );
	function check_ma() {
		$( '.check_ma' ).on( 'click', function() {
			let search = $( '#search' ).val(),
				url = $( '.form-information' ).data( 'url' ),
				parent    = $(this).parent();
			$.ajaxSetup( {
				headers: {
					'X-CSRF-TOKEN' : $( 'meta[name="csrf_token"]' ).attr( 'content' ),
				}
			} );
			$( '.form-progress' ).show();
			$( '#name' ).html( '' );
			$( '#order_status' ).html( '' );
			$( '#shipping_status' ).html( '' );
			$( '#order_note' ).html( '' );
			$( '#order_create' ).html( '' );
			$( '.order_details' ).html( '' );
			$.ajax( {
				url: url,
				method: 'post',
				data: {
					search: search,
				},
				success: function (result) {
					$( '.form-progress' ).hide();
					if ( ! result.success ) {
						$( '.form__content-ajax' ).addClass( 'hidden' );
						$( '.result-check' ).addClass( 'alert alert--danger' );
						$( '.result-check' ).html( 'Thông tin đơn hàng chưa chính xác' );
						$( '#name' ).html( '' );
						$( '#order_status' ).html( '' );
						$( '#shipping_status' ).html( '' );
						$( '#order_note' ).html( '' );
						$( '#order_create' ).html( '' );
						$( '.order_details' ).html( '' );
						return;
					}

					$( '.form__content-ajax' ).removeClass( 'hidden' );
					$( '.result-check' ).removeClass( 'alert alert--danger' );
					$( '.result-check' ).html( '' );
					$( '#name' ).html( result.name );
					$( '#order_status' ).html( result.status );
					$( '#shipping_status' ).html( result.shipping );
					$( '#order_create' ).html( result.create_date );
					$( '#order_note' ).html( result.order_note );
					$( '.order_details' ).html( htmlSuccess( result.order_details ) );
				}
			} );
		} );
	}

	// Html thông tin đơn hàng
	function htmlSuccess( data ) {
		// const { name, email, phone } = data;

		let form_body = '';
		data.forEach( element => {
			let gia_ban    = element.price - element.discount,
				thanh_tien = gia_ban * element.quantity;
			form_body += `
				<tr>
					<td>${element.productCode}</td>
					<td>${element.productName}</td>
					<td>${element.quantity}</td>
					<td>${formatNumber(0, 3, '.', ',', parseFloat( element.price ))}</td>
					<td>${formatNumber(0, 3, '.', ',', parseFloat( element.discount ))}</td>
					<td>${formatNumber(0, 3, '.', ',', parseFloat( gia_ban ))}</td>
					<td>${formatNumber(0, 3, '.', ',', parseFloat( thanh_tien ))}</td>
				</tr>
			`;
		} );
		return form_body;
	}

	check_ma();
	function formatNumber(n, x, s, c, number) {
		var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
			num = number.toFixed(Math.max(0, ~~n));
		return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
	}
} );