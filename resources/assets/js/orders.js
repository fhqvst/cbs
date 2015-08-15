var React = require('react');
var socket = require('socket.io-client')('http://localhost:3000');

"use strict";

var Orderbook = React.createClass({

    getInitialState() {
        return {
            orders: []
        };
    },

    _getOrders: function(message) {
        this.setState({
            orders: message.data.orders
        });
    },

    componentDidMount: function() {
        socket.on('global:App\\Events\\PutOrder', this._getOrders(message));
    },

    render: function(){
        return (
            <table>
                <tbody>
                    {
                        this.props.orders.map((order, index) => {
                            return (
                                <Order price="{order.price}" />
                            );
                        })
                    };
                </tbody>
            </table>
        );
    }
});

var Order = React.createClass({

    getInitialState() {
        return {price: 25};
    },

    _updateStock: function(message) {

        this.setState({
            price: message.data.price
        });
    },

    componentDidMount: function() {
        socket.on('global:App\\Events\\PutOrder', this._updateStock);
    },

    render: function(){
        return (
            <h1>{this.state.price}</h1>
        );
    }
});


React.render(
    <Order price="13.37" side="1"/>,
    document.getElementById('orderbook')
);