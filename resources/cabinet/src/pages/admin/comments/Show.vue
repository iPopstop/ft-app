<script>
import {mapState} from 'vuex'

export default {
  name: "CommentsShow",
  data: () => ({
    showCreateForm: false,
    reply: {
      answer: ''
    }
  }),
  computed: {
    ...mapState('comment', ['current'])
  },
  mounted() {
    this.loadComment()
  },
  methods: {
    loadComment() {
      this.$store.dispatch('comment/show', this.$route.params.id)
    },
    handleReply() {
      this.$store.dispatch('comment/reply', {id: this.$route.params.id, reply: this.reply.answer})
    }
  },
}
</script>
<template>
  <div class="web-app d-block h-100">
    <div class="row no-gutters app-block">
      <div class="col-md-12 app-content">
        <div class="app-content-body">
          <div class="app-detail show">
            <div class="card-header bg-white">
              <div class="app-detail-action-left align-items-center">
                <router-link
                  :to="{name: 'admin.comments.index'}"
                  class="app-detail-close-button btn btn-outline-light mr-3"
                >
                  <feather type="arrow-left"/>
                </router-link>
                <h5 class="mb-0">
                  Отзыв #{{ $route.params.id }}
                </h5>
              </div>
            </div>
            <div class="app-detail-article">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <div class="d-flex align-items-center">
                    <div>
                      <h6 class="m-b-0">
                        <span class="text-primary" v-if="current.user && current.user.fio">
                          {{ current.user.fio }}
                          ({{ current.user.tips }} руб. чаевых за всё время)
                        </span>
                      </h6>
                      <span class="small text-muted">{{ current.user.email || 'Почта не указана' }}</span>
                    </div>
                  </div>
                  <div class="ml-auto d-none d-md-block">
                    <span class="text-muted">{{ current.created_at }}</span>
                  </div>
                </div>
                <p>
                  Отзыв о сотруднике: <span class="font-weight-bold">{{ current.employee.fio }}</span>
                </p>
                <p>
                  Оценка: {{ current.rate }}
                </p>
                <p>
                  {{ current.message }}
                </p>
              </div>
              <hr class="m-0">
              <div class="card-body">
                <template v-if="current.answer">
                  <h6 class="mb-3 font-size-11 text-uppercase">Клиент получил ответ ({{ current.answered_at }}):</h6>
                  <div class="card">
                    <div class="card-body">
                      {{ current.answer }}
                    </div>
                  </div>
                </template>
                <template v-else-if="current.user.email">
                  <form @submit.prevent="handleReply">
                    <h6 class="mb-3 font-size-11 text-uppercase">Ответ</h6>
                    <textarea class="form-control mb-2" :rows="5" v-model="reply.answer"></textarea>
                    <button class="btn btn-primary ml-auto d-block" type="submit">Отправить</button>
                  </form>
                </template>
                <template v-else>
                  <h6 class="mb-3 font-size-11 text-uppercase">
                    Вы не можете ответить пользователю т.к. он не указал почту
                  </h6>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>