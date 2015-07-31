var React = require('react');

(function ($) {

    $(document).ready(function () {

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

        $('.block__toggle').click(function () {
            $(this).parents('.block').toggleClass('is-minimized');
            $(this).find('i').toggleClass('ion-ios-minus-empty');
            $(this).find('i').toggleClass('ion-ios-plus-empty');
        });

        $('.notice__close').click(function () {
            $(this).parents('.notice').remove();
        });

        //
        // Synchronization
        //

        $('#action__synchronize').click(function () {
            $.ajax(window.location.origin + '/nordnet/synchronize', {
                method: 'GET',
                success: function success(data) {
                    console.log(data);
                }
            });
        });

        $('#action__update-instrument').click(function () {
            $.ajax(window.location.origin + '/nordnet/update/16281393', {
                method: 'GET',
                success: function success(data) {
                    console.log(data);
                }
            });
        });

        $('#action__get-tradables').click(function () {
            $.ajax({
                url: 'https://www.nordnet.se/graph/instrument/11/101?from=2015-07-29&to=2015-07-29&fields=last,open,high,low,volume',
                type: 'GET',
                headers: {
                    'Access-Control-Request-Headers': 'x-requested-with'
                },
                crossDomain: true,
                data: JSON.stringify({}),
                dataType: 'json',
                success: function success(response) {
                    console.log(response);
                },
                error: function error(xhr, status) {
                    console.log(xhr);
                }
            });
        });

        // React
        var CommentBox = React.createClass({
            displayName: 'CommentBox',

            render: function render() {
                return React.createElement(
                    'div',
                    { className: 'commentBox' },
                    'Hello, world! I am a CommentBox.'
                );
            }
        });
        react.render(React.createElement(CommentBox, null), document.getElementById('react__content'));
    });
})(jQuery);
//# sourceMappingURL=app.js.map