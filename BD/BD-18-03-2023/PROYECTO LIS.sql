
CREATE database `proyecto`;
USE `proyecto`;

CREATE TABLE Estado_oferta (
    ID_EstadoOferta INT NOT NULL,
    Nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID_EstadoOferta)
)ENGINE=InnoDB; 
CREATE TABLE Rubro (
	ID_Rubro INT NOT NULL,
    Nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID_Rubro)
)ENGINE=InnoDB; 
CREATE TABLE Usuario (
	ID_Usuario INT NOT NULL,
    Nombres VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Contrasenia VARCHAR(256) NOT NULL,
    Correo VARCHAR(50) NOT NULL,
    Tipo VARCHAR(50) NOT NULL,
     Token VARCHAR(10)  NULL,
    PRIMARY KEY (ID_Usuario)
)ENGINE=InnoDB; 
CREATE TABLE Empresa (
	ID_Empresa VARCHAR(6) UNIQUE NOT NULL,
    Nombre VARCHAR(100) NOT NULL,
    Direccion VARCHAR(255) NOT NULL,
    NombreContacto VARCHAR(100) NOT NULL,
    Telefono VARCHAR(8) NOT NULL,
    Correo VARCHAR(50) NOT NULL,
    PorcentajeComision FLOAT NOT NULL,
    ID_Rubro INT NOT NULL,
    PRIMARY KEY (ID_Empresa),
    KEY fk_empresa_rubro (ID_Rubro)
)ENGINE=InnoDB;
CREATE TABLE Oferta (
	ID_Oferta INT NOT NULL,
    Titulo VARCHAR(100) NOT NULL,
    Categoria VARCHAR(100) NOT NULL,
	CantLimite INT NOT NULL,
    Descripcion VARCHAR(255) NOT NULL,
    Detalles VARCHAR(255),
    FechaInicio DATE NOT NULL,
    FechaFin DATE NOT NULL,
    PrecioOriginal FLOAT NOT NULL,
    PrecioOferta FLOAT NOT NULL,
	Imagen VARCHAR(255) NOT NULL,
    ID_Empresa VARCHAR(6) NOT NULL,
    ID_EstadoOferta INT NOT NULL,
    Justificacion VARCHAR(255),
    FechaLimite DATE NOT NULL,
    PRIMARY KEY (ID_Oferta),
    KEY `fk_oferta_empresa` (`ID_Empresa`),
    KEY `fk_oferta_oestado` (`ID_EstadoOferta`)
)ENGINE=InnoDB; 
CREATE TABLE Cliente (
	DUI INT NOT NULL,
	Nombres VARCHAR(100) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Correo VARCHAR(50) NOT NULL,
    Telefono VARCHAR(8) NOT NULL,
    Direccion VARCHAR (255) NOT NULL,
    ID_Usuario INT NOT NULL,
     Token VARCHAR(10)  NULL,
    PRIMARY KEY (DUI),
    KEY `fk_empleado_usuario` (`ID_Usuario`)
)ENGINE=InnoDB;
CREATE TABLE Empleado (
	ID_Empleado INT NOT NULL,
    ID_Empresa VARCHAR(6) NOT NULL,
    ID_Usuario INT NOT NULL,
    Tipo VARCHAR(50) NOT NULL,
    PRIMARY KEY (ID_Empleado),
    KEY `fk_empleado_usuario` (`ID_Usuario`),
    KEY `fk_empleado_empresa` (`ID_Empresa`)
)ENGINE=InnoDB; 
CREATE TABLE Estado_Cupon (
	ID_Estado_Cupon INT NOT NULL,
    Estado VARCHAR (50) NOT NULL,
    PRIMARY KEY (ID_Estado_Cupon)
)ENGINE=InnoDB; 
CREATE TABLE Cupon (
	ID_Cupon VARCHAR(13) NOT NULL,
    DUI INT NOT NULL,
    ID_Oferta INT NOT NULL,
    ID_Estado_Cupon INT NOT NULL,
    PRIMARY KEY (ID_Cupon),
    KEY `fk_cupon_dui` (`DUI`),
    KEY `fk_cupon_oferta`(`ID_Oferta`),
    KEY `fk_cupon_estado_cupon` (`ID_Estado_Cupon`)
)ENGINE=InnoDB;
INSERT INTO Estado_oferta (ID_EstadoOferta, Nombre) VALUES ('1', 'Espera de aprobacion'), ('2', 'Aprobadas futuras '),
 ('3', 'Activas'), ('4', ' Pasadas'),
 ('5', 'Rechazadas'), ('6', 'Descartadas');
