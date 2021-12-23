export default () => ({
  auth: {
    id: '',
    email: '',
    io: '',
    fio: '',
    fi: '',
    roles: [],
    preferences: {
      page_length: 15
    },
    roles_list: [],
  },
  news: {
    total: 0,
    data: {}
  },
  is_auth: false,
  config: {
    page_length: 15,
    pagination: [1, 15, 30, 40, 60, 100]
  },
  permissions: [],
  last_activity: null,
  default_role: {
    admin: 'Администратор',
    sadmin: 'Администратор (С)',
    employee: 'Сотрудник',
    regadmin: '',
    partymember: '',
    msrmember: '',
    user: '',
  }
})
