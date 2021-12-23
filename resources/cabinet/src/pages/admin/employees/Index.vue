<script>
import {mapState} from 'vuex'
import {Form} from '@/utils/helpers/_form'

export default {
  name: "EmployeesIndex",
  data: () => ({
    showCreateForm: false,
    createForm: new Form({
      first_name: '',
      middle_name: '',
      last_name: '',
      patronymic: '',
      mobile_number: '',
      email: '',
      position_id: null
    })
  }),
  computed: {
    ...mapState('employee', ['employees', 'search'])
  },
  methods: {
    loadEmployees() {
      this.$store.dispatch('employee/index', this.search)
    },
    handleCreate() {
      this.createForm.submit('employee/store')
    }
  },
  watch: {
    search: {
      handler() {
        this.loadEmployees()
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
<template>
  <div>
    <div class="page-header d-md-flex justify-content-between align-items-center">
      <div>
        <h3 class="mb-0">Сотрудники</h3>
      </div>
      <div class="mt-2 mt-md-0">
        <div class="dropdown">
          <a href="#" class="btn btn-success dropdown-toggle" title="Filter" data-toggle="dropdown">Фильтры</a>
          <div class="dropdown-menu dropdown-menu-big p-4 dropdown-menu-right">
            <form>
              <div class="form-group">
                <label>Роль</label>
                <select class="form-control">

                </select>
              </div>
            </form>
          </div>
        </div>
        <div class="d-inline ml-2">
          <button href="#" class="btn btn-primary" @click="showCreateForm = !showCreateForm">
            <feather type="plus"/>
          </button>
        </div>
      </div>
    </div>
    <transition name="fade">
      <div class="my-2" v-if="showCreateForm">
        <div class="card">
          <div class="card-header">Добавление сотрудника</div>
          <div class="card-body">
            <form @submit.prevent="handleCreate">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="last_name">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" placeholder="Укажите фамилию"
                           v-model="createForm.last_name">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="first_name">Имя</label>
                    <input type="text" class="form-control" id="first_name" placeholder="Укажите имя"
                           v-model="createForm.first_name">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="middle_name">Отчество</label>
                    <input type="text" class="form-control" id="middle_name" placeholder="Укажите отчество"
                           v-model="createForm.middle_name">
                  </div>
                </div>
              </div>
              <div class="form-group mt-1">
                <label for="mobile_number">Номер телефона</label>
                <input type="text" class="form-control" id="mobile_number"
                       placeholder="Укажите номер телефона в формате 8..." v-model="createForm.mobile_number">
                <small>Все лишние символы будут удалены автоматически</small>
              </div>
              <div class="form-group mt-1">
                <label for="position_id">Должность</label>
                <select class="form-control" id="position_id" v-model="createForm.position_id">
                  <option value="null">-</option>
                </select>
                <small>Должности можно изменить в настройках</small>
              </div>
              <button type="submit" class="btn btn-primary">Создать</button>
            </form>
          </div>
        </div>
      </div>
    </transition>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive" tabindex="4">
              <div id="user-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="my-2">
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table id="user-list" class="table table-lg dataTable no-footer" role="grid"
                           aria-describedby="user-list_info">
                      <thead>
                      <tr role="row">
                        <th>ID</th>
                        <th>ФИО</th>
                        <th>Email</th>
                        <th>Среднее количество чаевых</th>
                        <th>Чаевые</th>
                        <th class="text-right sorting_disabled" rowspan="1" colspan="1">Действие</th>
                      </tr>
                      </thead>
                      <tbody>
                      <template v-for="employee in employees.data">
                        <tr role="row" class="odd">
                          <td>{{ employee.id }}</td>
                          <td>
                            <a href="#">
                              <figure class="avatar avatar-sm mr-2">
                                <img :src="`https://eu.ui-avatars.com/api/?name=${employee.fio}`" class="rounded-circle"
                                     alt="avatar">
                              </figure>
                              {{ employee.fio }}
                            </a>
                          </td>
                          <td>{{ employee.email || 'Не указан' }}</td>
                          <td>{{ employee.avg_tips }} руб.</td>
                          <td>
                            <template v-if="employee.tips_enabled">
                              <span class="badge bg-success-bright text-success">Включены</span>
                            </template>
                            <template v-else>
                              <span class="badge bg-danger-bright text-danger">Выключены</span>
                            </template>
                          </td>
                          <td class="text-right">
                            <div class="btn-group">
                              <button @click="$router.push({name: 'admin.employees.show', params: {id: employee.id}})"
                                      class="btn btn-sm btn-primary">
                                <feather type="arrow-right"/>
                              </button>
                            </div>
                          </td>
                        </tr>
                      </template>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info">
                      Всего {{ employees.total }} записей
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <pagination-record
                      :records="employees"
                      :page.sync="search.page"
                      :page-length.sync="search.page_length"
                    />
                  </div>
                </div>
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