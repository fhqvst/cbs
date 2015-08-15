var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('global');

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

io.on('connection', function(socket) {
    console.log('A user connected');
});

io.on('disconnect', function(socket) {
    console.log('A user disconnected');
});

http.listen(3000, function() {
    console.log('Socket.io server listening at port 3000 on all channels.');
});