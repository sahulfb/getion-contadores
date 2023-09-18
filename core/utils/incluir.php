<?php

/*================================================================================
 *--------------------------------------------------------------------------------
 *
 *	Incluir
 *
 *--------------------------------------------------------------------------------
================================================================================*/
class Incluir
{
    /**
     * Template
     */
    public static function template($pathContent, $parametros = [], $options = [])
    {
        // Acomodamos el archivo a incluir por el modulo
        $pathContent = BASE_DIR."/app/".Peticion::getControlador()."/{$pathContent}";

        // Definimos las opciones
        $options = self::templateOptions($options);
        $pathTemplate = BASE_DIR."/core/views/{$options['template']}";

        // Instanciamos el Smarty
        $smarty = new Smarty;
        $smarty->template_dir = BASE_DIR."/core/views";
        $smarty->compile_dir = BASE_DIR."/core/views/views_c";

        // General
        $smarty->assign('sistemaNombre', SISTEMA['nombre']);
        $smarty->assign('sistemaVersion', SISTEMA['version']);
        $smarty->assign('sistemaProduccion', PRODUCCION);
        $smarty->assign('base_url', BASE_URL);
        $smarty->assign('moneda', json_encode( new MonedaModel(1) ));
        $smarty->assign('_SERVER', $_SERVER);

        // Archivo a incluir
        $smarty->assign('_pathContent', $pathContent);
        $smarty->assign('_js', $options['js']);
        $smarty->assign('_css', $options['css']);

        foreach($parametros as $key => $value) {
            $smarty->assign($key, $value);
        }

        if($options['template'] == 'default.template.tpl') {
            // Variables de plantilla
            $menus = self::menus();
            $smarty->assign('templateMenus', $menus[0]);
            $smarty->assign('menuLateral', $menus[1]);
        }

        $smarty->display($pathTemplate);
    }

    /**
     * Analizador de las opciones del metodo 'template'
     */
    private static function templateOptions($arrayOptions) {
        $options = [
            "template" => "default.template.tpl",
            "js" => [],
            "css" => []
        ];

        if(isset($arrayOptions['template'])) {
            $options['template'] = $arrayOptions['template'];
        }
        
        if(isset($arrayOptions['js'])) {
            foreach($arrayOptions['js'] as $js) {
                $pathJs = (strpos($js, "http") === FALSE) ? 
                    BASE_URL."/app/".Peticion::getControlador()."/{$js}" :
                    $js;
                array_push($options['js'], $pathJs);
            }
        }

        if(isset($arrayOptions['css'])) {
            foreach($arrayOptions['css'] as $css) {
                $pathCss = (strpos($css, "http") === FALSE) ? 
                    BASE_URL."/app/".Peticion::getControlador()."/{$css}" :
                    $css;
                array_push($options['css'], $pathCss);
            }
        }

        return $options;
    }
    
