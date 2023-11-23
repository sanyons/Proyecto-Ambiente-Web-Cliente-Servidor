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

INSERT INTO persona (idUser, nombre, username, password, rutaImagen, numero, correo, activo)
VALUES 
('111111111', 'Juan Pérez', 'juanperez', 'clave123', '/ruta/imagen1.jpg', '1234567890', 'juan.perez@email.com', true),
('222222222', 'Ana Rodríguez', 'anarodriguez', 'clave456', '/ruta/imagen2.jpg', '9876543210', 'ana.rodriguez@email.com', true),
('333333333', 'Carlos Gómez', 'carlosgomez', 'clave789', '/ruta/imagen3.jpg', '5555555555', 'carlos.gomez@email.com', true),
('444444444', 'María López', 'marialopez', 'claveabc', '/ruta/imagen4.jpg', '7777777777', 'maria.lopez@email.com', true),
('555555555', 'Pedro Fernández', 'pedrofernandez', 'clavedef', '/ruta/imagen5.jpg', '9999999999', 'pedro.fernandez@email.com', true);


INSERT INTO usuario (username, password, nombre, apellidos, correo, telefono, ruta_imagen, activo)
VALUES 
('usuario1', 'password1', 'Usuario 1', 'Apellido 1', 'usuario1@email.com', '111111111', '/ruta/imagen_usuario1.jpg', true),
('usuario2', 'password2', 'Usuario 2', 'Apellido 2', 'usuario2@email.com', '222222222', '/ruta/imagen_usuario2.jpg', true),
('usuario3', 'password3', 'Usuario 3', 'Apellido 3', 'usuario3@email.com', '333333333', '/ruta/imagen_usuario3.jpg', true),
('usuario4', 'password4', 'Usuario 4', 'Apellido 4', 'usuario4@email.com', '444444444', '/ruta/imagen_usuario4.jpg', true),
('usuario5', 'password5', 'Usuario 5', 'Apellido 5', 'usuario5@email.com', '555555555', '/ruta/imagen_usuario5.jpg', true);


INSERT INTO rol (nombre, id_usuario)
VALUES 
('Administrador', 1),
('Cliente', 2),
('Cliente', 3),
('Administrador', 4),
('Cliente', 5);


INSERT INTO mascota (nombre, especie, sexo, ruta_imagen, activo, id_usuario)
VALUES 
('Mascota1', 'Perro', 'Macho', '/ruta/imagen_mascota1.jpg', true, 1),
('Mascota2', 'Gato', 'Hembra', '/ruta/imagen_mascota2.jpg', true, 2),
('Mascota3', 'Perro', 'Hembra', '/ruta/imagen_mascota3.jpg', true, 3),
('Mascota4', 'Conejo', 'Macho', '/ruta/imagen_mascota4.jpg', true, 4),
('Mascota5', 'Gato', 'Macho', '/ruta/imagen_mascota5.jpg', true, 5);


INSERT INTO expediente (nombre_mascota, veterinario, padecimiento, presion, pulso, temperatura, peso, talla, edad, activo, id_mascota)
VALUES 
('Mascota1', 'Vet1', 'Padecimiento1', 120, 80, 39.5, 10, 30, 5, true, 1),
('Mascota2', 'Vet2', 'Padecimiento2', 130, 85, 40.0, 12, 35, 6, true, 2),
('Mascota3', 'Vet3', 'Padecimiento3', 110, 78, 39.0, 9, 28, 4, true, 3),
('Mascota4', 'Vet4', 'Padecimiento4', 125, 82, 39.8, 11, 32, 5, true, 4),
('Mascota5', 'Vet5', 'Padecimiento5', 128, 84, 39.7, 10.5, 31, 6, true, 5);
