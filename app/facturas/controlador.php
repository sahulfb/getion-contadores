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
            "con_filtros" => TRUE,
            "status_defecto" => NULL,
        ], [
            'js' => ['public/js/index.js']
        ]);
    }

    public function pendientes() {
        $status = StatusFacturasModel::Buscar();
        $empresas = EmpresasModel::Buscar(['isDeleted' => '0']);

        Incluir::template('templates/index.tpl', [
            "status" => $status,
            "empresas" => $empresas,
            "titulo" => "Facturas - Pendientes",
            "con_filtros" => FALSE,
            "status_defecto" => 1,
        ], [
            'js' => ['public/js/index.js']
        ]);
    }

    public function anulados() {
        $status = StatusFacturasModel::Buscar();
        $empresas = EmpresasModel::Buscar(['isDeleted' => '0']);

        Incluir::template('templates/index.tpl', [
            "status" => $status,
            "empresas" => $empresas,
            "titulo" => "Facturas - Anulados",
            "con_filtros" => FALSE,
            "status_defecto" => 3,
        ], [
            'js' => ['public/js/index.js']
        ]);
    }

    public function vencidos() {
        $status = StatusFacturasModel::Buscar();
        $empresas = EmpresasModel::Buscar(['isDeleted' => '0']);

        Incluir::template('templates/index.tpl', [
            "status" => $status,
            "empresas" => $empresas,
            "titulo" => "Facturas - Vencidos",
            "con_filtros" => FALSE,
            "status_defecto" => 2,
        ], [
            'js' => ['public/js/index.js']
        ]);
    }

    /**
     * Nuevo
     */
    public function nuevo() {
        // Datos principales
        $objMonedaCLP = new MonedaModel(1);
        $periodosCobros = PeriodosContablesModel::Buscar(['isDeleted' => '0']);
        $empresas = EmpresasModel::Buscar(['isDeleted' => '0']);
        $centrosCosto = CentrosCostoModel::Buscar(['isDeleted' => '0']);
        $servicios = ServiciosModel::Buscar();

        // Complementos los datos traidos de la base de datos
        for($i=0; $i<sizeof($empresas); $i++) {
            $idPlan = $empresas[$i]['idPlan'];
            // Si es nulo continuamos
            if(is_null($idPlan)) {
                $empresas[$i]['plan'] = NULL;
                continue;
            }
            // Complementamos
            $objPlan = new PlanModel($empresas[$i]['idPlan']);
            $objMoneda = new MonedaModel($objPlan->idMoneda);
            $monto = $objPlan->monto * $objMoneda->precioCLP;
            $monto = bcdiv($monto, '1', $objMonedaCLP->decimales);
            $empresas[$i]['plan'] = [
                'id' => $objPlan->id,
                'monto' => Formato::Precio($monto, $objMonedaCLP->decimales, $objMonedaCLP->simbolo),
                'value' => $monto,
                'nombre' => $objPlan->nombre
            ];

            if($empresas[$i]['idPlan_sinMovimiento'] == NULL) $empresas[$i]['plan_sinMovimiento'] = NULL;
            else {
                $objPlan = new PlanModel($empresas[$i]['idPlan_sinMovimiento']);
                $objMoneda = new MonedaModel($objPlan->idMoneda);
                $monto = $objPlan->monto * $objMoneda->precioCLP;
                $monto = bcdiv($monto, '1', $objMonedaCLP->decimales);
                $empresas[$i]['plan_sinMovimiento'] = [
                    'id' => $objPlan->id,
                    'monto' => Formato::Precio($monto, $objMonedaCLP->decimales, $objMonedaCLP->simbolo),
                    'value' => $monto,
                    'nombre' => $objPlan->nombre
                ];
            }

            // Cobros adicionales
            $cobros_adicionales = array_reverse( CobrosAdicionalModel::Buscar(['empresa_id' => $empresas[$i]['idEmpresa']]) );
            foreach($cobros_adicionales as $key => $cobro) {
                $cobros_adicionales[$key]['periodos'] = CobrosAdicionalModel::Periodos($cobro['id']);
            }
            $empresas[$i]['cobros_adicionales'] = $cobros_adicionales;
        }

        // Incluimos
        Incluir::template('templates/nuevo.tpl', [
            "empresas" => $empresas,
            'empresasJson' => str_replace('\\', '\\\\', json_encode($empresas)),
            'statusPendiente' => new StatusFacturaModel(1),
            'periodosCobros' => $periodosCobros,
            'centrosCosto' => $centrosCosto,
            'servicios' => $servicios
        ], ['js' => ['public/js/nuevo.js']]);
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
        $objFactura->planValue = $objFactura->valorPlan;
        $objFactura->valorPlan = Formato::Precio($objFactura->valorPlan, $objMonedaCLP->decimales, $objMonedaCLP->simbolo);
        
        $servicios = ServiciosModel::Buscar();
        
        // Incluimos
        Incluir::template('templates/ver.tpl', [
            'objFactura' => $objFactura,
            'objEmpresa' => $objEmpresa,
            'plan' => $plan,
            'objStatus' => $objStatus,
            'json_objStatus' => str_replace('\\', '\\\\', json_encode($objStatus)),
            'objPeriodo' => $objPeriodo,
            'objMonedaCLP' => new MonedaModel(1),
            'objUsuario' => $objUsuario,
            'objCentroCosto' => $objCentroCosto,
            'centrosCosto' => $centrosCosto,
            'metodosPagos' => $metodosPagos,
            'metodoPago' => $metodoPago,
            'fechaPago' => $fechaPago,
            'periodosCobros' => PeriodosContablesModel::Buscar(['isDeleted' => '0']),
            'servicios' => $servicios,
            'cobros_adicionales' => $objFactura->cobros_adicionales,
            'tipo_plan' => ($objFactura->con_movimiento == '1') ? 'Con movimiento' : 'Sin movimiento',
        ], [
            'js' => ['public/js/ver.js']
        ]);
    }

    /**
     * Por generar
     */
    public function por_generar() {
        Incluir::template('templates/por_generar.tpl', [
            'periodos' => PeriodosContablesModel::Buscar(),
        ], [
            'js' => ['public/js/por_generar.js']
        ]);
    }

    /**
     * Ver empresa
     */
    public function ver_empresa($par = []) {
        try {
            if( !isset($par[0]) ) throw new Exception('No se ha enviado el identificador de las empresas.');
            $empresa = new EmpresaModel( $par[0] );
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }

        try {
            $plan = new PlanModel( $empresa->idPlan );
        } catch(Exception $e) {
            $plan = NULL;
        }

        try {
            $plan_sinMovimiento = new PlanModel( $empresa->idPlan_sinMovimiento );
        } catch(Exception $e) {
            $plan_sinMovimiento = NULL;
        }

        Conexion::db()->where('idEmpresa', $empresa->id);
        $facturas = Conexion::db()->get('facturas');
        foreach($facturas as $key => $factura) {
            $facturas[$key]['periodo_contable'] = new PeriodoContableModel($factura['idPeriodoContable']);
            $facturas[$key]['status'] = new StatusFacturaModel($factura['idStatus']);
        }

        Incluir::template('templates/ver_empresa.tpl', [
            'empresa' => $empresa,
            'plan' => [
                'id' => ($plan != NULL) ? $plan->id : NULL,
                'nombre' => ($plan != NULL) ? $plan->nombre : '(No aplica)',
                'detalle' => ($plan != NULL) ? $plan->detalle : '(No aplica)',
            ],
            'plan_sinMovimiento' => [
                'id' => ($plan_sinMovimiento != NULL) ? $plan_sinMovimiento->id : NULL,
                'nombre' => ($plan_sinMovimiento != NULL) ? $plan_sinMovimiento->nombre : '(No aplica)',
                'detalle' => ($plan_sinMovimiento != NULL) ? $plan_sinMovimiento->detalle : '(No aplica)',
            ],
            'facturas' => $facturas,
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
            case 'EMPRESAS': empresas();
            break;
            default: throw new Exception("Acción invalida.");
        }
    }
}