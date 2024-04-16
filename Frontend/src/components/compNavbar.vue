<template>
  <div class="wrapper">
     <div class="menu">
       <div class="menu-item1">
          <ul>
            <!-- <router-link tag='li' :to="{path:'/'}"  class="logo">CT239</router-link> -->
            <router-link :class="{m_active: isRouterAllList}" tag="li" :to="{ path:'/'}">Từ vựng của tôi <i class="fa-solid fa-book"></i></router-link>
            <router-link exactActiveClass="m_active" tag="li" :to="{ path: '/insert' }">Thêm từ mới <i class="fa-solid fa-circle-plus"></i></router-link>
          </ul>
       </div>
       
       <label for="toggle-menu" class="btn-toggle-menu"
          ><i class="fas fa-bars"></i
       ></label>
       <input type="checkbox" id="toggle-menu" />
       <!-- <div class="menu-child">
          <ul>
            <router-link :class="{m_active: isRouterAllList}" tag="li" :to="{ path:'/'}">Từ vựng của tôi <i class="fa-solid fa-book"></i></router-link>
            <router-link tag ='li' :to="{ path: '/insert'}">Thêm từ mới <i class="fa-solid fa-circle-plus"></i></router-link>
            <li>
                <form @submit.prevent="handleSearch()">
                    <input type="search" id="gsearch" name="gsearch" v-model="querySearch" />
                    <i v-on:click="handleSearch()" class="fa-solid fa-magnifying-glass"></i>
                </form>
            </li>
            <li class="infor_avatar" @click="handleLogout()"><i class="fas fa-sign-out-alt" style="color:red"></i></li>
          </ul>
       </div> -->
       <div class="menu-item2">
          <ul>
            <li>
                <form @submit.prevent="handleSearch()">
                    <input type="search" id="gsearch" name="gsearch" v-model="querySearch" />
                    <i v-on:click="handleSearch()" class="fa-solid fa-magnifying-glass"></i>
                </form>
            </li>
            <li class="infor_avatar" @click="handleLogout()"><i class="fas fa-sign-out-alt" style="color:red"></i></li>
          </ul>
       </div>
     </div>
  </div>
</template>

<script>
import {mapActions, mapMutations} from 'vuex'
export default {
  name: "comp-navbar",
  data() {
     return {
         querySearch:''
     };
  },
  computed: {
      isRouterAllList(){
          return this.$route.name == 'allList' ? true : false;
      }, 
  },
  methods:{
        ...mapActions(['searchTu', 'getLogout']),
        ...mapMutations(['SET_LOGOUT']),
        handleSearch(){ 
            if(this.querySearch){
                this.$router.push({path: '/search', query:{query:this.querySearch}})
            }
            else alert("Vui long nhap tu can tim")
        },
        handleLogout(){
            this.getLogout().then(res=>{
                if(res.ok){
                    this.$router.push({path:'/login'})
                }
            });
            
        }
  },
  watch:{
      '$route'(to, from){
          this.isRouterAllList;
      }
  },
}
</script>

<style>
    .wrapper{
        max-width: 1200px;
        padding: 15px 5px;
        background: #fefd90;
        
    }
    .wrapper .menu ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .menu{
        display: flex;
        justify-content: space-between;
        align-items:center
    }
    .menu-item1 ul{
        display: flex;
        align-items:center
    }
    .menu-item1 ul .logo{
        font-size: 30px;
        font-weight: bold;
    }
    .menu-item2 ul{
        display: flex;
        align-items:center
    }
    .menu-item1 ul li,.menu-item2 ul li{
        /* margin-left:10px */
        padding: 8px 15px;
        font-weight:bold;
        transition: .2s;
    }
    .m_active{
        background-color: #1d63e8;
        border-radius: 10px;
        color: white;
    }

    ul li:hover{
        background-color: #1d63e8;
        border-radius: 12px;
        color: white;
        
    }
    #toggle-menu{
        display: none;
    }
    .btn-toggle-menu{
        font-size: 25px;
        cursor: pointer;
        display: none;
    }
    .toggle-logo{
        font-size: 30px;
        cursor: pointer;
        display: none;
        font-weight: bold;
    }
    .menu-child{
        display: none;
        margin-top: 5px;
        
    }
    .menu-child li{
        
        padding: 8px 15px;
        font-weight:bold;
        transition: .3s;

    }
    .menu-child li:hover {
        background-color: #1d63e8;
        border-radius: 10px;
        color: white;

    }
    .infor_avatar{
        font-size:30px
    }
    @media screen and (max-width:768px){
        .menu{
            flex-wrap: wrap;
        }
        .menu-item1, .menu-item2{
            display: none;
        }
        .toggle-logo{
            display: unset;
        }
        .btn-toggle-menu{
            display: unset;
        }
        #toggle-menu:checked + .menu-child{
        display: block;
        width: 100%;
        }
    }
</style>