(function($) {

    $(document).ready(function(){

        var modal = $('.modal');
        var overlay = $('.overlay');

        $('button').click(function(e) {
            modal.css({visibility: 'visible'});
            modal.addClass('is-open');
            overlay.velocity("fadeIn");

            var stock = $(e.target).closest('tr').data('stock');

            modal.html(stock)

        });

    });

})(jQuery);