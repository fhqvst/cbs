var io = require('socket.io-client')('http://localhost:3000');
io.on('test:App\\Events\\ViewInstrument', function(data) {
    console.log(data);
});

/* LJAWDBKAJWGDV

var Order = React.createClass({
    render: function () {
        return (
            <tr>
                <td>{this.props.order.volume}</td>
                <td>{this.props.order.price}</td>
                <td>||||</td>
            </tr>
        );
    }
});

var Orderbook = React.createClass({

    getInitialState: function() {
        var orders = {};

        socket.onChange(function(order) {
            orders.push(order);
            this.setState(
                {orders: orders}
            );
        }.bind(this));

        return {orders: orders};
    },
    render: function () {
        var items = [];

        this.props.orders.forEach(function(element, index) {
            var order = this.props.orders[index];
            items.push(<Order volume={order.symbol} price={order.price} order={order} />);
        });

        return (
            <div className="row">
                <table className="table-hover">
                    <thead>
                        <tr>
                            <th>Antal</th>
                            <th>Pris</th>
                            <th>Köp</th>
                        </tr>
                    </thead>
                    <tbody>
                        {items}
                    </tbody>
                </table>
            </div>
        );
    }
});
    */