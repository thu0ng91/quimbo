-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.37 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             8.3.0.4799
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table quimbo.t00web_Roles
CREATE TABLE IF NOT EXISTS `t00web_Roles` (
  `a01Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a01Nombre` varchar(50) NOT NULL,
  `a01Tag` varchar(10) NOT NULL,
  PRIMARY KEY (`a01Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t01web_Usuarios
CREATE TABLE IF NOT EXISTS `t01web_Usuarios` (
  `a01Codigo` char(36) NOT NULL,
  `a01Tipo` int(11) NOT NULL,
  `a01Nombres` varchar(100) NOT NULL,
  `a01Apellidos` varchar(100) NOT NULL,
  `a01Usuario` varchar(50) NOT NULL,
  `a01Clave` char(32) NOT NULL,
  `a01Fecha` datetime NOT NULL,
  `a01Estado` enum('A','I') NOT NULL,
  `a01Sincro` enum('P','S') NOT NULL DEFAULT 'P',
  PRIMARY KEY (`a01Codigo`),
  KEY `FK_t01web_Usuarios_t00web_Roles` (`a01Tipo`),
  CONSTRAINT `FK_t01web_Usuarios_t00web_Roles` FOREIGN KEY (`a01Tipo`) REFERENCES `t00web_Roles` (`a01Codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t02web_Capitulos
CREATE TABLE IF NOT EXISTS `t02web_Capitulos` (
  `a02Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a02Nombre` varchar(150) NOT NULL,
  `a02Letra` char(1) NOT NULL,
  PRIMARY KEY (`a02Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t03web_Capitulo_Preguntas
CREATE TABLE IF NOT EXISTS `t03web_Capitulo_Preguntas` (
  `a03Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a03Capitulo` int(11) NOT NULL,
  `a03Numero` int(11) NOT NULL,
  `a03Posicion` int(11) DEFAULT NULL,
  `a03Titulo` varchar(150) DEFAULT NULL,
  `a03Pregunta` varchar(150) DEFAULT NULL,
  `a03Tipo` enum('O','C','M','T','D','P','F') NOT NULL,
  `a03Tamanyo` int(11) DEFAULT NULL,
  PRIMARY KEY (`a03Codigo`),
  KEY `FK_t03web_Capitulo_Preguntas_t02web_Capitulos` (`a03Capitulo`),
  CONSTRAINT `FK_t03web_Capitulo_Preguntas_t02web_Capitulos` FOREIGN KEY (`a03Capitulo`) REFERENCES `t02web_Capitulos` (`a02Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t04web_Pregunta_Respuestas
CREATE TABLE IF NOT EXISTS `t04web_Pregunta_Respuestas` (
  `a04Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a04Pregunta` int(11) NOT NULL,
  `a04Numero` int(11) DEFAULT NULL,
  `a04Respuesta` varchar(100) NOT NULL,
  PRIMARY KEY (`a04Codigo`),
  KEY `FK_t04web_Pregunta_Respuestas_t03web_Capitulo_Preguntas` (`a04Pregunta`),
  CONSTRAINT `FK_t04web_Pregunta_Respuestas_t03web_Capitulo_Preguntas` FOREIGN KEY (`a04Pregunta`) REFERENCES `t03web_Capitulo_Preguntas` (`a03Codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t05web_Departamentos
CREATE TABLE IF NOT EXISTS `t05web_Departamentos` (
  `a05Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a05Nombre` varchar(100) NOT NULL,
  `a05DANE` char(2) NOT NULL,
  `a05Estado` enum('A','I') NOT NULL,
  PRIMARY KEY (`a05Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t06web_Municipios
CREATE TABLE IF NOT EXISTS `t06web_Municipios` (
  `a06Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a06Departamento` int(11) DEFAULT NULL,
  `a06Nombre` varchar(150) NOT NULL,
  `a06DANE` char(5) NOT NULL,
  `a06Estado` enum('A','I') NOT NULL,
  PRIMARY KEY (`a06Codigo`),
  KEY `FK_t06web_Municipios_t05web_Departamentos` (`a06Departamento`),
  CONSTRAINT `FK_t06web_Municipios_t05web_Departamentos` FOREIGN KEY (`a06Departamento`) REFERENCES `t05web_Departamentos` (`a05Codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t07web_Formularios
CREATE TABLE IF NOT EXISTS `t07web_Formularios` (
  `a07Codigo` char(36) NOT NULL,
  `a07Usuario` char(36) NOT NULL,
  `a07Departamento` int(11) NOT NULL,
  `a07Municipio` int(11) NOT NULL,
  `a07Busqueda` int(11) DEFAULT NULL,
  `a07Identificador` varchar(7) DEFAULT NULL,
  `a07Aplica` datetime NOT NULL,
  `a07Lugar` varchar(200) NOT NULL,
  `a07Imagen` varchar(200) DEFAULT NULL,
  `a07Video` varchar(200) DEFAULT NULL,
  `a07CodigoBarras` varchar(200) DEFAULT NULL,
  `a07Fecha` datetime NOT NULL,
  `a07Estado` enum('P','S') NOT NULL,
  PRIMARY KEY (`a07Codigo`),
  KEY `FK_t07web_Formularios_t01web_Usuarios` (`a07Usuario`),
  KEY `FK_t07web_Formularios_t05web_Departamentos` (`a07Departamento`),
  KEY `FK_t07web_Formularios_t06web_Municipios` (`a07Municipio`),
  KEY `FK_t07web_Formularios_t11web_Busqueda` (`a07Busqueda`),
  CONSTRAINT `FK_t07web_Formularios_t01web_Usuarios` FOREIGN KEY (`a07Usuario`) REFERENCES `t01web_Usuarios` (`a01Codigo`) ON UPDATE CASCADE,
  CONSTRAINT `FK_t07web_Formularios_t05web_Departamentos` FOREIGN KEY (`a07Departamento`) REFERENCES `t05web_Departamentos` (`a05Codigo`) ON UPDATE CASCADE,
  CONSTRAINT `FK_t07web_Formularios_t06web_Municipios` FOREIGN KEY (`a07Municipio`) REFERENCES `t06web_Municipios` (`a06Codigo`) ON UPDATE CASCADE,
  CONSTRAINT `FK_t07web_Formularios_t11web_Busqueda` FOREIGN KEY (`a07Busqueda`) REFERENCES `t11web_Busqueda` (`a11Codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t08web_Usuario_Respuestas
CREATE TABLE IF NOT EXISTS `t08web_Usuario_Respuestas` (
  `a08Codigo` char(36) NOT NULL,
  `a08Formulario` char(36) NOT NULL,
  `a08Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `a08Estado` enum('P','S') NOT NULL,
  `a08AP01` varchar(50) DEFAULT NULL,
  `a08AP02` varchar(50) DEFAULT NULL,
  `a08AP03O01` varchar(50) DEFAULT NULL,
  `a08AP03O02` varchar(50) DEFAULT NULL,
  `a08AP04` varchar(200) DEFAULT NULL,
  `a08AP05` varchar(200) DEFAULT NULL,
  `a08AP06` varchar(200) DEFAULT NULL,
  `a08AP07` varchar(200) DEFAULT NULL,
  `a08AP08O01` varchar(200) DEFAULT NULL,
  `a08AP08O02` varchar(200) DEFAULT NULL,
  `a08AP09O01` varchar(200) DEFAULT NULL,
  `a08AP09O02` varchar(200) DEFAULT NULL,
  `a08AP09O03` varchar(200) DEFAULT NULL,
  `a08AP011O01` varchar(200) DEFAULT NULL,
  `a08AP011O02` varchar(200) DEFAULT NULL,
  `a08AP011O03` varchar(200) DEFAULT NULL,
  `a08AP012` varchar(200) DEFAULT NULL,
  `a08AP013` varchar(200) DEFAULT NULL,
  `a08AP014O01` varchar(200) DEFAULT NULL,
  `a08AP014O02` varchar(200) DEFAULT NULL,
  `a08AP015` varchar(200) DEFAULT NULL,
  `a08AP016` varchar(200) DEFAULT NULL,
  `a08AP017` varchar(200) DEFAULT NULL,
  `a08AP018O01` varchar(200) DEFAULT NULL,
  `a08AP018O02` varchar(200) DEFAULT NULL,
  `a08AP019O01` varchar(200) DEFAULT NULL,
  `a08AP019O02` varchar(200) DEFAULT NULL,
  `a08BP01O01` varchar(200) DEFAULT NULL,
  `a08BP01O02` varchar(200) DEFAULT NULL,
  `a08BP02` varchar(200) DEFAULT NULL,
  `a08BP03` varchar(200) DEFAULT NULL,
  `a08BP04O01` varchar(200) DEFAULT NULL,
  `a08BP04O02` varchar(200) DEFAULT NULL,
  `a08BP05` varchar(200) DEFAULT NULL,
  `a08BP06` varchar(200) DEFAULT NULL,
  `a08BP07O01` varchar(200) DEFAULT NULL,
  `a08BP07O02` varchar(200) DEFAULT NULL,
  `a08BP08O01` varchar(200) DEFAULT NULL,
  `a08CP01O01` varchar(200) DEFAULT NULL,
  `a08CP01O02` varchar(200) DEFAULT NULL,
  `a08CP02` varchar(200) DEFAULT NULL,
  `a08CP03` varchar(200) DEFAULT NULL,
  `a08CP04O01` varchar(200) DEFAULT NULL,
  `a08CP04O02` varchar(200) DEFAULT NULL,
  `a08CP05` varchar(200) DEFAULT NULL,
  `a08CP06` varchar(200) DEFAULT NULL,
  `a08CP07O01` varchar(200) DEFAULT NULL,
  `a08CP07O02` varchar(200) DEFAULT NULL,
  `a08CP08O01` varchar(200) DEFAULT NULL,
  `a08CP09O01` varchar(200) DEFAULT NULL,
  `a08CP09O02` varchar(200) DEFAULT NULL,
  `a08CP09O03` varchar(200) DEFAULT NULL,
  `a08CP09O04` varchar(200) DEFAULT NULL,
  `a08CP09O05` varchar(200) DEFAULT NULL,
  `a08CP010O01` varchar(200) DEFAULT NULL,
  `a08CP010O02` varchar(200) DEFAULT NULL,
  `a08CP011` varchar(200) DEFAULT NULL,
  `a08CP012O01` varchar(200) DEFAULT NULL,
  `a08CP012O02` varchar(200) DEFAULT NULL,
  `a08CP013` varchar(200) DEFAULT NULL,
  `a08CP014` varchar(200) DEFAULT NULL,
  `a08CP015O01` varchar(200) DEFAULT NULL,
  `a08CP015O02` varchar(200) DEFAULT NULL,
  `a08CP016` varchar(200) DEFAULT NULL,
  `a08CP017` varchar(200) DEFAULT NULL,
  `a08CP018O01` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`a08Codigo`),
  KEY `FK_t08web_Usuario_Respuestas_t07web_Formularios` (`a08Formulario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t09web_Usuario_RespuestasN
CREATE TABLE IF NOT EXISTS `t09web_Usuario_RespuestasN` (
  `a09Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a09Formulario` char(36) NOT NULL,
  `a09Pregunta` varchar(5) NOT NULL,
  `a09Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `a09Estado` enum('P','S') NOT NULL,
  `a09O01` varchar(200) NOT NULL,
  `a09O02` varchar(200) NOT NULL,
  `a09O03` varchar(200) NOT NULL,
  `a09O04` varchar(200) NOT NULL,
  `a09O05` varchar(200) NOT NULL,
  `a09O06` varchar(200) NOT NULL,
  `a09O07` varchar(200) DEFAULT NULL,
  `a09O08` varchar(200) DEFAULT NULL,
  `a09O09` varchar(200) DEFAULT NULL,
  `a09O010` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`a09Codigo`),
  KEY `FK_t10web_Usuario_RespuestasN_t07web_Formularios` (`a09Formulario`),
  CONSTRAINT `FK_t10web_Usuario_RespuestasN_t07web_Formularios` FOREIGN KEY (`a09Formulario`) REFERENCES `t07web_Formularios` (`a07Codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t10web_Veredas
CREATE TABLE IF NOT EXISTS `t10web_Veredas` (
  `a10Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a10Municipio` int(11) NOT NULL,
  `a10Nombre` varchar(150) NOT NULL,
  `a10Estado` enum('A','I') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`a10Codigo`),
  KEY `FK_t09web_Veredas_t06web_Municipios` (`a10Municipio`),
  CONSTRAINT `FK_t09web_Veredas_t06web_Municipios` FOREIGN KEY (`a10Municipio`) REFERENCES `t06web_Municipios` (`a06Codigo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t11web_Busqueda
CREATE TABLE IF NOT EXISTS `t11web_Busqueda` (
  `a11Codigo` int(11) NOT NULL,
  `a11Tipo` enum('NoResidente','Residente') DEFAULT NULL,
  `a11Encuesta` int(11) NOT NULL,
  `a11Nombres` varchar(200) NOT NULL,
  `a11Apellidos` varchar(200) NOT NULL,
  `a11Edad` int(11) NOT NULL,
  `a11Sexo` int(11) DEFAULT NULL,
  `a11EstadoCivil` int(11) DEFAULT NULL,
  `a11Cantidad` int(11) NOT NULL,
  `a11TipoDoc` int(11) DEFAULT NULL,
  `a11NoDoc` int(11) NOT NULL,
  `a11Lugar` int(11) DEFAULT NULL,
  `a11Direccion` varchar(200) DEFAULT NULL,
  `a11Telefono` int(11) DEFAULT NULL,
  `a11Tiempo` int(11) NOT NULL,
  PRIMARY KEY (`a11Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t12web_Paises
CREATE TABLE IF NOT EXISTS `t12web_Paises` (
  `a12Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a12ISO` char(2) NOT NULL,
  `a12Nombre` varchar(80) NOT NULL,
  `a12Estado` enum('A','I') NOT NULL DEFAULT 'A',
  PRIMARY KEY (`a12Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table quimbo.t13web_Usuario_Docs
CREATE TABLE IF NOT EXISTS `t13web_Usuario_Docs` (
  `a13Codigo` int(11) NOT NULL AUTO_INCREMENT,
  `a13Identificador` char(36) NOT NULL,
  `a13Tipo` int(11) NOT NULL,
  `a13Documento` varchar(250) NOT NULL,
  `a13Folios` int(11) NOT NULL,
  `a13Fecha` datetime NOT NULL,
  `a13Estado` enum('P','S') NOT NULL,
  PRIMARY KEY (`a13Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
