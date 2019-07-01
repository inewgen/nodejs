console.log('Node.js is running...');

/////////////////
// setTimeout(function() {
// 	console.log('World');
// }, 2000);

// console.log('Hello');

///////////////////
// setInterval(function() {
// 	console.log('Fetching form dev.google.com');
// }, 2000);

// setInterval(function() {
// 	console.log('Fetching form www.amazon.com');
// }, 2000);

///////////////
// function queryDatabase(callback) {
// 	setTimeout(function(){
// 		var r = 'Finished queryDatabase()';
// 		callback(r);
// 	}, 2000);
// }

// function main() {
// 	queryDatabase(function(r) {
// 		console.log('Result: ' + r);
// 	});
// }

// main();

var http = require('http');

var httpServer = http.createServer(function(req, res) {
	res.writeHead(200, {'content-type': 'text/plain'});
	res.write('Hello\n');
	res.end('World');
});

httpServer.listen(9999);