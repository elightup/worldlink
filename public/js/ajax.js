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
						$( '.result-check' ).removeClass( 'success-popup active' );
						$( '.result-check' ).addClass( 'alert alert--danger' );
						$( '.result-check' ).html( 'Bạn chưa tạo tài khoản, hãy nhập đầy đủ thông tin' );
						$( '#phone' ).val( '' );
						$( '#name' ).val( '' );
						$( '#email' ).val( '' );
						$( '#account_id' ).val( '' );
						return;
					}

					$( '.result-check' ).removeClass( 'alert--danger' );
					$( '.result-check' ).addClass( 'success-popup active' );
					$( '.result-check' ).html( htmlSuccess( result.data_user ) );
				}
			} );
		} );
		// Click close popup thông tin user
		$d.on( 'click', '.btn-close', function() {
			$(this).parents( '.result-check' ).removeClass( 'active' );
		} );
		// Click ra ngoài close popup
		$d.on('click', function (e) {
			if ( $(e.target).closest( '.modal-dialog' ).length === 0 ) {
				$( '.result-check' ).removeClass( 'active' );
			}
		});

		// Click chọn user để điền thông tin vào form
		$d.on( 'click', '.modal-dialog .button', function() {
			let name = $(this).parents().siblings( '.form-name' ).text(),
			email = $(this).parents().siblings( '.form-email' ).text(),
			phone = $(this).parents().siblings( '.form-phone' ).text(),
			mst   = $(this).parents().siblings( '.form-mst' ).text(),
			account_id = $(this).attr( 'data-id' );

			console.log('name', name);
			$( '#account_id' ).val( account_id );
			$( '#name' ).val( name );
			$( '#email' ).val( email );
			$( '#phone' ).val( phone );
			$( '#ma_so_thue' ).val( mst );

			$(this).parents( '.result-check' ).removeClass( 'active' );
		} );
	}

	// Html popup thông tin user
	function htmlSuccess( data ) {
		// const { name, email, phone } = data;

		let form_body = '';
		data.forEach( element => {
			form_body += `
				<tr>
					<td class="form-name">${element.account_name}</td>
					<td class="form-email">${element.email}</td>
					<td class="form-phone">${element.phone}</td>
					<td class="form-mst hidden">${element.sic_code}</td>
					<td><a class="button" data-id="${element.account_id}">Chọn</a></td>
				</tr>
			`;
		} );
		return `
		<div class="modal-dialog">
			<div class="modal-header">
				<svg class="btn-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
					<path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path>
				</svg>
			</div>
			<table>
				<thead>
					<tr>
						<th>Tên</th>
						<th>Email</th>
						<th>Phone</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					${form_body}
				</tbody>
			</table>
		</div>
		`;
	}

	function changeRadio () {
		$( '.radio-list' ).on( 'change', function() {
			let val = $(this).val();
			let parents = $(this).parents( '.row-radio' );

			switch ( val ) {
				case '1':
					parents.next().find( '.row-content__item' ).removeClass( 'active' );
					$( `div[data-value="${val}"]` ).addClass( 'active' );
					break;
				case '2':
					parents.next().find( '.row-content__item' ).removeClass( 'active' );
					$( `div[data-value="${val}"]` ).addClass( 'active' );
					break;
				case '3':
					parents.next().find( '.row-content__item' ).removeClass( 'active' );
					$( `div[data-value="${val}"]` ).addClass( 'active' );
					break;
				case '4':
					parents.next().find( '.row-content__item' ).removeClass( 'active' );
					$( `div[data-value="${val}"]` ).addClass( 'active' );
					break;
			}
		} );
	}

	changeRadio();
	check_ma();
} );