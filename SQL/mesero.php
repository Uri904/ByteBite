<?php

class mesero{
    public $id_mesero;
    public $id_empleado;
    public $contra;

    function __construct($id_mesero,$id_empleado,$contra){
        $this->id_mesero=$id_mesero;
        $this->id_empleado=$id_empleado;
        $this->contra=$contra;
        echo "<br>Atributos inicializados ...";


    }

}
//$obj=new mesero(1,1,'Holaquehace');

?>