process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
require('laravel-elixir-bower');

elixir(function(mix) {

    mix
        //.bower('vendor.css', 'resources/assets/', 'vendor.js', 'resources/assets/js')
        .sass('app.scss')
        .scripts(['jquery.min.js', 'velocity.min.js', 'main.js'], 'public/js/app.js');
});

