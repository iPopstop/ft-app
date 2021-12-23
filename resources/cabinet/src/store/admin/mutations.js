import initialState from './initialState'

const mutations = {
  roles(state, payload) {
    state.roles = {
      ...state.roles,
      ...payload
    }
  },
  dashboard(state, payload) {
    state.dashboard = {
      ...state.dashboard,
      ...payload
    }
  },
  authentications(state, payload) {
    state.user.authentications = payload
  },
  clearQr(state) {
    let is = initialState()
    state.qr = is.qr
  },
  permissions(state, payload) {
    state.permissions = {
      ...state.permissions,
      ...payload
    }
  },
  settings(state, payload) {
    state.settings = {
      ...state.settings,
      ...payload
    }
  },
  clear() {
    this.state.admin = initialState()
  }
}

export default mutations
