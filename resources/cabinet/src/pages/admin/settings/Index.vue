<script>
import {mapState} from 'vuex'

export default {
  name: "SettingsIndex",
  data: () => ({
    showCreateForm: false,
    createForm: {
      position_id: null
    }
  }),
  computed: {
    ...mapState('admin', ['settings'])
  },
  methods: {
    loadSettings() {
      this.$store.dispatch('admin/settings')
    },
    handleSubmitSettings() {
      this.$store.dispatch('admin/setSettings', this.settings.info)
    }
  },
  mounted() {
    this.loadSettings()
  }
}
</script>
<template>
  <div>
    <div class="page-header d-md-flex justify-content-between align-items-center">
      <div>
        <h3 class="mb-0">Настройки</h3>
      </div>
    </div>
    <form @submit.prevent="handleSubmitSettings">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mt-1">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" v-model="settings.info.name">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-1">
            <label for="mobile_number">Адрес</label>
            <input type="text" class="form-control" id="address" v-model="settings.info.address">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group mt-1">
            <label for="email">Электронная почта администратора</label>
            <input type="text" class="form-control" id="email" v-model="settings.info.email">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group mt-1">
            <label for="mobile_number">Номер телефона администратора</label>
            <input type="text" class="form-control" id="mobile_number"
                   placeholder="Укажите номер телефона в формате 8..." v-model="settings.info.mobile_number">
            <small>Все лишние символы будут удалены автоматически</small>
          </div>
        </div>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="tips" v-model="settings.info.enabled">
        <label class="form-check-label" for="tips">Включить приём чаевых</label>
      </div>
      <button type="submit" class="d-block ml-auto btn btn-primary">Сохранить</button>
    </form>
    <hr class="my-5">
    <div>
      <div class="d-flex justify-content-between">
        <h5>Должности</h5>
        <div class="btn-group">
          <div class="btn btn btn-primary">
            <feather type="plus"/>
          </div>
        </div>
      </div>
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Название</th>
          <th>Количество сотрудников</th>
          <th>Действие</th>
        </tr>
        </thead>
        <tbody>
        <template v-if="settings.info.positions.length > 0">
          <tr v-for="position in settings.info.positions">
            <td>
              {{ position.id }}
            </td>
            <td>
              {{ position.name }}
            </td>
            <td>
              {{ position.employees_count }}
            </td>
          </tr>
        </template>
        <template>
          <tr class="text-center">
            <td colspan="4">
              Должности отсутствуют
            </td>
          </tr>
        </template>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>

</style>