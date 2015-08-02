var React = require('react');

(function($) {

    "use strict";

    function initialize() {

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
            $.ajax('http://borsdata.se/progress/comp/volv', {
                method: 'GET',
                success: function(data, response) {
                    console.log(data);
                }
            });
        });

        $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?a=e&filename=aapl-ohlc.json&callback=?', function (data) {

            // create the chart
            $('.instrument__chart__inner').highcharts('StockChart', {


                rangeSelector : {
                    selected : 1
                },

                title : {
                    text : 'AAPL Stock Price'
                },

                series : [{
                    type : 'candlestick',
                    name : 'AAPL Stock Price',
                    data : data,
                    dataGrouping : {
                        units : [
                            [
                                'week', // unit name
                                [1] // allowed multiples
                            ], [
                                'month',
                                [1, 2, 3, 4, 6]
                            ]
                        ]
                    }
                }]
            });
        });

        // PJAX
        $(document).pjax('a', '.site');

        $(document).on('pjax:send', function() {
            $('.site').addClass('is-loading');
        });
        $(document).on('pjax:complete', function() {
            $('.site').removeClass('is-loading');
            initialize();
        });
    }

    $(document).ready(initialize);

})(jQuery);