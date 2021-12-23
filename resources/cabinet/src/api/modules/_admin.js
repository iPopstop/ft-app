import api from '@/api/api.js'

const dashboard = () =>
  api({
    method: 'get',
    url: 'admin/dashboard'
  })

const getStats = () =>
  api({
    method: 'get',
    url: `admin/stats`,
  })

const settings = () =>
  api({
    method: 'get',
    url: `admin/settings`,
  })

const setSettings = ({...data}) =>
  api({
    method: 'post',
    url: `admin/settings`,
    data
  })

export {
  dashboard,
  getStats,
  settings,
  setSettings
}
