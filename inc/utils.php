<?php
/**
 * AM utility functions
 *
 * @since  1.0
 * @package advanced-media
 */

namespace AdvancedMedia\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Whether plugin is network activated
 *
 * Determines whether plugin is network activated or just on the local site.
 *
 * @since 1.0
 * @param string $plugin the plugin base name.
 * @return bool True if network activated or false.
 */
function is_network_activated( $plugin ) {
	$plugins = get_site_option( 'active_sitewide_plugins' );

	if ( is_multisite() && isset( $plugins[ $plugin ] ) ) {
		return true;
	}

	return false;
}

/**
 * Get plugin settings
 *
 * @param  string $setting_key Setting key
 * @return array
 */
function get_settings( $setting_key = null ) {
	$defaults = [
		's3_secret_access_key' => '',
		's3_access_key_id'     => '',
		's3_bucket'            => '',
		's3_region'            => 'us-west-1',
		'show_single_view'     => 'no',
	];

	$settings = ( AM_IS_NETWORK ) ? get_site_option( 'am_settings', [] ) : get_option( 'am_settings', [] );
	$settings = wp_parse_args( $settings, $defaults );

	if ( ! empty( $setting_key ) ) {
		return $settings[ $setting_key ];
	}

	return $settings;
}