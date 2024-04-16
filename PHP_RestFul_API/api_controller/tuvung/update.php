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

    // $data = json_decode(file_get_contents("php://input"));
    
    // $name          =  $_POST['txt_name'];
    $tentuvung = $_POST['tentuvung'];
    $phienam   = $_POST['phienam'];
    $id_loaitu = $_POST['id_loaitu'];
    $nghia     = $_POST['nghia'];
    $vidu      = $_POST['vidu'];
    $id_tu     = $_POST['id_tu'];

    $fileName      =  $_FILES['file']['name'];
    $fileType      =  $_FILES['file']['type'];
    $fileSize      =  $_FILES['file']['size'];
    $tempPath      =  $_FILES['file']['tmp_name'];
    $path          = "upload/".$fileName;

    
    
    if(empty($fileName)){
            // $errorMSG = json_encode(array("message" => "please select image", "status" => false));	
            // echo $errorMSG;
            $item->tentuvung = $tentuvung;
            $item->phienam   = $phienam;
            //$item->phatam    = null;
            $item->id_loaitu = $id_loaitu;
            $item->nghia     = $nghia;
            $item->vidu      = $vidu;
            $item->id_tu      = $id_tu;
            if($item->updateTuVung()){
                $tuvungArr = array();
                $tuvungArr["status"]= 200;
                $tuvungArr["message"]= 'Cập nhật thành công';
                echo json_encode($tuvungArr);
            }
            else{
                $tuvungArr = array();
                $tuvungArr["status"]= 400;
                $tuvungArr["message"]= 'Kết nối thất bại';
                echo json_encode($tuvungArr);
            }
    }else{
        if(!file_exists($path)){
            if($fileSize < 5000000){
                move_uploaded_file($tempPath, "upload/".$fileName);
                $item->tentuvung = $tentuvung;
                $item->phienam   = $phienam;
                $item->phatam    = $fileName;
                $item->id_loaitu = $id_loaitu; 
                $item->nghia     = $nghia;
                $item->vidu      = $vidu;
                $item->id_tu      = $id_tu;
                if($item->updateTuVung()){
                    $tuvungArr = array();
                    $tuvungArr["status"]= 200;
                    $tuvungArr["message"]= 'Cập nhật thành công';
                    echo json_encode($tuvungArr);
                }
                else{
                    $tuvungArr = array();
                    $tuvungArr["status"]= 400;
                    $tuvungArr["message"]= 'Kết nối thất bại';
                    echo json_encode($tuvungArr);
                }
            }
        }
        else{
                //Xoa file rồi thêm
            //$errorMSG="File cua ban da ton tai";
            unlink("upload/".$fileName);
            move_uploaded_file($tempPath, "upload/".$fileName);
            $item->tentuvung = $tentuvung;
            $item->phienam   = $phienam;
            $item->phatam    = $fileName;
            $item->id_loaitu = $id_loaitu;
            $item->nghia     = $nghia;
            $item->vidu      = $vidu;
            $item->id_tu      = $id_tu;
            if($item->updateTuVung()){
                $tuvungArr = array();
                $tuvungArr["status"]= 200;
                $tuvungArr["message"]= 'Cập nhật thành công';
                echo json_encode($tuvungArr);
            }
            else{
                $tuvungArr = array();
                $tuvungArr["status"]= 400;
                $tuvungArr["message"]= 'Kết nối thất bại';
                echo json_encode($tuvungArr);
            }

        }
    }
        
        //echo $errorMSG;






    

?>