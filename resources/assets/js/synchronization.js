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