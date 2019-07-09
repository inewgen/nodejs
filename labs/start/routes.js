'use strict'

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Http routes are entry points to your web application. You can create
| routes for different URL's and bind Controller actions to them.
|
| A complete guide on routing is available here.
| http://adonisjs.com/docs/4.0/routing
|
*/

const Route = use('Route')

Route.get('/', ({ request, response }) => {
  response.json({
    greeting: 'Hello world in JSON'
  })
})

// Auth
Route.group(() => {
  Route.post('register', 'AuthController.register')
  Route.post('login', 'AuthController.login')
}).prefix('auth')

Route.group(() => {

  // Customers
  Route.get('customers', 'CustomerController.index')
  Route.post('customers', 'CustomerController.store')
  Route.get('customers/:id', 'CustomerController.show').middleware('findCustomer')
  Route.patch('customers/:id', 'CustomerController.update').middleware('findCustomer')
  Route.delete('customers/:id', 'CustomerController.delete').middleware('findCustomer')


  // Projects
  Route.get('projects', 'ProjectController.index')
  Route.post('projects', 'ProjectController.store')
  Route.get('projects/:id', 'ProjectController.show').middleware('findProject')
  Route.patch('projects/:id', 'ProjectController.update').middleware('findProject')
  Route.delete('projects/:id', 'ProjectController.delete').middleware('findProject')

  // tasks
  Route.get('tasks', 'TaskController.index')
  Route.post('tasks', 'TaskController.store')
  Route.get('tasks/:id', 'TaskController.show').middleware('findTask')
  Route.patch('tasks/:id', 'TaskController.update').middleware('findTask')
  Route.delete('tasks/:id', 'TaskController.delete').middleware('findTask')

  // Users
  Route.get('users', 'UserController.index')

}).prefix('api/v1').middleware('auth')
