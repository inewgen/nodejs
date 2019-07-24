const express = require('express')
var bodyParser = require("body-parser")
const app = express()
app.use(bodyParser.json());

let product = require('./data/data-product-0')
let combo_product = require('./data/data-combo-product-0')
let modify_group = require('./data/data-modify-group-0')
let product_modify = require('./data/data-product-modify-0')
let store = require('./data/data-store-0')
let tax = require('./data/data-tax-0')
let tender = require('./data/data-tender-0')

let product_map = {}
product.ITEMS.forEach((item, key) => {
	product_map[item.PRODUCT_CODE] = item
})

let product_map2 = {}
product.ITEMS.forEach((item, key) => {
	product_map2[item.PRODUCT_CODE] = item
})

const data = {
	product: product_map,
	combo_product: combo_product.ITEMS
}

const response = product_map2

app.get('/', (req, res) => {
  res.json(response)
})

app.listen(3000, () => {
  console.log('Start server at port 3000.')
})
