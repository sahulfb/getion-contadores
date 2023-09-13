<?php
/* Smarty version 3.1.40, created on 2021-12-16 04:45:23
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/tareas/templates/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61bac4633f70f6_33700798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '256b27caf49bfafe3a6656d5156feb42c4035271' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/tareas/templates/index.html',
      1 => 1618951884,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61bac4633f70f6_33700798 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
    .max-width-description {
        max-width: 250px !important;
    }
    .select2 {
        width: 100% !important;
    }
    .select2-dropdown {
        z-index: 1074;
    }
</style>

<div class="px-2">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Tareas</h5>
                <div>
                    <button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#filtros">
                        <i class="fas fa-filter"></i> Filtros
                    </button>
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-nuevo">
                        <i class="fas fa-plus"></i> Registrar
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="collapse" id="filtros">
                <div class="p-3 rounded border mb-3 bg-info text-white">
                    <h5>Filtros</h5>
                    <div class="row">
                        <div class="form-group col-4 mb-0">
                            <label class="mb-0">Estado</label>
                            <select class="form-control form-control-sm" id="filtro-estado">
                                <option value="">General</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['estados']->value, 'estado');
$_smarty_tpl->tpl_vars['estado']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['estado']->value) {
$_smarty_tpl->tpl_vars['estado']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['estado']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['estado']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                        
                        <div class="form-group col-4 mb-0">
                            <label class="mb-0">Empresa</label>
                            <select class="form-control form-control-sm" id="filtro-empresa">
                                <option value="">General</option>
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
                        
                        <div class="form-group col-4 mb-0">
                            <label class="mb-0">Usuario</label>
                            <select class="form-control form-control-sm" id="filtro-usuario">
                                <option value="">General</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['usuarios']->value, 'usuario');
$_smarty_tpl->tpl_vars['usuario']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['usuario']->value) {
$_smarty_tpl->tpl_vars['usuario']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value['idUsuario'];?>
"><?php echo $_smarty_tpl->tpl_vars['usuario']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm w-100 mb-0" id="tabla">
                    <thead>
                        <tr>
                            <th style="width: 100px;">N°</th>
                            <th style="width: auto;">Empresa</th>
                            <th style="width: auto;">Tarea</th>
                            <th style="width: 100px;">Creación</th>
                            <th style="width: 100px;">Vencimiento</th>
                            <th style="width: 75px;">Status</th>
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
    </div>
</div>

<!-- MODAL NUEVO -->
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-nuevo">
            <div class="modal-header bg-primary text-white">
                <h5 class="mb-0">Nueva Tarea</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-0">Empresa</label>
                            <select class="form-control" name="empresa" id="nuevo-input-empresa" required>
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
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-0">Asignado a</label>
                            <select class="form-control" name="usuario" id="nuevo-input-usuario" required>
                                <option value="">Seleccione un usuario...</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['usuarios']->value, 'usuario');
$_smarty_tpl->tpl_vars['usuario']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['usuario']->value) {
$_smarty_tpl->tpl_vars['usuario']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value['idUsuario'];?>
"><?php echo $_smarty_tpl->tpl_vars['usuario']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-0">Detalle</label>
                            <textarea class="form-control" placeholder="Detalle..." name="descripcion" required cols="30" rows="3"></textarea>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label class="mb-0">Fecha de vencimiento</label>
                            <input type="date" class="form-control" name="fecha_vencimiento" required>
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
<!-- FIN MODAL NUEVO --><?php }
}
