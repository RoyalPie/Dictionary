<?php
    header("Access-Control-Allow-Origin: *");       
    header("Content-Type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Headers: Content-Type');
    include_once("../../model/tuvung.php");
    include_once("../../config/database.php");

    $database= new database();
    $db = $database->getConnection();
    $items = new tuvung($db);
    $items->tentuvung = isset($_GET['tentuvung']) ? $_GET['tentuvung'] : die();
    // $data = json_decode(file_get_contents("php://input"));
    // $items->tentuvung = $data->tentuvung;
    $stmt = $items->getAllTuVungBySearch();
    $itemCount = $stmt->rowCount();

    if($itemCount>0){
        $tuvungArr = array();
        $tuvungArr["status"]= 200;
        $tuvungArr["message"]= 'Kết nối thành công';
        $tuvungArr['tuvung'] = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $tuvung_item = array(
                'id_tu'   => $id_tu,
                'tentuvung'  => $tentuvung,
                'phienam' => $phienam,
                'phatam'  => ($phatam ? $database->servername.":".$database->port."/PHP_RestFul_API/api_controller/tuvung/upload/".$phatam : null),
                'id_loaitu' => $id_loaitu,
                'nghia'     => $nghia,
                'vidu'      => $vidu
            );
            array_push($tuvungArr['tuvung'], $tuvung_item);
        }
        echo json_encode($tuvungArr);
    }
    else if($itemCount == 0){
        $tuvungArr = array();
        $tuvungArr["status"]= 200;
        $tuvungArr["message"]= 'Kết nối thành công';
        $tuvungArr['tuvung'] = [];
        echo json_encode($tuvungArr);
    }
    else{
        $tuvungArr = array();
        $tuvungArr["status"]= 400;
        $tuvungArr["message"]= 'Kết nối thất bại';
        $tuvungArr['tuvung'] = [];
        echo json_encode($tuvungArr);
    }
?>