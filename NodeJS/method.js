const pi = 3.14
const obj = {}
obj.updateData = () => {
  console.log("Update Data")
}
obj.deleteUser = () => {
  console.log("Delete User")
}

const update = () => "Update server"
const add = (a, b) => a+b

exports.pi = pi
exports.add = add
exports.update = update
exports.obj = obj
