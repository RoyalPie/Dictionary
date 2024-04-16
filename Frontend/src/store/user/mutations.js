export default{
    SET_CURR_USER(state, data){
        state.ACCESS_TOKEN = data.id
        state.currUser= data
        localStorage.setItem('token', data.id)
         
    },
    SET_LOGOUT(state){
        state.ACCESS_TOKEN = ''
        localStorage.removeItem('token')
        state.currUser= null;
        
    }
}