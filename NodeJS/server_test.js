var http = require('http')
var fs = require('fs')

let product = fs.readFileSync('data/data-product-0.json');
product = JSON.parse(product);
product = product.ITEMS

let data = {
  product
}

http.createServer(function(req, res) {
  res.writeHead(200, {'Content-Type': 'application/json'})
  res.end(JSON.stringify(data))
}).listen(3000, '127.0.0.1')