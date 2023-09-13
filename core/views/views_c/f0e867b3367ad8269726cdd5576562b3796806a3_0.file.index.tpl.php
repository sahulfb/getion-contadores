<?php
/* Smarty version 3.1.40, created on 2022-02-01 12:01:17
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/frecuencia_cobro/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61f9210d6cf3d8_10684107',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0e867b3367ad8269726cdd5576562b3796806a3' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/frecuencia_cobro/templates/index.tpl',
      1 => 1603138362,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61f9210d6cf3d8_10684107 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Periodos de cobros

                <div class="datatable-header-options">
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
                        <th style="width: 150px;">Frecuencia</th>
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

<!-- MODAL EDITAR -->
<div class="modal fade" id="modal-editar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-editar">
            <input type="hidden" name="idPeriodo" id="editar-input-idPeriodo">

            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Modificar periodo de cobro</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-0">ID</label>
                            <input type="text" class="form-control" id="editar-input-idPeriodoHidden" disabled>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="editar-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="editar-input-nombre" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-0">Frecuencia</label>
                            <input type="text" class="form-control" id="editar-input-frecuencia" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary w-100px" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" class="btn btn-success w-100px">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
<!-- FIN MODAL EDITAR --><?php }
}
