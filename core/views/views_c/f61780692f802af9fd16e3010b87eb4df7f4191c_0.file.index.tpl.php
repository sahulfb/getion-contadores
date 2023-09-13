<?php
/* Smarty version 3.1.40, created on 2022-01-03 13:04:30
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/servicios/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61d2f45e450f10_75437333',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f61780692f802af9fd16e3010b87eb4df7f4191c' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/servicios/templates/index.tpl',
      1 => 1616585322,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61d2f45e450f10_75437333 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Servicios

                <div class="datatable-header-options">
                    <button data-toggle="modal" data-target="#modal-nuevo">
                        <i class="fas fa-plus"></i>
                    </button>

                    <button onclick="RefrescarTabla()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" style="width: 100%;" id="tabla">
                <thead class="table-sm">
                    <tr>
                        <th style="width: 25px;">Id</th>
                        <th style="width: auto;">Nombre</th>
                        <th style="width: auto;">Observación</th>
                        <th style="width: 100px;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="4">
                            <h5 class="mb-0 text-center p-2">. . .</h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL NUEVO -->
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-nuevo">
            <div class="modal-header bg-primary text-white">
                <h5 class="mb-0">Nuevo Servicio</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nuevo-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="nuevo-input-nombre" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label for="nuevo-input-observacion" class="mb-0">Observación</label>
                            <textarea class="form-control" placeholder="Observación..." name="observacion" id="nuevo-input-observacion" cols="30" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary w-100px" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" class="btn btn-primary w-100px">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>
<!-- FIN MODAL NUEVO -->

<!-- MODAL EDITAR -->
<div class="modal fade" id="modal-editar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-editar">
            <input type="hidden" name="id" id="editar-input-id">

            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Modificar Servicio</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="editar-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="editar-input-nombre" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label for="editar-input-observacion" class="mb-0">Observación</label>
                            <textarea class="form-control" placeholder="Observación..." name="observacion" id="editar-input-observacion" cols="30" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary w-100px" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" class="btn btn-success w-100px">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>
<!-- FIN MODAL EDITAR -->

<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modal-eliminar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-eliminar">
            <div class="modal-header bg-danger text-white">
                <h5 class="mb-0">Eliminar Servicio</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="eliminar-input-id">
                <label class="mb-0">¿Esta seguro que desea eliminar el servicio <b id="eliminar-label-nombre"></b>?</label>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary w-100px" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" class="btn btn-danger w-100px">
                    Confirmar
                </button>
            </div>
        </form>
    </div>
</div>
<!-- FIN MODAL ELIMINAR --><?php }
}
