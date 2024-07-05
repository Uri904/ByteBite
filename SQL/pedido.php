<?php

class pedido{
    public $id_pedido;
    public $costo;
    public $fecha;
    public $id_mesa;
    public $id_cliente;
    public $estado;

    function __construct($id_pedido,$costo,$fecha,$id_mesa,$id_cliente,$estado){
        $this->id_pedido=$id_pedido;
        $this->costo=$costo;
        $this->fecha=$fecha;
        $this->id_mesa=$id_mesa;
        $this->id_cliente=$id_cliente;
        $this->estado=$estado;
        echo "<br>Atributos inicializados ...";
        }

}

//$objP=new pedido(1,2500,'2024-03-03',1,1,'Finalizado');

?>