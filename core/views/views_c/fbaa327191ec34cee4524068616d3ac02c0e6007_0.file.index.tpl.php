<?php
/* Smarty version 3.1.40, created on 2022-01-10 15:00:40
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/planes/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61dc4a187b41e9_10170610',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbaa327191ec34cee4524068616d3ac02c0e6007' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/planes/templates/index.tpl',
      1 => 1615982908,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61dc4a187b41e9_10170610 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Planes

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
                        <th style="width: 100px;">Codigo</th>
                        <th style="width: auto; min-width: 200px;">Nombre</th>
                        <th style="width: 150px;">Periodo</th>
                        <th style="width: 100px;">Monto</th>
                        <th style="width: 100px;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="6">
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
                <h5 class="mb-0">Nuevo plan</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="nuevo-input-codigo" class="mb-0">Codigo</label>
                            <input type="text" class="form-control" placeholder="Codigo..." name="codigo" id="nuevo-input-codigo" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="nuevo-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="nuevo-input-nombre" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="nuevo-input-idPeriodo" class="mb-0">Periodo de cobro</label>
                            <select class="form-control" name="idPeriodo" id="nuevo-input-idPeriodo">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['periodos']->value, 'periodo');
$_smarty_tpl->tpl_vars['periodo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['periodo']->value) {
$_smarty_tpl->tpl_vars['periodo']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['periodo']->value['idFrecuenciaCobro'];?>
"><?php echo $_smarty_tpl->tpl_vars['periodo']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="nuevo-input-monto" class="mb-0">Monto</label>
                            <input type="number" class="form-control" placeholder="Monto..." name="monto" id="nuevo-input-monto" required min="0" step="0.01">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="nuevo-input-idMoneda" class="mb-0">Moneda</label>
                            <select class="form-control" name="idMoneda" id="nuevo-input-idMoneda" required>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['monedas']->value, 'moneda');
$_smarty_tpl->tpl_vars['moneda']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['moneda']->value) {
$_smarty_tpl->tpl_vars['moneda']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['moneda']->value['idMoneda'];?>
"><?php echo $_smarty_tpl->tpl_vars['moneda']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label for="nuevo-input-detalle" class="mb-0">Detalles</label>
                            <textarea class="form-control" name="detalle" id="nuevo-input-detalle" cols="30" rows="4" placeholder="Detalles (Opcional)..."></textarea>
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
            <input type="hidden" name="idPlan" id="editar-input-idPlan">

            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Modificar plan</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 d-none">
                        <div class="form-group">
                            <label for="editar-input-idPlanShow" class="mb-0">ID</label>
                            <input type="text" class="form-control" id="editar-input-idPlanShow" value="0" disabled>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="editar-input-codigo" class="mb-0">Codigo</label>
                            <input type="text" class="form-control" placeholder="Codigo..." name="codigo" id="editar-input-codigo" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="editar-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="editar-input-nombre" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="editar-input-idPeriodo" class="mb-0">Periodo de cobro</label>
                            <select class="form-control" name="idFrecuenciaCobro" id="editar-input-idPeriodo">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['periodos']->value, 'periodo');
$_smarty_tpl->tpl_vars['periodo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['periodo']->value) {
$_smarty_tpl->tpl_vars['periodo']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['periodo']->value['idFrecuenciaCobro'];?>
"><?php echo $_smarty_tpl->tpl_vars['periodo']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="editar-input-monto" class="mb-0">Monto</label>
                            <input type="number" class="form-control" placeholder="Monto..." name="monto" id="editar-input-monto" required min="0" step="0.01">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="editar-input-idMoneda" class="mb-0">Moneda</label>
                            <select class="form-control" name="idMoneda" id="editar-input-idMoneda" required>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['monedas']->value, 'moneda');
$_smarty_tpl->tpl_vars['moneda']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['moneda']->value) {
$_smarty_tpl->tpl_vars['moneda']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['moneda']->value['idMoneda'];?>
"><?php echo $_smarty_tpl->tpl_vars['moneda']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label for="editar-input-detalle" class="mb-0">Detalles</label>
                            <textarea class="form-control" name="detalle" id="editar-input-detalle" cols="30" rows="4" placeholder="Detalles (Opcional)..."></textarea>
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
                <h5 class="mb-0">Eliminar plan</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="idPlan" id="eliminar-input-idPlan">
                <label>¿Esta seguro que desea eliminar el plan <b id="eliminar-label-nombre"></b>?</label>
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
