<script>
import {mapState} from 'vuex'
import FormText from "@/components/Spectrum/Form/FormText"
import {Form} from '@/utils/helpers/_form'

export default {
  components: {FormText},
  data: () => ({
    showCreatePanel: false,
    createForm: new Form({
      name: ''
    })
  }),
  computed: {
    ...mapState('admin', ['roles', 'searchRoles'])
  },
  methods: {
    getRoles(){
      this.$store.dispatch('admin/getRoles', this.searchRoles)
    },
    createRole() {
      this.createForm.submit('admin/createRole')
    },
    confirmDelete(role){
      return dialog => this.deleteRole(role);
    },
    deleteRole(role){
      this.$store.dispatch('admin/destroyRole', role.id)
    },
  },
  watch: {
    searchRoles: {
      handler() {
        this.getRoles()
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
<template>
  <div>
    <div class="page-titles mb-3 d-flex align-items-center">
      <h3 class="mb-0">
        Роли
      </h3>
      <div class="btn-group ml-3">
        <router-link tag="button" class="btn btn-info btn-sm pull-right" :to="{name: 'admin.configuration.index'}">
          Вернуться
        </router-link>
        <button class="btn btn-primary btn-sm" @click="showCreatePanel = !showCreatePanel">
          Добавить
        </button>
      </div>
    </div>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12">
            <div class="card border-bottom" v-if="showCreatePanel">
              <div class="card-body p-4">
                <h4 class="card-title">Добавить новую роль</h4>
                <form @submit.prevent="createRole">
                  <form-text label="Название" prop-name="name" :errorForm="createForm" :value.sync="createForm.name" />
                  <button type="submit" class="btn btn-primary">Создать</button>
                  <button @click.prevent="showCreatePanel = false" class="btn btn-primary ml-3">Отмена</button>
                </form>
                </div>
              </div>
          <div class="card">
            <div class="card-body">
              <div class="table-responsive" v-if="roles.total">
                <table class="table">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th class="table-option">Опции</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="role in roles.data">
                    <td>{{ role.id }}</td>
                    <td v-text="role.name" />
                    <td>{{role.created_at | defDate }}</td>
                    <td class="table-option">
                      <div class="btn-group">
                        <button class="btn btn-danger btn-sm" :key="role.id" @click="deleteRole(role)"><feather type="X" /></button>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <pagination-record :page-length.sync="searchRoles.page_length" :records="roles" @updateRecords="getRoles" @change.native="getRoles"></pagination-record>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>