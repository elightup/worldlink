<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

trait CheckMaTrait {
	public function check_ma( $search ) {
		$client   = new Client();
		$request  = $client->request( 'GET', 'https://public.kiotapi.com/orders/code/' . $search, [
			'headers' => [
				'Retailer'      => 'dichthuatworldlink',
				'Authorization' => 'Bearer ' . $this->get_token(),
			],
			'verify'  => false,
		] );
		$response = json_decode( $request->getBody() );
		return $response;
	}
	public function get_token() {
		$client   = new Client();
		$request  = $client->request( 'POST', 'https://id.kiotviet.vn/connect/token', [
			// 'headers' => [
			// 'Content-Type' => 'application/x-www-form-urlencoded',
			// ],
			'form_params' => [
				'scopes'        => 'PublicApi.Access',
				'grant_type'    => 'client_credentials',
				'client_id'     => '77532b64-54e4-4356-8997-b68eccab0cb4',
				'client_secret' => '8CDDC7A9250A73F780A9C070ED0024C522D28793',
			],
			'verify'      => false,
		] );
		$response = json_decode( $request->getBody() );
		return $response->access_token;
	}
}
