-- BASE DE DATOS: TIENDA
-- PÁGINA WEB: kpopstore2.000webhostapp.com

CREATE DATABASE tienda;
-- DROP DATABASE tienda;

USE tienda;

-- ------------------------------------------------------------------------------
-- CREACIÓN DE TABLAS -----------------------------------------------------------

CREATE TABLE artistas (
	art_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    art_nombre VARCHAR(255) NOT NULL,
    art_tipo VARCHAR(50) NOT NULL,    
    CONSTRAINT checkArtTipo CHECK (art_tipo = 'Solista Masculino' OR 
								   art_tipo = 'Solista Femenina' OR
								   art_tipo = 'Duo' OR
                                   art_tipo = 'BoyGroup' OR 
								   art_tipo = 'GirlGroup' OR
								   art_tipo = 'Grupo Mixto')    
);

CREATE TABLE discos (
	dis_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    dis_nombre VARCHAR(255) NOT NULL,
    dis_flanzamiento DATETIME NOT NULL,
    dis_precioUnitario DOUBLE NOT NULL,
    dis_existencia INT NOT NULL,
    art_id INT NOT NULL
);

CREATE TABLE detalles (
	det_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    det_cantidad INT NOT NULL,
    det_precioActual DOUBLE NOT NULL, 
    det_total DOUBLE NOT NULL, 
    vta_id INT NOT NULL, 
    dis_id INT NOT NULL
);

CREATE TABLE ventas (
	vta_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    vta_idSesion VARCHAR(255) NOT NULL,
    vta_fecha DATETIME NOT NULL,
    vta_total DOUBLE NOT NULL,
    cte_id INT NOT NULL
);

