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

    _updateOrders(order) {
        var {orders} = this.state;
        orders.push(order.data);
        this.setState({orders});
    },

    componentDidMount() {

        var instrumentId = window.location.href.split('/').pop();
        $.get('/market/order/' + instrumentId, function(orders) {
            if(this.isMounted()) {
                this.setState({
                    orders: orders
                });
            }
        }.bind(this));

        socket.on('global:App\\Events\\ViewInstrument', function(message) {
            console.log(message);
        });
        socket.on('global:App\\Events\\OrderCreated', this._updateOrders);
        socket.on('global:App\\Events\\TradeConfirmed', this._updateOrders);
    },

    render() {
        return (
            <table className="orderbook__orders">
                <tbody>
                    {
                        this.state.orders.map((order, index) => {
                            return (
                                <Order key={order.id} price={order.price} />
                            )
                        })
                    }
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
            <div className="orderbook__order">
                <h1>{this.props.price}</h1>
            </div>
        );
    }
});

React.render(
    <Orderbook />,
        document.getElementById('orderbook')
);