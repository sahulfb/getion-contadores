<?php

class controlador
{
    /**
     * Index
     */
    public function index() {
        Incluir::template('templates/index.html', [
            'empresas' => EmpresasModel::Buscar(),
            'periodos' => PeriodosContablesModel::Buscar(),
        ], [
            'js' => ["public/index.js"]
        ]);
    }

    /**
     * CRUD Cobros adicionales
     */
    public function crud_cobros_adicionales($parametros = []) {
        setHandlerJson();
        if(!isset($parametros[0])) throw new Exception('No se ha enviado la acción.');
        $accion = strtolower($parametros[0]);
        require_once(__DIR__."/utils/crud-cobros.php");
    }
}