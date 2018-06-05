<?php 
 
    class DbLocaOperations{
 
        private $con; 
 
        function __construct(){
 
            require_once dirname(__FILE__).'/DbConnect.php';
 
            $db = new DbConnect();
 
            $this->con = $db->connect();
 
        }
 
        /*CRUD -> C -> CREATE */
 
        public function insertLocalisation($longtitude,$latitude){
            if($this->isLocaExist($longtitude,$latitude)){
                return 0; 
            }else{
                $stmt = $this->con->prepare("INSERT INTO `localisation`(`id`, `longtitude`, `latitude`) VALUES (NULL,?,?);");
                //$stmt = $this->con->prepare("INSERT INTO `users0` (`id`, `username`, `password`, `email`) VALUES (NULL, ?, ?, ?);");
                $stmt->bind_param("ss",$longtitude,$latitude);
 
                if($stmt->execute()){
                    return 1; 
                }else{
                    return 2; 
                }
            }

        }

        public function isLocaExist($longtitude,$latitude){
            $stmt = $this->con->prepare("SELECT id FROM localisation WHERE longtitude = ? OR latitude = ?");
            $stmt->bind_param("ss", $longtitude, $latitude);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0;
        }
 
    }
    ?>