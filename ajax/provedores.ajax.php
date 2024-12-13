<?php 
require_once "../controladores/provedores.controlador.php";
require_once "../modelos/provedores.modelo.php";

class AjaxProvedores{
    /**========================
     * EDITAR USUARIO
     =========================*/

     public $idProvedor;
     public function ajaxEditarProvedores(){
        $campo = 'id';
        $item = $this->idProvedor; 
        $respuesta = ControladorProvedores::ctrMostrarProveedores($item, $campo);
        echo json_encode($respuesta);
     }

     public function ajaxEliminarProvedores(){
        $tabla = "provedores";
        $campo = 'id';
        $item =$this->idProvedor;
        $respuesta = ModeloProvedores::mdlEliminarProvedor($item, $campo, $tabla);
        return $respuesta;
     }

}

if(isset($_POST['idProvedor'])){
    $editar = new AjaxProvedores();
    $editar-> idProvedor = $_POST['idProvedor'];
    $editar->ajaxEditarProvedores();
}

if(isset($_POST['eliminarprovedor'])){
    $eliminarProvedor = new AjaxProvedores();
    $eliminarProvedor-> idProvedor = $_POST['eliminarprovedor'];
    $eliminarProvedor->ajaxEliminarProvedores();
};