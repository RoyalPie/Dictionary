<template>
  <div id="app">
            <comp-navbar v-if="isRenderHeader"/>
            <router-view></router-view>
            <!-- <list-voca/> -->
            <!-- <insert/> -->
            <!-- <login/> -->
            <!-- <user/> -->
            <comp-loading v-if="isLoading" :isLoading="isLoading"/>
    </div>
</template>

<script>
import {mapActions, mapState} from 'vuex'
import compNavbar from './components/compNavbar.vue'
import compLoading from './components/compLoading.vue'
import listVoca from './pages/listVoca.vue'
import insert from './pages/insert.vue'
import login from './pages/login.vue'
import user from './pages/user.vue'
import vocaDetail from './pages/vocaDetail'
import update from './pages/update'
import CompLoading from './components/compLoading.vue'
export default {
  name: 'app',
  data () {
    return {
     
    }
  },
  components:{
    compNavbar,
    listVoca,
    insert,
    login,
    user,
    vocaDetail,
    update,
    CompLoading
   
  },
  computed:{
    ...mapState(
      {isLoading:state=> state.isLoading
      }
    ),

    isRenderHeader(){
     
      let Arr = ['login'];
      // let check =Arr.filter(item=> this.$route.name);
      let check =Arr.indexOf(this.$route.name);
      console.log(check);
      if(check != -1){
        return false;
      }
      return true;
    }
  },
  methods:{
  },
  created(){
    
  }
}
</script>

<style>
  body{
    background: #d6d9df;
  }
  #app{
        max-width: 1200px;
        position: relative;
        min-height: 100vh;
        background: #f0f2f5;
        margin: 0 auto;
    }
    *{
    font-family: 'Open Sans', sans-serif;
}

/* ----------------------------------- */

</style>
