<?php
/* Smarty version 3.1.40, created on 2021-11-18 14:07:00
  from '/home/exlandcl/public_html/gestion/app/cobros_adicionales/templates/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_619688347f4412_46797175',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd801a8a3c2462f7131571b1b9fee3fc98e63d25f' => 
    array (
      0 => '/home/exlandcl/public_html/gestion/app/cobros_adicionales/templates/index.html',
      1 => 1637255216,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_619688347f4412_46797175 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="p-2 m-2">
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <div class="d-flex justify-content-between">
                <h5 class="card-title mb-0">Cobros Adicionales</h5>
                <div class="datatable-header-options h5">
                    <button id="btn-nuevo">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered mb-0 w-100" id="table-cobros">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Empresa</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Es fijo</th>
                            <th>Opc.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="100">
                                <h5 class="mb-0 p-3 text-center">. . .</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL NUEVO -->
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="mb-0">Nuevo cobro adicional</h5>
                <button class="close" data-dismiss="modal" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-1">Empresa</label>
                            <div>
                                <select class="form-control select2 w-100" name="empresa_id" required>
                                    <option value="">Seleccione una empresa...</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['empresas']->value, 'empresa');
$_smarty_tpl->tpl_vars['empresa']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['empresa']->value) {
$_smarty_tpl->tpl_vars['empresa']->do_else = false;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['empresa']->value['idEmpresa'];?>
"><?php echo $_smarty_tpl->tpl_vars['empresa']->value['razon_social'];?>
</option>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-1">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" required placeholder="Descripción...">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-1">Monto</label>
                            <input type="number" class="form-control" name="monto" required placeholder="Monto...">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" name="es_fijo" class="custom-control-input" id="nuevo-cobro-adicional-fijo">
                            <label class="custom-control-label" for="nuevo-cobro-adicional-fijo">Cobro adicional fijo</label>
                        </div>
                    </div>
                    <div class="col-12 collapse show" id="nuevo-periodos">
                        <label class="mb-1">Periodos</label>
                        <select class="form-control select2" name="periodos_id[]" multiple>
                            <option value="" disabled>Seleccione un periodo...</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['periodos']->value, 'periodo');
$_smarty_tpl->tpl_vars['periodo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['periodo']->value) {
$_smarty_tpl->tpl_vars['periodo']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['periodo']->value['idPeriodoContable'];?>
"><?php echo $_smarty_tpl->tpl_vars['periodo']->value['nombre'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" style="width: 100px;" type="button" data-dismiss="modal">
                    Cerrar
                </button>
                <button class="btn btn-primary" style="width: 100px;" type="submit">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL MODIFICAR -->
<div class="modal fade" id="modal-modificar">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Modificar cobro adicional</h5>
                <button class="close" data-dismiss="modal" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="cobro_adicional_id">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-1">Empresa</label>
                            <div>
                                <input type="text" class="form-control" name="empresa" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-1">Descripción</label>
                            <input type="text" class="form-control" name="descripcion" required placeholder="Descripción...">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-1">Monto</label>
                            <input type="number" class="form-control" name="monto" required placeholder="Monto...">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" name="es_fijo" class="custom-control-input" id="modificar-cobro-adicional-fijo">
                            <label class="custom-control-label" for="modificar-cobro-adicional-fijo">Cobro adicional fijo</label>
                        </div>
                    </div>
                    <div class="col-12 collapse show" id="modificar-periodos">
                        <label class="mb-1">Periodos</label>
                        <select class="form-control select2" name="periodos_id[]" multiple>
                            <option value="" disabled>Seleccione un periodo...</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['periodos']->value, 'periodo');
$_smarty_tpl->tpl_vars['periodo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['periodo']->value) {
$_smarty_tpl->tpl_vars['periodo']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['periodo']->value['idPeriodoContable'];?>
"><?php echo $_smarty_tpl->tpl_vars['periodo']->value['nombre'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" style="width: 100px;" type="button" data-dismiss="modal">
                    Cerrar
                </button>
                <button class="btn btn-primary" style="width: 100px;" type="submit">
                    Modificar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modal-eliminar">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="mb-0">Eliminar cobro adicional</h5>
                <button class="close" data-dismiss="modal" type="button">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="cobro_adicional_id">
                <p class="mb-0">¿Esta seguro que desea eliminar el cobro adicional <b data="id"></b>?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" style="width: 100px;" type="button" data-dismiss="modal">
                    Cerrar
                </button>
                <button class="btn btn-danger" style="width: 100px;" type="submit">
                    Eliminar
                </button>
            </div>
        </form>
    </div>
</div><?php }
}
