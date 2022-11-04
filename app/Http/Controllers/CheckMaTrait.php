<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

trait CheckMaTrait {
	public function check_ma( $search ) {
		$client   = new Client();
		$request  = $client->request( 'GET', 'https://lawfirm.getflycrm.com/api/v3/accounts/', [
			'headers' => [
				'X-API-KEY' => '0jUwQAFe6JPgTAdi8OfjOGPguAfRa0',
			],
			'query'   => [
				'q' => $search,
			],
			'verify'  => false,
		] );
		$response = json_decode( $request->getBody() );
		$result   = [
			'sic'       => false,
			'data_user' => [],
		];

		if ( $response->records ) {
			$result['sic'] = true;
			foreach ( $response->records as $value ) {
				$result['data_user'][] = $value;
			}
		}
		return $result;
	}
}
