<?php
/**
 * ownCloud
 *
 * @author Artur Neumann <artur@jankaritech.com>
 * @copyright Copyright (c) 2017 Artur Neumann artur@jankaritech.com
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License,
 * as published by the Free Software Foundation;
 * either version 3 of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */
namespace TestHelpers;

use GuzzleHttp\Client;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Psr7\Request;

/**
 * Helper to test email sending, using mailhog
 *
 *
 */
class EmailHelper {
	/**
	 * retrieving emails sent from mailhog
	 *
	 * @param string $mailhogUrl
	 * 
	 * @return mixed JSON encoded contents
	 */
	public static function getEmails($mailhogUrl) {
		$client = new Client();
		$request = new Request(
			'GET',
			$mailhogUrl . "/api/v2/messages",
			['Content-Type' => 'application/json']
		);
		$response = $client->send($request);

		$json = json_decode($response->getBody()->getContents());
		return $json;
	}

	/**
	 * 
	 * @param string $mailhogUrl
	 * 
	 * @return ResponseInterface
	 */
	public static function deleteAllMessages($mailhogUrl) {
		$client = new Client();
		$request = new Request(
			'DELETE',
			$mailhogUrl . "/api/v1/messages"
		);
		$response = $client->send($request);
		return $response;
	}
}