    private static function menus() {
        $menus = [];

        array_push($menus, [
            'slug' => 'dashboard',
            'label' => 'Dashboard',
            'icon' => 'fas fa-home',
            'link' => BASE_URL,
            'con_opciones' => FALSE,
            'opciones' => [],
        ]);

        array_push($menus, [
            'slug' => 'tareas',
            'label' => 'Tareas',
            'icon' => 'far fa-circle',
            'link' => BASE_URL.'/Tareas/',
            'con_opciones' => FALSE,
            'opciones' => [],
        ]);

        array_push($menus, [
            'slug' => 'reportes',
            'label' => 'Reportes',
            'icon' => 'fas fa-list',
            'link' => NULL,
            'con_opciones' => TRUE,
            'opciones' => [
                [
                    'slug' => 'sub-reportes',
                    'label' => 'Reportes',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Reportes/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'caja',
                    'label' => 'Caja',
                    'icon' => 'fas fa-money-bill-wave',
                    'link' => BASE_URL.'/Caja/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ]
            ],
        ]);

        array_push($menus, [
            'slug' => 'gestion',
            'label' => 'Gestion',
            'icon' => 'fas fa-list',
            'link' => NULL,
            'con_opciones' => TRUE,
            'opciones' => [
                [
                    'slug' => 'facturas',
                    'label' => 'Facturas',
                    'icon' => 'fas fa-money-bill-wave',
                    'link' => NULL,
                    'con_opciones' => TRUE,
                    'opciones' => [
                        [
                            'slug' => 'por-generar',
                            'label' => 'Por generar',
                            'icon' => 'far fa-circle',
                            'link' => BASE_URL.'/Facturas/Por_Generar/',
                        ],
                        [
                            'slug' => 'reporte-general',
                            'label' => 'Reporte General',
                            'icon' => 'far fa-circle',
                            'link' => BASE_URL.'/Facturas/Index/',
                        ],
                        [
                            'slug' => 'pendientes',
                            'label' => 'Pendientes',
                            'icon' => 'far fa-circle',
                            'link' => BASE_URL.'/Facturas/Pendientes/',
                        ],
                        [
                            'slug' => 'anulados',
                            'label' => 'Anulados',
                            'icon' => 'far fa-circle',
                            'link' => BASE_URL.'/Facturas/Anulados/',
                        ],
                        [
                            'slug' => 'vencidos',
                            'label' => 'Vencidos',
                            'icon' => 'far fa-circle',
                            'link' => BASE_URL.'/Facturas/Vencidos/',
                        ],
                        [
                            'slug' => 'dicom',
                            'label' => 'Dicom',
                            'icon' => 'far fa-circle',
                            'link' => BASE_URL.'/Facturas/Dicom/',
                        ],
                    ],
                ],
                [
                    'slug' => 'cobros-adicionales',
                    'label' => 'Cobros Adicionales',
                    'icon' => 'fas fa-file-invoice-dollar',
                    'link' => BASE_URL.'/Cobros_Adicionales/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'egresos',
                    'label' => 'Egresos',
                    'icon' => 'fas fa-credit-card',
                    'link' => BASE_URL.'/Egresos/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
            ]
        ]);

        array_push($menus, [
            'slug' => 'mantenedores',
            'label' => 'Mantenedores',
            'icon' => 'fas fa-list',
            'link' => NULL,
            'con_opciones' => TRUE,
            'opciones' => [
                [
                    'slug' => 'periodo-contable',
                    'label' => 'Periodo contable',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Periodo_Contable/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'centro-costo',
                    'label' => 'Centros de costo',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Centros_costo/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'metodos-pago',
                    'label' => 'Metodos de pago',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Metodos_pago/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'planes',
                    'label' => 'Planes',
                    'icon' => 'fas fa-file-invoice-dollar',
                    'link' => BASE_URL.'/Planes/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'servicios',
                    'label' => 'Servicios',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Servicios/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'frecuencia-cobro',
                    'label' => 'Frecuencia de cobro',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Frecuencia_Cobro/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'monedas',
                    'label' => 'Monedas',
                    'icon' => 'fas fa-money-bill',
                    'link' => BASE_URL.'/Monedas/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
            ],
        ]);

        array_push($menus, [
            'slug' => 'empresas',
            'label' => 'Empresas',
            'icon' => 'fas fa-store',
            'link' => BASE_URL.'/Empresas/',
            'con_opciones' => FALSE,
            'opciones' => [],
        ]);

        array_push($menus, [
            'slug' => 'sistema',
            'label' => 'Sistema',
            'icon' => 'fas fa-cogs',
            'link' => NULL,
            'con_opciones' => TRUE,
            'opciones' => [
                [
                    'slug' => 'usuarios',
                    'label' => 'Usuarios',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Gestion_Sistema/Usuarios/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
                [
                    'slug' => 'roles',
                    'label' => 'Roles',
                    'icon' => 'far fa-circle',
                    'link' => BASE_URL.'/Gestion_Sistema/Roles/',
                    'con_opciones' => FALSE,
                    'opciones' => [],
                ],
            ],
        ]);

        $menus_lateral = [];
        $menusA = MenusAModel::BuscarPorRol(Sesion::Usuario()->idRol);
        foreach($menusA as $keyMenu => $menu) {
            $menu['conOpciones'] = boolval($menu['conOpciones']);
            $menu['opciones'] = [];
            if($menu['conOpciones']) {
                $menu['opciones'] = MenusBModel::BuscarPorRol(Sesion::Usuario()->idRol, $menu['idMenuA']);
            }

            if( !(isset($menus_lateral[$menu['seccion']]) && is_array($menus_lateral[$menu['seccion']])) ) {
                $menus_lateral[$menu['seccion']] = [];
            }
            array_push($menus_lateral[$menu['seccion']], $menu);
        }
        return [$menus, $menus_lateral];
    }
}