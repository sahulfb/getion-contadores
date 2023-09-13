<?php

class MenuBModel
{
    public $id;
    public $idMenuA;
    public $label;
    public $image;
    public $link;
    public $fecha_registro;
    public $fecha_modificacion;

    public function __construct($id) {
        Conexion::db()->where('idMenuB', $id);
        $datos = Conexion::db()->get('menus_b');
        if(sizeof($datos) <= 0) {
            throw new Exception("MenuB ID: {$id} no existe.");
        }

        $this->id = $datos[0]['idMenuB'];
        $this->idMenuA = $datos[0]['idMenuA'];
        $this->label = $datos[0]['label'];
        $this->image = $datos[0]['image'];
        $this->link = $datos[0]['link'];
        $this->fecha_registro = $datos[0]['fecha_registro'];
        $this->fecha_modificacion = $datos[0]['fecha_modificacion'];
    }
}