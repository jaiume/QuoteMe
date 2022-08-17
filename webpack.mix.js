const mix = require('laravel-mix');
require('laravel-mix-polyfill');
require('laravel-mix-purgecss');

const productionSourceMaps = false;
const isProd = mix.inProduction() || false;

mix.disableNotifications();

mix.copy('resources/favicon/*.*', 'public/favicon');

mix
  .sass('resources/sass/app.scss', 'public/css')
  .purgeCss({
    enabled: false,
    whitelistPatterns: [
      /choices/, /is-open/, /is-active/, /is-disabled/, /is-focused/, /is-flipped/, /is-highlighted/, /* this line is for choices.js */
    ],
  });

mix
  .js('resources/js/app.ts', 'public/js')
  .extract()
  .webpackConfig({
    module: {
      rules: [
        {
          test: /\.tsx?$/,
          loader: 'ts-loader',
          options: { appendTsSuffixTo: [/\.vue$/] },
          exclude: /node_modules/
        }
      ],
    },
    resolve: {
      extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx'],
      alias: {
        vue$: 'vue/dist/vue.esm.js',
      },
    }
  })
  .polyfill({
    enabled: true,
    debug: false,
    corejs: 3,
    useBuiltIns: 'usage',
    targets: 'last 3 versions, ie 11, not dead'
  })
  .sourceMaps(productionSourceMaps, 'source-map');

if (isProd) {
  mix.version();
}
