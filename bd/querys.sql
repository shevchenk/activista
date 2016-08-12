-- 2016-08-10
ALTER TABLE `cargos`
ADD COLUMN `tipo_cargo`  int(11) NULL COMMENT 'Tipo Cargo' AFTER `id`,
ADD COLUMN `orden`  int NULL COMMENT 'Orden' AFTER `nombre`;
