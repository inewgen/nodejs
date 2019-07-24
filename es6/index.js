const addUser = (name, last, ...city) => {
  return `${name} + ${last} + ${city}`
}
console.log(addUser("ches", "scs", "Bangkok", "KhonKhan"))

const addMessage = (first, ...message) => {
  return message.map(m => first + message) 
}
console.log(addMessage("Hello", "JS", "React"))
