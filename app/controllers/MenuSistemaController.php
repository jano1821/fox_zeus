<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use MenuSistemaIndexForm as menuSistemaIndexForm;
use MenuSistemaNewForm as menuSistemaNewForm;
use MenuSistemaEditForm as menuSistemaEditForm;
class MenuSistemaController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();

        $this->view->form = new menuSistemaIndexForm();
    }

    public function searchAction() {
        parent::validarSession();

        $codMenu = $this->request->getPost("codMenu");
        $codSistema = $this->request->getPost("codSistema");
        $codUsuario = $this->request->getPost("codUsuario");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");



        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }
        $menu_sistema = $this->modelsManager->createBuilder()
                                ->columns("ms.codMenu," .
                                          "ms.codSistema," .
                                          "ms.codUsuario," .
                                          "si.etiquetaSistema," .
                                          "us.nombreUsuario, " .
                                          "me.descripcion, " .
                                          "if(ms.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('MenuSistema',
                                          'ms')
                                ->innerJoin('Menu',
                                            'me.codMenu = ms.codMenu',
                                            'me')
                                ->innerJoin('Sistema',
                                            'si.codSistema = ms.codSistema',
                                            'si')
                                ->innerJoin('Usuario',
                                            'us.codUsuario = ms.codUsuario',
                                            'us')
                                ->andWhere('ms.codMenu like :codMenu: AND ' .
                                                        'ms.codSistema like :codSistema: AND ' .
                                                        'ms.codUsuario like :codUsuario: AND ' .
                                                        'ms.estadoRegistro like :estado: ',
                                           [
                                                'codMenu' => "%" . $codMenu . "%",
                                                'codSistema' => "%" . $codSistema . "%",
                                                'codUsuario' => "%" . $codUsuario . "%",
                                                'estado' => "%" . $estado . "%",
                                                        ]
                                )
                                ->orderBy('si.etiquetaSistema')
                                ->getQuery()
                                ->execute();

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }else if ($avance == 1) {
            if ($pagina < floor(count($menu_sistema) / 10) + 1) {
                $pagina = $pagina + 1;
            }else {
                $this->flash->notice("No hay Registros Posteriores");
            }
        }else if ($avance == -1) {
            if ($pagina > 1) {
                $pagina = $pagina - 1;
            }else {
                $this->flash->notice("No hay Registros Anteriores");
            }
        }else if ($avance == 2) {
            $pagina = floor(count($menu_sistema) / 10) + 1;
        }

        if (count($menu_sistema) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "menu_sistema",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $menu_sistema,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        parent::validarSession();

        $this->view->form = new menuSistemaNewForm();
    }

    public function editAction($codMenu,$codSistema,$codUsuario) {
        parent::validarSession();
        if (!$this->request->isPost()) {

            $menu_sistema = $this->modelsManager->createBuilder()
                                ->columns("ms.codMenu," .
                                          "ms.codSistema," .
                                          "ms.codUsuario," .
                                          "si.etiquetaSistema," .
                                          "us.nombreUsuario, " .
                                          "me.descripcion,".
                                          "ms.estadoRegistro ")
                                ->addFrom('MenuSistema',
                                          'ms')
                                ->innerJoin('Menu',
                                            'me.codMenu = ms.codMenu',
                                            'me')
                                ->innerJoin('Sistema',
                                            'si.codSistema = ms.codSistema',
                                            'si')
                                ->innerJoin('Usuario',
                                            'us.codUsuario = ms.codUsuario',
                                            'us')
                                ->andWhere('ms.codMenu = :codMenu: AND ' .
                                                        'ms.codSistema = :codSistema: AND ' .
                                                        'ms.codUsuario = :codUsuario: ' ,
                                           [
                                                'codMenu' => "".$codMenu."",
                                                'codSistema' => "".$codSistema."",
                                                'codUsuario' => "".$codUsuario."",
                                                        ]
                                )
                                ->getQuery()
                                ->execute();
            
            if (!$menu_sistema) {
                $this->flash->error("Menu Sistema No Encontrado");

                $this->dispatcher->forward([
                                'controller' => "menu_sistema",
                                'action' => 'index'
                ]);

                return;
            }
            foreach($menu_sistema as $resp){

            $this->tag->setDefault("codMenu",
                                   $resp->codMenu);
            $this->tag->setDefault("nombreMenu",
                                   $resp->descripcion);
            $this->tag->setDefault("codSistema",
                                   $resp->codSistema);
            $this->tag->setDefault("nombreSistema",
                                   $resp->etiquetaSistema);
            $this->tag->setDefault("codUsuario",
                                   $resp->codUsuario);
            $this->tag->setDefault("nombreUsuario",
                                   $resp->nombreUsuario);
            $this->tag->setDefault("estadoRegistro",
                                   $resp->estadoRegistro);
            
            $this->view->form = new menuSistemaEditForm();
            }
        }
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $username = $usuario['nombreUsuario'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $menu_sistema = new MenuSistema();
        $menu_sistema->Codmenu = $this->request->getPost("codMenu");
        $menu_sistema->Codsistema = $this->request->getPost("codSistema");
        $menu_sistema->Codusuario = $this->request->getPost("codUsuario");
        $menu_sistema->Estadoregistro = "S";
        $menu_sistema->Usuarioinsercion = $username;
        $menu_sistema->Fechainsercion = strftime("%Y-%m-%d",
                                                 time());

        if (!$menu_sistema->save()) {
            foreach ($menu_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Menu Sistema Registrado Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => 'index'
        ]);
    }

    /**
     * Saves a menu_sistema edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $codMenu = $this->request->getPost("codMenu");
        $menu_sistema = MenuSistema::findFirstBycodMenu($codMenu);

        if (!$menu_sistema) {
            $this->flash->error("menu_sistema does not exist " . $codMenu);

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        $menu_sistema->Codmenu = $this->request->getPost("codMenu");
        $menu_sistema->Codsistema = $this->request->getPost("codSistema");
        $menu_sistema->Codusuario = $this->request->getPost("codUsuario");
        $menu_sistema->Estadoregistro = $this->request->getPost("estadoRegistro");
        $menu_sistema->Usuarioinsercion = $this->request->getPost("usuarioInsercion");
        $menu_sistema->Fechainsercion = $this->request->getPost("fechaInsercion");
        $menu_sistema->Usuariomodificacion = $this->request->getPost("usuarioModificacion");
        $menu_sistema->Fechamodificacion = $this->request->getPost("fechaModificacion");


        if (!$menu_sistema->save()) {

            foreach ($menu_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'edit',
                            'params' => [$menu_sistema->codMenu]
            ]);

            return;
        }

        $this->flash->success("menu_sistema was updated successfully");

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => 'index'
        ]);
    }

    /**
     * Deletes a menu_sistema
     *
     * @param string $codMenu
     */
    public function deleteAction($codMenu) {
        $menu_sistema = MenuSistema::findFirstBycodMenu($codMenu);
        if (!$menu_sistema) {
            $this->flash->error("menu_sistema was not found");

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$menu_sistema->delete()) {

            foreach ($menu_sistema->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "menu_sistema",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("menu_sistema was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => "index"
        ]);
    }

    public function ajaxPostSistemaAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        $arraySistemas = array();
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaSistema = $this->request->getPost("busquedaSistema");
                $usuarioSesion = $this->session->get("Usuario");
                $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                $codUsuario = $usuarioSesion['codUsuario'];
                $codEmpresa = $usuarioSesion['codEmpresa'];

                $sistemas = $this->modelsManager->createBuilder()
                                        ->columns("ms.codSistema ")
                                        ->addFrom('MenuSistema',
                                                  'ms')
                                        ->innerJoin('Usuario',
                                                    'ms.codUsuario = us.codUsuario ',
                                                    'us')
                                        ->andWhere('us.codUsuario = :usuario: AND ' .
                                                                'us.codEmpresa = :empresa: AND ' .
                                                                'us.estadoRegistro = :estado: ',
                                                   [
                                                        'usuario' => $codUsuario,
                                                        'empresa' => $codEmpresa,
                                                        'estado' => "S",
                                                                ]
                                        )
                                        ->getQuery()
                                        ->execute();
                if (count($sistemas) > 0) {
                    foreach ($sistemas as $item) {
                        array_push($arraySistemas,
                                   $item->codSistema);
                    }
                }else {
                    $arraySistemas = array(0);
                }
                if ($indicadorUsuarioAdministrador != 'Z') {
                    $sistema = $this->modelsManager->createBuilder()
                                            ->columns("si.codSistema, " .
                                                                    "si.etiquetaSistema ")
                                            ->addFrom('Sistema',
                                                      'si')
                                            ->inWhere('si.codSistema',
                                                      $arraySistemas)
                                            ->andWhere('si.etiquetaSistema like :etiquetaSistema: AND ' .
                                                                    'si.estadoRegistro like :estado: ',
                                                       [
                                                            'etiquetaSistema' => "%" . $labelBusquedaSistema . "%",
                                                            'estado' => "S",
                                                                    ]
                                            )
                                            ->orderBy('si.etiquetaSistema')
                                            ->getQuery()
                                            ->execute();
                }else {
                    $sistema = $this->modelsManager->createBuilder()
                                            ->columns("si.codSistema, " .
                                                                    "si.etiquetaSistema ")
                                            ->addFrom('Sistema',
                                                      'si')
                                            ->notInWhere('si.codSistema',
                                                         $arraySistemas)
                                            ->andWhere('si.etiquetaSistema like :etiquetaSistema: AND ' .
                                                                    'si.estadoRegistro like :estado: ',
                                                       [
                                                            'etiquetaSistema' => "%" . $labelBusquedaSistema . "%",
                                                            'estado' => "S",
                                                                    ]
                                            )
                                            ->orderBy('si.etiquetaSistema')
                                            ->getQuery()
                                            ->execute();
                }


                //$pagina = $this->request->getPost("pagina");
                //$avance = $this->request->getPost("avance");

                /* if ($pagina == "") {
                  $pagina = 1;
                  }
                  if ($avance == "" || $avance == "0") {
                  $pagina = 1;
                  }inWhere */


                $tabla = '<table class="table"><tr  class="warning">
                                    <th>N°</th>
                                    <th>Sistema</th>
                                    <th class="text-center" style="width: 36px;">Agregar</th>
				</tr>';

                foreach ($sistema as $item) {
                    $contador++;
                    $tabla = $tabla . '<tr><td>' . $contador;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $item->etiquetaSistema;
                    $tabla = $tabla . '</td><td class="text-center"> '
                                            . '<button type="button" class="btn btn-info" '
                                            . 'id="listaSistemas" '
                                            . 'data-dismiss="modal" '
                                            . 'onclick="agregarSistema(\'' . $item->codSistema . '\', \'' . $item->etiquetaSistema . '\');"> '
                                            . '<span class="glyphicon glyphicon-plus"></span>'
                                            . '</button></td></tr>';
                }

                $tabla = $tabla . '<tr>
                            <td colspan=5><span class="pull-right">
                                </span>
                            </td>
                        </tr>
                    </table>';

                $this->response->setJsonContent(array('res' => array("codigo" => $tabla)));
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }else {
                $this->response->setStatusCode(406,
                                               "Not Acceptable");
            }
        }else {
            $this->response->setStatusCode(404,
                                           "Not Found");
        }
    }

    public function ajaxPostMenuAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;

        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaMenu = $this->request->getPost("busquedaMenu");

                //$pagina = $this->request->getPost("pagina");
                //$avance = $this->request->getPost("avance");

                /* if ($pagina == "") {
                  $pagina = 1;
                  }
                  if ($avance == "" || $avance == "0") {
                  $pagina = 1;
                  } */

                $menu = $this->modelsManager->createBuilder()
                                        ->columns("me.descripcion," .
                                                                "me.codMenu")
                                        ->addFrom('Menu',
                                                  'me')
                                        ->andWhere('me.descripcion like :descripcion: ',
                                                   [
                                                        'descripcion' => "%" . $labelBusquedaMenu . "%",
                                                                ]
                                        )
                                        ->orderBy('me.descripcion')
                                        ->getQuery()
                                        ->execute();

                $tabla = '<table class="table"><tr  class="warning">
                                    <th>N°</th>
                                    <th>Menu</th>
                                    <th class="text-center" style="width: 36px;">Agregar</th>
				</tr>';

                foreach ($menu as $item) {
                    $contador++;
                    $tabla = $tabla . '<tr><td>' . $contador;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $item->descripcion;
                    $tabla = $tabla . '</td><td class="text-center"> '
                                            . '<button type="button" class="btn btn-info" '
                                            . 'id="listaMenu" '
                                            . 'data-dismiss="modal" '
                                            . 'onclick="agregarMenu(\'' . $item->codMenu . '\', \'' . $item->descripcion . '\');"> '
                                            . '<span class="glyphicon glyphicon-plus"></span>'
                                            . '</button></td></tr>';
                }

                $tabla = $tabla . '<tr>
                            <td colspan=5><span class="pull-right">
                                </span>
                            </td>
                        </tr>
                    </table>';

                $this->response->setJsonContent(array('res' => array("codigo" => $tabla)));
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }else {
                $this->response->setStatusCode(406,
                                               "Not Acceptable");
            }
        }else {
            $this->response->setStatusCode(404,
                                           "Not Found");
        }
    }

    public function ajaxPostUsuarioAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;

        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaUsuario = $this->request->getPost("busquedaUsuario");
                $usuarioSesion = $this->session->get("Usuario");
                $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                if ($indicadorUsuarioAdministrador != 'Z') {
                    $codEmpresa = $usuarioSesion['codEmpresa'];
                    $codUsuario = $usuarioSesion['codUsuario'];
                }else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }


                //$pagina = $this->request->getPost("pagina");
                //$avance = $this->request->getPost("avance");

                /* if ($pagina == "") {
                  $pagina = 1;
                  }
                  if ($avance == "" || $avance == "0") {
                  $pagina = 1;
                  } */

                $usuarios = $this->modelsManager->createBuilder()
                                        ->columns("em.nombreEmpresa," .
                                                                "us.nombreUsuario," .
                                                                "us.codUsuario")
                                        ->addFrom('Usuario',
                                                  'us')
                                        ->innerJoin('Empresa',
                                                    'us.codEmpresa = em.codEmpresa',
                                                    'em')
                                        ->andWhere('us.nombreUsuario like :nombreUsuario: AND ' .
                                                                'us.codEmpresa like :empresa: AND ' .
                                                                'us.codUsuario <> :usuario: ',
                                                   [
                                                        'nombreUsuario' => "%" . $labelBusquedaUsuario . "%",
                                                        'empresa' => $codEmpresa,
                                                        'usuario' => $codUsuario,
                                                                ]
                                        )
                                        ->orderBy('us.nombreUsuario')
                                        ->getQuery()
                                        ->execute();

                $tabla = '<table class="table"><tr  class="warning">
                                    <th>N°</th>
                                    <th>Usuario</th>
                                    <th>Empresa</th>
                                    <th class="text-center" style="width: 36px;">Agregar</th>
				</tr>';

                foreach ($usuarios as $usuario) {
                    $contador++;
                    $tabla = $tabla . '<tr><td>' . $contador;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $usuario->nombreUsuario;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $usuario->nombreEmpresa;
                    $tabla = $tabla . '</td><td class="text-center"> '
                                            . '<button type="button" class="btn btn-info" '
                                            . 'id="listaUsuarios" '
                                            . 'data-dismiss="modal" '
                                            . 'onclick="agregarUsuario(\'' . $usuario->codUsuario . '\', \'' . $usuario->nombreUsuario . '\');"> '
                                            . '<span class="glyphicon glyphicon-plus"></span>'
                                            . '</button></td></tr>';
                }

                $tabla = $tabla . '<tr>
                            <td colspan=5><span class="pull-right">
                                </span>
                            </td>
                        </tr>
                    </table>';

                $this->response->setJsonContent(array('res' => array("codigo" => $tabla)));
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }else {
                $this->response->setStatusCode(406,
                                               "Not Acceptable");
            }
        }else {
            $this->response->setStatusCode(404,
                                           "Not Found");
        }
    }

    public function resetAction() {
        parent::validarSession();

        $this->view->form = new menuSistemaIndexForm();

        $this->dispatcher->forward([
                        'controller' => "menu_sistema",
                        'action' => 'index'
        ]);

        return;
    }
}