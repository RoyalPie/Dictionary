import Vue from 'vue'
export default {
    SETLOAITU(state, data){
        // Vue.set(state.loaitu[data.id_tu], "");
        for( var i = 0; i<data.length; i++){
            Vue.set(state.listLoaiTu, data[i].id_loai, data[i]);
        }
    
    },
    SETLISTTU(state, data){
        state.listTuVung = data;
        // for( var i = 0; i<data.length; i++){
        //     Vue.set(state.tuvung, data[i].id_tu, data[i]);
        // }
    },
    SortList(state, value){
        let clonelistTuVung = [...state.listTuVung];
        if(clonelistTuVung){
            if(value == 0){
                for( var i = 0; i< clonelistTuVung.length -1 ; i++){
                    for( var j = i+1; j<clonelistTuVung.length; j++){
                        if(clonelistTuVung[i].tentuvung > clonelistTuVung[j].tentuvung){
                            let a = clonelistTuVung[i];
                            clonelistTuVung[i] = clonelistTuVung[j];
                            clonelistTuVung[j] = a;
                        }
                    }
                }
                state.listTuVung = clonelistTuVung;
            }
            if(value == 1){
                for( var i = 0; i< clonelistTuVung.length -1 ; i++){
                    for( var j = i+1; j<clonelistTuVung.length; j++){
                        if(clonelistTuVung[i].tentuvung < clonelistTuVung[j].tentuvung){
                            let a = clonelistTuVung[i];
                            clonelistTuVung[i] = clonelistTuVung[j];
                            clonelistTuVung[j] = a;
                        }
                    }
                }
                state.listTuVung = clonelistTuVung;
            }
        
        }
    },
    CURR_VOCA(state, data){
        state.currVoca = data
    }
}