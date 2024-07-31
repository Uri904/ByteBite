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
contra VARCHAR(10) NOT NULL);

CREATE TABLE mesa(
    id_mesa SERIAL PRIMARY KEY,
    contra VARCHAR(50),
    confiContra VARCHAR(50),
    contraAdmin VARCHAR(50));


CREATE TABLE cliente(
id_cliente SERIAL PRIMARY KEY,
nombre_cliente VARCHAR(40) NOT NULL);

CREATE TABLE pedido(
id_pedido SERIAL PRIMARY KEY,
id_mesa int,
id_cliente int NOT NULL,
costo DECIMAL (10,2) NOT NULL,
fecha DATE NOT NULL,
estado VARCHAR(20),
FOREIGN KEY (id_mesa) REFERENCES mesa (id_mesa)on UPDATE CASCADE,
FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente)on UPDATE CASCADE);
FOREIGN KEY (id_mesa) REFERENCES mesa (id_mesa)on UPDATE CASCADE);

CREATE TABLE bebida(
id_bebida SERIAL PRIMARY KEY,
nombre_bebida VARCHAR(40) NOT NULL,
precio DECIMAL (10,2) NOT NULL,
descripcion varchar (200));

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
descripcion varchar (200));

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

-------------------------------------------------BITACORA----------------------------------------------------------
CREATE TABLE cambios(
timestamp_ TIMESTAMP WITH TIME ZONE default now(),
nombre_disparador text,
tipo_disparador text,
nivel_disparador text,
comando text
);

CREATE OR REPLACE FUNCTION grabar_registros() RETURNS TRIGGER AS $grabar_registros$
DECLARE
BEGIN
INSERT INTO cambios (nombre_disparador, tipo_disparador, nivel_disparador, comando)
values (TG_NAME,TG_WHEN,TG_LEVEL,TG_OP);
return null;
end;
$grabar_registros$ LANGUAGE plpgsql;

CREATE TRIGGER grabar_registros AFTER INSERT OR UPDATE OR delete
on mesa FOR EACH STATEMENT
EXECUTE PROCEDURE grabar_registros();

-----------------------------------------------------------------------------------------------------------------------
INSERT INTO administrador (contra)
VALUES
('root');



INSERT INTO bebida (id_bebida,nombre_bebida, precio, descripcion)
VALUES
    (1,'Margarita', 180.00, 'Cóctel mexicano de tequila, triple sec y jugo de limón.'),
    (2,'Mojito', 180.00, 'Bebida cubana de ron, menta, azúcar, lima y soda.'),
    (3,'Pina Colada', 216.00, 'Cóctel tropical de ron, crema de coco y jugo de piña.'),
    (4,'Sangria', 144.00, 'Bebida española de vino tinto mezclado con frutas y un toque de brandy.'),
    (5,'Negroni', 216.00, 'Cóctel italiano de ginebra, vermut rosso y Campari.'),
    (6,'Caipirinha', 180.00, 'Bebida brasileña de cachaça, lima y azúcar.'),
    (7,'Old Fashioned', 216.00, 'Cóctel clásico de whisky, azúcar, y amargos.'),
	(8,'Martini', 216.00, 'Bebida elegante de ginebra y vermut seco, a menudo con una aceituna.'),
    (9,'Cosmopolitan', 216.00, 'Cóctel de vodka, triple sec, jugo de arándano y jugo de lima.'),
    (10,'Manhattan', 216.00, 'Cóctel de whisky, vermut dulce y amargos.'),
    (11,'Jugo de Naranja', 72.00, 'Bebida refrescante y cítrica hecha de naranjas exprimidas.'),
    (12,'Jugo de Manzana', 72.00, 'Jugo dulce y afrutado hecho de manzanas.'),
    (13,'Jugo de Zanahoria', 90.00, 'Bebida nutritiva y ligeramente dulce hecha de zanahorias.'),
    (14,'Jugo de Pina', 90.00, 'Jugo tropical y refrescante hecho de piñas.'),
    (15,'Jugo de Uva', 90.00, 'Bebida dulce y afrutada hecha de uvas.'),
    (16,'Jugo de Tomate', 72.00, 'Bebida salada y ligeramente ácida hecha de tomates.'),
    (17,'Jugo de Mango', 90.00, 'Jugo tropical, dulce y espeso hecho de mangos.'),
	(18,'Jugo de Limon', 54.00, 'Bebida ácida y refrescante hecha de limones.'),
    (19,'Jugo de Arandano', 90.00, 'Jugo agridulce hecho de arándanos.'),
    (20,'Jugo de Sandia', 72.00, 'Bebida refrescante y ligera hecha de sandía.'),
    (21,'Licuado de Platano y Fresa', 90.00, 'Bebida cremosa hecha con plátano, fresas y leche.'),
    (22,'Licuado de Mango', 90.00, 'Bebida espesa y dulce hecha de mango y leche.'),
    (23,'Licuado de Papaya', 90.00, 'Licuado tropical hecho con papaya y leche.'),
    (24,'Licuado de Chocolate', 108.00, 'Bebida dulce y cremosa hecha con chocolate, leche y a veces helado.'),
    (25,'Licuado de Avena', 90.00, ' Bebida nutritiva hecha con avena, plátano y leche.'),
    (26,'Licuado Espinaca y Manzana', 108.00, 'Bebida verde y saludable hecha con espinaca.'),
    (27,'Licuado de Durazno', 90.00, 'Bebida dulce y afrutada hecha con duraznos y leche.'),
	(28,'Licuado de Coco', 90.00, 'Bebida tropical hecha con pulpa de coco y leche.'),
    (29,'Frutas Mixtas', 180.00, 'Bebida refrescante hecha con una mezcla de frutas y leche.'),
    (30,'Licuado de Almendras', 180.00, 'Bebida cremosa hecha con leche de almendra, plátano y miel.');

