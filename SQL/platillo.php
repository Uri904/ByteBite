<?php

class platillo{
    public $nombre_platillo;
    public $precio;
    public $descripcion;

    function __construct($nombre_platillo,$precio,$descripcion){
        $this->nombre_platillo=$nombre_platillo;
        $this->precio=$precio;
        $this->descripcion=$descripcion;
        echo "<br>Atributos inicializados ...";
        }
        

}
?>