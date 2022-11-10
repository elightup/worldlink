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

		$old_date    = strtotime( $response['data']->createdDate );
		$description = $response['data']->description;

		if ( str_contains( $description, 'Trạng thái đơn hàng:' ) ) {
			$status = explode( 'Trạng thái đơn hàng:', $description );
			$status = trim( end( $status ) );
		} else {
			$status = 'Description của bạn Không đúng định dạng';
		}

		$result['name']          = $response['data']->customerName;
		$result['status']        = $status;
		$result['create_date']   = gmdate( 'd/m/Y H:i', $old_date );
		$result['order_details'] = $response['data']->orderDetails;

		return $result;
	}
}
