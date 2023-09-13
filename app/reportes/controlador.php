<?php

class controlador
{
    public function index($par = []) {
        $objMonedaCLP = new MonedaModel(1);

        $anoActual = date('Y');
        $mesActual = (date('m') < 10) ? "0"+date('m') : date('m');
        $tarjetas = [];

        // Ventas pendientes de pago
        // Conexion::db()->where('idStatus', [1,2], 'IN');
        // $totalItem1 = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];
        // array_push($tarjetas, [
        //     'title' => 'Ventas pendientes de pago',
        //     'description' => 'Son todos con status pendientes y vencidos.',
        //     'class' => 'bg-warning text-black',
        //     'total' => $totalItem1
        // ]);

        // Ventas con pago vencido
        // Conexion::db()->where('idStatus', 2);
        // $totalItem2 = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];
        // array_push($tarjetas, [
        //     'title' => 'Ventas con pago vencido',
        //     'description' => 'Son todas las ventas con status vencido.',
        //     'class' => 'bg-warning text-black',
        //     'total' => $totalItem2
        // ]);

        // Ventas facturadas año en curso
        // Conexion::db()->where("fechaCobro >= '{$anoActual}-01-01'");
        // Conexion::db()->where('idStatus', [1,2,4], 'IN');
        // $totalItem3 = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];
        // array_push($tarjetas, [
        //     'title' => 'Ventas facturadas año en curso',
        //     'description' => 'Son todas las ventas con status Pagado, vencido y pendiente.',
        //     'class' => 'bg-warning text-black',
        //     'total' => $totalItem3
        // ]);

        // Formato::Precio($tarjeta.total, $objMonedaCLP->decimales)

        // Ventas facturadas mes en curso
        // Conexion::db()->where("fechaCobro >= '{$anoActual}-{$mesActual}-01'");
        // Conexion::db()->where('idStatus', [1,2,4], 'IN');
        // $totalItem5 = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];
        // array_push($tarjetas, [
        //     'title' => 'Ingreso del mes en curso',
        //     'description' => 'Son todas las ventas con status pagado dentro del mes en curso.',
        //     'class' => 'bg-primary text-white',
        //     'total' => $totalItem5
        // ]);

        // Egresos mensuales
        // Conexion::db()->where("fecha >= '{$anoActual}-{$mesActual}-01'");
        // Conexion::db()->where('idStatus', 1);
        // Conexion::db()->where('idCentroCosto <> \'1\'');
        // $totalItem7 = Conexion::db()->getOne('egresos', 'SUM(montoCLP) AS total')['total'];
        // array_push($tarjetas, [
        //     'title' => 'Egresos mensuales',
        //     'description' => 'Son todos los egresos del mes en curso sin considerar anulados y gastos personales Jose.',
        //     'class' => 'bg-success text-white',
        //     'total' => $totalItem7
        // ]);

        // Utilidades del mes
        // array_push($tarjetas, [
        //     'title' => 'Utilidades del mes',
        //     'description' => 'Resultado de la resta entre item 5 e item 7',
        //     'class' => 'bg-info text-white',
        //     'total' => $totalItem5 - $totalItem7
        // ]);

        // Renderizamos
        Incluir::template('templates/index.tpl', [
            'objMonedaCLP' => new MonedaModel(1),
            'today' => date("Y-m"),
            'next_month' => date('Y-m', strtotime("+1 months", strtotime( date("Y-m") ))),
        ], [
            'js' => ['public/js/index.js']
        ]);
    }
    
    public function api($par = []) {
        setHandlerJson();
        if( !isset($par[0]) ) throw new Exception('No se ha enviado la acción.');
        $accion = strtolower( $par[0] );
        switch($accion)
        {
            case 'consultar':
                $fecha_inicio = Input::post('fecha_inicio', TRUE);
                $fecha_fin = Input::post('fecha_fin', TRUE);

                $fecha_inicio = "{$fecha_inicio}-01";
                $fecha_fin = date("Y-m-t", strtotime($fecha_fin));

                $anoActual = date('Y');
                $mesActual = (date('m') < 10) ? "0"+date('m') : date('m');

                // Ventas pendientes de pago
                Conexion::db()->where('idStatus', [1,2], 'IN');
                $totalItem1 = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];
                
                // Ventas con pago vencido
                Conexion::db()->where('idStatus', 2);
                $totalItem2 = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];

                
                // Ventas facturadas año en curso
                Conexion::db()->where("fechaCobro >= '{$anoActual}-01-01'");
                Conexion::db()->where('idStatus', [1,2,4], 'IN');
                $totalItem3 = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];

                // Ventas facturadas
                Conexion::db()->where("fechaCobro >= '{$fecha_inicio}' AND fechaCobro <= '{$fecha_fin}'");
                Conexion::db()->where('idStatus', [1,2,4], 'IN');
                $ventas = Conexion::db()->getOne('facturas', 'SUM(valorCobrar) AS total')['total'];

                // Egresos
                Conexion::db()->where("fecha >= '{$fecha_inicio}' AND fecha <= '{$fecha_fin}'");
                Conexion::db()->where('idStatus', 1);
                Conexion::db()->where('idCentroCosto <> \'1\'');
                $egresos = Conexion::db()->getOne('egresos', 'SUM(montoCLP) AS total')['total'];

                // Utilidades
                $utlidades = $ventas - $egresos;

                // Enviamos
                sendJson([
                    'totalItem1'    => Formato::Numero( $totalItem1, 0 ),
                    'totalItem2'    => Formato::Numero( $totalItem2, 0 ),
                    'totalItem3'    => Formato::Numero( $totalItem3, 0 ),
                    'ventas'        => Formato::Numero( $ventas, 0 ),
                    'egresos'       => Formato::Numero( $egresos, 0 ),
                    'utlidades'     => Formato::Numero( $utlidades, 0 ),
                ]);
            break;

            default: throw new Exception('Acción invalida.');
        }
    }
}