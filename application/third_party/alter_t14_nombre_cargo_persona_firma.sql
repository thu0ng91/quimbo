--Se agregan los campos nombre y cargo de la persona que firma
ALTER TABLE `t14web_certificaciones_detalle`
	ADD COLUMN `a14NombrePersonaFirma` VARCHAR(500) NULL DEFAULT NULL COMMENT 'Nombre completo de la persona que firma.' COLLATE 'utf8_spanish_ci' AFTER `a14PersonaNoFigura`,
	ADD COLUMN `a14CargoPersonaFirma` VARCHAR(500) NULL DEFAULT NULL COMMENT 'Cargo de la persona que firma.' COLLATE 'utf8_spanish_ci' AFTER `a14NombrePersonaFirma`;