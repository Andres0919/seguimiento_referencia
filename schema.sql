/*
* Supportix Database
* @author Evilnapsis
*/

CREATE DATABASE seguimiento_referencia
USE seguimiento_referencia

CREATE TABLE Categoria(
	id int auto_increment primary key,
	nombre varchar(255)
);

CREATE TABLE Coleccion(
	id int auto_increment primary key,
	nombre varchar(255)
);

CREATE TABLE Referencia(
	id int auto_increment primary key,
	nombre varchar(255),
	categoria_id int,
	foreign key (categoria_id) references Categoria(id)
);

CREATE TABLE Area(
	id int auto_increment primary key,
	nombre varchar(255)
);

CREATE TABLE Planta(
	id int auto_increment primary key,
	nombre varchar(255)
);

CREATE TABLE EstadoMuestra(
	id int auto_increment primary key,
	nombre varchar(255)
);

CREATE TABLE ReferenciaColeccion(
	id int auto_increment primary key,
	referencia_id int,
	coleccion_id int,
	foreign key (referencia_id) references Referencia(id),
	foreign key (coleccion_id) references Coleccion(id)
);

CREATE TABLE ReferenciaMuestra(
	id int auto_increment primary key,
	referenciaColeccion_id int,
	muestra_id int,
	foreign key (referenciaColeccion_id) references ReferenciaColeccion(id),
	foreign key (muestra_id) references EstadoMuestra(id)
);

CREATE TABLE Usuario(
	id int auto_increment primary key,
	nombre varchar(255),
	contra varchar(255),
	rol int,
	planta_id int,
	area_id int,
	foreign key (area_id) references Area(id),
	foreign key (planta_id) references planta(id)
);

CREATE TABLE Proceso(
	id int auto_increment primary key,
	referenciaMuestra_id int,
	area_id int,
	fecha_inicio datetime,
	encargado_id int,
	observacion text,
	estado int,
	foreign key (area_id) references Area(id),
	foreign key (encargado_id) references Usuario(id),
	foreign key (referenciaMuestra_id) references ReferenciaMuestra(id)
);

CREATE TABLE Pinta(
	id int auto_increment primary key,
	codigo int,
	proceso_id int,
	fecha_fin datetime,
	estado int,
	foreign key (proceso_id) references Proceso(id)
);