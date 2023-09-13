<script>
    const EMPRESAS = JSON.parse(`{$empresasJson}`);
</script>

<div class="m-2 p-2">
    <form class="card" id="form-nuevo">
        <div class="card-header bg-primary text-white">
            <div class="float-left">
                <a href="{$base_url}/Facturas/Index/">
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
                            {foreach from=$empresas item="empresa"}
                                <option value="{$empresa.idEmpresa}">
                                    {$empresa.razon_social} [{$empresa.rut}]
                                </option>
                            {/foreach}
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
                            {foreach from=$periodosCobros item="periodoCobro"}
                                <option value="{$periodoCobro.idPeriodoContable}">
                                    {$periodoCobro.nombre}
                                </option>
                            {/foreach}
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
                            {foreach from=$servicios item="servicio"}
                                <option value="{$servicio.id}">
                                    {$servicio.nombre}
                                </option>
                            {/foreach}
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
                        <input type="date" name="fechaCobro" id="input-fechaCobro" class="form-control" required value="{$smarty.now|date_format:'%Y-%m-%d'}">
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
                                <input type="text" class="form-control bg-warning" disabled value="{$statusPendiente->nombre}">
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
                            {foreach from=$centrosCosto item="centro"}
                                <option value="{$centro.idCentroCosto}">{$centro.nombre}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Usuario que registra</label>
                        <input type="text" class="form-control" disabled value="{Sesion::Usuario()->nombre}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-center">
            <a class="btn btn-outline-secondary" style="width: 100px;" href="{$base_url}/Facturas/Index/">
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
</div>