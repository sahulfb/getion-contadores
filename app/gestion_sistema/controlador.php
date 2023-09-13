<?php

class controlador
{
    /**
     * Usuarios
     */
    public function usuarios($parametros = []) {
        $roles = RolesModel::Buscar();

        if(isset($parametros[0]))
        {
            $idUsuario = $parametros[0];

            try
            {
                $objUsuario = new UsuarioModel($idUsuario);
            }
            catch(Exception $e)
            {
                Incluir::template('templates/usuarios/404.tpl', ['idUsuario' => $idUsuario]);
                return;
            }

            Incluir::template('templates/usuarios/ver.tpl', ['objUsuario' => $objUsuario, "roles" => $roles], [
                'js' => ["public/js/usuarios-ver.js"]
            ]);
        }
        else
        {
            Incluir::template('templates/usuarios/index.tpl', ["roles" => $roles], [
                'js' => ["public/js/usuarios.js"]
            ]);
        }
    }

    /**
     * CRUD de los usuarios
     */
    public function crud_usuarios($parametros = []) {
        setHandlerJson();

        require_once(__DIR__."/utils/crud-usuarios.php");

        if(!isset($parametros[0])) throw new Exception('No se ha enviado la acción.');
        $accion = strtoupper($parametros[0]);

        switch($accion)
        {
            case 'CONSULTAR':
                consultar();
            break;

            case 'REGISTRAR':
                registrar();
            break;

            case 'MODIFICAR':
                modificar();
            break;

            case 'ELIMINAR':
                eliminar();
            break;

            case 'ACTIVAR':
                activar();
            break;

            default:
                throw new Exception('Acción invalida.');
            break;
        }
    }
    
    /**
     * Roles
     */
    public function roles() {
        $roles = RolesModel::Buscar();
        Incluir::template('templates/roles.tpl', ['roles' => $roles], [
            'js' => ["public/js/roles.js"]
        ]);
    }

    /**
     * CRUD Roles
     */
    public function crud_roles($parametros = []) {
        setHandlerJson();

        require_once(__DIR__."/utils/crud-roles.php");

        if(!isset($parametros[0])) throw new Exception('No se ha enviado la acción.');
        $accion = strtoupper($parametros[0]);

        switch($accion)
        {
            case 'CONSULTAR':
                consultar();
            break;

            case 'REGISTRAR':
                registrar();
            break;

            case 'MODIFICAR':
                modificar();
            break;

            case 'ELIMINAR':
                eliminar();
            break;

            default:
                throw new Exception('Acción invalida.');
            break;
        }
    }

    /**
     * CRUD de Permisos
     */
    public function crud_permisos($parametros = []) {
        setHandlerJson();

        require_once(__DIR__."/utils/crud-permisos.php");

        if(!isset($parametros[0])) throw new Exception('No se ha enviado la acción.');
        $accion = strtoupper($parametros[0]);

        switch($accion)
        {
            case 'CONSULTAR':
                consultar();
            break;

            case 'CAMBIAR':
                cambiar();
            break;

            default:
                throw new Exception('Acción invalida.');
            break;
        }
    }
}