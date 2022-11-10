<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller {
	use CheckMaTrait;

	public function ajax( Request $request ) {
		$search   = $request->input( 'search' );
		$response = $this->check_ma( $search );

		$result = [
			'success' => $response['code'],
		];

		if ( ! $response['code'] ) {
			return $result;
		}

		$old_date         = strtotime( $response['data']->createdDate );
		$description      = trim( strip_tags( $response['data']->description ) );
		$status           = preg_split( "/(\n|&#10;)/", $description, 2, PREG_SPLIT_NO_EMPTY );
		$status           = count( $status ) > 1 ? trim( end( $status ) ) : '';
		$default_statuses = [
			'Draft'     => 'Phiếu tạm',
			'Confirm'   => 'Đã xác nhận',
			'Shipping'  => 'Đang giao hàng',
			'Completed' => 'Hoàn thành',
			'Cancel'    => 'Đã hủy',
		];
		$status           = $status ?: $default_statuses[ $response['data']->statusValue ];

		$result['name']          = $response['data']->customerName;
		$result['status']        = $status;
		$result['create_date']   = gmdate( 'd/m/Y H:i', $old_date );
		$result['order_details'] = $response['data']->orderDetails;

		return $result;
	}
}
