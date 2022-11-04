<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller {
	use CheckMaTrait;

	public function ajax( Request $request ) {
		$search   = $request->input( 'search' );
		$response = $this->check_ma( $search );

		$status = [
			'Draft'     => 'Phiếu tạm',
			'Confirm'   => 'Đã xác nhận',
			'Shipping'  => 'Đang giao hàng',
			'Completed' => 'Hoàn thành',
			'Cancel'    => 'Đã hủy',
		];

		$old_date = strtotime( $response->createdDate );
		return response()->json( [
			'success'       => 'Done',
			'name'          => $response->customerName,
			'status'        => $status[ $response->statusValue ],
			'create_date'   => gmdate( 'd/m/Y H:i', $old_date ),
			'order_details' => $response->orderDetails,
		] );
	}
}
