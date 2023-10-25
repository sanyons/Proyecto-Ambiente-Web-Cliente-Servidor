veterinaria_db

/* tabla citas*/
create table citas(
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

create table persona(
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

CREATE TABLE usuario (
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

create table rol (
  id_rol INT NOT NULL AUTO_INCREMENT,
  nombre varchar(20),
  id_usuario int,
  PRIMARY KEY (id_rol),
  foreign key fk_rol_usuario (id_usuario) references usuario(id_usuario)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table mascota(
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

create table expediente(
  id_expediente INT AUTO_INCREMENT,
  nombre_mascota varchar(20),
  veterinario varchar(30),
  padecimiento varchar(50),
  presion double,
  pulso double,
  temperatura double,
  peso double,
  talla double,
  edad int,
  activo bool,
  id_mascota int,
  PRIMARY KEY (id_expediente),
	foreign key fk_mascota_expediente (id_mascota) references mascota(id_mascota)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table categoria (
  id_categoria INT NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(30) NOT NULL,
  ruta_imagen varchar(1024),
  activo bool,
  PRIMARY KEY (id_categoria))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;

create table producto (
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

ALTER TABLE citas
ADD COLUMN id_usuario INT,
ADD FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);

CREATE TABLE horarios (
    id_horario INT NOT NULL AUTO_INCREMENT,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    activo BOOLEAN,
    PRIMARY KEY (id_horario)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

ALTER TABLE citas
ADD COLUMN id_horario INT,
ADD FOREIGN KEY (id_horario) REFERENCES horarios(id_horario);

INSERT INTO horarios (hora_inicio, hora_fin, activo) VALUES
    ('08:00:00', '08:15:00', 1),
    ('08:15:00', '08:30:00', 1),
    -- Agregar más horarios disponibles
    ('16:45:00', '17:00:00', 1);

CREATE TABLE horarios_disponibles (
    id_horario INT NOT NULL AUTO_INCREMENT,
    dia_semana VARCHAR(10) NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    activo BOOLEAN,
    PRIMARY KEY (id_horario)
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4;

-- Insertar horarios disponibles para el lunes
INSERT INTO horarios_disponibles (dia_semana, hora_inicio, hora_fin, activo)
VALUES ('lunes', '08:00:00', '09:00:00', 1);

INSERT INTO horarios_disponibles (dia_semana, hora_inicio, hora_fin, activo)
VALUES ('lunes', '09:00:00', '10:00:00', 1);

-- Insertar horarios disponibles para el martes
INSERT INTO horarios_disponibles (dia_semana, hora_inicio, hora_fin, activo)
VALUES ('martes', '08:00:00', '09:00:00', 1);

INSERT INTO horarios_disponibles (dia_semana, hora_inicio, hora_fin, activo)
VALUES ('martes', '10:00:00', '11:00:00', 1);

-- Puedes seguir insertando horarios disponibles para otros días de la semana