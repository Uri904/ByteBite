CREATE DATABASE bytebite;
\c bytebite;

CREATE TABLE empleado(
id_empleado SERIAL PRIMARY KEY,
nombre_empleado VARCHAR(40) NOT NULL,
apellido_paterno VARCHAR(40) NOT NULL,
apellido_materno VARCHAR(40) NOT NULL,
calle VARCHAR(50),
municipio VARCHAR(50),
colonia VARCHAR(50),
codigo_postal int NOT NULL,
salario DECIMAL(10,2) NOT NULL,
telefono bigint NOT NULL);

CREATE TABLE administrador(
id_administrador serial PRIMARY KEY,
contraseña VARCHAR(10) NOT NULL,
id_empleado int NOT NULL,
FOREIGN KEY (id_empleado) REFERENCES empleado (id_empleado)on UPDATE CASCADE);

CREATE TABLE mesero(
id_mesero SERIAL PRIMARY KEY,
id_empleado int NOT NULL,
contra VARCHAR(50),
correo VARCHAR(50),
FOREIGN KEY (id_empleado) REFERENCES empleado (id_empleado)on UPDATE CASCADE);

CREATE TABLE cliente(
id_cliente SERIAL PRIMARY KEY,
nombre_cliente VARCHAR(40) NOT NULL);

CREATE TABLE pedido(
id_pedido SERIAL PRIMARY KEY,
costo DECIMAL (10,2) NOT NULL,
fecha DATE NOT NULL,
id_mesero int,
id_cliente int NOT NULL,
estado VARCHAR(20),
FOREIGN KEY (id_mesero) REFERENCES mesero (id_mesero)on UPDATE CASCADE,
FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente)on UPDATE CASCADE);

CREATE TABLE bebida(
id_bebida SERIAL PRIMARY KEY,
nombre_bebida VARCHAR(40) NOT NULL,
precio DECIMAL (10,2) NOT NULL,
descripcion VARCHAR(150) NOT NULL);

CREATE TABLE alcohol(
id_alcohol SERIAL PRIMARY KEY,
porsentaje int NOT NULL,
id_bebida int NOT NULL,
FOREIGN KEY (id_bebida) REFERENCES bebida (id_bebida)on UPDATE CASCADE);

CREATE TABLE jugo(
id_jugo SERIAL PRIMARY KEY,
fruta VARCHAR(40) NOT NULL,
id_bebida int NOT NULL,
FOREIGN KEY (id_bebida) REFERENCES bebida (id_bebida)on UPDATE CASCADE);

CREATE TABLE licuado(
id_licuado SERIAL PRIMARY KEY,
id_bebida int NOT NULL,
FOREIGN KEY (id_bebida) REFERENCES bebida (id_bebida)on UPDATE CASCADE);

CREATE TABLE platillo(
id_platillo SERIAL PRIMARY KEY,
nombre_platillo VARCHAR(40) NOT NULL,
precio DECIMAL (10,2) NOT NULL,
descripcion VARCHAR(150) NOT NULL);

CREATE TABLE postre(
id_postre SERIAL PRIMARY KEY,
id_platillo int NOT NULL,
FOREIGN KEY (id_platillo) REFERENCES platillo (id_platillo)on UPDATE CASCADE);

CREATE TABLE comida(
id_comida SERIAL PRIMARY KEY,
id_platillo int NOT NULL,
FOREIGN KEY (id_platillo) REFERENCES platillo (id_platillo)on UPDATE CASCADE);

CREATE TABLE guarnicion(
id_guarnicion SERIAL PRIMARY KEY,
cantidad_kg int NOT NULL,
id_platillo int NOT NULL,
FOREIGN KEY (id_platillo) REFERENCES platillo (id_platillo)on UPDATE CASCADE);

CREATE TABLE tiene(
id_tiene SERIAL PRIMARY KEY,
id_pedido int NOT NULL,
id_bebida int,
cantidad int NOT NULL,
FOREIGN KEY (id_pedido) REFERENCES pedido (id_pedido)on UPDATE CASCADE,
FOREIGN KEY (id_bebida) REFERENCES bebida (id_bebida)on UPDATE CASCADE);

CREATE TABLE contiene(
id_contiene SERIAL PRIMARY KEY,
id_pedido int NOT NULL,
id_platillo int,
cantidad int NOT NULL,
FOREIGN KEY (id_pedido) REFERENCES pedido (id_pedido)on UPDATE CASCADE,
FOREIGN KEY (id_platillo) REFERENCES platillo (id_platillo)on UPDATE CASCADE);


INSERT INTO administrador (contraseña, id_empleado)
VALUES
('root',1);



