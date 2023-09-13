<div class="m-2 p-2">
    <div class="card mb-3">
        <div class="card-body p-3">
            <h5 class="mb-0">
                <a href="{$base_url}/Gestion_Sistema/Usuarios/" class="text-decoration-none">
                    <i class="fas fa-arrow-left pr-1 mr-1"></i>
                </a>

                {$objUsuario->nombre}
            </h5>
        </div>
    </div>

    <form class="row" id="form-datos">
        <input type="hidden" name="idUsuario" value="{$objUsuario->id}">

        <div class="col-12 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Datos personales</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-nombre" class="mb-1">Nombre</label>
                                <input type="text" name="nombre" class="form-control" id="input-nombre" placeholder="Nombre..." value="{$objUsuario->nombre}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h5 class="mb-0">Datos de acceso</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-correo" class="mb-1">Correo:</label>
                                <input type="text" name="correo" class="form-control" id="input-correo" placeholder="Correo..." value="{$objUsuario->correo}">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-clave" class="mb-1">Contraseña</label>
                                <input type="password" name="clave" class="form-control" id="input-clave" placeholder="Contraseña...">
                                <label class="small text-danger mb-0">Complete este campo si desea cambiar la contraseña</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Permisología</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-idRol" class="mb-1">Rol</label>
                                <select class="form-control" name="idRol" id="input-idRol">
                                    {foreach from=$roles item=rol}
                                        {if $rol.idRol == $objUsuario->idRol}
                                        <option value="{$rol.idRol}" selected>{$rol.nombre}</option>
                                        {else}
                                        <option value="{$rol.idRol}">{$rol.nombre}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="activo" class="custom-control-input" id="input-activo" {($objUsuario->activo) ? 'checked' : ''}>
                                <label class="custom-control-label" for="input-activo">Activo</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header border-top">
                    <h5 class="mb-0">Datos de sistema</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                ID:
                                <label class="font-weight-bold">{$objUsuario->id}</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div>
                                Fecha registro:
                                <label class="font-weight-bold">{Formato::Fecha($objUsuario->fecha_registro)}</label>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div>
                                Fecha modificación:
                                <label class="font-weight-bold">{Formato::Fecha($objUsuario->fecha_modificacion)}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body p-3 text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-2"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>