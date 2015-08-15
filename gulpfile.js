process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
require('laravel-elixir-wiredep');

elixir(function(mix) {

    // SASS and Bower
    mix
        .sass('app.scss')
        .wiredep({src: 'app.blade.php'});

    // Merge JS
    mix.scripts(['app.js']);
    mix.browserify('orders.js', 'public/js/orders.js');

});