INSERT INTO Rubro (ID_Rubro, Nombre) 
VALUES ('1', 'Salon de belleza'), ('2', 'Restaurante '),
('3', 'Taller'), ('4', 'Estructuras metalicas'),
 ('5', 'Super mercado'), ('6', 'Farmacia');
INSERT INTO Empresa (ID_Empresa,  Nombre, Direccion, NombreContacto, Telefono, Correo, PorcentajeComision, ID_Rubro) 
VALUES 
('EMP001', 'Pollo de Oro', 'Blvr. del ejercito, Centro comercial Plaza Mundo, 2 nivel, Soyapango ', 'Mario Rivas', '77223344', 'armando.lopez@lis.com', '0.1', '2'), ('EMP002', 'El Super De Todos', 'PR2X+6P5, Blvr. del Ejercito Nacional, Soyapango', 'Luis Garcia', '77669955', 'super.todos@lis.com', '0.05', '5'),
 ('EMP003', 'Farmacia Amigo','Frente a, Entre 5a y 7a Avenida Norte y, 15 Calle Pte., San Salvador', 'Arturo Ram�rez ', '66789045', 'farma.amigo@gmail.com', '0.15', '6'), ('EMP004', 'Destellos Vicky Sal�n ', 'P.� Gral. Escal�n 3656, San Salvador', 'Victoria Flores', '77452987', 'destellos.vicky@lis.com', '0.08', '1');
