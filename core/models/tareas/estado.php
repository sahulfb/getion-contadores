<?php

class EstadoTareaModel
{
    public $id;
    public $nombre;
    public $color_class;

    public function __construct($id) {
        Conexion::db()->where('id', $id);
        $datos = Conexion::db()->get('estados_tareas');
        if(sizeof($datos) <= 0) {
            throw new Exception("Estado de la tarea ID: {$id} no existe.");
        }

        $this->id = $datos[0]['id'];
        $this->nombre = $datos[0]['nombre'];
        $this->color_class = $datos[0]['color_class'];
    }
}