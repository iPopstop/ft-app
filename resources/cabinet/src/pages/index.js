//import layoutIndex from './layouts/Authenticated'
import layoutGuest from './layouts/Guest'
import layoutError from './layouts/Error'
import layoutEmpty from './layouts/Empty'
import layoutAdmin from './layouts/Admin'

import login from './login/Index'

import notFound from './errors/NotFound'
import main from './admin/main/Index'
import employeesIndex from './admin/employees/Index'
import employeesShow from './admin/employees/Show'
import couponsIndex from './admin/coupons/Index'
import commentsIndex from './admin/comments/Index'
import commentsShow from './admin/comments/Show'
import settingsIndex from './admin/settings/Index'
import atWork from './errors/AtWork'

import configurationIndex from './admin/configuration/Index'
import configurationMenu from './admin/configuration/Menu'
import configurationRoles from './admin/configuration/Roles'
import configurationPermissions from './admin/configuration/Permissions'
import configurationPermissionsAssign from './admin/configuration/PermissionsAssign'
import questions from './admin/questions/Index'

export default {
  //layoutIndex,
  layoutGuest,
  layoutAdmin,
  layoutError,
  layoutEmpty,
  main,
  login,
  notFound,
  atWork,
  employeesIndex,
  employeesShow,
  couponsIndex,
  commentsIndex,
  commentsShow,
  settingsIndex,
  configurationIndex,
  configurationMenu,
  configurationRoles,
  configurationPermissions,
  configurationPermissionsAssign,
  questions
}
