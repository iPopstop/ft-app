<script>
import AppHeader from "@/components/Header"
import AppFooter from "@/components/Footer"
import {mapState} from "vuex"

export default {
  name: "layoutIndex",
  components: { AppFooter, AppHeader },
  data: () => ({
    navMenu: false,
    navLinks: [
      {
        label: 'Главная',
        to: 'main',
      },
      {
        label: 'Вступить в партию',
        to: 'join.default',
        check: 'join_default'
      },
      {
        label: 'Заявка в МСР',
        to: 'join.msr',
        check: 'join_msr'
      },
      {
        label: 'Календарь',
        to: 'calendar',
        check: 'calendar'
      },
      {
        label: 'Контакты',
        to: 'contacts',
        check: 'contacts'
      },
      {
        label: 'Заявки',
        to: 'applications',
        role: 'admin'
      },
      {
        label: 'Конфигурация',
        to: 'admin.configuration.index',
        role: 'admin'
      }
    ],
  }),
  computed: {
    ...mapState('config', ['is_auth'])
  },
  methods: {
    toggleMenu() {
      this.navMenu = !this.navMenu
    }
  },
  mounted() {
    if (!document.body.classList.contains("hidden-navigation")) {
      document.body.classList.add("hidden-navigation")
    }
  },
  /*watch: {
    is_auth: {
      handler() {
        if(!this.is_auth && this.$route.name !== 'login') {
          this.$router.push({name: 'login'})
        }
      }
    }
  }*/
}
</script>
<template>
  <div class="layout-wrapper">
    <app-header :links="navLinks" @menu="toggleMenu" />
    <div class="content-wrapper">
      <div class="navigation" :class="{'open': navMenu}">
        <div class="navigation-header">
          <span>Навигация</span>
          <a href="#" class="d-flex align-items-center justify-content-center" aria-label="Закрыть меню" @click.prevent="navMenu = false">
            <feather type="X" />
          </a>
        </div>
        <div class="navigation-menu-body">
          <ul>
            <li v-for="link in navLinks">
              <template v-if="!link.role">
                <router-link :to="{name: link.to}" active-class="active">{{ link.label }}</router-link>
              </template>
              <template v-else>
                <router-link :to="{name: link.to}" v-if="$hasRole(link.role)" active-class="active">{{ link.label }}</router-link>
              </template>
            </li>
          </ul>
        </div>
      </div>
      <div class="content-body">
        <div class="content">
          <router-view :key="$route.path" />
        </div>
        <app-footer />
      </div>
    </div>
  </div>
</template>
