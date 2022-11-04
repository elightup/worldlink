<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller {
	use CheckMaTrait;

	public function ajax( Request $request ) {
		$search   = $request->input( 'search' );
		$response = $this->check_ma( $search );

		return response()->json( [
			'data_user' => $response['data_user'],
			// 'result'    => $response['sic'],
			'success'   => $response['sic'],
		] );
	}
}
