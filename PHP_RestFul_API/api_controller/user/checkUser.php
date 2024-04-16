<?php
    header("Access-Control-Allow-Origin: *");       
    header("Content-Type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Headers: Content-Type');
    include_once("../../model/user.php");
    include_once("../../config/database.php");
  
    $database= new database();
    $db = $database->getConnection();
    $items = new user($db);
    $items->taikhoan = isset($_GET['taikhoan']) ? $_GET['taikhoan'] : die();
    //echo $items->taikhoan;
    $items->matkhau = isset($_GET['matkhau']) ? $_GET['matkhau'] : die();
    $stmt = $items->checkUser();
    $itemCount = $stmt->rowCount();
    if($itemCount>0){
        $tuvungArr = array();
        $tuvungArr["status"]= 200;
        $tuvungArr["message"]= 'Kết nối thành công';
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $tuvungArr['user'] = (object)array(
        'id'   => $id,
        'taikhoan' => $taikhoan
        );
        echo json_encode($tuvungArr);
    }
    else if($itemCount == 0){
        $tuvungArr = array();
        $tuvungArr["status"]= 400;
        $tuvungArr["message"]= 'Tài khoản hoặc mật khẩu sai';
        echo json_encode($tuvungArr);
    }
    else{
        $tuvungArr = array();
        $tuvungArr["status"]= 200;
        $tuvungArr["message"]= 'Tài khoản không tồn tại';
    }
?>