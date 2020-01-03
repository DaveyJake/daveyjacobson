<?php
/**
 * Widgets API: Custom widget HTML output.
 *
 * @package Davey_Jacobson
 * @subpackage Widget_Filters
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed

class DJ_Widget_Filters {

    /**
     * Primary constructor.
     *
     * @return DJ_Widget_Filters
     */
    public function __construct() {
        add_filter( 'dynamic_sidebar_params', array( $this, 'dynamic_sidebar_custom_params' ) );
        add_filter( 'widget_output', array( $this, 'dynamic_sidebar_output_filter' ), 10, 3 );
    }

    /**
     * The custom sidebar widget output filter.
     *
     * @param array $params The sidebar widget parameters.
     *
     * @return array Filtered parameters.
     */
    public function dynamic_sidebar_custom_params( $params ) {
        if ( is_admin() ) {
            return $params;
        }

        global $wp_registered_widgets;

        $widget_id = $params[0]['widget_id'];

        $wp_registered_widgets[ $widget_id ]['original_callback'] = $wp_registered_widgets[ $widget_id ]['callback'];
        $wp_registered_widgets[ $widget_id ]['callback'] = 'DJ_Widget_Filters::dynamic_sidebar_custom_output';

        return $params;
    }

    /**
     * The custom sidebar callback function.
     *
     * @global array $wp_registered_widgets Registered widgets.
     */
    public static function dynamic_sidebar_custom_output() {
        global $wp_registered_widgets;

        $original_callback_params = func_get_args();

        $widget_id = $original_callback_params[0]['widget_id'];

        $original_callback = $wp_registered_widgets[ $widget_id ]['original_callback'];

        $wp_registered_widgets[ $widget_id ]['callback'] = $original_callback;

        $widget_id_base = $wp_registered_widgets[ $widget_id ]['callback'][0]->id_base;

        if ( is_callable( $original_callback ) ) {
            ob_start();

            call_user_func_array( $original_callback, $original_callback_params );

            $widget_output = ob_get_clean();

            echo apply_filters( 'widget_output', $widget_output, $widget_id_base, $widget_id );
        }
    }

    /**
     * The custom widget output filter.
     *
     * @param mixed $widget_output  The final output.
     * @param mixed $widget_id_base The widget ID prefix.
     * @param mixed $widget_id      The widget ID attribute value.
     *
     * @return mixed                The final widget HTML.
     */
    public function dynamic_sidebar_output_filter( $widget_output, $widget_id_base, $widget_id ) {
        // To target a specific widget ID
        /*if ( 'custom_html-3' === $widget_id ) {
        }*/

        // To target all widgets of a particular type
        if ( 'custom_html' === $widget_id_base ) {
            $tags = preg_split( '/(>|<)/', $widget_output );

            $widget_output = array();

            $tags = array_filter( $tags );

            //d( $tags );

            unset( $tags[1] );
            unset( $tags[2] );
            unset( $tags[3] );
            unset( $tags[5] );
            unset( $tags[15] );

            $tags = array_values( $tags );

            foreach ( $tags as $tag ) {
                $widget_output[] = "<{$tag}>";
            }
        }

        return implode( '', $widget_output );
    }

}

return new DJ_Widget_Filters();