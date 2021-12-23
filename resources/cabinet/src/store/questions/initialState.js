export default () => (
  {
    questions: {
      total: 0
    },
    current: {
      id: '',
      question: '',
      answer: '',
      priority: 1,
    },
    form: {},
    edit: {
      id: '',
      question: '',
      answer: '',
      priority: 1,
    },
    search: {
      page: 1,
      page_length: 10,
      question: '',
      answer: '',
      sort_by: 'priority',
      order: 'DESC',
    },
  }
)
