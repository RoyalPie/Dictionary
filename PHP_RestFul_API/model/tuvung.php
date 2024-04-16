<?php
    header("Access-Control-Allow-Origin: *"); 
    class tuvung{
        public $conn;
        public $id_tu;
        public $tentuvung;
        public $phienam;
        public $phatam;
        public $id_loaitu;
        public $nghia;
        public $vidu;
        public $table = "tuvung";

        public function __construct($db){
            $this->conn = $db;
        }
        public function getAllTuVung(){
            $sqlQuery= "SELECT * FROM ".$this->table."";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getAllTuVungByIdLoaiTu(){
            $sqlQuery= "SELECT * FROM ".$this->table." WHERE id_loaitu = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id_loaitu);
            $stmt->execute();
            return $stmt;
        }
        public function getAllTuVungBySearch(){
            $like = "%".$this->tentuvung."%";
            $sqlQuery= "SELECT * FROM ".$this->table." WHERE tentuvung LIKE ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $like);
            $stmt->execute();
            return $stmt;
        }
        public function getSingleTuVung(){
            $sqlQuery= "SELECT * FROM ".$this->table." WHERE id_tu = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id_tu);
            $stmt->execute();           
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id_tu = $dataRow['id_tu'];
            $this->tentuvung = $dataRow['tentuvung'];
            $this->phienam = $dataRow['phienam'];
            $this->phatam = $dataRow['phatam'];
            $this->id_loaitu = $dataRow['id_loaitu'];
            $this->nghia = $dataRow['nghia'];
            $this->vidu = $dataRow['vidu'];
        }
        public function createTuVung(){
            $sqlQuery= "INSERT INTO ".$this->table." 
                                SET tentuvung= :tentuvung, 
                                    phienam=   :phienam, 
                                    phatam=    :phatam, 
                                    id_loaitu= :id_loaitu, 
                                    nghia=     :nghia, 
                                    vidu=      :vidu";
            $stmt = $this->conn->prepare($sqlQuery);
            //loai bo ky tu dac biet
            $this->tentuvung    = htmlspecialchars(strip_tags($this->tentuvung));
            $this->phienam      = htmlspecialchars(strip_tags($this->phienam));
            $this->phatam       = htmlspecialchars(strip_tags($this->phatam));
            $this->id_loaitu    = htmlspecialchars(strip_tags($this->id_loaitu));
            $this->nghia        = htmlspecialchars(strip_tags($this->nghia));
            $this->vidu         = htmlspecialchars(strip_tags($this->vidu));

            $stmt->bindParam(":tentuvung", $this->tentuvung);
            $stmt->bindParam(":phienam", $this->phienam);
            $stmt->bindParam(":phatam",  ($this->phatam));
            $stmt->bindParam(":id_loaitu", $this->id_loaitu);
            $stmt->bindParam(":nghia", $this->nghia);
            $stmt->bindParam(":vidu", $this->vidu);

            if($stmt->execute()){
                return true;
             }
             return false;
        }
        public function updateTuVung(){
            if(!$this->phatam){
                $sqlQuery= "UPDATE ".$this->table." 
                            SET tentuvung= :tentuvung, 
                                phienam=   :phienam, 
                                id_loaitu= :id_loaitu, 
                                nghia=     :nghia, 
                                vidu=      :vidu
                            WHERE id_tu=   :id_tu";
                $stmt = $this->conn->prepare($sqlQuery);
                //loai bo ky tu dac biet
                $this->tentuvung    = htmlspecialchars(strip_tags($this->tentuvung));
                $this->phienam      = htmlspecialchars(strip_tags($this->phienam));
               // $this->phatam       = htmlspecialchars(strip_tags($this->phatam));
                $this->id_loaitu    = htmlspecialchars(strip_tags($this->id_loaitu));
                $this->nghia        = htmlspecialchars(strip_tags($this->nghia));
                $this->vidu         = htmlspecialchars(strip_tags($this->vidu));
                $this->id_tu        = htmlspecialchars(strip_tags($this->id_tu));

                $stmt->bindParam(":tentuvung", $this->tentuvung);
                $stmt->bindParam(":phienam", $this->phienam);
                //$stmt->bindParam(":phatam",  ($this->phatam));
                $stmt->bindParam(":id_loaitu", $this->id_loaitu);
                $stmt->bindParam(":nghia", $this->nghia);
                $stmt->bindParam(":vidu", $this->vidu);
                $stmt->bindParam(":id_tu", $this->id_tu);
                    if($stmt->execute()){
                        return true;
                    }
                    return false;
            }

            $sqlQuery= "UPDATE ".$this->table." 
                            SET tentuvung= :tentuvung, 
                                phienam=   :phienam, 
                                phatam=    :phatam, 
                                id_loaitu= :id_loaitu, 
                                nghia=     :nghia, 
                                vidu=      :vidu
                            WHERE id_tu=   :id_tu";
            $stmt = $this->conn->prepare($sqlQuery);
            //loai bo ky tu dac biet
            $this->tentuvung    = htmlspecialchars(strip_tags($this->tentuvung));
            $this->phienam      = htmlspecialchars(strip_tags($this->phienam));
            $this->phatam       = htmlspecialchars(strip_tags($this->phatam));
            $this->id_loaitu    = htmlspecialchars(strip_tags($this->id_loaitu));
            $this->nghia        = htmlspecialchars(strip_tags($this->nghia));
            $this->vidu         = htmlspecialchars(strip_tags($this->vidu));
            $this->id_tu        = htmlspecialchars(strip_tags($this->id_tu));

            $stmt->bindParam(":tentuvung", $this->tentuvung);
            $stmt->bindParam(":phienam", $this->phienam);
            $stmt->bindParam(":phatam",  ($this->phatam));
            $stmt->bindParam(":id_loaitu", $this->id_loaitu);
            $stmt->bindParam(":nghia", $this->nghia);
            $stmt->bindParam(":vidu", $this->vidu);
            $stmt->bindParam(":id_tu", $this->id_tu);


            if($stmt->execute()){
                return true;
             }
            return false;

        }
        public function deleteTuVung(){
            $sqlQuery= "DELETE FROM ".$this->table." WHERE id_tu = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_tu = htmlspecialchars(strip_tags($this->id_tu));
            $stmt->bindParam(1, $this->id_tu);
            if($stmt->execute()){
                return true;
             }
            return false;
        }
    }
?>