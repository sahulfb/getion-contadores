<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$sistemaNombre}</title>
    
    <link rel="stylesheet" href="{$base_url}/public/bootstrap/css/bootstrap.css?v={$sistemaVersion}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{$base_url}/public/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{$base_url}/public/toastr/toastr.min.css">

    <script src="{$base_url}/public/jquery/js/jquery.min.js?v={$sistemaVersion}"></script>
    <script src="{$base_url}/public/font-awesome/js/all.min.js?v={$sistemaVersion}"></script>
    <script src="{$base_url}/public/bootstrap/js/bootstrap.min.js?v={$sistemaVersion}"></script>
    <!-- SweetAlert2 -->
    <script src="{$base_url}/public/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="{$base_url}/public/toastr/toastr.min.js"></script>

    <script>
        const BASE_URL = '{$base_url}';
        const PRODUCCION = ('{(int) $sistemaProduccion}' == "0") ? false : true;
    </script>

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
        .fondo::before {
            content: '';
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            opacity: 0.5;
            z-index: 0;
            background: url('{$base_url}/public/fondo-login.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 100% 100%;
        }
    </style>
</head>
<body>

<div class="w-100 h-100 d-flex justify-content-center align-items-center fondo bg-dark">
    <div class="container-fluid" style="max-width: 400px; width: 90%;">
        <div class="card shadow">
            <img src="{$base_url}/public/core/img/logo.png" alt="Logo" class="logo">
            <div class="card-header bg-warning text-dark">
                <div class="text-center h5 mb-0 font-weight-normal">
                    {$sistemaNombre}
                </div>
            </div>

            <div class="card-body">
                {include file=$_pathContent}
            </div>

            <div class="card-footer p-2">
                <div class="float-left text-muted small">
                    {$sistemaVersion}
                </div>

                <div class="float-right text-muted small">
                    {($sistemaProduccion) ? 'Producción' : 'Desarrollo'}
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>