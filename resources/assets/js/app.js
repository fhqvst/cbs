(function($) {

    "use strict";

    // Initialize
    $(document).ready(initialize);
    function initialize() {

        $('#order-form').on('click', 'button', function(event) {
            event.preventDefault();
            event.stopPropagation();

            $(this).siblings('button').each(function(index, element) {
                $(element).attr('disabled', 'disabled');
            });

            var initialText = $(this).html();
            var form = $('#order-form');
            var button = $(this);

            $(this).addClass('is-loading');
            $(this).html('<span class="button__loader"></span>');

            $.ajax({
                type: 'POST',
                url: '/market/instrument/order',
                data: {
                    _token: $('[name=_token]').val(),
                    instrument_id: $('[name="instrument"]').val(),
                    price: $('[name="price"]').val(),
                    volume: $('[name="volume"]').val(),
                    side: button.val(),
                    type: 0
                },
                complete: function(response) {
                    button.removeClass('is-loading');
                    button.html(initialText);
                    button.siblings('button').each(function(index, element) {
                        $(element).removeAttr('disabled');
                    });
                }
            });

        });

        $('.block__header').click(function () {
            $(this).parents('.block').toggleClass('is-minimized');
            $(this).find('i').toggleClass('ion-ios-minus-empty');
            $(this).find('i').toggleClass('ion-ios-plus-empty');
        });

        $('.notice__close').click(function () {
            $(this).parents('.notice').remove();
        });

        $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?a=e&filename=aapl-ohlc.json&callback=?', function (data) {
            var colors = {
                red: "#FB0E29",
                green: "#38BBA5",
                blue: "#38a5bb",
                black: "#333",
                white: "#fff",
                gray: "#ccc",
                offWhite: "#eee",
                orange: "#FF6E4C"
            };
            Highcharts.theme = {
                lang:{
                    rangeSelectorZoom: false,
                    rangeSelectorFrom: false,
                    rangeSelectorTo: '-'
                },
                plotOptions: {
                    candlestick: {
                        color: colors.red,
                        upColor: colors.blue,
                        lineColor: colors.red,
                        upLineColor: colors.blue,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        }
                    }
                },
                tooltip: {
                    backgroundColor: "rgba(255,255,255,0.85)",
                    borderColor: "rgba(0,0,0,0.15)",
                    borderWidth: 1,
                    borderRadius: 0,
                    shape: "square",
                    shadow: false
                },
                rangeSelector: {
                    buttonTheme: {
                        fill: 'none',
                        stroke: 'none',
                        style: {
                            color: colors.gray,
                            background: 'transparent',
                            textTransform: 'uppercase',
                            fontFamily: 'Yantramanav',
                            letterSpacing: '0.05em',
                            fontSize: 14
                        },
                        states: {
                            hover: {
                                fill: 'none',
                                style: {
                                    background: 'transparent',
                                    color: colors.black
                                }
                            },
                            select: {
                                fill: 'none',
                                style: {
                                    color: colors.black
                                }
                            }
                        }
                    },
                    inputBoxWidth: 72,
                    inputBoxHeight: 15,
                    inputDateFormat: "%Y-%m-%d",
                    inputBoxStyle: {
                        stroke: 'none',
                        color: colors.red
                    },
                    inputBoxBorderColor: 'transparent'
                },
                navigator: {
                    maskFill: 'rgba(255, 255, 255, 0.5)',
                    series: {
                        type: 'areaspline',
                        color: '#EEE',
                        fillOpacity: 0.05,
                        dataGrouping: {
                            smoothed: true
                        },
                        lineWidth: 1,
                        lineColor: '#DDD',
                        marker: {
                            enabled: false
                        }
                    }
                }
            };
            Highcharts.setOptions(Highcharts.theme);
            // create the chart
            $('.instrument__chart__inner').highcharts('StockChart', {
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
                }],
                xAxis: {
                    gridLineColor: colors.offWhite,
                    gridLineWidth: 1,
                    lineColor: colors.offWhite,
                    tickColor: colors.offWhite
                },
                yAxis: {
                    gridLineColor: colors.offWhite,
                    gridLineWidth: 1,
                    tickAmount: 6
                },
                credits: {
                    enabled: false
                },
                chart: {
                    marginTop: 25,
                    marginLeft: 25,
                    marginRight: 25,
                    marginBottom: 25,
                    spacingRight: 25,
                    spacingBottom: 0
                },
                scrollbar: {
                    enabled: false
                }
            });
        });
    }

    // Smoothstate
    var smoothState = $('#site').smoothState({
        // Runs when a link has been activated
        onStart: {
            duration: 250, // Duration of our animation
            render: function (container) {
                container.addClass('is-ready');
                smoothState.restartCSSAnimations();
            }
        },
        onReady: {
            duration: 0,
            render: function (container, newContent) {
                container.removeClass('is-ready');
                container.html(newContent);
                initialize();
            }
        },
        prefetch: false,
        blacklist: '.no-ss',
        forms: '[type=submit]'
    }).data('smoothState');

})(jQuery);