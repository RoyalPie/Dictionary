<template>
    <div class="list-card">
        <div class="row" v-if="getInfor_Voca">
            <div class="col-md-3 col-6 mt-3" v-for="(item, index) in getInfor_Voca.listTuVung" :key="index">
                <div class="card" style="width: 100%;height:280px">
                    <div class="card-body">
                        <router-link tag='h5' v-if="query" class="card-title" :to="{name:'vocaDetail', params:{id_tu: item.id_tu}}" 
                                    v-html="formatPostContent(item.tentuvung)"> 
                        </router-link>
                        <router-link tag='h5' class="card-title" v-if="!query" :to="{name:'vocaDetail', params:{id_tu: item.id_tu}}"> 
                           {{index+1}}. {{item.tentuvung}}
                        </router-link> 
                        <hr>
                        <small class="card-text">Loại từ</small>
                        <p class="card-text">{{getInfor_Voca.listLoaiTu[item.id_loaitu].tenloaitu}}</p>
                        <hr>
                        <small class="card-text" style="height:40px">Nghĩa của từ</small>
                        <p class="card-text">{{item.nghia}}</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script>
import {replaceAll} from '../helpers/index'
import {mapActions} from 'vuex'
export default {
    name: "comp-list",
    data() {
        return {
            query: this.$route.query.query
        };
    },
    props:{
        getInfor_Voca: {}
    },
    computed: {
        
    },
    methods: {
        ...mapActions(['getListTu','getLoaiTu']),
        formatPostContent(a){
            if(this.query){
               return replaceAll(a, this.query, `<mark>${this.query}</mark>`);
            }
        }
    },
    
    watch: {
        '$route'(to, from) {
            this.query = to.query.query;    
        }
    },
    created(){
        this.query= this.$route.query.query
    },

}
</script>

<style>
    .list-card h5{
        font-weight: bold;
        text-transform: capitalize
    }
    .list-card h5:hover{
        cursor: pointer;
        font-size: 127%;
        color: #1d63e8;
        animation: 0.5s ease all;
    }
    .card:hover{
        box-shadow: 1px 1px 1px rgb(128, 128, 128);
    }
    mark{
        background-color: red;
        padding: 1px 2px 1px 2px;
    }
</style>