(function($) {

    $(document).ready(function(){

        var modal = $('.modal');
        var overlay = $('.overlay');

        /*
        $('button').click(function(e) {
            modal.css({visibility: 'visible'});
            modal.addClass('is-open');
            overlay.velocity("fadeIn");
            var stock = $(e.target).closest('tr').data('stock');
            modal.html(stock)
        });
        */

        $('.block__toggle').click(function() {
            $(this).parents('.block').toggleClass('is-minimized');
            $(this).find('i').toggleClass('ion-ios-minus-empty');
            $(this).find('i').toggleClass('ion-ios-plus-empty');
        });

        $('.notice__close').click(function() {
            $(this).parents('.notice').remove();
        });

    });

})(jQuery);
(function($) {$(
    document).ready(function(){

        $('#action__synchronize').click(function() {
            $.ajax(window.location.origin + '/nordnet/synchronize', {
                method: 'GET',
                success: function(data) {
                    console.log(data);
                }
            });
        });

        $('#action__update-instrument').click(function() {
            $.ajax(window.location.origin + '/nordnet/update/16281393', {
                method: 'GET',
                success: function(data) {
                    console.log(data);
                }
            });
        });

        $('#action__connect-to-feed').click(function() {
            $.ajax(window.location.origin + '/nordnet/status', {
                method: 'GET',
                success: function(data) {
                    console.log(data);
                }
            });
            //{"session_key":"e3c550cdcda380b997a818f3cd3e8d739fe02ef0","expires_in":300,"environment":"exttest","country":"SE","private_feed":{"hostname":"priv.api.test.nordnet.se","port":443,"encrypted":true},"public_feed":{"hostname":"pub.api.test.nordnet.se","port":443,"encrypted":true}}
        });

    });
})(jQuery);
//# sourceMappingURL=app.js.map