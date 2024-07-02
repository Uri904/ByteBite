<?php
class empleado{
public $id_empleado;
public $nombre_empleado;
public $apellido_paterno;
public $apellido_materno;
public $calle;
public $municipio;
public $colonia;
public $codigo_postal;
public $salario;
public $telefono;

function __construct($id_empleado,$nombre_empleado,$apellido_paterno, $apellido_materno,$calle,$municipio,$colonia,$codigo_postal,$salario,$telefono){
$this->id_empleado=$id_empleado;
$this->nombre_empleado=$nombre_empleado;
$this->apellido_paterno=$apellido_paterno;
$this->apellido_materno=$apellido_materno;
$this->calle=$calle;
$this->municipio=$municipio;
$this->colonia=$colonia;
$this->codigo_postal=$codigo_postal;
$this->salario=$salario;
$this->telefono=$telefono;
echo "<br>Atributos inicializados ...";
}

}
//$obj= new empleado(1,'Brian','Sepulveda','Romero','San Roberto','Manzana 24','La Trinidad',55614,1700,5566338588);

?>