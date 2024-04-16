<template>
    <div class="form_Infor">
        <form action="" class="frm-infor">
            <div class="avatarUser">
                <img src="https://i.pinimg.com/originals/eb/b0/2a/ebb02aedec9bc74f65e38311c7e14d34.png" alt="AnhDaiDien" class="infor_avatar" width="150px" height="150px">
            </div>
            <p class="text-center mt-3"><label for="file-avatar" class="btn-avatar">Ảnh đại diện <i class="fas fa-pen"></i></label></p>
            <input type="file" name="" id="file-avatar" style="display: none;">
            <hr>
            <div class="form-group">
                <label for="vocabulary">Biệt danh</label>
                <input type="text" class="form-control" id="vocabulary" placeholder="">
                </div>
                <div class="form-group">
                <label for="example1">Giới thiệu</label>
                    <textarea class="form-control" id="example1" rows="4"></textarea>
                </div> 
                <hr>
                <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'user',
    data(){
        return{

        }
    }
}
</script>

<style >
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
    
    .form_Infor{
        background-color: rgb(224, 183, 70);
        max-width: 80vh;
        margin: 25px auto;
        border-radius: 20px;
        box-shadow: 2px 2px 5px black ;
    }
    
    .avatarUser{
        display: flex;
        justify-content: center;
        width: 100%;
        
    }
    .infor_avatar{
        border-radius: 10px;
    }
    .frm-infor{
        max-width: 60vh;
        height: 80vh;
        margin: 0 auto;
    }
    .btn-avatar{
        padding: 5px 10px;
        border-radius: 5px;
        background-color:#1a60bd;
        color: white;
        font-weight: bold
    }
    .btn-avatar:hover{
        background-color:#225480;
    }
</style>