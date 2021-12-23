export default () => ({
  comments: {
    info: {
      total: 0,
      data: []
    },
    minus: 0,
    plus: 0,
  },
  search: {
    sort_by: 'id',
    page_length: 15,
    order: "desc",
    page: 1,
    rate: null
  },
  current: {
    rate: 0,
    user: {
      id: null,
      fio: '',
      email: '',
    },
    employee: {
      id: null,
      fio: '',
    },
    answer: '',
    message: '',
    answered_at: null,
    created_at: null,
  }
})
