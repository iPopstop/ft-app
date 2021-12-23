import Vue from 'vue'
import VueRouter from 'vue-router'
import _includes from 'lodash/includes'
import _some from 'lodash/some'
import _find from 'lodash/find'
import pages from './pages'

Vue.use(VueRouter)

/*
How to add new page?
1. Run "npm run new page" or create file manually
2. Go to src/pages/index.js then insert row "import pageName from 'path'"
3. Use it as "pages.pageName" (pageName value from second step)
*/
/*
How to use middlewares?
1. Add "meta: { validate: [MIDDLEWARES] }" where MIDDLEWARES can be 'auth', 'guest', 'admin'.
Etc. ['auth', 'admin'] - check auth and check that user is admin
*/
/*

*/
const routes = [
  {
    path: '/admin',
    component: pages.layoutGuest,
    meta: {validate: ['guest']},
    children: [
      {
        path: '',
        redirect: {name: 'login'}
      },
      {
        path: 'login',
        name: 'login',
        meta: {validate: ['guest']},
        component: pages.login,
      },
    ],
  },
  {
    path: '/administration',
    component: pages.layoutAdmin,
    meta: {validate: ['auth', 'admin']},
    children: [
      {
        path: '',
        redirect: {name: 'admin.main'},
      },
      {
        path: 'main',
        component: pages.main,
        name: 'admin.main'
      },
      {
        path: 'employees',
        component: pages.employeesIndex,
        name: 'admin.employees'
      },
      {
        path: 'employees/:id',
        component: pages.employeesShow,
        name: 'admin.employees.show'
      },
      {
        path: 'coupons',
        component: pages.couponsIndex,
        name: 'admin.coupons'
      },
      {
        path: 'mail',
        component: pages.commentsIndex,
        name: 'admin.comments.index'
      },
      {
        path: 'mail/:id',
        component: pages.commentsShow,
        name: 'admin.comments.show'
      },
      {
        path: 'stocks',
        component: pages.commentsShow,
        name: 'admin.stocks'
      },
      {
        path: 'settings',
        component: pages.settingsIndex,
        name: 'admin.settings'
      },
      {
        path: 'configuration',
        component: pages.layoutEmpty,
        children: [
          {
            path: '',
            redirect: {name: 'admin.configuration.index'}
          },
          {
            path: 'index',
            name: 'admin.configuration.index',
            component: pages.configurationIndex
          },
          {
            path: 'menu',
            name: 'admin.configuration.menu',
            component: pages.configurationMenu
          },
          {
            path: 'stats',
            name: 'admin.configuration.stats',
            component: pages.configurationStats
          },
          {
            path: 'roles',
            name: 'admin.configuration.roles',
            component: pages.configurationRoles
          },
          {
            path: 'users',
            component: pages.layoutEmpty,
            children: [
              {
                path: '',
                name: 'admin.configuration.users',
                component: pages.configurationUsers
              },
              {
                path: ':id',
                name: 'admin.configuration.users.show',
                component: pages.configurationUsersShow
              }
            ]
          },
          {
            path: 'permissions',
            name: 'admin.configuration.permissions',
            component: pages.configurationPermissions
          },
          {
            path: 'permissions/assign',
            name: 'admin.configuration.permissions.assign',
            component: pages.configurationPermissionsAssign
          },
        ]
      },
    ]
  },
  {
    path: '/maintenance',
    component: pages.layoutError,
    children: [
      {
        path: '',
        name: 'maintenance',
        component: pages.atWork
      }
    ]
  },
  {
    path: '*',
    component: pages.layoutError,
    children: [
      {
        path: '*',
        component: pages.notFound
      },
    ],
  },
]

const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes,
  linkExactActiveClass: 'router-link',
  linkActiveClass: 'is-active'
})

router.beforeEach((to, from, next) => {
  helper.check()
    .then(() => {
      helper.notification()

      if (_some(to.matched, m => m.meta.validate)) {
        const m = _find(to.matched, m => m.meta.validate)

        if (_includes(m.meta.validate, 'auth')) {
          if (!helper.isAuth()) {
            toastr.error('Требуется авторизация')
            return next({name: 'login'})
          }
        }

        if (_includes(m.meta.validate, 'guest')) {
          console.log('guest')
          if (helper.isAuth()) {
            console.log('isauth')
            return next({name: 'admin.main'})
          }
        }
      }

      return next()
    })
    .catch(() => {
      store.dispatch('config/resetAuthUserDetail')
    })
  return next()
})

Vue.prototype.router = router
window.router = router
export default router
