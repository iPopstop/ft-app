import API from '@/api'

const actions = {
  index({dispatch, commit}, payload) {
    API.comment.index(payload).then(({data}) => {
      commit('index', data)
    })
  },
  show({dispatch, commit}, id) {
    API.comment.show(id).then(({data}) => {
      commit('show', data)
    })
  },
  reply({dispatch, commit}, payload) {
    API.comment.reply(payload).then(({data}) => {
      dispatch('show', payload.id)
    })
  }
}

export default actions
