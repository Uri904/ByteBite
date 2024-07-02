<?php

class contiene{
    public $id_contiene;
    public $id_pedido;
    public $id_platillo;
    public $cantidad;

    function __construct($id_contiene,$id_pedido,$id_platillo,$cantidad){
        $this->id_contiene=$id_contiene;
        $this->id_pedido=$id_pedido;
        $this->id_platillo=$id_platillo;
        $this->cantidad=$cantidad;
        echo "<br>Atributos inicializados ...";
    }
}
//$objCO=new contiene(1,1,1,3);


?>