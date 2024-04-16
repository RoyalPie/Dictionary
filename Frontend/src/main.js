import Vue from 'vue'
import plugin from './plugins' 
import App from './App.vue'
import store from './store'
import router from './router.js'
new Vue({
  el: '#app',
  router,
  store,
  
  render: h => h(App)
})
