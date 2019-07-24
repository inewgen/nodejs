var fs = require('fs')
var readMe = fs.readFileSync('code.txt', 'utf8')
console.log(readMe)

fs.mkdir('Project', () => {
  fs.writeFileSync('./Project/Readme.txt', readMe)
})