<?php
/**
 * Portfolio API: Enqueue scripts and styles.
 *
 * @package DaveyJacobson
 * @subpackage Scripts_Styles
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if directly accessed.

/** Vendor Version Constants */
require get_template_directory() . '/inc/core-version-constants.php';

class DJ_Scripts_Styles {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 5 );
    }

    /**
     * Primary script and style injector.
     *
     * @return void
     */
    public function enqueue() {
        $this->register();

        // If stylesheet is in browser cache, load it the traditional way
        if ( isset( $_COOKIE['fullCSS'] ) && false !== $_COOKIE['fullCSS'] )
        {
            // Load Typekit
            wp_enqueue_style( 'typekit' );
            // Default style.css.
            wp_enqueue_style( 'style' );
        }
        // Otherwise, inline critical CSS and load full stylesheet asynchronously
        else
        {
            add_filter( 'style_loader_tag', array( $this, 'custom_link_tag_attributes' ), 5, 4 );
            add_action( 'wp_head', array( __CLASS__, 'loadCSS' ), 10 );
        }

        // jQuery.
        wp_enqueue_script( 'jquery' );

        // Fullpage.js
        wp_enqueue_script( 'parallax' );
        wp_enqueue_script( 'fullpage' );

        // MmenuLight
        wp_enqueue_script( 'mmenu-light-polyfills' );
        wp_enqueue_script( 'mmenu-light' );

        // Frontend.
        wp_enqueue_script( 'app-js' );

        // Post comments.
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

    /**
     * Primary script and style registrar.
     *
     * @return void
     */
    public function register() {
        $this->remove();

        global $is_dev, $current_url;

        $dev    = $is_dev ? '' : '.min';
        $vendor = 'node_modules';

        // Adobe Typekit
        wp_register_style( 'typekit', 'https://use.typekit.net/dvm4pvz.css', false, null, 'all' );

    	// Default `style.css`
    	wp_register_style( 'style', get_template_directory_uri() . '/dist/assets/css/app.css', false, get_file_version( 'dist/assets/css/app.css' ), 'all' );

        // Replace `underscore` with `lodash`
        wp_deregister_script( 'underscore' );
        wp_register_script( 'underscore', includes_url( "js/dist/vendor/lodash$dev.js" ), array(), LODASH, true );

        // Deregister jQuery and re-register jQuery core.
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', includes_url( 'js/jquery/jquery.js' ), array(), '1.12.14', true );

        // Fullpage.js
        wp_register_script( 'parallax', get_template_directory_uri() . '/dist/assets/libs/fullpage/fullpage.parallax.min.js', array( 'jquery' ), '0.1.1', true );
        //wp_register_script( 'parallax', get_template_directory_uri() . '/dist/assets/libs/parallax/parallax.min.js', array( 'jquery' ), '1.5.0', true );
        wp_register_script( 'fullpage', get_template_directory_uri() . '/dist/assets/libs/fullpage/fullpage.extensions.min.js', array( 'jquery', 'parallax' ), '3.0.8', true );

        // MmenuLight.js
        //wp_register_script( 'mmenu-light-polyfills', get_template_directory_uri() . '/dist/assets/libs/mmenuLight/mmenu-light.polyfills.js', array( 'jquery' ), '3.0.1', true );
        //wp_register_script( 'mmenu-light', get_template_directory_uri() . '/dist/assets/libs/mmenuLight/mmenu-light.js', array( 'mmenu-light-polyfills', 'jquery' ), '3.0.1', true );

    	// Bundle JS
    	wp_register_script( 'app-js', get_template_directory_uri() . '/dist/assets/js/app.js', array( 'jquery', 'fullpage'/*, 'mmenu-light'*/ ), get_file_version( 'dist/assets/js/app.js' ), true );
    }

    /**
     * Remove/Prevent/Disable specific scripts and styles from loading.
     *
     * @return void
     */
    public function remove() {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
    }

    /**
     * LoadCSS polyfill.
     *
     * @return mixed
     */
    public static function loadCSS() {
        $set_cookie = " var stylesheet=loadCSS('" . get_template_directory_uri() . "/dist/assets/css/app.css');onloadCSS(stylesheet,function(){var expires=new Date(+new Date+(7*24*60*60*1000)).toUTCString();document.cookie='fullCSS=true;expires='+expires;}); ";
        echo '<script> !function(e){"use strict";var t=function(t,n,o,r){function i(e){return l.body?e():void setTimeout(function(){i(e)})}function d(){s.addEventListener&&s.removeEventListener("load",d),s.media=o||"all"}var a,l=e.document,s=l.createElement("link");if(n)a=n;else{var f=(l.body||l.getElementsByTagName("head")[0]).childNodes;a=f[f.length-1]}var u=l.styleSheets;if(r)for(var c in r)r.hasOwnProperty(c)&&s.setAttribute(c,r[c]);s.rel="stylesheet",s.href=t,s.media="only x",i(function(){a.parentNode.insertBefore(s,n?a:a.nextSibling)});var v=function(e){for(var t=s.href,n=u.length;n--;)if(u[n].href===t)return e();setTimeout(function(){v(e)})};return s.addEventListener&&s.addEventListener("load",d),s.onloadcssdefined=v,v(d),s};"undefined"!=typeof exports?exports.loadCSS=t:e.loadCSS=t}("undefined"!=typeof global?global:this); function onloadCSS(n,a){function t(){!d&&a&&(d=!0,a.call(n))}var d;n.addEventListener&&n.addEventListener("load",t),n.attachEvent&&n.attachEvent("onload",t),"isApplicationInstalled"in navigator&&"onloadcssdefined"in n&&n.onloadcssdefined(t)}' . $set_cookie . '</script>';
        echo '<script> !function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(a){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){function e(){t.addEventListener?t.removeEventListener("load",e):t.attachEvent&&t.detachEvent("onload",e),t.setAttribute("onload",null),t.media=a}var a=t.media||"all";t.addEventListener?t.addEventListener("load",e):t.attachEvent&&t.attachEvent("onload",e),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(e,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this); </script>';
    }

    /**
     * Custom 'link' tag attributes.
     *
     * @see {@link 'style_loader_tag'}
     */
    public function custom_link_tag_attributes( $html, $handle, $href, $media ) {
        if ( in_array( $handle, array( 'style', 'typekit' ) ) ) {
            $html = null;
            $html = '<link rel="preload" onload="this.onload=null;this.rel=\'stylesheet\'" href="' . esc_url( $href ) . '" media="' . esc_attr( $media ) . '" />';
        }

        return $html;
    }

}

new DJ_Scripts_Styles();
