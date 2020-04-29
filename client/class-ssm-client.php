<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//require dirname( __FILE__ ) . '../vendor/autoload.php';

use Aws\Ssm\SsmClient;
use Aws\Ssm\Exception\SsmException;

/**
 * Class Ssm_Client
 */
class Ssm_Client {

	/** @var SsmClient */
	protected $client;

	public function __construct() {
		$this->client = new SsmClient(
			[
				'credentials' => [
					'key'    => $this->get_access_key(),
					'secret' => $this->get_secret_access_key(),
				],
				'region'      => $this->get_region(),
				'version'     => '2014-11-06',
			]
		);
	}

	public function get_parameter( $key ) {
		try {
			$result = $this->client->getParameter(
				[
					'Name'           => $key,
					'WithDecryption' => false,
				]
			);
			return $result['Parameter']['Value'];
		} catch ( SsmException $e ) {
//			echo $e->getMessage();
			// TODO: Exception.
		}
	}

	public function get_access_key() {
		if ( defined( 'SSM_AWS_ACCESS_KEY' ) ) {
			return SSM_AWS_ACCESS_KEY;
		} else {
			return '';
		}
	}

	public function get_secret_access_key() {
		if ( defined( 'SSM_AWS_SECRET_ACCESS_KEY' ) ) {
			return SSM_AWS_SECRET_ACCESS_KEY;
		} else {
			return '';
		}
	}

	public function get_region() {
		// TODO:
		return 'ap-northeast-1';
	}
}
