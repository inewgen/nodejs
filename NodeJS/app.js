var express = require('express')
var routing = express()
routing.get('/home', (req, res) => {
  res.send('<h1>Helloworld</h1>')
})
routing.listen(3000)