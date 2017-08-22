// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import * as DEV_CONST from '../config/dev.const.js'
import './assets/css/global.css'
import 'element-ui/lib/theme-default/index.css'
import '../theme/index.css'
import './assets/cases/flexible.debug.js'
// import './assets/cases/flexible.min.js'

Vue.use(ElementUI)

Vue.config.productionTip = false

window.FRONT_DOMAIN = DEV_CONST.FRONT_DOMAIN
window.BACK_DOMAIN = DEV_CONST.BACK_DOMAIN

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
