<script>
import {mapState} from 'vuex'

export default {
  name: "CommentsIndex",
  data: () => ({
    showCreateForm: false,
    createForm: {
      position_id: null
    }
  }),
  computed: {
    ...mapState('comment', ['comments', 'search'])
  },
  methods: {
    loadComments() {
      this.$store.dispatch('comment/index', this.search)
    }
  },
  watch: {
    search: {
      handler() {
        this.loadComments()
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
<template>
  <div class="web-app">
    <div class="row no-gutters app-block">
      <div class="col-md-3 app-sidebar" tabindex="5">
        <div>
          <div class="list-group list-group-flush">
            <button
              class="list-group-item d-flex align-items-center"
              :class="{'active': search.rate === null}"
              @click="search.rate = null"
            >
              Все
              <span class="small ml-auto">{{ comments.total }}</span>
            </button>
            <button
              class="list-group-item d-flex align-items-center"
              :class="{'active': search.rate === '+'}"
              @click="search.rate = '+'"
            >
              Положительные
              <span class="small ml-auto">{{ comments.plus }}</span>
            </button>
            <button
              class="list-group-item d-flex align-items-center"
              :class="{'active': search.rate === '-'}"
              @click="search.rate = '-'"
            >
              Отрицательные
              <span class="small ml-auto">{{ comments.minus }}</span>
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-9 app-content">
        <h3 class="mb-4">Отзывы</h3>
        <div class="app-action">
          <div class="action-right">
            <ul class="list-inline">
              <li class="list-inline-item mb-0">
                <a href="#" class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown">
                  Сортировать
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <button
                    class="dropdown-item"
                    @click.prevent="search.sort_by = 'id'"
                    :disabled="search.sort_by === 'id'"
                  >
                    По дате
                  </button>
                  <div class="dropdown-divider"></div>
                  <button
                    class="dropdown-item"
                    :disabled="search.order === 'asc'"
                    @click="search.order = 'asc'"
                  >
                    По возрастанию
                  </button>
                  <button
                    class="dropdown-item"
                    :disabled="search.order === 'desc'"
                    @click="search.order = 'desc'"
                  >
                    По убыванию
                  </button>
                </div>
              </li>
            </ul>
            <form class="d-flex mr-3">
              <a href="#" class="app-sidebar-menu-button btn btn-outline-light">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="feather feather-menu width-15 height-15">
                  <line x1="3" y1="12" x2="21" y2="12"></line>
                  <line x1="3" y1="6" x2="21" y2="6"></line>
                  <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
              </a>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Поиск по почте" v-model="search.email">
              </div>
            </form>
            <div class="app-pager d-flex align-items-center">
              <div class="mr-3">
                Всего {{ comments.info.total || 0 }}
              </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item">
                    <button
                      class="page-link"
                      aria-label="Назад"
                      @click="comments.prev_page_url ? search.page -= 1 : null"
                    >
                      Назад
                    </button>
                  </li>
                  <li class="page-item">
                    <button
                      class="page-link"
                      aria-label="Вперёд"
                      @click="comments.next_page_url ? search.page += 1 : null"
                    >
                      Вперёд
                    </button>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="app-content-body">
          <div class="app-lists" tabindex="4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"
                  v-for="comment in comments.info.data"
                  :key="comment.id"
                  @click="$router.push({name: 'admin.comments.show', params: {id: comment.id}})"
              >
                <div class="d-none d-sm-block">
                  <a href="#" class="add-star mr-3" title="Add stars">
                    <i class="fa fa-star-o font-size-16"></i>
                  </a>
                </div>
                <div class="d-none d-sm-block">
                  <figure class="avatar avatar-sm mr-3">
                    <span class="avatar-title rounded-circle"
                          :class="{'bg-danger-bright text-danger': comment.rate < 4, 'bg-success-bright text-success': comment.rate > 3}"/>
                  </figure>
                </div>
                <div class="flex-grow-1 min-width-0">
                  <div class="mb-1 d-flex justify-content-between align-items-center">
                    <div class="text-truncate app-list-title">
                      {{ comment.user.fio }}
                      ({{ comment.employee.fio }} - оценка {{ comment.rate }})
                    </div>
                    <div class="pl-3 d-flex">
                      <span class="text-nowrap text-muted">{{ comment.created_at }}</span>
                    </div>
                  </div>
                  <div class="text-muted d-flex justify-content-between">
                    <div class="text-truncate small">
                      {{ comment.message | truncate(50) }}
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>