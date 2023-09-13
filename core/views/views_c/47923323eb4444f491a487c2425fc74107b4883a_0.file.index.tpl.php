<?php
/* Smarty version 3.1.40, created on 2022-08-16 14:12:40
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/gestion_sistema/templates/usuarios/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_62fba5d8541cb1_15270599',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47923323eb4444f491a487c2425fc74107b4883a' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/gestion_sistema/templates/usuarios/index.tpl',
      1 => 1602619082,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62fba5d8541cb1_15270599 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Usuarios

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
                        <th style="width: auto;">Rol</th>
                        <th style="width: 50px;">Activo</th>
                        <th style="width: 100px;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="5">
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
                <h5 class="mb-0">Nuevo usuario</h5>
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

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuevo-input-correo" class="mb-0">Correo</label>
                            <input type="email" class="form-control" placeholder="Correo..." name="correo" id="nuevo-input-correo" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuevo-input-clave" class="mb-0">Contraseña</label>
                            <input type="password" class="form-control" placeholder="Contraseña..." name="clave" id="nuevo-input-clave" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="nuevo-input-idRol" class="mb-0">Rol</label>
                            <select class="form-control" name="idRol" id="nuevo-input-idRol" required>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roles']->value, 'rol');
$_smarty_tpl->tpl_vars['rol']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rol']->value) {
$_smarty_tpl->tpl_vars['rol']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['rol']->value['idRol'];?>
"><?php echo $_smarty_tpl->tpl_vars['rol']->value['nombre'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="nuevo-input-activo" name="activo" checked>
                            <label class="custom-control-label" for="nuevo-input-activo">Activo</label>
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

<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modal-eliminar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-eliminar">
            <div class="modal-header bg-danger text-white">
                <h5 class="mb-0">Eliminar usuario</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <label>¿Esta seguro que desea eliminar el usuario de <b id="eliminar-label-nombre"></b>?</label>
                <input type="hidden" name="idUsuario" id="eliminar-input-idUsuario">
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
