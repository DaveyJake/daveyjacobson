<?php
/**
 * Admin API: Post types and taxonomies.
 *
 * @author Davey Jacobson <davey.jacobson@gmail.com>
 * @package DaveyJacobson
 * @subpackage Post_Types_Taxonomies
 * @since DaveyJacobson 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

class DJ_Post_Types_Taxonomies {

    /**
     * Main constructor.
     *
     * @return DJ_Post_Types
     */
    public function __construct() {
        add_action( 'init', array( __CLASS__, 'daveyjacobson_register_taxonomies' ), 0 );
        add_action( 'init', array( __CLASS__, 'daveyjacobson_register_post_types' ), 5 );
        add_filter( 'rest_api_allowed_post_types', array( __CLASS__, 'daveyjacobson_rest_api_allowed_post_types' ) );
    }

    /**
     * Register core taxonomies.
     *
     * @since Davey_Jacobson 1.0.0
     */
    public static function daveyjacobson_register_taxonomies() {
        if ( taxonomy_exists( 'dj_technology' ) ) {
            return;
        }

        do_action( 'daveyjacobson_register_taxonomy' );

        /**
         * All default taxonomy labels.
         *
         * @link {@see 'daveyjacobson_technology_tax_args'}
         *
         * @var array
         */
        $labels = array(
            'name'                       => _x( 'Technologies', 'Taxonomy General Name', 'daveyjacobson' ),
            'singular_name'              => _x( 'Technology', 'Taxonomy Singular Name', 'daveyjacobson' ),
            'menu_name'                  => __( 'Technology', 'daveyjacobson' ),
            'all_items'                  => __( 'All Technologies', 'daveyjacobson' ),
            'parent_item'                => __( 'Parent Technology', 'daveyjacobson' ),
            'parent_item_colon'          => __( 'Parent Technology:', 'daveyjacobson' ),
            'new_item_name'              => __( 'New Technology Name', 'daveyjacobson' ),
            'add_new_item'               => __( 'Add New Technology', 'daveyjacobson' ),
            'edit_item'                  => __( 'Edit Technology', 'daveyjacobson' ),
            'update_item'                => __( 'Update Technology', 'daveyjacobson' ),
            'view_item'                  => __( 'View Technology', 'daveyjacobson' ),
            'separate_items_with_commas' => __( 'Separate technologies with commas', 'daveyjacobson' ),
            'add_or_remove_items'        => __( 'Add or remove technologies', 'daveyjacobson' ),
            'choose_from_most_used'      => __( 'Choose from the most used technologies', 'daveyjacobson' ),
            'popular_items'              => __( 'Popular Technologies', 'daveyjacobson' ),
            'search_items'               => __( 'Search Technologies', 'daveyjacobson' ),
            'not_found'                  => __( 'Technologies Not Found', 'daveyjacobson' ),
            'no_terms'                   => __( 'No technologies', 'daveyjacobson' ),
            'items_list'                 => __( 'Technologies list', 'daveyjacobson' ),
            'items_list_navigation'      => __( 'Technologies list navigation', 'daveyjacobson' ),
        );

        /**
         * All default rewrite arguments.
         *
         * @link {@see 'daveyjacobson_technology_tax_args'}
         *
         * @var array
         */
        $rewrite = array(
            'slug'          => 'technology',
            'with_front'    => true,
            'hierarchical'  => false,
        );

        // Register taxonomy.
        register_taxonomy( 'dj_technology',
            // Apply taxonomy to specified `post_types`.
            apply_filters( 'daveyjacobson_technology_tax_object', array( 'dj_project' ) ),
            // Set taxonomy defaults.
            apply_filters( 'daveyjacobson_technology_tax_args', array(
                'labels'            => $labels,
                'hierarchical'      => false,
                'public'            => false,
                'show_ui'           => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => false,
                'query_var'         => 'technology',
                'rewrite'           => $rewrite,
                'show_in_rest'      => true,
                'rest_base'         => 'technology',
            ))
        );
    }

    /**
     * Register core post types.
     *
     * @since Davey_Jacobson 1.0.0
     */
    public static function daveyjacobson_register_post_types() {
        if ( post_type_exists( 'dj_project' ) ) {
            return;
        }

        do_action( 'daveyjacobson_register_post_type' );

        /**
         * Custom project permalink.
         *
         * @link {@see 'daveyjacobson_project_post_type_args'}
         *
         * @var string
         */
        $project_permalink_slug = get_option( 'daveyjacobson_project_slug' );
        $project_permalink      = empty( $project_permalink_slug ) ? _x( 'project', 'slug', 'daveyjacobson' ) : $project_permalink_slug;

        /**
         * All default project post type labels.
         *
         * @link {@see 'daveyjacobson_project_post_type_args'}
         *
         * @var array
         */
        $labels = array(
            'name'                  => _x( 'Projects', 'Post Type General Name', 'daveyjacobson' ),
            'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'daveyjacobson' ),
            'menu_name'             => __( 'Projects', 'daveyjacobson' ),
            'name_admin_bar'        => __( 'Project', 'daveyjacobson' ),
            'archives'              => __( 'Project Archives', 'daveyjacobson' ),
            'attributes'            => __( 'Project Attributes', 'daveyjacobson' ),
            'parent_item_colon'     => __( 'Project Item:', 'daveyjacobson' ),
            'all_items'             => __( 'All Projects', 'daveyjacobson' ),
            'add_new_item'          => __( 'Add New Project', 'daveyjacobson' ),
            'add_new'               => __( 'Add New Project', 'daveyjacobson' ),
            'new_item'              => __( 'New Project', 'daveyjacobson' ),
            'edit_item'             => __( 'Edit Project', 'daveyjacobson' ),
            'update_item'           => __( 'Update Project', 'daveyjacobson' ),
            'view_item'             => __( 'View Project', 'daveyjacobson' ),
            'view_items'            => __( 'View Projects', 'daveyjacobson' ),
            'search_items'          => __( 'Search Project', 'daveyjacobson' ),
            'not_found'             => __( 'Project not found', 'daveyjacobson' ),
            'not_found_in_trash'    => __( 'Project not found in Trash', 'daveyjacobson' ),
            'featured_image'        => __( 'Featured Screenshot', 'daveyjacobson' ),
            'set_featured_image'    => __( 'Set featured screenshot', 'daveyjacobson' ),
            'remove_featured_image' => __( 'Remove featured screenshot', 'daveyjacobson' ),
            'use_featured_image'    => __( 'Use as featured screenshot', 'daveyjacobson' ),
            'insert_into_item'      => __( 'Insert into project', 'daveyjacobson' ),
            'uploaded_to_this_item' => __( 'Uploaded to this project', 'daveyjacobson' ),
            'items_list'            => __( 'Projects list', 'daveyjacobson' ),
            'items_list_navigation' => __( 'Projects list navigation', 'daveyjacobson' ),
            'filter_items_list'     => __( 'Filter projects list', 'daveyjacobson' ),
        );

        /**
         * Default supports for theme.
         *
         * @link {@see 'daveyjacobson_project_post_type_args'}
         *
         * @var array
         */
        $supports = array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' );

        /**
         * Permalink rewrite handling for post type.
         *
         * @link {@see 'daveyjacobson_project_post_type_args'}
         *
         * @var array
         */
        $rewrite = array(
            'slug'       => $project_permalink ? untrailingslashit( $project_permalink ) : 'project',
            'with_front' => true,
            'pages'      => true,
            'feeds'      => true,
        );

        /**
         * Register custom `dj_project` post type.
         *
         * @link {@see 'register_post_type'}
         */
        register_post_type( 'dj_project',
            /**
             * Project post type arguments. Generated at {@link https://generatewp.com/post-type GenerateWP} with all
             * default options listed.
             *
             * @param array Default WordPress arguments for registering a custom post type.
             */
            apply_filters( 'daveyjacobson_project_post_type_args', array(
                'label'               => __( 'Project', 'daveyjacobson' ),
                'description'         => __( 'All projects that I have built.', 'daveyjacobson' ),
                'labels'              => $labels,
                'supports'            => $supports,
                'taxonomies'          => array( 'dj_technology' ),
                'hierarchical'        => false,
                'public'              => false,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 20,
                'menu_icon'           => 'dashicons-hammer',
                'show_in_admin_bar'   => true,
                'show_in_nav_menus'   => false,
                'can_export'          => true,
                'has_archive'         => false,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'query_var'           => 'project',
                'rewrite'             => $rewrite,
                'capability_type'     => 'post',
                'show_in_rest'        => true,
                'rest_base'           => 'project',
            ))
        );
    }

    /**
     * Added product for Jetpack related posts.
     *
     * @param  array $post_types
     * @return array
     */
    public static function daveyjacobson_rest_api_allowed_post_types( $post_types ) {
        $post_types[] = 'dj_project';

        return $post_types;
    }

}

new DJ_Post_Types_Taxonomies();