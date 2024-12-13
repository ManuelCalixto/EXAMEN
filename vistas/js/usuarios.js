$(".nuevaFoto").change(function () {
   let imagen = this.files[0];
   /**========================
    * validamos el formato en jpg, png
    ========================*/
   if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
      $(".nuevaFoto").val("");
      swal({
         title: "Error al subir la imagen",
         text: "La imagen debe estar en formato JPG o PNG",
         type: "error",
         confirmButtonText: "Cerrar"
      })
   } else if (imagen["size"] > 2000000) {
      $(".nuevaFoto").val("");
      swal({
         title: "Error al subir la imagen",
         text: "La imagen no debe pesar mas de 2MB",
         type: "error",
         confirmButtonText: "Cerrar"
      });
   } else {
      let datosImagen = new FileReader;
      datosImagen.readAsDataURL(imagen);

      $(datosImagen).on("load", function (event) {
         let rutaImagen = event.target.result;
         $(".previsualizar").attr("src", rutaImagen);
      });
   }
});

/**==================================================================
 * EDITAR USUARIO
 ===================================================================*/

$(document).on("click", ".btnEditarUsuario", function () {
   let idUsuario = $(this).attr("idUsuario");
   console.log(idUsuario);
   let datos = new FormData();
   //le estoy pasando un identificador y un valor
   datos.append("idUsuario", idUsuario);

   $.ajax({
      url: "ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
         console.log(respuesta);
         //let tu= document.getElementById("editarusuario");
         // tu.textContent= respuesta['usuario'];
         $("#editarusuario").val(respuesta['usuario']);
         $("#passwordActual").val(respuesta['password']);
         $("#editarestado").val(respuesta['estado']);
         respuesta['estado'] ? $("#editarestado").html("Activo") : $("#editarestado").html("Inactivo");

         $("#editartipo").val(respuesta['tipo']);
         respuesta['tipo'] == 'admin' ? $("#editartipo").html("admin") : $("#editartipo").html("Usuario");

         $('#fotoactual').val(respuesta['ruta']);
         $('.previsualizar').attr('src', respuesta['ruta']);
         $('#editarid').val(respuesta['id']);

      }
   });
});

/**======================================================================
 *   ELIMINAR USUARIO
 * +==================================================================== */

$(document).on('click', '.btnEliminarUsuario', function () {
   let idUsuario = $(this).attr("idUsuario");
   swal({
      title: "Deseas Eliminar Usuario?",
      text: "Si no lo esta, puede cancelar la accion",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Eliminar"
   }).then(function (result) {
      if (result.value) {
         let datos = new FormData();
         //le estoy pasando un identificador y un valor
         datos.append("eliminarUsuario", idUsuario);

         $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
               window.location = "?ruta=usuarios";
            }
         })
      }
   });
});


/**==================================================================
 * EDITAR PROVEEDOR
 ===================================================================*/

$(document).on("click", ".btnEditarProvedores", function () {
   let idProvedor = $(this).attr("idProvedor");
   console.log(idProvedor);
   let datos = new FormData();
   //le estoy pasando un identificador y un valor
   datos.append("idProvedor", idProvedor);

   $.ajax({
      url: "ajax/provedores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
         console.log(respuesta);
         //let tu= document.getElementById("editarusuario");
         // tu.textContent= respuesta['usuario'];
         $("#editarnombre").val(respuesta['nombre']);
         $("#editartelefono").val(respuesta['telefono']);
         $("#editaremail").val(respuesta['email']);
         $("#editardireccion").val(respuesta['direccion']);

         $("#editarestado").val(respuesta['estado']);
         respuesta['estado'] ? $("#editarestado").html("Activo") : $("#editarestado").html("Inactivo");

         $("#editarpostal").val(respuesta['codigo_postal']);

         //$("#editarpago").val(respuesta['metodo_pago']);

         if (respuesta['metodo_pago'] == 'efectivo') {
            $("#editarpago").html("efectivo")
         } else if (respuesta['metodo_pago'] == 'cheque') {
            $("#editarpago").html("cheque")
         } if (respuesta['metodo_pago'] == 'transferencia') {
            $("#editarpago").html("transferencia")
         } else {
            console.log("no hay opcion")
         }


         $("#editarcategoria").val(respuesta['categoria_proveedor']);
         

            switch (respuesta['categoria_proveedor']) {
            case 'tecnologia':
               $("#editarcategoria").html("tecnologia");
               break;
            case 'hogar':
               $("#editarcategoria").html("hogar");
               break;
            case 'ropa':
               $("#editarcategoria").html("ropa");
               break;
            case 'abarrotes':
               $("#editarcategoria").html("abarrotes");
               break;
            default:
               $("#editarcategoria").html(""); // Opcional: limpiar o manejar un caso no definido
               break;
         }


         $('#editarid').val(respuesta['id']);

      }
   });
});

/**======================================================================
 *   ELIMINAR USUARIO
 * +==================================================================== */

$(document).on('click', '.btnEliminarProvedor', function () {
   let idProvedor = $(this).attr('idProvedor');
   swal({
      title: "Deseas Eliminar Provedor?",
      text: "Si no lo esta, puede cancelar la accion",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Eliminar"
   }).then(function (result) {
      if (result.value) {
         let datos = new FormData();
         //le estoy pasando un identificador y un valor
         datos.append("eliminarprovedor", idProvedor);

         $.ajax({
            url: "ajax/provedores.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
               window.location = "?ruta=productos";
            }
         })
      }
   });
});
