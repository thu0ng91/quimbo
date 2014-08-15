ALTER TABLE `t14web_certificaciones_detalle`
	CHANGE COLUMN `a14DocumentoIdentificacion` `a14DocumentoIdentificacion` BIGINT NULL DEFAULT NULL COMMENT 'Número del documento de identificación de quien firma la certificación' AFTER `a14NITPersonaJuridica`,
	CHANGE COLUMN `a14NITEmpresa` `a14NITEmpresa` BIGINT NULL DEFAULT NULL COMMENT 'NIT de la empresa que certifica' AFTER `a14NombreEmpresa`;