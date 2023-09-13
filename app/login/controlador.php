<?php

class controlador
{
    public function index() {
        Incluir::template('templates/index.tpl', [], [
            "template" => 'login.template.tpl',
            "js" => ["public/js/index.js"],
            "css" => ["public/css/index.css"]
        ]);
    }
    
    public function acceder() {
        setHandlerJson();

        $correo = Input::post('correo');
        $clave = Input::post('clave');
        
        $objUsuario = UsuariosModel::BuscarPorCorreo($correo);

        if($objUsuario == NULL) {
            throw new Exception("Correo invalido.");
        }

        if($objUsuario->clave !== $clave) {
            throw new Exception("Contraseña incorrecta.");
        }

        if(!$objUsuario->activo) {
            throw new Exception("El usuario <b>{$objUsuario->nombre}</b> no esta activo");
        }

        Sesion::Crear($objUsuario->id);

        sendJson(['ok' => TRUE]);
    }
}