var http = require('http')
var fs = require('fs')
var myuser = {
  "name": "Suraches",
  "job": "Programmer",
  "age": 80
}
http.createServer(function(req, res) {
  res.writeHead(200, {'Content-Type': 'application/json'})
  // var myStream = fs.createReadStream(__dirname + "/" + 'index.html', 'utf8')
  // myStream.pipe(res)
  res.end(JSON.stringify(myuser))
}).listen(3000, '127.0.0.1')