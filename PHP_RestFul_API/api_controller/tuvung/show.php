<?php
    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    include_once("../../model/tuvung.php");
    include_once("../../config/database.php");
    $database = new database();
    $db = $database->getConnection();

    $items = new tuvung($db);
    $items->id_tu = isset($_GET['id_tu']) ? $_GET['id_tu'] : die();

     
    $items->getSingleTuVung();
    $tuvungArr = array();
    $tuvungArr["status"]= 200;
    $tuvungArr["message"]= 'Kết nối thành công';
    $tuvungArr['tuvung'] = (object)array();
    if($items->id_tu != null){
        $tuvungArr['tuvung']=(object)array(
            'id_tu'     => $items->id_tu,
            'tentuvung' => $items->tentuvung,
            'phienam'   => $items->phienam,
            'phatam'    => ($items->phatam ? $database->servername.":".$database->port."/PHP_RestFul_API/api_controller/tuvung/upload/".$items->phatam : null),
            'id_loaitu' => $items->id_loaitu,
            'nghia'     => $items->nghia,
            'vidu'      => $items->vidu
        );
        //array_push($tuvungArr['tuvung'], $tuvung_item);
        echo json_encode($tuvungArr);
    }
    else{
        $tuvungArr = array();
        $tuvungArr["status"]= 400;
        $tuvungArr["message"]= 'Không tìm thấy từ nào trong CSDL';
        $tuvungArr['tuvung']=[];
        echo json_encode($tuvungArr);
    }
?>