<?php
/**
 * Load assets
 *
 * @author      sFive
 * @category    Admin
 * @package     s5panfe/Admin
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'S5panfe_Admin_Assets' ) ) :

	/**
	 * S5panfe_Admin_Assets Class.
	 */
	class S5panfe_Admin_Assets {

		/**
		 * Hook in tabs.
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		}

		/**
		 * Enqueue styles.
		 */
		public function admin_styles() {

			// Register admin styles
			wp_register_style( 's5panfe_admin_menu_styles', s5panfe()->plugin_url() . '/assets/css/menu.css', array(), S5PANFE_VERSION );

			// Sitewide menu CSS
			wp_enqueue_style( 's5panfe_admin_menu_styles' );
		}
	}

endif;

return new S5panfe_Admin_Assets();
