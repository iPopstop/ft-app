import API from '@/api'

const actions = {
  index({dispatch, commit}, payload) {
    API.position.index(payload).then(({data}) => {
      commit('index', data)
    })
  },
  list({commit}) {
    API.position.list().then(({data}) => {
      commit('list', data)
    })
  },
  show({dispatch, commit}, id) {
    API.position.show(id).then(({data}) => {
      commit('show', data)
    })
  },
}

export default actions
