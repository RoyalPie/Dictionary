import Vue from 'vue'
import Vuex from 'vuex'
import state from './state'
import getters from './getters'
import mutations from './mutations'
import actions from './actions'
import voca from './voca'
import user from './user'

Vue.use(Vuex)
const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions,
    modules:{
            voca,
            user
    }
  })

  export default store;