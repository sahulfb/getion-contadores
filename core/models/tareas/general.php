<?php

class TareasModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $roles = Conexion::db()->get('tareas');
        return $roles;
    }

    public static function Registrar($empresa_id, $usuario_id, $descripcion, $fecha_vencimiento) {
        $data = [
            'estado_id' => 1,
            'empresa_id' => $empresa_id,
            'usuario_id' => $usuario_id,
            'descripcion' => $descripcion,
            'fecha_vencimiento' => $fecha_vencimiento
        ];

        $id = Conexion::db()->insert('tareas', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar la tarea.');
        }

        return $id;
    }

    public static function VerificarFechaVencimiento() {
        $fechaActual = date('Y-m-d');

        Conexion::db()->where("fecha_vencimiento < '{$fechaActual}' AND estado_id = '1'");
        $tareas_vencidas = Conexion::db()->get('tareas');
        if(sizeof($tareas_vencidas) > 0) {
            Conexion::db()->where("fecha_vencimiento < '{$fechaActual}' AND estado_id = '1'");
            Conexion::db()->update('tareas', ['estado_id' => '2']);
        }

        Conexion::db()->where("fecha_vencimiento >= '{$fechaActual}' AND estado_id = '2'");
        $tareas_vencidas = Conexion::db()->get('tareas');
        if(sizeof($tareas_vencidas) > 0) {
            Conexion::db()->where("fecha_vencimiento >= '{$fechaActual}' AND estado_id = '2'");
            Conexion::db()->update('tareas', ['estado_id' => '1']);
        }
    }
}