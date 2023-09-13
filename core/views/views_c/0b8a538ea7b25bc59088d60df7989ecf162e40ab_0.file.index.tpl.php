<?php
/* Smarty version 3.1.40, created on 2022-01-07 20:44:17
  from '/home/arsddfnz/gestion.santiagocontadores.cl/app/reportes/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61d8a6216bb7e8_82867851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b8a538ea7b25bc59088d60df7989ecf162e40ab' => 
    array (
      0 => '/home/arsddfnz/gestion.santiagocontadores.cl/app/reportes/templates/index.tpl',
      1 => 1632247154,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61d8a6216bb7e8_82867851 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="m-2 p-2">
    <form class="row mb-3" id="form-filtro">
        <div class="col-12 col-sm-6 col-lg-3 mb-3 mb-sm-0">
            <label class="mb-1">Desde</label>
            <input type="month" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['today']->value;?>
" name="fecha_inicio">
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <label class="mb-1">Hasta</label>
            <input type="month" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['next_month']->value;?>
" name="fecha_fin">
        </div>
    </form>

    <hr>

    <div class="row">
        <!-- Ventas pendientes de pago -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card mb-3 bg-warning text-black">
                <div class="card-header">
                    <div class="font-weight-bold mb-0">Ventas pendientes de pago</div>
                </div>

                <div class="card-body">
                    <div class="h6 mb-0 w-100">
                        <label class="h4" id="monto-ventas_pendientes">. . .</label>
                        <label style="position: relative; top: -5px;">CLP</label>

                        <div class="float-right">
                            <button class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapse-card-1">
                                <i class="fas fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-footer collapse p-0 m-0" id="collapse-card-1">
                    <div class="small m-0 p-2">
                        Son todos con status pendientes y vencidos.
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventas con pago vencido -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card mb-3 bg-warning text-black">
                <div class="card-header">
                    <div class="font-weight-bold mb-0">Ventas con pago vencido</div>
                </div>

                <div class="card-body">
                    <div class="h6 mb-0 w-100">
                        <label class="h4" id="monto-ventas_vencidas">. . .</label>
                        <label style="position: relative; top: -5px;">CLP</label>

                        <div class="float-right">
                            <button class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapse-card-2">
                                <i class="fas fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-footer collapse p-0 m-0" id="collapse-card-2">
                    <div class="small m-0 p-2">
                        Son todas las ventas con status vencido.
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventas facturadas año en curso -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card mb-3 bg-warning text-black">
                <div class="card-header">
                    <div class="font-weight-bold mb-0">Ventas facturadas año en curso</div>
                </div>

                <div class="card-body">
                    <div class="h6 mb-0 w-100">
                        <label class="h4" id="monto-ventas_ano_curso">. . .</label>
                        <label style="position: relative; top: -5px;">CLP</label>

                        <div class="float-right">
                            <button class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapse-card-3">
                                <i class="fas fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-footer collapse p-0 m-0" id="collapse-card-3">
                    <div class="small m-0 p-2">
                        Son todas las ventas con status Pagado, vencido y pendiente.
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Ventas facturadas -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card mb-3 bg-primary text-black">
                <div class="card-header">
                    <div class="font-weight-bold mb-0">Ventas facturadas</div>
                </div>

                <div class="card-body">
                    <div class="h6 mb-0 w-100">
                        <label class="h4" id="monto-ventas">. . .</label>
                        <label style="position: relative; top: -5px;">CLP</label>

                        <div class="float-right">
                            <button class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapse-card-4">
                                <i class="fas fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-footer collapse p-0 m-0" id="collapse-card-4">
                    <div class="small m-0 p-2">
                        Son todas las ventas con status pagado dentro del rango de fecha.
                    </div>
                </div>
            </div>
        </div>

        <!-- Egresos -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card mb-3 bg-success text-black">
                <div class="card-header">
                    <div class="font-weight-bold mb-0">Egresos</div>
                </div>

                <div class="card-body">
                    <div class="h6 mb-0 w-100">
                        <label class="h4" id="monto-egresos">. . .</label>
                        <label style="position: relative; top: -5px;">CLP</label>

                        <div class="float-right">
                            <button class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapse-card-5">
                                <i class="fas fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-footer collapse p-0 m-0" id="collapse-card-5">
                    <div class="small m-0 p-2">
                        Son todos los egresos dentro del rango de fecha sin considerar anulados y gastos personales Jose.
                    </div>
                </div>
            </div>
        </div>

        <!-- Utilidades -->
        <div class="col-12 col-sm-6 col-md-4">
            <div class="card mb-3 bg-info text-black">
                <div class="card-header">
                    <div class="font-weight-bold mb-0">Utilidades</div>
                </div>

                <div class="card-body">
                    <div class="h6 mb-0 w-100">
                        <label class="h4" id="monto-utilidades">. . .</label>
                        <label style="position: relative; top: -5px;">CLP</label>

                        <div class="float-right">
                            <button class="btn btn-sm btn-dark" data-toggle="collapse" data-target="#collapse-card-6">
                                <i class="fas fa-info"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-footer collapse p-0 m-0" id="collapse-card-6">
                    <div class="small m-0 p-2">
                        Resultado de la resta entre Ventas facturadas y egresos
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php }
}
