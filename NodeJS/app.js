var fs = require('fs')
var data = 'Suraches nodejs mongodb express';
var writerStream = fs.createReadStream('output.txt')
writerStream.push(data, 'utf8')
writerStream.end
writerStream.on('finish', () => {
  console.log("Output Finish")
})