<?php
/**
 * Installation related functions and actions
 *
 * @author   sFive
 * @category Admin
 * @package  s5panfe/Classes
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * s5panfe_Install Class.
 */
class S5panfe_Install {

	/**
	 * Hook in tabs.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'check_version' ), 5 );
	}

	/**
	 * Check s5panfe version and run the updater is required.
	 *
	 * This check is done on all requests and runs if he versions do not match.
	 */
	public static function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && get_option( 's5panfe_version' ) !== s5panfe()->version ) {
			self::install();
			do_action( 's5panfe_updated' );
		}
	}

	/**
	 * Install s5panfe.
	 */
	public static function install() {

		if ( ! defined( 'S5PANFE_INSTALLING' ) ) {
			define( 'S5PANFE_INSTALLING', true );
		}

		self::create_tables();

		self::update_s5panfe_version();

		// Flush rules after install
		flush_rewrite_rules();

		// Trigger action
		do_action( 's5panfe_installed' );
	}

	/**
	 * Update s5panfe version to current.
	 */
	private static function update_s5panfe_version() {
		delete_option( 's5panfe_version' );
		add_option( 's5panfe_version', s5panfe()->version );
	}

	/**
	 * Set up the database tables which the plugin needs to function.
	 *
	 * Tables:
	 *		heroes - Table for storing heroes.
	 */
	private static function create_tables() {
		global $wpdb;

		$wpdb->hide_errors();

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		dbDelta( self::get_schema() );
	}

	/**
	 * Get Table schema.
	 * @return string
	 */
	private static function get_schema() {
		global $wpdb;

		$collate = '';

		if ( $wpdb->has_cap( 'collation' ) ) {
			if ( ! empty( $wpdb->charset ) ) {
				$collate .= "DEFAULT CHARACTER SET $wpdb->charset";
			}
			if ( ! empty( $wpdb->collate ) ) {
				$collate .= " COLLATE $wpdb->collate";
			}
		}

		return "
CREATE TABLE {$wpdb->prefix}s5panfe_nfe (
  ID bigint(20) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY hero_id (ID),
  PRIMARY KEY (ID)
) $collate;
		";
	}
}

S5panfe_Install::init();