CREATE TABLE clientes (
	cte_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cte_nombre VARCHAR(255) NOT NULL,
    cte_password VARCHAR(255) NOT NULL,
    cte_fcreacion DATETIME NOT NULL,
    car_id INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE carritos (
	car_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    car_totalProductos INT NOT NULL,
    cte_id INT NOT NULL
);

CREATE TABLE carritos_discos (
	cardis_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cardis_cantidad INT NOT NULL,
    car_id INT NOT NULL,
    dis_id INT NOT NULL
);

-- -----------------------------------------------------------------------------
-- RESTRICCIONES DE LLAVE FORANEA ----------------------------------------------

ALTER TABLE discos
ADD CONSTRAINT FKdiscos_artid FOREIGN KEY (art_id) REFERENCES artistas (art_id);

ALTER TABLE detalles
ADD CONSTRAINT FKdetalles_disid FOREIGN KEY (dis_id) REFERENCES discos (dis_id);

ALTER TABLE detalles
ADD CONSTRAINT FKdetalles_vtaid FOREIGN KEY (vta_id) REFERENCES ventas (vta_id);

ALTER TABLE ventas
ADD CONSTRAINT FKventas_cteid FOREIGN KEY (cte_id) REFERENCES clientes (cte_id);

ALTER TABLE clientes
ADD CONSTRAINT FKclientes_carid FOREIGN KEY (car_id) REFERENCES carritos (car_id);

ALTER TABLE carritos
ADD CONSTRAINT FKcarritos_cteid FOREIGN KEY (cte_id) REFERENCES clientes (cte_id);

ALTER TABLE carritos_discos
ADD CONSTRAINT FKcardis_carid FOREIGN KEY (car_id) REFERENCES carritos (car_id);

ALTER TABLE carritos_discos
ADD CONSTRAINT FKcardis_disid FOREIGN KEY (dis_id) REFERENCES discos (dis_id);


-- ------------------------------------------------------------------------------------------
-- FUNCIONES --------------------------------------------------------------------------------

SET GLOBAL log_bin_trust_function_creators = 1;

DELIMITER $$
CREATE FUNCTION crearCarrito (cliente_id INT)
RETURNS INT
BEGIN
    DECLARE carrito_id INT;
    SET carrito_id = 0;

    INSERT INTO carritos (car_totalProductos, cte_id)
    VALUES (0, cliente_id);
    
    SET carrito_id = (SELECT car_id FROM carritos WHERE (cte_id = cliente_id)); 
    RETURN carrito_id;    
END$$

DELIMITER $$
CREATE FUNCTION obtenerNumProductos (cliente_id INT)
RETURNS INT
BEGIN
    DECLARE carrito_id INT;
    SET carrito_id = (SELECT car_totalProductos FROM carritos WHERE (cte_id = cliente_id)); 
    RETURN carrito_id;    
END$$

DELIMITER $$
CREATE FUNCTION obtenerNuevoClienteID (cliente_name VARCHAR(255))
RETURNS INT
BEGIN
	DECLARE cliente_id INT;
    SET cliente_id = (SELECT cte_id FROM clientes WHERE (cte_nombre = cliente_name));
    RETURN cliente_id;   
END$$


-- -----------------------------------------------------------------------------------------------------
-- PROCEDIMIENTOS ALMACENADOS --------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE actualizarClienteCarrito (IN carrito_id INT, IN cliente_id INT)
BEGIN	
    UPDATE clientes SET car_id = carrito_id WHERE (cte_id = cliente_id);
END$$

DELIMITER $$
CREATE PROCEDURE actualizarDiscoExistencia (IN disco_id INT, IN cantidadComprada INT)
BEGIN	
    UPDATE discos 
    SET dis_existencia = dis_existencia - cantidadComprada 
    WHERE (dis_id = disco_id);
END$$

DELIMITER $$
CREATE PROCEDURE agregarProductoCarrito (IN cliente_nombre VARCHAR(255), IN discos_id INT, IN discos_cantidad INT)
BEGIN	
    
    DECLARE carrito_id INT;
    DECLARE ya_existe INT;
    
    SET carrito_id = (SELECT car_id FROM clientes WHERE (cte_nombre = cliente_nombre));
    SET ya_existe = (SELECT COUNT(*) FROM carritos_discos WHERE ((car_id = carrito_id) AND (dis_id = discos_id)));  
    
    IF ya_existe > 0 THEN
    	UPDATE carritos_discos 
        SET cardis_cantidad = cardis_cantidad + discos_cantidad 
        WHERE dis_id = discos_id AND car_id = carrito_id;
    ELSE
    	INSERT INTO carritos_discos (cardis_cantidad, car_id, dis_id)
        VALUES (discos_cantidad, carrito_id, discos_id);
    END IF;
    
END$$

DELIMITER $$
CREATE PROCEDURE actualizarCarrito ()
BEGIN	
    UPDATE carritos 
    SET carritos.car_totalProductos = (SELECT COUNT(cd.cardis_id) 
    								  FROM carritos_discos as cd 
                                      WHERE (cd.car_id = carritos.car_id));
END$$


-- ----------------------------------------------------------------------------------------------------
-- VISTAS ---------------------------------------------------------------------------------------------

CREATE VIEW productosmasrecientes AS
SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario
FROM discos AS d 
INNER JOIN artistas AS a ON (a.art_id = d.art_id)
ORDER BY d.dis_flanzamiento DESC;

CREATE VIEW productosboygroups AS
SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario
FROM discos AS d 
INNER JOIN artistas AS a ON (a.art_id = d.art_id)
WHERE (a.art_tipo = 'BoyGroup')
ORDER BY d.dis_flanzamiento DESC
LIMIT 4;

CREATE VIEW productosgirlgroups AS
SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario
FROM discos AS d 
INNER JOIN artistas AS a ON (a.art_id = d.art_id)
WHERE (a.art_tipo = 'GirlGroup')
ORDER BY d.dis_flanzamiento DESC
LIMIT 4;

CREATE VIEW productossolistasmasculinos AS
SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario
FROM discos AS d 
INNER JOIN artistas AS a ON (a.art_id = d.art_id)
WHERE (a.art_tipo = 'Solista Masculino')
ORDER BY d.dis_flanzamiento DESC
LIMIT 4;

CREATE VIEW productossolistasfemeninas AS
SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario
FROM discos AS d 
INNER JOIN artistas AS a ON (a.art_id = d.art_id)
WHERE (a.art_tipo = 'Solista Femenina')
ORDER BY d.dis_flanzamiento DESC
LIMIT 4;

CREATE VIEW productosduos AS
SELECT a.art_nombre, d.dis_nombre, d.dis_precioUnitario
FROM discos AS d 
INNER JOIN artistas AS a ON (a.art_id = d.art_id)
WHERE (a.art_tipo = 'Duo')
ORDER BY d.dis_flanzamiento DESC
LIMIT 4;


-- ----------------------------------------------------------------------------------------------------
-- DATOS INSERTADOS DE PRUEBA -------------------------------------------------------------------------

INSERT INTO `artistas` (`art_nombre`, `art_tipo`) VALUES
('Red Velvet', 'GirlGroup'),
('aespa', 'GirlGroup'),
('TWICE', 'GirlGroup'),
('BLACKPINK', 'GirlGroup'),
('New Jeans', 'GirlGroup'),
('MAMAMOO', 'GirlGroup'),
('OH MY GIRL', 'GirlGroup'),
('NMIXX', 'GirlGroup'),
('IVE', 'GirlGroup'),
('(G)I-DLE', 'GirlGroup'),
('NCT', 'BoyGroup'),
('NCT U', 'BoyGroup'),
('NCT 127', 'BoyGroup'),
('NCT DREAM', 'BoyGroup'),
('EXO', 'BoyGroup'),
('DAY6', 'BoyGroup'),
('SHINee', 'BoyGroup'),
('Stray Kids', 'BoyGroup'),
('BTS', 'BoyGroup'),
('Seventeen', 'BoyGroup'),
('Red Velvet - IRENE & SEULGI', 'Duo'),
('TVXQ', 'Duo'),
('EXO-SC', 'Duo'),
('AKMU', 'Duo'),
('LEE HI', 'Solista Femenina'),
('CHUNG HA', 'Solista Femenina'),
('IU', 'Solista Femenina'),
('TAEYEON', 'Solista Femenina'),
('BIBI', 'Solista Femenina'),
('Wonpil', 'Solista Masculino'),
('Baekhyun', 'Solista Masculino'),
('Kai', 'Solista Masculino'),
('G-DRAGON', 'Solista Masculino'),
('Kyuhyun', 'Solista Masculino'),
('HEIZE', 'Solista Femenina'),
('JISOO', 'Solista Femenina');

INSERT INTO `discos` (`dis_nombre`, `dis_flanzamiento`, `dis_precioUnitario`, `dis_existencia`, `art_id`) VALUES
('The ReVe Festival 2022', '2022-03-21', 499, 50, 1),
('The ReVe Festival 2022 - Birthday', '2022-11-28', 599, 46, 1),
('Queendom', '2021-08-16', 459, 30, 1),
('Girls', '2022-07-08', 699, 70, 2),
('Savage', '2021-10-05', 499, 20, 2),
('READY TO BE', '2023-03-10', 799, 99, 3),
('BETWEEN 1&2', '2022-08-26', 599, 70, 3),
('Formula of Love: O+T=<3', '2021-11-12', 399, 40, 3),
('BORN PINK', '2022-09-16', 799, 150, 4),
('THE ALBUM', '2020-10-02', 599, 100, 4),
('NewJeans 1st EP \"New Jeans\"', '2022-08-01', 599, 100, 5),
('MIC ON', '2022-10-11', 599, 120, 6),
('ME', '2023-03-31', 599, 9, 36),
('Real Love', '2022-03-28', 449, 40, 7),
('Dear OHMYGIRL', '2021-05-10', 399, 20, 7),
('NONSTOP', '2022-04-27', 559, 50, 7),
('FALL IN LOVE', '2019-08-05', 449, 40, 7),
('expérgo', '2023-03-20', 499, 147, 8),
('After LIKE', '2022-08-22', 469, 100, 9),
('I love', '2022-10-17', 579, 149, 10),
('I NEVER DIE', '2022-03-14', 579, 120, 10),
('I burn', '2021-01-11', 499, 70, 10),
('I trust', '2020-04-06', 399, 30, 10),
('NCT 2018 EMPATHY', '2018-03-14', 539, 150, 11),
('NCT RESONANCE Pt.1', '2020-10-12', 579, 150, 11),
('NCT RESONANCE Pt.2', '2020-11-23', 589, 150, 11),
('Universe', '2021-12-14', 649, 100, 11),
('The 7th Sense', '2016-04-09', 399, 30, 12),
('Ay-Yo', '2023-01-30', 699, 200, 13),
('2 Baddies', '2022-09-16', 799, 220, 13),
('Favorite', '2021-10-25', 599, 100, 13),
('Sticker', '2021-09-17', 699, 100, 13),
('Candy', '2022-12-16', 699, 200, 14),
('Beatbox', '2022-05-30', 799, 220, 14),
('Glitch Mode', '2022-03-28', 599, 100, 14),
('DONT FIGHT THE FEELING', '2021-06-07', 699, 200, 15),
('OBSESSION', '2019-11-27', 799, 100, 15),
('The Book Of Us: Negentropy', '2021-04-19', 599, 200, 16),
('The Book Of Us: The Demon', '2020-05-11', 589, 200, 16),
('The Book Of Us: Entropy', '2019-10-22', 579, 200, 16),
('The Book Of Us: Gravity', '2019-07-15', 569, 200, 16),
('Atlantis', '2021-04-12', 599, 200, 17),
('Dont Call Me', '2021-02-22', 589, 200, 17),
('MAXIDENT', '2022-10-07', 599, 150, 18),
('ODDINARY', '2022-03-18', 589, 200, 18),
('Proof', '2022-06-10', 799, 250, 19),
('Face the Sun', '2022-05-27', 599, 250, 20),
('Monster', '2020-07-06', 599, 250, 21),
('New Chapter #2: The Truth of Love', '2018-12-26', 499, 70, 22),
('New Chapter #1: The Chance of Love', '2018-03-28', 499, 70, 22),
('1 Billion Views', '2020-07-13', 499, 100, 23),
('What a life', '2019-07-22', 399, 70, 23),
('NEXT EPISODE', '2020-07-13', 499, 100, 24),
('4 ONLY', '2021-09-09', 499, 100, 25),
('Bare&Rare, Pt.1', '2022-07-11', 599, 99, 26),
('Querencia', '2021-02-15', 499, 100, 26),
('LILAC', '2021-03-25', 599, 80, 27),
('Palette', '2017-04-21', 499, 100, 27),
('INVU', '2022-02-14', 699, 200, 28),
('What Do I Call You', '2020-12-15', 599, 100, 28),
('Lowlife Princess - Noir', '2022-11-18', 599, 197, 29),
('Pilmography', '2022-02-07', 599, 150, 30),
('Bambi', '2021-03-30', 599, 147, 31),
('Delight', '2020-05-25', 699, 150, 31),
('City Lights', '2019-07-10', 499, 150, 31),
('Rover', '2023-03-13', 599, 146, 32),
('Peaches', '2021-11-30', 699, 150, 32),
('KAI', '2020-11-30', 499, 150, 32),
('Kwon Ji Yong', '2017-06-08', 599, 150, 33),
('At Gwanghwamun', '2014-11-13', 599, 100, 34),
('HAPPEN', '2021-05-20', 599, 100, 35),
('Undo', '2022-06-30', 699, 100, 35);
