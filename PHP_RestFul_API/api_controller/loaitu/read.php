<?php
    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    include_once("../../model/loaitu.php");
    include_once("../../config/database.php");
    //Goi class database de Ket noi CSDL
    $database = new database();
    $db =       $database->getConnection();
    //Loai class loaitu o model der lienket du lieu
    
    $items = new loaitu($db);
    $statement = $items->getLoaiTu();

    $itemCount = $statement->rowCount();

    if($itemCount > 0){
        $loaituArr = array();
        $loaituArr['status']= 200;
        $loaituArr["message"]= 'Kết nối thành công';
        $loaituArr['loaitu'] = array();
        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $item = [
                'id_loai' => $id_loai,
                'tenloaitu'=> $tenloaitu,
                'kyhieu'=> $kyhieu
            ];
            array_push($loaituArr['loaitu'],$item);
        }
        echo json_encode($loaituArr);

    }
    else if($itemCount == 0){
        $loaituArr = array();
        $loaituArr['status']= 200;
        $loaituArr["message"]= 'Kết nối thành công';
        $loaituArr['loaitu'] = [];
        echo json_encode($loaituArr);
    }
    else{
        $loaituArr = array();
        $loaituArr['status']= 400;
        $loaituArr["message"]= 'Kết nối thất bại';
        echo json_encode($loaituArr);
    }

?>