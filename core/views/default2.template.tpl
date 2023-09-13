<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$sistemaNombre}</title>
    
    <link rel="stylesheet" href="{$base_url}/public/bootstrap/css/bootstrap.css?v={$sistemaVersion}">
    <link rel="stylesheet" href="{$base_url}/public/jquery/css/datatables.css?v={$sistemaVersion}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{$base_url}/public/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{$base_url}/public/toastr/toastr.min.css">
    <!-- SELECT 2 -->
    <link rel="stylesheet" href="{$base_url}/public/select2/select2.min.css">

    <script src="{$base_url}/public/jquery/js/jquery.min.js?v={$sistemaVersion}"></script>
    <script src="{$base_url}/public/jquery/js/datatables.js?v={$sistemaVersion}"></script>
    <script src="{$base_url}/public/font-awesome/js/all.min.js?v={$sistemaVersion}"></script>
    <script src="{$base_url}/public/bootstrap/js/bootstrap.min.js?v={$sistemaVersion}"></script>
    <script src="{$base_url}/public/select2/select2.min.js?v={$sistemaVersion}"></script>
    <!-- SweetAlert2 -->
    <script src="{$base_url}/public/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{$base_url}/public/toastr/toastr.min.js"></script>

    <script>
        const BASE_URL = '{$base_url}';
        const PRODUCCION = ('{(int) $sistemaProduccion}' == "0") ? false : true;
        const MONEDA = JSON.parse(`{$moneda}`);
    </script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <link rel="stylesheet" href="{$base_url}/public/core/css/core.css?v={$sistemaVersion}">
    <script src="{$base_url}/public/core/js/core.js?v={$sistemaVersion}" defer></script>

    <!-- ARCHIVOS DEL MODULO -->
    {foreach from=$_css item=css}
        <link rel="stylesheet" href="{$css}?v={$sistemaVersion}">
    {/foreach}

    {foreach from=$_js item=js}
        <script src="{$js}?v={$sistemaVersion}" defer></script>
    {/foreach}
    <!-- FIN ARCHIVOS DEL MODULO -->

    <style>
        .boton-personalizado {
            background-color: #4a4a4a !important;
            border-color: #4a4a4a !important;
        }
        .boton-personalizado:hover, .boton-personalizado:focus {
            box-shadow: 0 0 0 0.2rem rgb(123 123 123 / 50%) !important;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header class="encabezado">
        <div class="navbar" style="background-color: #000;">
            <a class="navbar-brand" href="{$base_url}">
                <img src="{$base_url}/public/core/img/logo.png" height="45" alt="Logo Exland">
            </a>
    
            <div>
                <div class="header-option">
                    <button class="btn btn-success boton-personalizado" onclick="switchMenuLateral()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
    
                <div class="header-option">
                    <button class="btn btn-success dropdown-toggle boton-personalizado" data-toggle="collapse" data-target="#user-options">
                        <i class="fas fa-user"></i>
                    </button>
    
                    <div class="position-absolute collapse m-0" id="user-options" style="top: 100%; right: 0px; width: 300px;">
                        <div class="card">
                            <div class="card-header p-2">
                                <div>
                                    {Sesion::Usuario()->nombre}
                                </div>
    
                                <div class="text-muted">
                                    {Sesion::Usuario()->Rol()->nombre}
                                </div>
                            </div>
    
                            <div class="card-body px-0 py-1">
                                <a class="user-option" href="#Datos-Cuenta">
                                    <div>
                                        <i class="fas fa-user"></i>
                                        <span>Datos de la cuenta</span>
                                    </div>
                                </a>
    
                                <hr class="mx-0 my-1">
    
                                <a class="user-option">
                                    <div onclick="CerrarSesion()">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Cerrar sesión</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-encabezado">
            <a class="opcion" href="#1"> <div>Opcion 1</div> </a>
            <a class="opcion" href="#2"> <div>Opcion 2</div> </a>
            <a class="opcion" href="#3"> <div>Opcion 3</div> </a>
            <a class="opcion" href="#4"> <div>Opcion 4</div> </a>
            <a class="opcion" href="#5"> <div>Opcion 5</div> </a>
            <a class="opcion" href="#6"> <div>Opcion 6</div> </a>
            <a class="opcion" href="#7"> <div>Opcion 7</div> </a>
        </div>
    </header>
    <!-- END HEADER -->

    <div class="container-fluid" role="template">
        <div class="row flex-xl-nowrap" menu-lateral="false">

            <!-- MENU LATERAL -->
            <div class="border-right menu-lateral bg-light" id="menu-lateral">
                <div class="p-2 border-bottom m-0 row">
                    <div class="col pr-0">
                        <div style="font-size: 14px;">
                            {Sesion::Usuario()->nombre}
                        </div>
                        
                        <div class="text-muted" style="font-size: 14px;">
                            {Sesion::Usuario()->Rol()->nombre}
                        </div>
                    </div>
                </div>

                <div class="lista-menu" id="group-menu">
                    <div class="menu-separator text-white" style="background-color: #4a4a4a;">
                        <label class="mb-0">Main</label>
                    </div>
                </div>

                {$active = ''}
                {if strpos($_SERVER['REQUEST_URI'], 'Dashboard/') !== FALSE}
                    {$active = 'active'}
                {/if}
                <div class="lista-menu" id="group-menu">
                    <a class="menu-item" {$active} href="{$base_url}/Dashboard/">
                        <i class="fas fa-home mr-1"></i>
                        Dashboard
                    </a>

                    {foreach from=$templateMenus item=menus key=seccion}
                        <div class="lista-menu" id="group-menu">
                            <div class="menu-separator text-white" style="background-color: #4a4a4a;">
                                <label class="mb-0">{$seccion}</label>
                            </div>
                        </div>

                        {foreach from=$menus item=menu}
                            {$active = FALSE}
                            {if strpos($_SERVER['REQUEST_URI'], $menu['link']) !== FALSE}
                                {$active = TRUE}
                            {/if}

                            {if $menu.conOpciones}
                                <a class="menu-item {($active) ? '' : 'collapsed'}" {($active) ? 'active' : ''} data-toggle="collapse" data-target="#submenu_{$menu.idMenuA}" aria-expanded="{($active) ? 'true' : 'false'}">
                                    <i class="{$menu.image} mr-1"></i>
                                    {$menu.label}

                                    <div class="float-right text-dark arrow-more">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </a>

                                <div class="lista-submenu collapse {($active) ? 'show' : ''}" id="submenu_{$menu.idMenuA}" data-parent="#group-menu">
                                    {foreach from=$menu.opciones item=opcion}
                                        {$subActive = FALSE}
                                        {if strpos($_SERVER['REQUEST_URI'], $opcion['link']) !== FALSE}
                                            {$subActive = TRUE}
                                        {/if}

                                        <a class="submenu-item" {($subActive) ? 'active' : ''} href="{$base_url}/{$opcion.link}">
                                            <i class="{$opcion.image} mr-1"></i>
                                            {$opcion.label}
                                        </a>
                                    {/foreach}
                                </div>
                            {else}

                                {$active = ''}
                                {if strpos($_SERVER['REQUEST_URI'], $menu['link']) !== FALSE}
                                    {$active = 'active'}
                                {/if}

                                <a class="menu-item" {($active) ? 'active' : ''} href="{$base_url}/{$menu.link}">
                                    <i class="{$menu.image} mr-1"></i>
                                    {$menu.label}
                                </a>
                            {/if}
                        {/foreach}
                    {/foreach}
                </div>
            </div>
            <!-- END MENU LATERAL -->

            <!-- MAIN CONTENT -->
            <main class="main-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2" style="border-radius: 0;">
                        <li style="text-transform: capitalize;" class="breadcrumb-item">{str_replace('_', ' ', Peticion::getControlador())}</li>
                        <li style="text-transform: capitalize;" class="breadcrumb-item">{str_replace('_', ' ', Peticion::getMetodo())}</li>
                    </ol>
                </nav>

                {include file=$_pathContent}
            </main>
            <!-- END MAIN CONTENT -->
        </div>
    </div>

</body>
</html>