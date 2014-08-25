ALTER TABLE `t07web_formularios`
	ALTER `a07Departamento` DROP DEFAULT,
	ALTER `a07Municipio` DROP DEFAULT;
ALTER TABLE `t07web_formularios`
	CHANGE COLUMN `a07Departamento` `a07Departamento` INT(11) NULL AFTER `a07Usuario`,
	CHANGE COLUMN `a07Municipio` `a07Municipio` INT(11) NULL AFTER `a07Departamento`;
