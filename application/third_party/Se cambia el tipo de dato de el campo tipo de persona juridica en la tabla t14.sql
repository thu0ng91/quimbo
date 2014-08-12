ALTER TABLE `quimbo`.`t14web_certificaciones_detalle`   
  CHANGE `a14TipoPersonaJuridica` `a14TipoPersonaJuridica` SMALLINT(2) NULL  COMMENT 'Junta de acción comunal, Unidad de justicia y comisaría de familia, Personería, Alcaldía, otro',
  CHANGE `a14NombrePersonaJuridica` `a14NombrePersonaJuridica` VARCHAR(500) NULL  COMMENT 'Nombre completo de la persona jurídica que certifica';
