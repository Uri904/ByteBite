<?php

class mesa{
    public $id_mesa;
    public $contra;
    public $conficontra;
    public $confiadmin;

    function __construct($id_mesa,$contra,$conficontra,$contraadmin){
        $this->id_mesa=$id_mesa;
        $this->contra=$contra;
        $this->conficontra=$conficontra;
        $this->contraadmin=$contraadmin;
        echo "<br>Atributos inicializados ...";
        }
        

}



?>