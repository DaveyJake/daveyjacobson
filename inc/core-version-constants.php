<?php
/**
 * Vendor Script Versions as CONSTANTS.
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'script_constant_version' ) ) {
	function script_constant_version( $package, $constant ) {
		$version = json_decode( "../node_modules/{$package}/package.json" );

		return ! defined( $constant ) && define( $constant, $version->version );
	}
}

// Lodash
script_constant_version( 'lodash', 'LODASH' );
