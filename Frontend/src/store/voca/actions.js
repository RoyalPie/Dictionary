import axios_instance from "../../plugins/axios"

export default {
    async getLoaiTu({commit}){
        //commit('SET_LOADING', true)
        try {
            var result = await axios_instance.get('/api_controller/loaitu/read.php');
            //commit('SET_LOADING', false)
            if(result.data.status==200){
                commit('SETLOAITU', result.data.loaitu);
            }
        } catch (error){
            //commit('SET_LOADING', false)
            console.log(error.message);
        }
    },
    async getListTu({commit}, id_loaitu =null){
        try {
            if(id_loaitu){
                let config ={
                    params:{
                        id_loaitu
                    }
                }
                var result = await axios_instance.get('/api_controller/tuvung/readbyid.php', config );
            }
            else{
                var result = await axios_instance.get('/api_controller/tuvung/read.php');
            }
            console.log(result)
            if(result.data.status==200){
                commit('SETLISTTU', result.data.tuvung); 
            }
        } catch (error) {
            console.log(error.message);
        }
    },
    async searchTu({commit, dispatch}, tentuvung =''){
        try {
            console.log('aaaa',tentuvung)
            var Promise1  =  axios_instance.get('/api_controller/tuvung/search.php', {params:{tentuvung}} );
            var Promise2 =   dispatch('getLoaiTu');
            let [result1,result2]= await Promise.all([Promise1, Promise2])
            console.log(result1)
            if(result1.data.status==200){
                commit('SETLISTTU', result1.data.tuvung); 
            }
        } catch (error) {
            return{
                ok: false
            }
        }
    },
    async createTuVung({commit}, {tentuvung ='', phienam='', file = null, id_loaitu = 1, nghia =null, vidu =null}){
        try {
            let config ={
                headers: { 'Content-Type': 'multipart/form-data', },
            }
            var bodyFormData = new FormData();
            bodyFormData.append('tentuvung', tentuvung);
            bodyFormData.append('phienam', phienam);
            bodyFormData.append('id_loaitu', id_loaitu);
            bodyFormData.append('nghia', nghia);
            bodyFormData.append('vidu', vidu);
            console.log("file",file);
            if(file){
                bodyFormData.append('file', file); 
            }   
           var result = await axios_instance.post("/api_controller/tuvung/createFromData.php", bodyFormData, config)
            //console.log(result)
            if(result.data && result.data.status==200){
                return{
                    ok: true,
                    message: result.data.message
                }
            }
            return{
                ok: false,
                message: "Thêm thất bại"
            }
        } catch (error) {
            return{
                ok: false,
                message: result.data.message
            }
        }
    },
    async getTuById({commit}, id_tu =null){
        try {
            let config ={
                params:{
                    id_tu
                }
            }
            var result = await axios_instance.get('/api_controller/tuvung/show.php', config );
            //console.log(result)
            if(result.data.status==200){    
                commit('CURR_VOCA',result.data.tuvung);
                var resultLoai = await axios_instance.get(`/api_controller/loaitu/show.php?id_loai=${result.data.tuvung.id_loaitu}`);
                let data={
                    ...result.data.tuvung, ...resultLoai.data.loaitu
                }
                return{
                    ok: true,
                    data: data,
                }
            }
            else{
                return{
                    ok: false,   
                }
            }
        } catch (error) {
            return{
                ok: false,
                data: error.message
            }
        }
    },
    async deleteVoCa(context,id_tu){
        try {
            console.log(id_tu)
            // let config ={
            //     params:{
            //         id_tu
            //     }
            // }
            let data ={
                id_tu
            }
            var result = await axios_instance.delete('/api_controller/tuvung/delete.php',  {data: { id_tu }} );
            //console.log(result);
            if(result.data.status==200){    
                return{
                    ok: true,
                    message: result.data.message,
                }
            }
            else{
                return{
                    ok: false,  
                    message: result.data.message 
                }
            }
        } catch (error){
            return{
                ok: false,
                message: error.message
            }
        }
    },
    async updateTuVung({commit}, {id_tu= '', tentuvung ='', phienam='', file = null, id_loaitu = 1, nghia =null, vidu =null}){
        try {
            let config ={
                headers: { 'Content-Type': 'multipart/form-data', },

            }

            var bodyFormData = new FormData();
            bodyFormData.append('tentuvung', tentuvung);
            bodyFormData.append('phienam', phienam);
            bodyFormData.append('id_loaitu', id_loaitu);
            bodyFormData.append('nghia', nghia);
            bodyFormData.append('vidu', vidu);
            bodyFormData.append('id_tu', id_tu);
            console.log("file",file);
            if(file){
                bodyFormData.append('file', file); 
            }
            
           var result = await axios_instance.post("/api_controller/tuvung/update.php", bodyFormData, config)
            //console.log(result)
            if(result.data && result.data.status==200){
                return{
                    ok: true,
                    message: result.data.message
                }
            }
            return{
                ok: false,
                message: "Cập nhật thành công"
            }
        } catch (error) {
            return{
                ok: false,
                message: result.data.message
            }
        }
    },
}