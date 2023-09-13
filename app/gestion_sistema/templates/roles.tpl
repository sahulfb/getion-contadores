<div class="p-2 m-2">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Roles

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
            <table class="table table-bordered table-striped table-hover" style="width: 100%;" id="tabla">
                <thead class="table-sm">
                    <tr>
                        <th style="width: 25px;">Id</th>
                        <th style="width: auto;">Nombre</th>
                        <th style="width: auto;">Descripción</th>
                        <th style="width: 100px;">Opciones</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="4">
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
                <h5 class="mb-0">Nuevo rol</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nuevo-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="nuevo-input-nombre" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="nuevo-input-descripcion" class="mb-0">Descripción</label>
                            <input type="text" class="form-control" placeholder="Descripción..." name="descripcion" id="nuevo-input-descripcion">
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
            <input type="hidden" name="idRol" id="editar-input-idRol">

            <div class="modal-header bg-success text-white">
                <h5 class="mb-0">Modificar rol</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="editar-input-nombre" class="mb-0">Nombre</label>
                            <input type="text" class="form-control" placeholder="Nombre..." name="nombre" id="editar-input-nombre" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="editar-input-descripcion" class="mb-0">Descripción</label>
                            <input type="text" class="form-control" placeholder="Descripción..." name="descripcion" id="editar-input-descripcion">
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

<!-- MODAL PERMISOS -->
<div class="modal fade" id="modal-permisos">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="mb-0">Permisos de <label id="permisos-label-nombre"></label></h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: auto;">Menu</th>
                                <th style="width: 100px;">Permiso</th>
                            </tr>
                        </thead>

                        <tbody id="permisos-tbody">
                            <tr>
                                <td colspan="2">
                                    <h5 class="mb-0 p-2 text-center">. . .</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-outline-secondary w-100px" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL PERMISOS -->

<!-- MODAL ELIMINAR -->
<div class="modal fade" id="modal-eliminar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="modal-content" id="form-eliminar">
            <div class="modal-header bg-danger text-white">
                <h5 class="mb-0">Eliminar rol</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="idRol" id="eliminar-input-idRol">
                <label>¿Esta seguro que desea eliminar el rol <b id="eliminar-label-nombre"></b>?</label>
                <br>
                <div class="form-group">
                    <label class="mb-0">Seleccione un rol para sustituir al que se elimina:</label>
                    <select name="idRolSustituto" id="eliminar-input-idRolSustituto" class="form-control" required>
                        {foreach from=$roles item=rol}
                            <option value="{$rol.idRol}">{$rol.nombre}</option>
                        {/foreach}
                    </select>
                </div>
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