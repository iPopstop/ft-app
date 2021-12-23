<script>
import {mapState} from 'vuex'
import _filter from 'lodash/filter'

export default {
  name: "ConfigurationIndex",
  computed: {
    ...mapState('config', ['config']),
  },
  /*mounted() {
    if (!helper.hasRole('admin')) {
      helper.notAccessibleMsg();
      this.$router.push({name: 'admin.applications.main'});
    }
  }*/
}
</script>
<template>
  <div>
    <div class="page-titles">
      <h3 class="text-themecolor">
        Конфигурация
      </h3>
    </div>
    <template v-if="$hasRole('admin')">
      <div class="list-group">
        <router-link :to="{name: 'admin.configuration.users'}" class="list-group-item list-group-item-action">
          Управление пользователями
        </router-link>
        <router-link :to="{name: 'admin.configuration.roles'}" class="list-group-item list-group-item-action">
          Управление ролями
        </router-link>
        <router-link :to="{name: 'admin.configuration.permissions'}" class="list-group-item list-group-item-action">
          Управление правами
        </router-link>
      </div>
    </template>
  </div>
</template>

<style scoped>

</style>