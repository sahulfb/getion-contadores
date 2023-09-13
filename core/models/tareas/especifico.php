<?php

class TareaModel
{
    public $id;
    public $estado_id;
    public $empresa_id;
    public $usuario_id;
    public $descripcion;
    public $fecha_vencimiento;
    public $created_at;
    public $updated_at;

    public function __construct($id) {
        Conexion::db()->where('id', $id);
        $datos = Conexion::db()->get('tareas');
        if(sizeof($datos) <= 0) {
            throw new Exception("Tarea ID: {$id} no existe.");
        }

        $this->id = $datos[0]['id'];
        $this->estado_id = $datos[0]['estado_id'];
        $this->empresa_id = $datos[0]['empresa_id'];
        $this->usuario_id = $datos[0]['usuario_id'];
        $this->descripcion = $datos[0]['descripcion'];
        $this->fecha_vencimiento = $datos[0]['fecha_vencimiento'];
        $this->created_at = $datos[0]['created_at'];
        $this->updated_at = $datos[0]['updated_at'];
    }

    /**
     * 
     */
    public function Modificar($data) {
        Conexion::db()->where('id', $this->id);
        $resp = Conexion::db()->update('tareas', $data);
        if(!$resp) {
            throw new Exception('Ocurrio un error al intentar modificar la tarea.' . Conexion::db()->getLastError());
        }
        
        foreach($data as $key => $value) {
            if(isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Historial
     */
    public function getHistorial() {
        Conexion::db()->where('tarea_id', $this->id);
        Conexion::db()->orderBy('created_at', 'desc');
        $data = Conexion::db()->get('historial_tareas');
        return $data;
    }

    public function addHistorial($usuario_id, $comentario) {
        $data = [
            'tarea_id' => $this->id,
            'usuario_id' => $usuario_id,
            'comentario' => $comentario,
        ];

        $id = Conexion::db()->insert('historial_tareas', $data);
        if(!$id) throw new Exception('Ocurrio un error al intentar registrar la acción en la tarea.');

        return $id;
    }
}