Insert INTO  Oferta (ID_Oferta , Titulo, Categoria, CantLimite, Descripcion,Detalles,FechaInicio, FechaFin, PrecioOriginal, PrecioOferta, Imagen,ID_Empresa, ID_EstadoOferta, Justificacion, FechaLimite)
Values (1, 'Domingos de Familia', 'Restaurante', 80, 'La familia solo pagara la mitad de cada Plato del restaurante', 'Incluye postres y bebida ', '2023-05-01', '2023-08-01', 9.5, 4.75, 'https://cdn.pixabay.com/photo/2017/03/23/19/57/asparagus-2169305_1280.jpg', 'EMP001', 3, '', '2023-08-01'),
(2, 'Lunes de hamburguesas al 2X1 ', 'Restaurante', 80, 'Por la compra de una hamburguesa te llevas dos ', 'Incluye papas y bebida ', '2023-05-01', '2023-08-01', 14, 7, 'https://cdn.pixabay.com/photo/2020/06/24/22/08/spicy-5337836_1280.jpg', 'EMP001', 3, '', '2023-08-01'),
(3, 'Miercoles de alitas', 'Restaurante', 80, 'Al compar el primer combo de alitas tellevas el Segundo a mitad de precio', 'Incluye papas y bebida', '2023-05-01', '2023-08-01', 16, 12, 'https://cdn.pixabay.com/photo/2016/07/31/18/00/chicken-1559579_1280.jpg', 'EMP001', 1, '', '2023-08-01'),
(4, 'Viernes de pizza ', 'Restaurante', 80, 'Todas las pizza amitad de precio', 'Incluye Bebida', '2023-05-01', '2023-08-01', 9.5, 4.75, 'https://cdn.pixabay.com/photo/2017/12/09/08/18/pizza-3007395_1280.jpg', 'EMP001', 2, '', '2023-08-01'),
(5, 'Martes de cortes', 'Belleza', 100, 'por el primer corte de cabello el segundo amitad de precio', 'Cualquier estilo de corte', '2023-05-01', '2023-08-01', 6, 4.5, 'https://cdn.pixabay.com/photo/2019/10/11/12/23/hair-4541747_1280.jpg', 'EMP004', 3, '', '2023-08-01'),
(6, 'Manicura al 2x1', 'Belleza', 100, 'por la primera manicura te llevas la segunda gratis ', 'No importa el largo de la uña', '2023-05-01', '2023-08-01', 24, 12, 'https://cdn.pixabay.com/photo/2017/08/05/13/13/people-2583493_1280.jpg', 'EMP004', 3, '', '2023-08-01'),
(7, 'Miercoles de alisados', 'Belleza', 100, 'Todos los alisados con un 40% de descuento', 'No importa el largo de cabello y el estilo de alisado', '2023-05-01', '2023-08-01', 25, 15, 'https://cdn.pixabay.com/photo/2019/11/20/06/27/hair-4639295_1280.jpg', 'EMP004', 3, '', '2023-08-01'),
(8, 'Tinte mas corte de cabello ', 'Belleza', 100, 'por la compra de un tinte te llevas un corte de cabello gratis', 'Cualquier largo de cabello', '2023-05-01', '2023-08-01', 6, 4.5, 'https://cdn.pixabay.com/photo/2017/08/06/15/13/woman-2593366_1280.jpg', 'EMP004', 1, '', '2023-08-01'),
(9, 'Pedicura y manicura', 'Belleza', 100, 'por el precio de uno te llevas el otro gratis', 'Cualquier dia de la semana', '2023-05-01', '2023-08-01', 20, 10, 'https://cdn.pixabay.com/photo/2017/03/02/20/55/nail-varnish-2112364_1280.jpg', 'EMP004', 3, '', '2023-05-01'),
(10, 'Corte de cabello mas mechas', 'Belleza', 100, 'Por un corte de cabello puedes pedir tus mechas gratis', 'Cualquier estilo de corte', '2023-05-01', '2023-08-01', 6, 4.5, 'https://cdn.pixabay.com/photo/2019/10/11/12/29/hair-4541766_1280.jpg', 'EMP004', 3, '', '2023-08-01'),
(11, 'Jueves dia de Pigmentacion con hena ', 'Belleza', 100, 'Pigmenta tus cejas amitad de precio', 'Cualquier tono de hena', '2023-05-01', '2023-08-01', 6, 4.5, 'https://cdn.pixabay.com/photo/2019/10/11/12/33/make-up-4541782_1280.jpg', 'EMP004', 4, '', '2023-08-01'),
(12, 'Jamon al 2x1', 'Super', 100, 'por la compra de un jamon te llevas el segundo gratis', 'valido todos los fines de semana', '2023-05-01', '2023-05-01', 6, 4.5, 'https://cdn.pixabay.com/photo/2017/05/02/14/55/black-forest-ham-2278383_1280.jpg', 'EMP001', 6, 'No cumple los reglametos de la cuponeria', '2023-05-01'),
(13, 'Viertes todo amitad de precio', 'Super', 100, 'Todos los productos a mitad de precio', 'No importa la cantidad de productos', '2023-05-01', '2023-08-01', 6, 4.5, 'https://cdn.pixabay.com/photo/2015/09/21/14/23/supermarket-949912_1280.jpg', 'EMP002', 3, '', '2023-08-01'),
(14, 'Dia de frutas', 'Super', 100, 'La libra de frutas con un 40% de descuento', 'Cualquier estilo de corte', '2023-05-01', '2023-08-01', 4, 2.4, 'https://cdn.pixabay.com/photo/2013/02/04/22/47/fruits-77946_1280.jpg', 'EMP002', 3, '', '2023-08-01'),
(15, 'Sabado de mechas', 'Belleza', 100, 'Mechas con el 25% de descuento', 'No importa el largo del cabello', '2023-04-01', '2023-04-03', 25, 15, 'https://cdn.pixabay.com/photo/2019/11/20/06/27/hair-4639295_1280.jpg', 'EMP004', 5, 'No cumple los reglametos de la cuponeria ', '2023-04-03'),
(16, 'VITASIL M ', 'Salud', 100, 'Por la compra de VITASIL M te llevas el segundo a mitad de precio ', '30 CAPSULAS  por caja (VITAMINAS+MINERALES)', '2023-05-01', '2023-09-01', 10, 7.5, 'https://fasani.b-cdn.net/productos/ecommerce/A8265.jpg?class=Medium', 'EMP003', 3, NULL, '2023-09-01'),
(17, 'CEREBROFOS INFANTIL X 120 ML con el 25% ', 'Salud', 100, 'Compra un CEREBROFOS INFANTIL X 120 ML  con un descuento del 25% canjeable en todas nuestras sucursales y tiendas online', NULL, '2023-04-06', '2024-12-04', 5.6, 4.2, 'https://fasani.b-cdn.net/productos/ecommerce/A1581.jpg?class=Medium', 'EMP003', 3, NULL, '2023-09-01');


