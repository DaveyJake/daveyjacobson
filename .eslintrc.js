module.exports = {
    "env": {
        "browser": true,
        "builtin": true,
        "jquery": true,
        "node": true,
        "es6": true
    },
    "globals": {
        "_": false,
        "Backbone": false,
        "Foundation": false,
        "Hammer": false,
        "jQuery": false,
        "JSON": false,
        "Pace": false,
        "Tabletop": false,
        "console": false,
        "dj": false,
        "wp": false,
        "yadcf": false
    },
    "extends": "wordpress",
    "parser": "babel-eslint",
    "parserOptions": {
        "ecmaFeatures": {
            "modules": true,
            "impliedStrict": true
        },
        "sourceType": "module"
    },
    "plugins": [
        "import",
        "jsdoc",
        "wordpress"
    ],
    "rules": {
        "block-scoped-var": 2,
        "camelcase": 2,
        "comma-style": [2, "last"],
        "curly": [0, "all"],
        "dot-notation": [
            2, { "allowKeywords": false }
        ],
        "eqeqeq": [2, "allow-null"],
        "guard-for-in": 2,
        "new-cap": 2,
        "no-bitwise": 2,
        "no-caller": 2,
        "no-cond-assign": [2, "except-parens"],
        "no-debugger": 2,
        "no-empty": 2,
        "no-eval": 2,
        "no-extend-native": 2,
        "no-extra-parens": 1,
        "no-irregular-whitespace": 2,
        "no-iterator": 2,
        "no-loop-func": 2,
        "no-mixed-spaces-and-tabs": ["error", "smart-tabs"],
        "no-multi-str": 2,
        "no-new": 2,
        "no-plusplus": 0,
        "no-proto": 2,
        "no-script-url": 2,
        "no-sequences": 2,
        "no-shadow": 1,
        "no-undef": 0,
        "no-unused-vars": 1,
        "no-with": 2,
        "quotes": 0,
        "semi": [0, "never"],
        "strict": [1, "global"],
        "valid-typeof": 2,
        "vars-on-top": 0,
        "wrap-iife": [2, "inside"]
    }
};