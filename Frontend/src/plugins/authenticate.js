import store  from "../store";

const ifLogin = (to, from, next)=>{
    if(store.getters.isLogin){
        next()
    }
    else next({ path: '/login', query: { redirect: to.name } })
}
const ifNotLogin = (to, from, next)=>{
    if(!store.getters.isLogin){
        next()
    }
    else next({ path: '/'})
}
export {ifLogin, ifNotLogin}