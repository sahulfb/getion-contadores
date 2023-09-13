<?php
/* Smarty version 3.1.40, created on 2021-11-16 09:20:12
  from '/home/exlandcl/public_html/gestion/core/views/default.template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6193a1fc290098_04379297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93e460b15bb433d89958fb77a9719da49f946625' => 
    array (
      0 => '/home/exlandcl/public_html/gestion/core/views/default.template.tpl',
      1 => 1632855338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6193a1fc290098_04379297 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->tpl_vars['sistemaNombre']->value;?>
</title>
    
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/bootstrap/css/bootstrap.css?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/jquery/css/datatables.css?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/toastr/toastr.min.css">
    <!-- SELECT 2 -->
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/select2/select2.min.css">

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/jquery/js/jquery.min.js?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/jquery/js/datatables.js?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/font-awesome/js/all.min.js?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/bootstrap/js/bootstrap.min.js?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/select2/select2.min.js?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
"><?php echo '</script'; ?>
>
    <!-- SweetAlert2 -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/sweetalert2/sweetalert2.min.js"><?php echo '</script'; ?>
>
    <!-- Toastr -->
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/toastr/toastr.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>
        const BASE_URL = '<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
';
        const PRODUCCION = ('<?php echo (int) $_smarty_tpl->tpl_vars['sistemaProduccion']->value;?>
' == "0") ? false : true;
        const MONEDA = JSON.parse(`<?php echo $_smarty_tpl->tpl_vars['moneda']->value;?>
`);
    <?php echo '</script'; ?>
>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"><?php echo '</script'; ?>
>
    
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/core/css/core.css?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
">
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/core/js/core.js?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
" defer><?php echo '</script'; ?>
>

    <!-- ARCHIVOS DEL MODULO -->
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_css']->value, 'css');
$_smarty_tpl->tpl_vars['css']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['css']->value) {
$_smarty_tpl->tpl_vars['css']->do_else = false;
?>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
">
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['_js']->value, 'js');
$_smarty_tpl->tpl_vars['js']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['js']->value) {
$_smarty_tpl->tpl_vars['js']->do_else = false;
?>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
?v=<?php echo $_smarty_tpl->tpl_vars['sistemaVersion']->value;?>
" defer><?php echo '</script'; ?>
>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
            <a class="navbar-brand" href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
">
                <img src="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/public/core/img/logo.png" height="45" alt="Logo Exland">
            </a>
    
            <div>
                <div class="header-option d-inline-block d-md-none">
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
                                    <?php echo Sesion::Usuario()->nombre;?>

                                </div>
    
                                <div class="text-muted">
                                    <?php echo Sesion::Usuario()->Rol()->nombre;?>

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
        <div class="sub-encabezado d-md-block d-none">
            <div class="optiones-a">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['templateMenus']->value, 'menu');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
?>
                    <?php if ($_smarty_tpl->tpl_vars['menu']->value['con_opciones'] === FALSE) {?>
                    <a class="opcion-a" href="<?php echo $_smarty_tpl->tpl_vars['menu']->value['link'];?>
">
                        <i class="mr-1 <?php echo $_smarty_tpl->tpl_vars['menu']->value['icon'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['menu']->value['label'];?>

                    </a>
                    <?php } else { ?>
                    <div class="opcion-a">
                        <div class="content-a dropdown-toggle" data-toggle="collapse" data-target="#collapse-<?php echo $_smarty_tpl->tpl_vars['menu']->value['slug'];?>
">
                            <i class="mr-1 <?php echo $_smarty_tpl->tpl_vars['menu']->value['icon'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['menu']->value['label'];?>

                        </div>

                        <div class="opciones-b collapse" id="collapse-<?php echo $_smarty_tpl->tpl_vars['menu']->value['slug'];?>
">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['opciones'], 'opcion');
$_smarty_tpl->tpl_vars['opcion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['opcion']->value) {
$_smarty_tpl->tpl_vars['opcion']->do_else = false;
?>
                                <?php if ($_smarty_tpl->tpl_vars['opcion']->value['con_opciones'] === FALSE) {?>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['opcion']->value['link'];?>
" class="opcion-b border-bottom">
                                        <i class="mr-1 <?php echo $_smarty_tpl->tpl_vars['opcion']->value['icon'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['opcion']->value['label'];?>

                                    </a>
                                <?php } else { ?>
                                    <div class="border-bottom">
                                        <div class="opcion-b dropdown-toggle" data-toggle="collapse" data-target="#collapse-<?php echo $_smarty_tpl->tpl_vars['opcion']->value['slug'];?>
">
                                            <i class="mr-1 <?php echo $_smarty_tpl->tpl_vars['opcion']->value['icon'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['opcion']->value['label'];?>

                                        </div>
                                        <div class="opciones-c collapse" id="collapse-<?php echo $_smarty_tpl->tpl_vars['opcion']->value['slug'];?>
">
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['opcion']->value['opciones'], 'subopciones');
$_smarty_tpl->tpl_vars['subopciones']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['subopciones']->value) {
$_smarty_tpl->tpl_vars['subopciones']->do_else = false;
?>
                                                <a class="opcion-c" href="<?php echo $_smarty_tpl->tpl_vars['subopciones']->value['link'];?>
">
                                                    <i class="mr-1 <?php echo $_smarty_tpl->tpl_vars['subopciones']->value['icon'];?>
"></i> <?php echo $_smarty_tpl->tpl_vars['subopciones']->value['label'];?>

                                                </a>
                                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    </div>
                    <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
    </header>
    <!-- END HEADER -->

    <div class="container-fluid" role="template">
        <div class="row flex-xl-nowrap" menu-lateral="false">

            <!-- MENU LATERAL -->
            <div class="border-right menu-lateral bg-light d-block d-md-none" id="menu-lateral">
                <div class="p-2 border-bottom m-0 row">
                    <div class="col pr-0">
                        <div style="font-size: 14px;">
                            <?php echo Sesion::Usuario()->nombre;?>

                        </div>
                        
                        <div class="text-muted" style="font-size: 14px;">
                            <?php echo Sesion::Usuario()->Rol()->nombre;?>

                        </div>
                    </div>
                </div>

                <div class="lista-menu" id="group-menu">
                    <div class="menu-separator text-white" style="background-color: #4a4a4a;">
                        <label class="mb-0">Main</label>
                    </div>
                </div>

                <?php $_smarty_tpl->_assignInScope('active', '');?>
                <?php if (strpos($_smarty_tpl->tpl_vars['_SERVER']->value['REQUEST_URI'],'Dashboard/') !== FALSE) {?>
                    <?php $_smarty_tpl->_assignInScope('active', 'active');?>
                <?php }?>
                <div class="lista-menu" id="group-menu">
                    <a class="menu-item" <?php echo $_smarty_tpl->tpl_vars['active']->value;?>
 href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/Dashboard/">
                        <i class="fas fa-home mr-1"></i>
                        Dashboard
                    </a>

                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menuLateral']->value, 'menus', false, 'seccion');
$_smarty_tpl->tpl_vars['menus']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['seccion']->value => $_smarty_tpl->tpl_vars['menus']->value) {
$_smarty_tpl->tpl_vars['menus']->do_else = false;
?>
                        <div class="lista-menu" id="group-menu">
                            <div class="menu-separator text-white" style="background-color: #4a4a4a;">
                                <label class="mb-0"><?php echo $_smarty_tpl->tpl_vars['seccion']->value;?>
</label>
                            </div>
                        </div>

                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menus']->value, 'menu');
$_smarty_tpl->tpl_vars['menu']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['menu']->value) {
$_smarty_tpl->tpl_vars['menu']->do_else = false;
?>
                            <?php $_smarty_tpl->_assignInScope('active', FALSE);?>
                            <?php if (strpos($_smarty_tpl->tpl_vars['_SERVER']->value['REQUEST_URI'],$_smarty_tpl->tpl_vars['menu']->value['link']) !== FALSE) {?>
                                <?php $_smarty_tpl->_assignInScope('active', TRUE);?>
                            <?php }?>

                            <?php if ($_smarty_tpl->tpl_vars['menu']->value['conOpciones']) {?>
                                <a class="menu-item <?php echo $_smarty_tpl->tpl_vars['active']->value ? '' : 'collapsed';?>
" <?php echo $_smarty_tpl->tpl_vars['active']->value ? 'active' : '';?>
 data-toggle="collapse" data-target="#submenu_<?php echo $_smarty_tpl->tpl_vars['menu']->value['idMenuA'];?>
" aria-expanded="<?php echo $_smarty_tpl->tpl_vars['active']->value ? 'true' : 'false';?>
">
                                    <i class="<?php echo $_smarty_tpl->tpl_vars['menu']->value['image'];?>
 mr-1"></i>
                                    <?php echo $_smarty_tpl->tpl_vars['menu']->value['label'];?>


                                    <div class="float-right text-dark arrow-more">
                                        <i class="fas fa-angle-right"></i>
                                    </div>
                                </a>

                                <div class="lista-submenu collapse <?php echo $_smarty_tpl->tpl_vars['active']->value ? 'show' : '';?>
" id="submenu_<?php echo $_smarty_tpl->tpl_vars['menu']->value['idMenuA'];?>
" data-parent="#group-menu">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu']->value['opciones'], 'opcion');
$_smarty_tpl->tpl_vars['opcion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['opcion']->value) {
$_smarty_tpl->tpl_vars['opcion']->do_else = false;
?>
                                        <?php $_smarty_tpl->_assignInScope('subActive', FALSE);?>
                                        <?php if (strpos($_smarty_tpl->tpl_vars['_SERVER']->value['REQUEST_URI'],$_smarty_tpl->tpl_vars['opcion']->value['link']) !== FALSE) {?>
                                            <?php $_smarty_tpl->_assignInScope('subActive', TRUE);?>
                                        <?php }?>

                                        <a class="submenu-item" <?php echo $_smarty_tpl->tpl_vars['subActive']->value ? 'active' : '';?>
 href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['opcion']->value['link'];?>
">
                                            <i class="<?php echo $_smarty_tpl->tpl_vars['opcion']->value['image'];?>
 mr-1"></i>
                                            <?php echo $_smarty_tpl->tpl_vars['opcion']->value['label'];?>

                                        </a>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </div>
                            <?php } else { ?>

                                <?php $_smarty_tpl->_assignInScope('active', '');?>
                                <?php if (strpos($_smarty_tpl->tpl_vars['_SERVER']->value['REQUEST_URI'],$_smarty_tpl->tpl_vars['menu']->value['link']) !== FALSE) {?>
                                    <?php $_smarty_tpl->_assignInScope('active', 'active');?>
                                <?php }?>

                                <a class="menu-item" <?php echo $_smarty_tpl->tpl_vars['active']->value ? 'active' : '';?>
 href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['menu']->value['link'];?>
">
                                    <i class="<?php echo $_smarty_tpl->tpl_vars['menu']->value['image'];?>
 mr-1"></i>
                                    <?php echo $_smarty_tpl->tpl_vars['menu']->value['label'];?>

                                </a>
                            <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>
            <!-- END MENU LATERAL -->

            <!-- MAIN CONTENT -->
            <main class="main-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-2" style="border-radius: 0;">
                        <li style="text-transform: capitalize;" class="breadcrumb-item"><?php echo str_replace('_',' ',Peticion::getControlador());?>
</li>
                        <li style="text-transform: capitalize;" class="breadcrumb-item"><?php echo str_replace('_',' ',Peticion::getMetodo());?>
</li>
                    </ol>
                </nav>

                <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['_pathContent']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            </main>
            <!-- END MAIN CONTENT -->
        </div>
    </div>

</body>
</html><?php }
}
