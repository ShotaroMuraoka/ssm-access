<?php
/*
Plugin Name: SSM Parameter Store Access
Plugin URI:
Description: A plugin that gives you access to the SSM parameter store.
Version: 1.0.0
Author: muraokashotaro
Author URI:
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Ssm_Access
 */
class Ssm_Access {

	/**
	 * プラグインのpath
	 * @var string
	 */
	public $plugin_path = '';

	/**
	 * プラグインのURL
	 * @var string
	 */
	public $plugin_url = '';

	/**
	 * @var Ssm_Access
	 */
	protected static $_instance = null;

	/**
	 * @return Ssm_Access
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Ssm_Access constructor.
	 */
	public function __construct() {
		$dirname = dirname( __FILE__ );

		// プラグインのpath,url ＊他のclassから使えるように
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_url  = plugin_dir_url( __FILE__ );

		require $dirname . '/vendor/autoload.php';
		require $dirname . '/client/class-ssm-client.php';

		add_action( 'admin_init', array( $this, 'test_init' ), 10 );
	}

	// SSMクライアントでテストしてみる.
	public function test_init() {
		$test = new Ssm_Client();
	}
}

Ssm_Access::instance();
