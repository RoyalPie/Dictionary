export default {
    getInfor_Voca:(state)=>{
        let listTuVung = state.listTuVung;
        let listLoaiTu = state.listLoaiTu;
        let All = {
            listTuVung,
            listLoaiTu
        }
        return All;
    },
    SortList:(state)=>{
        let clonelistTuVung = [...state.listTuVung];
        if(clonelistTuVung){
            for( var i = 0; i< clonelistTuVung.length -1 ; i++){
                for( var j = 1; j<clonelistTuVung.length; j++){
                    if(clonelistTuVung[i].tentuvung < clonelistTuVung[j].tentuvung){
                        let a = clonelistTuVung[i];
                        clonelistTuVung[i] = clonelistTuVung[j];
                        clonelistTuVung[j] = a;
                    }
                }
            }
        // state.listTuVung = clonelistTuVung;
        return clonelistTuVung;
        }
    },
    getListLoai:(state)=>{
        return state.listLoaiTu;
    }
}