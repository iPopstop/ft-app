/* eslint-disable */
import API from '@/api'
// noinspection all
const actions = {
  login({dispatch, commit}, payload) {
    return new Promise((resolve, reject) => {
      API.auth.login(payload).then((data) => {
        if (data.data.user) {
          dispatch('setAuthStatus')
        }
        resolve(data)
      }).catch((err) => {
        reject(err)
      })
    })
  },
  register({dispatch, commit}, payload) {
    return new Promise((resolve, reject) => {
      API.auth.register(payload).then((data) => {
        if (data.data.user) {
          dispatch('setAuthStatus')
          resolve(data)
        }
      }).catch((err) => {
        reject(err)
      })
    })
  },
  logout({dispatch, commit}) {
    return new Promise((resolve, reject) => {
      API.auth
        .logout()
        .then((data) => {
          dispatch('resetAuthUserDetail')
          resolve(data)
        })
        .catch((err) => reject(err))
    })
  },
  handle({dispatch, commit}, payload) {
    return new Promise((resolve, reject) => {
      API.admin.cfg(payload)
        .then((data) => {
          dispatch('check')
          resolve(data)
        })
        .catch((err) => reject(err))
    })
  },
  findCity({dispatch, commit}, payload) {
    return new Promise((resolve, reject) => {
      API.search.findCity(payload)
        .then((data) => {
          commit('setSuggestions', data.data.suggestions)
          resolve(data)
        })
        .catch((err) => reject(err))
    })
  },
  findUik({dispatch, commit}, payload) {
    return new Promise((resolve, reject) => {
      API.search.findUik(payload)
        .then((response) => {
          commit('setSuggestionsUik', response.data.suggestions)
          resolve(response)
        }).catch((err) => reject(err))
    })
  },
  findState({dispatch, commit}, payload) {
    return new Promise((resolve, reject) => {
      API.search.findState(payload)
        .then((data) => {
          commit('setSuggestionsState', data.data.suggestions)
          resolve(data)
        })
        .catch((err) => reject(err))
    })
  },
  news({dispatch, commit}, payload) {
    return new Promise((resolve, reject) => {
      API.user.news(payload)
        .then(({response, data}) => {
          commit('news', data.news)
          resolve(response)
        })
        .catch((err) => reject(err))
    })
  },
  cookies({dispatch, commit}) {
    API.auth.cookies()
  },
  check({commit, dispatch}) {
    return new Promise((resolve, reject) => {
      API.auth.check().then(({data}) => {
        //dispatch('setConfig', data.config)
        if (data.authenticated === true) {
          dispatch('setAuthUserDetail', data.user)
          dispatch('setPermission', data.permissions)
          dispatch('setDefaultRole', data.default_role)
        } else {
          dispatch('resetAuthUserDetail')
        }

        resolve(data.authenticated)
      }).catch((error) => {
        //resetAuthUserDetail
        dispatch('resetAuthUserDetail')
        reject(error)
      })
    })
  },
  setAuthStatus({commit}) {
    commit('setAuthStatus')
  },
  setConfig({commit}, config) {
    commit('setConfig', config)
  },
  setAuthUserDetail({commit}, auth) {
    commit('setAuthUserDetail', auth)
  },
  resetAuthUserDetail({commit}) {
    commit('resetAuthUserDetail')
  },
  pageLength({commit}, data) {
    return new Promise((resolve, reject) => {
      commit('setPageLength', data)
      resolve(data)
    })
  },
  setPermission({commit}, data) {
    commit('setPermission', data)
  },
  setDefaultRole({commit}, data) {
    commit('setDefaultRole', data)
  }
}

export default actions
