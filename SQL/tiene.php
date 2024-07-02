<?php

class tiene{
    public $id_tiene;
    public $id_pedido;
    public $id_bebida;
    public $cantidad;

    function __construct($id_tiene,$id_pedido,$id_bebida,$cantidad){
        $this->id_tiene=$id_tiene;
        $this->id_pedido=$id_pedido;
        $this->id_bebida=$id_bebida;
        $this->cantidad=$cantidad;
        echo "<br>Atributos inicializados ...";
    }
}
//$objT=new tiene(1,1,1,3);


?>