<?php

function consultar() {
    $idRol = Input::post('idRol', TRUE);
    $objRol = new RolModel($idRol);

    $response = [];
    $menusA = MenusAModel::Buscar();
    foreach($menusA as $menuA) {
        $opciones = [];

        $menusB = MenusBModel::Buscar(['idMenuA' => $menuA['idMenuA']]);
        foreach($menusB as $menuB) {
            array_push($opciones, [
                "id" => $menuB['idMenuB'],
                "label" => $menuB['label'],
                "image" => $menuB['image'],
                "permiso" => MenusBModel::VerificarPermiso($objRol->id, $menuB['idMenuB'])
            ]);
        }

        array_push($response, [
            "id" => $menuA['idMenuA'],
            "label" => $menuA['label'],
            "image" => $menuA['image'],
            "permiso" => MenusAModel::VerificarPermiso($objRol->id, $menuA['idMenuA']),
            "opciones" => $opciones
        ]);
    }

    sendJson($response);
}

function cambiar() {
    $idRol = Input::post('idRol', TRUE);
    $tipo = Input::post('tipo', TRUE);
    $idMenu = Input::post('idMenu', TRUE);

    Conexion::db()->startTransaction();

    $objRol = new RolModel($idRol);
    if($tipo == "A") {
        $objMenu = new MenuAModel($idMenu);
        MenusAModel::CambiarPermiso($objRol->id, $objMenu->id);
    } else {
        $objMenu = new MenuBModel($idMenu);
        MenusBModel::CambiarPermiso($objRol->id, $objMenu->id);
    }
    
    Conexion::db()->commit();

    sendJson([
        'idRol' => $objRol->id,
        'nombre' => $objRol->nombre,
        'descripcion' => $objRol->descripcion,
        'fecha_registro' => $objRol->fecha_registro,
        'fecha_modificacion' => $objRol->fecha_modificacion,
    ]);
}