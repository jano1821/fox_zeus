<?php

class MenuController extends ControllerBase {

    public function indexAction() {
        parent::validarSession();

        $usuarioSesion = $this->session->get("Usuario");
        $codUsuario = $usuarioSesion['codUsuario'];
        $codEmpresa = $usuarioSesion['codEmpresa'];

        $menuUsuario = $this->modelsManager->createBuilder()
                                ->columns("me.descripcion, ".
                                          "me.id, ".
                                          "me.idBoton,".
                                          "me.nombreBoton,".
                                          "me.orden,".
                                          "mu.codMenu ")
                                ->addFrom("MenuUsuario",
                                          "mu")
                                ->innerJoin("Menu",
                                            "mu.codMenu = me.codMenu",
                                            "me")
                                ->innerJoin("Usuario",
                                            "mu.codUsuario = us.codUsuario",
                                            "us")
                                ->andWhere("mu.codUsuario = :usuario: AND ".
                                           "us.codEmpresa = :empresa: AND ".
                                           "mu.estadoRegistro = :estado: ",
                                           [
                                                "usuario" => $codUsuario,
                                                "empresa" => $codEmpresa,
                                                "estado" => "S",
                                           ]
                                )
                                ->orderBy('me.orden')
                                ->getQuery()
                                ->execute();
        
        $menuSistema = $this->modelsManager->createBuilder()
                                ->columns("ms.codMenu, ".
                                          "si.etiquetaSistema, ".
                                          "si.url,".
                                          "si.urlIcono ")
                                ->addFrom("MenuSistema",
                                          "ms")
                                ->innerJoin("Sistema",
                                            "ms.codSistema = si.codSistema",
                                            "si")
                                ->innerJoin("Usuario",
                                            "ms.codUsuario = us.codUsuario",
                                            "us")
                                ->andWhere("ms.codUsuario = :usuario: AND ".
                                           "us.codEmpresa = :empresa: AND ".
                                           "ms.estadoRegistro = :estado: ",
                                           [
                                                "usuario" => $codUsuario,
                                                "empresa" => $codEmpresa,
                                                "estado" => "S",
                                           ]
                                )
                                ->getQuery()
                                ->execute();

        
          $this->view->menu = $menuUsuario;
          $this->view->menuSistema = $menuSistema;
    }

    public function menuPrincipalAction() {
        parent::validarSession();
    }
}