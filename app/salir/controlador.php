<?php

class controlador
{
    public function index() {
        setHandlerJson();
        Sesion::Cerrar();
        sendJson(['ok' => TRUE]);
    }
}