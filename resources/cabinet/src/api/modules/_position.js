import api from '@/api/api.js'

const index = params => api({
  method: 'get',
  url: 'admin/positions',
  params
})

const show = id => api({
  method: 'get',
  url: `admin/positions/${id}`,
})

const list = () => api({
  method: 'get',
  url: `admin/positions/list`,
})

const update = ({id, ...data}) => api({
  method: 'patch',
  url: `admin/positions/${id}`,
  data
})

const destroy = id => api({
  method: 'delete',
  url: `admin/positions/${id}`,
})

export {
  index,
  show,
  list,
  update,
  destroy
}
