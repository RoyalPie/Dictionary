<template>
    <div id="info-voca">
        <h1 class="text-center pt-1">Chi tiết từ vựng</h1>
        <div class="Voca-items" v-if="dataVoca">
            <p class="p_capitalize">{{dataVoca.tentuvung}} <i>/{{dataVoca.phienam}}/ </i> <i v-if="dataVoca.phatam" @click="handleClick" class="fas fa-volume-up"></i></p>

            <audio controls id="audio-player" style="display:none" v-if="dataVoca.phatam">           
                <source ref="fileAudio" :src="`http://${dataVoca.phatam}`" type="audio/mpeg">
            </audio>
            <p class="p_capitalize"><i>Loại từ: </i> {{dataVoca.tenloaitu}} ({{dataVoca.kyhieu}})</p>
            <p class="p_capitalize"><i>Nghĩa: </i> {{dataVoca.nghia}}</p>
            <p v-if="dataVoca.vidu"><i>Ví dụ: </i>{{dataVoca.vidu}}</p>
            <p v-else><i>Ví dụ: --chưa thêm vào--</i></p>
        </div>
        <div  class="btn-items">
            <router-link :to="{name:'update', params:{parmas:{id_tu: id_tu}}}">
                <button type="button" class="btn btn-primary">Cập nhật</button>
            </router-link>
            
            <button @click="handleDelete()" type="button" class="btn btn-danger">Xóa</button>
        </div>
    </div>	
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name: 'voca-detail',
    data(){
        return{
            id_tu: this.$route.params.id_tu,
            dataVoca: null
        }
    },
    methods:{
        ...mapActions(['getTuById','deleteVoCa']),
        setTuById(){
            this.getTuById(this.id_tu).then(res=>{
                if(res.ok){
                    this.dataVoca = res.data
                }
                else{
                    this.$router.push("/")
                }
            })
        },
        handleClick(){
            var audio = document.getElementById("audio-player");
            if (audio.paused) {
            audio.play();
            } else {
            audio.pause();
            }
        },
        handleDelete(){
            let y = confirm("Bạn chắc chắn có muốn xóa từ này?");
            if(y){
                this.deleteVoCa(this.id_tu).then(res=>{
                    if(res.ok){
                        alert(res.message);
                        this.$router.push("/");
                    }
                else{
                    alert(res.message);
                }
                })
            }
            
        }
    },
    
    computed:{

    },
    
    created(){
        this.getTuById(this.id_tu);
        this.setTuById()
    },
    watch:{
        $route(to,from){
            this.id_tu = to.params.id_tu;
            this.setTuById()
        }
    }


}
</script>

<style>
    #info-voca{
            position:absolute;
            left: 50%;
            top:  50%;
            transform: translate(-50%, -50%);
            border: 2px solid black;
            min-width: 700px;
            min-height: 60vh;
            margin: 0 auto;
            height: auto;
    }
    .Voca-items{
        padding: 20px 0 0 20px;
        min-height: 40vh;
    }
    .Voca-items p{
        font-size: 30px;
    }
    .btn-items{
        padding: 20px 0 10px 20px;
        
    }
    .btn-items button{
        padding: 10px 15px;
        font-size: 20px;
    }
    .p_capitalize{
        text-transform: capitalize
    }
</style>