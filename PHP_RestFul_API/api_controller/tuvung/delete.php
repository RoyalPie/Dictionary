<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    // header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once("../../model/tuvung.php");
    include_once("../../config/database.php");
    $database = new database();
    $db = $database->getConnection();

    $items = new tuvung($db);
    //$items->id_tu = isset($_GET['id_tu']) ? $_GET['id_tu'] : die();
    //$item = new tuvung($db);
    $data = json_decode(file_get_contents("php://input"));
    $items->id_tu = $data->id_tu;

    $tuvungArr = array();
    
    if($items->deleteTuVung()){
        $tuvungArr["status"]= 200;
        $tuvungArr["message"]= 'Xóa thành công';
        echo json_encode($tuvungArr);
    }
    else{
        $tuvungArr["status"]= 400;
        $tuvungArr["message"]= 'Không tìm thấy từ nào trong CSDL';
        echo json_encode($tuvungArr);
    }
?>