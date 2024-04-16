<template>
    <div class="login"> 
        <form action="" @submit.prevent="handleCheckUser">
            <div class="form-group">
                <h3>Đăng nhập vào website</h3>
                <input v-model="taikhoan" type="text" class="form-control" placeholder="Username">
                <input v-model="matkhau" type="password" class="form-control" placeholder="Password">
                <button type="submit" class="btn btn-primary ml-auto">Đăng nhập</button>
            </div>
        </form>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name: 'login',
    data(){
        return{
            taikhoan:'',
            matkhau: ''
        }
    },
    methods:{
        ...mapActions(['checkLogin']),
        handleCheckUser(){
            console.log("aaaa")
            if(this.taikhoan && this.matkhau){
                let data={
                    taikhoan: this.taikhoan,
                    matkhau: this.matkhau
                }
                this.checkLogin(data).then(res=>{
                    console.log(res)
                    if(res.ok){
                        alert(res.message);
                        this.$router.push("/");
                    }
                    else{
                        alert(res.message);
                    }

                })
            }
            else{
                alert("Bạn cần nhập đầy đủ")
            }
        }
    }
}
</script>

<style>
    .login{
                width: 27rem;
                height: 20rem;
                background-color: white;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%,-50%);
                box-shadow: 2px 2px 3px black;
                padding: 1rem;
                box-sizing: border-box;
            
 
        }
        .login h3{
                color: Blue;

            
        }
        .form-group{
                width: 25rem;
                height: 17rem;
                display: flex;
                align-items: center;
                flex-wrap: wrap;
        }
        .form-control{
                width: 100%;
                display: block;
        }
</style>