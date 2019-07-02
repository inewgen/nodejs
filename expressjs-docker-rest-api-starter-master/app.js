const express = require('express');
const path = require('path');
const logger = require('morgan');
const bodyParser = require('body-parser');

const ApiResponse = require('./service/ApiResponse');
const routes = require('./routes');

const app = express();

app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', routes);

//Request not captured by any router
app.use(function(req, res, next) {
  let error = new ApiResponse(res, ApiResponse.ERROR, 404, 'Resource not found');
  next(error)

});

// error handler
app.use(function(err, req, res, next) {
    let apiResponse = new ApiResponse(res, ApiResponse.ERROR, err.code || 500, err.message || err.data);
    apiResponse.sendResponse();
});

module.exports = app;
