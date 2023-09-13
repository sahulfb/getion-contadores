<?php
/* Smarty version 3.1.40, created on 2022-08-02 16:12:49
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/facturas/templates/ver_empresa.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62e94d014f9a80_91063332',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd13118af8fb669cd4f5807f3a57529d6af2c8405' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/facturas/templates/ver_empresa.tpl',
      1 => 1632761328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62e94d014f9a80_91063332 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/arsddfnz/gestion.santiagocontadores.cl/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<div class="px-2 d-flex justify-content-between align-items-center">
    <h3><span class="text-muted">Empresa</span> - <?php echo $_smarty_tpl->tpl_vars['empresa']->value->razon_social;?>
</h3>

    <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Facturas/Por_Generar/">Volver</a>
</div>

<div class="px-2">
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title mb-0">Datos</div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3 mb-3 mb-md-0 form-group">
                    <label class="mb-0">RUT</label>
                    <input type="text" class="form-control" disabled value="<?php echo $_smarty_tpl->tpl_vars['empresa']->value->rut;?>
">
                </div>
                <div class="col-12 col-md-9 form-group">
                    <label class="mb-0">Razon social</label>
                    <input type="text" class="form-control" disabled value="<?php echo $_smarty_tpl->tpl_vars['empresa']->value->razon_social;?>
">
                </div>
                <div class="col-12 form-group mb-3">
                    <label class="mb-0">Correo</label>
                    <input type="text" class="form-control" disabled value="<?php echo $_smarty_tpl->tpl_vars['empresa']->value->correo;?>
">
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 form-group">
                    <label class="mb-0">Plan con movimiento</label>
                    <input type="text" class="form-control" disabled value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['nombre'];?>
">
                </div>
                <div class="col-12 form-group mb-3">
                    <label class="mb-0">Detalle</label>
                    <textarea class="form-control" disabled cols="30" rows="3"><?php echo $_smarty_tpl->tpl_vars['plan']->value['detalle'];?>
</textarea>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 form-group">
                    <label class="mb-0">Plan sin movimiento</label>
                    <input type="text" class="form-control" disabled value="<?php echo $_smarty_tpl->tpl_vars['plan_sinMovimiento']->value['nombre'];?>
">
                </div>
                <div class="col-12 form-group mb-0">
                    <label class="mb-0">Detalle</label>
                    <textarea class="form-control" disabled cols="30" rows="3"><?php echo $_smarty_tpl->tpl_vars['plan_sinMovimiento']->value['detalle'];?>
</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title mb-0">Facturas</div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered mb-0 w-100">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Fecha de cobro</th>
                            <th>Periodo contable</th>
                            <th>N° factura</th>
                            <th>Valor a cobrar</th>
                            <th>Fecha Venc.</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($_smarty_tpl->tpl_vars['facturas']->value) > 0) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['facturas']->value, 'factura');
$_smarty_tpl->tpl_vars['factura']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['factura']->value) {
$_smarty_tpl->tpl_vars['factura']->do_else = false;
?>
                            <tr>
                                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['factura']->value['idFactura'];?>
</td>
                                <td class="text-center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['factura']->value['fechaCobro'],'d/m/Y');?>
</td>
                                <td class="text-left"><?php echo $_smarty_tpl->tpl_vars['factura']->value['periodo_contable']->nombre;?>
</td>
                                <td class="text-right"><?php echo $_smarty_tpl->tpl_vars['factura']->value['numeroFactura'];?>
</td>
                                <td class="text-right"><?php echo number_format($_smarty_tpl->tpl_vars['factura']->value['valorCobrar'],0,',','.');?>
</td>
                                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['factura']->value['fechaVencimiento'];?>
</td>
                                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['factura']->value['status']->nombre;?>
</td>
                            </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="100">
                                    <h5 class="mb-0 p-3 text-center">
                                        No hay facturas registradas a esta empresa.
                                    </h5>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br><?php }
}
