const express = require('express');
const router = express.Router();
const ApiResponse = require('../service/ApiResponse');
const os = require('os');

router.get('/server', function(req, res, next) {
  let apiResponse = new ApiResponse(res, ApiResponse.SUCCESS, 200, os.cpus());
  apiResponse.sendResponse();
});

module.exports = router;
