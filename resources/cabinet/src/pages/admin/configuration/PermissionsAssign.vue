<script>
import {mapState} from 'vuex'
import FormText from "@/components/Spectrum/Form/FormText"
import {Form} from '@/utils/helpers/_form'

export default {
  components: {FormText},
  data: () => ({
    showCreatePanel: false,
    assignPermissionForm: new Form({
      info: {}
    }),
    permissions: [],
    roles: []
  }),
  mounted() {
    this.getPermissions()
  },
  methods: {
    getPermissions() {
      this.$store.dispatch('admin/getPermissionsAssign').then(response => {
        this.permissions = response.data.permissions
        this.roles = response.data.roles
        this.assignPermissionForm.info = response.data.data
      })
    },
    createPermission() {
      this.createForm.submit('admin/createPermission')
    },
    savePermission() {
      this.assignPermissionForm.submit('admin/permissionsAssign')
    }
  },
}
</script>
<template>
  <div>
    <div class="page-titles mb-3 d-flex align-items-center">
      <h3 class="text-themecolor">
        Настройка прав
      </h3>
      <div class="btn-group ml-3">
        <router-link tag="button" class="btn btn-info btn-sm" :to="{name: 'admin.configuration.index'}">
          Вернуться
        </router-link>
        <router-link tag="button" :to="{name: 'admin.configuration.permissions'}" class="btn btn-info btn-sm">
          Список прав
        </router-link>
      </div>
    </div>
    <template v-if="$hasRole('admin')">
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive m-b-20">
                  <table class="table table-hover">
                    <thead>
                    <tr>
                      <th>Право</th>
                      <th v-for="role in roles" class="text-center">{{ role.name }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="permission in permissions">
                      <td>{{ permission.name }}</td>
                      <td v-for="role in roles" class="text-center">
                        <div class="form-check">
                          <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" v-model="assignPermissionForm.info[role.id][permission.id]">
                        </div>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-info" @click="savePermission">
                    Сохранить
                  </button>
                  <router-link tag="button" :to="{name: 'admin.configuration.permissions'}" class="btn btn-info btn-sm">
                    Список прав
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </div>
</template>
<style>

</style>