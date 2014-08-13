#Insertar opcion Zona Rural y Zona Urbana para todos las Veredas
INSERT INTO t10web_veredas (t10web_veredas.a10Municipio, t10web_veredas.a10Nombre, t10web_veredas.a10Estado)
SELECT a06Codigo, 'Zona Rural', 'A' FROM t06web_municipios;

INSERT INTO t10web_veredas (t10web_veredas.a10Municipio, t10web_veredas.a10Nombre, t10web_veredas.a10Estado)
SELECT a06Codigo, 'Zona Urbana', 'A' FROM t06web_municipios;

#Insertar opcion Zona Rural y Zona Urbana para todos los Predios
INSERT INTO `t15web_predios` (`a15Vereda`, `a15Predio`, `a15Estado`)
SELECT `a10Codigo`, 'Zona Rural', 'A' FROM `t10web_veredas`;

INSERT INTO `t15web_predios` (`a15Vereda`, `a15Predio`, `a15Estado`)
SELECT `a10Codigo`, 'Zona Urbana', 'A' FROM `t10web_veredas`;