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
  //   return { greeting: 'Hello world in JSON' }
})

// Customers
Route.get('api/v1/customers', 'CustomerController.index').middleware('auth')
Route.get('api/v1/customers/:id', 'CustomerController.show').middleware([
  'findCustomer'
])
Route.post('api/v1/customers', 'CustomerController.store')
Route.patch('api/v1/customers/:id', 'CustomerController.update').middleware([
  'findCustomer'
])
Route.delete('api/v1/customers/:id', 'CustomerController.delete').middleware([
  'findCustomer'
])

// projects
Route.get('api/v1/projects', 'ProjectController.index')
Route.get('api/v1/projects/:id', 'ProjectController.show').middleware(['findProject'])
Route.post('api/v1/projects', 'ProjectController.store')
Route.patch('api/v1/projects/:id', 'ProjectController.update').middleware([
  'findProject'
])
Route.delete('api/v1/projects/:id', 'ProjectController.delete').middleware([
  'findProject'
])

// tasks
Route.get('api/v1/tasks', 'TaskController.index')
Route.get('api/v1/tasks/:id', 'TaskController.show').middleware(['findTask'])
Route.post('api/v1/tasks', 'TaskController.store')
Route.patch('api/v1/tasks/:id', 'TaskController.update').middleware(['findTask'])
Route.delete('api/v1/tasks/:id', 'TaskController.delete').middleware(['findTask'])

Route.post('/auth/register', 'AuthController.register')
Route.post('/auth/login', 'AuthController.login')
