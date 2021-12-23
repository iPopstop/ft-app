import api from '@/api/api.js'

const index = params => api({
  method: 'get',
  url: 'admin/employees',
  params
})

const show = id => api({
  method: 'get',
  url: `admin/employees/${id}`,
})

const store = ({...data}) => api({
  method: 'post',
  url: `admin/employees`,
  data
})

const tips = ({id, ...params}) => api({
  method: 'get',
  url: `admin/tips/${id}`,
  params
})

const update = ({id, ...data}) => api({
  method: 'patch',
  url: `admin/employee/${id}`,
  data
})

const destroy = id => api({
  method: 'delete',
  url: `admin/employee/${id}`,
})

export {
  index,
  show,
  store,
  update,
  tips,
  destroy
}
