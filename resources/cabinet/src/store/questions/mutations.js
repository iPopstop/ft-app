import _isArray from 'lodash/isArray'
import _map from 'lodash/map'
import initialState from './initialState'

const mutations = {
  index(state, payload) {
    state.questions = {
      ...state.questions,
      ...payload
    }
  },
  show(state, payload) {
    state.current = {
      ...state.current,
      ...payload
    }

    for (const key in state.edit) {
      if ({}.hasOwnProperty.call(state.edit, key)) {
        if ({}.hasOwnProperty.call(payload, key)) {
          state.edit[key] = payload[key]
        }
      }
    }
  },
  clear() {
    this.state.questions = initialState()
  }
}

export default mutations
