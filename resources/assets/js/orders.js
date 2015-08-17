var React = require('react');
var socket = require('socket.io-client')('http://localhost:3000');
var $ = require('jquery');
"use strict";

var Orderbook = React.createClass({

    getInitialState() {
        return {
            buyOrders: [],
            sellOrders: []
        }
    },

    _updateOrders() {

        var instrumentId = window.location.href.split('/').pop();
        $.get('/market/order/' + instrumentId, function(orders) {
            if(this.isMounted()) {
                this.setState({
                    buyOrders: orders.buyOrders,
                    sellOrders: orders.sellOrders
                });
            }
        }.bind(this));
    },

    componentDidMount() {

        this._updateOrders();

        socket.on('global:App\\Events\\ViewInstrument', function(message) {console.log(message);});
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
                        <Orderlist orders={this.state.buyOrders} side="1" />
                    </td>
                    <td className="orderbook__sell">
                        <Orderlist orders={this.state.sellOrders} side="0" />
                    </td>
                </tr>
            </tbody>
        </table>
        );
    }
});

var Orderlist = React.createClass({
    render() {

        var orders = this.props.orders;
        var renderOrders = [];
        for(var i = 0; i < 5; i++) {
            if(this.props.orders[i] !== undefined) {
                renderOrders.push(<Order key={this.props.orders[i].id} price={this.props.orders[i].price} volume={this.props.orders[i].volume} side={this.props.side} />);
            } else {
                renderOrders.push(<Order key={i} price="-" volume="-" side={this.props.side} />);
            }
        }

        return (
            <table>
                <thead>
                    <tr>
                        <th>Pris</th>
                        <th>Antal</th>
                    </tr>
                </thead>
                <tbody>
                    {renderOrders}
                </tbody>
            </table>
        )
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

        // Mirror td placement depending on side
        if(this.props.side) {
            return (
                <tr className="orderbook__order">
                    <td>{this.props.price}</td>
                    <td>{this.props.volume}</td>
                </tr>
            )
        } else {
            return (
                <tr className="orderbook__order">
                    <td>{this.props.volume}</td>
                    <td>{this.props.price}</td>
                </tr>
            )
        }
    }
});

React.render(
    <Orderbook />,
        document.getElementById('orderbook')
);