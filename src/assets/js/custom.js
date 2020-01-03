const $    = window.jQuery,
      body = document.body;
/**
 * Main JavaScript Source
 *
 * @since 1.0.0
 */
const App = function() {
    $( document ).ready( function() {
        $( '#fp' ).fullpage({
            anchors: ['home', 'portfolio', 'blog', 'about', 'contact'],
            sectionsColor: ['rgba(0, 0, 0, 0.5)', 'rgba(0, 0, 0, 0.5)', 'rgba(0, 0, 0, 0.5)', 'rgba(0, 0, 0, 0.75)', '#000'],
            paddingTop: 62,
            parallax: true,
            parallaxOptions: {
                type: 'reveal',
                percentage: 62,
                property: 'translate'
            },
            menu: '#menu',
            slidesNavigation: true,
            scrollingSpeed: 1000,
            autoScrolling: true,
            scrollBar: false,
            fitToSection: false,
            navigation: false,
            verticalCentered: true,
            // Fullpage.js Events
            onLeave: function( origin, destination, direction ) {
                //$( `#${destination.anchor}-page` ).parallax({ imageSrc: `/wp-content/themes/daveyjacobson/dist/assets/images/${destination.anchor}@2x.jpg` });
            },
            afterLoad: function( origin, destination, direction ) {
                fullpage_api.parallax.init();
            },
            afterRender: function() {
                $( body ).prepend( $( '#masthead' ) );
                slideImageFadeIn();
            },
            afterResize: function( width, height ) {
                $( body ).prepend( $( '#masthead' ) );
            },
            afterReBuild: function(){},
            afterResponsive: function( isResponsive ){},
            afterSlideLoad: function( section, origin, destination, direction ) {
            },
            onSlideLeave: function( section, origin, destination, direction ) {
                slideImageFadeOut( section );
                slideImageFadeIn( destination );
            }
        });

        $( '#hamburger' ).click( function( e ) {
            e.preventDefault();
            showUI();
        });

        $( '#blocker' ).click( function( e ) {
            e.preventDefault();
            showUI();
        });

        $( '[data-menuanchor] > a' ).click( function( e ) {
            showUI();
        });

        function slideImageFadeIn( selector = null ) {
            if ( null !== selector ) {
                return $( selector + ' .fp-bg' ).css({ opacity: 1, transition: 'opacity 1s ease-in-out' });
            } else {
                return $( '.fp-bg' ).css({ opacity: 1, transition: 'opacity 1s ease-in-out' });
            }
        }

        function slideImageFadeOut( selector = null ) {
            if ( null !== selector ) {
                return $( selector + ' .fp-bg' ).css({ opacity: 0, transition: 'opacity 1s ease-in-out' });
            } else {
                return $( '.fp-bg' ).css({ opacity: 0, transition: 'opacity 1s ease-in-out' });
            }
        }

        function showUI() {
            $( '#hamburger' ).toggleClass( 'mm-opened' );
            $( '#masthead, body' ).toggleClass( 'mm-open' );
        }

        /*$( '#menu-item-52 a' ).click( function( e ) {
            e.preventDefault();
            $( this ).parents( '#menu' ).toggleClass( 'open' );
        });*/
    });
};

module.exports = App;
