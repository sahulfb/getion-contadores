<?php

class controlador
{
    public function index($par = []) {
        // Renderizamos
        Incluir::template('templates/index.tpl', [], []);
    }
}