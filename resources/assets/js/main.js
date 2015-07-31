var React = require('react');
var Chart = require("chart.js");
var LineChart = require("react-chartjs").Line;


(function($) {

    "use strict";

    function initialize() {
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
            $.ajax(window.location.origin + '/nordnet/borsdata/255', {
                method: 'GET',
                success: function(data) {
                    console.log(data);
                }
            });
        });



        // React

        var colors = {
            white: "rgba(255,255,255,1)",
            opaque: "rgba(255, 255, 255, 0.25)",
            red: "rgba(255,0,0,1)"
        };

        Chart.defaults.global.responsive = true;
        Chart.defaults.global.scaleGridLineColor = colors.red;

        var chartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
                {
                    label: "Instrument Graph Data",
                    fillColor: colors.opaque,
                    strokeColor: colors.white,
                    pointColor: colors.white,
                    pointStrokeColor: colors.white,
                    pointHighlightFill: colors.white,
                    pointHighlightStroke: colors.white,
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };

        var chartOptions = {
            bezierCurve: false,
            scaleFontColor: colors.white,
            scaleLineColor: colors.opaque,
            scaleGridLineColor: colors.opaque
        };

        var StockChart = React.createClass({
            render: function() {
                return <LineChart data={chartData} options={chartOptions} />
            }
        });

        if($('.instrument__chart').length) {
            React.render(
                <StockChart />, $('.instrument__chart__inner')[0]
            );
        }


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