<?php
    header("Access-Control-Allow-Origin: *");       
    header("Content-Type: application/json; charset=UTF-8");
    header('Access-Control-Allow-Headers: Content-Type');
    class user{
        public $conn;
        public $id;
        public $taikhoan;
        public $matkhau;
        public $table = "user";

        public function __construct($db){
            $this->conn = $db;
        }
        
        public function checkUser(){
            $sqlQuery= "SELECT * FROM ".$this->table." WHERE taikhoan=? and matkhau =?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->taikhoan);
            $stmt->bindParam(2, $this->matkhau);
            $stmt->execute();
            // if($stmt->execute()){
            //     return true;
            //  }
            return $stmt;
        }
        
    }
?>