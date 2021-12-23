import initialState from './initialState'
import _has from 'lodash/has'
const mutations = {
  setCard(state, payload) {
    //state.card[payload.type] = payload.profile
    state.form = payload.form
  },
  setCardInfo(state, payload) {
    //state.card[payload.type] = payload.profile
    state.currentCard = _has(payload, 'information') ? payload.information : {fio: '', email: '', id: ''}
  },
  setErrors(state, payload) {
    state[payload.errors.state].errors = payload
  },
  clearErrors(state, name) {
    state[name].errors = {}
  },
  clearForm(state, name) {
    state[name] = initialState()[name]
  },
  clear() {
    this.state.config = initialState()
  }
}

export default mutations
