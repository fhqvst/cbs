process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
require('laravel-elixir-wiredep');

elixir(function(mix) {
    mix
        .browserify('main.js')
        .sass('app.scss')
        //.scripts(['main.js'], 'public/js/app.js')
        .wiredep({src: 'app.blade.php'});
});