<?php

function consultar() {
    $monedas = MonedasModel::Buscar();
    $monedaCLP = new MonedaModel(1);
    
    for($i=0; $i<sizeof($monedas); $i++) {
        $onlyDate = explode(' ', $monedas[$i]['fecha_modificacion'])[0];
        $monedas[$i]['fecha_actualizacion'] = Formato::Fecha($onlyDate);
        $monedas[$i]['precioCLP'] = Formato::Precio($monedas[$i]['precioCLP'], 2);
    }
    
    sendJson([
        'CLP' => $monedaCLP,
        'monedas' => $monedas
    ]);
}

function modificar() {
    // Validamos la moneda
    $idMoneda = Input::post('idMoneda', TRUE);
    $objMoneda = new MonedaModel($idMoneda);

    // Recibimos los datos
    $nombre = Input::post('nombre', TRUE);
    $simbolo = Input::post('simbolo', TRUE);
    $decimales = (int) Input::post('decimales', TRUE);

    // Validamos
    if($decimales < 0 || $decimales > 10) {
        throw new Exception("El rango para los decimales es de 0 - 10.");
    }

    // Guardamos los datos
    $data = [];
    if($nombre != $objMoneda->nombre) {
        if(MonedasModel::ExisteNombre($nombre)) {
            throw new Exception("La moneda <b>{$nombre}</b> ya esta registrado.");
        }

        $data['nombre'] = $nombre;
    }
    if($simbolo != $objMoneda->simbolo) {
        $data['simbolo'] = $simbolo;
    }
    if($decimales != $objMoneda->decimales) {
        $data['decimales'] = $decimales;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objMoneda->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idMoneda' => $objMoneda->id
    ]);
}

function actualizar() {
    // Validamos la moneda
    $idMoneda = Input::post('idMoneda', TRUE);
    $objMoneda = new MonedaModel($idMoneda);

    $precioCLP = Input::post('precioCLP', TRUE);
    $precioCLP = bcdiv($precioCLP, '1', 2);

    $data = [];
    if($precioCLP != $objMoneda->precioCLP) {
        $data['precioCLP'] = $precioCLP;
    }

    if(sizeof($data) > 0) {
        Conexion::db()->startTransaction();
        $objMoneda->Modificar($data);
        Conexion::db()->commit();
    }

    sendJson([
        'idMoneda' => $objMoneda->id,
        'ok' => TRUE
    ]);
}