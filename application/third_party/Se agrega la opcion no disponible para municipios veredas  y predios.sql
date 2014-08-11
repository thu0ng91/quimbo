#Agrega opción Otros para los municipios
INSERT INTO t06web_municipios (a06Departamento, a06Nombre, a06DANE, a06Estado)
SELECT a05Codigo, 'No Disponible', '10000', 'A' FROM t05web_departamentos;

#Insertar opcion otros para todos los municipios
INSERT INTO t10web_veredas (t10web_veredas.a10Municipio, t10web_veredas.a10Nombre, t10web_veredas.a10Estado)
SELECT a06Codigo, 'No Disponible', 'A' FROM t06web_municipios;

#Se agrega la opcion otros en predios
INSERT INTO `t15web_predios` (`a15Vereda`, `a15Predio`, `a15Estado`)
SELECT `a10Codigo`, 'No Disponible', 'A' FROM `t10web_veredas`;