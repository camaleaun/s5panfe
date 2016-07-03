<?php
/**
 * s5panfe Admin
 *
 * @class    S5panfe_Admin
 * @author   sFive
 * @category Admin
 * @package  s5panfe/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * S5panfe_Admin class.
 */
class S5panfe_Admin {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {
		include_once( 'class-s5panfe-admin-menus.php' );
	}
}

return new S5panfe_Admin();
