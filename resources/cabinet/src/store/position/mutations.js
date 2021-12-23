import initialState from './initialState'

const mutations = {
  index(state, payload) {
    state.employees = {
      ...state.employees,
      ...payload
    }
  },
  show(state, payload) {
    state.current = {
      ...state.current,
      ...payload
    }
  },
  list(state, payload) {
    state.list = payload
  },
  clear() {
    this.state.employee = initialState()
  }
}

export default mutations
