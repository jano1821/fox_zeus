
CREATE TABLE agencia
(
	codAgencia           INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL
);



ALTER TABLE agencia
ADD PRIMARY KEY (codAgencia);



CREATE TABLE almacen
(
	codAlmacen           INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE almacen
ADD PRIMARY KEY (codAlmacen);



CREATE TABLE cargo_empleado
(
	codCargo             INTEGER NOT NULL,
	decripcion           VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL
);



ALTER TABLE cargo_empleado
ADD PRIMARY KEY (codCargo);



CREATE TABLE categoria
(
	codCategoria         INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	indicadorExclusivo   VARCHAR(1) NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NULL
);



ALTER TABLE categoria
ADD PRIMARY KEY (codCategoria);



CREATE TABLE cliente
(
	codPersona           INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	fechaInsercion       DATETIME NULL,
	usuarioInsercion     VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	usuarioModificacion  VARCHAR(30) NULL
);



ALTER TABLE cliente
ADD PRIMARY KEY (codPersona);



CREATE TABLE compra
(
	codCompra            INTEGER NOT NULL,
	subTotal             DECIMAL(13,3) NOT NULL,
	total                DECIMAL(13,3) NOT NULL,
	igv                  DECIMAL(13,3) NOT NULL,
	fechaProceso         DATETIME NOT NULL,
	numeroSerie          VARCHAR(30) NULL,
	numeroComprobante    VARCHAR(30) NOT NULL,
	codComprobante       INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codProveedor         INTEGER NULL
);



ALTER TABLE compra
ADD PRIMARY KEY (codCompra);



CREATE TABLE comprobante
(
	codComprobante       INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	indicadorExclusivo   VARCHAR(1) NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE comprobante
ADD PRIMARY KEY (codComprobante);



CREATE TABLE correlativo_comprobante
(
	numeroCorrelativo    VARCHAR(30) NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codComprobante       INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL,
	codCorrelativo       INTEGER NOT NULL,
	serie                VARCHAR(20) NULL,
	codVenta             INTEGER NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE correlativo_comprobante
ADD PRIMARY KEY (codCorrelativo);



CREATE TABLE departamento
(
	codDepartamento      INTEGER NOT NULL,
	nombreDepartamento   VARCHAR(200) NOT NULL
);



ALTER TABLE departamento
ADD PRIMARY KEY (codDepartamento);



CREATE TABLE detalle_compra
(
	correlativoDetalle   INTEGER NOT NULL,
	monto                DECIMAL(13,3) NOT NULL,
	cantidad             DECIMAL(13,3) NOT NULL,
	codCompra            INTEGER NOT NULL
);



ALTER TABLE detalle_compra
ADD PRIMARY KEY (correlativoDetalle);



CREATE TABLE detalle_venta
(
	correlativoDetalle   INTEGER NOT NULL,
	monto                DECIMAL(13,3) NOT NULL,
	cantidad             DECIMAL(13,3) NOT NULL,
	codVenta             INTEGER NOT NULL
);



ALTER TABLE detalle_venta
ADD PRIMARY KEY (correlativoDetalle);



CREATE TABLE direccion
(
	codDireccion         INTEGER NOT NULL,
	direccion            VARCHAR(500) NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codDistrito          INTEGER NULL,
	codPersona           INTEGER NOT NULL
);



ALTER TABLE direccion
ADD PRIMARY KEY (codDireccion);



CREATE TABLE distrito
(
	codDistrito          INTEGER NOT NULL,
	nombreDistrito       VARCHAR(200) NOT NULL,
	codProvincia         INTEGER NOT NULL
);



ALTER TABLE distrito
ADD PRIMARY KEY (codDistrito);



CREATE TABLE empleado
(
	codPersona           INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	fechaInsercion       DATETIME NULL,
	usuarioInsercion     VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	usuarioModificacion  VARCHAR(30) NULL
);



ALTER TABLE empleado
ADD PRIMARY KEY (codPersona);



CREATE TABLE empresa
(
	codEmpresa           INTEGER NOT NULL,
	nombreEmpresa        VARCHAR(500) NOT NULL,
	razonSocial          VARCHAR(1000) NULL,
	limiteUsuarios       INTEGER NOT NULL,
	identificadorEmpresa VARCHAR(30) NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE empresa
ADD PRIMARY KEY (codEmpresa);



CREATE TABLE empresa_sistema
(
	codEmpresa           INTEGER NOT NULL,
	codSistema           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL
);



ALTER TABLE empresa_sistema
ADD PRIMARY KEY (codEmpresa,codSistema);



CREATE TABLE errores_sistema
(
	codError             INTEGER NOT NULL,
	descripcionError     VARCHAR(2000) NOT NULL,
	claseError           VARCHAR(2000) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuario              VARCHAR(30) NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE errores_sistema
ADD PRIMARY KEY (codError);



CREATE TABLE historico_movimientos
(
	codHistorico         INTEGER NOT NULL,
	fechaMovimiento      DATETIME NOT NULL,
	ingresoEgreso        VARCHAR(1) NOT NULL,
	codUbicacion         INTEGER NOT NULL,
	codAlmacen           INTEGER NOT NULL,
	codProducto          INTEGER NOT NULL,
	codPersona           INTEGER NOT NULL,
	codUnidad            INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE historico_movimientos
ADD PRIMARY KEY (codHistorico);



CREATE TABLE horario
(
	codHorario           INTEGER NOT NULL,
	horaIngreso          VARCHAR(50) NOT NULL,
	horaSalida           VARCHAR(50) NULL,
	horaDescanso         VARCHAR(50) NULL,
	horaRetorno          VARCHAR(50) NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codPersona           INTEGER NOT NULL,
	horaIngresoSabatino  VARCHAR(50) NULL,
	horaSalidaSabatino   VARCHAR(50) NULL
);



ALTER TABLE horario
ADD PRIMARY KEY (codHorario);



CREATE TABLE logistica
(
	codLogistica         INTEGER NOT NULL,
	stock                DECIMAL(13,3) NOT NULL,
	minimo               DECIMAL(13,3) NOT NULL,
	codProducto          INTEGER NOT NULL,
	codUnidad            INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAlmacen           INTEGER NOT NULL,
	stoack               DECIMAL(13,3) NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE logistica
ADD PRIMARY KEY (codLogistica);



CREATE TABLE marca
(
	codMarca             INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	indicadorExclusivo   VARCHAR(1) NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE marca
ADD PRIMARY KEY (codMarca);



CREATE TABLE menu
(
	codMenu              INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	id                   VARCHAR(100) NOT NULL,
	icono                VARCHAR(250) NULL,
	idBoton              VARCHAR(100) NULL,
	nombreBoton          VARCHAR(100) NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	tipoMenu             VARCHAR(1) NOT NULL,
	orden                INTEGER NOT NULL
);



ALTER TABLE menu
ADD PRIMARY KEY (codMenu);



CREATE TABLE menu_sistema
(
	codMenu              INTEGER NOT NULL,
	codSistema           INTEGER NOT NULL,
	codUsuario           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE menu_sistema
ADD PRIMARY KEY (codMenu,codSistema,codUsuario);



CREATE TABLE menu_usuario
(
	codMenu              INTEGER NOT NULL,
	codUsuario           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE menu_usuario
ADD PRIMARY KEY (codMenu,codUsuario);



CREATE TABLE modelo
(
	codModelo            INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	indicadorExclusivo   VARCHAR(1) NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE modelo
ADD PRIMARY KEY (codModelo);



CREATE TABLE operador
(
	codOperador          INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE operador
ADD PRIMARY KEY (codOperador);



CREATE TABLE parametros_generales
(
	codParametro         INTEGER NOT NULL,
	identificadorParametro VARCHAR(30) NOT NULL,
	valorParametro       VARCHAR(200) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	indicadorFijo        VARCHAR(1) NOT NULL,
	codEmpresa           INTEGER NOT NULL
);



ALTER TABLE parametros_generales
ADD PRIMARY KEY (codParametro);



CREATE TABLE permisos
(
	codPermiso           INTEGER NOT NULL,
	fechaPermiso         DATETIME NOT NULL,
	horasPermiso         VARCHAR(30) NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codPersona           INTEGER NULL
);



ALTER TABLE permisos
ADD PRIMARY KEY (codPermiso);



CREATE TABLE persona
(
	codPersona           INTEGER NOT NULL,
	nombrePersona        VARCHAR(250) NOT NULL,
	apePat               VARCHAR(200) NOT NULL,
	apeMat               VARCHAR(200) NOT NULL,
	sexo                 VARCHAR(1) NULL,
	edad                 INTEGER NULL,
	numeroDocumento      VARCHAR(30) NOT NULL,
	razonSocial          VARCHAR(250) NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codTipoDocumento     INTEGER NULL,
	tipoPersona          VARCHAR(1) NOT NULL,
	codEmpresa           INTEGER NOT NULL
);



ALTER TABLE persona
ADD PRIMARY KEY (codPersona);



CREATE TABLE precio
(
	codPrecio            INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	monto                DECIMAL(13,2) NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE precio
ADD PRIMARY KEY (codPrecio);



CREATE TABLE privilegios
(
	codCargo             INTEGER NULL,
	codPersona           INTEGER NOT NULL,
	codAgencia           INTEGER NULL
);



ALTER TABLE privilegios
ADD PRIMARY KEY (codPersona);



CREATE TABLE producto
(
	codProducto          INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	imagen               VARCHAR(150) NULL,
	fechaBaja            DATETIME NULL,
	motivoBaja           VARCHAR(250) NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codCategoria         INTEGER NOT NULL,
	codMarca             INTEGER NOT NULL,
	codModelo            INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	descripcionCorta     VARCHAR(50) NULL,
	fechaVencimiento     DATETIME NULL,
	fechaAlta            DATETIME NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE producto
ADD PRIMARY KEY (codProducto);



CREATE TABLE producto_precio
(
	codProducto          INTEGER NOT NULL,
	codPrecio            INTEGER NOT NULL
);



ALTER TABLE producto_precio
ADD PRIMARY KEY (codProducto,codPrecio);



CREATE TABLE producto_proveedor
(
	codProducto          INTEGER NOT NULL,
	codPersona           INTEGER NOT NULL
);



ALTER TABLE producto_proveedor
ADD PRIMARY KEY (codProducto,codPersona);



CREATE TABLE producto_unidad
(
	codUnidadPadre       INTEGER NOT NULL,
	correlativo          INTEGER NOT NULL,
	codUnidadHijo        INTEGER NOT NULL,
	codProducto          INTEGER NOT NULL,
	indicadorPrincipal   VARCHAR(1) NOT NULL,
	contenido            DECIMAL(13,3) NULL,
	estadoRegistro       VARCHAR(1) NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE producto_unidad
ADD PRIMARY KEY (correlativo);



CREATE TABLE proveedor
(
	codPersona           INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	estadoRegistro       VARCHAR(1) NULL,
	fechaInsercion       DATETIME NULL,
	usuarioInsercion     VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	usuarioModificacion  VARCHAR(30) NULL
);



ALTER TABLE proveedor
ADD PRIMARY KEY (codPersona);



CREATE TABLE provincia
(
	codProvincia         INTEGER NOT NULL,
	nombreProvincia      VARCHAR(200) NOT NULL,
	codDepartamento      INTEGER NOT NULL
);



ALTER TABLE provincia
ADD PRIMARY KEY (codProvincia);



CREATE TABLE registro_asistencia
(
	codRegistroAsistencia INTEGER NOT NULL,
	codTipoAsistencia    INTEGER NOT NULL,
	codPersona           INTEGER NOT NULL,
	hora                 VARCHAR(30) NOT NULL,
	fechaTransaccion     DATETIME NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	minTardanza          INTEGER NULL,
	indicadorClase       VARCHAR(1) NOT NULL
);



ALTER TABLE registro_asistencia
ADD PRIMARY KEY (codRegistroAsistencia);



CREATE TABLE seccion
(
	codSecion            INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE seccion
ADD PRIMARY KEY (codSecion);



CREATE TABLE sector
(
	codSector            INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE sector
ADD PRIMARY KEY (codSector);



CREATE TABLE sistema
(
	codSistema           INTEGER NOT NULL,
	etiquetaSistema      VARCHAR(200) NOT NULL,
	urlIcono             VARCHAR(500) NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	url                  VARCHAR(500) NULL,
	indicadorAdministrador VARCHAR(1) NULL
);



ALTER TABLE sistema
ADD PRIMARY KEY (codSistema);



CREATE TABLE telefono
(
	codTelefono          INTEGER NOT NULL,
	numeroTelefono       VARCHAR(30) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codOperador          INTEGER NOT NULL,
	codPersona           INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL
);



ALTER TABLE telefono
ADD PRIMARY KEY (codTelefono);



CREATE TABLE tipo_asistencia
(
	codTipoAsistencia    INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	orden                INTEGER NOT NULL
);



ALTER TABLE tipo_asistencia
ADD PRIMARY KEY (codTipoAsistencia);



CREATE TABLE tipo_documento
(
	codTipoDocumento     INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE tipo_documento
ADD PRIMARY KEY (codTipoDocumento);



CREATE TABLE tipo_pago
(
	codTipoPago          INTEGER NOT NULL,
	descripcion          VARCHAR(250) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL
);



ALTER TABLE tipo_pago
ADD PRIMARY KEY (codTipoPago);



CREATE TABLE ubicacion
(
	codUbicacion         INTEGER NOT NULL,
	codSecion            INTEGER NOT NULL,
	codZona              INTEGER NOT NULL,
	codSector            INTEGER NOT NULL,
	codAlmacen           INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codProducto          INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE ubicacion
ADD PRIMARY KEY (codUbicacion);



CREATE TABLE unidad_medida
(
	codUnidad            INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL
);



ALTER TABLE unidad_medida
ADD PRIMARY KEY (codUnidad);



CREATE TABLE usuario
(
	codUsuario           INTEGER NOT NULL,
	nombreUsuario        VARCHAR(30) NOT NULL,
	passwordUsuario      VARCHAR(200) NOT NULL,
	cantidadIntentos     INTEGER NOT NULL,
	indicadorUsuarioAdministrador VARCHAR(1) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codPersona           INTEGER NOT NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE usuario
ADD PRIMARY KEY (codUsuario);



CREATE TABLE venta
(
	codVenta             INTEGER NOT NULL,
	subTotal             DECIMAL(13,3) NOT NULL,
	total                DECIMAL(13,3) NOT NULL,
	igv                  DECIMAL(13,3) NOT NULL,
	fechaProceso         DATETIME NOT NULL,
	codTipoPago          INTEGER NOT NULL,
	codCliente           INTEGER NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL,
	codEmpleado          INTEGER NULL
);



ALTER TABLE venta
ADD PRIMARY KEY (codVenta);



CREATE TABLE zona
(
	codZona              INTEGER NOT NULL,
	descripcion          VARCHAR(100) NOT NULL,
	estadoRegistro       VARCHAR(1) NOT NULL,
	usuarioInsercion     VARCHAR(30) NOT NULL,
	fechaInsercion       DATETIME NOT NULL,
	usuarioModificacion  VARCHAR(30) NULL,
	fechaModificacion    DATETIME NULL,
	codEmpresa           INTEGER NOT NULL,
	codAgencia           INTEGER NOT NULL
);



ALTER TABLE zona
ADD PRIMARY KEY (codZona);



ALTER TABLE agencia
ADD FOREIGN KEY R_58 (codEmpresa) REFERENCES empresa (codEmpresa);



ALTER TABLE cliente
ADD FOREIGN KEY R_15 (codPersona) REFERENCES persona (codPersona);



ALTER TABLE compra
ADD FOREIGN KEY R_59 (codComprobante) REFERENCES comprobante (codComprobante);



ALTER TABLE compra
ADD FOREIGN KEY R_88 (codProveedor) REFERENCES proveedor (codPersona);



ALTER TABLE correlativo_comprobante
ADD FOREIGN KEY R_70 (codComprobante) REFERENCES comprobante (codComprobante);



ALTER TABLE correlativo_comprobante
ADD FOREIGN KEY R_83 (codVenta) REFERENCES venta (codVenta);



ALTER TABLE detalle_compra
ADD FOREIGN KEY R_60 (codCompra) REFERENCES compra (codCompra);



ALTER TABLE detalle_venta
ADD FOREIGN KEY R_24 (codVenta) REFERENCES venta (codVenta);



ALTER TABLE direccion
ADD FOREIGN KEY R_9 (codDistrito) REFERENCES distrito (codDistrito);



ALTER TABLE direccion
ADD FOREIGN KEY R_13 (codPersona) REFERENCES persona (codPersona);



ALTER TABLE distrito
ADD FOREIGN KEY R_8 (codProvincia) REFERENCES provincia (codProvincia);



ALTER TABLE empleado
ADD FOREIGN KEY R_16 (codPersona) REFERENCES persona (codPersona);



ALTER TABLE empresa_sistema
ADD FOREIGN KEY R_1 (codEmpresa) REFERENCES empresa (codEmpresa);



ALTER TABLE empresa_sistema
ADD FOREIGN KEY R_3 (codSistema) REFERENCES sistema (codSistema);



ALTER TABLE historico_movimientos
ADD FOREIGN KEY R_42 (codUbicacion) REFERENCES ubicacion (codUbicacion);



ALTER TABLE historico_movimientos
ADD FOREIGN KEY R_43 (codAlmacen) REFERENCES almacen (codAlmacen);



ALTER TABLE historico_movimientos
ADD FOREIGN KEY R_44 (codProducto) REFERENCES producto (codProducto);



ALTER TABLE historico_movimientos
ADD FOREIGN KEY R_46 (codPersona) REFERENCES proveedor (codPersona);



ALTER TABLE historico_movimientos
ADD FOREIGN KEY R_49 (codUnidad) REFERENCES unidad_medida (codUnidad);



ALTER TABLE horario
ADD FOREIGN KEY R_61 (codPersona) REFERENCES empleado (codPersona);



ALTER TABLE logistica
ADD FOREIGN KEY R_47 (codProducto) REFERENCES producto (codProducto);



ALTER TABLE logistica
ADD FOREIGN KEY R_48 (codUnidad) REFERENCES unidad_medida (codUnidad);



ALTER TABLE logistica
ADD FOREIGN KEY R_53 (codAlmacen) REFERENCES almacen (codAlmacen);



ALTER TABLE menu_sistema
ADD FOREIGN KEY R_79 (codMenu) REFERENCES menu (codMenu);



ALTER TABLE menu_sistema
ADD FOREIGN KEY R_81 (codSistema) REFERENCES sistema (codSistema);



ALTER TABLE menu_sistema
ADD FOREIGN KEY R_82 (codUsuario) REFERENCES usuario (codUsuario);



ALTER TABLE menu_usuario
ADD FOREIGN KEY R_72 (codMenu) REFERENCES menu (codMenu);



ALTER TABLE menu_usuario
ADD FOREIGN KEY R_74 (codUsuario) REFERENCES usuario (codUsuario);



ALTER TABLE permisos
ADD FOREIGN KEY R_64 (codPersona) REFERENCES empleado (codPersona);



ALTER TABLE persona
ADD FOREIGN KEY R_12 (codTipoDocumento) REFERENCES tipo_documento (codTipoDocumento);



ALTER TABLE privilegios
ADD FOREIGN KEY R_84 (codCargo) REFERENCES cargo_empleado (codCargo);



ALTER TABLE privilegios
ADD FOREIGN KEY R_86 (codPersona) REFERENCES empleado (codPersona);



ALTER TABLE producto
ADD FOREIGN KEY R_39 (codCategoria) REFERENCES categoria (codCategoria);



ALTER TABLE producto
ADD FOREIGN KEY R_40 (codMarca) REFERENCES marca (codMarca);



ALTER TABLE producto
ADD FOREIGN KEY R_41 (codModelo) REFERENCES modelo (codModelo);



ALTER TABLE producto_precio
ADD FOREIGN KEY R_54 (codProducto) REFERENCES producto (codProducto);



ALTER TABLE producto_precio
ADD FOREIGN KEY R_56 (codPrecio) REFERENCES precio (codPrecio);



ALTER TABLE producto_proveedor
ADD FOREIGN KEY R_25 (codProducto) REFERENCES producto (codProducto);



ALTER TABLE producto_proveedor
ADD FOREIGN KEY R_27 (codPersona) REFERENCES proveedor (codPersona);



ALTER TABLE producto_unidad
ADD FOREIGN KEY R_31 (codUnidadPadre) REFERENCES unidad_medida (codUnidad);



ALTER TABLE producto_unidad
ADD FOREIGN KEY R_32 (codUnidadHijo) REFERENCES unidad_medida (codUnidad);



ALTER TABLE producto_unidad
ADD FOREIGN KEY R_33 (codProducto) REFERENCES producto (codProducto);



ALTER TABLE proveedor
ADD FOREIGN KEY R_14 (codPersona) REFERENCES persona (codPersona);



ALTER TABLE provincia
ADD FOREIGN KEY R_7 (codDepartamento) REFERENCES departamento (codDepartamento);



ALTER TABLE registro_asistencia
ADD FOREIGN KEY R_62 (codTipoAsistencia) REFERENCES tipo_asistencia (codTipoAsistencia);



ALTER TABLE registro_asistencia
ADD FOREIGN KEY R_63 (codPersona) REFERENCES empleado (codPersona);



ALTER TABLE telefono
ADD FOREIGN KEY R_10 (codOperador) REFERENCES operador (codOperador);



ALTER TABLE telefono
ADD FOREIGN KEY R_11 (codPersona) REFERENCES persona (codPersona);



ALTER TABLE ubicacion
ADD FOREIGN KEY R_34 (codSecion) REFERENCES seccion (codSecion);



ALTER TABLE ubicacion
ADD FOREIGN KEY R_35 (codZona) REFERENCES zona (codZona);



ALTER TABLE ubicacion
ADD FOREIGN KEY R_36 (codSector) REFERENCES sector (codSector);



ALTER TABLE ubicacion
ADD FOREIGN KEY R_38 (codAlmacen) REFERENCES almacen (codAlmacen);



ALTER TABLE ubicacion
ADD FOREIGN KEY R_57 (codProducto) REFERENCES producto (codProducto);



ALTER TABLE usuario
ADD FOREIGN KEY R_17 (codPersona) REFERENCES empleado (codPersona);



ALTER TABLE venta
ADD FOREIGN KEY R_19 (codTipoPago) REFERENCES tipo_pago (codTipoPago);



ALTER TABLE venta
ADD FOREIGN KEY R_20 (codCliente) REFERENCES cliente (codPersona);



ALTER TABLE venta
ADD FOREIGN KEY R_87 (codEmpleado) REFERENCES empleado (codPersona);
