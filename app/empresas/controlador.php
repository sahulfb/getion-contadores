<?php

class controlador
{
    public function index($parametros = []) {
        if(isset($parametros[0]))
        {
            $planes = PlanesModel::Buscar();

            try {
                $idEmpresa = $parametros[0];
                $objEmpresa = new EmpresaModel($idEmpresa);
            } catch(Exception $e) {
                Incluir::template('templates/404.tpl', ['idEmpresa' => $parametros[0]], []);
            }

            Incluir::template('templates/ver.tpl', [
                'objEmpresa' => $objEmpresa,
                'json_planes' => str_replace('\\', '\\\\', json_encode($planes)),
                'planes' => $planes
            ], [
                'js' => ['public/js/ver.js']
            ]);
        }
        else
        {
            Incluir::template('templates/index.tpl', [
                'planes' => PlanesModel::Buscar(['isDeleted' => '0'])
            ], [
                'js' => ['public/js/index.js']
            ]);
        }
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
            
            case 'REGISTRAR':
                registrar();
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