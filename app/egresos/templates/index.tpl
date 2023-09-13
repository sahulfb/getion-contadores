<div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Egresos

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
                            <div class="col-12 col-md-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Fecha desde</div>
                                    </div>
                                    <input type="date" class="form-control border-right-0" id="filter-fecha-desde">
    
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Hasta</div>
                                    </div>
                                    <input type="date" class="form-control" id="filter-fecha-hasta">
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Centro de costo</div>
                                    </div>
                                    <select class="form-control" id="filter-centro">
                                        <option value="">General</option>
                                        {foreach from=$centrosCosto item="centroCosto"}
                                        <option value="{$centroCosto.idCentroCosto}">{$centroCosto.nombre}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-hover table-sm" style="width: 100%;" id="tabla">
                <thead>
                    <tr>
                        <th style="width: 25px;">Id</th>
                        <th style="width: 100px;">Fecha</th>
                        <th style="width: auto;">Detalle</th>
                        <th style="width: 150px;">Monto en CLP</th>
                        <th style="width: 150px;">Centro de costo</th>
                        <th style="width: 100px">Status</th>
                        <th style="width: 100px;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="7">
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
                <h5 class="mb-0">Nuevo egreso</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuevo-input-fecha" class="mb-0">Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="nuevo-input-fecha" required value="{$smarty.now|date_format:'%Y-%m-%d'}">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuevo-input-detalle" class="mb-0">Detalle</label>
                            <input type="text" class="form-control" placeholder="Detalle..." name="detalle" id="nuevo-input-detalle" required>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuevo-input-montoCLP" class="mb-0">Monto CLP</label>
                            <input type="number" class="form-control" placeholder="Monto CLP..." name="montoCLP" id="nuevo-input-montoCLP" required step="{(1 / pow(10, $objMonedaCLP->decimales))}">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="nuevo-input-idCentroCosto" class="mb-0">Centro de costo</label>
                            <select class="form-control" name="idCentroCosto" id="nuevo-input-idCentroCosto" required>
                                <option value="">Centro de costo...</option>
                                {foreach from=$centrosCosto item="centroCosto"}
                                    <option value="{$centroCosto.idCentroCosto}">{$centroCosto.nombre}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="nuevo-input-observacion" class="mb-0">Observaciones</label>
                            <textarea class="form-control" placeholder="Observaciones..." name="observacion" id="nuevo-input-observacion" cols="30" rows="3"></textarea>
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

<!-- MODAL EDITAR -->
<div class="modal fade" id="modal-editar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-editar">
            <input type="hidden" name="idEgreso" id="editar-input-idEgreso">

            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Modificar egreso</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="editar-input-fecha" class="mb-0">Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="editar-input-fecha" required value="{$smarty.now|date_format:'%Y-%m-%d'}">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="editar-input-detalle" class="mb-0">Detalle</label>
                            <input type="text" class="form-control" placeholder="Detalle..." name="detalle" id="editar-input-detalle" required>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="editar-input-montoCLP" class="mb-0">Monto CLP</label>
                            <input type="number" class="form-control" placeholder="Monto CLP..." name="montoCLP" id="editar-input-montoCLP" required step="{(1 / pow(10, $objMonedaCLP->decimales))}">
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="editar-input-idCentroCosto" class="mb-0">Centro de costo</label>
                            <select class="form-control" name="idCentroCosto" id="editar-input-idCentroCosto" required>
                                <option value="">Centro de costo...</option>
                                {foreach from=$centrosCosto item="centroCosto"}
                                    <option value="{$centroCosto.idCentroCosto}">{$centroCosto.nombre}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="editar-input-observacion" class="mb-0">Observaciones</label>
                            <textarea class="form-control" placeholder="Observaciones..." name="observacion" id="editar-input-observacion" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary w-100px" data-dismiss="modal">
                    Cerrar
                </button>

                <button type="submit" class="btn btn-success w-100px">
                    Registrar
                </button>
            </div>
        </form>
    </div>
</div>
<!-- FIN MODAL EDITAR -->

<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modal-eliminar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-eliminar">
            <div class="modal-header bg-danger text-white">
                <h5 class="mb-0">Anular egreso</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="idEgreso" id="eliminar-input-idEgreso">
                <label>¿Esta seguro que desea anular el egreso <b id="eliminar-label-id"></b>?</label>
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
<!-- FIN MODAL ELIMINAR -->