<?php

class GestionAccesosController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction($codSistema) {
        parent::validarSession();
        $codUsuario = '';
        $codEmpresa = '';
        $indicadorUsuarioAdministrador = '';
        $nombresPersona = '';
        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $nombresPersona = $usuario['nombresPersona'];
            $codUsuario = $usuario['codUsuario'];
            $codEmpresa = $usuario['codEmpresa'];
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }



        $this->view->nombreUsuario = $nombresPersona;
        $this->view->titulo = "Sistema de Inventario";
        $this->view->menuPrincipal = parent::obtenerSubmenuSession('P');
        $this->view->menuSecundario = parent::obtenerSubmenuSession('S');
        $this->view->indicadorUsuarioAdministrador = $indicadorUsuarioAdministrador;
        $this->tag->setDefault("codSistema",
                               $codSistema);
    }

    public function ajaxMenuPrincipalAction() {
        $this->view->disable();
        $arraySubSistemas = array();
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $codSistema = $this->request->getPost("codSistema");
                $codUsuario = $this->request->getPost("codUsuario");

                if ($this->session->has("Usuario")) {
                    $usuario = $this->session->get("Usuario");
                    $codEmpresa = $usuario['codEmpresa'];
                }else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $subSistemas = $this->modelsManager->createBuilder()
                                        ->columns("us.codSubMenu ")
                                        ->addFrom('PermisoSubmenu',
                                                  'us')
                                        ->andWhere('us.codUsuario = :usuario: AND ' .
                                                                'us.codEmpresa = :empresa: AND ' .
                                                                'us.estadoRegistro = "S" ',
                                                   [
                                                        'usuario' => $codUsuario,
                                                        'empresa' => $codEmpresa,
                                                                ]
                                        )
                                        ->getQuery()
                                        ->execute();
                if (count($subSistemas) > 0) {
                    foreach ($subSistemas as $item) {
                        array_push($arraySubSistemas,
                                   $item->codSubMenu);
                    }
                }else {
                    $arraySubSistemas = array(0);
                }

                $menuInventario = $this->modelsManager->createBuilder()
                                        ->columns("su.descripcion," .
                                                                "su.codSubMenu ")
                                        ->addFrom('Submenu',
                                                  'su')
                                        ->notInWhere('su.codSubMenu',
                                                     $arraySubSistemas
                                        )
                                        ->andWhere('su.estadoRegistro = "S" AND ' .
                                                                'su.indicadorMenuPrincipal = "S" AND ' .
                                                                'su.codSistema like :sistema: ',
                                                   [
                                                        'sistema' => $codSistema,
                                                                ]
                                        )
                                        ->orderBy('su.ordenMenu')
                                        ->getQuery()
                                        ->execute();

                $objetoPrincipal = "<select id='menuPrincipal' class='form-control'>";
                $objetoPrincipal = $objetoPrincipal . '<option value="0">Seleccionar Menú</option>';
                foreach ($menuInventario as $menu) {
                    $objetoPrincipal = $objetoPrincipal . '<option value="' . $menu->codSubMenu . '">';
                    $objetoPrincipal = $objetoPrincipal . $menu->descripcion;
                    $objetoPrincipal = $objetoPrincipal . '</option>';
                }

                $objetoPrincipal = $objetoPrincipal . "</select>";

                //BUSQUEDA DE MENU ASIGNADO POR USUARIO
                $menuSeleccionado = $this->modelsManager->createBuilder()
                                        ->columns("su.descripcion," .
                                                                "su.codSubMenu ")
                                        ->addFrom('PermisoSubmenu',
                                                  'ps')
                                        ->innerJoin('Submenu',
                                                    'ps.codSubmenu = su.codSubmenu',
                                                    'su')
                                        ->andWhere('ps.codUsuario like :usuario: AND ' .
                                                                'ps.codEmpresa = :codEmpresa: AND ' .
                                                                'ps.estadoRegistro = "S" AND ' .
                                                                'su.estadoRegistro = "S" AND ' .
                                                                'su.indicadorMenuPrincipal = "S" AND ' .
                                                                'su.codSistema like :sistema: ',
                                                   [
                                                        'usuario' => $codUsuario,
                                                        'codEmpresa' => $codEmpresa,
                                                        'sistema' => $codSistema,
                                                                ]
                                        )
                                        ->orderBy('su.ordenMenu')
                                        ->getQuery()
                                        ->execute();

                $objetoSeleccionado = "<select id='menuSeleccionado' class='form-control'>";
                $objetoSeleccionado = $objetoSeleccionado . '<option value="0">Seleccionar Menú</option>';
                foreach ($menuSeleccionado as $menu) {
                    $objetoSeleccionado = $objetoSeleccionado . '<option value="' . $menu->codSubMenu . '">';
                    $objetoSeleccionado = $objetoSeleccionado . $menu->descripcion;
                    $objetoSeleccionado = $objetoSeleccionado . '</option>';
                }

                $objetoSeleccionado = $objetoSeleccionado . "</select>";
                //FIN DE BUSQUEDA

                $this->response->setJsonContent(array('res' => array("codigo" => $objetoPrincipal, "seleccionado" => $objetoSeleccionado)));
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }
        }
    }

    public function agregharMenuPrincipal() {
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                //$codSistema = $this->request->getPost("codSistema");
                //$codUsuario = $this->request->getPost("codUsuario");

                if ($this->session->has("Usuario")) {
                    $usuario = $this->session->get("Usuario");
                    $codEmpresa = $usuario['codEmpresa'];
                }else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }
                
                //$this->response->setJsonContent(array('res' => array("codigo" => $objetoPrincipal, "seleccionado" => $objetoSeleccionado)));
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }
        }
    }
}