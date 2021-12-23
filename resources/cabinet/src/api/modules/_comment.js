import api from '@/api/api.js'

const index = params => api({
  method: 'get',
  url: 'admin/comments',
  params
})

const show = id => api({
  method: 'get',
  url: `admin/comments/${id}`,
})

const reply = ({id, ...data}) => api({
  method: 'post',
  url: `admin/reply/${id}`,
  data
})

const update = ({id, ...data}) => api({
  method: 'patch',
  url: `admin/comments/${id}`,
  data
})

const destroy = id => api({
  method: 'delete',
  url: `admin/comments/${id}`,
})

export {
  index,
  show,
  update,
  destroy,
  reply
}
