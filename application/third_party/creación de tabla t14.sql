/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.0.51b-community-nt-log : Database - quimbo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `t14web_certificaciones_detalle` */

CREATE TABLE `t14web_certificaciones_detalle` (
  `a14Codigo` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla t14 Certficaciones detalle',
  `a14Identificador` CHAR(36) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Identificador o codigo del formulario FK',
  `a14FechaExpedicion` DATE NOT NULL COMMENT 'Fecha en que se expide la certificación',
  `a14MunicipioExpedicion` CHAR(5) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Municipio en el cual desempeñaba la labor certificada',
  `a14VeredaCertificacion` INT(11) NOT NULL COMMENT 'Vereda en el cual desempeñaba la labor certificada',
  `a14PredioCertificacion` INT(11) NOT NULL COMMENT 'Predio en el cual desempeñaba la labor certificada',
  `a14Cargo` VARCHAR(500) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Cargo de las labores desempeñadas certificado en el documento',
  `a14FechaSuministrada` TINYINT(4) DEFAULT NULL COMMENT 'Si/No (fitra la siguiente)',
  `a14FechaInicio` DATE DEFAULT NULL COMMENT 'Fecha inicial del periodo de tiempo certificado',
  `a14FechaFin` DATE DEFAULT NULL COMMENT 'Fecha final del periodo de tiempo certificado',
  `a14TipoPersonaJuridica` VARCHAR(500) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'Junta de acción comunal, Unidad de justicia y comisaría de familia, Personería, Alcaldía, otro',
  `a14NombrePersonaJuridica` varchar(500) collate utf8_spanish_ci default NULL COMMENT 'Nombre completo de la persona jurídica que certifica',
  `a14NITPersonaJuridica` int(10) default NULL COMMENT 'NIT de la persona jurídica que certifica',
  `a14DocumentoIdentificacion` int(12) default NULL COMMENT 'Número del documento de identificación de quien firma la certificación',
  `a14NombreEmpresa` varchar(500) collate utf8_spanish_ci default NULL COMMENT 'Nombre completo de la empresa que certifica',
  `a14NITEmpresa` int(10) default NULL COMMENT 'NIT de la empresa que certifica',
  `a14DescripcionRelacion` varchar(1000) collate utf8_spanish_ci default NULL COMMENT 'Breve y clara descripción de la relación certificada',
  `a14ValoresCertificados` tinyint(4) default NULL COMMENT 'Si/No (fitra la siguientes 3)',
  `a14Unidades` varchar(100) collate utf8_spanish_ci default NULL COMMENT '$,Gr, K,Lb,Bloque,M3, Otra cual',
  `a14Cantidad` varchar(100) collate utf8_spanish_ci default NULL COMMENT 'Valor de las unidades certificadas',
  `a14DescripcionUnidades` varchar(30) collate utf8_spanish_ci default NULL COMMENT 'Descripción de las unidades certificadas(Oro, pescado, madera, arena, gravilla, otro cuál',
  `a14DireccionCertificacion` varchar(200) collate utf8_spanish_ci default NULL COMMENT 'Predio en el cual se certifica la vecindad',
  `a14Zona` smallint(6) default NULL COMMENT 'Urbana/Rural (filtra las siguientes)',
  `a14Barrio` varchar(200) collate utf8_spanish_ci default NULL COMMENT 'Barrio en el cual se certifica la vecindad',
  `a14OtroMunicipio` varchar(200) collate utf8_spanish_ci default NULL COMMENT 'En caso de no existir el muicipio se agrega otro',
  `a14OtraVereda` varchar(200) collate utf8_spanish_ci default NULL COMMENT 'En caso de no existir la vereda se agrega una vereda nueva en texto',
  `a14OtroPredio` varchar(200) collate utf8_spanish_ci default NULL COMMENT 'En caso de no existir el predio se agrega nuevo predio en texto',
  `a14TipoCertificacion` smallint(1) default NULL COMMENT 'Define el tipo de Certificación ya sea laboral, comercial, o de vecindad',
  `a14OtraDescripcionUnidades` varchar(200) collate utf8_spanish_ci default NULL COMMENT 'Otra descripcion de unidades en caso de que no exista en la lista desplegable',
  `a14FechaCreacion` timestamp NULL default CURRENT_TIMESTAMP COMMENT 'Corresponde a la fecha de creación',
  `a14FechaUltimaActualizacion` datetime default NULL COMMENT 'Corresponde a la fecha de ultima actualización',
  PRIMARY KEY  (`a14Codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
