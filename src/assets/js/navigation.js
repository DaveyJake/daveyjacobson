/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function( undefined ) {

    var links,
        container,
        button,
        menu,
        i,
        len;

    container = document.getElementById( 'site-navigation' );

    if ( ! container ) {
        return;
    }

    button = container.querySelector( 'button' ); // querySelector will automatically return the first match.

    if ( undefined === typeof button ) {
        return;
    }

    menu = container.querySelector( 'ul' );

    // Hide menu toggle button if menu is empty and return early.
    if ( undefined === typeof menu ) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute( 'aria-expanded', 'false' );

    if ( ! menu.classList.contains( 'nav-menu' ) ) {
        menu.classList.add( 'nav-menu' );
    }

    button.onclick = function() {

        if ( container.classList.contains( 'toggled' ) ) {

            container.classList.remove( 'toggled' );

            button.setAttribute( 'aria-expanded', 'false' );

            menu.setAttribute( 'aria-expanded', 'false' );

        } else {

            container.classList.add( 'toggled' );

            button.setAttribute( 'aria-expanded', 'true' );

            menu.setAttribute( 'aria-expanded', 'true' );

        }

    };

    // Get all the link elements within the menu.
    links = menu.querySelectorAll( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    links.forEach( function( link ) {

        link.addEventListener( 'focus', toggleFocus, true );

        link.addEventListener( 'blur', toggleFocus, true );

    });

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {

        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( ! self.classList.contains( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'LI' === self.tagName ) {

                if ( self.classList.contains( 'focus' ) ) {

                    self.classList.remove( 'focus' );

                } else {

                    self.classList.add( 'focus' );

                }

            }

            self = self.parentElement;

        }

    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( container ) {

        var touchStartFn, i,
parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {

            touchStartFn = function( e ) {

                var i,
menuItem = this.parentNode;

                if ( ! menuItem.classList.contains( 'focus' ) ) {

                    e.preventDefault();

                    for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {

                        if ( menuItem === menuItem.parentNode.children[ i ]) {
                            continue;
                        }

                        menuItem.parentNode.children[ i ].classList.remove( 'focus' );

                    }

                    menuItem.classList.add( 'focus' );

                } else {

                    menuItem.classList.remove( 'focus' );

                }

            };

            parentLink.forEach( function( child ) {
                child.addEventListener( 'touchstart', touchStartFn, false );
            });

        }

    }( container ) );

}() );
