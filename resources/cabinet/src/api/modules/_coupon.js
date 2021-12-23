import api from '@/api/api.js'

const index = params => api({
  method: 'get',
  url: 'admin/coupons',
  params
})

const update = ({id, ...data}) => api({
  method: 'patch',
  url: `admin/coupons/${id}`,
  data
})

const destroy = id => api({
  method: 'delete',
  url: `admin/coupons/${id}`,
})

export {
  index,
  update,
  destroy
}
