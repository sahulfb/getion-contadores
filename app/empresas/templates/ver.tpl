<script>
    const PLANES = JSON.parse(`{$json_planes}`);
</script>

<form class="m-2 p-2" id="form-datos">
    <input type="hidden" name="idEmpresa" value="{$objEmpresa->id}">

    <div class="card mb-3">
        <div class="card-body p-3">
            <h5 class="mb-0">
                <a href="{$base_url}/Empresas/Index/" class="text-decoration-none">
                    <i class="fas fa-arrow-left pr-1 mr-1"></i>
                </a>
                {$objEmpresa->razon_social}
            </h5>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Datos basicos</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label for="input-rut" class="mb-0">RUT</label>
                                <input type="text" class="form-control" placeholder="RUT..." name="rut" id="input-rut" required value="{$objEmpresa->rut}">
                            </div>
                        </div>
    
                        <div class="col-12 col-md-8">
                            <div class="form-group">
                                <label for="input-razon_social" class="mb-0">Razon social</label>
                                <input type="text" class="form-control" placeholder="Razon social..." name="razon_social" id="input-razon_social" required value="{$objEmpresa->razon_social}">
                            </div>
                        </div>
    
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-correo" class="mb-0">Correo</label>
                                <input type="email" class="form-control" placeholder="Correo..." name="correo" id="input-correo" required value="{$objEmpresa->correo}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        
        <div class="col-12 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Planes con movimiento</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-idPlan" class="mb-0">Plan</label>
                                <select class="form-control" name="idPlan" id="input-idPlan" required>
                                    <option value="">Asignar un plan</option>
                                    {foreach from=$planes item=plan}
                                        {if $plan.idPlan == $objEmpresa->idPlan}
                                            <option value="{$plan.idPlan}" selected>{$plan.nombre}</option>
                                        {else}
                                            <option value="{$plan.idPlan}">{$plan.nombre}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="mb-0">Detalle</label>
                                <textarea id="input-detalle" disabled cols="30" rows="3" class="form-control" placeholder="Detalle del plan..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        
        <div class="col-12 col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Planes sin movimiento</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-idPlan" class="mb-0">Plan</label>
                                <select class="form-control" name="idPlan_sinMovimiento" id="input-idPlan-sinMovimiento">
                                    <option value="">Asignar un plan</option>
                                    {foreach from=$planes item=plan}
                                        {if $plan.idPlan == $objEmpresa->idPlan_sinMovimiento}
                                            <option value="{$plan.idPlan}" selected>{$plan.nombre}</option>
                                        {else}
                                            <option value="{$plan.idPlan}">{$plan.nombre}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="mb-0">Detalle</label>
                                <textarea id="input-detalle-sinMovimiento" disabled cols="30" rows="3" class="form-control" placeholder="Detalle del plan..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <div class="card">
        <div class="card-body p-3">
            <div class="text-center">
                <button type="submit" class="btn btn-success w-100px">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</form>