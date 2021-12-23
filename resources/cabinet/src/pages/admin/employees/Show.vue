<script>
import {mapState} from 'vuex'

export default {
  name: "EmployeesShow",
  data: () => ({
    showCreateForm: false,
    createForm: {
      position_id: null
    },
    currentTab: 'tips',
    tabs: [
      {
        label: 'Чаевые',
        name: 'tips'
      },
      {
        label: 'Редактировать',
        name: 'settings'
      }
    ]
  }),
  computed: {
    ...mapState('employee', ['current', 'search', 'currentTips']),
    id() {
      return this.$route.params.id
    }
  },
  methods: {
    loadEmployee() {
      this.$store.dispatch('employee/show', this.id).then(() => this.loadTips()).then(() => {
        Echo.private('user.tips.' + this.id).notification((notification) => {
          console.log(notification.type);
        })
      })
    },
    loadTips() {
      this.$store.dispatch('employee/tips', {id: this.id, ...this.search})
    },
    loadStats() {
      this.$store.dispatch('employee/stats', id)
    },
    loadForm() {
      this.$store.dispatch('position/list')
    }
  },
  mounted() {
    this.loadEmployee()
    this.loadForm()
  },
  watch: {
    currentTab: {
      handler(newValue) {
        if (newValue === 'stats') {
          console.log('stats')
        }
      }
    },
    search: {
      handler() {
        this.loadTips()
      },
      deep: true,
    }
  }
}
</script>
<template>
  <div>
    <div class="profile-container">
      <div class="d-flex align-items-center">
        <figure class="avatar avatar-lg mr-3">
        </figure>
        <div>
          <h4 class="mb-0">{{ current.fio }}</h4>
          <small class="mr-2">{{ current.position.name }}</small>
          <template v-if="current.tips_enabled">
            <span class="badge bg-success-bright text-success">Чаевые включены</span>
          </template>
          <template v-else>
            <span class="badge bg-danger-bright text-danger">Чаевые выключены</span>
          </template>
        </div>
      </div>
      <div class="profile-menu">
        <ul class="nav nav-pills flex-column flex-sm-row" id="myTab" role="tablist">
          <li class="flex-sm-fill text-sm-center nav-item" v-for="tab in tabs">
            <button class="btn btn-link nav-link" :class="{'active': currentTab === tab.name}"
                    @click="currentTab = tab.name">
              {{ tab.label }}
            </button>
          </li>
        </ul>
      </div>
    </div>
    <div class="mt-2">
      <div class="card">
        <div class="card-body">
          <div v-if="currentTab === 'tips'">
            <div class="my-2">
              <div class="card-columns">
                <div class="card text-center p-3">
                  <blockquote class="blockquote mb-0 card-body">
                    <p>Количество чаевых: {{ current.tips_count }}</p>
                    <footer class="blockquote-footer">
                      <small class="text-muted">
                        За <cite title="Source Title">месяц</cite>
                      </small>
                    </footer>
                  </blockquote>
                </div>
                <div class="card bg-success text-center p-3">
                  <blockquote class="blockquote mb-0 card-body">
                    <p>Средний размер чаевых: {{ current.avg_tips }}</p>
                  </blockquote>
                </div>
                <div class="card text-center p-3">
                  <blockquote class="blockquote mb-0 card-body">
                    <p>Сумма чаевых: {{ current.sum_tips }}</p>
                    <footer class="blockquote-footer">
                      <small class="text-white opacity-6">
                        За <cite title="Source Title">всё время</cite>
                      </small>
                    </footer>
                  </blockquote>
                </div>
              </div>
            </div>
            <h6 class="card-title d-flex justify-content-between align-items-center">
              Последние чаевые
            </h6>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex align-items-center px-0" v-for="tip in currentTips.data">
                <figure class="avatar avatar-state-success mr-3">
                  <img src="https://eu.ui-avatars.com/api/?name=Vjacheslav+Kutov" class="rounded-circle" alt="image">
                </figure>
                <div>
                  <h6 class="mb-0">{{ tip.sum_tips }} руб.
                    <router-link v-if="tip.comment_id" class="font-weight-bold"
                                 :to="{name: 'admin.comments.show', params: {id: tip.comment_id}}">
                      С комментарием
                    </router-link>
                  </h6>
                  <small class="text-muted">{{ tip.user.fio }} - {{ tip.created_at }}</small>
                </div>
              </li>
            </ul>
            <div class="mt-2">
              <pagination-record
                :records="currentTips"
                :page.sync="search.page"
                :page-length.sync="search.page_length"
              />
            </div>
          </div>
          <div v-else>
            <h6 class="card-title d-flex justify-content-between align-items-center">
              Редактирование
            </h6>
            <form action="">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>