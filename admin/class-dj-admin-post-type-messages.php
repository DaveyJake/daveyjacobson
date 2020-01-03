<?php
/**
 * Theme Admin API: Post type admin. messages.
 *
 * @package DaveyJacobson
 * @subpackage Admin_Post_Type_Messages
 * @since DaveyJacobson 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

class DJ_Admin_Post_Type_Messages {

    /**
     * Primary constructor.
     *
     * @return DJ_Admin_Post_Type_Messages
     */
    public function __construct() {
        add_filter( 'post_updated_messages', array( $this, 'daveyjacobson_project_updated_messages' ) );
    }

    /**
     * Project update messages.
     *
     * @see {@link /wp-admin/edit-form-advanced.php}
     *
     * @param array $messages Existing post update messages.
     * @return array          Amended post update messages with new CPT update messages.
     */
    public function daveyjacobson_project_updated_messages( $messages ) {

        $post             = get_post();
        $post_type        = get_post_type( $post );
        $post_type_object = get_post_type_object( $post_type );

        $messages['project'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => __( 'Project updated.', 'daveyjacobson' ),
            2  => __( 'Custom field updated.', 'daveyjacobson' ),
            3  => __( 'Custom field deleted.', 'daveyjacobson' ),
            4  => __( 'Project updated.', 'daveyjacobson' ),
            /* translators: %s: date and time of the revision */
            5  => isset( $_GET['revision'] ) ? sprintf( __( 'Project restored to revision from %s', 'daveyjacobson' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6  => __( 'Project published.', 'daveyjacobson' ),
            7  => __( 'Project saved.', 'daveyjacobson' ),
            8  => __( 'Project submitted.', 'daveyjacobson' ),
            9  => sprintf(
                __( 'Project scheduled for: <strong>%1$s</strong>.', 'daveyjacobson' ),
                // translators: Publish box date format, see http://php.net/date
                date_i18n( __( 'M j, Y @ G:i', 'daveyjacobson' ), strtotime( $post->post_date ) )
            ),
            10 => __( 'Project draft updated.', 'daveyjacobson' )
        );

        if ( $post_type_object->publicly_queryable && 'project' === $post_type ) {
            $permalink = get_permalink( $post->ID );

            $view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View project', 'daveyjacobson' ) );
            $messages[ $post_type ][1] .= $view_link;
            $messages[ $post_type ][6] .= $view_link;
            $messages[ $post_type ][9] .= $view_link;

            $preview_permalink = add_query_arg( 'preview', 'true', $permalink );
            $preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview project', 'daveyjacobson' ) );
            $messages[ $post_type ][8]  .= $preview_link;
            $messages[ $post_type ][10] .= $preview_link;
        }

        return $messages;

    }

}

new DJ_Admin_Post_Type_Messages();