<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");
include_once("../../model/tuvung.php");
include_once("../../config/database.php");
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "ct239";

    $database = new database();
    $db = $database->getConnection();
    

    //$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
	$errorMSG = '';
    $name          =  $_POST['txt_name'];

    $fileName      =  $_FILES['file']['name'];
    $fileType      =  $_FILES['file']['type'];
    $fileSize      =  $_FILES['file']['size'];
    $tempPath      =  $_FILES['file']['tmp_name'];
    $path          = "upload/".$fileName;
		
        if(empty($fileName))
        {
            $errorMSG = json_encode(array("message" => "please select image", "status" => false));	
            echo $errorMSG;
        }
        if(!file_exists($path)){
            if($fileSize < 5000000){
                move_uploaded_file($tempPath, "upload/".$fileName);
            }
            else{
                $errorMSG="File cua ban lon tren 5mb";
            }
        }
        else{
            $errorMSG="File cua ban da ton tai";
        }
        echo $errorMSG;
            
    // if no error caused, continue ....
    if(!$errorMSG)
    {
        $insert_stmt = $db->prepare("INSERT into file (name,file) VALUES(:name, :file)");
        $insert_stmt->bindParam(":name", $name);
        $insert_stmt->bindParam(":file", $path);
        if($insert_stmt->execute()){
            echo json_encode(array("message" => "Image Uploaded Successfully", "status" => true));
        }
        	
    }
        // $insert_stmt = $conn->prepare("INSERT into file (name,file) VALUES(:name, :file)");
        // $insert_stmt->bindParam(":name", $name);
        // $insert_stmt->bindParam(":file", $path);
        // $insert_stmt->execute();
        // echo json_encode(array("message" => "Image Uploaded Successfully", "status" => true));
        // if($insert_stmt->execute()){
        //     echo json_encode(array("message" => "Image Uploaded Successfully", "status" => true));
        // }

?>