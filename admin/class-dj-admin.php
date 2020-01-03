<?php
/**
 * The main admin class for this portfolio.
 *
 * @package DaveyJacobson
 * @subpackage Admin
 * @since DaveyJacobson 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

class DJ_Admin {

    /**
     * Primary constructor.
     *
     * @return DJ_Admin
     */
    public function __construct() {
        add_action( 'init', array( $this, 'includes' ), 10 );
    }

    /**
     * Include all essential files to initialize.
     */
    public function includes() {
        if ( is_admin() ) {
            include_once( 'class-dj-admin-post-type-messages.php' );
            include_once( 'class-dj-admin-columns.php' );
        }
    }

}

new DJ_Admin();