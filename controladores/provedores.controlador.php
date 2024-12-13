<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class ControladorProvedores
{
    /**
     * MOSTRAR USUARIOS
     */
    static public function ctrMostrarProveedores($item, $campo)
    {
        $tabla = 'provedores';

        $respuesta = ModeloProvedores::mdlMostrarProvedores($tabla, $item, $campo);
        return $respuesta;
    }
    /** =================================================
     * CREAR PROVEDOR
     =============================*/
    static public function ctrCrearProvedor()
{
    // Valide por cada campo
    $validNombre = "/^[a-zA-Z]+$/"; 
    $validTelefono = "/^[0-9]{10}$/"; //solo 10 digitos
    $validDireccion = "/^.{1,255}$/"; 
    $validCodigoPostal = "/^[0-9]{5}$/";  // solo codigo postal validos 5 digitos
    $validMetodoPago = "/^(efectivo|transferencia|tarjeta|cheque)$/"; // validacion de campo para solo opciones validas
    $validCategoria = "/^(tecnologia|hogar|ropa|abarrotes)$/"; // validacion de campo para solo opciones validas

    if (isset($_POST["nombre"])) {
        if (
            preg_match($validNombre, $_POST["nombre"]) &&
            preg_match($validTelefono, $_POST["telefono"]) &&
            preg_match($validDireccion, $_POST["direccion"]) &&
            preg_match($validCodigoPostal, $_POST["codigo_postal"]) &&
            preg_match($validMetodoPago, $_POST["metodo_pago"]) &&
            preg_match($validCategoria, $_POST["categoria_proveedor"])
        ) {
            var_dump($_POST);

            $tabla = 'provedores';
            $parametros = [
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'direccion' => $_POST['direccion'],
                'estado' => $_POST['estado'],
                'codigo_postal' => $_POST['codigo_postal'],
                'metodo_pago' => $_POST['metodo_pago'],
                'categoria_proveedor' => $_POST['categoria_proveedor']
            ];

            $respuesta = ModeloProvedores::mdIgresarProvedore($tabla, $parametros);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "Proveedor guardado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location ="?ruta=productos";
                             }                        
                        });
                    </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "El proveedor no se guardó",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location ="?ruta=productos";
                             }                        
                        });
                    </script>';
            }
        } else {
            echo '<script>
                swal({
                    type: "error",
                    title: "Algunos campos contienen datos inválidos.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location ="?ruta=productos";
                         }                        
                    });
                </script>';
        }
    }
}

    /**
     * ===========================================
     * EDITAR PROVEDOR
     * ===========================================
     */

     static public function ctrEditarProvedores()
     {
         // Valido igual que al agregar provedores
         $validNombre = "/^[a-zA-Z]+$/";
         $validTelefono = "/^[0-9]{10}$/"; 
         $validDireccion = "/^.{1,255}$/";
         $validCodigoPostal = "/^[0-9]{5}$/";
         $validMetodoPago = "/^(efectivo|transferencia|tarjeta|cheque)$/";
         $validCategoria = "/^(tecnologia|hogar|ropa|abarrotes)$/"; 
     
         if (isset($_POST["editarnombre"])) {
             // Validar cada campo con las expresiones regulares
             if (
                 preg_match($validNombre, $_POST["editarnombre"]) &&
                 preg_match($validTelefono, $_POST["editartelefono"]) &&
                 preg_match($validDireccion, $_POST["editardireccion"]) &&
                 preg_match($validCodigoPostal, $_POST["editarpostal"]) &&
                 preg_match($validMetodoPago, $_POST["editarpago"]) &&
                 preg_match($validCategoria, $_POST["editarcategoria"])
             ) {
                 $tabla = 'provedores';
                 $id = $_POST['editarid']; // ID del proveedor a editar
                 $parametros = [
                     'nombre' => $_POST['editarnombre'],
                     'telefono' => $_POST['editartelefono'],
                     'email' => $_POST['editaremail'],
                     'direccion' => $_POST['editardireccion'],
                     'estado' => $_POST['editarestado'],
                     'codigo_postal' => $_POST['editarpostal'],
                     'metodo_pago' => $_POST['editarpago'],
                     'categoria_proveedor' => $_POST['editarcategoria']
                 ];
     
                 // Llamar al modelo para actualizar el proveedor
                 $respuesta = ModeloProvedores::mdIEdtarProvedores($tabla, $parametros, $id);
     
                 // Respuesta según el resultado
                 if ($respuesta == "ok") {
                     echo '<script>
                         swal({
                             type: "success",
                             title: "Proveedor actualizado correctamente",
                             showConfirmButton: true,
                             confirmButtonText: "Cerrar"
                             }).then(function(result){
                                 if(result.value){
                                     window.location ="?ruta=productos";
                                  }                        
                             });
                         </script>';
                 } else {
                     echo '<script>
                         swal({
                             type: "error",
                             title: "El proveedor no se pudo actualizar",
                             showConfirmButton: true,
                             confirmButtonText: "Cerrar"
                             }).then(function(result){
                                 if(result.value){
                                     window.location ="?ruta=productos";
                                  }                        
                             });
                         </script>';
                 }
             } else {
                 // Validación fallida: Mostrar mensaje de error
                 echo '<script>
                     swal({
                         type: "error",
                         title: "Algunos campos contienen datos inválidos.",
                         showConfirmButton: true,
                         confirmButtonText: "Cerrar"
                         }).then(function(result){
                             if(result.value){
                                 window.location ="?ruta=productos";
                              }                        
                         });
                     </script>';
             }
         }
     }
     
}
