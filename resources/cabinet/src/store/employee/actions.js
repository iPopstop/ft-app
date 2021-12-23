import API from '@/api'

const actions = {
  index({dispatch, commit}, payload) {
    API.employee.index(payload).then(({data}) => {
      commit('index', data)
    })
  },
  show({dispatch, commit}, id) {
    API.employee.show(id).then(({data}) => {
      commit('show', data)
    })
  },
  store({dispatch, commit, state}, payload) {
    return new Promise((resolve, reject) => {
      API.employee.store(payload).then(() => {
        dispatch('index', state.search)
      }).catch(err => {
        reject(err)
      })
    })
  },
  tips({dispatch, commit, state}, payload) {
    API.employee.tips(payload).then(({data}) => {
      commit('tips', data)
    })
  }
}

export default actions
