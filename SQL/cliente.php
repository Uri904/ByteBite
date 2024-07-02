<?php

class cliente{
    public $id_cliente;
    public $nombre_cliente;

    function __construct($id_cliente,$nombre_cliente){
    $this->id_cliente=$id_cliente;
    $this->nombre_cliente=$nombre_cliente;
    echo "<br>Atributos inicializados ...";
    }
}
//$objC=new cliente(1,'Uriel');


?>