drop schema if exists proyecto_sc503;
drop user if exists adminvet;
CREATE SCHEMA proyecto_sc503;

create user 'adminvet'@'%' identified by 'Abc12345';

grant all privileges on proyecto_sc305.* to 'adminvet'@'%';

flush privileges;

/* tabla citas*/
create table proyecto_sc503.Citas(
  id_citas INT NOT NULL AUTO_INCREMENT,
  nombre_mascota VARCHAR(30)NOT NULL,
  nombre_duenno VARCHAR(30)NOT NULL,
  descripcion VARCHAR(30) NOT NULL,
  ruta_imagen varchar(1024) null,
  estado bool,
  activo bool,
  PRIMARY KEY (id_citas))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table proyecto_sc503.Persona(
    id_persona int auto_increment,
    idUser varchar(25),   /*numero cedula*/
    nombre varchar(20),
    username varchar(20),
    password varchar(10),
    rutaImagen varchar(1024),
    numero varchar(10),
    correo varchar(20),
    activo boolean, 
    primary key (id_persona)
    )
    ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

CREATE TABLE proyecto_sc503.usuario (
  id_usuario INT NOT NULL AUTO_INCREMENT,
  username varchar(20) NOT NULL,
  password varchar(200) NOT NULL,
  nombre VARCHAR(20) NOT NULL,
  apellidos VARCHAR(30) NOT NULL,
  correo VARCHAR(25) NULL,
  telefono VARCHAR(15) NULL,
  ruta_imagen varchar(200) NULL,
  activo boolean,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table proyecto_sc503.rol (
  id_rol INT NOT NULL AUTO_INCREMENT,
  nombre varchar(20),
  id_usuario int,
  PRIMARY KEY (id_rol),
  foreign key fk_rol_usuario (id_usuario) references usuario(id_usuario)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table proyecto_sc503.mascota(
    id_mascota int auto_increment,
    nombre varchar(20), 
    especie varchar(20), 
    sexo varchar(10),
    ruta_imagen varchar(1024),
    activo boolean,
	id_usuario int,
    primary key(id_mascota),
	foreign key fk_mascota_usuario (id_usuario) references usuario(id_usuario)
)
    ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table proyecto_sc503.expediente(
  id_expediente INT AUTO_INCREMENT,
  /*numeroExpediente varchar(10),*/
  nombre_mascota varchar(20),
  /*nombreDuenno varchar(30),*/
  veterinario varchar(30),
  padecimiento varchar(50),
  presion double,
  pulso double,
  temperatura double,
  peso double,
  talla double,
  edad int,
  /*ruta_imagen varchar(1024),*/
  activo bool,
  id_mascota int,
  PRIMARY KEY (id_expediente),
	foreign key fk_mascota_expediente (id_mascota) references mascota(id_mascota)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table proyecto_sc503.categoria (
  id_categoria INT NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(30) NOT NULL,
  ruta_imagen varchar(1024),
  activo bool,
  PRIMARY KEY (id_categoria))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table proyecto_sc503.producto (
  id_producto INT NOT NULL AUTO_INCREMENT,
  id_categoria INT NOT NULL,
  descripcion VARCHAR(30) NOT NULL,
  detalle VARCHAR(1600) NOT NULL, 
  precio double,
  existencias int,
  ruta_imagen varchar(1024),
  activo bool,
  PRIMARY KEY (id_producto),
  foreign key fk_producto_caregoria (id_categoria) references categoria(id_categoria)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;



insert into proyecto_sc503.Citas (id_citas, nombre_Mascota, nombre_Duenno, descripcion, ruta_imagen, estado, activo) values
(1, 'Rousseau', 'Marco','Labrador con vomitos','https://upload.wikimedia.org/wikipedia/commons/0/04/Labrador_Retriever_%281210559%29.jpg', 1, 1);
  
 /*Se insertan 3 registros en la tabla cliente como ejemplo */
INSERT INTO proyecto_sc503.usuario (id_usuario, username,password,nombre, apellidos, correo, telefono,ruta_imagen,activo) VALUES 
(1,'juan','$2a$10$P1.w58XvnaYQUQgZUCk4aO/RTRl8EValluCqB3S2VMLTbRt.tlre.','Juan', 'Castro Mora',    'jcastro@gmail.com',    '4556-8978', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Juan_Diego_Madrigal.jpg/250px-Juan_Diego_Madrigal.jpg',true),
(2,'rebeca','$2a$10$GkEj.ZzmQa/aEfDmtLIh3udIH5fMphx/35d0EYeqZL5uzgCJ0lQRi','Rebeca',  'Contreras Mora', 'acontreras@gmail.com', '5456-8789','https://upload.wikimedia.org/wikipedia/commons/0/06/Photo_of_Rebeca_Arthur.jpg',true),
(3,'pedro','$2a$10$koGR7eS22Pv5KdaVJKDcge04ZB53iMiw76.UjHPY.XyVYlYqXnPbO','Pedro', 'Mena Loria',     'lmena@gmail.com',      '7898-8936','https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Eduardo_de_Pedro_2019.jpg/480px-Eduardo_de_Pedro_2019.jpg?20200109230854',true);

insert into proyecto_sc503.rol (id_rol, nombre, id_usuario) values
 (1,'ROLE_ADMIN',1), (2,'ROLE_VENDEDOR',1), (3,'ROLE_USER',1),
 (4,'ROLE_VENDEDOR',2), (5,'ROLE_USER',2),
 (6,'ROLE_USER',3);