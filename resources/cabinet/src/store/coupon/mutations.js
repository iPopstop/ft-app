import initialState from './initialState'

const mutations = {
  index(state, payload) {
    state.coupons = {
      ...state.coupons,
      ...payload
    }
  },
  clear() {
    this.state.coupon = initialState()
  }
}

export default mutations
