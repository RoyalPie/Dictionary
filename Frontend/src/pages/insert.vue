<template>	
    <div class="form_insert">
        <form action="" @submit.prevent="handleSubmit()">
            <div class="mt-3">
                <label for="vocabulary">Từ vựng mới</label>
                <input v-model='tentuvung' type="text" class="form-control" id="vocabulary" placeholder="Từ vựng mới...">
            </div>
            <div class="mt-3">
                <label for="phienam">Phiên âm</label>
                <input v-model="phienam" type="text" class="form-control" id="phiemam" placeholder="Phiên âm...">
            </div>
            <div class="mt-3">
                <label>File âm thanh: </label>
                <label for="sound" class="btn-file">Chọn file</label><input @change="handleFile($event)" style="display:none" type="File" class="form-control" id="sound" placeholder="Từ vựng mới...">
                <a href="https://soundoftext.com/" class="ml-3" target="_blank">Bạn có thể tạo file âm thanh tại đây</a>
            </div>
            <div id="frm-audio">
                <div class="" id="song"></div>
                <i class="far fa-window-close size-icon" @click="handleDeleteAudioPreview" v-show="base64URL"></i>
            </div>
            <br>
            <label for="form_select">Loại từ</label>
            <select id="form_select"  class="form-control" style="width: 20%;" @change="handleChooseLoaiTu($event)" value="null">
                <option value="null">--Chọn loại từ--</option>
                <option v-for="(tuloai,index) in getListLoai" :key="index" :value="tuloai.id_loai">{{tuloai.tenloaitu}}</option>
            </select>
                <br>
                <label for="mean1">Nghĩa của từ</label>
                <input v-model="nghia" type="text" class="form-control" id="mean1">
                <br>
                <label for="example1">Ví dụ (nếu có)</label>
                <textarea v-model="vidu" class="form-control" id="example1" rows="3"></textarea>						  
                <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        </form>
        
    </div>				
</template>

<script>
import { mapState, mapGetters, mapActions } from "vuex";
export default {
    name: 'insert',
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
            id_tu: this.$route.params.id_tu
        }
    },
    computed:{
         ...mapGetters(['getListLoai']),
    },
    // watch: {
    //     base64URL(newValue){
    //     this.base64URL = newValue;
    //     document.getElementById('song').innerHTML = `<audio id="audio-player" controls="controls" src="${this.base64URL}" type="audio/mpeg">`;
    //     }
    // },
    methods:{
        ...mapActions(['getLoaiTu','createTuVung']),
        handleChooseLoaiTu(e){
            this.id_loaitu = e.target.value;
            console.log(this.id_loaitu)
        },
        handleFile(e){
            this.file = e.target.files[0];
            console.log(e.target.files[0].name);
            console.log(e.target.files[0].type);
            if(e.target.files && e.target.files.length){ //e.target.files.length !== 0
                const fileAudio = e.target.files[0];
                let reader = new FileReader();
                let checkFile = this.handleCheckFile(fileAudio);
                if(!checkFile){
                    alert("File không hợp lệ");
                    return;
                }
                reader.addEventListener("load", ()=>{
                    let preview = reader.result;
                    console.log("previewSRc", preview)
                    this.base64URL = preview;
                    document.getElementById('song').innerHTML = `<audio id="audio-player" controls="controls" src="${this.base64URL}" type="audio/mpeg">`}, false);
                    reader.readAsDataURL(fileAudio);
                }
        },
        handleSubmit(){
            
            console.log(this.tentuvung, this.phienam, this.file, this.id_loaitu,this.nghia, this.vidu);
            console.log(this.id_loaitu);
            if(this.tentuvung && this.id_loaitu && this.nghia){
                let data={tentuvung: this.tentuvung, phienam: this.phienam, file: this.file, id_loaitu: this.id_loaitu, nghia: this.nghia, vidu: this.vidu}
                this.createTuVung(data).then(res =>{
                    if(res.ok ==true){
                        this.tentuvung ='', 
                        this.phienam = '', 
                        this.file = null, 
                        this.id_loaitu ='',
                        this.nghia ='', 
                        this.vidu =''
                    }
                    alert("Thêm thành công");
                    this.$router.push("/");
                })
            }
            else{
                alert("Bạn chưa nhập đầy đủ");
            }
        },
        handleCheckFile(file){

                let filename = file.name;
                let type = file.type;

                if(filename.lastIndexOf(".") == -1) {
                    return false
                }
                if( type.lastIndexOf('audio/mpeg') != -1 ) {
                    return true
                }

                return false;
        },
        handleDeleteAudioPreview(){
            this.base64URL='';
            this.file = null;
            document.getElementById('song').innerHTML = ``;
        }
    },
    created(){
        this.getLoaiTu();
    }
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