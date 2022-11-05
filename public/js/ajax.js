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
			$.ajax( {
				url: url,
				method: 'post',
				data: {
					search: search,
				},
				success: function (result) {
					$( '.form-progress' ).hide();
					if ( ! result.success ) {
						$( '.result-check' ).addClass( 'alert alert--danger' );
						$( '.result-check' ).html( 'Thông tin đơn hàng chưa chính xác' );
						$( '#name' ).val( '' );
						$( '#order_status' ).val( '' );
						$( '#order_create' ).val( '' );
						$( '.order_details' ).html( '' );
						return;
					}

					$( '.result-check' ).removeClass( 'alert alert--danger' );
					$( '.result-check' ).html( '' );
					$( '#name' ).val( result.name );
					$( '#order_status' ).val( result.status );
					$( '#order_create' ).val( result.create_date );
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
					<td>${element.price}</td>
					<td>${element.discount}</td>
					<td>${gia_ban}</td>
					<td>${thanh_tien}</td>
				</tr>
			`;
		} );
		return form_body;
	}

	check_ma();
} );