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
