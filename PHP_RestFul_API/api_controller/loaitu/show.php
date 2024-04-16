<?php
    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    include_once("../../model/loaitu.php");
    include_once("../../config/database.php");
    $database = new database();
    $db = $database->getConnection();

    $items = new loaitu($db);
    $items->id_loai = isset($_GET['id_loai']) ? $_GET['id_loai'] : die();

     
    $items->getSingleLoai();
    $tuvungArr = array();
    $tuvungArr["status"]= 200;
    $tuvungArr["message"]= 'Kết nối thành công';
    $tuvungArr['loaitu'] = (object)array();
    if($items->id_loai){
        $tuvungArr['loaitu']=(object)array(
            'id_loai'     => $items->id_loai,
            'tenloaitu' => $items->tenloaitu,
            'kyhieu'   => $items->kyhieu,
        );
        //array_push($tuvungArr['tuvung'], $tuvung_item);
        echo json_encode($tuvungArr);
    }
    else{
        $tuvungArr = array();
        $tuvungArr["status"]= 400;
        $tuvungArr["message"]= 'Không tìm thấy từ nào trong CSDL';
        $tuvungArr['loaitu']=[];
        echo json_encode($tuvungArr);
    }


        
?>