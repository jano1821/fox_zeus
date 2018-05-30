<?php

class AjaxBusquedasController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function ajaxPostPersonaAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;

        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaPersona = $this->request->getPost("busquedaPersona");
                $usuarioSesion = $this->session->get("Usuario");
                $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                if ($indicadorUsuarioAdministrador != 'Z') {
                    $codEmpresa = $usuarioSesion['codEmpresa'];
                    $codUsuario = $usuarioSesion['codUsuario'];
                } else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }

                $personas = $this->modelsManager->createBuilder()
                        ->columns("pe.codPersona, " .
                                "concat(pe.apePat,' ',pe.apeMat,' ',pe.nombrePersona) nombres, " .
                                "em.nombreEmpresa ")
                        ->addFrom('Persona', 'pe')
                        ->innerJoin('Empresa', 'pe.codEmpresa = em.codEmpresa', 'em')
                        ->andWhere("upper(concat(pe.apePat,' ',pe.apeMat,' ',pe.nombrePersona)) like upper(:nombre:) AND " .
                                "pe.codEmpresa like :empresa: ", [
                            'nombre' => "%" . $labelBusquedaPersona . "%",
                            'empresa' => $codEmpresa,
                                ]
                        )
                        ->orderBy('pe.apePat')
                        ->getQuery()
                        ->execute();

                $tabla = '<table class="table"><tr  class="warning">
                                    <th>N°</th>
                                    <th>Persona</th>
                                    <th>Empresa</th>
                                    <th class="text-center" style="width: 36px;">Agregar</th>
				</tr>';

                foreach ($personas as $persona) {
                    $contador++;
                    $tabla = $tabla . '<tr><td>' . $contador;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $persona->nombres;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $persona->nombreEmpresa;
                    $tabla = $tabla . '</td><td class="text-center"> '
                            . '<button type="button" class="btn btn-info" '
                            . 'id="listaPersona" '
                            . 'data-dismiss="modal" '
                            . 'onclick="agregarPersona(\'' . $persona->codPersona . '\', \'' . $persona->nombres . '\');"> '
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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    //Busca todas las empresas
    public function ajaxPostEmpresaAction() {
        parent::validarSession();
        $this->view->disable();
        $tabla = '';
        $contador = 0;

        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaEmpresa = $this->request->getPost("busquedaEmpresa");
                $usuarioSesion = $this->session->get("Usuario");
                $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                if ($indicadorUsuarioAdministrador != 'Z') {
                    $codEmpresa = $usuarioSesion['codEmpresa'];
                    $codUsuario = $usuarioSesion['codUsuario'];
                } else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }

                $empresas = $this->modelsManager->createBuilder()
                        ->columns("em.codEmpresa, " .
                                "em.nombreEmpresa ")
                        ->addFrom('Empresa', 'em')
                        ->andWhere("upper(em.nombreEmpresa) like upper(:nombre:) AND " .
                                "em.codEmpresa like :empresa: ", [
                            'nombre' => "%" . $labelBusquedaEmpresa . "%",
                            'empresa' => $codEmpresa,
                                ]
                        )
                        ->orderBy('em.nombreEmpresa')
                        ->getQuery()
                        ->execute();

                $tabla = '<table class="table"><tr  class="warning">
                                    <th>N°</th>
                                    <th>Codigo</th>
                                    <th>Empresa</th>
                                    <th class="text-center" style="width: 36px;">Agregar</th>
				</tr>';

                foreach ($empresas as $empresa) {
                    $contador++;
                    $tabla = $tabla . '<tr><td>' . $contador;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $empresa->codEmpresa;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $empresa->nombreEmpresa;
                    $tabla = $tabla . '</td><td class="text-center"> '
                            . '<button type="button" class="btn btn-info" '
                            . 'id="listaPersona" '
                            . 'data-dismiss="modal" '
                            . 'onclick="agregarEmpresa(\'' . $empresa->codEmpresa . '\', \'' . $empresa->nombreEmpresa . '\');"> '
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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    public function ajaxPostAgenciaAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;

        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaAgencia = $this->request->getPost("busquedaAgencia");
                $usuarioSesion = $this->session->get("Usuario");
                $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                if ($indicadorUsuarioAdministrador != 'Z') {
                    $codEmpresa = $usuarioSesion['codEmpresa'];
                    $codUsuario = $usuarioSesion['codUsuario'];
                } else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }

                $agencias = $this->modelsManager->createBuilder()
                        ->columns("ag.codAgencia, " .
                                "ag.descripcion, " .
                                "em.nombreEmpresa ")
                        ->addFrom('Agencia', 'ag')
                        ->innerJoin('Empresa', 'ag.codEmpresa = em.codEmpresa', 'em')
                        ->andWhere("upper(ag.descripcion) like upper(:nombre:) AND " .
                                "ag.codEmpresa like :empresa: ", [
                            'nombre' => "%" . $labelBusquedaAgencia . "%",
                            'empresa' => $codEmpresa,
                                ]
                        )
                        ->orderBy('ag.descripcion')
                        ->getQuery()
                        ->execute();

                $tabla = '<table class="table"><tr  class="warning">
                                    <th>N°</th>
                                    <th>Agencia</th>
                                    <th>Empresa</th>
                                    <th class="text-center" style="width: 36px;">Agregar</th>
				</tr>';

                foreach ($agencias as $agencia) {
                    $contador++;
                    $tabla = $tabla . '<tr><td>' . $contador;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $agencia->descripcion;
                    $tabla = $tabla . '</td><td>';
                    $tabla = $tabla . $agencia->nombreEmpresa;
                    $tabla = $tabla . '</td><td class="text-center"> '
                            . '<button type="button" class="btn btn-info" '
                            . 'id="listaPersona" '
                            . 'data-dismiss="modal" '
                            . 'onclick="agregarAgencia(\'' . $agencia->codAgencia . '\', \'' . $agencia->descripcion . '\');"> '
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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    public function ajaxPostSistemaAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        $arraySistemas = array();
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                if ($this->session->has("Usuario")) {
                    $usuarioSesion = $this->session->get("Usuario");
                    $codEmpresa = $usuarioSesion['codEmpresa'];
                } else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $labelBusquedaSistema = $this->request->getPost("busquedaSistema");
                $codUsuario = $this->request->getPost("codUsuario");
                $codMenu = $this->request->getPost("codMenu");

                $menu = $this->modelsManager->createBuilder()
                        ->columns("me.tipoMenu ")
                        ->addFrom('Menu', 'me')
                        ->andWhere('me.codMenu = :codigo: ', [
                            'codigo' => $codMenu,
                                ]
                        )
                        ->getQuery()
                        ->execute();

                $sistemas = $this->modelsManager->createBuilder()
                        ->columns("ms.codSistema ")
                        ->addFrom('MenuSistema', 'ms')
                        ->innerJoin('Usuario', 'ms.codUsuario = us.codUsuario ', 'us')
                        ->andWhere('us.codUsuario = :usuario: AND ' .
                                'us.codEmpresa = :empresa: AND ' .
                                'us.estadoRegistro = :estado: ', [
                            'usuario' => $codUsuario,
                            'empresa' => $codEmpresa,
                            'estado' => "S",
                                ]
                        )
                        ->getQuery()
                        ->execute();
                if (count($sistemas) > 0) {
                    foreach ($sistemas as $item) {
                        array_push($arraySistemas, $item->codSistema);
                    }
                } else {
                    $arraySistemas = array(0);
                }
                $sistema = $this->modelsManager->createBuilder()
                        ->columns("si.codSistema, " .
                                "si.etiquetaSistema ")
                        ->addFrom('EmpresaSistema', 'es')
                        ->innerJoin('Sistema', 'es.codSistema = si.codSistema ', 'si')
                        ->notInWhere('si.codSistema', $arraySistemas)
                        ->andWhere('si.etiquetaSistema like :etiquetaSistema: AND ' .
                                'si.estadoRegistro like :estado: AND ' .
                                'si.indicadorAdministrador = :indicador: ', [
                            'etiquetaSistema' => "%" . $labelBusquedaSistema . "%",
                            'estado' => "S",
                            'indicador' => $menu[0]->tipoMenu,
                                ]
                        )
                        ->orderBy('si.etiquetaSistema')
                        ->getQuery()
                        ->execute();

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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    public function ajaxPostSistemaAgregarAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        $arraySistemas = array();
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                if ($this->session->has("Usuario")) {
                    $usuarioSesion = $this->session->get("Usuario");
                    $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                } else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $labelBusquedaSistema = $this->request->getPost("busquedaSistema");
                $codEmpresa = $this->request->getPost("codEmpresa");


                $sistemas = $this->modelsManager->createBuilder()
                        ->columns("es.codSistema ")
                        ->addFrom('EmpresaSistema', 'es')
                        ->andWhere('es.codEmpresa = :empresa: AND ' .
                                'es.estadoRegistro = :estado: ', [
                            'empresa' => $codEmpresa,
                            'estado' => "S",
                                ]
                        )
                        ->getQuery()
                        ->execute();
                if (count($sistemas) > 0) {
                    foreach ($sistemas as $item) {
                        array_push($arraySistemas, $item->codSistema);
                    }
                } else {
                    $arraySistemas = array(0);
                }
                if ($indicadorUsuarioAdministrador != 'N') {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom('Sistema', 'si')
                            ->notInWhere('si.codSistema', $arraySistemas)
                            ->andWhere('si.etiquetaSistema like :etiquetaSistema: AND ' .
                                    'si.estadoRegistro like :estado: ', [
                                'etiquetaSistema' => "%" . $labelBusquedaSistema . "%",
                                'estado' => "S",
                                    ]
                            )
                            ->orderBy('si.etiquetaSistema')
                            ->getQuery()
                            ->execute();
                } else {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom('Sistema', 'si')
                            ->andWhere('si.estadoRegistro like :estado: ', [
                                'estado' => "X",
                                    ]
                            )
                            ->getQuery()
                            ->execute();
                }

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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    //Busca los sistemas vinculados a la Empresa
    public function ajaxPostEmpresaSistemaAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                if ($this->session->has("Usuario")) {
                    $usuarioSesion = $this->session->get("Usuario");
                    $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                } else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $labelBusquedaSistema = $this->request->getPost("busquedaSistema");
                $codEmpresa = $this->request->getPost("codEmpresa");

                if ($indicadorUsuarioAdministrador != 'N') {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom('Sistema', 'si')
                            ->innerJoin('EmpresaSistema', 'si.codSistema = es.codSistema ', 'es')
                            ->andWhere('si.etiquetaSistema like :etiquetaSistema: AND ' .
                                    'si.estadoRegistro like :estado: AND ' .
                                    'es.codEmpresa = :empresa: ', [
                                'etiquetaSistema' => "%" . $labelBusquedaSistema . "%",
                                'estado' => "S",
                                'empresa' => $codEmpresa,
                                    ]
                            )
                            ->orderBy('si.etiquetaSistema')
                            ->getQuery()
                            ->execute();
                } else {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom('Sistema', 'si')
                            ->andWhere('si.estadoRegistro like :estado: ', [
                                'estado' => "X",
                                    ]
                            )
                            ->orderBy('si.etiquetaSistema')
                            ->getQuery()
                            ->execute();
                }

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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    //Busca los sistemas no vinculados a la Empresa
    public function ajaxPostEmpresaSistemaNoVinculadoAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        $arraySistemas = array();
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                if ($this->session->has("Usuario")) {
                    $usuarioSesion = $this->session->get("Usuario");
                    $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                } else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $labelBusquedaSistema = $this->request->getPost("busquedaSistema");
                $codEmpresa = $this->request->getPost("codEmpresa");

                $sistemas = $this->modelsManager->createBuilder()
                        ->columns("es.codSistema ")
                        ->addFrom('EmpresaSistema', 'es')
                        ->andWhere('es.codEmpresa = :empresa: AND ' .
                                'es.estadoRegistro = :estado: ', [
                            'empresa' => $codEmpresa,
                            'estado' => "S",
                                ]
                        )
                        ->getQuery()
                        ->execute();
                if (count($sistemas) > 0) {
                    foreach ($sistemas as $item) {
                        array_push($arraySistemas, $item->codSistema);
                    }
                } else {
                    $arraySistemas = array(0);
                }

                if ($indicadorUsuarioAdministrador != 'N') {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom('Sistema', 'si')
                            ->notInWhere('si.codSistema', $arraySistemas)
                            ->andWhere('upper(si.etiquetaSistema) like upper(:etiquetaSistema:) AND ' .
                                    'si.estadoRegistro like :estado: ', [
                                'etiquetaSistema' => "%" . $labelBusquedaSistema . "%",
                                'estado' => "S",
                                    ]
                            )
                            ->orderBy('si.etiquetaSistema')
                            ->getQuery()
                            ->execute();
                } else {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom('Sistema', 'si')
                            ->andWhere('si.estadoRegistro like :estado: ', [
                                'estado' => "X",
                                    ]
                            )
                            ->orderBy('si.etiquetaSistema')
                            ->getQuery()
                            ->execute();
                }

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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    public function ajaxPostMenuSistemaAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                if ($this->session->has("Usuario")) {
                    $usuarioSesion = $this->session->get("Usuario");
                    $indicadorUsuarioAdministrador = $usuarioSesion['indicadorUsuarioAdministrador'];
                } else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $labelBusquedaSistema = $this->request->getPost("busquedaSistema");
                $codUsuario = $this->request->getPost("codUsuario");
                $codMenu = $this->request->getPost("codMenu");

                if ($indicadorUsuarioAdministrador != 'N') {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom("Sistema", "si")
                            ->innerJoin("MenuSistema", "si.codSistema = ms.codSistema AND " .
                                    "ms.codUsuario = $codUsuario AND" .
                                    "ms.codMenu = $codMenu ", "ms")
                            ->innerJoin("MenuUsuario", "mu.codUsuario = $codUsuario AND " .
                                    "mu.codMenu = $codMenu ", "mu")
                            ->andWhere('si.etiquetaSistema like :etiquetaSistema: AND ' .
                                    'si.estadoRegistro like :estado: ', [
                                'etiquetaSistema' => "%" . $labelBusquedaSistema . "%",
                                'estado' => "S",
                                    ]
                            )
                            ->orderBy('si.etiquetaSistema')
                            ->getQuery()
                            ->execute();
                } else {
                    $sistema = $this->modelsManager->createBuilder()
                            ->columns("si.codSistema, " .
                                    "si.etiquetaSistema ")
                            ->addFrom('Sistema', 'si')
                            ->andWhere('si.estadoRegistro like :estado: ', [
                                'estado' => "X",
                                    ]
                            )
                            ->orderBy('si.etiquetaSistema')
                            ->getQuery()
                            ->execute();
                }

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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    //Busca menu relacionado con menu usuario sin restricciones
    public function ajaxPostMenuAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        $arrayMenu = array();

        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaMenu = $this->request->getPost("busquedaMenu");
                $codUsuario = $this->request->getPost("codUsuario");

                if ($this->session->has("Usuario")) {
                    $usuario = $this->session->get("Usuario");
                    $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
                } else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $menu = $this->modelsManager->createBuilder()
                        ->columns("mu.codMenu ")
                        ->addFrom('MenuUsuario', 'mu')
                        ->andWhere('mu.codUsuario = :usuario: ', [
                            'usuario' => $codUsuario,
                                ]
                        )
                        ->getQuery()
                        ->execute();

                if (count($menu) > 0) {
                    foreach ($menu as $item) {
                        array_push($arrayMenu, $item->codMenu);
                    }
                } else {
                    $arrayMenu = array(0);
                }

                if ($indicadorUsuarioAdministrador != "N") {
                    $menu = $this->modelsManager->createBuilder()
                            ->columns("me.descripcion," .
                                    "me.codMenu")
                            ->addFrom('Menu', 'me')
                            ->inWhere('me.codMenu', $arrayMenu)
                            ->andWhere('me.descripcion like :descripcion: ', [
                                'descripcion' => "%" . $labelBusquedaMenu . "%",
                                    ]
                            )
                            ->orderBy('me.descripcion')
                            ->getQuery()
                            ->execute();
                } else {
                    $menu = $this->modelsManager->createBuilder()
                            ->columns("'' descripcion," .
                                    "'' codMenu")
                            ->addFrom('Menu', 'me')
                            ->andWhere('me.descripcion = :descripcion: ', [
                                'descripcion' => "%",
                                    ]
                            )
                            ->getQuery()
                            ->execute();
                }
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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

    //Busca menus que no esten vinculado con el usuario
    public function ajaxPostNoMenuUsuarioAction() {
        $this->view->disable();
        $tabla = '';
        $contador = 0;
        $arrayMenu = array();

        if ($this->request->isPost() == true) {
            if ($this->request->isAjax() == true) {
                $labelBusquedaMenu = $this->request->getPost("busquedaMenu");
                $codUsuario = $this->request->getPost("codUsuario");

                if ($this->session->has("Usuario")) {
                    $usuario = $this->session->get("Usuario");
                    $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
                } else {
                    $this->session->destroy();
                    $this->response->redirect('index');
                }

                $menu = $this->modelsManager->createBuilder()
                        ->columns("mu.codMenu ")
                        ->addFrom('MenuUsuario', 'mu')
                        ->andWhere('mu.codUsuario = :usuario: ', [
                            'usuario' => $codUsuario,
                                ]
                        )
                        ->getQuery()
                        ->execute();

                if (count($menu) > 0) {
                    foreach ($menu as $item) {
                        array_push($arrayMenu, $item->codMenu);
                    }
                } else {
                    $arrayMenu = array(0);
                }

                if ($indicadorUsuarioAdministrador != "N") {
                    $menu = $this->modelsManager->createBuilder()
                            ->columns("me.descripcion," .
                                    "me.codMenu")
                            ->addFrom('Menu', 'me')
                            ->notInWhere('me.codMenu', $arrayMenu)
                            ->andWhere('me.descripcion like :descripcion: ', [
                                'descripcion' => "%" . $labelBusquedaMenu . "%",
                                    ]
                            )
                            ->orderBy('me.descripcion')
                            ->getQuery()
                            ->execute();
                } else {
                    $menu = $this->modelsManager->createBuilder()
                            ->columns("'' descripcion," .
                                    "'' codMenu")
                            ->addFrom('Menu', 'me')
                            ->andWhere('me.descripcion = :descripcion: ', [
                                'descripcion' => "%",
                                    ]
                            )
                            ->getQuery()
                            ->execute();
                }
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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
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
                } else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }

                $usuarios = $this->modelsManager->createBuilder()
                        ->columns("em.nombreEmpresa," .
                                "us.nombreUsuario," .
                                "us.codUsuario")
                        ->addFrom('Usuario', 'us')
                        ->innerJoin('Empresa', 'us.codEmpresa = em.codEmpresa', 'em')
                        ->andWhere('us.nombreUsuario like :nombreUsuario: AND ' .
                                'us.codEmpresa like :empresa: AND ' .
                                'us.codUsuario <> :usuario: ', [
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
                $this->response->setStatusCode(200, "OK");
                $this->response->send();
            } else {
                $this->response->setStatusCode(406, "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404, "Not Found");
        }
    }

}
