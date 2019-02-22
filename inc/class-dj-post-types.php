<?php
/**
 * Custom portfolio post types.
 *
 * @author Davey Jacobson <davey.jacobson@gmail.com>
 */

class DJ_Post_Types {

    /**
     * Main constructor.
     */
    function __construct() {

    }

    /**
     * Register core post types
     */
    public static function register_post_types() {

        if ( post_type_exists( 'dj_project' ) ) {
            return;
        }

        do_action( 'dj_register_post_type' );

        register_post_type( 'dj_project',
            apply_filters( 'dj_register_post_type_project',
                array(
                    'labels' => array(
                        'name'                => __( 'Projects', 'daveyjacobson' ),
                        'singular_name'       => __( 'Project', 'daveyjacobson' ),
                        'add_new'             => __( 'Add New', 'daveyjacobson' ),
                        'all_items'           => __( 'All Projects', 'daveyjacobson' ),
                        'add_new_item'        => __( 'Add New Project', 'daveyjacobson' ),
                        'edit_item'           => __( 'Edit Project', 'daveyjacobson' ),
                        'new_item'            => __( 'New Project', 'daveyjacobson' ),
                        'view_item'           => __( 'View Project', 'daveyjacobson' ),
                        'search_items'        => __( 'Search Projects', 'daveyjacobson' ),
                        'not_found'           => __( 'No projects found', 'daveyjacobson' ),
                        'not_found_in_trash'  => __( 'No projects found in trash'),
                        'parent_item_colon'   => __( 'Parent Project:', 'daveyjacobson' ),
                        'menu_name'           => __( 'Projects', 'daveyjacobson' )
                    ),
                    'hierarchical'        => false,
                    'supports'            => array( 'title', 'editor', 'custom-fields', 'excerpt', 'thumbnail', 'page-attributes' ),
                    'public'              => true,
                    'show_ui'             => true,
                    'show_in_menu'        => true,
                    'show_in_nav_menus'   => true,
                    'menu_icon'           => 'dashicons-hammer',
                    'publicly_queryable'  => true,
                    'exclude_from_search' => false,
                    'has_archive'         => false,
                    'query_var'           => true,
                    'can_export'          => true,
                    'rewrite'             => $project_permalink ? array( 'slug' => untrailingslashit( $project_permalink ) ) : false,
                    'capability_type'     => 'dj_project',
                    'map_meta_cap'        => true,
                )
            )
        );

        $permalink         = get_option( 'dj_project_slug' );
        $project_permalink = empty( $permalink ) ? _x( 'player', 'slug', 'daveyjacobson' ) : $permalink;

    }


}
