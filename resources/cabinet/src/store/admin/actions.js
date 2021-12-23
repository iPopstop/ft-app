/* eslint-disable */
import API from '@/api'
import {setTwoFactor} from "../../api/modules/_admin";

const fileDownload = require('js-file-download');

// noinspection all
const actions = {
  getRoles({commit}, payload = []) {
    return new Promise((resolve, reject) => {
      API.admin.getRoles(payload).then((response) => {
        commit('roles', response.data)
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  dashboard({commit}, payload) {
    API.admin.dashboard(payload).then(({data}) => {
      commit('dashboard', data)
    })
  },
  settings({commit}) {
    API.admin.settings().then(({data}) => {
      commit('settings', data)
    })
  },
  setSettings({commit, dispatch}, payload) {
    API.admin.setSettings(payload).then(() => {
      dispatch('settings')
    })
  },
  getQr({commit}) {
    return new Promise((resolve, reject) => {
      API.admin.getQr().then((response) => {
        commit('setQr', response.data)
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  downloadMainStats({commit, dispatch}) {
    return new Promise((resolve, reject) => {
      API.admin.downloadMainStats()
        .then(({data}) => {
          fileDownload(data, `Общая статистика.xlsx`)
          resolve(data)
        })
        .catch((err) => {
          reject(err)
        })
    })
  },
  downloadMainSupportersStats({commit, dispatch}) {
    return new Promise((resolve, reject) => {
      API.admin.downloadMainSupportersStats()
        .then(({data}) => {
          fileDownload(data, `Общая статистика.xlsx`)
          resolve(data)
        })
        .catch((err) => {
          reject(err)
        })
    })
  },
  createRole({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.admin.createRole(payload).then((response) => {
        dispatch('getRoles')
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  newReport({commit, dispatch, state}, payload) {
    return new Promise((resolve, reject) => {
      API.admin.newReport(payload).then((response) => {
        dispatch('getDepartment', {id: router.currentRoute.params.id, ...state.searchDepartments})
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  destroyRole({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.admin.destroyRole(payload).then((response) => {
        dispatch('getRoles')
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  getPermissions({commit}, payload = []) {
    return new Promise((resolve, reject) => {
      API.admin.getPermissions(payload).then((response) => {
        commit('permissions', response.data)
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  getPermissionsAssign({commit}) {
    return new Promise((resolve, reject) => {
      API.admin.getPermissionsAssign().then((response) => {
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  permissionsAssign({commit}, payload) {
    return new Promise((resolve, reject) => {
      API.admin.permissionsAssign(payload).then((response) => {
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
  createPermission({commit, dispatch}, payload) {
    return new Promise((resolve, reject) => {
      API.admin.createPermission(payload).then(({response, data}) => {
        dispatch('getPermissions')
        resolve(response)
      }).catch(err => {
        reject(err)
      })
    })
  },
}

export default actions
