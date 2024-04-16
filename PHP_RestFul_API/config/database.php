<?php
    //Ket noi csdl
    header("Access-Control-Allow-Origin: *"); 
    class database{
        public $conn;
        private $db_name ='my_dictionary';
        public $servername = "localhost";
        private $username = "root";
        private $password = "";
        public $port= '80';
        public function getConnection(){
            $this->conn = null;
            try {
                $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->db_name."", $this->username, $this->password); //array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                $this->conn->exec("set names utf8");
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
            } catch (PDOException $e) {
                echo "Ket noi failed: " . $e->getMessage();
            }
        return $this->conn;
        }
    }
?>