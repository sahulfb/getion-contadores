<?php
/* Smarty version 3.1.40, created on 2022-01-03 12:32:03
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/monedas/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61d2ecc3d615d6_18482831',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8e61a4b4bd427b2b4a6dcc0034d61d61da43424' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/monedas/templates/index.tpl',
      1 => 1603694810,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61d2ecc3d615d6_18482831 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/arsddfnz/gestion.santiagocontadores.cl/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<div class="m-2 p-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Monedas</h5>
        </div>

        <div class="card-body">
            <div class="alert alert-info">
                Presione <b>Click Izquierdo</b> para actualizar precio.<br>
                Presione <b>Click Derecho</b> para actualizar datos<br>
            </div>

            <div class="row" id="rowBody">
                <div class="col-12">
                    <div class="card card-body text-center bg-light">
                        <h5 class="mb-0">. . .</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-modificar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-modificar">
            <input type="hidden" name="idMoneda" id="editar-input-idMoneda">
            <div class="modal-header bg-primary text-white">
                <h5 class="mb-0">Modificar moneda</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="editar-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" id="editar-input-nombre" name="nombre" placeholder="Nombre..." required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="editar-input-simbolo" class="mb-0">Simbolo</label>
                            <input type="text" class="form-control" id="editar-input-simbolo" name="simbolo" placeholder="Simbolo..." required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="editar-input-decimales" class="mb-0">Decimales</label>
                            <input type="number" step="1" class="form-control" id="editar-input-decimales" name="decimales" min="0" max="10" placeholder="Decimales..." required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" style="width: 100px;" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" class="btn btn-primary" style="width: 100px;">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-actualizar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-actualizar">
            <input type="hidden" name="idMoneda" id="actualizar-input-idMoneda">
            <div class="modal-header bg-primary text-white">
                <h5 class="mb-0">Actualizar moneda</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="actualizar-input-fecha" class="mb-0">Fecha</label>
                            <input type="date" class="form-control" id="actualizar-input-fecha" value="<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d');?>
">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="mb-3">
                            <button type="button" onclick="BuscarMindicador()" class="btn btn-primary w-100">Actualizar</button>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="actualizar-input-monto" class="mb-0">Monto</label>
                            <input type="number" class="form-control" id="actualizar-input-monto" step="0.01" name="precioCLP">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary" style="width: 100px;" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" class="btn btn-primary" style="width: 100px;">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div><?php }
}
