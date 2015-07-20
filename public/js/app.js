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

    });
})(jQuery);
//# sourceMappingURL=app.js.map