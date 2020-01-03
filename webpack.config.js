module.exports = {
  mode: 'development',
  externals: {
    jquery: 'jQuery',
    lodash: {
      commonjs: 'lodash',
      amd: 'lodash',
      root: '_'
    },
    fullpage: {
        commonjs: 'fullpage',
        amd: 'fullpage',
        root: 'fullpage'
    },
    MmenuLight: 'MmenuLight',
    Foundation: 'foundation-pieces',
    Modernizr: 'Modernizr'
  }
};
