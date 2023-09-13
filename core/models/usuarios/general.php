<?php

class UsuariosModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $roles = Conexion::db()->get('usuarios');
        return $roles;
    }

    /**
     * correo: String
     */
    public static function BuscarPorCorreo($correo) {
        Conexion::db()->where('correo', $correo);
        $usuario = Conexion::db()->getone('usuarios');
        if($usuario == NULL) {
            return NULL;
        }
        
        $objUsuario = new UsuarioModel($usuario['idUsuario']);
        return $objUsuario;
    }

    /**
     * correo: String
     */
    public static function ExisteCorreo($correo, $idUsuarioException = "") {
        Conexion::db()->where('correo', $correo);
        if($idUsuarioException != "") {
            Conexion::db()->where("idUsuario <> '{$idUsuarioException}'");
        }
        $usuarios = Conexion::db()->get('usuarios');
        if(sizeof($usuarios) > 0) return TRUE;
        else return FALSE;
    }
    
    /**
     * nombre: String
     * correo: String
     * clave: String
     * idRol: Number
     * activo: Boolean
     */
    public static function Registrar($nombre, $correo, $clave, $idRol, $activo) {
        $idRol = (int) $idRol;
        $activo = (int) $activo;

        $data = [
            'nombre' => $nombre,
            'correo' => $correo,
            'clave' => $clave,
            'idRol' => $idRol,
            'activo' => $activo
        ];

        $id = Conexion::db()->insert('usuarios', $data);
        if(!$id) {
            throw new Exception('Error al intentar crear el usuario.');
        }

        return $id;
    }
}