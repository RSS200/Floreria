drop database if exists floreria;
create database floreria;
use floreria;



create table usuarios(
    id int not null primary key auto_increment,
    nombre varchar(255) not null,
    usuario varchar(255) not null,
    password varchar(255) not null,
    admin int not null,
    fecha_creacion datetime not null default current_timestamp()
    
);

CREATE TABLE categoria(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    activo BOOLEAN
);

CREATE TABLE arreglo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precioFlores DECIMAL(10, 2),
    precioManoObra DECIMAL(10, 2),
    activo BOOLEAN,
    descripcion VARCHAR(255),
    codigo VARCHAR(50)
);


CREATE TABLE flor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2),
    activo BOOLEAN,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categoria(id)
);

CREATE TABLE foto(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    id_arreglo INT,
    FOREIGN KEY (id_arreglo) REFERENCES arreglo(id)
);


CREATE TABLE flor_arreglo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    piezasFlor INT,
    precioUnitario DECIMAL(10, 2),
    precioTotal DECIMAL(10, 2),
    id_flor INT,
    id_arreglo INT,
    FOREIGN KEY (id_flor) REFERENCES flor(id),
    FOREIGN KEY (id_arreglo) REFERENCES arreglo(id)
);



insert into usuarios values (null,'Jose Braulio','usuario1','81dc9bdb52d04dc20036dbd8313ed055',1,'2023-05-06 14:31:00');
create view view_usuarios as select u.id, u.nombre, u.usuario, u.password, case u.admin when 1 then 'Administrador' else 'usuario'end as admin, DATE_FORMAT(u.fecha_creacion, '%d/%m/%Y') as fecha_creacion from usuarios u;
