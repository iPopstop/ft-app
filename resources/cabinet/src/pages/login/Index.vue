<script>
import {mapState} from 'vuex'

import {Form} from '@/utils/helpers/_form'
import FormText from "@/components/Spectrum/Form/FormText"
import VueRecaptcha from 'vue-recaptcha';
import ShowError from "@/components/Spectrum/Form/ShowError"
import _has from 'lodash/has'
import _includes from 'lodash/includes'

export default {
  name: 'Login',
  metaInfo: {
    title: 'Login',
  },
  components: {FormText, VueRecaptcha, ShowError},
  data: () => ({
    showSecret: false,
    loginForm: new Form({
      mobile_number: '',
      password: '',
    }),
    freeze: false
  }),
  computed: {
    ...mapState('config', ['auth']),
  },
  mounted() {
    this.$store.dispatch('config/cookies')
    document.body.classList.remove('hidden-navigation')
    document.body.classList.add('form-membership')
  },
  beforeDestroy() {
    document.body.classList.add('hidden-navigation')
    document.body.classList.remove('form-membership')
  },
  methods: {
    handleLogin() {
      if (!this.freeze) {
        this.freeze = true
        this.loginForm.submit('config/login').then(({data}) => {
          if (data.authenticated) {
            return this.$router.push({name: 'admin.main'})
          }
        }).catch((err) => {
          setTimeout(() => {
            this.freeze = false
          }, 2150)
        })
      }
    },
  }
}
</script>
<template>
  <div>
    <h5>Вход для сотрудников</h5>
    <form @submit.prevent="handleLogin" @keydown="loginForm.errors.clear($event.target.name)">
      <form-text
        class="text-left"
        label="Номер телефона"
        :value.sync="loginForm.mobile_number"
        :error-form="loginForm"
        prop-name="mobile_number"
      />
      <form-text
        type="password"
        class="text-left"
        label="Пароль"
        :value.sync="loginForm.password"
        :error-form="loginForm"
        prop-name="password"
      />
      <template v-if="showSecret">
        <form-text
          type="text"
          class="text-left"
          label="Код подтверждения из приложения"
          template="positiveInteger"
          :value.sync="loginForm.secret"
          :error-form="loginForm"
          prop-name="secret"
        />
      </template>
      <div class="my-2">
        <show-error :form="loginForm" prop="gRecaptchaResponse"/>
      </div>
      <button type="submit" class="btn btn-primary btn-block" :disabled="freeze">Войти</button>
    </form>
  </div>
</template>
<style src='@/assets/styles/pages/login/index.scss' lang='scss'></style>
