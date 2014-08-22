ALTER TABLE `t14web_certificaciones_detalle`
	ADD COLUMN `a14Observaciones` VARCHAR(1000) NULL DEFAULT NULL COMMENT 'Observaciones' COLLATE 'utf8_spanish_ci' AFTER `a14CargoPersonaFirma`;
