<div class="m-2 p-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Empresas
            </h5>
        </div>

        <div class="card-body">
            <div class="alert alert-info">
                <div class="h5 mb-0">Filtros</div>
                <hr>
                <div class="row">
                    <div class="form-group col-12 col-md-6 mb-3 mb-md-0">
                        <label class="mb-0">Mostrar al que tenga el periodo contable:</label>
                        <select name="" id="filtro-incluir-periodo" class="form-control form-control-sm">
                            <option value="">General</option>
                            {foreach from=$periodos item="periodo"}
                                <option value="{$periodo['idPeriodoContable']}">{$periodo['nombre']}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-6 mb-0">
                        <label class="mb-0">Mostrar al que falte por el periodo contable:</label>
                        <select name="" id="filtro-excluir-periodo" class="form-control form-control-sm">
                            <option value="">General</option>
                            {foreach from=$periodos item="periodo"}
                                <option value="{$periodo['idPeriodoContable']}">{$periodo['nombre']}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm" style="width: 100%;" id="tabla">
                    <thead>
                        <tr>
                            <th style="width: 25px;">Id</th>
                            <th style="width: 100px;">RUT</th>
                            <th style="width: auto;">Nombre</th>
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
</div>