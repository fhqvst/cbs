var elixir = require('laravel-elixir');

process.env.DISABLE_NOTIFIER = true;

elixir(function(mix) {
    mix.sass('app.scss');
});
