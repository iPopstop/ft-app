import API from '@/api'

const fileDownload = require('js-file-download');

const actions = {
  checkCard({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.user.checkCard(payload)
        .then(({data}) => {
          commit('setCard', data)
          resolve(data)
        })
        .catch((err) => {
          reject(err)
        })
    })
  },
  getCard({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.user.getCard(payload)
        .then(({data}) => {
          if(payload !== 'default') {
            fileDownload(data, 'Карточка.docx')
          }else{
            fileDownload(data, 'Карточка.xlsx')
          }
          resolve(data)
        })
        .catch((err) => {
          reject(err)
        })
    })
  },
  editCard({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.user.editCard(payload)
        .then(({data}) => {
          resolve(data)
        }).catch((err) => {
          reject(err)
        })
    })
  },
  mailCard({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.user.mailCard(payload)
        .then(({data}) => {
          resolve(data)
        }).catch((err) => {
          reject(err)
        })
    })
  },
  destroyCard({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.user.destroyCard(payload)
        .then(({data}) => {
          resolve(data)
        }).catch((err) => {
          reject(err)
        })
    })
  },
  getApplication({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.user.getApplication(payload)
        .then(({data}) => {
          let name = payload === 'default' ? 'Заявление в партию' : 'Заявление в МСР'
          fileDownload(data, `${name}.docx`)
          resolve(data)
        })
        .catch((err) => {
          reject(err)
        })
    })
  },
  setCard({commit}, payload) {
    return new Promise((resolve, reject) => {
      API.user.setCard(payload)
        .then((res) => {
          commit('setCardInfo', res.data)
          resolve(res)
        })
        .catch((err) => {
          reject(err)
        })
    })
  },
}

export default actions
