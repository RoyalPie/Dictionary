<template>
    <div>
        <comp-menu-select/>
        <comp-list :getInfor_Voca="getInfor_Voca"/>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import compMenuSelect from '../components/compMenuSelect.vue'
import compList from '../components/compList.vue'
export default {
    name: 'list-voca',
    data () {
        return {
        
        }
  },
    components:{
        compMenuSelect,
        compList
    },
    computed:{
        ...mapGetters(['getInfor_Voca']),

    },
    methods:{
          
    },
    

}
</script>

<style>

</style>