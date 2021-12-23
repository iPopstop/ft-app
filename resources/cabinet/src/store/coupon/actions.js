import API from '@/api'

const actions = {
  index({dispatch, commit}, payload) {
    API.coupon.index(payload).then(({data}) => {
      commit('index', data)
    })
  }
}

export default actions
