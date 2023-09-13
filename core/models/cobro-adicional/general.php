<?php

class CobrosAdicionalModel
{
    public static function Buscar($condicionales = []) {
        foreach($condicionales as $key => $value) {
            Conexion::db()->where($key, $value);
        }

        $roles = Conexion::db()->get('cobros_adicionales');
        return $roles;
    }

    public static function Registrar($empresa_id, $descripcion, $monto, $es_fijo, $periodos_id) {
        $id = Conexion::db()->insert('cobros_adicionales', [
            'empresa_id' => $empresa_id,
            'descripcion' => $descripcion,
            'monto' => $monto,
            'es_fijo' => $es_fijo,
        ]);
        if(!$id) throw new Exception('Ocurrio un error al intentar registrar el cobro adicional.');

        if(!$es_fijo) {
            if(empty($periodos_id) || count($periodos_id) < 1) throw new Exception('Debe enviar almenos un periodo.');

            foreach($periodos_id as $periodo_id) {
                $id_aux = Conexion::db()->insert('cobros_adicionales_periodos', [
                    'cobro_adicional_id' => $id,
                    'periodo_id' => $periodo_id,
                ]);
                if(!$id_aux) throw new Exception('Ocurrio un error al intentar registrar los periodos del cobro adicional.');
            }
        }

        return $id;
    }
    
    public static function Periodos($cobro_adicional_id) {
        Conexion::db()->where('cobro_adicional_id', $cobro_adicional_id);
        $resp = Conexion::db()->get('cobros_adicionales_periodos', NULL, ['periodo_id']);
        $output = [];
        foreach($resp as $value) {
            array_push($output, $value['periodo_id']);
        }
        return $output;
    }
}