/*
RENOMBAR TABLA

ALTER TABLE cat_gnegocios RENAME TO cat_negocios

RENOMBAR COLUMNA DE UNA TABLA

ALTER TABLE cat_gnegocios renom CHANGE negocios negocio varchar(100) null;

MOFIGICAR COLUMNA SIN CAMBIAR NOMBRE

ALTER TABLE cat_negocios MODIFY negocio char(40) not null;

AÑADIR COLUMNA

ALTER TABLA cat_negocios ADD website varchar(100) not null;

AÑADIR RESTRICCION A COLUMNA

ALTER TABLE cat_negocios ADD CONSTRAINT uq_email UNIQUE(email);

BORRAR UNA COLUMNA

ALTER TABLE cat_negocios DROP website

*/

CREATE DATABASE IF NOT EXISTS soporte;
USE soporte;

CREATE TABLE cat_estatus(
	id_estatus int(10) auto_increment not null,
	estatus varchar(10) not null,
	CONSTRAINT pk_cat_estatus PRIMARY KEY(id_estatus)
)ENGINE=InnoDB;

CREATE TABLE cat_gnegocios(
	id_gnegocio int(10) auto_increment not null,
	gironegocio varchar(20) not null,
	CONSTRAINT pk_cat_gnegocios PRIMARY KEY(id_gnegocio)
)ENGINE=InnoDB;

CREATE TABLE negocios(
	id_negocios int(10) auto_increment not null,
	id_estatus int(10) not null,
	id_gnegocio int(10) not null,
	nombre varchar(15) not null,
	direccion varchar(25),
	fechainicio varchar(10),
	fechafin varchar(10),
	CONSTRAINT pk_negocios PRIMARY KEY(id_negocios),
	CONSTRAINT fk_negocio_estatus FOREIGN KEY(id_estatus) REFERENCES cat_estatus(id_estatus),
	CONSTRAINT fk_negocio_gnegocio FOREIGN KEY(id_gnegocio) REFERENCES cat_gnegocios(id_gnegocio)
)ENGINE=InnoDB;

CREATE TABLE cat_sucursales(
	id_sucursales int(10) auto_increment not null,
	id_negocios int(10) not null,
	sucursales varchar(20) not null,
	licencia varchar(15),
	CONSTRAINT pk_cat_sucursales PRIMARY KEY(id_sucursales),
	CONSTRAINT fk_sucursal_negocio FOREIGN KEY(id_negocios) REFERENCES negocios(id_negocios) 
)ENGINE=InnoDB;

CREATE TABLE cat_clientes(
	id_clientes int(10) auto_increment not null,
	id_negocios int(10) not null,
	nombre varchar(15) not null,
	apellidos varchar(25),
	telefono int(10),
	celular int(10),
	correo varchar(30),
	CONSTRAINT pk_cat_clientes PRIMARY KEY(id_clientes),
	CONSTRAINT fk_clientes_negocios FOREIGN KEY(id_negocios) REFERENCES negocios(id_negocios)
)ENGINE=InnoDB;

CREATE TABLE reportes(
	id_reportes int(10) auto_increment not null,
	id_clientes int(10) not null,
	id_negocios int(10) not null,
	id_estatus int(10) not null,
	fechareporta varchar(15) not null,
	fechasolucion varchar(15) not null,
	problema varchar(150),
	codigoreportes varchar(100),
	CONSTRAINT pk_reportes PRIMARY KEY(id_reportes),
	CONSTRAINT fk_reportes_clientes FOREIGN KEY(id_clientes) REFERENCES cat_clientes(id_clientes),
	CONSTRAINT fk_reportes_negocios FOREIGN KEY(id_negocios) REFERENCES negocios(id_negocios),
	CONSTRAINT fk_reportes_estatus FOREIGN KEY(id_estatus) REFERENCES cat_estatus(id_estatus)
)ENGINE=InnoDB;