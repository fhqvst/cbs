var React = require('react');
var io = require('socket.io-client');

(function($) {

    "use strict";

    // Initialize
    $(document).ready(initialize);
    function initialize() {

        $('.block__header').click(function() {
            $(this).parents('.block').toggleClass('is-minimized');
            $(this).find('i').toggleClass('ion-ios-minus-empty');
            $(this).find('i').toggleClass('ion-ios-plus-empty');
        });

        $('.notice__close').click(function() {
            $(this).parents('.notice').remove();
        });

        /*

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
                title: {
                    style: {
                        color: '#333',
                        font: 'bold 16px DIN Pro, Roboto, Helvetica, sans-serif'
                    }
                },
                subtitle: {
                    style: {
                        color: '#333',
                        font: 'bold 12px serif'
                    }
                },

                plotOptions: {
                    candlestick: {
                        color: colors.orange,
                        upColor: colors.blue,
                        lineColor: colors.orange,
                        upLineColor: colors.blue,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        }
                    }
                },

                tooltip: {
                   backgroundColor: "rgba(255,255,255,0.75)",
                    borderColor: "rgba(0,0,0,0.25)",
                    borderWidth: 1,
                    borderRadius: 0,
                    shape: "square",
                    shadow: false
                },

                rangeSelector: {
                    buttonTheme: { // styles for the buttons
                        fill: 'none',
                        stroke: 'none',
                        'stroke-width': 0,
                        style: {
                            color: colors.gray,
                            background: 'transparent',
                            textTransform: 'uppercase',
                            fontFamily: 'DIN Pro',
                            letterSpacing: '0.05em'
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
                    inputStyle: {
                        color: '#039',
                        fontWeight: 'bold'
                    },
                    labelStyle: {
                        left: 50
                    },
                    selected: 1
                },

                legend: {
                    itemStyle: {
                        font: '9pt Calibri, Roboto, sans-serif',
                        color: 'black'
                    },
                    itemHoverStyle:{
                        color: '#38BBA5'
                    }
                },


                navigator: {
                    outlineColor: colors.gray
                }
            };

            Highcharts.setOptions(Highcharts.theme);

            // create the chart
            $('.instrument__chart__inner').highcharts('StockChart', {

                rangeSelector : {
                    selected : 1
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
                }],
                xAxis: {
                    gridLineColor: colors.offWhite,
                    gridLineWidth: 1
                },
                yAxis: {
                    gridLineColor: colors.offWhite,
                    gridLineWidth: 1
                },

                credits: {
                    enabled: false
                },
                chart: {
                    marginTop: 0,
                    marginLeft: 0,
                    marginRight: 0,
                    marginBottom: 25,
                    spacingRight: 25,
                    spacingBottom: 0
                },
                scrollbar: {
                    enabled: false
                }

            });
        });

        */

        // SMOOTHSTATE

        //.data('smoothState') makes public methods available


    }

    // Smoothstate
    var smoothState = $('#site').smoothState({
        // Runs when a link has been activated
        onStart: {
            duration: 500, // Duration of our animation
            render: function (container) {
                container.addClass('is-loading');
            }
        },
        onReady: {
            duration: 0,
            render: function (container, newContent) {
                container.removeClass('is-loading');
                container.html(newContent);
                initialize();
            }
        },
        prefetch: false
    }).data('smoothState');



    // Socket
    var socket = io('http://localhost:3000');


    var orders;
    socket.on('test:App\\Events\\ViewInstrument', function(data) {
        orders.push(data);
    });


    // React
    var Orderbook = React.createClass({
        getInitialState: function() {
            return {orders: []};
        },
        componentDidMount: function() {
            this.set
        },
        render: function() {

            var orderNodes = this.props.orders.map(function(order) {
                return <Order price="{order.price}"></Order>
            });

            return (
               <table class="orderbook__book">
                   <thead>
                       <tr>
                           <th>Köp</th>
                           <th>Sälj</th>
                       </tr>
                   </thead>
                   <tbody>
                       <tr>
                            {orderNodes}
                       </tr>
                   </tbody>
               </table>
            );
        }
    });

    var Order = React.createClass({
        render: function() {
            return (
                <td>
                    <p class="orderbook__order">{this.props.price}</p>
                </td>
            );
        }
    });

    React.render(
        <Orderbook orders="{orders}" />,
        document.getElementsByClassName('orderbook')[0]
    );

})(jQuery);