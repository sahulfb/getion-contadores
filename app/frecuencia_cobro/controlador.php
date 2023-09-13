<?php

class controlador
{
    public function index() {
        $periodos = FrecuenciasCobroModel::Buscar();
        Incluir::template('templates/index.tpl', ['periodos' => $periodos], [
            'js' => ['public/js/index.js']
        ]);
    }

    public function crud($parametros = []) {
        setHandlerJson();

        require_once(__DIR__."/utils/crud.php");

        if(!isset($parametros[0])) throw new Exception('No se envio la acción.');
        $accion = strtoupper($parametros[0]);

        switch($accion)
        {
            case 'CONSULTAR':
                consultar();
            break;
            
            case 'MODIFICAR':
                modificar();
            break;
            
            default:
            throw new Exception("Acción invalida.");
            break;
        }
    }
}