<?php
/* Smarty version 3.1.40, created on 2022-05-02 14:53:21
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/tareas/templates/ver.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_626ff0619a5f08_81431057',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa6ec75c18f44a25f9015b3bbe884c7401b92074' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/tareas/templates/ver.html',
      1 => 1632242582,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_626ff0619a5f08_81431057 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/arsddfnz/gestion.santiagocontadores.cl/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<script'; ?>
>
    const ID = `<?php echo $_smarty_tpl->tpl_vars['tarea']->value->id;?>
`;
    const CAMBIOS = JSON.parse(`<?php echo $_smarty_tpl->tpl_vars['json_cambios']->value;?>
`);
<?php echo '</script'; ?>
>

<div class="px-2 pb-3">
    <form class="card mb-3" id="form-datos">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Tarea N° <?php echo $_smarty_tpl->tpl_vars['tarea']->value->id;?>
</h5>
                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Tareas/">Volver</a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label class="mb-0">ID</label>
                    <input type="text" disabled class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['tarea']->value->id;?>
" />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label class="mb-0">Empresa</label>
                    <select required name="empresa" class="form-control">
                        <option value="">Seleccione una empresa...</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['empresas']->value, 'empresa');
$_smarty_tpl->tpl_vars['empresa']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['empresa']->value) {
$_smarty_tpl->tpl_vars['empresa']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['empresa']->value['idEmpresa'];?>
" <?php echo $_smarty_tpl->tpl_vars['empresa']->value['idEmpresa'] == $_smarty_tpl->tpl_vars['objEmpresa']->value->id ? 'selected' : '';?>
>
                                <?php echo $_smarty_tpl->tpl_vars['empresa']->value['razon_social'];?>

                            </option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label class="mb-0">Asignado a</label>
                    <select required name="usuario" class="form-control">
                        <option value="">Seleccione un usuario...</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['usuarios']->value, 'usuario');
$_smarty_tpl->tpl_vars['usuario']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['usuario']->value) {
$_smarty_tpl->tpl_vars['usuario']->do_else = false;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value['idUsuario'];?>
" <?php echo $_smarty_tpl->tpl_vars['usuario']->value['idUsuario'] == $_smarty_tpl->tpl_vars['objUsuario']->value->id ? 'selected' : '';?>
>
                                <?php echo $_smarty_tpl->tpl_vars['usuario']->value['nombre'];?>

                            </option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label class="mb-0">Creado el</label>
                    <input type="date" disabled class="form-control" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['tarea']->value->created_at,'%Y-%m-%d');?>
" />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label class="mb-0">Vence el</label>
                    <input type="date" required name="fecha_vencimiento" class="form-control" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['tarea']->value->fecha_vencimiento,'%Y-%m-%d');?>
" />
                </div>
                <div class="form-group col-12 col-md-6">
                    <label class="mb-0">Estado</label>
                    <input type="text" disabled class="form-control bg-<?php echo $_smarty_tpl->tpl_vars['estado']->value->color_class;?>
 text-white" value="<?php echo $_smarty_tpl->tpl_vars['estado']->value->nombre;?>
" />
                </div>
                <div class="form-group col-12 mb-0">
                    <label class="mb-0">Detalle</label>
                    <textarea class="form-control" name="descripcion" required cols="30" rows="3"><?php echo $_smarty_tpl->tpl_vars['tarea']->value->descripcion;?>
</textarea>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <?php if ($_smarty_tpl->tpl_vars['estado']->value->id == '1') {?>
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-anular" style="width: 100px;">Anular</button>
                <button class="btn btn-primary" type="button" onclick="cerrar()" style="width: 100px;">Cerrar</button>
                <button class="btn btn-success" type="submit" style="width: 100px;">Actualizar</button>
            <?php } elseif ($_smarty_tpl->tpl_vars['estado']->value->id == '2') {?>
                <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modal-anular" style="width: 100px;">Anular</button>
                <button class="btn btn-primary" type="button" onclick="cerrar()" style="width: 100px;">Cerrar</button>
                <button class="btn btn-success" type="submit" style="width: 100px;">Actualizar</button>
            <?php } elseif ($_smarty_tpl->tpl_vars['estado']->value->id == '3') {?>

            <?php } else { ?>
                <button class="btn btn-primary" type="button" onclick="abrir()" style="width: 100px;">Abrir</button>
            <?php }?>
        </div>
    </form>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Historial</h5>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-nuevo">
                    <i class="fas fa-plus"></i> Nuevo
                </button>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-striped table-hover mb-0 w-100">
                    <thead>
                        <tr>
                            <th style="width: 175px;">Fecha</th>
                            <th style="width: 200px;">Usuario</th>
                            <th style="width: auto;">Comentario</th>
                            <th style="width: 50px;">Opc.</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php if (count($_smarty_tpl->tpl_vars['cambios']->value) > 0) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cambios']->value, 'cambio');
$_smarty_tpl->tpl_vars['cambio']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['cambio']->value) {
$_smarty_tpl->tpl_vars['cambio']->do_else = false;
?>
                                <tr <?php if ($_smarty_tpl->tpl_vars['cambio']->value['anulado'] == '1') {?> class="table-danger" <?php }?>>
                                    <td class="text-center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['cambio']->value['created_at'],"%d/%m/%Y - %H:%M:%S");?>
</td>
                                    <td class="text-left"><?php echo $_smarty_tpl->tpl_vars['cambio']->value['usuario']->nombre;?>
</td>
                                    <td class="text-left"><?php echo $_smarty_tpl->tpl_vars['cambio']->value['comentario'];?>
</td>
                                    <td class="text-center">
                                        <?php if ($_smarty_tpl->tpl_vars['cambio']->value['anulado'] == '0') {?>
                                            <button class="btn btn-sm btn-danger" onclick="modal_anular_accion(`<?php echo $_smarty_tpl->tpl_vars['cambio']->value['id'];?>
`)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-danger" disabled>
                                                <i class="fas fa-times"></i>
                                            </button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                                <tr>
                                    <td colspan="100">
                                        <h5 class="text-center mb-0 p-3">No hay cambios registrados.</h5>
                                    </td>
                                </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL ANULAR -->
<div class="modal fade" id="modal-anular">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="mb-0">Anular Tarea</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="anular-input-id">
                <label>¿Esta seguro que desea anular la tarea <b>N° <?php echo $_smarty_tpl->tpl_vars['tarea']->value->id;?>
</b>?</label>

                <div class="form-group mb-0">
                    <b class="mb-0">Justificación:</b>
                    <textarea class="form-control" id="anular-justificacion" cols="30" rows="3" placeholder="Justificación..."></textarea>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary w-100px" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" onclick="anular()" class="btn btn-danger w-100px">
                    Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL ANULAR -->

<!-- MODAL NUEVO -->
<div class="modal fade" id="modal-nuevo">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-nuevo">
            <div class="modal-header bg-primary text-white">
                <h5 class="mb-0">Nueva acción</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p>Agregar una acción o comentario a la tarea actual:</p>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-0">
                            <b class="mb-0">Acción o Comentario</b>
                            <textarea class="form-control" placeholder="Acción o Comentario..." name="comentario" required cols="30" rows="3"></textarea>
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

<!-- MODAL ANULAR ACCION -->
<div class="modal fade" id="modal-anular_accion">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-anular_accion">
            <div class="modal-header bg-danger text-white">
                <h5 class="mb-0">Anular Acción</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="anular_accion-input-id">
                <label>Esta apunto de anular la siguiente acción del historial:</label><br>
                <label class="mb-0">
                    <b>Fecha:</b> <span id="anular_accion-label-fecha"></span><br>
                    <b>Usuario:</b> <span id="anular_accion-label-usuario"></span><br>
                    <b>Comentario:</b> <span id="anular_accion-label-comentario"></span><br>
                </label>
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
<!-- FIN MODAL ANULAR ACCION --><?php }
}
