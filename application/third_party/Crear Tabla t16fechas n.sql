CREATE TABLE `t16web_nfechascertificaciones` (
  `a16Codigo` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla N Fechas Certificaciones',
  `a16Certificacion` INT(11) NOT NULL COMMENT 'Identificador de la certificacion correspondiente',
  `a16FechaInicio` DATE NOT NULL COMMENT 'Fecha inicio del periodo a registrar',
  `a16FechaFin` DATE NOT NULL COMMENT 'Fecha fin del periodo a registrar',
  PRIMARY KEY  (`a16Codigo`),
  KEY `a16Certificacion` (`a16Certificacion`),
  CONSTRAINT `t16web_nfechascertificaciones_ibfk_1` FOREIGN KEY (`a16Certificacion`) REFERENCES `t14web_certificaciones_detalle` (`a14Codigo`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

