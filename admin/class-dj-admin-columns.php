<?php
/**
 * Admin API: Custom Admin Columns.
 *
 * This is a modified version of the the {@link https://wordpress.org/plugins/catch-ids|Catch IDs}
 * plugin by {@link http://catchplugins.com|Catch Plugins}, a division of {@link http://catchinternet.com|Catch Internet Pvt. Ltd}.
 *
 * @package Davey_Jacobson
 * @subpackage Admin_Columns
 * @since 1.0.0
 * @version 0.0.1 - Initial commit.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // exit if directly accessed.

class DJ_Admin_Columns {

    /**
     * Default admin query arguments.
     *
     * @var array
     */
    public static $args = array(
        'public'   => true,
        '_builtin' => false,
    );

    public function __construct() {
        add_action( 'admin_init', array( $this, 'daveyjacobson_admin_columns' ) );
    }

    // Hook 'em all!
    public function daveyjacobson_admin_columns() {

        //add_action( 'admin_head', array( $this, 'daveyjacobson_css' ) );

        // For Post Management
        add_filter( 'manage_posts_columns', array( $this, 'daveyjacobson_column' ) );
        add_action( 'manage_posts_custom_column', array( $this, 'daveyjacobson_column_value' ), 10, 2 );

        // For Page Management
        add_filter( 'manage_pages_columns', array( $this, 'daveyjacobson_column' ) );
        add_action( 'manage_pages_custom_column', array( $this, 'daveyjacobson_column_value' ), 10, 2 );

        // For Media Management
        add_filter( 'manage_media_columns', array( $this, 'daveyjacobson_column' ) );
        add_action( 'manage_media_custom_column', array( $this, 'daveyjacobson_column_value' ), 10, 2 );

        // For Link Management
        add_filter( 'manage_link-manager_columns', array( $this, 'daveyjacobson_column' ) );
        add_action( 'manage_link_custom_column', array( $this, 'daveyjacobson_column_value' ), 10, 2 );

        // For Custom Post Types
        add_action( 'pre_get_posts', array( $this, 'daveyjacobson_custom_sortable_columns' ), 10, 1 );
        foreach ( array( 'dj_project' ) as $post_type ) {
            add_filter( "manage_{$post_type}_posts_columns", array( $this, 'daveyjacobson_column' ) );
            add_filter( "manage_edit-{$post_type}_sortable_columns", array( $this, 'daveyjacobson_column' ) );
            add_action( "manage_{$post_type}_posts_custom_column", array( $this, 'daveyjacobson_column_value' ), 10, 2 );
        }

        // For Category Management
        add_action( 'manage_edit-link-categories_columns', array( $this, 'daveyjacobson_column' ) );
        add_filter( 'manage_link_categories_custom_column', array( $this, 'daveyjacobson_return_value' ), 10, 3 );

        // For Tags Management
        foreach ( get_taxonomies( self::$args ) as $taxonomy ) {
            add_action( "manage_edit-{$taxonomy}_columns", array( $this, 'daveyjacobson_column' ) );
            add_filter( "manage_edit-{$taxonomy}_sortable_columns", array( $this, 'daveyjacobson_column' ) );
            add_filter( "manage_{$taxonomy}_custom_column", array( $this, 'daveyjacobson_return_value' ), 10, 3 );
        }

        // For User Management
        //add_action( 'manage_users_columns', array( $this, 'daveyjacobson_column' ) );
        //add_filter( 'manage_edit-users_sortable_columns', array( $this, 'daveyjacobson_column' ) );
        //add_filter( 'manage_users_custom_column', array( $this, 'daveyjacobson_return_value' ), 10, 3 );

        // For Comment Management
        //add_action( 'manage_edit-comments_columns', array( $this, 'daveyjacobson_column' ) );
        //add_action( 'manage_comments_custom_column', array( $this, 'daveyjacobson_column_value' ), 10, 2 );

    }

    /**
     * Add and create custom columns.
     *
     * @since 1.0.0
     *
     * @param  array $columns List of available columns.
     * @return array          Updated list of available columns.
     */
    public function daveyjacobson_column( $columns ) {
        unset( $columns['date'] );
        $columns['date'] = 'Date';
        $columns['ID']   = 'ID';

        return $columns;
    }

    /**
     * Output the column data display.
     *
     * @param  string $column_name Name of the column to display.
     * @param  int    $post_id     The current post ID.
     */
    public function daveyjacobson_column_value( $column_name, $post_id ) {
        if ( 'ID' === $column_name ) {
            echo $post_id;
        }
    }

    /**
     * Adjust the column value returned on custom post types.
     *
     * The dynamic portion of the hook name, `$post->post_type`, refers to the post type.
     *
     * @since 1.0.0
     *
     * @link {@see "manage_{$post_type}_posts_columns"}
     * @link {@see "manage_edit-{$post_type}_posts_columns"}
     * @link {@see "manage_{$post_type}_posts_custom_columns"}
     *
     * @param mixed  $value       The current column value.
     * @param string $column_name The name of the column to display.
     * @param int    $post_id     The current post ID.
     */
    public function daveyjacobson_return_value( $value, $column_name, $post_id ) {
        if ( 'ID' === $column_name ) {
            return $post_id;
        }

        return $value;
    }

    /**
     * Custom sorting order.
     *
     * @since 1.0.0
     *
     * @link {@see 'pre_get_posts'}
     *
     * @param WP_Query|object|array $query WP_Query object.
     */
    public function daveyjacobson_custom_sortable_columns( $query ) {
        if ( ! is_admin() || ! $query->is_main_query() ) {
            return;
        }

        $query->set( 'orderby', 'ID' );
        $query->set( 'meta_type', 'numeric' );
    }

    /**
     * Inline CSS for column widths.
     *
     * @return void
     */
    public function daveyjacobson_css() {
        //echo '<style type="text/css"> #dj-technologies, #id { width:50px; } </style>';
    }

}

new DJ_Admin_Columns();
