<?php
/* Smarty version 3.1.40, created on 2023-09-18 02:53:43
  from 'C:\Users\user\Desktop\sql\app\app\facturas\templates\nuevo.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6507bbb77ee1d3_41962016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fe51339a1ad0c5dfb0b2f3d79d3a9e6d7968452' => 
    array (
      0 => 'C:\\Users\\user\\Desktop\\sql\\app\\app\\facturas\\templates\\nuevo.tpl',
      1 => 1632767668,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6507bbb77ee1d3_41962016 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\Users\\user\\Desktop\\sql\\app\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<script'; ?>
>
    const EMPRESAS = JSON.parse(`<?php echo $_smarty_tpl->tpl_vars['empresasJson']->value;?>
`);
<?php echo '</script'; ?>
>

<div class="m-2 p-2">
    <form class="card" id="form-nuevo">
        <div class="card-header bg-primary text-white">
            <div class="float-left">
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Facturas/Index/">
                    <div class="text-white pr-2">
                        <i class="fas fa-sm fa-arrow-left"></i>
                    </div>
                </a>
            </div>
            
            <h5 class="mb-0">Emitir Factura</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- ROW 1 -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="input-idEmpresa" class="mb-0">Empresa<b class="text-danger">*</b></label>
                        <select name="idEmpresa" id="input-idEmpresa" class="form-control" required>
                            <option value="">Seleccione una empresa</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['empresas']->value, 'empresa');
$_smarty_tpl->tpl_vars['empresa']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['empresa']->value) {
$_smarty_tpl->tpl_vars['empresa']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['empresa']->value['idEmpresa'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['empresa']->value['razon_social'];?>
 [<?php echo $_smarty_tpl->tpl_vars['empresa']->value['rut'];?>
]
                                </option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>

                <!-- ROW 2 -->
                <div class="col-12">
                    <div class="form-group">
                        <label for="input-idPlan" class="mb-0">Tipo de plan</label>
                        <select name="tipo_plan" id="input-tipo_plan" class="form-control">
                            <option value="1">Con movimiento</option>
                            <option value="0">Sin movimiento</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-idPlan" class="mb-0">Plan</label>
                        <input type="text" id="input-idPlan" class="form-control bg-warning" disabled>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-valorPlan" class="mb-0">Valor Plan CLP</label>
                        <input type="text" id="input-valorPlan" class="form-control bg-warning text-right" disabled>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-periodoCobro" class="mb-0">Periodo de cobro<b class="text-danger">*</b></label>
                        <select name="periodoCobro" id="input-periodoCobro" class="form-control" required>
                            <option value="">Seleccione...</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['periodosCobros']->value, 'periodoCobro');
$_smarty_tpl->tpl_vars['periodoCobro']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['periodoCobro']->value) {
$_smarty_tpl->tpl_vars['periodoCobro']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['periodoCobro']->value['idPeriodoContable'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['periodoCobro']->value['nombre'];?>

                                </option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-cobrosAdicionales" class="mb-0">Cobros adicionales</label>
                        <div class="input-group">
                            <input type="text" id="input-cobrosAdicionales" class="form-control bg-warning text-right" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal-cobros-adicionales">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ROW 3 -->
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-servicio" class="mb-0">Servicios</label>
                        <select name="servicio" id="input-servicio" class="form-control">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicios']->value, 'servicio');
$_smarty_tpl->tpl_vars['servicio']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['servicio']->value) {
$_smarty_tpl->tpl_vars['servicio']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
">
                                    <?php echo $_smarty_tpl->tpl_vars['servicio']->value['nombre'];?>

                                </option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-valorCobrar" class="mb-0">Valor a Cobrar<b class="text-danger">*</b></label>
                        <input type="number" name="valorCobrar" id="input-valorCobrar" class="form-control" placeholder="Valor a cobrar..." required>
                    </div>
                </div>
                
                <!-- ROW 4 -->
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-numeroFactura" class="mb-0">N° Factura<b class="text-danger">*</b></label>
                        <input type="text" name="numeroFactura" id="input-numeroFactura" class="form-control" placeholder="Numero de factura..." required>
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-fechaCobro" class="mb-0">Fecha de cobro<b class="text-danger">*</b></label>
                        <input type="date" name="fechaCobro" id="input-fechaCobro" class="form-control" required value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
">
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-fechaVencimiento" class="mb-0">Fecha Vencimiento<b class="text-danger">*</b></label>
                        <input type="date" name="fechaVencimiento" id="input-fechaVencimiento" class="form-control" required>
                    </div>
                </div>
                
                <!-- ROW 5 -->
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-mb-6">
                            <div class="form-group">
                                <label class="mb-0">Status</label>
                                <input type="text" class="form-control bg-warning" disabled value="<?php echo $_smarty_tpl->tpl_vars['statusPendiente']->value->nombre;?>
">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-observacion" class="mb-0">Observación</label>
                        <textarea name="observacion" id="input-observacion" class="form-control" placeholder="Observación..." cols="30" rows="4"></textarea>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-observacion" class="mb-0">Centro de costo<b class="text-danger">*</b></label>
                        <select name="centroCosto" id="input-centroCosto" class="form-control" required>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['centrosCosto']->value, 'centro');
$_smarty_tpl->tpl_vars['centro']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['centro']->value) {
$_smarty_tpl->tpl_vars['centro']->do_else = false;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['centro']->value['idCentroCosto'];?>
"><?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre'];?>
</option>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Usuario que registra</label>
                        <input type="text" class="form-control" disabled value="<?php echo Sesion::Usuario()->nombre;?>
">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-center">
            <a class="btn btn-outline-secondary" style="width: 100px;" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Facturas/Index/">
                Cancelar
            </a>

            <button type="submit" class="btn btn-primary" style="width: 100px;">
                Generar
            </button>
        </div>
    </form>
</div>

<!-- MODAL COBROS ADICIONALES -->
<div class="modal fade" id="modal-cobros-adicionales">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="mb-0">Cobros adicionales</h5>
                <button class="close" type="button" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover table-striped w-100 mb-0">
                        <thead>
                            <tr>
                                <th style="width: 50px;">N°</th>
                                <th style="width: auto;">Descripción</th>
                                <th style="width: 120px;">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="100">
                                    <h5 class="mb-0 p-2 text-center">. . .</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" style="width: 100px;" type="button" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div><?php }
}
