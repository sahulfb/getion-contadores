<?php

class PeriodosContablesModel
{
    /**
     * 
     */
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        Conexion::db()->orderBy('idPeriodoContable', 'desc');
        $periodos = Conexion::db()->get('periodos_contables');
        return $periodos;
    }

    /**
     * 
     */
    public static function ExisteNombre($nombre) {
        Conexion::db()->where('nombre', $nombre);
        $datos = Conexion::db()->get('periodos_contables');
        if(sizeof($datos) > 0) return TRUE;
        else return FALSE;
    }

    /**
     * 
     */
    public static function Registrar($nombre) {
        $data = [
            'nombre' => $nombre
        ];
        $id = Conexion::db()->insert('periodos_contables', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar el periodo contable.');
        }

        return $id;
    }
}