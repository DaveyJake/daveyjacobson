/* eslint-disable */
const ModuleMaker = function( ModuleName ) {

    if ( 'function' === typeof define && define.amd ) {

        define( function() { return ModuleName; });

    } else if ( 'undefined' !== typeof module && module.exports ) {

        module.exports = ModuleName;

    } else {

        window[ ModuleName ] = ModuleName;

    }

};

module.exports = ModuleMaker;