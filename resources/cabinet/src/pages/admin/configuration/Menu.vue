<script>
import {mapState} from 'vuex'
import _filter from 'lodash/filter'

export default {
  name: "ConfigurationMenu",
  data() {
    return {
      configForm: {
        show_user_menu: 0,
        show_todo_menu: 0,
        show_message_menu: 0,
        show_configuration_menu: 0,
        show_backup_menu: 0,
        show_email_template_menu: 0,
        show_email_log_menu: 0,
        show_activity_log_menu: 0,
        config_type: 'menu'
      }
    }
  },
  computed: {
    ...mapState('config', ['config']),
  },
  methods: {
    submit(){
      this.configForm.config_type = 'menu';
      this.$store.dispatch('config/handle', this.configForm)
      /*this.configForm.post('/api/configuration')
        .then(response => {
          this.$store.dispatch('setConfig',this.configForm);
          toastr.success(response.message);
        }).catch(error => {
        helper.showErrorMsg(error);
      });*/
    },
    loadVars() {
      let vars = _filter(Object.keys(this.config), i => /^show_(.*?)_menu$/gim.test(i))
      for(let i = 0; i < vars.length; i++) {
        let name = vars[i]
        this.configForm[name] = helper.getConfig(vars[i])
      }
    }
  },
  watch: {
    config: {
      handler() {
          this.loadVars()
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
<template>
  <div>
    <div class="page-titles">
      <h3 class="text-themecolor">
        Настройка меню
        <router-link tag="button" class="btn btn-info btn-sm pull-right" :to="{name: 'admin.configuration.index'}">
          Вернуться
        </router-link>
      </h3>
    </div>
    <div class="container-fluid p-0" v-if="$hasRole('admin')">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr v-for="(row, index) in Object.keys(configForm)">
                        <td v-if="row !== 'config_type'">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" :id="`customCheck${index}`" v-model="configForm[row]">
                            <label class="custom-control-label" :for="`customCheck${index}`">{{ row }}</label>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <button type="submit" class="btn btn-info waves-effect waves-light pull-right m-t-10">Сохранить</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>