<?php
/* Smarty version 3.1.40, created on 2023-09-13 01:30:47
  from 'C:\Users\user\Desktop\sql\app\app\login\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_650110c7228d07_82701366',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bcbf783ebbe283485669418dc63a19c6886be217' => 
    array (
      0 => 'C:\\Users\\user\\Desktop\\sql\\app\\app\\login\\templates\\index.tpl',
      1 => 1603828094,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650110c7228d07_82701366 (Smarty_Internal_Template $_smarty_tpl) {
?><form id="form-login">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-user"></i>
            </div>
        </div>

        <input type="text" class="form-control" name="correo" placeholder="Correo..." required>
    </div>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-key"></i>
            </div>
        </div>

        <input type="password" class="form-control" name="clave" placeholder="Contraseña..." required>
    </div>
    
    <div class="w-100">
        <button class="btn btn-warning w-100">
            Acceder
        </button>
    </div>
</form><?php }
}
