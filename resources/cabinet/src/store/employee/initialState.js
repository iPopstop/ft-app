export default () => ({
  employees: {
    total: 0,
    data: []
  },
  search: {
    page_length: 15,
    order: "desc",
    page: 1,
    first_name: '',
    last_name: '',
    middle_name: '',
  },
  current: {
    id: null,
    fio: '',
    email: '',
    mobile_number: '',
    tips_enabled: 0,
    position: {
      id: null,
      name: ''
    }
  },
  currentTips: {
    total: 0,
    data: []
  }
})
