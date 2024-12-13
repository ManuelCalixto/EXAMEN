<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "conexion.php";
class ModeloProvedores{
    /**Mostrar Provedores */
    static public function mdlMostrarProvedores($tabla, $item, $campo){
        if ($item != null) {

            $query = Conexion::start()->prepare("SELECT * FROM $tabla WHERE $campo = '$item'"); 
            $query->execute();
            return $query->fetch();
        }else{
            $query = Conexion::start()->prepare("SELECT * FROM $tabla"); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }        

        $query->close();
        $query = null;
    }
    /***
     * CREAR PROVEDORES
     */
    static public function mdIgresarProvedore($tabla,$parametros){
        $col = implode(', ',array_keys($parametros));
        $valores = ":". implode(', :',array_keys($parametros));       
        $query = Conexion::start()->prepare("INSERT INTO {$tabla} 
        ({$col}) VALUES ({$valores})");
        if ($query->execute($parametros)) {
            return "ok";
        }else{
            return "error";
        }
        $query->close();
        $query = null;
    }

    static public function mdIEdtarProvedores($tabla, $parametros, $id){
    
        // var_dump($parametros);
        $col = implode(', ',array_map(function($col){
            return "{$col} =:{$col}";
        }, array_keys($parametros)));
        // var_dump($col);

        $query = Conexion::start()->prepare("UPDATE {$tabla} SET {$col} WHERE id =:id");
        $parametros['id']= $id;
        if ($query->execute($parametros)) {
            return "ok";
        }else{
            return "error";
        }
        $query->close();
        $query=null;
    }

    /**================================================================
     * Eliminar usuario
     * 
     ===============================================================*/
     
    static function mdlEliminarProvedor($item, $campo, $tabla){
        $query = Conexion::start()->prepare("DELETE FROM {$tabla} WHERE $campo = '$item'");
        if ($query->execute()) {
            return "ok";
        }else{
            return "error";
        }
        $query->close();
        $query=null;
    }
    
}