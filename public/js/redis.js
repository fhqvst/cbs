var app = require('http').createServer(handler);
var io = require('socket.io')(app);
var feed = require('socket.io');

var Redis = require('ioredis');
var redis = new Redis();

app.listen(6379, function() {
    console.log('Server is running!');
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

io.on('connection', function(socket) {
    console.log('a user connected');
    socket.on('disconnect', function(){
        console.log('user disconnected');
    });
});

redis.psubscribe('*', function(err, count) {
    console.log('Redis: All channels subscribed');
});

redis.on('pmessage', function(subscribed, channel, message) {
    console.log("message found on channel " + channel)
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});