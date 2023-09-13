<?php

class EmpresasModel
{
    /**
     * 
     */
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $empresas = Conexion::db()->get('empresas');
        return $empresas;
    }

    public static function ExisteRut($rut) {
        Conexion::db()->where('rut', $rut);
        $empresas = Conexion::db()->get('empresas');
        if(sizeof($empresas) > 0) return TRUE;
        else return FALSE;
    }

    public static function Registrar($rut, $razon_social, $correo, $idPlan, $idPlan_sinMovimiento, $fecha = NULL) {
        if($fecha == NULL) {
            $fecha = date('Y-m-d H:i:s');
        }
        
        $data = [
            'rut' => $rut,
            'razon_social' => $razon_social,
            'correo' => $correo,
            'idPlan' => $idPlan,
            'idPlan_sinMovimiento' => $idPlan_sinMovimiento,
            'fecha_registro' => $fecha,
            'fecha_modificacion' => $fecha,
        ];

        $id = Conexion::db()->insert('empresas', $data);
        if(!$id) {
            throw new Exception('Ocurrio un error al intentar registrar la empresa.');
        }

        return $id;
    }
}