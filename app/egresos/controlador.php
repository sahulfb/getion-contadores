<?php

class controlador
{
    public function index() {
        $objMonedaCLP = new MonedaModel(1);
        $centrosCosto = CentrosCostoModel::Buscar();

        Incluir::template('templates/index.tpl', [
            'centrosCosto' => $centrosCosto,
            'objMonedaCLP' => $objMonedaCLP
        ], [
            'js' => ['public/js/index.js']
        ]);
    }

    public function crud($parametros = []) {
        setHandlerJson();

        require_once(__DIR__."/utils/crud.php");

        if(!isset($parametros[0])) throw new Exception('No se envio la acción.');
        $accion = strtoupper($parametros[0]);

        switch($accion) {
            case 'CONSULTAR': consultar();
            break;

            case 'REGISTRAR': registrar();
            break;
            
            case 'MODIFICAR': modificar();
            break;
            
            case 'ANULAR': anular();
            break;
            
            default: throw new Exception("Acción invalida.");
        }
    }
}