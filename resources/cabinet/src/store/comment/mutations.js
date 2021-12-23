import initialState from './initialState'

const mutations = {
  index(state, payload) {
    state.comments = {
      ...state.comments,
      ...payload
    }
  },
  show(state, payload) {
    state.current = {
      ...state.current,
      ...payload
    }
  },
  clear() {
    this.state.comment = initialState()
  }
}

export default mutations
