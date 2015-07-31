var React = require('react');


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


        //
        // Synchronization
        //

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


        $('#action__get-tradables').click(function() {
            $.ajax(window.location.origin + '/nordnet/volvo', {
                method: 'GET',
                success: function(data) {
                    console.log(data);
                }
            });
        });



        // React
        //var CommentBox = React.createClass({
        //    render: function() {
        //        return (
        //            <div className="commentBox">
        //            Hello, world! I am a CommentBox.
        //        </div>
        //        );
        //    }
        //});
        //React.render(
        //<CommentBox />,
        //    document.getElementById('react__content')
        //);

        // PJAX
        $(document).pjax('a', '.site');

        $(document).on('pjax:send', function() {
            console.log("pjax:send");
        });
        $(document).on('pjax:complete', function() {
            console.log("pjax:complete");
        });

    });

})(jQuery);