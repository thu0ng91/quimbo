K523633h

6f555a24-07ae-11e4-8eb8-0019d185774a 


ALTER TABLE `t09web_Usuario_RespuestasN`
	ADD COLUMN `a09O07` VARCHAR(200) NULL AFTER `a09O06`,
	ADD COLUMN `a09O08` VARCHAR(200) NULL AFTER `a09O07`,
	ADD COLUMN `a09O09` VARCHAR(200) NULL AFTER `a09O08`,
	ADD COLUMN `a09O010` VARCHAR(200) NULL AFTER `a09O09`;

CREATE TABLE `t00web_Roles` (
	`a01Codigo` INT NOT NULL AUTO_INCREMENT,
	`a01Nombre` VARCHAR(50) NOT NULL,
	`a01Tag` VARCHAR(10) NOT NULL,
	PRIMARY KEY (`a01Codigo`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;

INSERT INTO `t00web_Roles` (`a01Codigo`, `a01Nombre`, `a01Tag`) VALUES
	(1, 'Administrador', 'admin'),
	(2, 'Usuario', 'user'),
	(3, 'Clasificador', 'docs');


ALTER TABLE `t01web_Usuarios`
	ADD COLUMN `a01Tipo` INT NOT NULL AFTER `a01Codigo`;
ALTER TABLE `t01web_Usuarios`
	ADD CONSTRAINT `FK_t01web_Usuarios_t00web_Roles` FOREIGN KEY (`a01Tipo`) REFERENCES `t00web_Roles` (`a01Codigo`) ON UPDATE CASCADE;


UPDATE t01web_Usuarios SET a01tipo = 2
UPDATE t01web_Usuarios SET a01tipo = 1 WHERE a01Usuario = 'admin'

CREATE TABLE `t13web_Usuario_Docs` (
	`a13Codigo` INT(11) NOT NULL AUTO_INCREMENT,
	`a13Identificador` CHAR(36) NOT NULL,
	`a13Tipo` INT(11) NOT NULL,
	`a13Documento` VARCHAR(250) NOT NULL,
	`a13Folios` INT(11) NOT NULL,
	`a13Fecha` DATETIME NOT NULL,
	`a13Estado` ENUM('P','S') NOT NULL,
	PRIMARY KEY (`a13Codigo`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;




