<?php
/**
 * Plugin Name: s5panfe
 * Plugin URI: http://www.sfive.com.br/panfe/
 * Description: Portal auxiliary brazilian electronic invoice
 * Version: 1.0.0
 * Author: sFive
 * Author URI: http://sfive.com.br
 * Requires at least: 4.4
 * Tested up to: 4.5
 *
 * Text Domain: s5panfe
 * Domain Path: /i18n/languages/
 *
 * @package s5panfe
 * @category Core
 * @author sFive
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 's5panfe' ) ) :

	/**
	 * Main s5panfe Class.
	 *
	 * @class s5panfe
	 * @version 1.0.0
	 */
	final class S5panfe {

		/**
		 * s5panfe version.
		 *
		 * @var string
		 */
		public $version = '1.0.0';

		/**
		 * The single instance of the class.
		 *
		 * @var s5panfe
		 */
		protected static $_instance = null;

		/**
		 * Main s5panfe Instance.
		 *
		 * Ensures only one instance of s5panfe is loaded or can be loaded.
		 *
		 * @static
		 * @see s5panfe()
		 * @return s5panfe - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * s5panfe Constructor.
		 */
		public function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();

			do_action( 's5panfe_loaded' );
		}

		/**
		 * Hook into actions and filters.
		 */
		private function init_hooks() {
			register_activation_hook( __FILE__, array( 's5panfe_Install', 'install' ) );
			add_action( 'init', array( $this, 'init' ), 0 );
		}

		/**
		 * Define s5panfe Constants.
		 */
		private function define_constants() {
			$this->define( 'S5PANFE_VERSION', $this->version );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * What type of request is this?
		 *
		 * @param  string $type admin.
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin' :
					return is_admin();
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		public function includes() {
			include_once( 'includes/s5panfe-core-functions.php' );
			include_once( 'includes/class-s5panfe-install.php' );

			if ( $this->is_request( 'admin' ) ) {
				include_once( 'includes/admin/class-s5panfe-admin.php' );
			}
		}

		/**
		 * Init s5panfe when WordPress Initialises.
		 */
		public function init() {
			// Before init action
			do_action( 'before_s5panfe_init' );

			// Set up localisation
			$this->load_plugin_textdomain();

			// Init action
			do_action( 's5panfe_init' );
		}

		/**
		 * Load Localisation files.
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 's5panfe', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}

		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}
	}

endif;

/**
 * Main instance of s5panfe.
 *
 * Returns the main instance of s5panfe to prevent the need to use globals.
 *
 * @return s5panfe
 */
function s5panfe() {
	return S5panfe::instance();
}

s5panfe();
