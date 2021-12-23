<script>
import {mapState} from "vuex"
import _has from 'lodash/has'

export default {
  name: "AppHeader",
  data: () => ({
    mobile: false,
    headerOpened: false
  }),
  props: {
    links: {
      type: Array,
      default: () => ([])
    }
  },
  computed: {
    ...mapState('admin', ['todayStats']),
  },
  methods: {
    hasRole(name) {
      return helper.hasRole(name)
    },
    handleLogout() {
      this.$store.dispatch("config/logout").then(() => {
        this.$router.push({name: 'admin.main'})
      }).catch(() => {
        this.$router.go()
      })
    },
    toggleFullScreen() {
      if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen();
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        }
      }
    },
    toggleMenuOpen() {
      this.$emit('menu')
    },
    checkRole(role) {
      return helper.hasRole(role)
    },
    checkUser(link) {
      return link.notsadmin ? !helper.hasRole('sadmin') : true
    },
    hasMiddleware(link, middleware) {
      return _has(link, middleware)
    },
    hasCounter(link) {
      return _has(link, 'counter') && _has(this.todayStats, link.counter)
    }
  },
}
</script>
<template>
  <div class="header d-print-none">
    <div class="header-container">
      <div class="header-left">
        <div class="navigation-toggler d-block d-md-none">
          <a href="#" @click.prevent="toggleMenuOpen" aria-label="Открыть левое меню" data-action="navigation-toggler">
            <feather type="menu"/>
          </a>
        </div>
        <div class="header-logo">
          <a href="/">
            <img class="logo" src="@/assets/images/rgr.png" alt="Логотип Ригер">
          </a>
        </div>
      </div>
      <div class="header-body" :class="{'open':headerOpened}">
        <div class="header-body-left">
          <ul class="navbar-nav">
            <li class="nav-item d-none d-md-block mx-0 mx-md-1 text-center" v-for="link in links">
              <router-link class="nav-link" :to="{name: link.to}">
                {{ link.label }}
              </router-link>
            </li>
          </ul>
        </div>
        <div class="header-body-right">
          <ul class="navbar-nav">
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link" title="Полный экран" data-toggle="fullscreen"
                 @click.prevent="toggleFullScreen">
                <feather type="maximize"/>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" :title="$auth('fi')" data-toggle="dropdown">
                <figure class="avatar avatar-sm">
                  <img src="https://eu.ui-avatars.com/api/?name=Vjacheslav+Kutov" class="rounded-circle" alt="avatar">
                </figure>
                <span class="ml-2 d-sm-inline d-none">{{ $auth('fi') }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                <div class="text-center py-4">
                  <figure class="avatar avatar-lg mb-3 border-0">
                    <img src="https://eu.ui-avatars.com/api/?name=Vjacheslav+Kutov" class="rounded-circle" alt="image">
                  </figure>
                  <h5 class="text-center">{{ $auth('fio') }}</h5>
                  <div class="small text-center text-muted">
                    {{ _map($auth('roles'), 'name').join('; ') }}
                  </div>
                  <router-link v-if="$auth('id')" tag="button" class="btn btn-outline-light btn-rounded mt-3"
                               :to="{name: 'admin.employees.show', params: {id: $auth('id')}}">Профиль
                  </router-link>
                </div>
                <div class="list-group">
                  <a href="#" @click.prevent="handleLogout" class="list-group-item text-danger">Выход</a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item header-toggler">
          <a href="#" @click.prevent="headerOpened = !headerOpened" aria-label="Открыть меню аккаунта" class="nav-link">
            <feather type="arrow-down"/>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>
