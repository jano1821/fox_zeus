<?php
        $usuario = "";
        $username = "";
        $nombreEmpresa = "";
        $nombresPersona = "";
        $tiempoSesion = "";
        $indicadorUsuarioAdministrador = "";
        if ($this->session->has("Usuario")) {
            $usuario        =   $this->session->get("Usuario");
            
            $username       =   $usuario['nombreUsuario'];
            $nombreEmpresa  =   $usuario['nombreEmpresa'];
            $nombresPersona =   $usuario['nombresPersona'];
            $tiempoSesion   =   $usuario['tiempoSesion'];
            $indicadorUsuarioAdministrador = $usuario['indicadorUsuarioAdministrador'];
        }