var React = require('react');
var socket = require('socket.io-client')('http://localhost:3000');
var $ = require('jquery');
"use strict";

var Orderbook = React.createClass({

    getInitialState() {
        return {
            orders: []
        }
    },

    _updateOrders() {

        var instrumentId = window.location.href.split('/').pop();
        $.get('/market/order/' + instrumentId, function(orders) {

            var fillerOrders = 5 - orders.length;
            for(var i = 0; i < fillerOrders; i++) {
                orders.push({
                    price: '-',
                    volume: '-'
                });
            }

            if(this.isMounted()) {
                this.setState({
                    orders: orders
                });
            }
        }.bind(this));
    },

    componentDidMount() {

        this._updateOrders();

        socket.on('global:App\\Events\\ViewInstrument', function(message) {
            console.log(message);
        });
        socket.on('global:App\\Events\\OrderCreated', this._updateOrders);
        socket.on('global:App\\Events\\TradeConfirmed', this._updateOrders);
    },

    render() {
        return (
        <table className="orderbook">
            <thead>
                <tr className="orderbook__titles">
                    <th className="orderbook__titles__buy">
                        Köp
                    </th>
                    <th className="orderbook__titles__sell">
                        Sälj
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td className="orderbook__buy">
                        <table>
                            <thead>
                                <tr>
                                    <th>Pris</th>
                                    <th>Antal</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    this.state.orders.map((order, index) => {
                                        return (
                                            <Order key={order.id} price={order.price} volume={order.volume} />
                                        )
                                    })
                                }
                            </tbody>
                        </table>
                    </td>
                    <td className="orderbook__sell">
                        <table>
                            <thead>
                                <tr>
                                    <th>Pris</th>
                                    <th>Antal</th>
                                </tr>
                            </thead>
                            <tbody>
                                {
                                    this.state.orders.map((order, index) => {
                                        return (
                                            <Order key={order.id} price={order.price} volume={order.volume} />
                                        )
                                    })
                                }
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        );
    }
});

var Order = React.createClass({

    _updateStock: function(message) {
        console.log("ORDER: " + message);
    },

    componentDidMount: function() {
        socket.on('global:App\\Events\\PutOrder', this._updateStock);
    },

    render: function(){
        return (
            <tr className="orderbook__order">
                <td>{this.props.price}</td>
                <td>{this.props.volume}</td>
            </tr>
        );
    }
});

React.render(
    <Orderbook />,
        document.getElementById('orderbook')
);