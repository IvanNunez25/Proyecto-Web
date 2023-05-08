-- BASE DE DATOS: TIENDA
-- PÁGINA WEB: kpopstore2.000webhostapp.com

DROP DATABASE IF EXISTS tienda;
CREATE DATABASE tienda;
-- DROP DATABASE tienda;

USE tienda;

-- ------------------------------------------------------------------------------
-- CREACIÓN DE TABLAS -----------------------------------------------------------

DROP TABLE IF EXISTS artistas;
CREATE TABLE artistas (
	art_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    art_nombre VARCHAR(255) NOT NULL,
    art_tipo VARCHAR(50) NOT NULL,  
    ses_id INT NOT NULL,
    CONSTRAINT checkArtTipo CHECK (art_tipo = 'Solista Masculino' OR 
								   art_tipo = 'Solista Femenina' OR
								   art_tipo = 'Duo' OR
                                   art_tipo = 'BoyGroup' OR 
								   art_tipo = 'GirlGroup' OR
								   art_tipo = 'Grupo Mixto')    
);

DROP TABLE IF EXISTS discos;
CREATE TABLE discos (
	dis_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    dis_nombre VARCHAR(255) NOT NULL,
    dis_flanzamiento DATETIME NOT NULL,
    dis_precioUnitario DOUBLE NOT NULL,
    dis_existencia INT NOT NULL,
    art_id INT NOT NULL,
    ses_id INT NOT NULL
);

DROP TABLE IF EXISTS detalles;
CREATE TABLE detalles (
	det_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    det_cantidad INT NOT NULL,
    det_precioActual DOUBLE NOT NULL, 
    det_subtotal DOUBLE NOT NULL, 
    vta_id INT NOT NULL, 
    dis_id INT NOT NULL
);

DROP TABLE IF EXISTS ventas;
CREATE TABLE ventas (
	vta_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    vta_numProductos INT NOT NULL,
    vta_fecha DATETIME NOT NULL,
    vta_total DOUBLE NOT NULL,
    cte_id INT NOT NULL
);

DROP TABLE IF EXISTS clientes;
CREATE TABLE clientes (
	cte_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cte_nombre VARCHAR(255) UNIQUE NOT NULL,
    cte_password VARCHAR(255) NOT NULL,
    cte_correo VARCHAR(255) NOT NULL,
    cte_fcreacion DATETIME NOT NULL,
    car_id INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS carritos;
CREATE TABLE carritos (
	car_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    car_totalProductos INT NOT NULL,
    cte_id INT NOT NULL
);

DROP TABLE IF EXISTS carritos_discos;
CREATE TABLE carritos_discos (
	cardis_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cardis_cantidad INT NOT NULL,
    car_id INT NOT NULL,
    dis_id INT NOT NULL
);

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
	usr_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usr_nombre VARCHAR(255) UNIQUE NOT NULL,
    usr_password VARCHAR(255) NOT NULL,
    usr_puesto VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS sesiones;
CREATE TABLE sesiones (
	ses_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ses_inicio DATETIME NOT NULL,
    ses_fin DATETIME NULL,
    usr_id INT NOT NULL
);

-- -----------------------------------------------------------------------------
-- RESTRICCIONES DE LLAVE FORANEA ----------------------------------------------

ALTER TABLE artistas
ADD CONSTRAINT FKartistas_sesid FOREIGN KEY (ses_id) REFERENCES sesiones (ses_id);

ALTER TABLE discos
ADD CONSTRAINT FKdiscos_artid FOREIGN KEY (art_id) REFERENCES artistas (art_id);

ALTER TABLE discos
ADD CONSTRAINT FKdiscos_sesid FOREIGN KEY (ses_id) REFERENCES sesiones (ses_id);

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

ALTER TABLE sesiones
ADD CONSTRAINT FKsesiones_usrid FOREIGN KEY (usr_id) REFERENCES usuarios (usr_id);


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

DELIMITER $$
CREATE PROCEDURE iniciarSesion (IN usuario VARCHAR(255))
BEGIN	
    DECLARE usuario_id INT;
    SET usuario_id = (SELECT usr_id FROM usuarios WHERE usr_nombre = usuario);
    
    INSERT INTO sesiones(ses_inicio, usr_id)
    VALUES (SYSDATE(), usuario_id);
END$$

DELIMITER $$
CREATE PROCEDURE cerrarSesion (IN usuario VARCHAR(255))
BEGIN	
    DECLARE usuario_id INT;
    SET usuario_id = (SELECT usr_id FROM usuarios WHERE usr_nombre = usuario);
    
    UPDATE sesiones 
    SET ses_fin = SYSDATE() 
    WHERE (usr_id = usuario_id);
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

-- ---------------------------------------------------------------------------------
-- PRIMEROS USUARIOS ---------------------------------------------------------------

INSERT INTO usuarios (usr_nombre, usr_password, usr_puesto)
VALUES ('Ivan', aes_encrypt('ivan', 'claveContrasenia'), 'Jefe');


SELECT * FROM sesiones;
