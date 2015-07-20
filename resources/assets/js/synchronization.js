(function($) {$(
    document).ready(function(){

        $('#action__synchronize').click(function() {

            $.ajax(window.location.origin + '/nordnet/synchronize', {
                method: 'GET',
                success: function(data) {
                    data = JSON.parse(data);
                    data.forEach(function(element) {
                       console.log(element);
                    });
                }
            });

        });

        $('#action__update-instrument').click(function() {

            $.ajax(window.location.origin + '/nordnet/update/1337', {
                method: 'GET',
                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                }
            });
        });

    });
})(jQuery);