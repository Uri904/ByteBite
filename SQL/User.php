<?php
include_once 'conexion.php';

class User extends conexion{

        private $id_mesa;
        private $contra;

        public function userExists ($user, $contra){
                $md5pass = md5(pass);

                $query = $this->conent()->prepare('SELECT * FROM mesa WHERE id_mesa = : id_mesas AND contra = : contra');
                $query->execute(['id_mesa' => $id_mesa, 'contra' => $md5pass]);

                if($query->rowCount()){
                        return true;
                }else{
                        return false;
                }
        }

        public function setId_mesa($id_mesa){
                $query = this->connect()->prepare('SELECT * FROM mesa WHERE id_mesa = : id_mesas');
                $query->execute(['id_mesa' => $id_mesa]);

                foreach($query as $currentId_mesa){
                        $this->id_mesa = $currentId_esa['id_mesa'];
                        $this->id_mesa = $currentId_mesa['id_mesa'];

                }

        }
}