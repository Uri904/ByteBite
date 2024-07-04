<?php

class mesa{
    public $contra;
    public $confiContra;
    public $confiAdmin;

    function __construct($contra,$confiContra,$contraAdmin){
        $this->contra=$contra;
        $this->confiContra=$confiContra;
        $this->contraAdmin=$contraAdmin;
        echo "<br>Atributos inicializados ...";
        }
        

}



?>