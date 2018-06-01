<?php

use Phalcon\Paginator\Adapter\Model as Paginator;
use PersonaIndexForm as personaIndexForm;
use PersonaEditForm as personaEditForm;
use PersonaNewForm as personaNewForm;
class PersonaController extends ControllerBase {

    public function onConstruct() {
        parent::validarAdministradores();
    }

    public function indexAction() {
        parent::validarSession();

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }
        
        $parameters['order'] = "descripcion ASC";
        $tipoDocumento = TipoDocumento::find($parameters);

        $this->view->superAdmin = $indicadorUsuarioAdministrador;
        $this->view->tipoDocumento = $tipoDocumento;

        $this->view->form = new personaIndexForm();
    }

    public function searchAction() {
        parent::validarSession();
        $codEmpresa = $this->request->getPost("codEmpresa");

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
            $codPersonaSession = $usuario['codPersona'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        if ($indicadorUsuarioAdministrador != "Z") {
            $codEmpresa = $usuario['codEmpresa'];
        }

        $nombrePersona = $this->request->getPost("nombrePersona");
        $apePat = $this->request->getPost("apePat");
        $apeMat = $this->request->getPost("apeMat");
        $sexo = $this->request->getPost("sexo");
        $edad = $this->request->getPost("edad");
        $codTipoDocumento = $this->request->getPost("codTipoDocumento");
        $numeroDocumento = $this->request->getPost("numeroDocumento");
        $razonSocial = $this->request->getPost("razonSocial");
        $tipoPersona = $this->request->getPost("tipoPersona");
        $estado = $this->request->getPost("estadoRegistro");
        $pagina = $this->request->getPost("pagina");
        $avance = $this->request->getPost("avance");

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }

        $persona = $this->queryBusquedaPersona($nombrePersona,
                                               $apePat,
                                               $apeMat,
                                               $sexo,
                                               $edad,
                                               $numeroDocumento,
                                               $razonSocial,
                                               $codTipoDocumento,
                                               $tipoPersona,
                                               $codEmpresa,
                                               $estado,
                                               $indicadorUsuarioAdministrador,
                                               $codPersonaSession);

        if ($pagina == "") {
            $pagina = 1;
        }
        if ($avance == "" || $avance == "0") {
            $pagina = 1;
        }else if ($avance == 1) {
            if ($pagina < floor(count($persona) / 10) + 1) {
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
            $pagina = floor(count($persona) / 10) + 1;
        }

        if (count($persona) == 0) {
            $this->flash->notice("La Búqueda no ha Obtenido Resultados");

            $this->dispatcher->forward([
                            "controller" => "Persona",
                            "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
                        'data' => $persona,
                        'limit' => 10,
                        'page' => $pagina
        ]);

        $this->tag->setDefault("pagina",
                               $pagina);
        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        parent::validarSession();

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $parameters['order'] = "descripcion ASC";
        $tipoDocumento = TipoDocumento::find($parameters);

        $this->view->tipoDocumento = $tipoDocumento;
        $this->view->superAdmin = $indicadorUsuarioAdministrador;

        $this->view->form = new personaNewForm();
    }

    public function editAction($codPersona) {
        parent::validarSession();
        if (!$this->request->isPost()) {

            $persona = Persona::findFirstBycodPersona($codPersona);
            if (!$persona) {
                $this->flash->error("Persona no encontrada");

                $this->dispatcher->forward([
                                'controller' => "persona",
                                'action' => 'index'
                ]);

                return;
            }

            $parameters['order'] = "descripcion ASC";
            $tipoDocumento = TipoDocumento::find($parameters);

            $this->view->tipoDocumento = $tipoDocumento;


            $this->view->codPersona = $persona->codPersona;

            $this->tag->setDefault("codPersona",
                                   $persona->codPersona);

            $this->tag->setDefault("nombrePersona",
                                   $persona->nombrePersona);
            $this->tag->setDefault("apePat",
                                   $persona->apePat);
            $this->tag->setDefault("apeMat",
                                   $persona->apeMat);
            $this->tag->setDefault("sexo",
                                   $persona->sexo);
            $this->tag->setDefault("edad",
                                   $persona->edad);
            $this->tag->setDefault("numeroDocumento",
                                   $persona->numeroDocumento);
            $this->tag->setDefault("razonSocial",
                                   $persona->razonSocial);
            $this->tag->setDefault("estadoRegistro",
                                   $persona->estadoRegistro);
            $this->tag->setDefault("codTipoDocumento",
                                   $persona->codTipoDocumento);
            $this->tag->setDefault("tipoPersona",
                                   $persona->tipoPersona);
            $this->tag->setDefault("codEmpresa",
                                   $persona->codEmpresa);

            $this->view->form = new personaEditForm();
        }
    }

    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'index'
            ]);

            return;
        }

        if ($this->session->has("Usuario")) {
            $usuario = $this->session->get("Usuario");
            $username = $usuario['nombreUsuario'];
            $codEmpresa = $usuario['codEmpresa'];
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }else {
            $this->session->destroy();
            $this->response->redirect('index');
        }

        $persona = new Persona();
        $persona->Nombrepersona = $this->request->getPost("nombrePersona");
        $persona->Apepat = $this->request->getPost("apePat");
        $persona->Apemat = $this->request->getPost("apeMat");
        $persona->Sexo = $this->request->getPost("sexo");
        $persona->Edad = $this->request->getPost("edad");
        $persona->Numerodocumento = $this->request->getPost("numeroDocumento");
        $persona->Razonsocial = $this->request->getPost("razonSocial");
        $persona->Codtipodocumento = $this->request->getPost("codTipoDocumento");
        $persona->Tipopersona = $this->request->getPost("tipoPersona");
        if ($indicadorUsuarioAdministrador == "Z") {
            $persona->Codempresa = $this->request->getPost("codEmpresa");
        }else {
            $persona->Codempresa = $codEmpresa;
        }
        $persona->Estadoregistro = "S";
        $persona->Usuarioinsercion = $username;
        $persona->Fechainsercion = strftime("%Y-%m-%d",
                                            time());
        if (!$persona->save()) {
            foreach ($persona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Persona Registrada Satisfactoriamente");

        $this->dispatcher->forward([
                        'controller' => "persona",
                        'action' => 'index'
        ]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'index'
            ]);

            return;
        }

        $codPersona = $this->request->getPost("codPersona");
        $persona = Persona::findFirstBycodPersona($codPersona);

        if (!$persona) {
            $this->flash->error("Persona no Encontrada" . $codPersona);

            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'index'
            ]);

            return;
        }

        $form = new personaEditForm();
        if (!$this->request->isPost() || $form->isValid($this->request->getPost()) == false) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'edit'
            ]);

            return;
        }else {
            if ($this->session->has("Usuario")) {
                $usuario = $this->session->get("Usuario");
                $username = $usuario['nombreUsuario'];
                $codEmpresa = $usuario['codEmpresa'];
            }else {
                $this->session->destroy();
                $this->response->redirect('index');
            }

            $persona->Nombrepersona = $this->request->getPost("nombrePersona");
            $persona->Apepat = $this->request->getPost("apePat");
            $persona->Apemat = $this->request->getPost("apeMat");
            $persona->Sexo = $this->request->getPost("sexo");
            $persona->Edad = $this->request->getPost("edad");
            $persona->Numerodocumento = $this->request->getPost("numeroDocumento");
            $persona->Razonsocial = $this->request->getPost("razonSocial");
            $persona->Estadoregistro = $this->request->getPost("estadoRegistro");
            $persona->Usuariomodificacion = $username;
            $persona->Fechamodificacion = strftime("%Y-%m-%d",
                                                   time());
            $persona->Codtipodocumento = $this->request->getPost("codTipoDocumento");
            $persona->Tipopersona = $this->request->getPost("tipoPersona");
            $persona->Codempresa = $codEmpresa;


            if (!$persona->save()) {

                foreach ($sistema->getMessages() as $message) {
                    $this->flash->error($message);
                }

                $this->dispatcher->forward([
                                'controller' => "persona",
                                'action' => 'edit',
                                'params' => [$persona->codPersona]
                ]);

                return;
            }

            $this->flash->success("Persona Actualizada Satisfactoriamente");

            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'index'
            ]);
        }
    }

    public function deleteAction($codPersona) {
        $persona = Persona::findFirstBycodPersona($codPersona);
        if (!$persona) {
            $this->flash->error("persona was not found");

            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'index'
            ]);

            return;
        }

        if (!$persona->delete()) {

            foreach ($persona->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                            'controller' => "persona",
                            'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("persona was deleted successfully");

        $this->dispatcher->forward([
                        'controller' => "persona",
                        'action' => "index"
        ]);
    }

    public function resetAction() {
        parent::validarSession();

        $this->view->form = new personaIndexForm();

        $this->dispatcher->forward([
                        'controller' => "persona",
                        'action' => 'index'
        ]);

        return;
    }

    public function findById($codPersona) {
        $persona = $this->modelsManager->createBuilder()
                                ->columns("pe.codPersona," .
                                                        "pe.nombrePersona," .
                                                        "pe.apePat," .
                                                        "pe.apeMat," .
                                                        "if(pe.sexo='M','Masculino','Femenino') as sexo," .
                                                        "pe.edad," .
                                                        "pe.numeroDocumento," .
                                                        "pe.razonSocial," .
                                                        "td.descripcion as tipoDocumento," .
                                                        "if(pe.tipoPersona='N','Natural','Jurídica') as tipoPersona," .
                                                        "em.nombreEmpresa," .
                                                        "if(pe.estadoRegistro='S','Vigente','No Vigente') as estado")
                                ->addFrom('Persona',
                                          'pe')
                                ->innerJoin('TipoDocumento',
                                            'td.codTipoDocumento = pe.codTipoDocumento',
                                            'td')
                                ->innerJoin('Empresa',
                                            'em.codEmpresa = pe.codEmpresa',
                                            'em')
                                ->andWhere('pe.codPersona = :codePersona: AND ' .
                                                        'pe.estadoRegistro = :estado: ',
                                           [
                                                'codePersona' => $codPersona,
                                                'estado' => "S",
                                                        ]
                                )
                                ->getQuery()
                                ->execute();
        if (count($persona) <= 0) {
            $persona = array(array('', '', '', '', '', '', '', '', '', '', '', ''));
        }
        return $persona[0];
    }

    private function queryBusquedaPersona($nombrePersona,
                                          $apePat,
                                          $apeMat,
                                          $sexo,
                                          $edad,
                                          $numeroDocumento,
                                          $razonSocial,
                                          $codTipoDocumento,
                                          $tipoPersona,
                                          $codEmpresa,
                                          $estado,
                                          $superAdmin,
                                          $codPersonaSession) {
        if ($superAdmin == "Z") {
            if ($codEmpresa==""){
                $codEmpresa = "%";
            }
            $persona = $this->modelsManager->createBuilder()
                                    ->columns("pe.codPersona," .
                                                            "pe.nombrePersona," .
                                                            "pe.apePat," .
                                                            "pe.apeMat," .
                                                            "if(pe.sexo='M','Masculino','Femenino') as sexo," .
                                                            "pe.edad," .
                                                            "pe.numeroDocumento," .
                                                            "pe.razonSocial," .
                                                            "td.descripcion as tipoDocumento," .
                                                            "if(pe.tipoPersona='N','Natural','Jurídica') as tipoPersona," .
                                                            "em.nombreEmpresa," .
                                                            "if(pe.estadoRegistro='S','Vigente','No Vigente') as estado")
                                    ->addFrom('Persona',
                                              'pe')
                                    ->innerJoin('TipoDocumento',
                                                'td.codTipoDocumento = pe.codTipoDocumento',
                                                'td')
                                    ->innerJoin('Empresa',
                                                'em.codEmpresa = pe.codEmpresa',
                                                'em')
                                    ->andWhere('pe.nombrePersona like :nombrePersona: AND ' .
                                                            'pe.apePat like :apePat: AND ' .
                                                            'pe.apeMat like :apeMat: AND ' .
                                                            'pe.sexo like :sexo: AND ' .
                                                            'pe.edad like :edad: AND ' .
                                                            'pe.numeroDocumento like :numeroDocumento: AND ' .
                                                            'pe.razonSocial like :razonSocial: AND ' .
                                                            'pe.codTipoDocumento like :codTipoDocumento: AND ' .
                                                            'pe.tipoPersona like :tipoPersona: AND ' .
                                                            'pe.codEmpresa like :empresa: AND ' .
                                                            'pe.estadoRegistro like :estado: ',
                                               [
                                                    'nombrePersona' => "%" . $nombrePersona . "%",
                                                    'apePat' => "%" . $apePat . "%",
                                                    'apeMat' => "%" . $apeMat . "%",
                                                    'sexo' => "%" . $sexo . "%",
                                                    'edad' => "%" . $edad . "%",
                                                    'numeroDocumento' => "%" . $numeroDocumento . "%",
                                                    'razonSocial' => "%" . $razonSocial . "%",
                                                    'codTipoDocumento' => "%" . $codTipoDocumento . "%",
                                                    'tipoPersona' => "%" . $tipoPersona . "%",
                                                    'empresa' => $codEmpresa,
                                                    'estado' => "%" . $estado . "%",
                                                            ]
                                    )
                                    ->orderBy('pe.apePat')
                                    ->getQuery()
                                    ->execute();
        }else {
            $persona = $this->modelsManager->createBuilder()
                                    ->columns("pe.codPersona," .
                                                            "pe.nombrePersona," .
                                                            "pe.apePat," .
                                                            "pe.apeMat," .
                                                            "if(pe.sexo='M','Masculino','Femenino') as sexo," .
                                                            "pe.edad," .
                                                            "pe.numeroDocumento," .
                                                            "pe.razonSocial," .
                                                            "td.descripcion as tipoDocumento," .
                                                            "if(pe.tipoPersona='N','Natural','Jurídica') as tipoPersona," .
                                                            "em.nombreEmpresa," .
                                                            "if(pe.estadoRegistro='S','Vigente','No Vigente') as estado")
                                    ->addFrom('Persona',
                                              'pe')
                                    ->innerJoin('TipoDocumento',
                                                'td.codTipoDocumento = pe.codTipoDocumento',
                                                'td')
                                    ->innerJoin('Empresa',
                                                'em.codEmpresa = pe.codEmpresa',
                                                'em')
                                    ->andWhere('pe.nombrePersona like :nombrePersona: AND ' .
                                                            'pe.apePat like :apePat: AND ' .
                                                            'pe.apeMat like :apeMat: AND ' .
                                                            'pe.sexo like :sexo: AND ' .
                                                            'pe.edad like :edad: AND ' .
                                                            'pe.numeroDocumento like :numeroDocumento: AND ' .
                                                            'pe.razonSocial like :razonSocial: AND ' .
                                                            'pe.codTipoDocumento like :codTipoDocumento: AND ' .
                                                            'pe.tipoPersona like :tipoPersona: AND ' .
                                                            'pe.codEmpresa = :empresa: AND ' .
                                                            'pe.estadoRegistro like :estado: ',
                                               [
                                                    'nombrePersona' => "%" . $nombrePersona . "%",
                                                    'apePat' => "%" . $apePat . "%",
                                                    'apeMat' => "%" . $apeMat . "%",
                                                    'sexo' => "%" . $sexo . "%",
                                                    'edad' => "%" . $edad . "%",
                                                    'numeroDocumento' => "%" . $numeroDocumento . "%",
                                                    'razonSocial' => "%" . $razonSocial . "%",
                                                    'codTipoDocumento' => "%" . $codTipoDocumento . "%",
                                                    'tipoPersona' => "%" . $tipoPersona . "%",
                                                    'empresa' => $codEmpresa,
                                                    'estado' => "%" . $estado . "%",
                                                            ]
                                    )
                                    ->orderBy('pe.apePat')
                                    ->getQuery()
                                    ->execute();
        }
        return $persona;
    }
}