<?php

class bebida{
    public $nombre_bebida;
    public $precio;
    public $descripcion;

    function __construct($nombre_bebida,$precio,$descripcion){
        $this->nombre_bebida=$nombre_bebida;
        $this->precio=$precio;
        $this->descripcion=$descripcion;
        echo "<br>Atributos inicializados ...";
        }
    
}

?>