INSERT INTO bebida (id_bebida,nombre_bebida, precio, descripcion)
VALUES
    (1,'Pastel', 60.00, 'pastel de chocolate.'),
    (2,'Tarta Lima', 45.00, 'Tarta de limón.'),
    (3,'Cheesecake', 55.00, 'Cheesecake .'),
    (4,'Helado', 30.00, 'Helado de vainilla.'),
    (5,'Crepas', 50.00, 'Crepas de crema.'),
    (6,'Filete', 180.00, 'Filete de salmón.'),
    (7,'Pasta', 150.00, 'Pasta fetuccini'),
	(8,'Carnitas', 120.00, 'Tacos mexicanos.'),
    (9,'Ensalada César', 130.00, 'Ensalada césar.'),
    (10,'Hamburguesa', 110.00, 'Hamburguesa '),
    (11,'Pastel', 60.00, 'pastel de chocolate.'),
    (12,'Tarta Lima', 45.00, 'Tarta de limón.'),
    (13,'Cheesecake', 55.00, 'Cheesecake .'),
    (14,'Helado', 30.00, 'Helado de vainilla.'),
    (15,'Crepas', 50.00, 'Crepas de crema.'),
    (16,'Filete', 180.00, 'Filete de salmón.'),
    (17,'Pasta', 150.00, 'Pasta fetuccini'),
	(18,'Carnitas', 120.00, 'Tacos mexicanos.'),
    (19,'Ensalada César', 130.00, 'Ensalada césar.'),
    (20,'Hamburguesa', 110.00, 'Hamburguesa '),
    (21,'Pastel', 60.00, 'pastel de chocolate.'),
    (22,'Tarta Lima', 45.00, 'Tarta de limón.'),
    (23,'Cheesecake', 55.00, 'Cheesecake .'),
    (24,'Helado', 30.00, 'Helado de vainilla.'),
    (25,'Crepas', 50.00, 'Crepas de crema.'),
    (26,'Filete', 180.00, 'Filete de salmón.'),
    (27,'Pasta', 150.00, 'Pasta fetuccini'),
	(28,'Carnitas', 120.00, 'Tacos mexicanos.'),
    (29,'Ensalada César', 130.00, 'Ensalada césar.'),
    (30,'Hamburguesa', 110.00, 'Hamburguesa ');

INSERT INTO alcohol (porsentaje, id_bebida)
VALUES
(40, 1),
(20, 2),
(30, 3),
(40, 4),
(35, 5);

INSERT INTO jugo (fruta, id_bebida)
VALUES
('Naranja', 6),
('Manzana', 7),
('Piña', 8),
('Fresa', 9),
('Mixto', 10);

INSERT INTO licuado (id_bebida)
VALUES
(11),
(12),
(13),
(14),
(15);

INSERT INTO platillo (id_platillo,nombre_platillo, precio, descripcion)
VALUES
    (1,'Tiramisú', 144.00, 'Postre italiano de capas de bizcocho empapado en café, mascarpone y cacao.'),
    (2,'Churros', 108.00, 'Dulces fritos de masa, espolvoreados con azúcar.'),
    (3,'Cheesecake', 126.00, ' Pastel de queso cremoso sobre una base de galleta, a menudo con una capa de fruta..'),
    (4,'Macarons', 216.00, ' Galletas francesas hechas de merengue de almendra, rellenas con ganache.'),
    (5,'Gelato', 72.00, 'Helado italiano más denso y cremoso que el helado tradicional.'),
    (6,'Pavlova', 126.00, ' Merengue crujiente por fuera y suave por dentro, cubierto con crema y frutas.'),
    (7,'Tres Leches', 108.00, 'Pastel latinoamericano empapado en una mezcla de tres tipos de leche.'),
	(8,'Baklava', 108.00, 'Postre del Medio Oriente de capas de masa rellenas con nueces y bañadas en almíbar.'),
    (9,'Crema Catalana', 126.00, 'Postre español similar a la crème brûlée, con una capa de azúcar caramelizado.'),
    (10,'Brownie', 72.00, 'Pastel de chocolate denso y húmedo, a menudo con nueces. '),
    (11,'Paella', 450.00, 'Plato español de arroz con mariscos, pollo y verduras, sazonado con azafrán.'),
    (12,'Sushi', 360.00, 'Comida japonesa que consiste en pescado crudo, arroz y algas.'),
    (13,'Tacos al Pastor', 180.00, 'Tacos mexicanos de carne marinada y asada.'),
    (14,'Lasagna', 270.00, 'Plato italiano de capas de pasta, carne molida, salsa de tomate y queso.'),
    (15,'Ceviche', 270.00, 'Plato de mariscos crudos marinados en jugo de limón, típicamente con cebolla, cilantro y ají.'),
    (16,'Filete', 180.00, 'Filete de salmón.'),
    (17,'Pasta', 150.00, 'Pasta fetuccini'),
	(18,'Carnitas', 120.00, 'Tacos mexicanos.'),
    (19,'Ensalada César', 130.00, 'Ensalada césar.'),
    (20,'Hamburguesa', 110.00, 'Hamburguesa '),
    (21,'Pastel', 60.00, 'pastel de chocolate.'),
    (22,'Tarta Lima', 45.00, 'Tarta de limón.'),
    (23,'Cheesecake', 55.00, 'Cheesecake .'),
    (24,'Helado', 30.00, 'Helado de vainilla.'),
    (25,'Crepas', 50.00, 'Crepas de crema.'),
    (26,'Filete', 180.00, 'Filete de salmón.'),
    (27,'Pasta', 150.00, 'Pasta fetuccini'),
	(28,'Carnitas', 120.00, 'Tacos mexicanos.'),
    (29,'Ensalada César', 130.00, 'Ensalada césar.'),
    (30,'Hamburguesa', 110.00, 'Hamburguesa ');
    

