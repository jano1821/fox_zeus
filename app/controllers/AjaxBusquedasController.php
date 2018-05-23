<?php
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
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
                }else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }

                $personas = $this->modelsManager->createBuilder()
                                        ->columns("pe.codPersona, ".
                                                    "concat(pe.apePat,' ',pe.apeMat,' ',pe.nombrePersona) nombres, " .
                                                    "em.nombreEmpresa ")
                                        ->addFrom('Persona',
                                                  'pe')
                                        ->innerJoin('Empresa',
                                                    'pe.codEmpresa = em.codEmpresa',
                                                    'em')
                                        ->andWhere("upper(concat(pe.apePat,' ',pe.apeMat,' ',pe.nombrePersona)) like upper(:nombre:) AND " .
                                                                "pe.codEmpresa like :empresa: " ,
                                                   [
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
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }else {
                $this->response->setStatusCode(406,
                                               "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404,
                                           "Not Found");
        }
    }
    
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
                }else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }

                $empresas = $this->modelsManager->createBuilder()
                                        ->columns("em.codEmpresa, ".
                                                  "em.nombreEmpresa ")
                                        ->addFrom('Empresa',
                                                  'em')
                                        ->andWhere("upper(em.nombreEmpresa) like upper(:nombre:) AND " .
                                                                "em.codEmpresa like :empresa: " ,
                                                   [
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
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }else {
                $this->response->setStatusCode(406,
                                               "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404,
                                           "Not Found");
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
                }else {
                    $codEmpresa = "%";
                    $codUsuario = "";
                }

                $agencias = $this->modelsManager->createBuilder()
                                        ->columns("ag.codAgencia, ".
                                                    "ag.descripcion, " .
                                                    "em.nombreEmpresa ")
                                        ->addFrom('Agencia',
                                                  'ag')
                                        ->innerJoin('Empresa',
                                                    'ag.codEmpresa = em.codEmpresa',
                                                    'em')
                                        ->andWhere("upper(ag.descripcion) like upper(:nombre:) AND " .
                                                                "ag.codEmpresa like :empresa: " ,
                                                   [
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
                $this->response->setStatusCode(200,
                                               "OK");
                $this->response->send();
            }else {
                $this->response->setStatusCode(406,
                                               "Not Acceptable");
            }
        } else {
            $this->response->setStatusCode(404,
                                           "Not Found");
        }
    }
}