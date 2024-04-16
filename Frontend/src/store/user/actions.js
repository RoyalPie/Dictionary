import axios_instance from "../../plugins/axios"
export default{
    async checkLogin({commit}, {taikhoan, matkhau}){
        try {
            var result = await axios_instance.get('/api_controller/user/checkUser.php', {params:{taikhoan, matkhau}});
            console.log(result)
            if(result.data.status==200){
                commit('SET_CURR_USER', result.data.user);
                return{
                    ok: true,
                    message: result.data.message
                }
                
            }
            else 
                return{
                    ok: false,
                    message: result.data.message
                }
        } catch (error){
            return{
                ok: false,
                message: error.message
            }
        }
    },
    getLogout({commit}){
        try {
            commit('SET_LOGOUT');
            return{
                ok:true
            }
        } catch (error) {
            return{
                ok:false
            }
        }
    }
}