const path                    = require( 'path' ),
      MiniCssExtractPlugin    = require( 'mini-css-extract-plugin' ),
      UglifyJSPlugin          = require( 'uglifyjs-webpack-plugin' ),
      OptimizeCssAssetsPlugin = require( 'optimize-css-assets-webpack-plugin' ),
      WebpackManifestPlugin   = require( 'webpack-manifest-plugin' ),
      BrowserSyncPlugin       = require( 'browser-sync-webpack-plugin' ),
      StyleLintPlugin         = require( 'stylelint-webpack-plugin' );

module.exports = {
    context: __dirname,
    entry: {
        frontend: [ '@babel/polyfill', './src/index.js' ],
        customizer: './src/assets/js/customizer.js'
    },
    output: {
        filename: '[name]-bundle.js',
        path: path.resolve( __dirname, './dist/assets/js' )
    },
    mode: 'development',
    devtool: 'source-map',
    resolve: {
        alias: {
            debug$: path.resolve( __dirname, './src/assets/js/debug.js' ),
            navigation$: path.resolve( __dirname, './src/assets/js/navigation.js' ),
            skipLinkFocusFix$: path.resolve( __dirname, './src/assets/js/skip-link-focus-fix.js' )
        }
    },
    module: {
        rules: [
            {
                enforce: 'pre',
                exclude: /node_modules/,
                test: /\.js$/,
                loader: 'eslint-loader'
            },
            {
                test: /\.js$/,
                loader: 'babel-loader'
            },
            {
                test: /\.scss$/,
                include: [
                    path.resolve( __dirname, './src/assets/sass' )
                ],
                loader: [ MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader' ]
            },
            {
                test: /\.(jpe?g|png|gif)$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            outputPath: 'images/',
                            name: '[name].[ext]'
                        }
                    },
                    'img-loader'
                ]
            },
            {
                test: /\.(eot|svg|ttf|woff2?)$/,
                loader: 'file-loader'
            }
        ]
    },
    plugins: [

        //new StyleLintPlugin(),
        new MiniCssExtractPlugin({ filename: './dist/assets/style.css' }),
        new BrowserSyncPlugin({
            files: '**/*.php',
            injectChanges: true,
            proxy: 'http://davey.test'
        })
    ],
    externals: {
        jquery: 'jQuery'
    },
    optimization: {
        minimizer: [
            new UglifyJSPlugin(),
            new OptimizeCssAssetsPlugin()
        ]
    }
};
