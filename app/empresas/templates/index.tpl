<div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Empresas

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
            <table class="table table-bordered table-striped table-hover table-sm" style="width: 100%;" id="tabla">
                <thead>
                    <tr>
                        <th style="width: 25px;">Id</th>
                        <th style="width: 100px;">RUT</th>
                        <th style="width: auto;">Nombre</th>
                        <th style="width: 200px;">Plan con mov.</th>
                        <th style="width: 200px;">Plan sin mov.</th>
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
                <h5 class="mb-0">Nueva empresa</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="nuevo-input-rut" class="mb-0">RUT</label>
                            <input type="text" class="form-control" placeholder="RUT..." name="rut" id="nuevo-input-rut" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label for="nuevo-input-razon_social" class="mb-0">Razon social</label>
                            <input type="text" class="form-control" placeholder="Razon social..." name="razon_social" id="nuevo-input-razon_social" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="nuevo-input-correo" class="mb-0">Correo</label>
                            <input type="email" class="form-control" placeholder="Correo..." name="correo" id="nuevo-input-correo" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="nuevo-input-idPlan" class="mb-0">Plan con movimiento</label>
                            <select name="idPlan" id="nuevo-input-idPlan" class="form-control" required>
                                <option value="">Planes...</option>
                                {foreach from=$planes item="plan"}
                                    <option value="{$plan.idPlan}">{$plan.nombre}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group mb-0">
                            <label for="nuevo-input-idPlan_sinMovimiento" class="mb-0">Plan sin movimiento</label>
                            <select name="idPlan_sinMovimiento" id="nuevo-input-idPlan_sinMovimiento" class="form-control">
                                <option value="">Planes...</option>
                                {foreach from=$planes item="plan"}
                                    <option value="{$plan.idPlan}">{$plan.nombre}</option>
                                {/foreach}
                            </select>
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