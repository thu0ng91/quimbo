#Se agrega el campo de Persona no figura en la certificacion para la tabla t14
ALTER TABLE `quimbo`.`t14web_certificaciones_detalle`   
  ADD COLUMN `a14PersonaNoFigura` TINYINT(4) NULL  COMMENT 'Notifica si la persona encuestada no figura dentro de la certificación digitada' AFTER `a14FechaUltimaActualizacion`;