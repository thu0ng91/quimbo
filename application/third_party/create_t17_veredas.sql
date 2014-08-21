CREATE TABLE `t17web_nveredascertificaciones` (
	`a17Codigo` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla NVeredas',
	`a17Certificacion` INT(11) NOT NULL COMMENT 'Contiene el id de la certificacion relacionada',
	`a17Municipio` INT(11) NULL DEFAULT NULL COMMENT 'Contiene el municipio relacionado',
	`a17Vereda` INT(11) NULL DEFAULT NULL COMMENT 'Contiene la vereda relacionada',
	`a17Predio` INT(11) NULL DEFAULT NULL COMMENT 'Contiene el predio relacionado',
	`a17OtroMun` VARCHAR(200) NULL DEFAULT NULL COMMENT 'Contiene el valor Otro de Municipio' COLLATE 'utf8_spanish_ci',
	`a17OtraVda` VARCHAR(200) NULL DEFAULT NULL COMMENT 'Contiene el valor Otro de Vereda' COLLATE 'utf8_spanish_ci',
	`a17OtroPredio` VARCHAR(200) NULL DEFAULT NULL COMMENT 'Contiene el valor Otro de Predio' COLLATE 'utf8_spanish_ci',
	PRIMARY KEY (`a17Codigo`),
	INDEX `a17Certificacion` (`a17Certificacion`),
	CONSTRAINT `t17web_nveredascertificaciones_ibfk_1` FOREIGN KEY (`a17Certificacion`) REFERENCES `t14web_certificaciones_detalle` (`a14Codigo`)
)
COMMENT='Tabla que relaciona las veredas con las certificaciones.'
COLLATE='utf8_spanish_ci'