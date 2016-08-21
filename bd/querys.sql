-- 2016-08-19
ALTER TABLE `firmas`
MODIFY COLUMN `estado_firma`  varchar(150) NULL DEFAULT NULL AFTER `nombre`,
ADD COLUMN `conteo`  int(1) NULL COMMENT '1: Valido | 2: Inválido | 3: Blanco' AFTER `estado_firma`;

ALTER TABLE `firmas`
ADD COLUMN `fila`  int(11) NULL AFTER `ficha`,
ADD COLUMN `paterno`  varchar(70) NULL AFTER `dni`,
ADD COLUMN `materno`  varchar(70) NULL AFTER `paterno`,
ADD COLUMN `nombre`  varchar(70) NULL AFTER `materno`;

-- 2016-08-17
ALTER TABLE `fichas`
ADD COLUMN `bueno`  int NULL AFTER `escalafon_ficha_recepcion_id`,
ADD COLUMN `malo`  int NULL AFTER `bueno`,
ADD COLUMN `blanco`  int NULL AFTER `malo`;

ALTER TABLE `fichas`
ADD COLUMN `hoja`  int(11) NULL AFTER `ficha`;

CREATE TABLE `relacion_hoja_ficha` (
`id`  int NOT NULL ,
`hoja`  int NULL ,
`ficha`  int NULL ,
`estado`  int(1) NULL DEFAULT 1 ,
`usuario_created_at`  int NULL ,
`usuario_updated_at`  int NULL ,
`created_at`  datetime NULL ,
`updated_at`  datetime NULL ,
PRIMARY KEY (`id`)
)
;
-- 2016-08-10
ALTER TABLE `cargos`
ADD COLUMN `tipo_cargo`  int(11) NULL COMMENT 'Tipo Cargo' AFTER `id`,
ADD COLUMN `orden`  int NULL COMMENT 'Orden' AFTER `nombre`;
