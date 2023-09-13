<?php

class MenuAModel
{
    public $id;
    public $label;
    public $seccion;
    public $image;
    public $link;
    public $conOpciones;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idMenuA', $id);
        $datos = Conexion::db()->get('menus_a');
        if(sizeof($datos) <= 0) {
            throw new Exception("MenuA ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idMenuA'];
        $this->label = $datos[0]['label'];
        $this->seccion = $datos[0]['seccion'];
        $this->image = $datos[0]['image'];
        $this->link = $datos[0]['link'];
        $this->conOpciones = boolval($datos[0]['conOpciones']);
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }
}