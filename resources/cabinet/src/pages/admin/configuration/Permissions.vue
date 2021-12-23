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
    ...mapState('admin', ['permissions', 'searchPermissions'])
  },
  methods: {
    getPermissions(){
      this.$store.dispatch('admin/getPermissions', this.searchPermissions)
    },
    createPermission() {
      this.createForm.submit('admin/createPermission')
    },
  },
  watch: {
    searchPermissions: {
      handler() {
        this.getPermissions()
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
        Права
      </h3>
      <router-link tag="button" class="btn btn-info btn-sm ml-3" :to="{name: 'admin.configuration.index'}">
        Вернуться
      </router-link>
      <div class="btn-group ml-3">
        <button class="btn btn-info btn-sm" @click="showCreatePanel = !showCreatePanel">Добавить</button>
        <router-link tag="button" class="btn btn-info btn-sm" :to="{name: 'admin.configuration.permissions.assign'}">Настройка</router-link>
      </div>
    </div>
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-12">
          <transition name="fade">
            <div class="card border-bottom" v-if="showCreatePanel">
              <div class="card-body p-4">
                <h4 class="card-title">Добавить право</h4>
                <form @submit.prevent="createPermission">
                  <form-text label="Название" prop-name="name" :errorForm="createForm" :value.sync="createForm.name" />
                  <button type="submit" class="btn btn-primary">Создать</button>
                  <button @click.prevent="showCreatePanel = false" class="btn btn-primary ml-3">Отмена</button>
                </form>
              </div>
            </div>
          </transition>
          <div class="card">
            <div class="card-body">
              <div class="table-responsive" v-if="permissions.total">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Название</th>
                    <th class="table-option">Опции</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="permission in permissions.data">
                    <td v-text="permission.name"></td>
                    <td class="table-option">
                      <div class="btn-group">
                        <button class="btn btn-danger btn-sm" :key="permission.id">
                          <feather type="trash" />
                        </button>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <pagination-record :page-length.sync="searchPermissions.page_length" :records="permissions" @updateRecords="getPermissions" @change.native="getPermissions" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>