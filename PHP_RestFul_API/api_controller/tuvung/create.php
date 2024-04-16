<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    // header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../../model/tuvung.php");
    include_once("../../config/database.php");

    $database = new database();
    $db = $database->getConnection();

    $item = new tuvung($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->tentuvung = $data->tentuvung;
    $item->phienam   = $data->phienam;
    $item->phatam    = $data->phatam;
    $item->id_loaitu = $data->id_loaitu;
    $item->nghia     = $data->nghia;
    $item->vidu      = $data->vidu;
    
    if($item->createTuVung()){
        $tuvungArr = array();
        $tuvungArr["status"]= 200;
        $tuvungArr["message"]= 'Thêm thành công';
        echo json_encode($tuvungArr);
    }
    else{
        $tuvungArr = array();
        $tuvungArr["status"]= 400;
        $tuvungArr["message"]= 'Kết nối thất bại';
        echo json_encode($tuvungArr);
    }

?>