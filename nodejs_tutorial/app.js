var express = require('express')
var app = express()
app.set('view engine', 'ejs')
app.get('/:name', (req, res) => {
  var data = {user: "Suraches", age: 15, job: "Programmer"}
  res.render('profile', {person: req.params.name, data})
})
app.listen(3000)