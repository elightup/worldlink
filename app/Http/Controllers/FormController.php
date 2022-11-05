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

		$return = [
			'success' => $response['code'],
		];
		if ( $response['code'] ) {
			$old_date = strtotime( $response['data']->createdDate );

			$return['name']          = $response['data']->customerName;
			$return['status']        = $status[ $response['data']->statusValue ];
			$return['create_date']   = gmdate( 'd/m/Y H:i', $old_date );
			$return['order_details'] = $response['data']->orderDetails;
		}
		return $return;
	}
}