INSERT INTO Usuario (ID_Usuario, Nombres, Apellidos, Contrasenia, Correo, Tipo, Token) 
VALUES 
('0' , 'Cesar' , 'Lopez', '1599', 'cesarlopez@gmail.com', 'Administrador', Null),
 ('1' , 'Armando' , 'Lopez', '1599', 'armandolopez@gmail.com', 'Administrador_Empresa', Null),
 ('2', 'Richard Mario ', 'Molina Aguilar', '1599', 'semita@gmail.com', 'Cliente','1520');
INSERT INTO Empleado(ID_Empleado, ID_Empresa, ID_Usuario, Tipo)
VALUES ('1', 'EMP001', '1',  'Administrador_Empresa');
Insert Into Cliente (DUI, Nombres,Apellidos,Correo,Telefono , Direccion ,  ID_Usuario, Token) 
VALUES  ('00167564', 'Richard Mario','Molina Aguilar','semita@gmail.com','75080845', 'Ciudad delgado, canton plan del pino colonia mercedes casa 30A ',  '2', '1520');
INSERT INTO Estado_Cupon( ID_Estado_Cupon, Estado)
VALUES
('01', 'Canjeado'), ('02', 'Sin canjear'), ('03', 'Vencido');
INSERT INTO Cupon(ID_Cupon, DUI, ID_Oferta, ID_Estado_Cupon)
Values 
('001', '00167564', '1', '01'), ('002', '00167564', '5', '02');


ALTER TABLE `Cupon`
  ADD CONSTRAINT `cupon_ibfk_1` FOREIGN KEY (`DUI`) REFERENCES `Cliente` (`DUI`)ON UPDATE CASCADE,
  ADD CONSTRAINT `cupon_ibfk_2` FOREIGN KEY (`ID_Oferta`) REFERENCES `Oferta` (`ID_Oferta`)ON UPDATE CASCADE,
  ADD CONSTRAINT `cupon_ibfk_3` FOREIGN KEY (`ID_Estado_Cupon`) REFERENCES `Estado_cupon` (`ID_Estado_Cupon`)ON UPDATE CASCADE;


ALTER TABLE `Empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuario` (`ID_Usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`ID_Empresa`) REFERENCES `Empresa` (`ID_Empresa`) ON UPDATE CASCADE;


ALTER TABLE `Empresa`
  ADD CONSTRAINT `empresa_ibfk_1` FOREIGN KEY (`ID_Rubro`) REFERENCES `Rubro` (`ID_Rubro`) ON UPDATE CASCADE;


ALTER TABLE `Oferta`
  ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`ID_Empresa`) REFERENCES `Empresa` (`ID_Empresa`)ON UPDATE CASCADE,
  ADD CONSTRAINT `oferta_ibfk_2` FOREIGN KEY (`ID_EstadoOferta`) REFERENCES `Estado_oferta` (`ID_EstadoOferta`)ON UPDATE CASCADE;
COMMIT;
ALTER TABLE `Cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuario` (`ID_Usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
