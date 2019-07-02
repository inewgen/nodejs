const express = require('express')
var bodyParser = require("body-parser")
const app = express()
app.use(bodyParser.json());
const books = require('./db')

app.get('/', (req, res) => {
  res.send('Hello World2')
})

app.get('/books', (req, res) => {
  res.json(books)
})

app.get('/books/:id', (req, res) => {
  res.json(books.find(book => book.id === req.params.id))
})

app.put('/books/:id', (req, res) => {
	const updateIndex = books.findIndex(book => book.id === req.params.id)
	res.json(Object.assign(books[updateIndex], req.body))
})

app.delete('/books/:id', (req, res) => {
	const deletedIndex = books.findIndex(book => book.id === req.params.id)
	books.splice(deletedIndex, 1)
	res.status(204).send()
})

app.listen(3000, () => {
  console.log('Start server at port 3000.')
})
