<?php
/* Smarty version 3.1.40, created on 2022-08-16 14:12:49
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/gestion_sistema/templates/usuarios/ver.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62fba5e1c70a36_03187939',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04bc8ba148232891a29fc9bab3a13593e9fd32b5' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/gestion_sistema/templates/usuarios/ver.tpl',
      1 => 1602625752,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62fba5e1c70a36_03187939 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="m-2 p-2">
    <div class="card mb-3">
        <div class="card-body p-3">
            <h5 class="mb-0">
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Gestion_Sistema/Usuarios/" class="text-decoration-none">
                    <i class="fas fa-arrow-left pr-1 mr-1"></i>
                </a>

                <?php echo $_smarty_tpl->tpl_vars['objUsuario']->value->nombre;?>

            </h5>
        </div>
    </div>

    <form class="row" id="form-datos">
        <input type="hidden" name="idUsuario" value="<?php echo $_smarty_tpl->tpl_vars['objUsuario']->value->id;?>
">

        <div class="col-12 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Datos personales</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-nombre" class="mb-1">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="input-nombre" placeholder="Nombre..." value="<?php echo $_smarty_tpl->tpl_vars['objUsuario']->value->nombre;?>
">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h5 class="mb-0">Datos de acceso</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-correo" class="mb-1">Correo:</label>
                                <input type="text" name="correo" class="form-control" id="input-correo" placeholder="Correo..." value="<?php echo $_smarty_tpl->tpl_vars['objUsuario']->value->correo;?>
">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-clave" class="mb-1">Contraseña</label>
                                <input type="password" name="clave" class="form-control" id="input-clave" placeholder="Contraseña...">
                                <label class="small text-danger mb-0">Complete este campo si desea cambiar la contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Permisología</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-idRol" class="mb-1">Rol</label>
                                <select class="form-control" name="idRol" id="input-idRol">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roles']->value, 'rol');
$_smarty_tpl->tpl_vars['rol']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rol']->value) {
$_smarty_tpl->tpl_vars['rol']->do_else = false;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['rol']->value['idRol'] == $_smarty_tpl->tpl_vars['objUsuario']->value->idRol) {?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['rol']->value['idRol'];?>
" selected><?php echo $_smarty_tpl->tpl_vars['rol']->value['nombre'];?>
</option>
                                        <?php } else { ?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['rol']->value['idRol'];?>
"><?php echo $_smarty_tpl->tpl_vars['rol']->value['nombre'];?>
</option>
                                        <?php }?>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="activo" class="custom-control-input" id="input-activo" <?php echo $_smarty_tpl->tpl_vars['objUsuario']->value->activo ? 'checked' : '';?>
>
                                <label class="custom-control-label" for="input-activo">Activo</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h5 class="mb-0">Datos de sistema</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                ID:
                                <label class="font-weight-bold"><?php echo $_smarty_tpl->tpl_vars['objUsuario']->value->id;?>
</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div>
                                Fecha registro:
                                <label class="font-weight-bold"><?php echo Formato::Fecha($_smarty_tpl->tpl_vars['objUsuario']->value->fecha_registro);?>
</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div>
                                Fecha modificación:
                                <label class="font-weight-bold"><?php echo Formato::Fecha($_smarty_tpl->tpl_vars['objUsuario']->value->fecha_modificacion);?>
</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-2"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div><?php }
}