INSERT INTO postre (id_platillo)
VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

INSERT INTO comida (id_platillo)
VALUES
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20);


INSERT INTO guarnicion (cantidad_kg, id_platillo)
VALUES
(10, 21),
(15, 22),
(20, 23),
(25, 24),
(30, 25),
(10, 26),
(15, 27),
(20, 28),
(25, 29),
(30, 30);





















//registros que no se ocupan pero por si las moscas los dejo aqui:




INSERT INTO cliente (nombre_cliente)
VALUES
('Daniel'),
('Juan'),
('Gerardo'),
('Brian'),
('Uriel'),
('Rodrigo'),
('Cristobal'),
('Kevin'),
('Jatziri'),
('Messi');



INSERT INTO mesero(id_empleado,id)
VALUES 


INSERT INTO empleado (nombre_empleado, apellido_paterno, apellido_materno, calle, municipio, colonia, codigo_postal, salario, telefono)
VALUES
    ('bytebiv', 'bytebiv', 'bytebiv', '', '', '', '55555',0, '55555'),
    ('Juan', 'García', 'Pérez', 'Revolución', 'Juárez', 'Centro', '32000', 1500, '6141234567'),
    ('María', 'López', 'Hernández', 'Revolución', 'Monterrey', 'Valle', '6400', 18000, '8112345678'),
    ('José', 'Martínez', 'Rodríguez', 'Insurgentes', 'Guadalajara', 'Colinas', '45050', 20000, '3334567890'),
    ('Ana', 'Fernández', 'García', 'onstitución', 'Tijuana', 'Palmas', '22040', 17000, '6642345678'),
    ('Luis ', 'González', 'Martínez', 'Reforma', 'Puebla', 'La Paz', '72160', 19000, '2225678901'),
    ('Laura', 'Díaz', 'López', 'Hidalgo', 'León', 'Centro', '37000', 16000, '4773456789'),
    ('Carlos', 'Ramírez', 'Sánchez', 'Principal', 'Querétaro', 'Cimatario', '76030', 22000, '4422345678'),
    ('Rosa', 'Vázquez', 'Ramírez', 'Juárez', 'Mérida', 'Montes', '97115', 20000, '9994567890'),
    ('Javier', 'Silva', 'González', 'Morelos', 'Roma', 'Las Flores', '20010', 18000, '4492345678'),
    ('Patricia', 'Pérez', 'Gómez', 'Miguel', 'Saltillo', 'San Isidro', '25210', 21000, '8443456789'),
    ('Francisco', 'Ruiz', 'Torres', 'Independencia', 'Culiacán', 'Centro', '80000', 15000, '6672345678'),
    ('Adriana', 'Sánchez', 'Díaz', 'Allende', 'Hermosillo', 'Lomas', '83240', 19000, '6624567890'),
    ('Raúl', 'López', 'Romero', ' Colosio', 'Chihuahua', 'Quintas', '31206', 22000, '6143456789'),
    ('Carmen', 'Martínez', 'Flores', 'Constituye', 'Mexicali', 'Nueva', '21100', 17000, '6862345678'),
    ('Eduardo', 'García', 'Vargas', ' Guerrero', 'Morelia', 'Centro', '58000', 20000, '4433456789'),
    ('Silvia', 'Hernández', 'Núñez', 'Morelos', 'Victoria', 'Valle', '87010', 18000, '8342345678'),
    ('Daniel', 'Rodríguez', 'Mendoza', ' Bravo', 'Toluca', 'Colón', '50070', 21000, '7223456789'),
    ('Alejandra', 'Ramírez', 'Castillo', 'Aragoza', 'Oaxaca', 'Reforma', '68050', 16000, '9512345678'),
    ('Jorge', 'Gutiérrez', 'Luna', 'Suárez', 'Tuxtla', 'Centro', '29000', 19000, '9613456789'),
    ('Norma', 'Morales', 'Ortega', 'niversidad', 'Villa', 'Atasta', '86050', 22000, '9932345678');









INSERT INTO tiene (id_pedido, id_bebida, cantidad)
VALUES
(1, 1, 5),
(2, 8, 3),
(3, 12, 4);


INSERT INTO contiene(id_pedido, id_platillo, cantidad)
VALUES
(4,1, 2),
(5,5, 1),
(6,7, 3);


SELECT nombre_cliente,nombre_platillo, cantidad, costo, fecha from cliente
inner join pedido on cliente.id_cliente = pedido.id_pedido
inner join contiene on pedido.id_pedido = contiene.id_pedido
inner join platillo on platillo.id_platillo = contiene.id_platillo;