INSERT INTO alcohol (porsentaje, id_bebida)
VALUES
(40, 1),
(20, 2),
(30, 3),
(40, 4),
(35, 5),
(40, 6),
(20, 7),
(30, 8),
(40, 9),
(35, 10);

INSERT INTO jugo (fruta, id_bebida)
VALUES
('Naranja', 11),
('Manzana', 12),
('Zanahoria', 13),
('Piña', 14),
('uva', 15),
('Tomate', 16),
('Mango', 17),
('Limon', 18),
('Arandano', 19),
('Sandia', 20);

INSERT INTO licuado (id_bebida)
VALUES
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30);

INSERT INTO platillo (id_platillo,nombre_platillo, precio, descripcion)
VALUES
    (1,'Tiramisu', 144.00, 'Postre italiano de capas de bizcocho empapado en café, mascarpone y cacao.'),
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
    (16,'Moussaka', 324.00, 'Platillo griego de capas de berenjena, carne de cordero y salsa bechamel horneada.'),
    (17,'Poutine', 180.00, 'Comida canadiense de papas fritas cubiertas con queso en grano y salsa de carne.'),
	(18,'Feijoada', 360.00, 'Guiso brasileño de frijoles negros con carne de cerdo y res, servido con arroz.'),
    (19,'Curry de Pollo', 270.00, 'Plato indio de pollo cocido en una salsa espesa y especiada con cúrcuma.'),
    (20,'Kimchi Jjigae', 270.00, 'Estofado coreano hecho con kimchi, tofu, cerdo y vegetales.'),
    (21,'Pure de Papas', 90.00, 'Papas hervidas y machacadas con mantequilla y leche.'),
    (22,'Arroz Pilaf', 90.00, ' Arroz cocido en caldo con especias y a veces con verduras.'),
    (23,'Ensalada de Col', 72.00, ' Ensalada fresca de col rallada y zanahoria con mayonesa..'),
    (24,'Elote Asado', 72.00, 'Mazorca de maíz asada, a menudo servida con mayonesa, queso y chile.'),
    (25,'Pan de Ajo', 72.00, 'Pan tostado con mantequilla de ajo y perejil.'),
    (26,'Tabule', 108.00, 'Ensalada de trigo bulgur con tomate, pepino, perejil, menta y limón.'),
    (27,'Brocoli al Vapor', 108.00, 'Brócoli cocido al vapor, a menudo servido con un poco de mantequilla.'),
	(28,'Patatas Bravas', 90.00, ' Papas fritas españolas servidas con salsa brava y alioli.'),
    (29,'Ratatoille', 108.00, 'Guiso francés de berenjenas, calabacines, pimientos y tomate.'),
    (30,'Hummus', 90.00, 'Puré de garbanzos con tahini, ajo y limón, servido con pan pita.');
    

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


SELECT nombre_cliente,nombre_platillo, cantidad, costo, fecha from cliente
inner join pedido on cliente.id_cliente = pedido.id_pedido
inner join contiene on pedido.id_pedido = contiene.id_pedido
inner join platillo on platillo.id_platillo = contiene.id_platillo;

alter table contiene add column id_bebida int;
create index idx_id_bebida ON contiene(id_bebida);
alter table pedido drop column id_cliente;