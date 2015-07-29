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


        $('#action__get-tradables').click(function() {
            $.ajax({
                url: "https://www.nordnet.se/graph/instrument/11/101?from=2015-07-29&to=2015-07-29&fields=last,open,high,low,volume",
                type: "GET",
                headers: {
                    "Access-Control-Request-Headers": "x-requested-with"
                },
                crossDomain: true,
                data: JSON.stringify({}),
                dataType: "json",
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status) {
                    console.log(xhr);
                }
            });
        });

    });
})(jQuery);