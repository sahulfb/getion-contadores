<?php
/* Smarty version 3.1.40, created on 2021-12-16 04:46:20
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/facturas/templates/ver.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61bac49cb7a8e1_66365564',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94be1a1bba2e5cb5c77a28f06b9b984347a5718b' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/facturas/templates/ver.tpl',
      1 => 1632855936,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61bac49cb7a8e1_66365564 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/arsddfnz/gestion.santiagocontadores.cl/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<script'; ?>
>
    const ID_FACTURA = '<?php echo $_smarty_tpl->tpl_vars['objFactura']->value->id;?>
';
    const COBROS_ADICIONALES = JSON.parse(`<?php echo $_smarty_tpl->tpl_vars['cobros_adicionales']->value;?>
`);
    const VALOR_PLAN = `<?php echo $_smarty_tpl->tpl_vars['objFactura']->value->planValue;?>
`;
    const STATUS_FACTURA = JSON.parse(`<?php echo $_smarty_tpl->tpl_vars['json_objStatus']->value;?>
`);
<?php echo '</script'; ?>
>

<div class="m-2 p-2">
    <form class="card" id="form-modificar">
        <div class="card-header bg-primary text-white">
            <div class="float-left">
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Facturas/Index/">
                    <div class="text-white pr-2">
                        <i class="fas fa-sm fa-arrow-left"></i>
                    </div>
                </a>
            </div>

            <h5 class="mb-0">Factura ID <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->id;?>
</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- ROW 1 -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="mb-0">Empresa<b class="text-danger">*</b></label>
                        <input type="text" class="form-control form-control-sm text-black" disabled value="<?php echo $_smarty_tpl->tpl_vars['objEmpresa']->value->razon_social;?>
 [<?php echo $_smarty_tpl->tpl_vars['objEmpresa']->value->rut;?>
]">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="mb-0">Tipo plan<b class="text-danger">*</b></label>
                        <input type="text" class="form-control form-control-sm text-black" disabled value="<?php echo $_smarty_tpl->tpl_vars['tipo_plan']->value;?>
">
                    </div>
                </div>

                <!-- ROW 2 -->
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Plan Contratado</label>
                        <input type="text" class="form-control form-control-sm text-black" disabled value="<?php echo $_smarty_tpl->tpl_vars['plan']->value['nombre'] == NULL ? 'No asignado' : $_smarty_tpl->tpl_vars['plan']->value['nombre'];?>
">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Valor Plan CLP</label>
                        <input type="text" class="form-control form-control-sm text-right text-black" disabled value="<?php echo $_smarty_tpl->tpl_vars['objFactura']->value->valorPlan;?>
">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Periodo de cobro<b class="text-danger">*</b></label>
                        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $_smarty_tpl->tpl_vars['objPeriodo']->value->nombre;?>
">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-cobrosAdicionales" class="mb-0">Cobros adicionales</label>
                        <div class="input-group input-group-sm">
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
                                <?php if ($_smarty_tpl->tpl_vars['servicio']->value['id'] == $_smarty_tpl->tpl_vars['objFactura']->value->idServicio) {?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
" selected>
                                        <?php echo $_smarty_tpl->tpl_vars['servicio']->value['nombre'];?>

                                    </option>
                                <?php } else { ?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
">
                                        <?php echo $_smarty_tpl->tpl_vars['servicio']->value['nombre'];?>

                                    </option>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-valorCobrar" class="mb-0">Valor a Cobrar<b class="text-danger">*</b></label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="input-valorCobrar" <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '1' || $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '2' ? 'required' : 'disabled';?>
 name="valorCobrar" class="form-control text-right" value="<?php echo $_smarty_tpl->tpl_vars['objFactura']->value->valorCobrar;?>
" step="<?php echo 1/(pow(10,$_smarty_tpl->tpl_vars['objMonedaCLP']->value->decimales));?>
">
                            <div class="input-group-append">
                                <div class="input-group-text"><?php echo $_smarty_tpl->tpl_vars['objMonedaCLP']->value->simbolo;?>
</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ROW 4 -->
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-numeroFactura" class="mb-0">N° Factura<b class="text-danger">*</b></label>
                        <input type="text" id="input-numeroFactura" <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '1' || $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '2' ? 'required' : 'disabled';?>
 name="numeroFactura" class="form-control form-control-sm" value="<?php echo $_smarty_tpl->tpl_vars['objFactura']->value->numeroFactura;?>
">
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-fechaCobro" class="mb-0">Fecha de cobro<b class="text-danger">*</b></label>
                        <input type="date" id="input-fechaCobro" <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '1' || $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '2' ? 'required' : 'disabled';?>
 name="fechaCobro" class="form-control form-control-sm" value="<?php echo $_smarty_tpl->tpl_vars['objFactura']->value->fechaCobro;?>
">
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-fechaVencimiento" class="mb-0">Fecha Vencimiento<b class="text-danger">*</b></label>
                        <input type="date" id="input-fechaVencimiento" <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '1' || $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '2' ? 'required' : 'disabled';?>
 name="fechaVencimiento" class="form-control form-control-sm" value="<?php echo $_smarty_tpl->tpl_vars['objFactura']->value->fechaVencimiento;?>
">
                    </div>
                </div>
                
                <!-- ROW 5 -->
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-mb-6">
                            <div class="form-group">
                                <label class="mb-0">Status</label>
                                <input type="text" class="form-control form-control-sm bg-white text-black" idStatus="<?php echo $_smarty_tpl->tpl_vars['objStatus']->value->id;?>
" disabled value="<?php echo $_smarty_tpl->tpl_vars['objStatus']->value->nombre;?>
" id="input-status">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-observacion" class="mb-0">Observación</label>
                        <textarea name="observacion" id="input-observacion" class="form-control form-control-sm" placeholder="Observación..." <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '1' || $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '2' ? '' : 'disabled';?>
 cols="30" rows="4"><?php echo $_smarty_tpl->tpl_vars['objFactura']->value->observacion;?>
</textarea>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-observacion" class="mb-0">Centro de costo<b class="text-danger">*</b></label>
                        <select name="centroCosto" id="input-centroCosto" class="form-control form-control-sm" <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '1' || $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '2' ? 'required' : 'disabled';?>
>
                            <option value="">Seleccione el centro de costo...</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['centrosCosto']->value, 'centro');
$_smarty_tpl->tpl_vars['centro']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['centro']->value) {
$_smarty_tpl->tpl_vars['centro']->do_else = false;
?>
                                <?php if ($_smarty_tpl->tpl_vars['objCentroCosto']->value->id == $_smarty_tpl->tpl_vars['centro']->value['idCentroCosto']) {?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['centro']->value['idCentroCosto'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre'];?>
</option>
                                <?php } else { ?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['centro']->value['idCentroCosto'];?>
"><?php echo $_smarty_tpl->tpl_vars['centro']->value['nombre'];?>
</option>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Registrado por</label>
                        <input type="text" class="form-control form-control-sm" disabled value="<?php echo $_smarty_tpl->tpl_vars['objUsuario']->value->nombre;?>
">
                    </div>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['metodoPago']->value != NULL && $_smarty_tpl->tpl_vars['fechaPago']->value != NULL) {?>
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-0">
                            <label class="mb-0">Metodo de pago</label>
                            <input type="text" class="form-control form-control-sm" disabled value="<?php echo $_smarty_tpl->tpl_vars['metodoPago']->value;?>
">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-0">
                            <label class="mb-0">Fecha de pago</label>
                            <input type="text" class="form-control form-control-sm" disabled value="<?php echo Formato::Fecha($_smarty_tpl->tpl_vars['fechaPago']->value);?>
">
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>

        <div class="card-footer text-center">
            <a type="button" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Facturas/Index/" class="btn btn-outline-secondary" style="width: 100px;">
                Volver
            </a>

            <?php if ($_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '1' || $_smarty_tpl->tpl_vars['objFactura']->value->idStatus == '2') {?>
            <button type="button" class="btn btn-danger" style="width: 100px;" id="boton-anular">
                Anular
            </button>
            
            <button type="submit" class="btn btn-primary" style="width: 100px;" id="boton-actualizar">
                Actualizar
            </button>

            <button type="button" class="btn btn-success" style="width: 100px;" id="boton-pagar">
                Pagar
            </button>
            <?php }?>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-pagar">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form class="modal-content" id="form-pagar">
            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Pagar factura N° <?php echo $_smarty_tpl->tpl_vars['objFactura']->value->id;?>
</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="pagar-input-idMetodoPago" class="mb-0">Metodo de pago</label>
                            <select name="idMetodoPago" id="pagar-input-idMetodoPago" class="form-control" required>
                                <option value="">Metodos de pagos...</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['metodosPagos']->value, 'metodopago');
$_smarty_tpl->tpl_vars['metodopago']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['metodopago']->value) {
$_smarty_tpl->tpl_vars['metodopago']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['metodopago']->value['idMetodoPago'];?>
"><?php echo $_smarty_tpl->tpl_vars['metodopago']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label for="pagar-input-fechaPago" class="mb-0">Metodo de pago</label>
                            <input type="date" name="fechaPago" id="pagar-input-fechaPago" class="form-control" value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" style="width: 100px;" data-dismiss="modal">
                    Cancelar
                </button>

                <button type="submit" class="btn btn-success" style="width: 100px;">
                    Pagar
                </button>
            </div>
        </form>
    </div>
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
