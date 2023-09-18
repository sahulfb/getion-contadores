<script>
    const ID_FACTURA = '{$objFactura->id}';
    const COBROS_ADICIONALES = JSON.parse(`{$cobros_adicionales}`);
    const VALOR_PLAN = `{$objFactura->planValue}`;
    const STATUS_FACTURA = JSON.parse(`{$json_objStatus}`);
</script>

<div class="m-2 p-2">
    <form class="card" id="form-modificar">
        <div class="card-header bg-primary text-white">
            <div class="float-left">
                <a href="{$base_url}/Facturas/Index/">
                    <div class="text-white pr-2">
                        <i class="fas fa-sm fa-arrow-left"></i>
                    </div>
                </a>
            </div>

            <h5 class="mb-0">Factura ID {$objFactura->id}</h5>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- ROW 1 -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="mb-0">Empresa<b class="text-danger">*</b></label>
                        <input type="text" class="form-control form-control-sm text-black" disabled value="{$objEmpresa->razon_social} [{$objEmpresa->rut}]">
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label class="mb-0">Tipo plan<b class="text-danger">*</b></label>
                        <input type="text" class="form-control form-control-sm text-black" disabled value="{$tipo_plan}">
                    </div>
                </div>

                <!-- ROW 2 -->
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Plan Contratado</label>
                        <input type="text" class="form-control form-control-sm text-black" disabled value="{($plan.nombre == NULL) ? 'No asignado' : $plan.nombre}">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Valor Plan CLP</label>
                        <input type="text" class="form-control form-control-sm text-right text-black" disabled value="{$objFactura->valorPlan}">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Periodo de cobro<b class="text-danger">*</b></label>
                        <input type="text" class="form-control form-control-sm" disabled value="{$objPeriodo->nombre}">
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
                            {foreach from=$servicios item="servicio"}
                                {if $servicio.id == $objFactura->idServicio}
                                    <option value="{$servicio.id}" selected>
                                        {$servicio.nombre}
                                    </option>
                                {else}
                                    <option value="{$servicio.id}">
                                        {$servicio.nombre}
                                    </option>
                                {/if}
                            {/foreach}
                        </select>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-valorCobrar" class="mb-0">Valor a Cobrar<b class="text-danger">*</b></label>
                        <div class="input-group input-group-sm">
                            <input type="number" id="input-valorCobrar" {($objFactura->idStatus == '1' OR $objFactura->idStatus == '2') ? 'required' : 'disabled'} name="valorCobrar" class="form-control text-right" value="{$objFactura->valorCobrar}" step="{1 / (pow(10, $objMonedaCLP->decimales))}">
                            <div class="input-group-append">
                                <div class="input-group-text">{$objMonedaCLP->simbolo}</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ROW 4 -->
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-numeroFactura" class="mb-0">N° Factura<b class="text-danger">*</b></label>
                        <input type="text" id="input-numeroFactura" {($objFactura->idStatus == '1' OR $objFactura->idStatus == '2') ? 'required' : 'disabled'} name="numeroFactura" class="form-control form-control-sm" value="{$objFactura->numeroFactura}">
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-fechaCobro" class="mb-0">Fecha de cobro<b class="text-danger">*</b></label>
                        <input type="date" id="input-fechaCobro" {($objFactura->idStatus == '1' OR $objFactura->idStatus == '2') ? 'required' : 'disabled'} name="fechaCobro" class="form-control form-control-sm" value="{$objFactura->fechaCobro}">
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="input-fechaVencimiento" class="mb-0">Fecha Vencimiento<b class="text-danger">*</b></label>
                        <input type="date" id="input-fechaVencimiento" {($objFactura->idStatus == '1' OR $objFactura->idStatus == '2') ? 'required' : 'disabled'} name="fechaVencimiento" class="form-control form-control-sm" value="{$objFactura->fechaVencimiento}">
                    </div>
                </div>
                
                <!-- ROW 5 -->
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12 col-mb-6">
                            <div class="form-group">
                                <label class="mb-0">Status</label>
                                <input type="text" class="form-control form-control-sm bg-white text-black" idStatus="{$objStatus->id}" disabled value="{$objStatus->nombre}" id="input-status">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-observacion" class="mb-0">Observación</label>
                        <textarea name="observacion" id="input-observacion" class="form-control form-control-sm" placeholder="Observación..." {($objFactura->idStatus == '1' OR $objFactura->idStatus == '2') ? '' : 'disabled'} cols="30" rows="4">{$objFactura->observacion}</textarea>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="input-observacion" class="mb-0">Centro de costo<b class="text-danger">*</b></label>
                        <select name="centroCosto" id="input-centroCosto" class="form-control form-control-sm" {($objFactura->idStatus == '1' OR $objFactura->idStatus == '2') ? 'required' : 'disabled'}>
                            <option value="">Seleccione el centro de costo...</option>
                            {foreach from=$centrosCosto item="centro"}
                                {if $objCentroCosto->id == $centro.idCentroCosto}
                                    <option value="{$centro.idCentroCosto}" selected>{$centro.nombre}</option>
                                {else}
                                    <option value="{$centro.idCentroCosto}">{$centro.nombre}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label class="mb-0">Registrado por</label>
                        <input type="text" class="form-control form-control-sm" disabled value="{$objUsuario->nombre}">
                    </div>
                </div>

                {if $metodoPago != NULL && $fechaPago != NULL}
                    <div class="col-12 col-md-6">
                        <div class="form-group mb-0">
                            <label class="mb-0">Metodo de pago</label>
                            <input type="text" class="form-control form-control-sm" disabled value="{$metodoPago}">
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group mb-0">
                            <label class="mb-0">Fecha de pago</label>
                            <input type="text" class="form-control form-control-sm" disabled value="{Formato::Fecha($fechaPago)}">
                        </div>
                    </div>
                {/if}
            </div>
        </div>

        <div class="card-footer text-center">
            <a type="button" href="{$base_url}/Facturas/Index/" class="btn btn-outline-secondary" style="width: 100px;">
                Volver
            </a>

            {if $objFactura->idStatus == '1' OR $objFactura->idStatus == '2'}
            <button type="button" class="btn btn-danger" style="width: 100px;" id="boton-anular">
                Anular
            </button>
            
            <button type="submit" class="btn btn-primary" style="width: 100px;" id="boton-actualizar">
                Actualizar
            </button>

            <button type="button" class="btn btn-success" style="width: 100px;" id="boton-pagar">
                Pagar
            </button>

               <button type="button" class="btn btn-danger" style="width: 100px;" id="boton-dicom">
               Dicom
            </button>
            {/if}
        </div>
    </form>
</div>

<div class="modal fade" id="modal-pagar">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <form class="modal-content" id="form-pagar">
            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Pagar factura N° {$objFactura->id}</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="pagar-input-idMetodoPago" class="mb-0">Metodo de pago</label>
                            <select name="idMetodoPago" id="pagar-input-idMetodoPago" class="form-control" required>
                                <option value="">Metodos de pagos...</option>
                                {foreach from=$metodosPagos item="metodopago"}
                                    <option value="{$metodopago.idMetodoPago}">{$metodopago.nombre}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label for="pagar-input-fechaPago" class="mb-0">Metodo de pago</label>
                            <input type="date" name="fechaPago" id="pagar-input-fechaPago" class="form-control" value="{$smarty.now|date_format:'%Y-%m-%d'}">
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
</div>