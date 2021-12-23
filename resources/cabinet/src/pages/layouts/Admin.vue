<script>
import AppHeader from "@/components/Header"
import AppFooter from "@/components/Footer"
import {mapState} from "vuex"
import _has from 'lodash/has'

export default {
  name: "layoutIndex",
  components: {AppFooter, AppHeader},
  data: () => ({
    navMenu: false,
    navLinks: [
      {
        label: 'Статистика',
        to: 'admin.main',
      },
      {
        label: 'Сотрудники',
        to: 'admin.employees',
      },
      {
        label: 'Купоны',
        to: 'admin.coupons'
      },
      {
        label: 'Акции',
        to: 'admin.stocks'
      },
      {
        label: 'Отзывы',
        to: 'admin.comments.index'
      },
      {
        label: 'Настройки',
        to: 'admin.settings'
      }
    ],
  }),
  computed: {
    ...mapState('config', ['is_auth', 'user', 'auth']),
    ...mapState('admin', ['todayStats']),
  },
  methods: {
    toggleMenu() {
      this.navMenu = !this.navMenu
    },
    checkUser(link) {
      return link.notsadmin ? !helper.hasRole('sadmin') : true
    },
    checkRole(role) {
      return helper.hasRole(role)
    },
    hasMiddleware(link, middleware) {
      return _has(link, middleware)
    },
    hasPermission(link) {
      return _has(link, 'permission') ? helper.hasPermission(`access-${link.permission}`) : true
    },
    hasCounter(link) {
      return _has(link, 'counter') && _has(this.todayStats, link.counter)
    }
  },
  mounted() {
    if (!document.body.classList.contains("hidden-navigation")) {
      document.body.classList.add("hidden-navigation")
    }
  },
  watch: {
    is_auth: {
      handler() {
        if (!this.is_auth && this.$route.name !== 'login') {
          this.$router.push({name: 'login'})
        }
      },
    }
  }
}
</script>
<template>
  <div class="layout-wrapper">
    <app-header :links="navLinks" @menu="toggleMenu"/>
    <div class="content-wrapper">
      <div class="navigation" :class="{'open': navMenu}">
        <div class="navigation-header">
          <span>Навигация</span>
          <a href="#" class="d-flex align-items-center justify-content-center" aria-label="Закрыть меню"
             @click.prevent="navMenu = false">
            <feather type="X"/>
          </a>
        </div>
        <div class="navigation-menu-body">
          <ul>
            <li v-for="link in navLinks">
              <template
                v-if="hasPermission(link) && !hasMiddleware(link, 'role') && ((!hasMiddleware(link, 'notsadmin')) || (hasMiddleware(link, 'notsadmin') && checkUser(link)))">
                <router-link :to="{name: link.to}" active-class="active">
                  {{ link.label }}
                  <template v-if="hasCounter(link)"><br>({{ '+' + todayStats[link.counter] }})</template>
                </router-link>
              </template>
              <template v-else>
                <router-link :to="{name: link.to}" v-if="hasPermission(link) && checkRole(link.role)"
                             active-class="active">
                  {{ link.label }}
                  <template v-if="hasCounter(link)"><br>({{ '+' + todayStats[link.counter] }})</template>
                </router-link>
              </template>
            </li>
          </ul>
        </div>
      </div>
      <div class="content-body">
        <div class="content">
          <router-view :key="$route.path"/>
        </div>
        <app-footer/>
      </div>
    </div>
  </div>
</template>
