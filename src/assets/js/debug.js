/**
 * Window deubgger for JS.
 *
 * @return {Methods} See line 27.
 */
function debug() {

    var self = window;

    function exec_callback( args ) {
        ! callback_func || ! callback_force && con && con.log || callback_func.apply( self, args );
    }

    function is_level( level ) {
        return 0 < log_level ? log_level > level : log_methods.length + log_level <= level;
    }

    for ( var callback_func, callback_force, aps = Array.prototype.slice, con = self.console, that = {}, log_level = 9, log_methods = [ 'error', 'warn', 'info', 'debug', 'log' ], pass_methods = 'assert clear count dir dirxml exception group groupCollapsed groupEnd profile profileEnd table time timeEnd trace'.split( ' ' ), idx = pass_methods.length, logs = []; 0 <= --idx; ) {
        ! ( function( method ) {

            that[ method ] = function() {

                0 !== log_level && con && con[ method ] && con[ method ].apply( con, arguments );

            };

        }( pass_methods[ idx ]) );
    }

    for ( idx = log_methods.length; 0 <= --idx; ) {
        ! ( function( idx, level ) {

            that[ level ] = function() {

                var args = aps.call( arguments ),
                    log_arr = [ level ].concat( args );

                logs.push( log_arr ),

                    exec_callback( log_arr ),

                    con && is_level( idx ) && ( con.firebug ? con[ level ].apply( self, args ) : con[ level ] ? con[ level ]( args ) : con.log( args ) );

            };

        }( idx, log_methods[ idx ]) );
    }

    return that.setLevel = function( level ) {
            log_level = 'number' === typeof level ? level : 9;
        },

        that.setCallback = function() {

            var args = aps.call( arguments ),
                max = logs.length,
                i = max;

            for ( callback_func = args.shift() || null, callback_force = 'boolean' == typeof args[ 0 ] && args.shift(), i -= 'number' == typeof args[ 0 ] ? args.shift() : max; i < max; ) {
                exec_callback( logs[ i++ ]);
            }
        },

        that;

}

module.exports = debug;
