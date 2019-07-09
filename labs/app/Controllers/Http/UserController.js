'use strict'
const User = use('App/Models/User')

class UserController {
  async index({ response }) {
    const users = await User.all()

    response.status(200).json({
      message: 'Here are your users.',
      data: users
    })
  }

  async store({ request, response }) {
    const { name, description } = request.post()

    // save and get instance back
    const user = await User.create({ name, description })

    response.status(201).json({
      message: 'Successfully created a new user.',
      data: user
    })
  }

  async show({ request, response }) {
    const user = await User.find(request.params.id)
    response.status(200).json({
      message: 'Here is your user.',
      data: user
    })
  }

  async update({ request, response }) {
    const { name, description, user } = request.post()

    user.name = name
    user.description = description

    await user.save()

    response.status(200).json({
      message: 'Successfully updated this user.',
      data: user
    })
  }

  async delete({ request, response, params: { id } }) {
    const user = request.post().user

    await user.delete()

    response.status(200).json({
      message: 'Successfully deleted this user.',
      id
    })
  }
}

module.exports = UserController
