<?php
require("db.php");
    class user{ 
        private $id;
        public $login;
        public $prenom;
        public $nom;
        public $password;

        public function __construct(){
            $this->db = connect();
        }


        public function getAll() {
            foreach($con->query('SELECT * FROM utilisateurs') as $row){
                echo '<pre>';
                print_r($row);
                echo '</pre>';

                }
            }

    }


    
    
?>