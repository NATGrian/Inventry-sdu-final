import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
 state: {
  api_token: null,
  user_id: null,
  userPermission: null
 },
 mutations: {
  apitoken(state, data){
   state.api_token = data
 },
 users_id(state, data){
  state.user_id = data
 },
 auth(state, data){
  state.userPermission = data
 },
 },
 actions: {
  set_apitoken({ commit }, data) {
   commit('apitoken', data)
  },
  set_id({ commit }, data) {
   commit('users_id', data)
  },
  set_auth({ commit }, data) {
   commit('auth', data)
  },
 }

})