<div class="px-2 d-flex justify-content-between align-items-center">
    <h3><span class="text-muted">Empresa</span> - {$empresa->razon_social}</h3>

    <a href="{$base_url}/Facturas/Por_Generar/">Volver</a>
</div>

<div class="px-2">
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title mb-0">Datos</div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3 mb-3 mb-md-0 form-group">
                    <label class="mb-0">RUT</label>
                    <input type="text" class="form-control" disabled value="{$empresa->rut}">
                </div>
                <div class="col-12 col-md-9 form-group">
                    <label class="mb-0">Razon social</label>
                    <input type="text" class="form-control" disabled value="{$empresa->razon_social}">
                </div>
                <div class="col-12 form-group mb-3">
                    <label class="mb-0">Correo</label>
                    <input type="text" class="form-control" disabled value="{$empresa->correo}">
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 form-group">
                    <label class="mb-0">Plan con movimiento</label>
                    <input type="text" class="form-control" disabled value="{$plan.nombre}">
                </div>
                <div class="col-12 form-group mb-3">
                    <label class="mb-0">Detalle</label>
                    <textarea class="form-control" disabled cols="30" rows="3">{$plan.detalle}</textarea>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 form-group">
                    <label class="mb-0">Plan sin movimiento</label>
                    <input type="text" class="form-control" disabled value="{$plan_sinMovimiento.nombre}">
                </div>
                <div class="col-12 form-group mb-0">
                    <label class="mb-0">Detalle</label>
                    <textarea class="form-control" disabled cols="30" rows="3">{$plan_sinMovimiento.detalle}</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card mb-3">
        <div class="card-header">
            <div class="card-title mb-0">Facturas</div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped table-bordered mb-0 w-100">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Fecha de cobro</th>
                            <th>Periodo contable</th>
                            <th>N° factura</th>
                            <th>Valor a cobrar</th>
                            <th>Fecha Venc.</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {if $facturas|@count > 0}
                            {foreach from=$facturas item="factura"}
                            <tr>
                                <td class="text-center">{$factura.idFactura}</td>
                                <td class="text-center">{$factura.fechaCobro|@date_format:'d/m/Y'}</td>
                                <td class="text-left">{$factura.periodo_contable->nombre}</td>
                                <td class="text-right">{$factura.numeroFactura}</td>
                                <td class="text-right">{$factura.valorCobrar|@number_format:0:',':'.'}</td>
                                <td class="text-center">{$factura.fechaVencimiento}</td>
                                <td class="text-center">{$factura.status->nombre}</td>
                            </tr>
                            {/foreach}
                        {else}
                            <tr>
                                <td colspan="100">
                                    <h5 class="mb-0 p-3 text-center">
                                        No hay facturas registradas a esta empresa.
                                    </h5>
                                </td>
                            </tr>
                        {/if}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<br>