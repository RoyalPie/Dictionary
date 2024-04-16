<template>	
    <div class="form_insert" v-if="renderCurrVoca">
        <form action="" @submit.prevent="handleSubmit()">
            <div class="mt-3">
                <label for="vocabulary">Từ vựng mới</label>
                <input 
                    v-on:input="tentuvung = $event.target.value"
                    v-bind:value='renderCurrVoca.tentuvung' type="text" class="form-control" id="vocabulary" placeholder="Từ vựng mới..."
                >
                </div>
                <div class="mt-3">
                <label for="phienam">Phiên âm</label>
                <input v-on:input="phienam = $event.target.value" v-bind:value="renderCurrVoca.phienam" type="text" class="form-control" id="phiemam" placeholder="Phiên âm...">
                </div>
                <div class="mt-3">
                <label>Chọn File âm thanh: </label>
                <label for="sound" class="btn-file">Chọn file</label><input @change="handleFile($event)" style="display:none" type="File" class="form-control" id="sound" placeholder="Từ vựng mới...">
                </div>
                <p>File âm thanh hiện tại:
                    <i v-if="!renderCurrVoca.phatam">chưa có</i>
                </p>
                <audio controls id="audio-player" v-if="renderCurrVoca.phatam && !base64URL">           
                        <source ref="fileAudio" :src="`http://${renderCurrVoca.phatam}`" type="audio/mpeg">
                </audio>
                <div  id="frm-audio" style="width:50px">
                    <div id="song"></div>
                    <i class="far fa-window-close size-icon" @click="handleDeleteAudioPreview" v-show="base64URL"></i>
                </div>
                
                <br/>
            <label for="form_select">Loại từ</label>
            <select id="form_select"  class="form-control" style="width: 20%;" @change="handleChooseLoaiTu($event)" :value="renderCurrVoca.id_loaitu">
                <option value="null">--Chọn loại từ--</option>
                <option v-for="(tuloai,index) in getListLoai" :key="index" :value="tuloai.id_loai">{{tuloai.tenloaitu}}</option>
            </select>
                <br>
                <label for="mean1">Nghĩa của từ</label>
                <input v-on:input="nghia = $event.target.value" v-bind:value="renderCurrVoca.nghia" type="text" class="form-control" id="mean1">
                <br>
                <label for="example1">Ví dụ (nếu có)</label>
                <textarea v-on:input="vidu = $event.target.value" v-bind:value="renderCurrVoca.vidu" class="form-control" id="example1" rows="3"></textarea>						  
                <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        </form>
    </div>				
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";
export default {
    name: 'update',
    data(){
        return{
            id_loaitu: "",
            tentuvung: '',
            phienam: '',
            file: null,
            base64URL: '',
            id_loaitu: '',
            nghia:'',
            vidu:'',
            id_tu: this.$route.params.id_tu,
            isAudio: true
        }
    },
    computed:{
         ...mapGetters(['getListLoai']),
         ...mapState({
             currVoca: (state)=> state.voca.currVoca
         }),
         renderCurrVoca(){
             if(this.currVoca){
                 return this.currVoca
             }
         }
    },
    methods:{
        ...mapActions(['getLoaiTu', 'getTuById', 'updateTuVung']),
        handleChooseLoaiTu(e){
            this.id_loaitu = e.target.value;
            console.log(this.id_loaitu)
        },

        async getAll(){
            var r1 = this.getLoaiTu();
            var r2 = this.getTuById(this.id_tu);
            await Promise.all([r1, r2]);
        },
        handleFile(e){
            this.file = e.target.files[0];
        },
        handleSubmit(){
           
            this.tentuvung = this.tentuvung ? this.tentuvung : this.renderCurrVoca.tentuvung;
            this.phienam   = this.phienam   ? this.phienam   : this.renderCurrVoca.phienam;
            this.id_loaitu = this.id_loaitu ? this.id_loaitu : this.renderCurrVoca.id_loaitu;
            this.nghia     = this.nghia     ? this.nghia     : this.renderCurrVoca.nghia;
            this.vidu      = this.vidu      ? this.vidu      : this.renderCurrVoca.vidu;
            this.id_tu     = this.id_tu;
            console.log(this.tentuvung, this.phienam, this.file, this.id_loaitu,this.nghia, this.vidu);
            if(this.tentuvung && this.id_loaitu && this.nghia){
                let data={  id_tu: this.id_tu,tentuvung: this.tentuvung, 
                            phienam: this.phienam, file: this.file, 
                            id_loaitu: this.id_loaitu, nghia: this.nghia, 
                            vidu: this.vidu
                        }
                this.updateTuVung(data).then(res =>{
                    if(res.ok ==true){
                        this.tentuvung ='', 
                        this.phienam = '', 
                        this.file = null, 
                        this.id_loaitu ='',
                        this.nghia ='', 
                        this.vidu =''
                    }
                    alert(res.message);
                    this.$router.push(`/vocaDetail/${this.id_tu}`);
                })
            }
            else{
                alert("Bạn chưa nhập đầy đủ");
            }
        },
        handleFile(e){
            this.file = e.target.files[0];
            if(e.target.files && e.target.files.length){ //e.target.files.length !== 0
                const fileAudio = e.target.files[0]
                let reader = new FileReader();

                reader.addEventListener("load", ()=>{
                    let preview = reader.result;
                    console.log("previewSRc", preview)
                    this.base64URL = preview;
                    // this.file = fileAudio;
                    
                document.getElementById('song').innerHTML = `<audio id="audio-player" controls="controls" src="${this.base64URL}" type="audio/mpeg">`}, true);
                if(fileAudio){
                    reader.readAsDataURL(fileAudio);
                }
            }
        },
        handleDeleteAudioPreview(){
            this.base64URL='';
            this.file = null;
            document.getElementById('song').innerHTML = ``;
        }
    },
    created(){
        this.getAll();     
    },

}
</script>

<style scoped>
        .form_insert{
            width: 800px;
            margin: 25px auto;
            
        }
        .btn-submit{
            margin-top: 2vh;
        }
        .btn-file{
            background-color: rgb(5, 125, 129);
            padding: 5px 8px;
            color: #fff; 
            border-radius: 5px;
        }
        .btn-file:hover{
            background-color: rgb(16, 157, 212);
            padding: 5px 8px;
            color: #fff; 
            border-radius: 5px;
        }
        #frm-audio{
            display: flex;
            align-items: center;
        }
        .size-icon{
            font-size: 1.6rem;
            color: red;
            vertical-align: baseline;
            padding-bottom: 5px;
        }
</style>