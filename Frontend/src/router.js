import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import insert from './pages/insert.vue'
import update from './pages/update.vue'
import listVoca from './pages/listVoca.vue'
import login from './pages/login.vue'
import user from './pages/user.vue'
import vocaDetail from './pages/vocaDetail.vue'
import search from './pages/search.vue'
import {ifLogin, ifNotLogin} from './plugins/authenticate'
const routes = [
    { name: 'allList',
      path: '/',
      component: listVoca,
      beforeEnter: ifLogin
    //   children: [{
    //     path: '',
    //     component: listVoca,
    //     name: 'allList'
    //   }]
    },
    { name: 'search', path: '/search', component: search, beforeEnter: ifLogin },
    { name: 'login', path: '/login', component: login, beforeEnter: ifNotLogin  },
    { name: 'insert', path: '/insert', component: insert, beforeEnter: ifLogin },
    { name: 'update', path: '/update/:id_tu', component: update, beforeEnter: ifLogin },
    { name: 'user', path: '/user/:userid', component: user, beforeEnter: ifLogin },
    { name: 'userUpdate', path: '/:userid/update', component: user, beforeEnter: ifLogin },
    { name: 'vocaDetail', path: '/vocaDetail/:id_tu', component: vocaDetail, beforeEnter: ifLogin }
]
    const router = new VueRouter({
    mode:'history',
    routes // short for `routes: routes`
    })
export default router;