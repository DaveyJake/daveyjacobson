<?php
/**
 * Vendor Script Versions as CONSTANTS.
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

if ( ! function_exists( 'script_constant_version' ) ) {
	function script_constant_version( $package ) {
        $data     = ABSTHEME . "node_modules/{$package}/package.json";
		$pkg      = json_decode( file_get_contents( $data ) );
        $version  = $pkg->version;
        $constant = strtoupper( $package );

		!defined( $constant ) && define( $constant, $version );

        return true;
	}
}

// Lodash
script_constant_version( 'lodash' );
