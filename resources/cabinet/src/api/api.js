import axios from 'axios'
import qs from 'qs'
// import _has from "lodash/has"
const send = axios.create({
  paramsSerializer: (params) => qs.stringify(params),
  baseURL: 'https://fintech.popstop.space/api'
})

send.defaults.withCredentials = true

send.interceptors.response.use(
  (response) => {
    let data = response.data
    if (process.env.VUE_APP_FORM_NOTIFICATIONS && data.status === 'success' && data.message) {
      let msg = data.message
      helper.hasProperty(data, 'notification', process.env.VUE_APP_TOASTR_ALLOWED.split(','))
        ? toastr[data.notification](msg)
        : toastr['success'](msg)
    }
    if (process.env.VUE_APP_API_DEBUG && process.env.NODE_ENV !== 'production') {
      console.info('✉️ ', response)
    }
    return Promise.resolve(response)
  },
  (error) => {
    //helper.showDataErrorMsg(error)
    let status = error.response.status

    if (status === 419) {
      store.dispatch('config/cookies')
      store.dispatch('config/logout')
    }
    console.log(error.response.data)

    if (status === 422 && error.response.data.errors) {
      if (error.response.data.errors.message) {
        const msg = error.response.data.errors.message[0]
        toastr.error(msg)
      }
      if (error.response.data.errors.back) {
        router.go(-1)
      }
    }


    if (status === 403) {
      helper.notAccessibleMsg()
      let name = 'admin.main'
      if (router.currentRoute.name !== name) {
        router.push({name: 'admin.main'})
      }
    }

    return Promise.reject(error)
  }
)

export default send
