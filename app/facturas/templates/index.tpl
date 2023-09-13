<div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                {$titulo}

                <div class="datatable-header-options">
                    <a href="{$base_url}/Facturas/Nuevo/">
                        <button class="float-left">
                            <i class="fas fa-plus"></i>
                        </button>
                    </a>

                    <button onclick="RefrescarTabla()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </h5>
        </div>

        <div class="card-body">
            <div class="collapse" id="filtros">
                <div class="card mb-3">
                    <div class="card-header p-2">
                        <div class="mb-0">
                            Filtros
                            <button class="close" data-toggle="collapse" data-target="#filtros">&times;</button>
                        </div>
                    </div>

                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <div class="small {if !$con_filtros}d-none{/if}">Status:</div>
                                <div class="row {if !$con_filtros}d-none{/if}">
                                    {foreach from=$status item="statu"}
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" {if $status_defecto == $statu.idStatus}checked{/if} id="filter-status-{$statu.idStatus}" value="{$statu.idStatus}">
                                            <label class="custom-control-label" for="filter-status-{$statu.idStatus}">{$statu.nombre}</label>
                                        </div>
                                    </div>
                                    {/foreach}
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="form-group mb-0">
                                            <label class="mb-0">Empresas</label>
                                            <select class="form-control" style="width: 100%;" id="filter-empresa">
                                                <option value="">General</option>
                                                {foreach from=$empresas item="empresa"}
                                                <option value="{$empresa.idEmpresa}">{$empresa.razon_social}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Desde</div>
                                            </div>
                                            <input type="date" class="form-control border-right-0" id="filter-fecha-desde">
            
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Hasta</div>
                                            </div>
                                            <input type="date" class="form-control" id="filter-fecha-hasta">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" style="width: 100%;" id="tabla">
                <thead>
                    <tr>
                        <th class="text-truncate" style="width: 25px;">Id</th>
                        <th class="text-truncate" style="width: 100px;">Fecha cobro</th>
                        <th class="text-truncate" style="width: 100px;">Periodo contable</th>
                        <th class="text-truncate" style="width: auto;">Empresa</th>
                        <th class="text-truncate" style="width: 50px;">N° factura</th>
                        <th class="text-truncate" style="width: 150px;">Servicio</th>
                        <th class="text-truncate" style="width: 100px;">Valor a cobrar</th>
                        <th class="text-truncate" style="width: 50px;">Con Mov.</th>
                        <th class="text-truncate" style="width: 100px;">Fecha venc.</th>
                        <th class="text-truncate" style="width: 100px;">Status</th>
                        <th class="text-truncate" style="width: 50px;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="100">
                            <h5 class="mb-0 text-center p-2">. . .</h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>