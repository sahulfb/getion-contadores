<?php

class controlador
{
    /**
     * Index
     */
    public function index() {
        $status = StatusFacturasModel::Buscar();
        $empresas = EmpresasModel::Buscar(['isDeleted' => '0']);

        Incluir::template('templates/index.tpl', [
            "status" => $status,
            "empresas" => $empresas,
            "titulo" => "Facturas - General",
            "con_filtros" =>    FALSE,
            "status_defecto" => 4,
        ], [
            'js' => ['public/js/index.js']
        ]);
    }

    /**
     * Ver
     */
    public function ver($parametros) {
        // Verificamos que se haya enviado un parametro
        if(!isset($parametros[0])) {
            header('location: '.BASE_URL.'/Facturas/Index/');
            exit;
        }

        // Objetos principales
        $objMonedaCLP = new MonedaModel(1);
        $idFactura = $parametros[0];
        $objFactura = new FacturaModel($idFactura);
        $objEmpresa = new EmpresaModel($objFactura->idEmpresa);
        // Datos principales
        $centrosCosto = CentrosCostoModel::Buscar(['isDeleted' => '0']);
        $metodosPagos = MetodosPagoModel::Buscar(['isDeleted' => '0']);

        // Plan
        $plan = ["nombre" => NULL];
        if(!is_null($objEmpresa->idPlan)) {
            $objPlan = new PlanModel($objFactura->idPlan);
            $plan = ["nombre" => $objPlan->nombre];
        }

        // Metodo de fecha de pago
        $metodoPago = NULL;
        $fechaPago = NULL;
        if(!(is_null($objFactura->idMetodoPago) || is_null($objFactura->fechaPago))) {
            $objMetodo = new MetodoPagoModel($objFactura->idMetodoPago);
            $metodoPago = $objMetodo->nombre;
            $fechaPago = $objFactura->fechaPago;
        }

        // Datos que dependen de otros datos
        $objStatus = new StatusFacturaModel($objFactura->idStatus);
        $objPeriodo = new PeriodoContableModel($objFactura->idPeriodoContable);
        $objUsuario = new UsuarioModel($objFactura->idUsuario);
        $objCentroCosto = new CentroCostoModel($objFactura->idCentroCosto);
        $objFactura->valorPlan = Formato::Precio($objFactura->valorPlan, $objMonedaCLP->decimales, $objMonedaCLP->simbolo);

        // Incluimos
        Incluir::template('templates/ver.tpl', [
            'objFactura' => $objFactura,
            'objEmpresa' => $objEmpresa,
            'plan' => $plan,
            'objStatus' => $objStatus,
            'objPeriodo' => $objPeriodo,
            'objMonedaCLP' => new MonedaModel(1),
            'objUsuario' => $objUsuario,
            'objCentroCosto' => $objCentroCosto,
            'centrosCosto' => $centrosCosto,
            'metodosPagos' => $metodosPagos,
            'metodoPago' => $metodoPago,
            'fechaPago' => $fechaPago
        ], [
            'js' => ['public/js/ver.js']
        ]);
    }

    /**
     * CRUD
     */
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
            case 'PAGAR': pagar();
            break;
            default: throw new Exception("Acción invalida.");
        }
    }
}