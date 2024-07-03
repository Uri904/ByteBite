<?php

class mesero{
    public $id_empleado;
    public $contra;
    public $correo;

    function __construct($id_empleado,$correo,$contra){
        $this->id_empleado=$id_empleado;
        $this->correo=$correo;
        $this->contra=$contra;
        

        echo "<br>Atributos inicializados ...";


    }

}
//$obj=new mesero(1,1,'Holaquehace');

?>