<?php
/* Smarty version 3.1.40, created on 2022-02-01 11:58:51
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/centros_costo/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61f9207b8ec284_13088868',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8953f462682484a1beef04266c1131e87b143b0c' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/centros_costo/templates/index.tpl',
      1 => 1603819698,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f9207b8ec284_13088868 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Centro de costos

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
            <table class="table table-bordered table-striped table-hover table-sm" style="width: 100%;" id="tabla">
                <thead>
                    <tr>
                        <th style="width: 25px;">Id</th>
                        <th style="width: auto;">Nombre</th>
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
                <h5 class="mb-0">Nuevo centro de costo</h5>
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
            <input type="hidden" name="idCentroCosto" id="editar-input-idCentroCosto">

            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Modificar centro de costo</h5>
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
                <h5 class="mb-0">Eliminar centro de costo</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="idCentroCosto" id="eliminar-input-idCentroCosto">
                <label>¿Esta seguro que desea eliminar el centro de costo <b id="eliminar-label-nombre"></b>?</label>
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
