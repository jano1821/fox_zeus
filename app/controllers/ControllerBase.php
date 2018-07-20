<?php

use Phalcon\Mvc\Controller;
class ControllerBase extends Controller {

    public function validarSession() {
        if (!$this->session->has("Usuario")) {
            $this->response->redirect('index');
        }else {
            $usuario = $this->session->get("Usuario");

            $ultimoAcceso = $usuario['ultimoAcceso'];
            $tiempoSesion = $usuario['tiempoSesion'];

            $ahora = date("Y-n-j H:i:s");
            $tiempo_transcurrido = (strtotime($ahora) - strtotime($ultimoAcceso));

            if ($tiempo_transcurrido >= ($tiempoSesion * 60)) {
                $this->session->destroy();
                $this->response->redirect('index');
            }else {
                $usuario['ultimoAcceso'] = $ahora;
                $this->session->set('Usuario',
                                    $usuario);
            }
        }
    }

    public function validaAccesoSistema($codSistema,
                                        $codUsuario) {
        if ($this->buscarVinculoUsuarioSistema($codSistema,
                                               $codUsuario)) {
            $this->response->redirect('menu');
        }
    }

    private function buscarVinculoUsuarioSistema($codSistema,
                                                 $codUsuario) {
        $menu_sistema = $this->modelsManager->createBuilder()
                                ->columns("ms.codMenu ")
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
                                ->andWhere('ms.codSistema = :codSistema: AND ' .
                                                        'ms.codUsuario = :codUsuario: AND ' .
                                                        'ms.estadoRegistro = :estado: ',
                                           [
                                                'codSistema' => $codSistema,
                                                'codUsuario' => $codUsuario,
                                                'estado' => "S",
                                                        ]
                                )
                                ->getQuery()
                                ->execute();

        if (count($menu_sistema) > 0) {
            return false;
        }else {
            return true;
        }
    }

    public static function fromInput($dependencyInjector,
                                     $modelName,
                                     $data) {
        $conditions = array();
        if (count($data)) {
            $metaData = $dependencyInjector->getShared('modelsMetadata');
            $model = new $modelName();
            $dataTypes = $metaData->getDataTypes($model);
            $columnMap = $metaData->getReverseColumnMap($model);
            $bind = array();

            foreach ($data as $fieldName => $value) {
                if (isset($columnMap[$fieldName])) {
                    $field = $columnMap[$fieldName];
                }else {
                    continue;
                }

                if (isset($dataTypes[$field])) {
                    if (!is_null($value)) {
                        if ($value != '') {
                            /**
                             * si el campo es de tipo varchar o text aplicamos la clausula like
                             * int = 0
                             * timestamp = 1
                             * varchar = 2
                             * char = 5
                             * text = 6
                             */
                            //si es varchar text o timestamp utilizamos like
                            if ($dataTypes[$field] == 2 || $dataTypes[$field] == 6 || $dataTypes[$field] == 1) {
                                $condition = $fieldName . " LIKE :" . $fieldName . ":";
                                $bind[$fieldName] = '%' . $value . '%';
                            }
                            //en otro caso buscamos la búsqueda exacta
                            else {
                                $condition = $fieldName . ' = :' . $fieldName . ':';
                                $bind[$fieldName] = $value;
                            }
                            $conditions[] = $condition;
                        }
                    }
                }
            }
        }

        $criteria = new Criteria();
        if (count($conditions)) {
            $criteria->where(join(' AND ',
                                  $conditions));
            $criteria->bind($bind);
        }
        return $criteria;
    }

    public function obtenerParametros($codigoParametro) {
        $parametrosGenerales = $this->modelsManager->createBuilder()
                                ->columns("pg.valorParametro ")
                                ->addFrom('ParametrosGenerales',
                                          'pg')
                                ->andWhere('pg.identificadorParametro = :identificadorParametro: AND ' .
                                                        'pg.estadoRegistro = :estadoRegistro: ',
                                           [
                                                'identificadorParametro' => $codigoParametro,
                                                'estadoRegistro' => 'S',
                                                        ]
                                )
                                ->getQuery()
                                ->execute();

        if (count($parametrosGenerales) > 0) {
            return $parametrosGenerales[0]->valorParametro;
        }else {
            return "";
        }
    }

    public function validarAdministradores() {
        $usuario = $this->session->get("Usuario");

        $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];

        if ($indicadorUsuarioAdministrador == 'N') {
            $this->session->destroy();
            $this->response->redirect('index');
        }
    }

    public function generarSubMenu($codSistema,
                                   $codUsuario,
                                   $codEmpresa,
                                   $menuPrincipal) {
        $menuInventario = $this->modelsManager->createBuilder()
                                ->columns("su.descripcion," .
                                                        "su.indicadorSeparador," .
                                                        "su.indicadorAdministrador," .
                                                        "su.indicadorMenuPrincipal," .
                                                        "su.ordenMenu," .
                                                        "su.codMenuPadre," .
                                                        "su.codSistema," .
                                                        "su.codSubMenu," .
                                                        "su.urlSubmenu ")
                                ->addFrom('PermisoSubmenu',
                                          'ps')
                                ->innerJoin('Submenu',
                                            'ps.codSubmenu = su.codSubmenu',
                                            'su')
                                ->andWhere('ps.codUsuario like :usuario: AND ' .
                                                        'ps.codEmpresa = :codEmpresa: AND ' .
                                                        'ps.estadoRegistro = "S" AND ' .
                                                        'su.estadoRegistro = "S" AND ' .
                                                        'su.indicadorMenuPrincipal = :menuPrincipal: AND ' .
                                                        'su.codSistema like :sistema: ',
                                           [
                                                'usuario' => $codUsuario,
                                                'codEmpresa' => $codEmpresa,
                                                'sistema' => $codSistema,
                                                'menuPrincipal' => $menuPrincipal,
                                                        ]
                                )
                                ->orderBy('su.ordenMenu')
                                ->getQuery()
                                ->execute();

        return $menuInventario;
    }
    
    public function obtenerSubmenuSession($tipoSubMenu){
        $subMenu = '';
        if ($this->session->has("subMenuSistemas")) {
            $subMenuSistemas = $this->session->get("subMenuSistemas");
            if ($tipoSubMenu == 'P'){
            $subMenu = $subMenuSistemas['menuPrincipal'];
            } 
            if ($tipoSubMenu == 'S'){
            $subMenu = $subMenuSistemas['menuSecundario'];
            }
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }
        return $subMenu;
    }
}