var React = require('react');
var io = require('socket.io-client')('http://localhost:3000');
io.on('test:App\\Events\\ViewInstrument', function(data) {
    console.log(data);
});


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
    render: function () {
        var items = [{name: "derp"}];

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

if(document.getElementById('orderbook')) {
    React.render(<Orderbook />, document.getElementById('orderbook'));
}