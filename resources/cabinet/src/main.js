import Vue from 'vue'
import App from './App'
import './utils/plugins'

import store from './store'
import router from './router'
import './utils/helpers'
import './assets/styles/app.scss'
import 'bootstrap/js/dist/dropdown'
import 'bootstrap/js/dist/button'
import 'bootstrap/js/dist/collapse'
import 'bootstrap/js/dist/modal'
import 'bootstrap/js/dist/tab'
import './utils/helpers/index'

window.$ = require('jquery')
Vue.config.productionTip = false

// Хотели подключить систему уведомлений для чаевых в реальном времени
/*window.io = require("socket.io-client");
if (typeof io !== "undefined") {
  window.Echo = new Echo({
    broadcaster: "socket.io",
    host:
      process.env.NODE_ENV === "development"
        ? `ws://laravel.test:6001`
        : `${window.location.hostname}:6001`,
    keyPrefix: "laravel_database_",
    withCredentials: true,
  });
}*/

const app = new Vue({
  router,
  store,
  render: (h) => h(App)
})

app.$mount('#app')
