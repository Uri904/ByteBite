<?php

class mesero{
    public $id_empleado;
    public $id_mesero;
    public $contra;

    function __construct($id_empleado,$id_mesero,$contra){
        $this->id_empleado=$id_empleado;
        $this->id_mesero=$id_mesero;
        $this->contra=$contra;
        echo "<br>Atributos inicializados ...";


    }

}
//$obj=new mesero(1,1,'Holaquehace');

?>