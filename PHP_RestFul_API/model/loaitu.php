<?php
    header("Access-Control-Allow-Origin: *"); 
    class loaitu{
        public $id_loai;
        public $tenloaitu;
        public $kyhieu;

        private $conn;
        private $table='loaitu';

        public function __construct($db){
            $this->conn=$db;
        }

        public function getLoaiTu(){
            $sqlQuery  = "Select * from ".$this->table."";
            $statement = $this->conn->prepare($sqlQuery);
            $statement->execute();
            return $statement;
        }
        public function getSingleLoai(){
            $sqlQuery= "SELECT * FROM ".$this->table." WHERE id_loai = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id_loai);
            $stmt->execute();           
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id_loai = $dataRow['id_loai'];
            $this->tenloaitu = $dataRow['tenloaitu'];
            $this->kyhieu = $dataRow['kyhieu'];
  
        }

    }
?>