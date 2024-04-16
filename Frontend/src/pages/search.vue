<template>
    <div>
        <div class="pt-2 pl-2 ">
            <p>- Từ khóa tìm kiếm: <b>{{query}}</b></p>
            <p>- Đã tìm thấy (<b>{{getInfor_Voca.listTuVung.length}}</b>) kết quả</p>
        </div>
        <comp-list :getInfor_Voca="getInfor_Voca"/>
    </div>
</template>

<script>
import {mapActions,mapGetters} from 'vuex'
import compList from '../components/compList.vue'
export default {
    components: { compList },
    name: 'search',
    data(){
       return{
            query: this.$route.query.query
       }
    },
    props:{
        compList
    },
    computed:{
        ...mapGetters(['getInfor_Voca']),
    },
    watch: {
        '$route'(to, from) {
            this.query = to.query.query;
            this.checkQuery();
            this.fetchDataSearch()
            
        }
    },
    created(){
        this.query= this.$route.query.query
        this.checkQuery();
        this.fetchDataSearch()
    },
    methods:{
        ...mapActions(['searchTu']),
        checkQuery(){
            if(!this.query){
                this.$router.push("/");
            }
        },
        fetchDataSearch(){
            if(this.query){
                this.searchTu(this.query).then(res=>{
            })
            }
        }
    }
}
</script>

<style>

</style>