export default {
	state: {
		api_token: null,
		user_id: null,
		authenticated: null
	},
	initialize() {
		this.state.api_token = localStorage.getItem('api_token')
		this.state.authenticated = localStorage.getItem('authenticated')
		this.state.user_id = parseInt(localStorage.getItem('user_id'))
	},
	set(api_token, user_id ,authenticated)  {
		localStorage.setItem('api_token', api_token)
		localStorage.setItem('user_id', user_id)
		localStorage.setItem('authenticated', authenticated)
		this.initialize()
	},
	remove() {
		localStorage.removeItem('api_token')
		localStorage.removeItem('authenticated')
		localStorage.removeItem('user_id')
		this.initialize()
	}
}