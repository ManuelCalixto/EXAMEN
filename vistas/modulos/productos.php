<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lista de proveedores</h1>
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarUsuarios">
        Agregar provedor
    </button>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista de provedor</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>telefono</th>
                            <th>email</th>
                            <th>direccion</th>
                            <th>estado</th>
                            <th>codigo postal</th>
                            <th>metodo de pago</th>
                            <th>categoria_proveedor</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>telefono</th>
                            <th>email</th>
                            <th>direccion</th>
                            <th>estado</th>
                            <th>codigo postal</th>
                            <th>metodo de pago</th>
                            <th>categoria_proveedor</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $item = null;
                        $campo = null;

                        $provedores = ControladorProvedores::ctrMostrarProveedores($item, $campo);
                        foreach ($provedores as $provedor):
                            ?>
                            <tr>
                                <td><?= $provedor->id ?></td>
                                <td><?= $provedor->nombre ?></td>
                                <td><?= $provedor->telefono ?></td>
                                <td><?= $provedor->email ?></td>
                                <td><?= $provedor->direccion ?></td>
                                <td><?= $provedor->estado ? "Activo" : "No activo";?></td>
                                <td><?= $provedor->codigo_postal ?></td>
                                <td><?= $provedor->metodo_pago ?></td>
                                <td><?= $provedor->categoria_proveedor ?></td>
                                <td><button class="btn btn-warning btnEditarProvedores" idProvedor="<?= $provedor->id ?>"
                                        data-toggle="modal" data-target="#modalEditarUsuarios">
                                        Editar
                                    </button></td>
                                <td><button class="btn btn-danger btnEliminarProvedor"
                                idProvedor="<?=$provedor->id?>">Eliminar</button></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- INICIAN LOS MODALES -->

<!-- MODAL AGREGAR USUARIO -->

<div class="modal fade" id="modalAgregarUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="user" method="post" enctype="multipart/form-data">
                <!-- CABEZA MODAL -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar provedor</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- TERMINA CABEZA MODAL -->

                <!-- CUERPO MODAL -->
                <div class="modal-body">
                    <div class="form-group row">
                        <!-- ENTRAD DEL USUARIO -->
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="nombre"
                                placeholder="nombre">
                        </div>
                        <!-- ENTRADA TELEFONO -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="telefono"
                                placeholder="telefono">
                        </div>
                        <!-- ENTREDA DE EMAIL -->
                        <div class="col-sm-6 py-3">
                            <input type="text" class="form-control form-control-user" name="email" placeholder="email">
                        </div>

                        <!-- ENTREDA DE DIRECCION -->
                        <div class="col-sm-6 py-3">
                            <input type="text" class="form-control form-control-user" name="direccion"
                                placeholder="Direccion">
                        </div>

                        <!-- ENTRADA DE ESTADO -->
                        <div class="col-sm-6 py-3">
                            <select name="estado" class="form-control">Selecciona un estado
                                <option value="0">Inactivo</option>
                                ><option value="1">Activo</option>
                            </select>
                        </div>
                        <!-- ENTRADA DE CODIGO POSTAL -->
                        <div class="col-sm-6 py-3">
                            <input type="number" class="form-control form-control-user" name="codigo_postal"
                                placeholder="codigo postal">
                        </div>

                        <div class="col-sm-6 py-3">
                            <select name="metodo_pago" class="form-control">Selecciona metodo de pago
                                <option value="efectivo">efectivo</option>
                                <option value="cheque">cheque</option>
                                <option value="transferencia">transferencia</option>
                            </select>

                        </div>

                        <div class="col-sm-6 py-3">
                            <select name="categoria_proveedor" class="form-control">Seleccione categoria
                                <option value="tecnologia">Tecnologia</option>
                                <option value="hogar">Hogar</option>
                                <option value="ropa">Ropa</option>
                                <option value="abarrotes">Abarrotes</option>
                            </select>
                        </div>

                    </div>
                </div>
                <!-- TERMINA CUERPO DEL MODAL -->

                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Salir</button>
                    <button class="btn btn-success" type="submit">Guardar provedor</button>
                </div>
                <!-- TERMINA PIE DEL MODAL -->
            </form>
            <?php
            $crearProvedor = new ControladorProvedores();
            $crearProvedor->ctrCrearProvedor();
            ?>
        </div>
    </div>
</div>
<!-- TEMINA MODAL AGREGAR USUARIO -->
<!-- MODAL EDITAR USUARIO -->

<div class="modal fade" id="modalEditarUsuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="user" method="post" enctype="multipart/form-data">
                <!-- CABEZA MODAL -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Provedor</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">❌</span>
                    </button>
                </div>
                <!-- TERMINA CABEZA MODAL -->

                <!-- CUERPO MODAL -->
                <div class="modal-body">
                    <div class="form-group row">
                        <!-- ENTRAD DEL USUARIO -->
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="editarnombre"
                                id="editarnombre" value="">
                            <input type="text" name="editarid" id="editarid" value="">
                        </div>

                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" id="editartelefono" name="editartelefono"
                                placeholder="telefono">
                        </div>
                        <!-- ENTREDA DE EMAIL -->
                        <div class="col-sm-6 py-3">
                            <input type="text" id="editaremail"  class="form-control form-control-user" name="editaremail" placeholder="email">
                        </div>

                        <!-- ENTREDA DE DIRECCION -->
                        <div class="col-sm-6 py-3">
                            <input type="text" class="form-control form-control-user" id="editardireccion" name="editardireccion"
                                placeholder="Direccion">
                        </div>

                        <!-- ENTRADA DE ESTADO -->
                        <div class="col-sm-6 py-3">
                            <select name="editarestado" class="form-control">Selecciona un Estado>
                                <option value="" id="editarestado"></option>
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>

                        <!-- ENTRADA DE CODIGO POSTAL -->
                        <div class="col-sm-6 py-3">
                            <input type="number" class="form-control form-control-user" id="editarpostal" name="editarpostal"
                                placeholder="codigo postal">
                        </div>

                        <div class="col-sm-6 py-3">
                            <select name="editarpago" class="form-control">Selecciona metodo de pago
                                <option value="" id="editarpago"></option>
                                <option value="efectivo">efectivo</option>
                                <option value="cheque">cheque</option>
                                <option value="transferencia">transferencia</option>
                            </select>

                        </div>

                        <div class="col-sm-6 py-3">
                            <select name="editarcategoria" class="form-control">Seleccione categoria
                                <option value="" id="editarcategoria"></option>
                                <option value="tecnologia">Tecnologia</option>
                                <option value="hogar">Hogar</option>
                                <option value="ropa">Ropa</option>
                                <option value="abarrotes">Abarrotes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- TERMINA CUERPO DEL MODAL -->

                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Salir</button>
                    <button class="btn btn-success" type="submit">Guardar Cambios</button>
                </div>
                <!-- TERMINA PIE DEL MODAL -->
                <?php
                $editarProvedor = new ControladorProvedores();
                $editarProvedor->ctrEditarProvedores();
                ?>
            </form>
            <?php

            ?>
        </div>
    </div>
</div>
<!-- TEMINA MODAL EDITAR USUARIO -->