-- ----------------------------
-- Table structure for activista_apoyo
-- ----------------------------
DROP TABLE IF EXISTS `activista_apoyo`;
CREATE TABLE `activista_apoyo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_activista` int(11) DEFAULT NULL,
  `id_apoyo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for activista_cargo
-- ----------------------------
DROP TABLE IF EXISTS `activista_cargo`;
CREATE TABLE `activista_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activista_id` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ac_activista_id` (`activista_id`),
  KEY `ac_cargo_id` (`cargo_id`),
  CONSTRAINT `ac_activista_id` FOREIGN KEY (`activista_id`) REFERENCES `activistas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ac_cargo_id` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of activista_cargo
-- ----------------------------
INSERT INTO `activista_cargo` VALUES ('1', '1', '11', '1', '2016-01-08 00:30:51', null, '1', '3');
INSERT INTO `activista_cargo` VALUES ('2', '2', '11', '1', '2016-01-11 19:15:42', '2016-01-11 19:15:42', '3', null);

-- ----------------------------
-- Table structure for activista_grupo
-- ----------------------------
DROP TABLE IF EXISTS `activista_grupo`;
CREATE TABLE `activista_grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activista_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ag_activista_id` (`activista_id`),
  KEY `ag_grupo_id` (`grupo_id`),
  CONSTRAINT `ag_activista_id` FOREIGN KEY (`activista_id`) REFERENCES `activistas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ag_grupo_id` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for activista_nivel
-- ----------------------------
DROP TABLE IF EXISTS `activista_nivel`;
CREATE TABLE `activista_nivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activista_id` int(11) NOT NULL,
  `nivel_id` int(11) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `an_activista_id` (`activista_id`),
  KEY `an_nivel_id` (`nivel_id`),
  CONSTRAINT `an_activista_id` FOREIGN KEY (`activista_id`) REFERENCES `activistas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `an_nivel_id` FOREIGN KEY (`nivel_id`) REFERENCES `niveles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of activista_nivel
-- ----------------------------

-- ----------------------------
-- Table structure for activistas
-- ----------------------------
DROP TABLE IF EXISTS `activistas`;
CREATE TABLE `activistas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nivel_id` int(11) NOT NULL DEFAULT '1',
  `centro_votacion_id` int(11) DEFAULT NULL,
  `paterno` varchar(70) NOT NULL,
  `materno` varchar(70) NOT NULL,
  `nombres` varchar(70) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `dni` char(8) NOT NULL,
  `email` varchar(150) NOT NULL,
  `sexo` char(1) DEFAULT NULL COMMENT '1: Masculino | 2:Femenino',
  `orientacion_sexual` char(1) DEFAULT NULL COMMENT '1:Heterosexual  | 2:Homosexual | 3: Moderno',
  `fecha_ingreso` date NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  `estado_civil` char(1) DEFAULT NULL,
  `grado_instruccion` char(1) DEFAULT NULL,
  `profesion` varchar(500) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `n_departamento` int(11) DEFAULT NULL,
  `n_provincia` int(11) DEFAULT NULL,
  `n_distrito` int(11) DEFAULT NULL,
  `d_departamento` int(11) DEFAULT NULL,
  `d_provincia` int(11) DEFAULT NULL,
  `d_distrito` int(11) DEFAULT NULL,
  `d_urbanizacion` varchar(500) DEFAULT NULL,
  `d_avenida` varchar(500) DEFAULT NULL,
  `d_numero` varchar(500) DEFAULT NULL,
  `d_telefono` varchar(500) DEFAULT NULL,
  `cv_departamento` int(11) DEFAULT NULL,
  `cv_provincia` int(11) DEFAULT NULL,
  `cv_distrito` int(11) DEFAULT NULL,
  `cv_colegio` varchar(500) DEFAULT NULL,
  `cv_mesa` varchar(500) DEFAULT NULL,
  `cl_departamento` int(11) DEFAULT NULL,
  `cl_provincia` int(11) DEFAULT NULL,
  `cl_distrito` int(11) DEFAULT NULL,
  `cl_urbanizacion` varchar(500) DEFAULT NULL,
  `cl_direccion` varchar(500) DEFAULT NULL,
  `cl_numero` varchar(500) DEFAULT NULL,
  `cl_telefono` varchar(500) DEFAULT NULL,
  `cl_nombre` varchar(500) DEFAULT NULL,
  `soy_lider` char(1) DEFAULT '0',
  `lider_padre` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `grupo_persona_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `a_centro_votacion_id` (`centro_votacion_id`),
  KEY `a_nivel_id` (`nivel_id`),
  CONSTRAINT `a_centro_votacion_id` FOREIGN KEY (`centro_votacion_id`) REFERENCES `centro_votaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of activistas
-- ----------------------------
INSERT INTO `activistas` VALUES ('1', '11', null, 'Salcedo', 'Franco', 'Jorge Luis', '$2y$10$bBAMrO6/dDGItoVFm4mCgu5y63ztbJ0Hd/rlAlKCeBLcZGWk3Uj/K', '45350382', 'jorgeshevchenk@gmail.com', '1', '1', '2016-07-19', '', 'zjjg8GOw6MbVXQmPMCZJsQ5T1Can1O6CamFJ8a4FoJtmg6FlhO63F3z7WIpM', '1', '2016-01-07 23:32:15', '2016-07-22 16:43:22', '1', '3', '2', '3', 'ingeniria', '954573333', '@lueimg', '2015-12-04', '14', '127', '1272', '14', '127', '1264', 'mazon', '', '89', '877566767', '1', '1', '1', 'colegio', 'mesa', '2', '8', '85', 'cv ubr', 'cl dire', '899', '7687678', 'belatrix', '1', '6535', null, '1');
INSERT INTO `activistas` VALUES ('2', '11', null, 'LUNA', 'GALVEZ', 'JUAN', '$2y$10$Q.KeRJyD1fFc4GIXFKQ5HOj7rrR/e4zL/1g6tQ5ljVR.KT9wNE0i2', '08327378', 'liebre.freddy23@GMAIL.COM', '1', '1', '2016-03-15', 'u3.png', 'hBPiLkspn9QLthMmqba9ivpU9VGtCd7h6UD6Njlzoglx8U2TkzHXVSHn568b', '1', '2016-01-11 19:15:42', '2016-08-03 00:39:04', null, '3', '2', '5', 'ING. SISTEMAS', '956879545', '#JUANLUNA', '1964-05-26', '14', '127', '1279', '14', '127', '1279', 'Chacarilla de Otero', 'Av. Próceres de la Independencia', '698', '7267468', '14', '127', '1279', 'FE Y ALEGRIA N° 5', '6582', '14', '127', '1276', '', '', '', '', '', '1', '3', null, '39');

-- ----------------------------
-- Table structure for apoyos
-- ----------------------------
DROP TABLE IF EXISTS `apoyos`;
CREATE TABLE `apoyos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(400) NOT NULL,
  `puntos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of apoyos
-- ----------------------------
INSERT INTO `apoyos` VALUES ('1', 'Personero', null);
INSERT INTO `apoyos` VALUES ('2', 'Da Pared', null);
INSERT INTO `apoyos` VALUES ('3', 'Coordinador de centro de votación', null);
INSERT INTO `apoyos` VALUES ('4', 'Pared de pancarta', null);
INSERT INTO `apoyos` VALUES ('5', 'Aviso en la puerta', null);

-- ----------------------------
-- Table structure for archivos
-- ----------------------------
DROP TABLE IF EXISTS `archivos`;
CREATE TABLE `archivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  `ubicacion` varchar(500) DEFAULT NULL,
  `type` varchar(500) DEFAULT NULL,
  `size` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for asistencia_eventos
-- ----------------------------
DROP TABLE IF EXISTS `asistencia_eventos`;
CREATE TABLE `asistencia_eventos` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `activista_id` int(11) NOT NULL,
  `nro_invitados` int(1) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ae_activista_id` (`activista_id`),
  KEY `ae_evento_id` (`evento_id`),
  CONSTRAINT `ae_activista_id` FOREIGN KEY (`activista_id`) REFERENCES `activistas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ae_evento_id` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of asistencia_eventos
-- ----------------------------

-- ----------------------------
-- Table structure for cargo_opcion
-- ----------------------------
DROP TABLE IF EXISTS `cargo_opcion`;
CREATE TABLE `cargo_opcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_id` int(11) NOT NULL,
  `opcion_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `co_cargo_id_idx` (`cargo_id`) USING BTREE,
  KEY `co_opcion_id_idx` (`opcion_id`) USING BTREE,
  CONSTRAINT `cargo_opcion_ibfk_1` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cargo_opcion_ibfk_2` FOREIGN KEY (`opcion_id`) REFERENCES `opciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cargo_opcion
-- ----------------------------
INSERT INTO `cargo_opcion` VALUES ('25', '1', '1', '0', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('26', '1', '2', '0', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('27', '1', '3', '1', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('28', '1', '4', '1', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('29', '3', '1', '0', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('30', '3', '2', '0', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('31', '3', '3', '1', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('32', '3', '4', '1', '2016-01-24 23:16:34', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('36', '4', '1', '0', '2016-01-24 23:16:39', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('37', '4', '2', '0', '2016-01-24 23:16:39', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('38', '4', '3', '1', '2016-01-24 23:16:39', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('39', '4', '4', '1', '2016-01-24 23:16:39', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('43', '5', '1', '0', '2016-01-24 23:16:42', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('44', '5', '2', '0', '2016-01-24 23:16:42', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('45', '5', '3', '1', '2016-01-24 23:16:42', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('46', '5', '4', '1', '2016-01-24 23:16:42', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('50', '6', '1', '0', '2016-01-24 23:16:49', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('51', '6', '2', '0', '2016-01-24 23:16:49', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('52', '6', '3', '1', '2016-01-24 23:16:49', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('53', '6', '4', '1', '2016-01-24 23:16:49', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('57', '7', '1', '0', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('58', '7', '2', '0', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('59', '7', '3', '1', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('64', '8', '1', '0', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('65', '8', '2', '0', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('66', '8', '3', '1', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('67', '9', '1', '0', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('68', '9', '2', '0', '2016-01-24 23:17:24', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('69', '2', '1', '0', '2016-01-25 20:38:22', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('70', '2', '2', '0', '2016-01-25 20:38:22', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('71', '2', '3', '1', '2016-01-25 20:38:22', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('72', '2', '4', '1', '2016-01-25 20:38:22', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('76', '8', '5', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('77', '7', '5', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('84', '11', '1', '0', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('85', '11', '2', '0', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('86', '11', '3', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('87', '11', '22', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('88', '11', '23', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('89', '1', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('90', '2', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('91', '3', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('92', '4', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('93', '5', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('94', '6', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('95', '9', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('96', '10', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('97', '11', '5', '1', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('104', '10', '24', '0', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('105', '11', '24', '0', '2016-02-06 09:29:20', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('107', '11', '25', '1', '2016-02-17 14:17:06', '2016-02-17 14:17:06', '1', '3');
INSERT INTO `cargo_opcion` VALUES ('108', '1', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('109', '2', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('110', '3', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('111', '4', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('112', '5', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('113', '6', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('114', '7', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('115', '8', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('116', '9', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('117', '10', '25', '1', '2016-02-20 08:59:18', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('123', '1', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('124', '2', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('125', '3', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('126', '4', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('127', '5', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('128', '6', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('129', '7', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('130', '8', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('131', '9', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('132', '10', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('133', '11', '26', '1', '2016-02-21 00:37:38', null, '1', '3');
INSERT INTO `cargo_opcion` VALUES ('138', '11', '27', '1', '2016-02-21 00:37:38', null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('139', '10', '27', '1', '2016-02-21 00:37:38', null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('141', '11', '28', '1', '2016-02-21 00:37:38', null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('142', '11', '29', '1', '2016-02-21 00:37:38', null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('143', '11', '30', '1', '2016-02-21 00:37:38', null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('144', '11', '31', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('145', '1', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('146', '2', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('148', '3', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('149', '4', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('151', '5', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('152', '6', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('153', '7', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('154', '8', '32', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('155', '11', '33', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('156', '12', '33', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('157', '1', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('159', '2', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('160', '3', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('161', '4', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('162', '5', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('163', '6', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('164', '10', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('165', '11', '34', '1', null, null, null, '3');
INSERT INTO `cargo_opcion` VALUES ('166', '11', '35', '1', '2016-07-04 00:00:00', null, '1', null);
INSERT INTO `cargo_opcion` VALUES ('167', '8', '4', '1', '2016-07-20 19:00:08', '2016-07-20 19:00:08', '3', null);
INSERT INTO `cargo_opcion` VALUES ('170', '11', '37', '1', null, null, null, null);
INSERT INTO `cargo_opcion` VALUES ('171', '11', '38', '1', null, null, null, null);
INSERT INTO `cargo_opcion` VALUES ('172', '11', '39', '1', null, null, null, null);
INSERT INTO `cargo_opcion` VALUES ('173', '11', '40', '1', null, null, null, null);

-- ----------------------------
-- Table structure for cargos
-- ----------------------------
DROP TABLE IF EXISTS `cargos`;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cargos
-- ----------------------------
INSERT INTO `cargos` VALUES ('1', '9.- Celebridad', '1', '2015-10-18 20:53:24', '2016-07-19 14:40:49', '1', '3');
INSERT INTO `cargos` VALUES ('2', '8.- Experto', '1', '2015-10-22 18:14:28', '2016-07-19 14:40:37', '1', '3');
INSERT INTO `cargos` VALUES ('3', '7.- Líderes de Pensamiento', '1', '2015-10-22 18:16:14', '2016-07-19 14:40:04', '1', '3');
INSERT INTO `cargos` VALUES ('4', '6.- Difusor', '1', '2015-10-23 20:41:48', '2016-07-19 14:39:46', '1', '3');
INSERT INTO `cargos` VALUES ('5', '5.- Creador de Red', '1', '2015-10-23 20:41:48', '2016-07-19 14:39:27', '1', '3');
INSERT INTO `cargos` VALUES ('6', '4.- Socializador', '1', '2015-10-23 20:41:48', '2016-07-19 14:39:12', '1', '3');
INSERT INTO `cargos` VALUES ('7', '3.- Activista', '1', '2015-10-23 20:41:48', '2016-07-19 14:38:55', '1', '3');
INSERT INTO `cargos` VALUES ('8', '2.- Seguidor', '1', '2015-10-23 20:41:48', '2016-07-19 14:38:36', '1', '3');
INSERT INTO `cargos` VALUES ('9', '1.- Simpatizante', '1', '2015-10-23 20:41:48', '2016-07-19 14:38:02', '1', '3');
INSERT INTO `cargos` VALUES ('10', 'X Liebre', '1', null, '2016-07-19 12:49:39', null, '3');
INSERT INTO `cargos` VALUES ('11', 'X Administrador RED', '1', null, '2016-06-29 13:21:41', null, '3');
INSERT INTO `cargos` VALUES ('12', 'X Liebre Validador', '1', null, '2016-07-19 12:48:29', null, '3');

-- ----------------------------
-- Table structure for cargos_estrategicos
-- ----------------------------
DROP TABLE IF EXISTS `cargos_estrategicos`;
CREATE TABLE `cargos_estrategicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cargos_estrategicos
-- ----------------------------
INSERT INTO `cargos_estrategicos` VALUES ('1', 'Presidente', '0', '2016-06-24 11:31:38', '2016-07-21 14:14:56', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('2', 'Administrador zonal', '1', '2016-06-24 11:42:26', '2016-07-21 14:13:36', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('3', 'xxxxxxxxxxx', '0', '2016-06-24 16:30:20', '2016-07-19 15:18:46', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('4', 'Dir. de Organización y movilización', '1', '2016-06-24 16:30:57', '2016-07-28 09:54:50', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('5', 'Administrador Distrital', '1', '2016-06-29 14:37:55', '2016-07-21 14:12:39', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('6', 'Supervisor Regional', '1', '2016-06-29 14:46:07', '2016-07-21 14:07:29', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('7', 'Dir. de Macroregiones', '0', '2016-06-29 14:46:19', '2016-07-21 14:14:44', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('8', 'Dir. de Planificación y Control', '0', '2016-06-29 14:46:44', '2016-07-21 14:15:21', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('9', 'Empadronador', '1', '2016-06-29 14:47:09', '2016-07-28 10:29:24', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('10', 'Coordinador', '1', '2016-06-29 14:48:17', '2016-07-21 14:10:08', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('11', 'Dir. de Mujer', '0', '2016-06-29 14:48:51', '2016-07-21 14:14:38', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('12', 'Dir. de Profesionales', '0', '2016-06-29 14:49:03', '2016-07-21 14:15:17', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('13', 'Dir. de Trabajadores', '0', '2016-06-29 14:49:16', '2016-07-21 14:14:20', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('14', 'Dir. de Juventudes', '0', '2016-06-29 14:50:47', '2016-07-21 14:14:47', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('15', 'Dir. de Org. Populares', '0', '2016-06-29 14:51:16', '2016-07-21 14:15:40', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('16', 'Dir. de Org. Civiles', '0', '2016-06-29 14:51:33', '2016-07-21 14:14:41', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('17', 'Administrador Provincial', '1', '2016-06-29 18:45:54', '2016-07-21 14:12:10', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('18', 'xxxyyyy', '0', '2016-06-29 18:46:30', '2016-07-19 15:18:58', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('19', 'xxxxxyyyyxxxx', '0', '2016-06-29 18:47:32', '2016-07-19 15:18:54', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('20', 'xxxxxxxxxxxxxx', '0', '2016-06-29 18:48:00', '2016-07-19 19:53:57', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('21', 'Secretario General', '1', '2016-06-29 18:48:55', '2016-07-28 09:54:34', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('22', 'xxxwwwee', '0', '2016-06-29 18:49:09', '2016-07-19 15:16:39', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('23', 'Afiliado', '1', '2016-07-19 15:05:23', '2016-07-19 15:05:23', '3', null);
INSERT INTO `cargos_estrategicos` VALUES ('24', 'Dir. de Redes Sociales', '0', '2016-07-19 15:20:42', '2016-07-21 14:15:12', '3', '3');
INSERT INTO `cargos_estrategicos` VALUES ('25', 'Administrador Regional', '1', '2016-07-21 14:08:03', '2016-07-21 14:08:03', '3', null);
INSERT INTO `cargos_estrategicos` VALUES ('26', 'Supervisor Provincial', '1', '2016-07-21 14:08:39', '2016-07-21 14:08:39', '3', null);
INSERT INTO `cargos_estrategicos` VALUES ('27', 'Supervisor Distrital', '1', '2016-07-21 14:10:36', '2016-07-21 14:10:36', '3', null);
INSERT INTO `cargos_estrategicos` VALUES ('28', 'Supervisor Zonal', '1', '2016-07-21 14:10:54', '2016-07-21 14:10:54', '3', null);

-- ----------------------------
-- Table structure for centro_votaciones
-- ----------------------------
DROP TABLE IF EXISTS `centro_votaciones`;
CREATE TABLE `centro_votaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distrito_id` int(11) NOT NULL,
  `nro` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ubigeo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `departamento` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `provincia` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `distrito` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `local` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `grupo_votacion` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `nro_mesas` int(11) DEFAULT NULL,
  `nro_electo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `n` (`nro`),
  KEY `cv_distrito_id` (`distrito_id`),
  CONSTRAINT `cv_distrito_id` FOREIGN KEY (`distrito_id`) REFERENCES `distritos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of centro_votaciones
-- ----------------------------

-- ----------------------------
-- Table structure for departamentos
-- ----------------------------
DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of departamentos
-- ----------------------------
INSERT INTO `departamentos` VALUES ('1', 'AMAZONAS');
INSERT INTO `departamentos` VALUES ('2', 'ANCASH');
INSERT INTO `departamentos` VALUES ('3', 'APURIMAC');
INSERT INTO `departamentos` VALUES ('4', 'AREQUIPA');
INSERT INTO `departamentos` VALUES ('5', 'AYACUCHO');
INSERT INTO `departamentos` VALUES ('6', 'CAJAMARCA');
INSERT INTO `departamentos` VALUES ('7', 'CUSCO');
INSERT INTO `departamentos` VALUES ('8', 'HUANCAVELICA');
INSERT INTO `departamentos` VALUES ('9', 'HUANUCO');
INSERT INTO `departamentos` VALUES ('10', 'ICA');
INSERT INTO `departamentos` VALUES ('11', 'JUNIN');
INSERT INTO `departamentos` VALUES ('12', 'LA LIBERTAD');
INSERT INTO `departamentos` VALUES ('13', 'LAMBAYEQUE');
INSERT INTO `departamentos` VALUES ('14', 'LIMA');
INSERT INTO `departamentos` VALUES ('15', 'LORETO');
INSERT INTO `departamentos` VALUES ('16', 'MADRE DE DIOS');
INSERT INTO `departamentos` VALUES ('17', 'MOQUEGUA');
INSERT INTO `departamentos` VALUES ('18', 'PASCO');
INSERT INTO `departamentos` VALUES ('19', 'PIURA');
INSERT INTO `departamentos` VALUES ('20', 'PUNO');
INSERT INTO `departamentos` VALUES ('21', 'SAN MARTIN');
INSERT INTO `departamentos` VALUES ('22', 'TACNA');
INSERT INTO `departamentos` VALUES ('23', 'TUMBES');
INSERT INTO `departamentos` VALUES ('24', 'CALLAO');
INSERT INTO `departamentos` VALUES ('25', 'UCAYALI');

-- ----------------------------
-- Table structure for distritos
-- ----------------------------
DROP TABLE IF EXISTS `distritos`;
CREATE TABLE `distritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_id` int(11) NOT NULL,
  `ubigeo` varchar(6) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idprovincia` (`provincia_id`),
  CONSTRAINT `di_provincia_id` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1835 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of distritos
-- ----------------------------
INSERT INTO `distritos` VALUES ('1', '1', '010101', 'CHACHAPOYAS');
INSERT INTO `distritos` VALUES ('2', '1', '010102', 'ASUNCION');
INSERT INTO `distritos` VALUES ('3', '1', '010103', 'BALSAS');
INSERT INTO `distritos` VALUES ('4', '1', '010104', 'CHETO');
INSERT INTO `distritos` VALUES ('5', '1', '010105', 'CHILIQUIN');
INSERT INTO `distritos` VALUES ('6', '1', '010106', 'CHUQUIBAMBA');
INSERT INTO `distritos` VALUES ('7', '1', '010107', 'GRANADA');
INSERT INTO `distritos` VALUES ('8', '1', '010108', 'HUANCAS');
INSERT INTO `distritos` VALUES ('9', '1', '010109', 'LA JALCA');
INSERT INTO `distritos` VALUES ('10', '1', '010110', 'LEIMEBAMBA');
INSERT INTO `distritos` VALUES ('11', '1', '010111', 'LEVANTO');
INSERT INTO `distritos` VALUES ('12', '1', '010112', 'MAGDALENA');
INSERT INTO `distritos` VALUES ('13', '1', '010113', 'MARISCAL CASTILLA');
INSERT INTO `distritos` VALUES ('14', '1', '010114', 'MOLINOPAMPA');
INSERT INTO `distritos` VALUES ('15', '1', '010115', 'MONTEVIDEO');
INSERT INTO `distritos` VALUES ('16', '1', '010116', 'OLLEROS');
INSERT INTO `distritos` VALUES ('17', '1', '010117', 'QUINJALCA');
INSERT INTO `distritos` VALUES ('18', '1', '010118', 'SAN FCO DE DAGUAS');
INSERT INTO `distritos` VALUES ('19', '1', '010119', 'SAN ISIDRO DE MAINO');
INSERT INTO `distritos` VALUES ('20', '1', '010120', 'SOLOCO');
INSERT INTO `distritos` VALUES ('21', '1', '010121', 'SONCHE');
INSERT INTO `distritos` VALUES ('22', '2', '010201', 'LA PECA');
INSERT INTO `distritos` VALUES ('23', '2', '010202', 'ARAMANGO');
INSERT INTO `distritos` VALUES ('24', '2', '010203', 'COPALLIN');
INSERT INTO `distritos` VALUES ('25', '2', '010204', 'EL PARCO');
INSERT INTO `distritos` VALUES ('26', '2', '010205', 'BAGUA');
INSERT INTO `distritos` VALUES ('27', '2', '010206', 'IMAZA');
INSERT INTO `distritos` VALUES ('28', '3', '010301', 'JUMBILLA');
INSERT INTO `distritos` VALUES ('29', '3', '010302', 'COROSHA');
INSERT INTO `distritos` VALUES ('30', '3', '010303', 'CUISPES');
INSERT INTO `distritos` VALUES ('31', '3', '010304', 'CHISQUILLA');
INSERT INTO `distritos` VALUES ('32', '3', '010305', 'CHURUJA');
INSERT INTO `distritos` VALUES ('33', '3', '010306', 'FLORIDA');
INSERT INTO `distritos` VALUES ('34', '3', '010307', 'RECTA');
INSERT INTO `distritos` VALUES ('35', '3', '010308', 'SAN CARLOS');
INSERT INTO `distritos` VALUES ('36', '3', '010309', 'SHIPASBAMBA');
INSERT INTO `distritos` VALUES ('37', '3', '010310', 'VALERA');
INSERT INTO `distritos` VALUES ('38', '3', '010311', 'YAMBRASBAMBA');
INSERT INTO `distritos` VALUES ('39', '3', '010312', 'JAZAN');
INSERT INTO `distritos` VALUES ('40', '4', '010401', 'LAMUD');
INSERT INTO `distritos` VALUES ('41', '4', '010402', 'CAMPORREDONDO');
INSERT INTO `distritos` VALUES ('42', '4', '010403', 'COCABAMBA');
INSERT INTO `distritos` VALUES ('43', '4', '010404', 'COLCAMAR');
INSERT INTO `distritos` VALUES ('44', '4', '010405', 'CONILA');
INSERT INTO `distritos` VALUES ('45', '4', '010406', 'INGUILPATA');
INSERT INTO `distritos` VALUES ('46', '4', '010407', 'LONGUITA');
INSERT INTO `distritos` VALUES ('47', '4', '010408', 'LONYA CHICO');
INSERT INTO `distritos` VALUES ('48', '4', '010409', 'LUYA');
INSERT INTO `distritos` VALUES ('49', '4', '010410', 'LUYA VIEJO');
INSERT INTO `distritos` VALUES ('50', '4', '010411', 'MARIA');
INSERT INTO `distritos` VALUES ('51', '4', '010412', 'OCALLI');
INSERT INTO `distritos` VALUES ('52', '4', '010413', 'OCUMAL');
INSERT INTO `distritos` VALUES ('53', '4', '010414', 'PISUQUIA');
INSERT INTO `distritos` VALUES ('54', '4', '010415', 'SAN CRISTOBAL');
INSERT INTO `distritos` VALUES ('55', '4', '010416', 'SAN FRANCISCO DE YESO');
INSERT INTO `distritos` VALUES ('56', '4', '010417', 'SAN JERONIMO');
INSERT INTO `distritos` VALUES ('57', '4', '010418', 'SAN JUAN DE LOPECANCHA');
INSERT INTO `distritos` VALUES ('58', '4', '010419', 'SANTA CATALINA');
INSERT INTO `distritos` VALUES ('59', '4', '010420', 'SANTO TOMAS');
INSERT INTO `distritos` VALUES ('60', '4', '010421', 'TINGO');
INSERT INTO `distritos` VALUES ('61', '4', '010422', 'TRITA');
INSERT INTO `distritos` VALUES ('62', '4', '010423', 'PROVIDENCIA');
INSERT INTO `distritos` VALUES ('63', '5', '010501', 'SAN NICOLAS');
INSERT INTO `distritos` VALUES ('64', '5', '010502', 'COCHAMAL');
INSERT INTO `distritos` VALUES ('65', '5', '010503', 'CHIRIMOTO');
INSERT INTO `distritos` VALUES ('66', '5', '010504', 'HUAMBO');
INSERT INTO `distritos` VALUES ('67', '5', '010505', 'LIMABAMBA');
INSERT INTO `distritos` VALUES ('68', '5', '010506', 'LONGAR');
INSERT INTO `distritos` VALUES ('69', '5', '010507', 'MILPUC');
INSERT INTO `distritos` VALUES ('70', '5', '010508', 'MCAL BENAVIDES');
INSERT INTO `distritos` VALUES ('71', '5', '010509', 'OMIA');
INSERT INTO `distritos` VALUES ('72', '5', '010510', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('73', '5', '010511', 'TOTORA');
INSERT INTO `distritos` VALUES ('74', '5', '010512', 'VISTA ALEGRE');
INSERT INTO `distritos` VALUES ('75', '6', '010601', 'NIEVA');
INSERT INTO `distritos` VALUES ('76', '6', '010602', 'RIO SANTIAGO');
INSERT INTO `distritos` VALUES ('77', '6', '010603', 'EL CENEPA');
INSERT INTO `distritos` VALUES ('78', '7', '010701', 'BAGUA GRANDE');
INSERT INTO `distritos` VALUES ('79', '7', '010702', 'CAJARURO');
INSERT INTO `distritos` VALUES ('80', '7', '010703', 'CUMBA');
INSERT INTO `distritos` VALUES ('81', '7', '010704', 'EL MILAGRO');
INSERT INTO `distritos` VALUES ('82', '7', '010705', 'JAMALCA');
INSERT INTO `distritos` VALUES ('83', '7', '010706', 'LONYA GRANDE');
INSERT INTO `distritos` VALUES ('84', '7', '010707', 'YAMON');
INSERT INTO `distritos` VALUES ('85', '8', '020101', 'HUARAZ');
INSERT INTO `distritos` VALUES ('86', '8', '020102', 'INDEPENDENCIA');
INSERT INTO `distritos` VALUES ('87', '8', '020103', 'COCHABAMBA');
INSERT INTO `distritos` VALUES ('88', '8', '020104', 'COLCABAMBA');
INSERT INTO `distritos` VALUES ('89', '8', '020105', 'HUANCHAY');
INSERT INTO `distritos` VALUES ('90', '8', '020106', 'JANGAS');
INSERT INTO `distritos` VALUES ('91', '8', '020107', 'LA LIBERTAD');
INSERT INTO `distritos` VALUES ('92', '8', '020108', 'OLLEROS');
INSERT INTO `distritos` VALUES ('93', '8', '020109', 'PAMPAS');
INSERT INTO `distritos` VALUES ('94', '8', '020110', 'PARIACOTO');
INSERT INTO `distritos` VALUES ('95', '8', '020111', 'PIRA');
INSERT INTO `distritos` VALUES ('96', '8', '020112', 'TARICA');
INSERT INTO `distritos` VALUES ('97', '9', '020201', 'AIJA');
INSERT INTO `distritos` VALUES ('98', '9', '020203', 'CORIS');
INSERT INTO `distritos` VALUES ('99', '9', '020205', 'HUACLLAN');
INSERT INTO `distritos` VALUES ('100', '9', '020206', 'LA MERCED');
INSERT INTO `distritos` VALUES ('101', '9', '020208', 'SUCCHA');
INSERT INTO `distritos` VALUES ('102', '10', '020301', 'CHIQUIAN');
INSERT INTO `distritos` VALUES ('103', '10', '020302', 'A PARDO LEZAMETA');
INSERT INTO `distritos` VALUES ('104', '10', '020304', 'AQUIA');
INSERT INTO `distritos` VALUES ('105', '10', '020305', 'CAJACAY');
INSERT INTO `distritos` VALUES ('106', '10', '020310', 'HUAYLLACAYAN');
INSERT INTO `distritos` VALUES ('107', '10', '020311', 'HUASTA');
INSERT INTO `distritos` VALUES ('108', '10', '020313', 'MANGAS');
INSERT INTO `distritos` VALUES ('109', '10', '020315', 'PACLLON');
INSERT INTO `distritos` VALUES ('110', '10', '020317', 'SAN MIGUEL DE CORPANQUI');
INSERT INTO `distritos` VALUES ('111', '10', '020320', 'TICLLOS');
INSERT INTO `distritos` VALUES ('112', '10', '020321', 'ANTONIO RAIMONDI');
INSERT INTO `distritos` VALUES ('113', '10', '020322', 'CANIS');
INSERT INTO `distritos` VALUES ('114', '10', '020323', 'COLQUIOC');
INSERT INTO `distritos` VALUES ('115', '10', '020324', 'LA PRIMAVERA');
INSERT INTO `distritos` VALUES ('116', '10', '020325', 'HUALLANCA');
INSERT INTO `distritos` VALUES ('117', '11', '020401', 'CARHUAZ');
INSERT INTO `distritos` VALUES ('118', '11', '020402', 'ACOPAMPA');
INSERT INTO `distritos` VALUES ('119', '11', '020403', 'AMASHCA');
INSERT INTO `distritos` VALUES ('120', '11', '020404', 'ANTA');
INSERT INTO `distritos` VALUES ('121', '11', '020405', 'ATAQUERO');
INSERT INTO `distritos` VALUES ('122', '11', '020406', 'MARCARA');
INSERT INTO `distritos` VALUES ('123', '11', '020407', 'PARIAHUANCA');
INSERT INTO `distritos` VALUES ('124', '11', '020408', 'SAN MIGUEL DE ACO');
INSERT INTO `distritos` VALUES ('125', '11', '020409', 'SHILLA');
INSERT INTO `distritos` VALUES ('126', '11', '020410', 'TINCO');
INSERT INTO `distritos` VALUES ('127', '11', '020411', 'YUNGAR');
INSERT INTO `distritos` VALUES ('128', '12', '020501', 'CASMA');
INSERT INTO `distritos` VALUES ('129', '12', '020502', 'BUENA VISTA ALTA');
INSERT INTO `distritos` VALUES ('130', '12', '020503', 'COMANDANTE NOEL');
INSERT INTO `distritos` VALUES ('131', '12', '020505', 'YAUTAN');
INSERT INTO `distritos` VALUES ('132', '13', '020601', 'CORONGO');
INSERT INTO `distritos` VALUES ('133', '13', '020602', 'ACO');
INSERT INTO `distritos` VALUES ('134', '13', '020603', 'BAMBAS');
INSERT INTO `distritos` VALUES ('135', '13', '020604', 'CUSCA');
INSERT INTO `distritos` VALUES ('136', '13', '020605', 'LA PAMPA');
INSERT INTO `distritos` VALUES ('137', '13', '020606', 'YANAC');
INSERT INTO `distritos` VALUES ('138', '13', '020607', 'YUPAN');
INSERT INTO `distritos` VALUES ('139', '14', '020701', 'CARAZ');
INSERT INTO `distritos` VALUES ('140', '14', '020702', 'HUALLANCA');
INSERT INTO `distritos` VALUES ('141', '14', '020703', 'HUATA');
INSERT INTO `distritos` VALUES ('142', '14', '020704', 'HUAYLAS');
INSERT INTO `distritos` VALUES ('143', '14', '020705', 'MATO');
INSERT INTO `distritos` VALUES ('144', '14', '020706', 'PAMPAROMAS');
INSERT INTO `distritos` VALUES ('145', '14', '020707', 'PUEBLO LIBRE');
INSERT INTO `distritos` VALUES ('146', '14', '020708', 'SANTA CRUZ');
INSERT INTO `distritos` VALUES ('147', '14', '020709', 'YURACMARCA');
INSERT INTO `distritos` VALUES ('148', '14', '020710', 'SANTO TORIBIO');
INSERT INTO `distritos` VALUES ('149', '15', '020801', 'HUARI');
INSERT INTO `distritos` VALUES ('150', '15', '020802', 'CAJAY');
INSERT INTO `distritos` VALUES ('151', '15', '020803', 'CHAVIN DE HUANTAR');
INSERT INTO `distritos` VALUES ('152', '15', '020804', 'HUACACHI');
INSERT INTO `distritos` VALUES ('153', '15', '020805', 'HUACHIS');
INSERT INTO `distritos` VALUES ('154', '15', '020806', 'HUACCHIS');
INSERT INTO `distritos` VALUES ('155', '15', '020807', 'HUANTAR');
INSERT INTO `distritos` VALUES ('156', '15', '020808', 'MASIN');
INSERT INTO `distritos` VALUES ('157', '15', '020809', 'PAUCAS');
INSERT INTO `distritos` VALUES ('158', '15', '020810', 'PONTO');
INSERT INTO `distritos` VALUES ('159', '15', '020811', 'RAHUAPAMPA');
INSERT INTO `distritos` VALUES ('160', '15', '020812', 'RAPAYAN');
INSERT INTO `distritos` VALUES ('161', '15', '020813', 'SAN MARCOS');
INSERT INTO `distritos` VALUES ('162', '15', '020814', 'SAN PEDRO DE CHANA');
INSERT INTO `distritos` VALUES ('163', '15', '020815', 'UCO');
INSERT INTO `distritos` VALUES ('164', '15', '020816', 'ANRA');
INSERT INTO `distritos` VALUES ('165', '16', '020901', 'PISCOBAMBA');
INSERT INTO `distritos` VALUES ('166', '16', '020902', 'CASCA');
INSERT INTO `distritos` VALUES ('167', '16', '020903', 'LUCMA');
INSERT INTO `distritos` VALUES ('168', '16', '020904', 'FIDEL OLIVAS ESCUDERO');
INSERT INTO `distritos` VALUES ('169', '16', '020905', 'LLAMA');
INSERT INTO `distritos` VALUES ('170', '16', '020906', 'LLUMPA');
INSERT INTO `distritos` VALUES ('171', '16', '020907', 'MUSGA');
INSERT INTO `distritos` VALUES ('172', '16', '020908', 'ELEAZAR GUZMAN BARRON');
INSERT INTO `distritos` VALUES ('173', '17', '021001', 'CABANA');
INSERT INTO `distritos` VALUES ('174', '17', '021002', 'BOLOGNESI');
INSERT INTO `distritos` VALUES ('175', '17', '021003', 'CONCHUCOS');
INSERT INTO `distritos` VALUES ('176', '17', '021004', 'HUACASCHUQUE');
INSERT INTO `distritos` VALUES ('177', '17', '021005', 'HUANDOVAL');
INSERT INTO `distritos` VALUES ('178', '17', '021006', 'LACABAMBA');
INSERT INTO `distritos` VALUES ('179', '17', '021007', 'LLAPO');
INSERT INTO `distritos` VALUES ('180', '17', '021008', 'PALLASCA');
INSERT INTO `distritos` VALUES ('181', '17', '021009', 'PAMPAS');
INSERT INTO `distritos` VALUES ('182', '17', '021010', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('183', '17', '021011', 'TAUCA');
INSERT INTO `distritos` VALUES ('184', '18', '021101', 'POMABAMBA');
INSERT INTO `distritos` VALUES ('185', '18', '021102', 'HUAYLLAN');
INSERT INTO `distritos` VALUES ('186', '18', '021103', 'PAROBAMBA');
INSERT INTO `distritos` VALUES ('187', '18', '021104', 'QUINUABAMBA');
INSERT INTO `distritos` VALUES ('188', '19', '021201', 'RECUAY');
INSERT INTO `distritos` VALUES ('189', '19', '021202', 'COTAPARACO');
INSERT INTO `distritos` VALUES ('190', '19', '021203', 'HUAYLLAPAMPA');
INSERT INTO `distritos` VALUES ('191', '19', '021204', 'MARCA');
INSERT INTO `distritos` VALUES ('192', '19', '021205', 'PAMPAS CHICO');
INSERT INTO `distritos` VALUES ('193', '19', '021206', 'PARARIN');
INSERT INTO `distritos` VALUES ('194', '19', '021207', 'TAPACOCHA');
INSERT INTO `distritos` VALUES ('195', '19', '021208', 'TICAPAMPA');
INSERT INTO `distritos` VALUES ('196', '19', '021209', 'LLACLLIN');
INSERT INTO `distritos` VALUES ('197', '19', '021210', 'CATAC');
INSERT INTO `distritos` VALUES ('198', '20', '021301', 'CHIMBOTE');
INSERT INTO `distritos` VALUES ('199', '20', '021302', 'CACERES DEL PERU');
INSERT INTO `distritos` VALUES ('200', '20', '021303', 'MACATE');
INSERT INTO `distritos` VALUES ('201', '20', '021304', 'MORO');
INSERT INTO `distritos` VALUES ('202', '20', '021305', 'NEPENA');
INSERT INTO `distritos` VALUES ('203', '20', '021306', 'SAMANCO');
INSERT INTO `distritos` VALUES ('204', '20', '021307', 'SANTA');
INSERT INTO `distritos` VALUES ('205', '20', '021308', 'COISHCO');
INSERT INTO `distritos` VALUES ('206', '20', '021309', 'NUEVO CHIMBOTE');
INSERT INTO `distritos` VALUES ('207', '21', '021401', 'SIHUAS');
INSERT INTO `distritos` VALUES ('208', '21', '021402', 'ALFONSO UGARTE');
INSERT INTO `distritos` VALUES ('209', '21', '021403', 'CHINGALPO');
INSERT INTO `distritos` VALUES ('210', '21', '021404', 'HUAYLLABAMBA');
INSERT INTO `distritos` VALUES ('211', '21', '021405', 'QUICHES');
INSERT INTO `distritos` VALUES ('212', '21', '021406', 'SICSIBAMBA');
INSERT INTO `distritos` VALUES ('213', '21', '021407', 'ACOBAMBA');
INSERT INTO `distritos` VALUES ('214', '21', '021408', 'CASHAPAMPA');
INSERT INTO `distritos` VALUES ('215', '21', '021409', 'RAGASH');
INSERT INTO `distritos` VALUES ('216', '21', '021410', 'SAN JUAN');
INSERT INTO `distritos` VALUES ('217', '22', '021501', 'YUNGAY');
INSERT INTO `distritos` VALUES ('218', '22', '021502', 'CASCAPARA');
INSERT INTO `distritos` VALUES ('219', '22', '021503', 'MANCOS');
INSERT INTO `distritos` VALUES ('220', '22', '021504', 'MATACOTO');
INSERT INTO `distritos` VALUES ('221', '22', '021505', 'QUILLO');
INSERT INTO `distritos` VALUES ('222', '22', '021506', 'RANRAHIRCA');
INSERT INTO `distritos` VALUES ('223', '22', '021507', 'SHUPLUY');
INSERT INTO `distritos` VALUES ('224', '22', '021508', 'YANAMA');
INSERT INTO `distritos` VALUES ('225', '23', '021601', 'LLAMELLIN');
INSERT INTO `distritos` VALUES ('226', '23', '021602', 'ACZO');
INSERT INTO `distritos` VALUES ('227', '23', '021603', 'CHACCHO');
INSERT INTO `distritos` VALUES ('228', '23', '021604', 'CHINGAS');
INSERT INTO `distritos` VALUES ('229', '23', '021605', 'MIRGAS');
INSERT INTO `distritos` VALUES ('230', '23', '021606', 'SAN JUAN DE RONTOY');
INSERT INTO `distritos` VALUES ('231', '24', '021701', 'SAN LUIS');
INSERT INTO `distritos` VALUES ('232', '24', '021702', 'YAUYA');
INSERT INTO `distritos` VALUES ('233', '24', '021703', 'SAN NICOLAS');
INSERT INTO `distritos` VALUES ('234', '25', '021801', 'CHACAS');
INSERT INTO `distritos` VALUES ('235', '25', '021802', 'ACOCHACA');
INSERT INTO `distritos` VALUES ('236', '26', '021901', 'HUARMEY');
INSERT INTO `distritos` VALUES ('237', '26', '021902', 'COCHAPETI');
INSERT INTO `distritos` VALUES ('238', '26', '021903', 'HUAYAN');
INSERT INTO `distritos` VALUES ('239', '26', '021904', 'MALVAS');
INSERT INTO `distritos` VALUES ('240', '26', '021905', 'CULEBRAS');
INSERT INTO `distritos` VALUES ('241', '27', '022001', 'ACAS');
INSERT INTO `distritos` VALUES ('242', '27', '022002', 'CAJAMARQUILLA');
INSERT INTO `distritos` VALUES ('243', '27', '022003', 'CARHUAPAMPA');
INSERT INTO `distritos` VALUES ('244', '27', '022004', 'COCHAS');
INSERT INTO `distritos` VALUES ('245', '27', '022005', 'CONGAS');
INSERT INTO `distritos` VALUES ('246', '27', '022006', 'LLIPA');
INSERT INTO `distritos` VALUES ('247', '27', '022007', 'OCROS');
INSERT INTO `distritos` VALUES ('248', '27', '022008', 'SAN CRISTOBAL DE RAJAN');
INSERT INTO `distritos` VALUES ('249', '27', '022009', 'SAN PEDRO');
INSERT INTO `distritos` VALUES ('250', '27', '022010', 'SANTIAGO DE CHILCAS');
INSERT INTO `distritos` VALUES ('251', '28', '030101', 'ABANCAY');
INSERT INTO `distritos` VALUES ('252', '28', '030102', 'CIRCA');
INSERT INTO `distritos` VALUES ('253', '28', '030103', 'CURAHUASI');
INSERT INTO `distritos` VALUES ('254', '28', '030104', 'CHACOCHE');
INSERT INTO `distritos` VALUES ('255', '28', '030105', 'HUANIPACA');
INSERT INTO `distritos` VALUES ('256', '28', '030106', 'LAMBRAMA');
INSERT INTO `distritos` VALUES ('257', '28', '030107', 'PICHIRHUA');
INSERT INTO `distritos` VALUES ('258', '28', '030108', 'SAN PEDRO DE CACHORA');
INSERT INTO `distritos` VALUES ('259', '28', '030109', 'TAMBURCO');
INSERT INTO `distritos` VALUES ('260', '29', '030201', 'CHALHUANCA');
INSERT INTO `distritos` VALUES ('261', '29', '030202', 'CAPAYA');
INSERT INTO `distritos` VALUES ('262', '29', '030203', 'CARAYBAMBA');
INSERT INTO `distritos` VALUES ('263', '29', '030204', 'COLCABAMBA');
INSERT INTO `distritos` VALUES ('264', '29', '030205', 'COTARUSE');
INSERT INTO `distritos` VALUES ('265', '29', '030206', 'CHAPIMARCA');
INSERT INTO `distritos` VALUES ('266', '29', '030207', 'IHUAYLLO');
INSERT INTO `distritos` VALUES ('267', '29', '030208', 'LUCRE');
INSERT INTO `distritos` VALUES ('268', '29', '030209', 'POCOHUANCA');
INSERT INTO `distritos` VALUES ('269', '29', '030210', 'SANAICA');
INSERT INTO `distritos` VALUES ('270', '29', '030211', 'SORAYA');
INSERT INTO `distritos` VALUES ('271', '29', '030212', 'TAPAIRIHUA');
INSERT INTO `distritos` VALUES ('272', '29', '030213', 'TINTAY');
INSERT INTO `distritos` VALUES ('273', '29', '030214', 'TORAYA');
INSERT INTO `distritos` VALUES ('274', '29', '030215', 'YANACA');
INSERT INTO `distritos` VALUES ('275', '29', '030216', 'SAN JUAN DE CHACNA');
INSERT INTO `distritos` VALUES ('276', '29', '030217', 'JUSTO APU SAHUARAURA');
INSERT INTO `distritos` VALUES ('277', '30', '030301', 'ANDAHUAYLAS');
INSERT INTO `distritos` VALUES ('278', '30', '030302', 'ANDARAPA');
INSERT INTO `distritos` VALUES ('279', '30', '030303', 'CHIARA');
INSERT INTO `distritos` VALUES ('280', '30', '030304', 'HUANCARAMA');
INSERT INTO `distritos` VALUES ('281', '30', '030305', 'HUANCARAY');
INSERT INTO `distritos` VALUES ('282', '30', '030306', 'KISHUARA');
INSERT INTO `distritos` VALUES ('283', '30', '030307', 'PACOBAMBA');
INSERT INTO `distritos` VALUES ('284', '30', '030308', 'PAMPACHIRI');
INSERT INTO `distritos` VALUES ('285', '30', '030309', 'SAN ANTONIO DE CACHI');
INSERT INTO `distritos` VALUES ('286', '30', '030310', 'SAN JERONIMO');
INSERT INTO `distritos` VALUES ('287', '30', '030311', 'TALAVERA');
INSERT INTO `distritos` VALUES ('288', '30', '030312', 'TURPO');
INSERT INTO `distritos` VALUES ('289', '30', '030313', 'PACUCHA');
INSERT INTO `distritos` VALUES ('290', '30', '030314', 'POMACOCHA');
INSERT INTO `distritos` VALUES ('291', '30', '030315', 'STA MARIA DE CHICMO');
INSERT INTO `distritos` VALUES ('292', '30', '030316', 'TUMAY HUARACA');
INSERT INTO `distritos` VALUES ('293', '30', '030317', 'HUAYANA');
INSERT INTO `distritos` VALUES ('294', '30', '030318', 'SAN MIGUEL DE CHACCRAMPA');
INSERT INTO `distritos` VALUES ('295', '30', '030319', 'KAQUIABAMBA');
INSERT INTO `distritos` VALUES ('296', '31', '030401', 'ANTABAMBA');
INSERT INTO `distritos` VALUES ('297', '31', '030402', 'EL ORO');
INSERT INTO `distritos` VALUES ('298', '31', '030403', 'HUAQUIRCA');
INSERT INTO `distritos` VALUES ('299', '31', '030404', 'JUAN ESPINOZA MEDRANO');
INSERT INTO `distritos` VALUES ('300', '31', '030405', 'OROPESA');
INSERT INTO `distritos` VALUES ('301', '31', '030406', 'PACHACONAS');
INSERT INTO `distritos` VALUES ('302', '31', '030407', 'SABAINO');
INSERT INTO `distritos` VALUES ('303', '32', '030501', 'TAMBOBAMBA');
INSERT INTO `distritos` VALUES ('304', '32', '030502', 'COYLLURQUI');
INSERT INTO `distritos` VALUES ('305', '32', '030503', 'COTABAMBAS');
INSERT INTO `distritos` VALUES ('306', '32', '030504', 'HAQUIRA');
INSERT INTO `distritos` VALUES ('307', '32', '030505', 'MARA');
INSERT INTO `distritos` VALUES ('308', '32', '030506', 'CHALLHUAHUACHO');
INSERT INTO `distritos` VALUES ('309', '33', '030601', 'CHUQUIBAMBILLA');
INSERT INTO `distritos` VALUES ('310', '33', '030602', 'CURPAHUASI');
INSERT INTO `distritos` VALUES ('311', '33', '030603', 'HUAILLATI');
INSERT INTO `distritos` VALUES ('312', '33', '030604', 'MAMARA');
INSERT INTO `distritos` VALUES ('313', '33', '030605', 'MARISCAL GAMARRA');
INSERT INTO `distritos` VALUES ('314', '33', '030606', 'MICAELA BASTIDAS');
INSERT INTO `distritos` VALUES ('315', '33', '030607', 'PROGRESO');
INSERT INTO `distritos` VALUES ('316', '33', '030608', 'PATAYPAMPA');
INSERT INTO `distritos` VALUES ('317', '33', '030609', 'SAN ANTONIO');
INSERT INTO `distritos` VALUES ('318', '33', '030610', 'TURPAY');
INSERT INTO `distritos` VALUES ('319', '33', '030611', 'VILCABAMBA');
INSERT INTO `distritos` VALUES ('320', '33', '030612', 'VIRUNDO');
INSERT INTO `distritos` VALUES ('321', '33', '030613', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('322', '33', '030614', 'CURASCO');
INSERT INTO `distritos` VALUES ('323', '34', '030701', 'CHINCHEROS');
INSERT INTO `distritos` VALUES ('324', '34', '030702', 'ONGOY');
INSERT INTO `distritos` VALUES ('325', '34', '030703', 'OCOBAMBA');
INSERT INTO `distritos` VALUES ('326', '34', '030704', 'COCHARCAS');
INSERT INTO `distritos` VALUES ('327', '34', '030705', 'ANCO HUALLO');
INSERT INTO `distritos` VALUES ('328', '34', '030706', 'HUACCANA');
INSERT INTO `distritos` VALUES ('329', '34', '030707', 'URANMARCA');
INSERT INTO `distritos` VALUES ('330', '34', '030708', 'RANRACANCHA');
INSERT INTO `distritos` VALUES ('331', '35', '040101', 'AREQUIPA');
INSERT INTO `distritos` VALUES ('332', '35', '040102', 'CAYMA');
INSERT INTO `distritos` VALUES ('333', '35', '040103', 'CERRO COLORADO');
INSERT INTO `distritos` VALUES ('334', '35', '040104', 'CHARACATO');
INSERT INTO `distritos` VALUES ('335', '35', '040105', 'CHIGUATA');
INSERT INTO `distritos` VALUES ('336', '35', '040106', 'LA JOYA');
INSERT INTO `distritos` VALUES ('337', '35', '040107', 'MIRAFLORES');
INSERT INTO `distritos` VALUES ('338', '35', '040108', 'MOLLEBAYA');
INSERT INTO `distritos` VALUES ('339', '35', '040109', 'PAUCARPATA');
INSERT INTO `distritos` VALUES ('340', '35', '040110', 'POCSI');
INSERT INTO `distritos` VALUES ('341', '35', '040111', 'POLOBAYA');
INSERT INTO `distritos` VALUES ('342', '35', '040112', 'QUEQUENA');
INSERT INTO `distritos` VALUES ('343', '35', '040113', 'SABANDIA');
INSERT INTO `distritos` VALUES ('344', '35', '040114', 'SACHACA');
INSERT INTO `distritos` VALUES ('345', '35', '040115', 'SAN JUAN DE SIGUAS');
INSERT INTO `distritos` VALUES ('346', '35', '040116', 'SAN JUAN DE TARUCANI');
INSERT INTO `distritos` VALUES ('347', '35', '040117', 'SANTA ISABEL DE SIGUAS');
INSERT INTO `distritos` VALUES ('348', '35', '040118', 'STA RITA DE SIGUAS');
INSERT INTO `distritos` VALUES ('349', '35', '040119', 'SOCABAYA');
INSERT INTO `distritos` VALUES ('350', '35', '040120', 'TIABAYA');
INSERT INTO `distritos` VALUES ('351', '35', '040121', 'UCHUMAYO');
INSERT INTO `distritos` VALUES ('352', '35', '040122', 'VITOR');
INSERT INTO `distritos` VALUES ('353', '35', '040123', 'YANAHUARA');
INSERT INTO `distritos` VALUES ('354', '35', '040124', 'YARABAMBA');
INSERT INTO `distritos` VALUES ('355', '35', '040125', 'YURA');
INSERT INTO `distritos` VALUES ('356', '35', '040126', 'MARIANO MELGAR');
INSERT INTO `distritos` VALUES ('357', '35', '040127', 'JACOBO HUNTER');
INSERT INTO `distritos` VALUES ('358', '35', '040128', 'ALTO SELVA ALEGRE');
INSERT INTO `distritos` VALUES ('359', '35', '040129', 'JOSE LUIS BUSTAMANTE Y RIVERO');
INSERT INTO `distritos` VALUES ('360', '36', '040201', 'CHIVAY');
INSERT INTO `distritos` VALUES ('361', '36', '040202', 'ACHOMA');
INSERT INTO `distritos` VALUES ('362', '36', '040203', 'CABANACONDE');
INSERT INTO `distritos` VALUES ('363', '36', '040204', 'CAYLLOMA');
INSERT INTO `distritos` VALUES ('364', '36', '040205', 'CALLALLI');
INSERT INTO `distritos` VALUES ('365', '36', '040206', 'COPORAQUE');
INSERT INTO `distritos` VALUES ('366', '36', '040207', 'HUAMBO');
INSERT INTO `distritos` VALUES ('367', '36', '040208', 'HUANCA');
INSERT INTO `distritos` VALUES ('368', '36', '040209', 'ICHUPAMPA');
INSERT INTO `distritos` VALUES ('369', '36', '040210', 'LARI');
INSERT INTO `distritos` VALUES ('370', '36', '040211', 'LLUTA');
INSERT INTO `distritos` VALUES ('371', '36', '040212', 'MACA');
INSERT INTO `distritos` VALUES ('372', '36', '040213', 'MADRIGAL');
INSERT INTO `distritos` VALUES ('373', '36', '040214', 'SAN ANTONIO DE CHUCA');
INSERT INTO `distritos` VALUES ('374', '36', '040215', 'SIBAYO');
INSERT INTO `distritos` VALUES ('375', '36', '040216', 'TAPAY');
INSERT INTO `distritos` VALUES ('376', '36', '040217', 'TISCO');
INSERT INTO `distritos` VALUES ('377', '36', '040218', 'TUTI');
INSERT INTO `distritos` VALUES ('378', '36', '040219', 'YANQUE');
INSERT INTO `distritos` VALUES ('379', '36', '040220', 'MAJES');
INSERT INTO `distritos` VALUES ('380', '37', '040301', 'CAMANA');
INSERT INTO `distritos` VALUES ('381', '37', '040302', 'JOSE MARIA QUIMPER');
INSERT INTO `distritos` VALUES ('382', '37', '040303', 'MARIANO N VALCARCEL');
INSERT INTO `distritos` VALUES ('383', '37', '040304', 'MARISCAL CACERES');
INSERT INTO `distritos` VALUES ('384', '37', '040305', 'NICOLAS DE PIEROLA');
INSERT INTO `distritos` VALUES ('385', '37', '040306', 'OCONA');
INSERT INTO `distritos` VALUES ('386', '37', '040307', 'QUILCA');
INSERT INTO `distritos` VALUES ('387', '37', '040308', 'SAMUEL PASTOR');
INSERT INTO `distritos` VALUES ('388', '38', '040401', 'CARAVELI');
INSERT INTO `distritos` VALUES ('389', '38', '040402', 'ACARI');
INSERT INTO `distritos` VALUES ('390', '38', '040403', 'ATICO');
INSERT INTO `distritos` VALUES ('391', '38', '040404', 'ATIQUIPA');
INSERT INTO `distritos` VALUES ('392', '38', '040405', 'BELLA UNION');
INSERT INTO `distritos` VALUES ('393', '38', '040406', 'CAHUACHO');
INSERT INTO `distritos` VALUES ('394', '38', '040407', 'CHALA');
INSERT INTO `distritos` VALUES ('395', '38', '040408', 'CHAPARRA');
INSERT INTO `distritos` VALUES ('396', '38', '040409', 'HUANUHUANU');
INSERT INTO `distritos` VALUES ('397', '38', '040410', 'JAQUI');
INSERT INTO `distritos` VALUES ('398', '38', '040411', 'LOMAS');
INSERT INTO `distritos` VALUES ('399', '38', '040412', 'QUICACHA');
INSERT INTO `distritos` VALUES ('400', '38', '040413', 'YAUCA');
INSERT INTO `distritos` VALUES ('401', '39', '040501', 'APLAO');
INSERT INTO `distritos` VALUES ('402', '39', '040502', 'ANDAGUA');
INSERT INTO `distritos` VALUES ('403', '39', '040503', 'AYO');
INSERT INTO `distritos` VALUES ('404', '39', '040504', 'CHACHAS');
INSERT INTO `distritos` VALUES ('405', '39', '040505', 'CHILCAYMARCA');
INSERT INTO `distritos` VALUES ('406', '39', '040506', 'CHOCO');
INSERT INTO `distritos` VALUES ('407', '39', '040507', 'HUANCARQUI');
INSERT INTO `distritos` VALUES ('408', '39', '040508', 'MACHAGUAY');
INSERT INTO `distritos` VALUES ('409', '39', '040509', 'ORCOPAMPA');
INSERT INTO `distritos` VALUES ('410', '39', '040510', 'PAMPACOLCA');
INSERT INTO `distritos` VALUES ('411', '39', '040511', 'TIPAN');
INSERT INTO `distritos` VALUES ('412', '39', '040512', 'URACA');
INSERT INTO `distritos` VALUES ('413', '39', '040513', 'UNON');
INSERT INTO `distritos` VALUES ('414', '39', '040514', 'VIRACO');
INSERT INTO `distritos` VALUES ('415', '40', '040601', 'CHUQUIBAMBA');
INSERT INTO `distritos` VALUES ('416', '40', '040602', 'ANDARAY');
INSERT INTO `distritos` VALUES ('417', '40', '040603', 'CAYARANI');
INSERT INTO `distritos` VALUES ('418', '40', '040604', 'CHICHAS');
INSERT INTO `distritos` VALUES ('419', '40', '040605', 'IRAY');
INSERT INTO `distritos` VALUES ('420', '40', '040606', 'SALAMANCA');
INSERT INTO `distritos` VALUES ('421', '40', '040607', 'YANAQUIHUA');
INSERT INTO `distritos` VALUES ('422', '40', '040608', 'RIO GRANDE');
INSERT INTO `distritos` VALUES ('423', '41', '040701', 'MOLLENDO');
INSERT INTO `distritos` VALUES ('424', '41', '040702', 'COCACHACRA');
INSERT INTO `distritos` VALUES ('425', '41', '040703', 'DEAN VALDIVIA');
INSERT INTO `distritos` VALUES ('426', '41', '040704', 'ISLAY');
INSERT INTO `distritos` VALUES ('427', '41', '040705', 'MEJIA');
INSERT INTO `distritos` VALUES ('428', '41', '040706', 'PUNTA DE BOMBON');
INSERT INTO `distritos` VALUES ('429', '42', '040801', 'COTAHUASI');
INSERT INTO `distritos` VALUES ('430', '42', '040802', 'ALCA');
INSERT INTO `distritos` VALUES ('431', '42', '040803', 'CHARCANA');
INSERT INTO `distritos` VALUES ('432', '42', '040804', 'HUAYNACOTAS');
INSERT INTO `distritos` VALUES ('433', '42', '040805', 'PAMPAMARCA');
INSERT INTO `distritos` VALUES ('434', '42', '040806', 'PUYCA');
INSERT INTO `distritos` VALUES ('435', '42', '040807', 'QUECHUALLA');
INSERT INTO `distritos` VALUES ('436', '42', '040808', 'SAYLA');
INSERT INTO `distritos` VALUES ('437', '42', '040809', 'TAURIA');
INSERT INTO `distritos` VALUES ('438', '42', '040810', 'TOMEPAMPA');
INSERT INTO `distritos` VALUES ('439', '42', '040811', 'TORO');
INSERT INTO `distritos` VALUES ('440', '43', '050101', 'AYACUCHO');
INSERT INTO `distritos` VALUES ('441', '43', '050102', 'ACOS VINCHOS');
INSERT INTO `distritos` VALUES ('442', '43', '050103', 'CARMEN ALTO');
INSERT INTO `distritos` VALUES ('443', '43', '050104', 'CHIARA');
INSERT INTO `distritos` VALUES ('444', '43', '050105', 'QUINUA');
INSERT INTO `distritos` VALUES ('445', '43', '050106', 'SAN JOSE DE TICLLAS');
INSERT INTO `distritos` VALUES ('446', '43', '050107', 'SAN JUAN BAUTISTA');
INSERT INTO `distritos` VALUES ('447', '43', '050108', 'SANTIAGO DE PISCHA');
INSERT INTO `distritos` VALUES ('448', '43', '050109', 'VINCHOS');
INSERT INTO `distritos` VALUES ('449', '43', '050110', 'TAMBILLO');
INSERT INTO `distritos` VALUES ('450', '43', '050111', 'ACOCRO');
INSERT INTO `distritos` VALUES ('451', '43', '050112', 'SOCOS');
INSERT INTO `distritos` VALUES ('452', '43', '050113', 'OCROS');
INSERT INTO `distritos` VALUES ('453', '43', '050114', 'PACAYCASA');
INSERT INTO `distritos` VALUES ('454', '43', '050115', 'JESUS NAZARENO');
INSERT INTO `distritos` VALUES ('455', '44', '050201', 'CANGALLO');
INSERT INTO `distritos` VALUES ('456', '44', '050204', 'CHUSCHI');
INSERT INTO `distritos` VALUES ('457', '44', '050206', 'LOS MOROCHUCOS');
INSERT INTO `distritos` VALUES ('458', '44', '050207', 'PARAS');
INSERT INTO `distritos` VALUES ('459', '44', '050208', 'TOTOS');
INSERT INTO `distritos` VALUES ('460', '44', '050211', 'MARIA PARADO DE BELLIDO');
INSERT INTO `distritos` VALUES ('461', '45', '050301', 'HUANTA');
INSERT INTO `distritos` VALUES ('462', '45', '050302', 'AYAHUANCO');
INSERT INTO `distritos` VALUES ('463', '45', '050303', 'HUAMANGUILLA');
INSERT INTO `distritos` VALUES ('464', '45', '050304', 'IGUAIN');
INSERT INTO `distritos` VALUES ('465', '45', '050305', 'LURICOCHA');
INSERT INTO `distritos` VALUES ('466', '45', '050307', 'SANTILLANA');
INSERT INTO `distritos` VALUES ('467', '45', '050308', 'SIVIA');
INSERT INTO `distritos` VALUES ('468', '45', '050309', 'LLOCHEGUA');
INSERT INTO `distritos` VALUES ('469', '46', '050401', 'SAN MIGUEL');
INSERT INTO `distritos` VALUES ('470', '46', '050402', 'ANCO');
INSERT INTO `distritos` VALUES ('471', '46', '050403', 'AYNA');
INSERT INTO `distritos` VALUES ('472', '46', '050404', 'CHILCAS');
INSERT INTO `distritos` VALUES ('473', '46', '050405', 'CHUNGUI');
INSERT INTO `distritos` VALUES ('474', '46', '050406', 'TAMBO');
INSERT INTO `distritos` VALUES ('475', '46', '050407', 'LUIS CARRANZA');
INSERT INTO `distritos` VALUES ('476', '46', '050408', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('477', '47', '050501', 'PUQUIO');
INSERT INTO `distritos` VALUES ('478', '47', '050502', 'AUCARA');
INSERT INTO `distritos` VALUES ('479', '47', '050503', 'CABANA');
INSERT INTO `distritos` VALUES ('480', '47', '050504', 'CARMEN SALCEDO');
INSERT INTO `distritos` VALUES ('481', '47', '050506', 'CHAVINA');
INSERT INTO `distritos` VALUES ('482', '47', '050508', 'CHIPAO');
INSERT INTO `distritos` VALUES ('483', '47', '050510', 'HUAC-HUAS');
INSERT INTO `distritos` VALUES ('484', '47', '050511', 'LARAMATE');
INSERT INTO `distritos` VALUES ('485', '47', '050512', 'LEONCIO PRADO');
INSERT INTO `distritos` VALUES ('486', '47', '050513', 'LUCANAS');
INSERT INTO `distritos` VALUES ('487', '47', '050514', 'LLAUTA');
INSERT INTO `distritos` VALUES ('488', '47', '050516', 'OCANA');
INSERT INTO `distritos` VALUES ('489', '47', '050517', 'OTOCA');
INSERT INTO `distritos` VALUES ('490', '47', '050520', 'SANCOS');
INSERT INTO `distritos` VALUES ('491', '47', '050521', 'SAN JUAN');
INSERT INTO `distritos` VALUES ('492', '47', '050522', 'SAN PEDRO');
INSERT INTO `distritos` VALUES ('493', '47', '050524', 'STA ANA DE HUAYCAHUACHO');
INSERT INTO `distritos` VALUES ('494', '47', '050525', 'SANTA LUCIA');
INSERT INTO `distritos` VALUES ('495', '47', '050529', 'SAISA');
INSERT INTO `distritos` VALUES ('496', '47', '050531', 'SAN PEDRO DE PALCO');
INSERT INTO `distritos` VALUES ('497', '47', '050532', 'SAN CRISTOBAL');
INSERT INTO `distritos` VALUES ('498', '48', '050601', 'CORACORA');
INSERT INTO `distritos` VALUES ('499', '48', '050604', 'CORONEL CASTANEDA');
INSERT INTO `distritos` VALUES ('500', '48', '050605', 'CHUMPI');
INSERT INTO `distritos` VALUES ('501', '48', '050608', 'PACAPAUSA');
INSERT INTO `distritos` VALUES ('502', '48', '050611', 'PULLO');
INSERT INTO `distritos` VALUES ('503', '48', '050612', 'PUYUSCA');
INSERT INTO `distritos` VALUES ('504', '48', '050615', 'SAN FCO DE RAVACAYCO');
INSERT INTO `distritos` VALUES ('505', '48', '050616', 'UPAHUACHO');
INSERT INTO `distritos` VALUES ('506', '49', '050701', 'HUANCAPI');
INSERT INTO `distritos` VALUES ('507', '49', '050702', 'ALCAMENCA');
INSERT INTO `distritos` VALUES ('508', '49', '050703', 'APONGO');
INSERT INTO `distritos` VALUES ('509', '49', '050704', 'CANARIA');
INSERT INTO `distritos` VALUES ('510', '49', '050706', 'CAYARA');
INSERT INTO `distritos` VALUES ('511', '49', '050707', 'COLCA');
INSERT INTO `distritos` VALUES ('512', '49', '050708', 'HUAYA');
INSERT INTO `distritos` VALUES ('513', '49', '050709', 'HUAMANQUIQUIA');
INSERT INTO `distritos` VALUES ('514', '49', '050710', 'HUANCARAYLLA');
INSERT INTO `distritos` VALUES ('515', '49', '050713', 'SARHUA');
INSERT INTO `distritos` VALUES ('516', '49', '050714', 'VILCANCHOS');
INSERT INTO `distritos` VALUES ('517', '49', '050715', 'ASQUIPATA');
INSERT INTO `distritos` VALUES ('518', '50', '050801', 'SANCOS');
INSERT INTO `distritos` VALUES ('519', '50', '050802', 'SACSAMARCA');
INSERT INTO `distritos` VALUES ('520', '50', '050803', 'SANTIAGO DE LUCANAMARCA');
INSERT INTO `distritos` VALUES ('521', '50', '050804', 'CARAPO');
INSERT INTO `distritos` VALUES ('522', '51', '050901', 'VILCAS HUAMAN');
INSERT INTO `distritos` VALUES ('523', '51', '050902', 'VISCHONGO');
INSERT INTO `distritos` VALUES ('524', '51', '050903', 'ACCOMARCA');
INSERT INTO `distritos` VALUES ('525', '51', '050904', 'CARHUANCA');
INSERT INTO `distritos` VALUES ('526', '51', '050905', 'CONCEPCION');
INSERT INTO `distritos` VALUES ('527', '51', '050906', 'HUAMBALPA');
INSERT INTO `distritos` VALUES ('528', '51', '050907', 'SAURAMA');
INSERT INTO `distritos` VALUES ('529', '51', '050908', 'INDEPENDENCIA');
INSERT INTO `distritos` VALUES ('530', '52', '051001', 'PAUSA');
INSERT INTO `distritos` VALUES ('531', '52', '051002', 'COLTA');
INSERT INTO `distritos` VALUES ('532', '52', '051003', 'CORCULLA');
INSERT INTO `distritos` VALUES ('533', '52', '051004', 'LAMPA');
INSERT INTO `distritos` VALUES ('534', '52', '051005', 'MARCABAMBA');
INSERT INTO `distritos` VALUES ('535', '52', '051006', 'OYOLO');
INSERT INTO `distritos` VALUES ('536', '52', '051007', 'PARARCA');
INSERT INTO `distritos` VALUES ('537', '52', '051008', 'SAN JAVIER DE ALPABAMBA');
INSERT INTO `distritos` VALUES ('538', '52', '051009', 'SAN JOSE DE USHUA');
INSERT INTO `distritos` VALUES ('539', '52', '051010', 'SARA SARA');
INSERT INTO `distritos` VALUES ('540', '53', '051101', 'QUEROBAMBA');
INSERT INTO `distritos` VALUES ('541', '53', '051102', 'BELEN');
INSERT INTO `distritos` VALUES ('542', '53', '051103', 'CHALCOS');
INSERT INTO `distritos` VALUES ('543', '53', '051104', 'SAN SALVADOR DE QUIJE');
INSERT INTO `distritos` VALUES ('544', '53', '051105', 'PAICO');
INSERT INTO `distritos` VALUES ('545', '53', '051106', 'SANTIAGO DE PAUCARAY');
INSERT INTO `distritos` VALUES ('546', '53', '051107', 'SAN PEDRO DE LARCAY');
INSERT INTO `distritos` VALUES ('547', '53', '051108', 'SORAS');
INSERT INTO `distritos` VALUES ('548', '53', '051109', 'HUACANA');
INSERT INTO `distritos` VALUES ('549', '53', '051110', 'CHILCAYOC');
INSERT INTO `distritos` VALUES ('550', '53', '051111', 'MORCOLLA');
INSERT INTO `distritos` VALUES ('551', '54', '060101', 'CAJAMARCA');
INSERT INTO `distritos` VALUES ('552', '54', '060102', 'ASUNCION');
INSERT INTO `distritos` VALUES ('553', '54', '060103', 'COSPAN');
INSERT INTO `distritos` VALUES ('554', '54', '060104', 'CHETILLA');
INSERT INTO `distritos` VALUES ('555', '54', '060105', 'ENCANADA');
INSERT INTO `distritos` VALUES ('556', '54', '060106', 'JESUS');
INSERT INTO `distritos` VALUES ('557', '54', '060107', 'LOS BANOS DEL INCA');
INSERT INTO `distritos` VALUES ('558', '54', '060108', 'LLACANORA');
INSERT INTO `distritos` VALUES ('559', '54', '060109', 'MAGDALENA');
INSERT INTO `distritos` VALUES ('560', '54', '060110', 'MATARA');
INSERT INTO `distritos` VALUES ('561', '54', '060111', 'NAMORA');
INSERT INTO `distritos` VALUES ('562', '54', '060112', 'SAN JUAN');
INSERT INTO `distritos` VALUES ('563', '55', '060201', 'CAJABAMBA');
INSERT INTO `distritos` VALUES ('564', '55', '060202', 'CACHACHI');
INSERT INTO `distritos` VALUES ('565', '55', '060203', 'CONDEBAMBA');
INSERT INTO `distritos` VALUES ('566', '55', '060205', 'SITACOCHA');
INSERT INTO `distritos` VALUES ('567', '56', '060301', 'CELENDIN');
INSERT INTO `distritos` VALUES ('568', '56', '060302', 'CORTEGANA');
INSERT INTO `distritos` VALUES ('569', '56', '060303', 'CHUMUCH');
INSERT INTO `distritos` VALUES ('570', '56', '060304', 'HUASMIN');
INSERT INTO `distritos` VALUES ('571', '56', '060305', 'JORGE CHAVEZ');
INSERT INTO `distritos` VALUES ('572', '56', '060306', 'JOSE GALVEZ');
INSERT INTO `distritos` VALUES ('573', '56', '060307', 'MIGUEL IGLESIAS');
INSERT INTO `distritos` VALUES ('574', '56', '060308', 'OXAMARCA');
INSERT INTO `distritos` VALUES ('575', '56', '060309', 'SOROCHUCO');
INSERT INTO `distritos` VALUES ('576', '56', '060310', 'SUCRE');
INSERT INTO `distritos` VALUES ('577', '56', '060311', 'UTCO');
INSERT INTO `distritos` VALUES ('578', '56', '060312', 'LA LIBERTAD DE PALLAN');
INSERT INTO `distritos` VALUES ('579', '57', '060401', 'CONTUMAZA');
INSERT INTO `distritos` VALUES ('580', '57', '060403', 'CHILETE');
INSERT INTO `distritos` VALUES ('581', '57', '060404', 'GUZMANGO');
INSERT INTO `distritos` VALUES ('582', '57', '060405', 'SAN BENITO');
INSERT INTO `distritos` VALUES ('583', '57', '060406', 'CUPISNIQUE');
INSERT INTO `distritos` VALUES ('584', '57', '060407', 'TANTARICA');
INSERT INTO `distritos` VALUES ('585', '57', '060408', 'YONAN');
INSERT INTO `distritos` VALUES ('586', '57', '060409', 'STA CRUZ DE TOLEDO');
INSERT INTO `distritos` VALUES ('587', '58', '060501', 'CUTERVO');
INSERT INTO `distritos` VALUES ('588', '58', '060502', 'CALLAYUC');
INSERT INTO `distritos` VALUES ('589', '58', '060503', 'CUJILLO');
INSERT INTO `distritos` VALUES ('590', '58', '060504', 'CHOROS');
INSERT INTO `distritos` VALUES ('591', '58', '060505', 'LA RAMADA');
INSERT INTO `distritos` VALUES ('592', '58', '060506', 'PIMPINGOS');
INSERT INTO `distritos` VALUES ('593', '58', '060507', 'QUEROCOTILLO');
INSERT INTO `distritos` VALUES ('594', '58', '060508', 'SAN ANDRES DE CUTERVO');
INSERT INTO `distritos` VALUES ('595', '58', '060509', 'SAN JUAN DE CUTERVO');
INSERT INTO `distritos` VALUES ('596', '58', '060510', 'SAN LUIS DE LUCMA');
INSERT INTO `distritos` VALUES ('597', '58', '060511', 'SANTA CRUZ');
INSERT INTO `distritos` VALUES ('598', '58', '060512', 'SANTO DOMINGO DE LA CAPILLA');
INSERT INTO `distritos` VALUES ('599', '58', '060513', 'SANTO TOMAS');
INSERT INTO `distritos` VALUES ('600', '58', '060514', 'SOCOTA');
INSERT INTO `distritos` VALUES ('601', '58', '060515', 'TORIBIO CASANOVA');
INSERT INTO `distritos` VALUES ('602', '59', '060601', 'CHOTA');
INSERT INTO `distritos` VALUES ('603', '59', '060602', 'ANGUIA');
INSERT INTO `distritos` VALUES ('604', '59', '060603', 'COCHABAMBA');
INSERT INTO `distritos` VALUES ('605', '59', '060604', 'CONCHAN');
INSERT INTO `distritos` VALUES ('606', '59', '060605', 'CHADIN');
INSERT INTO `distritos` VALUES ('607', '59', '060606', 'CHIGUIRIP');
INSERT INTO `distritos` VALUES ('608', '59', '060607', 'CHIMBAN');
INSERT INTO `distritos` VALUES ('609', '59', '060608', 'HUAMBOS');
INSERT INTO `distritos` VALUES ('610', '59', '060609', 'LAJAS');
INSERT INTO `distritos` VALUES ('611', '59', '060610', 'LLAMA');
INSERT INTO `distritos` VALUES ('612', '59', '060611', 'MIRACOSTA');
INSERT INTO `distritos` VALUES ('613', '59', '060612', 'PACCHA');
INSERT INTO `distritos` VALUES ('614', '59', '060613', 'PION');
INSERT INTO `distritos` VALUES ('615', '59', '060614', 'QUEROCOTO');
INSERT INTO `distritos` VALUES ('616', '59', '060615', 'TACABAMBA');
INSERT INTO `distritos` VALUES ('617', '59', '060616', 'TOCMOCHE');
INSERT INTO `distritos` VALUES ('618', '59', '060617', 'SAN JUAN DE LICUPIS');
INSERT INTO `distritos` VALUES ('619', '59', '060618', 'CHOROPAMPA');
INSERT INTO `distritos` VALUES ('620', '59', '060619', 'CHALAMARCA');
INSERT INTO `distritos` VALUES ('621', '60', '060701', 'BAMBAMARCA');
INSERT INTO `distritos` VALUES ('622', '60', '060702', 'CHUGUR');
INSERT INTO `distritos` VALUES ('623', '60', '060703', 'HUALGAYOC');
INSERT INTO `distritos` VALUES ('624', '61', '060801', 'JAEN');
INSERT INTO `distritos` VALUES ('625', '61', '060802', 'BELLAVISTA');
INSERT INTO `distritos` VALUES ('626', '61', '060803', 'COLASAY');
INSERT INTO `distritos` VALUES ('627', '61', '060804', 'CHONTALI');
INSERT INTO `distritos` VALUES ('628', '61', '060805', 'POMAHUACA');
INSERT INTO `distritos` VALUES ('629', '61', '060806', 'PUCARA');
INSERT INTO `distritos` VALUES ('630', '61', '060807', 'SALLIQUE');
INSERT INTO `distritos` VALUES ('631', '61', '060808', 'SAN FELIPE');
INSERT INTO `distritos` VALUES ('632', '61', '060809', 'SAN JOSE DEL ALTO');
INSERT INTO `distritos` VALUES ('633', '61', '060810', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('634', '61', '060811', 'LAS PIRIAS');
INSERT INTO `distritos` VALUES ('635', '61', '060812', 'HUABAL');
INSERT INTO `distritos` VALUES ('636', '62', '060901', 'SANTA CRUZ');
INSERT INTO `distritos` VALUES ('637', '62', '060902', 'CATACHE');
INSERT INTO `distritos` VALUES ('638', '62', '060903', 'CHANCAIBANOS');
INSERT INTO `distritos` VALUES ('639', '62', '060904', 'LA ESPERANZA');
INSERT INTO `distritos` VALUES ('640', '62', '060905', 'NINABAMBA');
INSERT INTO `distritos` VALUES ('641', '62', '060906', 'PULAN');
INSERT INTO `distritos` VALUES ('642', '62', '060907', 'SEXI');
INSERT INTO `distritos` VALUES ('643', '62', '060908', 'UTICYACU');
INSERT INTO `distritos` VALUES ('644', '62', '060909', 'YAUYUCAN');
INSERT INTO `distritos` VALUES ('645', '62', '060910', 'ANDABAMBA');
INSERT INTO `distritos` VALUES ('646', '62', '060911', 'SAUCEPAMPA');
INSERT INTO `distritos` VALUES ('647', '63', '061001', 'SAN MIGUEL');
INSERT INTO `distritos` VALUES ('648', '63', '061002', 'CALQUIS');
INSERT INTO `distritos` VALUES ('649', '63', '061003', 'LA FLORIDA');
INSERT INTO `distritos` VALUES ('650', '63', '061004', 'LLAPA');
INSERT INTO `distritos` VALUES ('651', '63', '061005', 'NANCHOC');
INSERT INTO `distritos` VALUES ('652', '63', '061006', 'NIEPOS');
INSERT INTO `distritos` VALUES ('653', '63', '061007', 'SAN GREGORIO');
INSERT INTO `distritos` VALUES ('654', '63', '061008', 'SAN SILVESTRE DE COCHAN');
INSERT INTO `distritos` VALUES ('655', '63', '061009', 'EL PRADO');
INSERT INTO `distritos` VALUES ('656', '63', '061010', 'UNION AGUA BLANCA');
INSERT INTO `distritos` VALUES ('657', '63', '061011', 'TONGOD');
INSERT INTO `distritos` VALUES ('658', '63', '061012', 'CATILLUC');
INSERT INTO `distritos` VALUES ('659', '63', '061013', 'BOLIVAR');
INSERT INTO `distritos` VALUES ('660', '64', '061101', 'SAN IGNACIO');
INSERT INTO `distritos` VALUES ('661', '64', '061102', 'CHIRINOS');
INSERT INTO `distritos` VALUES ('662', '64', '061103', 'HUARANGO');
INSERT INTO `distritos` VALUES ('663', '64', '061104', 'NAMBALLE');
INSERT INTO `distritos` VALUES ('664', '64', '061105', 'LA COIPA');
INSERT INTO `distritos` VALUES ('665', '64', '061106', 'SAN JOSE DE LOURDES');
INSERT INTO `distritos` VALUES ('666', '64', '061107', 'TABACONAS');
INSERT INTO `distritos` VALUES ('667', '65', '061201', 'PEDRO GALVEZ');
INSERT INTO `distritos` VALUES ('668', '65', '061202', 'ICHOCAN');
INSERT INTO `distritos` VALUES ('669', '65', '061203', 'GREGORIO PITA');
INSERT INTO `distritos` VALUES ('670', '65', '061204', 'JOSE MANUEL QUIROZ');
INSERT INTO `distritos` VALUES ('671', '65', '061205', 'EDUARDO VILLANUEVA');
INSERT INTO `distritos` VALUES ('672', '65', '061206', 'JOSE SABOGAL');
INSERT INTO `distritos` VALUES ('673', '65', '061207', 'CHANCAY');
INSERT INTO `distritos` VALUES ('674', '66', '061301', 'SAN PABLO');
INSERT INTO `distritos` VALUES ('675', '66', '061302', 'SAN BERNARDINO');
INSERT INTO `distritos` VALUES ('676', '66', '061303', 'SAN LUIS');
INSERT INTO `distritos` VALUES ('677', '66', '061304', 'TUMBADEN');
INSERT INTO `distritos` VALUES ('678', '67', '070101', 'CUSCO');
INSERT INTO `distritos` VALUES ('679', '67', '070102', 'CCORCA');
INSERT INTO `distritos` VALUES ('680', '67', '070103', 'POROY');
INSERT INTO `distritos` VALUES ('681', '67', '070104', 'SAN JERONIMO');
INSERT INTO `distritos` VALUES ('682', '67', '070105', 'SAN SEBASTIAN');
INSERT INTO `distritos` VALUES ('683', '67', '070106', 'SANTIAGO');
INSERT INTO `distritos` VALUES ('684', '67', '070107', 'SAYLLA');
INSERT INTO `distritos` VALUES ('685', '67', '070108', 'WANCHAQ');
INSERT INTO `distritos` VALUES ('686', '68', '070201', 'ACOMAYO');
INSERT INTO `distritos` VALUES ('687', '68', '070202', 'ACOPIA');
INSERT INTO `distritos` VALUES ('688', '68', '070203', 'ACOS');
INSERT INTO `distritos` VALUES ('689', '68', '070204', 'POMACANCHI');
INSERT INTO `distritos` VALUES ('690', '68', '070205', 'RONDOCAN');
INSERT INTO `distritos` VALUES ('691', '68', '070206', 'SANGARARA');
INSERT INTO `distritos` VALUES ('692', '68', '070207', 'MOSOC LLACTA');
INSERT INTO `distritos` VALUES ('693', '69', '070301', 'ANTA');
INSERT INTO `distritos` VALUES ('694', '69', '070302', 'CHINCHAYPUJIO');
INSERT INTO `distritos` VALUES ('695', '69', '070303', 'HUAROCONDO');
INSERT INTO `distritos` VALUES ('696', '69', '070304', 'LIMATAMBO');
INSERT INTO `distritos` VALUES ('697', '69', '070305', 'MOLLEPATA');
INSERT INTO `distritos` VALUES ('698', '69', '070306', 'PUCYURA');
INSERT INTO `distritos` VALUES ('699', '69', '070307', 'ZURITE');
INSERT INTO `distritos` VALUES ('700', '69', '070308', 'CACHIMAYO');
INSERT INTO `distritos` VALUES ('701', '69', '070309', 'ANCAHUASI');
INSERT INTO `distritos` VALUES ('702', '70', '070401', 'CALCA');
INSERT INTO `distritos` VALUES ('703', '70', '070402', 'COYA');
INSERT INTO `distritos` VALUES ('704', '70', '070403', 'LAMAY');
INSERT INTO `distritos` VALUES ('705', '70', '070404', 'LARES');
INSERT INTO `distritos` VALUES ('706', '70', '070405', 'PISAC');
INSERT INTO `distritos` VALUES ('707', '70', '070406', 'SAN SALVADOR');
INSERT INTO `distritos` VALUES ('708', '70', '070407', 'TARAY');
INSERT INTO `distritos` VALUES ('709', '70', '070408', 'YANATILE');
INSERT INTO `distritos` VALUES ('710', '71', '070501', 'YANAOCA');
INSERT INTO `distritos` VALUES ('711', '71', '070502', 'CHECCA');
INSERT INTO `distritos` VALUES ('712', '71', '070503', 'KUNTURKANKI');
INSERT INTO `distritos` VALUES ('713', '71', '070504', 'LANGUI');
INSERT INTO `distritos` VALUES ('714', '71', '070505', 'LAYO');
INSERT INTO `distritos` VALUES ('715', '71', '070506', 'PAMPAMARCA');
INSERT INTO `distritos` VALUES ('716', '71', '070507', 'QUEHUE');
INSERT INTO `distritos` VALUES ('717', '71', '070508', 'TUPAC AMARU');
INSERT INTO `distritos` VALUES ('718', '72', '070601', 'SICUANI');
INSERT INTO `distritos` VALUES ('719', '72', '070602', 'COMBAPATA');
INSERT INTO `distritos` VALUES ('720', '72', '070603', 'CHECACUPE');
INSERT INTO `distritos` VALUES ('721', '72', '070604', 'MARANGANI');
INSERT INTO `distritos` VALUES ('722', '72', '070605', 'PITUMARCA');
INSERT INTO `distritos` VALUES ('723', '72', '070606', 'SAN PABLO');
INSERT INTO `distritos` VALUES ('724', '72', '070607', 'SAN PEDRO');
INSERT INTO `distritos` VALUES ('725', '72', '070608', 'TINTA');
INSERT INTO `distritos` VALUES ('726', '73', '070701', 'SANTO TOMAS');
INSERT INTO `distritos` VALUES ('727', '73', '070702', 'CAPACMARCA');
INSERT INTO `distritos` VALUES ('728', '73', '070703', 'COLQUEMARCA');
INSERT INTO `distritos` VALUES ('729', '73', '070704', 'CHAMACA');
INSERT INTO `distritos` VALUES ('730', '73', '070705', 'LIVITACA');
INSERT INTO `distritos` VALUES ('731', '73', '070706', 'LLUSCO');
INSERT INTO `distritos` VALUES ('732', '73', '070707', 'QUINOTA');
INSERT INTO `distritos` VALUES ('733', '73', '070708', 'VELILLE');
INSERT INTO `distritos` VALUES ('734', '74', '070801', 'ESPINAR');
INSERT INTO `distritos` VALUES ('735', '74', '070802', 'CONDOROMA');
INSERT INTO `distritos` VALUES ('736', '74', '070803', 'COPORAQUE');
INSERT INTO `distritos` VALUES ('737', '74', '070804', 'OCORURO');
INSERT INTO `distritos` VALUES ('738', '74', '070805', 'PALLPATA');
INSERT INTO `distritos` VALUES ('739', '74', '070806', 'PICHIGUA');
INSERT INTO `distritos` VALUES ('740', '74', '070807', 'SUYKUTAMBO');
INSERT INTO `distritos` VALUES ('741', '74', '070808', 'ALTO PICHIGUA');
INSERT INTO `distritos` VALUES ('742', '75', '070901', 'SANTA ANA');
INSERT INTO `distritos` VALUES ('743', '75', '070902', 'ECHARATE');
INSERT INTO `distritos` VALUES ('744', '75', '070903', 'HUAYOPATA');
INSERT INTO `distritos` VALUES ('745', '75', '070904', 'MARANURA');
INSERT INTO `distritos` VALUES ('746', '75', '070905', 'OCOBAMBA');
INSERT INTO `distritos` VALUES ('747', '75', '070906', 'SANTA TERESA');
INSERT INTO `distritos` VALUES ('748', '75', '070907', 'VILCABAMBA');
INSERT INTO `distritos` VALUES ('749', '75', '070908', 'QUELLOUNO');
INSERT INTO `distritos` VALUES ('750', '75', '070909', 'KIMBIRI');
INSERT INTO `distritos` VALUES ('751', '75', '070910', 'PICHARI');
INSERT INTO `distritos` VALUES ('752', '76', '071001', 'PARURO');
INSERT INTO `distritos` VALUES ('753', '76', '071002', 'ACCHA');
INSERT INTO `distritos` VALUES ('754', '76', '071003', 'CCAPI');
INSERT INTO `distritos` VALUES ('755', '76', '071004', 'COLCHA');
INSERT INTO `distritos` VALUES ('756', '76', '071005', 'HUANOQUITE');
INSERT INTO `distritos` VALUES ('757', '76', '071006', 'OMACHA');
INSERT INTO `distritos` VALUES ('758', '76', '071007', 'YAURISQUE');
INSERT INTO `distritos` VALUES ('759', '76', '071008', 'PACCARITAMBO');
INSERT INTO `distritos` VALUES ('760', '76', '071009', 'PILLPINTO');
INSERT INTO `distritos` VALUES ('761', '77', '071101', 'PAUCARTAMBO');
INSERT INTO `distritos` VALUES ('762', '77', '071102', 'CAICAY');
INSERT INTO `distritos` VALUES ('763', '77', '071103', 'COLQUEPATA');
INSERT INTO `distritos` VALUES ('764', '77', '071104', 'CHALLABAMBA');
INSERT INTO `distritos` VALUES ('765', '77', '071105', 'COSNIPATA');
INSERT INTO `distritos` VALUES ('766', '77', '071106', 'HUANCARANI');
INSERT INTO `distritos` VALUES ('767', '78', '071201', 'URCOS');
INSERT INTO `distritos` VALUES ('768', '78', '071202', 'ANDAHUAYLILLAS');
INSERT INTO `distritos` VALUES ('769', '78', '071203', 'CAMANTI');
INSERT INTO `distritos` VALUES ('770', '78', '071204', 'CCARHUAYO');
INSERT INTO `distritos` VALUES ('771', '78', '071205', 'CCATCA');
INSERT INTO `distritos` VALUES ('772', '78', '071206', 'CUSIPATA');
INSERT INTO `distritos` VALUES ('773', '78', '071207', 'HUARO');
INSERT INTO `distritos` VALUES ('774', '78', '071208', 'LUCRE');
INSERT INTO `distritos` VALUES ('775', '78', '071209', 'MARCAPATA');
INSERT INTO `distritos` VALUES ('776', '78', '071210', 'OCONGATE');
INSERT INTO `distritos` VALUES ('777', '78', '071211', 'OROPESA');
INSERT INTO `distritos` VALUES ('778', '78', '071212', 'QUIQUIJANA');
INSERT INTO `distritos` VALUES ('779', '79', '071301', 'URUBAMBA');
INSERT INTO `distritos` VALUES ('780', '79', '071302', 'CHINCHERO');
INSERT INTO `distritos` VALUES ('781', '79', '071303', 'HUAYLLABAMBA');
INSERT INTO `distritos` VALUES ('782', '79', '071304', 'MACHUPICCHU');
INSERT INTO `distritos` VALUES ('783', '79', '071305', 'MARAS');
INSERT INTO `distritos` VALUES ('784', '79', '071306', 'OLLANTAYTAMBO');
INSERT INTO `distritos` VALUES ('785', '79', '071307', 'YUCAY');
INSERT INTO `distritos` VALUES ('786', '80', '080101', 'HUANCAVELICA');
INSERT INTO `distritos` VALUES ('787', '80', '080102', 'ACOBAMBILLA');
INSERT INTO `distritos` VALUES ('788', '80', '080103', 'ACORIA');
INSERT INTO `distritos` VALUES ('789', '80', '080104', 'CONAYCA');
INSERT INTO `distritos` VALUES ('790', '80', '080105', 'CUENCA');
INSERT INTO `distritos` VALUES ('791', '80', '080106', 'HUACHOCOLPA');
INSERT INTO `distritos` VALUES ('792', '80', '080108', 'HUAYLLAHUARA');
INSERT INTO `distritos` VALUES ('793', '80', '080109', 'IZCUCHACA');
INSERT INTO `distritos` VALUES ('794', '80', '080110', 'LARIA');
INSERT INTO `distritos` VALUES ('795', '80', '080111', 'MANTA');
INSERT INTO `distritos` VALUES ('796', '80', '080112', 'MARISCAL CACERES');
INSERT INTO `distritos` VALUES ('797', '80', '080113', 'MOYA');
INSERT INTO `distritos` VALUES ('798', '80', '080114', 'NUEVO OCCORO');
INSERT INTO `distritos` VALUES ('799', '80', '080115', 'PALCA');
INSERT INTO `distritos` VALUES ('800', '80', '080116', 'PILCHACA');
INSERT INTO `distritos` VALUES ('801', '80', '080117', 'VILCA');
INSERT INTO `distritos` VALUES ('802', '80', '080118', 'YAULI');
INSERT INTO `distritos` VALUES ('803', '80', '080119', 'ASCENCION');
INSERT INTO `distritos` VALUES ('804', '80', '080120', 'HUANDO');
INSERT INTO `distritos` VALUES ('805', '81', '080201', 'ACOBAMBA');
INSERT INTO `distritos` VALUES ('806', '81', '080202', 'ANTA');
INSERT INTO `distritos` VALUES ('807', '81', '080203', 'ANDABAMBA');
INSERT INTO `distritos` VALUES ('808', '81', '080204', 'CAJA');
INSERT INTO `distritos` VALUES ('809', '81', '080205', 'MARCAS');
INSERT INTO `distritos` VALUES ('810', '81', '080206', 'PAUCARA');
INSERT INTO `distritos` VALUES ('811', '81', '080207', 'POMACOCHA');
INSERT INTO `distritos` VALUES ('812', '81', '080208', 'ROSARIO');
INSERT INTO `distritos` VALUES ('813', '82', '080301', 'LIRCAY');
INSERT INTO `distritos` VALUES ('814', '82', '080302', 'ANCHONGA');
INSERT INTO `distritos` VALUES ('815', '82', '080303', 'CALLANMARCA');
INSERT INTO `distritos` VALUES ('816', '82', '080304', 'CONGALLA');
INSERT INTO `distritos` VALUES ('817', '82', '080305', 'CHINCHO');
INSERT INTO `distritos` VALUES ('818', '82', '080306', 'HUAYLLAY GRANDE');
INSERT INTO `distritos` VALUES ('819', '82', '080307', 'HUANCA HUANCA');
INSERT INTO `distritos` VALUES ('820', '82', '080308', 'JULCAMARCA');
INSERT INTO `distritos` VALUES ('821', '82', '080309', 'SAN ANTONIO DE ANTAPARCO');
INSERT INTO `distritos` VALUES ('822', '82', '080310', 'STO TOMAS DE PATA');
INSERT INTO `distritos` VALUES ('823', '82', '080311', 'SECCLLA');
INSERT INTO `distritos` VALUES ('824', '82', '080312', 'CCOCHACCASA');
INSERT INTO `distritos` VALUES ('825', '83', '080401', 'CASTROVIRREYNA');
INSERT INTO `distritos` VALUES ('826', '83', '080402', 'ARMA');
INSERT INTO `distritos` VALUES ('827', '83', '080403', 'AURAHUA');
INSERT INTO `distritos` VALUES ('828', '83', '080405', 'CAPILLAS');
INSERT INTO `distritos` VALUES ('829', '83', '080406', 'COCAS');
INSERT INTO `distritos` VALUES ('830', '83', '080408', 'CHUPAMARCA');
INSERT INTO `distritos` VALUES ('831', '83', '080409', 'HUACHOS');
INSERT INTO `distritos` VALUES ('832', '83', '080410', 'HUAMATAMBO');
INSERT INTO `distritos` VALUES ('833', '83', '080414', 'MOLLEPAMPA');
INSERT INTO `distritos` VALUES ('834', '83', '080422', 'SAN JUAN');
INSERT INTO `distritos` VALUES ('835', '83', '080427', 'TANTARA');
INSERT INTO `distritos` VALUES ('836', '83', '080428', 'TICRAPO');
INSERT INTO `distritos` VALUES ('837', '83', '080429', 'SANTA ANA');
INSERT INTO `distritos` VALUES ('838', '84', '080501', 'PAMPAS');
INSERT INTO `distritos` VALUES ('839', '84', '080502', 'ACOSTAMBO');
INSERT INTO `distritos` VALUES ('840', '84', '080503', 'ACRAQUIA');
INSERT INTO `distritos` VALUES ('841', '84', '080504', 'AHUAYCHA');
INSERT INTO `distritos` VALUES ('842', '84', '080506', 'COLCABAMBA');
INSERT INTO `distritos` VALUES ('843', '84', '080509', 'DANIEL HERNANDEZ');
INSERT INTO `distritos` VALUES ('844', '84', '080511', 'HUACHOCOLPA');
INSERT INTO `distritos` VALUES ('845', '84', '080512', 'HUARIBAMBA');
INSERT INTO `distritos` VALUES ('846', '84', '080515', 'NAHUIMPUQUIO');
INSERT INTO `distritos` VALUES ('847', '84', '080517', 'PAZOS');
INSERT INTO `distritos` VALUES ('848', '84', '080518', 'QUISHUAR');
INSERT INTO `distritos` VALUES ('849', '84', '080519', 'SALCABAMBA');
INSERT INTO `distritos` VALUES ('850', '84', '080520', 'SAN MARCOS DE ROCCHAC');
INSERT INTO `distritos` VALUES ('851', '84', '080523', 'SURCUBAMBA');
INSERT INTO `distritos` VALUES ('852', '84', '080525', 'TINTAY PUNCU');
INSERT INTO `distritos` VALUES ('853', '84', '080526', 'SALCAHUASI');
INSERT INTO `distritos` VALUES ('854', '85', '080601', 'AYAVI');
INSERT INTO `distritos` VALUES ('855', '85', '080602', 'CORDOVA');
INSERT INTO `distritos` VALUES ('856', '85', '080603', 'HUAYACUNDO ARMA');
INSERT INTO `distritos` VALUES ('857', '85', '080604', 'HUAYTARA');
INSERT INTO `distritos` VALUES ('858', '85', '080605', 'LARAMARCA');
INSERT INTO `distritos` VALUES ('859', '85', '080606', 'OCOYO');
INSERT INTO `distritos` VALUES ('860', '85', '080607', 'PILPICHACA');
INSERT INTO `distritos` VALUES ('861', '85', '080608', 'QUERCO');
INSERT INTO `distritos` VALUES ('862', '85', '080609', 'QUITO ARMA');
INSERT INTO `distritos` VALUES ('863', '85', '080610', 'SAN ANTONIO DE CUSICANCHA');
INSERT INTO `distritos` VALUES ('864', '85', '080611', 'SAN FRANCISCO DE SANGAYAICO');
INSERT INTO `distritos` VALUES ('865', '85', '080612', 'SAN ISIDRO');
INSERT INTO `distritos` VALUES ('866', '85', '080613', 'SANTIAGO DE CHOCORVOS');
INSERT INTO `distritos` VALUES ('867', '85', '080614', 'SANTIAGO DE QUIRAHUARA');
INSERT INTO `distritos` VALUES ('868', '85', '080615', 'SANTO DOMINGO DE CAPILLA');
INSERT INTO `distritos` VALUES ('869', '85', '080616', 'TAMBO');
INSERT INTO `distritos` VALUES ('870', '86', '080701', 'CHURCAMPA');
INSERT INTO `distritos` VALUES ('871', '86', '080702', 'ANCO');
INSERT INTO `distritos` VALUES ('872', '86', '080703', 'CHINCHIHUASI');
INSERT INTO `distritos` VALUES ('873', '86', '080704', 'EL CARMEN');
INSERT INTO `distritos` VALUES ('874', '86', '080705', 'LA MERCED');
INSERT INTO `distritos` VALUES ('875', '86', '080706', 'LOCROJA');
INSERT INTO `distritos` VALUES ('876', '86', '080707', 'PAUCARBAMBA');
INSERT INTO `distritos` VALUES ('877', '86', '080708', 'SAN MIGUEL DE MAYOC');
INSERT INTO `distritos` VALUES ('878', '86', '080709', 'SAN PEDRO DE CORIS');
INSERT INTO `distritos` VALUES ('879', '86', '080710', 'PACHAMARCA');
INSERT INTO `distritos` VALUES ('880', '87', '090101', 'HUANUCO');
INSERT INTO `distritos` VALUES ('881', '87', '090102', 'CHINCHAO');
INSERT INTO `distritos` VALUES ('882', '87', '090103', 'CHURUBAMBA');
INSERT INTO `distritos` VALUES ('883', '87', '090104', 'MARGOS');
INSERT INTO `distritos` VALUES ('884', '87', '090105', 'QUISQUI');
INSERT INTO `distritos` VALUES ('885', '87', '090106', 'SAN FCO DE CAYRAN');
INSERT INTO `distritos` VALUES ('886', '87', '090107', 'SAN PEDRO DE CHAULAN');
INSERT INTO `distritos` VALUES ('887', '87', '090108', 'STA MARIA DEL VALLE');
INSERT INTO `distritos` VALUES ('888', '87', '090109', 'YARUMAYO');
INSERT INTO `distritos` VALUES ('889', '87', '090110', 'AMARILIS');
INSERT INTO `distritos` VALUES ('890', '87', '090111', 'PILLCO MARCA');
INSERT INTO `distritos` VALUES ('891', '88', '090201', 'AMBO');
INSERT INTO `distritos` VALUES ('892', '88', '090202', 'CAYNA');
INSERT INTO `distritos` VALUES ('893', '88', '090203', 'COLPAS');
INSERT INTO `distritos` VALUES ('894', '88', '090204', 'CONCHAMARCA');
INSERT INTO `distritos` VALUES ('895', '88', '090205', 'HUACAR');
INSERT INTO `distritos` VALUES ('896', '88', '090206', 'SAN FRANCISCO');
INSERT INTO `distritos` VALUES ('897', '88', '090207', 'SAN RAFAEL');
INSERT INTO `distritos` VALUES ('898', '88', '090208', 'TOMAY KICHWA');
INSERT INTO `distritos` VALUES ('899', '89', '090301', 'LA UNION');
INSERT INTO `distritos` VALUES ('900', '89', '090307', 'CHUQUIS');
INSERT INTO `distritos` VALUES ('901', '89', '090312', 'MARIAS');
INSERT INTO `distritos` VALUES ('902', '89', '090314', 'PACHAS');
INSERT INTO `distritos` VALUES ('903', '89', '090316', 'QUIVILLA');
INSERT INTO `distritos` VALUES ('904', '89', '090317', 'RIPAN');
INSERT INTO `distritos` VALUES ('905', '89', '090321', 'SHUNQUI');
INSERT INTO `distritos` VALUES ('906', '89', '090322', 'SILLAPATA');
INSERT INTO `distritos` VALUES ('907', '89', '090323', 'YANAS');
INSERT INTO `distritos` VALUES ('908', '90', '090401', 'LLATA');
INSERT INTO `distritos` VALUES ('909', '90', '090402', 'ARANCAY');
INSERT INTO `distritos` VALUES ('910', '90', '090403', 'CHAVIN DE PARIARCA');
INSERT INTO `distritos` VALUES ('911', '90', '090404', 'JACAS GRANDE');
INSERT INTO `distritos` VALUES ('912', '90', '090405', 'JIRCAN');
INSERT INTO `distritos` VALUES ('913', '90', '090406', 'MIRAFLORES');
INSERT INTO `distritos` VALUES ('914', '90', '090407', 'MONZON');
INSERT INTO `distritos` VALUES ('915', '90', '090408', 'PUNCHAO');
INSERT INTO `distritos` VALUES ('916', '90', '090409', 'PUNOS');
INSERT INTO `distritos` VALUES ('917', '90', '090410', 'SINGA');
INSERT INTO `distritos` VALUES ('918', '90', '090411', 'TANTAMAYO');
INSERT INTO `distritos` VALUES ('919', '91', '090501', 'HUACRACHUCO');
INSERT INTO `distritos` VALUES ('920', '91', '090502', 'CHOLON');
INSERT INTO `distritos` VALUES ('921', '91', '090505', 'SAN BUENAVENTURA');
INSERT INTO `distritos` VALUES ('922', '92', '090601', 'RUPA RUPA');
INSERT INTO `distritos` VALUES ('923', '92', '090602', 'DANIEL ALOMIA ROBLES');
INSERT INTO `distritos` VALUES ('924', '92', '090603', 'HERMILIO VALDIZAN');
INSERT INTO `distritos` VALUES ('925', '92', '090604', 'LUYANDO');
INSERT INTO `distritos` VALUES ('926', '92', '090605', 'MARIANO DAMASO BERAUN');
INSERT INTO `distritos` VALUES ('927', '92', '090606', 'JOSE CRESPO Y CASTILLO');
INSERT INTO `distritos` VALUES ('928', '93', '090701', 'PANAO');
INSERT INTO `distritos` VALUES ('929', '93', '090702', 'CHAGLLA');
INSERT INTO `distritos` VALUES ('930', '93', '090704', 'MOLINO');
INSERT INTO `distritos` VALUES ('931', '93', '090706', 'UMARI');
INSERT INTO `distritos` VALUES ('932', '94', '090801', 'HONORIA');
INSERT INTO `distritos` VALUES ('933', '94', '090802', 'PUERTO INCA');
INSERT INTO `distritos` VALUES ('934', '94', '090803', 'CODO DEL POZUZO');
INSERT INTO `distritos` VALUES ('935', '94', '090804', 'TOURNAVISTA');
INSERT INTO `distritos` VALUES ('936', '94', '090805', 'YUYAPICHIS');
INSERT INTO `distritos` VALUES ('937', '95', '090901', 'HUACAYBAMBA');
INSERT INTO `distritos` VALUES ('938', '95', '090902', 'PINRA');
INSERT INTO `distritos` VALUES ('939', '95', '090903', 'CANCHABAMBA');
INSERT INTO `distritos` VALUES ('940', '95', '090904', 'COCHABAMBA');
INSERT INTO `distritos` VALUES ('941', '96', '091001', 'JESUS');
INSERT INTO `distritos` VALUES ('942', '96', '091002', 'BANOS');
INSERT INTO `distritos` VALUES ('943', '96', '091003', 'SAN FRANCISCO DE ASIS');
INSERT INTO `distritos` VALUES ('944', '96', '091004', 'QUEROPALCA');
INSERT INTO `distritos` VALUES ('945', '96', '091005', 'SAN MIGUEL DE CAURI');
INSERT INTO `distritos` VALUES ('946', '96', '091006', 'RONDOS');
INSERT INTO `distritos` VALUES ('947', '96', '091007', 'JIVIA');
INSERT INTO `distritos` VALUES ('948', '97', '091101', 'CHAVINILLO');
INSERT INTO `distritos` VALUES ('949', '97', '091102', 'APARICIO POMARES (CHUPAN)');
INSERT INTO `distritos` VALUES ('950', '97', '091103', 'CAHUAC');
INSERT INTO `distritos` VALUES ('951', '97', '091104', 'CHACABAMBA');
INSERT INTO `distritos` VALUES ('952', '97', '091105', 'JACAS CHICO');
INSERT INTO `distritos` VALUES ('953', '97', '091106', 'OBAS');
INSERT INTO `distritos` VALUES ('954', '97', '091107', 'PAMPAMARCA');
INSERT INTO `distritos` VALUES ('955', '97', '091108', 'CHORAS                   ');
INSERT INTO `distritos` VALUES ('956', '98', '100101', 'ICA');
INSERT INTO `distritos` VALUES ('957', '98', '100102', 'LA TINGUINA');
INSERT INTO `distritos` VALUES ('958', '98', '100103', 'LOS AQUIJES');
INSERT INTO `distritos` VALUES ('959', '98', '100104', 'PARCONA');
INSERT INTO `distritos` VALUES ('960', '98', '100105', 'PUEBLO NUEVO');
INSERT INTO `distritos` VALUES ('961', '98', '100106', 'SALAS');
INSERT INTO `distritos` VALUES ('962', '98', '100107', 'SAN JOSE DE LOS MOLINOS');
INSERT INTO `distritos` VALUES ('963', '98', '100108', 'SAN JUAN BAUTISTA');
INSERT INTO `distritos` VALUES ('964', '98', '100109', 'SANTIAGO');
INSERT INTO `distritos` VALUES ('965', '98', '100110', 'SUBTANJALLA');
INSERT INTO `distritos` VALUES ('966', '98', '100111', 'YAUCA DEL ROSARIO');
INSERT INTO `distritos` VALUES ('967', '98', '100112', 'TATE');
INSERT INTO `distritos` VALUES ('968', '98', '100113', 'PACHACUTEC');
INSERT INTO `distritos` VALUES ('969', '98', '100114', 'OCUCAJE');
INSERT INTO `distritos` VALUES ('970', '99', '100201', 'CHINCHA ALTA');
INSERT INTO `distritos` VALUES ('971', '99', '100202', 'CHAVIN');
INSERT INTO `distritos` VALUES ('972', '99', '100203', 'CHINCHA BAJA');
INSERT INTO `distritos` VALUES ('973', '99', '100204', 'EL CARMEN');
INSERT INTO `distritos` VALUES ('974', '99', '100205', 'GROCIO PRADO');
INSERT INTO `distritos` VALUES ('975', '99', '100206', 'SAN PEDRO DE HUACARPANA');
INSERT INTO `distritos` VALUES ('976', '99', '100207', 'SUNAMPE');
INSERT INTO `distritos` VALUES ('977', '99', '100208', 'TAMBO DE MORA');
INSERT INTO `distritos` VALUES ('978', '99', '100209', 'ALTO LARAN');
INSERT INTO `distritos` VALUES ('979', '99', '100210', 'PUEBLO NUEVO');
INSERT INTO `distritos` VALUES ('980', '99', '100211', 'SAN JUAN DE YANAC');
INSERT INTO `distritos` VALUES ('981', '100', '100301', 'NAZCA');
INSERT INTO `distritos` VALUES ('982', '100', '100302', 'CHANGUILLO');
INSERT INTO `distritos` VALUES ('983', '100', '100303', 'EL INGENIO');
INSERT INTO `distritos` VALUES ('984', '100', '100304', 'MARCONA');
INSERT INTO `distritos` VALUES ('985', '100', '100305', 'VISTA ALEGRE');
INSERT INTO `distritos` VALUES ('986', '101', '100401', 'PISCO');
INSERT INTO `distritos` VALUES ('987', '101', '100402', 'HUANCANO');
INSERT INTO `distritos` VALUES ('988', '101', '100403', 'HUMAY');
INSERT INTO `distritos` VALUES ('989', '101', '100404', 'INDEPENDENCIA');
INSERT INTO `distritos` VALUES ('990', '101', '100405', 'PARACAS');
INSERT INTO `distritos` VALUES ('991', '101', '100406', 'SAN ANDRES');
INSERT INTO `distritos` VALUES ('992', '101', '100407', 'SAN CLEMENTE');
INSERT INTO `distritos` VALUES ('993', '101', '100408', 'TUPAC AMARU INCA');
INSERT INTO `distritos` VALUES ('994', '102', '100501', 'PALPA');
INSERT INTO `distritos` VALUES ('995', '102', '100502', 'LLIPATA');
INSERT INTO `distritos` VALUES ('996', '102', '100503', 'RIO GRANDE');
INSERT INTO `distritos` VALUES ('997', '102', '100504', 'SANTA CRUZ');
INSERT INTO `distritos` VALUES ('998', '102', '100505', 'TIBILLO');
INSERT INTO `distritos` VALUES ('999', '103', '110101', 'HUANCAYO');
INSERT INTO `distritos` VALUES ('1000', '103', '110103', 'CARHUACALLANGA');
INSERT INTO `distritos` VALUES ('1001', '103', '110104', 'COLCA');
INSERT INTO `distritos` VALUES ('1002', '103', '110105', 'CULLHUAS');
INSERT INTO `distritos` VALUES ('1003', '103', '110106', 'CHACAPAMPA');
INSERT INTO `distritos` VALUES ('1004', '103', '110107', 'CHICCHE');
INSERT INTO `distritos` VALUES ('1005', '103', '110108', 'CHILCA');
INSERT INTO `distritos` VALUES ('1006', '103', '110109', 'CHONGOS ALTO');
INSERT INTO `distritos` VALUES ('1007', '103', '110112', 'CHUPURO');
INSERT INTO `distritos` VALUES ('1008', '103', '110113', 'EL TAMBO');
INSERT INTO `distritos` VALUES ('1009', '103', '110114', 'HUACRAPUQUIO');
INSERT INTO `distritos` VALUES ('1010', '103', '110116', 'HUALHUAS');
INSERT INTO `distritos` VALUES ('1011', '103', '110118', 'HUANCAN');
INSERT INTO `distritos` VALUES ('1012', '103', '110119', 'HUASICANCHA');
INSERT INTO `distritos` VALUES ('1013', '103', '110120', 'HUAYUCACHI');
INSERT INTO `distritos` VALUES ('1014', '103', '110121', 'INGENIO');
INSERT INTO `distritos` VALUES ('1015', '103', '110122', 'PARIAHUANCA');
INSERT INTO `distritos` VALUES ('1016', '103', '110123', 'PILCOMAYO');
INSERT INTO `distritos` VALUES ('1017', '103', '110124', 'PUCARA');
INSERT INTO `distritos` VALUES ('1018', '103', '110125', 'QUICHUAY');
INSERT INTO `distritos` VALUES ('1019', '103', '110126', 'QUILCAS');
INSERT INTO `distritos` VALUES ('1020', '103', '110127', 'SAN AGUSTIN');
INSERT INTO `distritos` VALUES ('1021', '103', '110128', 'SAN JERONIMO DE TUNAN');
INSERT INTO `distritos` VALUES ('1022', '103', '110131', 'STO DOMINGO DE ACOBAMBA');
INSERT INTO `distritos` VALUES ('1023', '103', '110132', 'SANO');
INSERT INTO `distritos` VALUES ('1024', '103', '110133', 'SAPALLANGA');
INSERT INTO `distritos` VALUES ('1025', '103', '110134', 'SICAYA');
INSERT INTO `distritos` VALUES ('1026', '103', '110136', 'VIQUES');
INSERT INTO `distritos` VALUES ('1027', '104', '110201', 'CONCEPCION');
INSERT INTO `distritos` VALUES ('1028', '104', '110202', 'ACO');
INSERT INTO `distritos` VALUES ('1029', '104', '110203', 'ANDAMARCA');
INSERT INTO `distritos` VALUES ('1030', '104', '110204', 'COMAS');
INSERT INTO `distritos` VALUES ('1031', '104', '110205', 'COCHAS');
INSERT INTO `distritos` VALUES ('1032', '104', '110206', 'CHAMBARA');
INSERT INTO `distritos` VALUES ('1033', '104', '110207', 'HEROINAS TOLEDO');
INSERT INTO `distritos` VALUES ('1034', '104', '110208', 'MANZANARES');
INSERT INTO `distritos` VALUES ('1035', '104', '110209', 'MCAL CASTILLA');
INSERT INTO `distritos` VALUES ('1036', '104', '110210', 'MATAHUASI');
INSERT INTO `distritos` VALUES ('1037', '104', '110211', 'MITO');
INSERT INTO `distritos` VALUES ('1038', '104', '110212', 'NUEVE DE JULIO');
INSERT INTO `distritos` VALUES ('1039', '104', '110213', 'ORCOTUNA');
INSERT INTO `distritos` VALUES ('1040', '104', '110214', 'STA ROSA DE OCOPA');
INSERT INTO `distritos` VALUES ('1041', '104', '110215', 'SAN JOSE DE QUERO');
INSERT INTO `distritos` VALUES ('1042', '105', '110301', 'JAUJA');
INSERT INTO `distritos` VALUES ('1043', '105', '110302', 'ACOLLA');
INSERT INTO `distritos` VALUES ('1044', '105', '110303', 'APATA');
INSERT INTO `distritos` VALUES ('1045', '105', '110304', 'ATAURA');
INSERT INTO `distritos` VALUES ('1046', '105', '110305', 'CANCHAILLO');
INSERT INTO `distritos` VALUES ('1047', '105', '110306', 'EL MANTARO');
INSERT INTO `distritos` VALUES ('1048', '105', '110307', 'HUAMALI');
INSERT INTO `distritos` VALUES ('1049', '105', '110308', 'HUARIPAMPA');
INSERT INTO `distritos` VALUES ('1050', '105', '110309', 'HUERTAS');
INSERT INTO `distritos` VALUES ('1051', '105', '110310', 'JANJAILLO');
INSERT INTO `distritos` VALUES ('1052', '105', '110311', 'JULCAN');
INSERT INTO `distritos` VALUES ('1053', '105', '110312', 'LEONOR ORDONEZ');
INSERT INTO `distritos` VALUES ('1054', '105', '110313', 'LLOCLLAPAMPA');
INSERT INTO `distritos` VALUES ('1055', '105', '110314', 'MARCO');
INSERT INTO `distritos` VALUES ('1056', '105', '110315', 'MASMA');
INSERT INTO `distritos` VALUES ('1057', '105', '110316', 'MOLINOS');
INSERT INTO `distritos` VALUES ('1058', '105', '110317', 'MONOBAMBA');
INSERT INTO `distritos` VALUES ('1059', '105', '110318', 'MUQUI');
INSERT INTO `distritos` VALUES ('1060', '105', '110319', 'MUQUIYAUYO');
INSERT INTO `distritos` VALUES ('1061', '105', '110320', 'PACA');
INSERT INTO `distritos` VALUES ('1062', '105', '110321', 'PACCHA');
INSERT INTO `distritos` VALUES ('1063', '105', '110322', 'PANCAN');
INSERT INTO `distritos` VALUES ('1064', '105', '110323', 'PARCO');
INSERT INTO `distritos` VALUES ('1065', '105', '110324', 'POMACANCHA');
INSERT INTO `distritos` VALUES ('1066', '105', '110325', 'RICRAN');
INSERT INTO `distritos` VALUES ('1067', '105', '110326', 'SAN LORENZO');
INSERT INTO `distritos` VALUES ('1068', '105', '110327', 'SAN PEDRO DE CHUNAN');
INSERT INTO `distritos` VALUES ('1069', '105', '110328', 'SINCOS');
INSERT INTO `distritos` VALUES ('1070', '105', '110329', 'TUNAN MARCA');
INSERT INTO `distritos` VALUES ('1071', '105', '110330', 'YAULI');
INSERT INTO `distritos` VALUES ('1072', '105', '110331', 'CURICACA');
INSERT INTO `distritos` VALUES ('1073', '105', '110332', 'MASMA CHICCHE');
INSERT INTO `distritos` VALUES ('1074', '105', '110333', 'SAUSA');
INSERT INTO `distritos` VALUES ('1075', '105', '110334', 'YAUYOS');
INSERT INTO `distritos` VALUES ('1076', '106', '110401', 'JUNIN');
INSERT INTO `distritos` VALUES ('1077', '106', '110402', 'CARHUAMAYO');
INSERT INTO `distritos` VALUES ('1078', '106', '110403', 'ONDORES');
INSERT INTO `distritos` VALUES ('1079', '106', '110404', 'ULCUMAYO');
INSERT INTO `distritos` VALUES ('1080', '107', '110501', 'TARMA');
INSERT INTO `distritos` VALUES ('1081', '107', '110502', 'ACOBAMBA');
INSERT INTO `distritos` VALUES ('1082', '107', '110503', 'HUARICOLCA');
INSERT INTO `distritos` VALUES ('1083', '107', '110504', 'HUASAHUASI');
INSERT INTO `distritos` VALUES ('1084', '107', '110505', 'LA UNION');
INSERT INTO `distritos` VALUES ('1085', '107', '110506', 'PALCA');
INSERT INTO `distritos` VALUES ('1086', '107', '110507', 'PALCAMAYO');
INSERT INTO `distritos` VALUES ('1087', '107', '110508', 'SAN PEDRO DE CAJAS');
INSERT INTO `distritos` VALUES ('1088', '107', '110509', 'TAPO');
INSERT INTO `distritos` VALUES ('1089', '108', '110601', 'LA OROYA');
INSERT INTO `distritos` VALUES ('1090', '108', '110602', 'CHACAPALPA');
INSERT INTO `distritos` VALUES ('1091', '108', '110603', 'HUAY HUAY');
INSERT INTO `distritos` VALUES ('1092', '108', '110604', 'MARCAPOMACOCHA');
INSERT INTO `distritos` VALUES ('1093', '108', '110605', 'MOROCOCHA');
INSERT INTO `distritos` VALUES ('1094', '108', '110606', 'PACCHA');
INSERT INTO `distritos` VALUES ('1095', '108', '110607', 'STA BARBARA DE CARHUACAYAN');
INSERT INTO `distritos` VALUES ('1096', '108', '110608', 'SUITUCANCHA');
INSERT INTO `distritos` VALUES ('1097', '108', '110609', 'YAULI');
INSERT INTO `distritos` VALUES ('1098', '108', '110610', 'STA ROSA DE SACCO');
INSERT INTO `distritos` VALUES ('1099', '109', '110701', 'SATIPO');
INSERT INTO `distritos` VALUES ('1100', '109', '110702', 'COVIRIALI');
INSERT INTO `distritos` VALUES ('1101', '109', '110703', 'LLAYLLA');
INSERT INTO `distritos` VALUES ('1102', '109', '110704', 'MAZAMARI');
INSERT INTO `distritos` VALUES ('1103', '109', '110705', 'PAMPA HERMOSA');
INSERT INTO `distritos` VALUES ('1104', '109', '110706', 'PANGOA');
INSERT INTO `distritos` VALUES ('1105', '109', '110707', 'RIO NEGRO');
INSERT INTO `distritos` VALUES ('1106', '109', '110708', 'RIO TAMBO');
INSERT INTO `distritos` VALUES ('1107', '110', '110801', 'CHANCHAMAYO');
INSERT INTO `distritos` VALUES ('1108', '110', '110802', 'SAN RAMON');
INSERT INTO `distritos` VALUES ('1109', '110', '110803', 'VITOC');
INSERT INTO `distritos` VALUES ('1110', '110', '110804', 'SAN LUIS DE SHUARO');
INSERT INTO `distritos` VALUES ('1111', '110', '110805', 'PICHANAQUI');
INSERT INTO `distritos` VALUES ('1112', '110', '110806', 'PERENE');
INSERT INTO `distritos` VALUES ('1113', '111', '110901', 'CHUPACA');
INSERT INTO `distritos` VALUES ('1114', '111', '110902', 'AHUAC');
INSERT INTO `distritos` VALUES ('1115', '111', '110903', 'CHONGOS BAJO');
INSERT INTO `distritos` VALUES ('1116', '111', '110904', 'HUACHAC');
INSERT INTO `distritos` VALUES ('1117', '111', '110905', 'HUAMANCACA CHICO');
INSERT INTO `distritos` VALUES ('1118', '111', '110906', 'SAN JUAN DE ISCOS');
INSERT INTO `distritos` VALUES ('1119', '111', '110907', 'SAN JUAN DE JARPA');
INSERT INTO `distritos` VALUES ('1120', '111', '110908', 'TRES DE DICIEMBRE');
INSERT INTO `distritos` VALUES ('1121', '111', '110909', 'YANACANCHA');
INSERT INTO `distritos` VALUES ('1122', '112', '120101', 'TRUJILLO');
INSERT INTO `distritos` VALUES ('1123', '112', '120102', 'HUANCHACO');
INSERT INTO `distritos` VALUES ('1124', '112', '120103', 'LAREDO');
INSERT INTO `distritos` VALUES ('1125', '112', '120104', 'MOCHE');
INSERT INTO `distritos` VALUES ('1126', '112', '120105', 'SALAVERRY');
INSERT INTO `distritos` VALUES ('1127', '112', '120106', 'SIMBAL');
INSERT INTO `distritos` VALUES ('1128', '112', '120107', 'VICTOR LARCO HERRERA');
INSERT INTO `distritos` VALUES ('1129', '112', '120109', 'POROTO');
INSERT INTO `distritos` VALUES ('1130', '112', '120110', 'EL PORVENIR');
INSERT INTO `distritos` VALUES ('1131', '112', '120111', 'LA ESPERANZA');
INSERT INTO `distritos` VALUES ('1132', '112', '120112', 'FLORENCIA DE MORA');
INSERT INTO `distritos` VALUES ('1133', '113', '120201', 'BOLIVAR');
INSERT INTO `distritos` VALUES ('1134', '113', '120202', 'BAMBAMARCA');
INSERT INTO `distritos` VALUES ('1135', '113', '120203', 'CONDORMARCA');
INSERT INTO `distritos` VALUES ('1136', '113', '120204', 'LONGOTEA');
INSERT INTO `distritos` VALUES ('1137', '113', '120205', 'UCUNCHA');
INSERT INTO `distritos` VALUES ('1138', '113', '120206', 'UCHUMARCA');
INSERT INTO `distritos` VALUES ('1139', '114', '120301', 'HUAMACHUCO');
INSERT INTO `distritos` VALUES ('1140', '114', '120302', 'COCHORCO');
INSERT INTO `distritos` VALUES ('1141', '114', '120303', 'CURGOS');
INSERT INTO `distritos` VALUES ('1142', '114', '120304', 'CHUGAY');
INSERT INTO `distritos` VALUES ('1143', '114', '120305', 'MARCABAL');
INSERT INTO `distritos` VALUES ('1144', '114', '120306', 'SANAGORAN');
INSERT INTO `distritos` VALUES ('1145', '114', '120307', 'SARIN');
INSERT INTO `distritos` VALUES ('1146', '114', '120308', 'SARTIMBAMBA');
INSERT INTO `distritos` VALUES ('1147', '115', '120401', 'OTUZCO');
INSERT INTO `distritos` VALUES ('1148', '115', '120402', 'AGALLPAMPA');
INSERT INTO `distritos` VALUES ('1149', '115', '120403', 'CHARAT');
INSERT INTO `distritos` VALUES ('1150', '115', '120404', 'HUARANCHAL');
INSERT INTO `distritos` VALUES ('1151', '115', '120405', 'LA CUESTA');
INSERT INTO `distritos` VALUES ('1152', '115', '120408', 'PARANDAY');
INSERT INTO `distritos` VALUES ('1153', '115', '120409', 'SALPO');
INSERT INTO `distritos` VALUES ('1154', '115', '120410', 'SINSICAP');
INSERT INTO `distritos` VALUES ('1155', '115', '120411', 'USQUIL');
INSERT INTO `distritos` VALUES ('1156', '115', '120413', 'MACHE');
INSERT INTO `distritos` VALUES ('1157', '116', '120501', 'SAN PEDRO DE LLOC');
INSERT INTO `distritos` VALUES ('1158', '116', '120503', 'GUADALUPE');
INSERT INTO `distritos` VALUES ('1159', '116', '120504', 'JEQUETEPEQUE');
INSERT INTO `distritos` VALUES ('1160', '116', '120506', 'PACASMAYO');
INSERT INTO `distritos` VALUES ('1161', '116', '120508', 'SAN JOSE');
INSERT INTO `distritos` VALUES ('1162', '117', '120601', 'TAYABAMBA');
INSERT INTO `distritos` VALUES ('1163', '117', '120602', 'BULDIBUYO');
INSERT INTO `distritos` VALUES ('1164', '117', '120603', 'CHILLIA');
INSERT INTO `distritos` VALUES ('1165', '117', '120604', 'HUAYLILLAS');
INSERT INTO `distritos` VALUES ('1166', '117', '120605', 'HUANCASPATA');
INSERT INTO `distritos` VALUES ('1167', '117', '120606', 'HUAYO');
INSERT INTO `distritos` VALUES ('1168', '117', '120607', 'ONGON');
INSERT INTO `distritos` VALUES ('1169', '117', '120608', 'PARCOY');
INSERT INTO `distritos` VALUES ('1170', '117', '120609', 'PATAZ');
INSERT INTO `distritos` VALUES ('1171', '117', '120610', 'PIAS');
INSERT INTO `distritos` VALUES ('1172', '117', '120611', 'TAURIJA');
INSERT INTO `distritos` VALUES ('1173', '117', '120612', 'URPAY');
INSERT INTO `distritos` VALUES ('1174', '117', '120613', 'SANTIAGO DE CHALLAS');
INSERT INTO `distritos` VALUES ('1175', '118', '120701', 'SANTIAGO DE CHUCO');
INSERT INTO `distritos` VALUES ('1176', '118', '120702', 'CACHICADAN');
INSERT INTO `distritos` VALUES ('1177', '118', '120703', 'MOLLEBAMBA');
INSERT INTO `distritos` VALUES ('1178', '118', '120704', 'MOLLEPATA');
INSERT INTO `distritos` VALUES ('1179', '118', '120705', 'QUIRUVILCA');
INSERT INTO `distritos` VALUES ('1180', '118', '120706', 'SANTA CRUZ DE CHUCA');
INSERT INTO `distritos` VALUES ('1181', '118', '120707', 'SITABAMBA');
INSERT INTO `distritos` VALUES ('1182', '118', '120708', 'ANGASMARCA');
INSERT INTO `distritos` VALUES ('1183', '119', '120801', 'ASCOPE');
INSERT INTO `distritos` VALUES ('1184', '119', '120802', 'CHICAMA');
INSERT INTO `distritos` VALUES ('1185', '119', '120803', 'CHOCOPE');
INSERT INTO `distritos` VALUES ('1186', '119', '120804', 'SANTIAGO DE CAO');
INSERT INTO `distritos` VALUES ('1187', '119', '120805', 'MAGDALENA DE CAO');
INSERT INTO `distritos` VALUES ('1188', '119', '120806', 'PAIJAN');
INSERT INTO `distritos` VALUES ('1189', '119', '120807', 'RAZURI');
INSERT INTO `distritos` VALUES ('1190', '119', '120808', 'CASA GRANDE');
INSERT INTO `distritos` VALUES ('1191', '120', '120901', 'CHEPEN');
INSERT INTO `distritos` VALUES ('1192', '120', '120902', 'PACANGA');
INSERT INTO `distritos` VALUES ('1193', '120', '120903', 'PUEBLO NUEVO');
INSERT INTO `distritos` VALUES ('1194', '121', '121001', 'JULCAN');
INSERT INTO `distritos` VALUES ('1195', '121', '121002', 'CARABAMBA');
INSERT INTO `distritos` VALUES ('1196', '121', '121003', 'CALAMARCA');
INSERT INTO `distritos` VALUES ('1197', '121', '121004', 'HUASO');
INSERT INTO `distritos` VALUES ('1198', '122', '121101', 'CASCAS');
INSERT INTO `distritos` VALUES ('1199', '122', '121102', 'LUCMA');
INSERT INTO `distritos` VALUES ('1200', '122', '121103', 'MARMOT');
INSERT INTO `distritos` VALUES ('1201', '122', '121104', 'SAYAPULLO');
INSERT INTO `distritos` VALUES ('1202', '123', '121201', 'VIRU');
INSERT INTO `distritos` VALUES ('1203', '123', '121202', 'CHAO');
INSERT INTO `distritos` VALUES ('1204', '123', '121203', 'GUADALUPITO');
INSERT INTO `distritos` VALUES ('1205', '124', '130101', 'CHICLAYO');
INSERT INTO `distritos` VALUES ('1206', '124', '130102', 'CHONGOYAPE');
INSERT INTO `distritos` VALUES ('1207', '124', '130103', 'ETEN');
INSERT INTO `distritos` VALUES ('1208', '124', '130104', 'ETEN PUERTO');
INSERT INTO `distritos` VALUES ('1209', '124', '130105', 'LAGUNAS');
INSERT INTO `distritos` VALUES ('1210', '124', '130106', 'MONSEFU');
INSERT INTO `distritos` VALUES ('1211', '124', '130107', 'NUEVA ARICA');
INSERT INTO `distritos` VALUES ('1212', '124', '130108', 'OYOTUN');
INSERT INTO `distritos` VALUES ('1213', '124', '130109', 'PICSI');
INSERT INTO `distritos` VALUES ('1214', '124', '130110', 'PIMENTEL');
INSERT INTO `distritos` VALUES ('1215', '124', '130111', 'REQUE');
INSERT INTO `distritos` VALUES ('1216', '124', '130112', 'JOSE LEONARDO ORTIZ');
INSERT INTO `distritos` VALUES ('1217', '124', '130113', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('1218', '124', '130114', 'SANA');
INSERT INTO `distritos` VALUES ('1219', '124', '130115', 'LA VICTORIA');
INSERT INTO `distritos` VALUES ('1220', '124', '130116', 'CAYALTI');
INSERT INTO `distritos` VALUES ('1221', '124', '130117', 'PATAPO');
INSERT INTO `distritos` VALUES ('1222', '124', '130118', 'POMALCA');
INSERT INTO `distritos` VALUES ('1223', '124', '130119', 'PUCALA');
INSERT INTO `distritos` VALUES ('1224', '124', '130120', 'TUMAN');
INSERT INTO `distritos` VALUES ('1225', '125', '130201', 'FERRENAFE');
INSERT INTO `distritos` VALUES ('1226', '125', '130202', 'INCAHUASI');
INSERT INTO `distritos` VALUES ('1227', '125', '130203', 'CANARIS');
INSERT INTO `distritos` VALUES ('1228', '125', '130204', 'PITIPO');
INSERT INTO `distritos` VALUES ('1229', '125', '130205', 'PUEBLO NUEVO');
INSERT INTO `distritos` VALUES ('1230', '125', '130206', 'MANUEL ANTONIO MESONES MURO');
INSERT INTO `distritos` VALUES ('1231', '126', '130301', 'LAMBAYEQUE');
INSERT INTO `distritos` VALUES ('1232', '126', '130302', 'CHOCHOPE');
INSERT INTO `distritos` VALUES ('1233', '126', '130303', 'ILLIMO');
INSERT INTO `distritos` VALUES ('1234', '126', '130304', 'JAYANCA');
INSERT INTO `distritos` VALUES ('1235', '126', '130305', 'MOCHUMI');
INSERT INTO `distritos` VALUES ('1236', '126', '130306', 'MORROPE');
INSERT INTO `distritos` VALUES ('1237', '126', '130307', 'MOTUPE');
INSERT INTO `distritos` VALUES ('1238', '126', '130308', 'OLMOS');
INSERT INTO `distritos` VALUES ('1239', '126', '130309', 'PACORA');
INSERT INTO `distritos` VALUES ('1240', '126', '130310', 'SALAS');
INSERT INTO `distritos` VALUES ('1241', '126', '130311', 'SAN JOSE');
INSERT INTO `distritos` VALUES ('1242', '126', '130312', 'TUCUME');
INSERT INTO `distritos` VALUES ('1243', '127', '140101', 'LIMA');
INSERT INTO `distritos` VALUES ('1244', '127', '140102', 'ANCON');
INSERT INTO `distritos` VALUES ('1245', '127', '140103', 'ATE');
INSERT INTO `distritos` VALUES ('1246', '127', '140104', 'BRENA');
INSERT INTO `distritos` VALUES ('1247', '127', '140105', 'CARABAYLLO');
INSERT INTO `distritos` VALUES ('1248', '127', '140106', 'COMAS');
INSERT INTO `distritos` VALUES ('1249', '127', '140107', 'CHACLACAYO');
INSERT INTO `distritos` VALUES ('1250', '127', '140108', 'CHORRILLOS');
INSERT INTO `distritos` VALUES ('1251', '127', '140109', 'LA VICTORIA');
INSERT INTO `distritos` VALUES ('1252', '127', '140110', 'LA MOLINA');
INSERT INTO `distritos` VALUES ('1253', '127', '140111', 'LINCE');
INSERT INTO `distritos` VALUES ('1254', '127', '140112', 'LURIGANCHO');
INSERT INTO `distritos` VALUES ('1255', '127', '140113', 'LURIN');
INSERT INTO `distritos` VALUES ('1256', '127', '140114', 'MAGDALENA DEL MAR');
INSERT INTO `distritos` VALUES ('1257', '127', '140115', 'MIRAFLORES');
INSERT INTO `distritos` VALUES ('1258', '127', '140116', 'PACHACAMAC');
INSERT INTO `distritos` VALUES ('1259', '127', '140117', 'PUEBLO LIBRE');
INSERT INTO `distritos` VALUES ('1260', '127', '140118', 'PUCUSANA');
INSERT INTO `distritos` VALUES ('1261', '127', '140119', 'PUENTE PIEDRA');
INSERT INTO `distritos` VALUES ('1262', '127', '140120', 'PUNTA HERMOSA');
INSERT INTO `distritos` VALUES ('1263', '127', '140121', 'PUNTA NEGRA');
INSERT INTO `distritos` VALUES ('1264', '127', '140122', 'RIMAC');
INSERT INTO `distritos` VALUES ('1265', '127', '140123', 'SAN BARTOLO');
INSERT INTO `distritos` VALUES ('1266', '127', '140124', 'SAN ISIDRO');
INSERT INTO `distritos` VALUES ('1267', '127', '140125', 'BARRANCO');
INSERT INTO `distritos` VALUES ('1268', '127', '140126', 'SAN MARTIN DE PORRES');
INSERT INTO `distritos` VALUES ('1269', '127', '140127', 'SAN MIGUEL');
INSERT INTO `distritos` VALUES ('1270', '127', '140128', 'STA MARIA DEL MAR');
INSERT INTO `distritos` VALUES ('1271', '127', '140129', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('1272', '127', '140130', 'SANTIAGO DE SURCO');
INSERT INTO `distritos` VALUES ('1273', '127', '140131', 'SURQUILLO');
INSERT INTO `distritos` VALUES ('1274', '127', '140132', 'VILLA MARIA DEL TRIUNFO');
INSERT INTO `distritos` VALUES ('1275', '127', '140133', 'JESUS MARIA');
INSERT INTO `distritos` VALUES ('1276', '127', '140134', 'INDEPENDENCIA');
INSERT INTO `distritos` VALUES ('1277', '127', '140135', 'EL AGUSTINO');
INSERT INTO `distritos` VALUES ('1278', '127', '140136', 'SAN JUAN DE MIRAFLORES');
INSERT INTO `distritos` VALUES ('1279', '127', '140137', 'SAN JUAN DE LURIGANCHO');
INSERT INTO `distritos` VALUES ('1280', '127', '140138', 'SAN LUIS');
INSERT INTO `distritos` VALUES ('1281', '127', '140139', 'CIENEGUILLA');
INSERT INTO `distritos` VALUES ('1282', '127', '140140', 'SAN BORJA');
INSERT INTO `distritos` VALUES ('1283', '127', '140141', 'VILLA EL SALVADOR');
INSERT INTO `distritos` VALUES ('1284', '127', '140142', 'LOS OLIVOS');
INSERT INTO `distritos` VALUES ('1285', '127', '140143', 'SANTA ANITA');
INSERT INTO `distritos` VALUES ('1286', '128', '140201', 'CAJATAMBO');
INSERT INTO `distritos` VALUES ('1287', '128', '140205', 'COPA');
INSERT INTO `distritos` VALUES ('1288', '128', '140206', 'GORGOR');
INSERT INTO `distritos` VALUES ('1289', '128', '140207', 'HUANCAPON');
INSERT INTO `distritos` VALUES ('1290', '128', '140208', 'MANAS');
INSERT INTO `distritos` VALUES ('1291', '129', '140301', 'CANTA');
INSERT INTO `distritos` VALUES ('1292', '129', '140302', 'ARAHUAY');
INSERT INTO `distritos` VALUES ('1293', '129', '140303', 'HUAMANTANGA');
INSERT INTO `distritos` VALUES ('1294', '129', '140304', 'HUAROS');
INSERT INTO `distritos` VALUES ('1295', '129', '140305', 'LACHAQUI');
INSERT INTO `distritos` VALUES ('1296', '129', '140306', 'SAN BUENAVENTURA');
INSERT INTO `distritos` VALUES ('1297', '129', '140307', 'SANTA ROSA DE QUIVES');
INSERT INTO `distritos` VALUES ('1298', '130', '140401', 'SAN VICENTE DE CANETE');
INSERT INTO `distritos` VALUES ('1299', '130', '140402', 'CALANGO');
INSERT INTO `distritos` VALUES ('1300', '130', '140403', 'CERRO AZUL');
INSERT INTO `distritos` VALUES ('1301', '130', '140404', 'COAYLLO');
INSERT INTO `distritos` VALUES ('1302', '130', '140405', 'CHILCA');
INSERT INTO `distritos` VALUES ('1303', '130', '140406', 'IMPERIAL');
INSERT INTO `distritos` VALUES ('1304', '130', '140407', 'LUNAHUANA');
INSERT INTO `distritos` VALUES ('1305', '130', '140408', 'MALA');
INSERT INTO `distritos` VALUES ('1306', '130', '140409', 'NUEVO IMPERIAL');
INSERT INTO `distritos` VALUES ('1307', '130', '140410', 'PACARAN');
INSERT INTO `distritos` VALUES ('1308', '130', '140411', 'QUILMANA');
INSERT INTO `distritos` VALUES ('1309', '130', '140412', 'SAN ANTONIO');
INSERT INTO `distritos` VALUES ('1310', '130', '140413', 'SAN LUIS');
INSERT INTO `distritos` VALUES ('1311', '130', '140414', 'SANTA CRUZ DE FLORES');
INSERT INTO `distritos` VALUES ('1312', '130', '140415', 'ZUNIGA');
INSERT INTO `distritos` VALUES ('1313', '130', '140416', 'ASIA');
INSERT INTO `distritos` VALUES ('1314', '131', '140501', 'HUACHO');
INSERT INTO `distritos` VALUES ('1315', '131', '140502', 'AMBAR');
INSERT INTO `distritos` VALUES ('1316', '131', '140504', 'CALETA DE CARQUIN');
INSERT INTO `distritos` VALUES ('1317', '131', '140505', 'CHECRAS');
INSERT INTO `distritos` VALUES ('1318', '131', '140506', 'HUALMAY');
INSERT INTO `distritos` VALUES ('1319', '131', '140507', 'HUAURA');
INSERT INTO `distritos` VALUES ('1320', '131', '140508', 'LEONCIO PRADO');
INSERT INTO `distritos` VALUES ('1321', '131', '140509', 'PACCHO');
INSERT INTO `distritos` VALUES ('1322', '131', '140511', 'SANTA LEONOR');
INSERT INTO `distritos` VALUES ('1323', '131', '140512', 'SANTA MARIA');
INSERT INTO `distritos` VALUES ('1324', '131', '140513', 'SAYAN');
INSERT INTO `distritos` VALUES ('1325', '131', '140516', 'VEGUETA');
INSERT INTO `distritos` VALUES ('1326', '132', '140601', 'MATUCANA');
INSERT INTO `distritos` VALUES ('1327', '132', '140602', 'ANTIOQUIA');
INSERT INTO `distritos` VALUES ('1328', '132', '140603', 'CALLAHUANCA');
INSERT INTO `distritos` VALUES ('1329', '132', '140604', 'CARAMPOMA');
INSERT INTO `distritos` VALUES ('1330', '132', '140605', 'CASTA');
INSERT INTO `distritos` VALUES ('1331', '132', '140606', 'CUENCA');
INSERT INTO `distritos` VALUES ('1332', '132', '140607', 'CHICLA');
INSERT INTO `distritos` VALUES ('1333', '132', '140608', 'HUANZA');
INSERT INTO `distritos` VALUES ('1334', '132', '140609', 'HUAROCHIRI');
INSERT INTO `distritos` VALUES ('1335', '132', '140610', 'LAHUAYTAMBO');
INSERT INTO `distritos` VALUES ('1336', '132', '140611', 'LANGA');
INSERT INTO `distritos` VALUES ('1337', '132', '140612', 'MARIATANA');
INSERT INTO `distritos` VALUES ('1338', '132', '140613', 'RICARDO PALMA');
INSERT INTO `distritos` VALUES ('1339', '132', '140614', 'SAN ANDRES DE TUPICOCHA');
INSERT INTO `distritos` VALUES ('1340', '132', '140615', 'SAN ANTONIO');
INSERT INTO `distritos` VALUES ('1341', '132', '140616', 'SAN BARTOLOME');
INSERT INTO `distritos` VALUES ('1342', '132', '140617', 'SAN DAMIAN');
INSERT INTO `distritos` VALUES ('1343', '132', '140618', 'SANGALLAYA');
INSERT INTO `distritos` VALUES ('1344', '132', '140619', 'SAN JUAN DE TANTARANCHE');
INSERT INTO `distritos` VALUES ('1345', '132', '140620', 'SAN LORENZO DE QUINTI');
INSERT INTO `distritos` VALUES ('1346', '132', '140621', 'SAN MATEO');
INSERT INTO `distritos` VALUES ('1347', '132', '140622', 'SAN MATEO DE OTAO');
INSERT INTO `distritos` VALUES ('1348', '132', '140623', 'SAN PEDRO DE HUANCAYRE');
INSERT INTO `distritos` VALUES ('1349', '132', '140624', 'SANTA CRUZ DE COCACHACRA');
INSERT INTO `distritos` VALUES ('1350', '132', '140625', 'SANTA EULALIA');
INSERT INTO `distritos` VALUES ('1351', '132', '140626', 'SANTIAGO DE ANCHUCAYA');
INSERT INTO `distritos` VALUES ('1352', '132', '140627', 'SANTIAGO DE TUNA');
INSERT INTO `distritos` VALUES ('1353', '132', '140628', 'SANTO DOMINGO DE LOS OLLEROS');
INSERT INTO `distritos` VALUES ('1354', '132', '140629', 'SURCO');
INSERT INTO `distritos` VALUES ('1355', '132', '140630', 'HUACHUPAMPA');
INSERT INTO `distritos` VALUES ('1356', '132', '140631', 'LARAOS');
INSERT INTO `distritos` VALUES ('1357', '132', '140632', 'SAN JUAN DE IRIS');
INSERT INTO `distritos` VALUES ('1358', '133', '140701', 'YAUYOS');
INSERT INTO `distritos` VALUES ('1359', '133', '140702', 'ALIS');
INSERT INTO `distritos` VALUES ('1360', '133', '140703', 'AYAUCA');
INSERT INTO `distritos` VALUES ('1361', '133', '140704', 'AYAVIRI');
INSERT INTO `distritos` VALUES ('1362', '133', '140705', 'AZANGARO');
INSERT INTO `distritos` VALUES ('1363', '133', '140706', 'CACRA');
INSERT INTO `distritos` VALUES ('1364', '133', '140707', 'CARANIA');
INSERT INTO `distritos` VALUES ('1365', '133', '140708', 'COCHAS');
INSERT INTO `distritos` VALUES ('1366', '133', '140709', 'COLONIA');
INSERT INTO `distritos` VALUES ('1367', '133', '140710', 'CHOCOS');
INSERT INTO `distritos` VALUES ('1368', '133', '140711', 'HUAMPARA');
INSERT INTO `distritos` VALUES ('1369', '133', '140712', 'HUANCAYA');
INSERT INTO `distritos` VALUES ('1370', '133', '140713', 'HUANGASCAR');
INSERT INTO `distritos` VALUES ('1371', '133', '140714', 'HUANTAN');
INSERT INTO `distritos` VALUES ('1372', '133', '140715', 'HUANEC');
INSERT INTO `distritos` VALUES ('1373', '133', '140716', 'LARAOS');
INSERT INTO `distritos` VALUES ('1374', '133', '140717', 'LINCHA');
INSERT INTO `distritos` VALUES ('1375', '133', '140718', 'MIRAFLORES');
INSERT INTO `distritos` VALUES ('1376', '133', '140719', 'OMAS');
INSERT INTO `distritos` VALUES ('1377', '133', '140720', 'QUINCHES');
INSERT INTO `distritos` VALUES ('1378', '133', '140721', 'QUINOCAY');
INSERT INTO `distritos` VALUES ('1379', '133', '140722', 'SAN JOAQUIN');
INSERT INTO `distritos` VALUES ('1380', '133', '140723', 'SAN PEDRO DE PILAS');
INSERT INTO `distritos` VALUES ('1381', '133', '140724', 'TANTA');
INSERT INTO `distritos` VALUES ('1382', '133', '140725', 'TAURIPAMPA');
INSERT INTO `distritos` VALUES ('1383', '133', '140726', 'TUPE');
INSERT INTO `distritos` VALUES ('1384', '133', '140727', 'TOMAS');
INSERT INTO `distritos` VALUES ('1385', '133', '140728', 'VINAC');
INSERT INTO `distritos` VALUES ('1386', '133', '140729', 'VITIS');
INSERT INTO `distritos` VALUES ('1387', '133', '140730', 'HONGOS');
INSERT INTO `distritos` VALUES ('1388', '133', '140731', 'MADEAN');
INSERT INTO `distritos` VALUES ('1389', '133', '140732', 'PUTINZA');
INSERT INTO `distritos` VALUES ('1390', '133', '140733', 'CATAHUASI');
INSERT INTO `distritos` VALUES ('1391', '134', '140801', 'HUARAL');
INSERT INTO `distritos` VALUES ('1392', '134', '140802', 'ATAVILLOS ALTO');
INSERT INTO `distritos` VALUES ('1393', '134', '140803', 'ATAVILLOS BAJO');
INSERT INTO `distritos` VALUES ('1394', '134', '140804', 'AUCALLAMA');
INSERT INTO `distritos` VALUES ('1395', '134', '140805', 'CHANCAY');
INSERT INTO `distritos` VALUES ('1396', '134', '140806', 'IHUARI');
INSERT INTO `distritos` VALUES ('1397', '134', '140807', 'LAMPIAN');
INSERT INTO `distritos` VALUES ('1398', '134', '140808', 'PACARAOS');
INSERT INTO `distritos` VALUES ('1399', '134', '140809', 'SAN MIGUEL DE ACOS');
INSERT INTO `distritos` VALUES ('1400', '134', '140810', 'VEINTISIETE DE NOVIEMBRE');
INSERT INTO `distritos` VALUES ('1401', '134', '140811', 'STA CRUZ DE ANDAMARCA');
INSERT INTO `distritos` VALUES ('1402', '134', '140812', 'SUMBILCA');
INSERT INTO `distritos` VALUES ('1403', '135', '140901', 'BARRANCA');
INSERT INTO `distritos` VALUES ('1404', '135', '140902', 'PARAMONGA');
INSERT INTO `distritos` VALUES ('1405', '135', '140903', 'PATIVILCA');
INSERT INTO `distritos` VALUES ('1406', '135', '140904', 'SUPE');
INSERT INTO `distritos` VALUES ('1407', '135', '140905', 'SUPE PUERTO');
INSERT INTO `distritos` VALUES ('1408', '136', '141001', 'OYON');
INSERT INTO `distritos` VALUES ('1409', '136', '141002', 'NAVAN');
INSERT INTO `distritos` VALUES ('1410', '136', '141003', 'CAUJUL');
INSERT INTO `distritos` VALUES ('1411', '136', '141004', 'ANDAJES');
INSERT INTO `distritos` VALUES ('1412', '136', '141005', 'PACHANGARA');
INSERT INTO `distritos` VALUES ('1413', '136', '141006', 'COCHAMARCA');
INSERT INTO `distritos` VALUES ('1414', '137', '150101', 'IQUITOS');
INSERT INTO `distritos` VALUES ('1415', '137', '150102', 'ALTO NANAY');
INSERT INTO `distritos` VALUES ('1416', '137', '150103', 'FERNANDO LORES');
INSERT INTO `distritos` VALUES ('1417', '137', '150104', 'LAS AMAZONAS');
INSERT INTO `distritos` VALUES ('1418', '137', '150105', 'MAZAN');
INSERT INTO `distritos` VALUES ('1419', '137', '150106', 'NAPO');
INSERT INTO `distritos` VALUES ('1420', '137', '150107', 'PUTUMAYO');
INSERT INTO `distritos` VALUES ('1421', '137', '150108', 'TORRES CAUSANA');
INSERT INTO `distritos` VALUES ('1422', '137', '150110', 'INDIANA');
INSERT INTO `distritos` VALUES ('1423', '137', '150111', 'PUNCHANA');
INSERT INTO `distritos` VALUES ('1424', '137', '150112', 'BELEN');
INSERT INTO `distritos` VALUES ('1425', '137', '150113', 'SAN JUAN BAUTISTA');
INSERT INTO `distritos` VALUES ('1426', '137', '150114', 'TNTE MANUEL CLAVERO');
INSERT INTO `distritos` VALUES ('1427', '138', '150201', 'YURIMAGUAS');
INSERT INTO `distritos` VALUES ('1428', '138', '150202', 'BALSAPUERTO');
INSERT INTO `distritos` VALUES ('1429', '138', '150205', 'JEBEROS');
INSERT INTO `distritos` VALUES ('1430', '138', '150206', 'LAGUNAS');
INSERT INTO `distritos` VALUES ('1431', '138', '150210', 'SANTA CRUZ');
INSERT INTO `distritos` VALUES ('1432', '138', '150211', 'TNTE CESAR LOPEZ ROJAS');
INSERT INTO `distritos` VALUES ('1433', '139', '150301', 'NAUTA');
INSERT INTO `distritos` VALUES ('1434', '139', '150302', 'PARINARI');
INSERT INTO `distritos` VALUES ('1435', '139', '150303', 'TIGRE');
INSERT INTO `distritos` VALUES ('1436', '139', '150304', 'URARINAS');
INSERT INTO `distritos` VALUES ('1437', '139', '150305', 'TROMPETEROS');
INSERT INTO `distritos` VALUES ('1438', '140', '150401', 'REQUENA');
INSERT INTO `distritos` VALUES ('1439', '140', '150402', 'ALTO TAPICHE');
INSERT INTO `distritos` VALUES ('1440', '140', '150403', 'CAPELO');
INSERT INTO `distritos` VALUES ('1441', '140', '150404', 'EMILIO SAN MARTIN');
INSERT INTO `distritos` VALUES ('1442', '140', '150405', 'MAQUIA');
INSERT INTO `distritos` VALUES ('1443', '140', '150406', 'PUINAHUA');
INSERT INTO `distritos` VALUES ('1444', '140', '150407', 'SAQUENA');
INSERT INTO `distritos` VALUES ('1445', '140', '150408', 'SOPLIN');
INSERT INTO `distritos` VALUES ('1446', '140', '150409', 'TAPICHE');
INSERT INTO `distritos` VALUES ('1447', '140', '150410', 'JENARO HERRERA');
INSERT INTO `distritos` VALUES ('1448', '140', '150411', 'YAQUERANA');
INSERT INTO `distritos` VALUES ('1449', '141', '150501', 'CONTAMANA');
INSERT INTO `distritos` VALUES ('1450', '141', '150502', 'VARGAS GUERRA');
INSERT INTO `distritos` VALUES ('1451', '141', '150503', 'PADRE MARQUEZ');
INSERT INTO `distritos` VALUES ('1452', '141', '150504', 'PAMPA HERMOZA');
INSERT INTO `distritos` VALUES ('1453', '141', '150505', 'SARAYACU');
INSERT INTO `distritos` VALUES ('1454', '141', '150506', 'INAHUAYA');
INSERT INTO `distritos` VALUES ('1455', '142', '150601', 'MARISCAL RAMON CASTILLA');
INSERT INTO `distritos` VALUES ('1456', '142', '150602', 'PEBAS');
INSERT INTO `distritos` VALUES ('1457', '142', '150603', 'YAVARI');
INSERT INTO `distritos` VALUES ('1458', '142', '150604', 'SAN PABLO');
INSERT INTO `distritos` VALUES ('1459', '143', '150701', 'BARRANCA');
INSERT INTO `distritos` VALUES ('1460', '143', '150702', 'ANDOAS');
INSERT INTO `distritos` VALUES ('1461', '143', '150703', 'CAHUAPANAS');
INSERT INTO `distritos` VALUES ('1462', '143', '150704', 'MANSERICHE');
INSERT INTO `distritos` VALUES ('1463', '143', '150705', 'MORONA');
INSERT INTO `distritos` VALUES ('1464', '143', '150706', 'PASTAZA');
INSERT INTO `distritos` VALUES ('1465', '144', '160101', 'TAMBOPATA');
INSERT INTO `distritos` VALUES ('1466', '144', '160102', 'INAMBARI');
INSERT INTO `distritos` VALUES ('1467', '144', '160103', 'LAS PIEDRAS');
INSERT INTO `distritos` VALUES ('1468', '144', '160104', 'LABERINTO');
INSERT INTO `distritos` VALUES ('1469', '145', '160201', 'MANU');
INSERT INTO `distritos` VALUES ('1470', '145', '160202', 'FITZCARRALD');
INSERT INTO `distritos` VALUES ('1471', '145', '160203', 'MADRE DE DIOS');
INSERT INTO `distritos` VALUES ('1472', '145', '160204', 'HUEPETUHE');
INSERT INTO `distritos` VALUES ('1473', '146', '160301', 'INAPARI');
INSERT INTO `distritos` VALUES ('1474', '146', '160302', 'IBERIA');
INSERT INTO `distritos` VALUES ('1475', '146', '160303', 'TAHUAMANU');
INSERT INTO `distritos` VALUES ('1476', '147', '170101', 'MOQUEGUA');
INSERT INTO `distritos` VALUES ('1477', '147', '170102', 'CARUMAS');
INSERT INTO `distritos` VALUES ('1478', '147', '170103', 'CUCHUMBAYA');
INSERT INTO `distritos` VALUES ('1479', '147', '170104', 'SAN CRISTOBAL');
INSERT INTO `distritos` VALUES ('1480', '147', '170105', 'TORATA');
INSERT INTO `distritos` VALUES ('1481', '147', '170106', 'SAMEGUA');
INSERT INTO `distritos` VALUES ('1482', '148', '170201', 'OMATE');
INSERT INTO `distritos` VALUES ('1483', '148', '170202', 'COALAQUE');
INSERT INTO `distritos` VALUES ('1484', '148', '170203', 'CHOJATA');
INSERT INTO `distritos` VALUES ('1485', '148', '170204', 'ICHUNA');
INSERT INTO `distritos` VALUES ('1486', '148', '170205', 'LA CAPILLA');
INSERT INTO `distritos` VALUES ('1487', '148', '170206', 'LLOQUE');
INSERT INTO `distritos` VALUES ('1488', '148', '170207', 'MATALAQUE');
INSERT INTO `distritos` VALUES ('1489', '148', '170208', 'PUQUINA');
INSERT INTO `distritos` VALUES ('1490', '148', '170209', 'QUINISTAQUILLAS');
INSERT INTO `distritos` VALUES ('1491', '148', '170210', 'UBINAS');
INSERT INTO `distritos` VALUES ('1492', '148', '170211', 'YUNGA');
INSERT INTO `distritos` VALUES ('1493', '149', '170301', 'ILO');
INSERT INTO `distritos` VALUES ('1494', '149', '170302', 'EL ALGARROBAL');
INSERT INTO `distritos` VALUES ('1495', '149', '170303', 'PACOCHA');
INSERT INTO `distritos` VALUES ('1496', '150', '180101', 'CHAUPIMARCA');
INSERT INTO `distritos` VALUES ('1497', '150', '180103', 'HUACHON');
INSERT INTO `distritos` VALUES ('1498', '150', '180104', 'HUARIACA');
INSERT INTO `distritos` VALUES ('1499', '150', '180105', 'HUAYLLAY');
INSERT INTO `distritos` VALUES ('1500', '150', '180106', 'NINACACA');
INSERT INTO `distritos` VALUES ('1501', '150', '180107', 'PALLANCHACRA');
INSERT INTO `distritos` VALUES ('1502', '150', '180108', 'PAUCARTAMBO');
INSERT INTO `distritos` VALUES ('1503', '150', '180109', 'SAN FCO DE ASIS DE YARUSYACAN');
INSERT INTO `distritos` VALUES ('1504', '150', '180110', 'SIMON BOLIVAR');
INSERT INTO `distritos` VALUES ('1505', '150', '180111', 'TICLACAYAN');
INSERT INTO `distritos` VALUES ('1506', '150', '180112', 'TINYAHUARCO');
INSERT INTO `distritos` VALUES ('1507', '150', '180113', 'VICCO');
INSERT INTO `distritos` VALUES ('1508', '150', '180114', 'YANACANCHA');
INSERT INTO `distritos` VALUES ('1509', '151', '180201', 'YANAHUANCA');
INSERT INTO `distritos` VALUES ('1510', '151', '180202', 'CHACAYAN');
INSERT INTO `distritos` VALUES ('1511', '151', '180203', 'GOYLLARISQUIZGA');
INSERT INTO `distritos` VALUES ('1512', '151', '180204', 'PAUCAR');
INSERT INTO `distritos` VALUES ('1513', '151', '180205', 'SAN PEDRO DE PILLAO');
INSERT INTO `distritos` VALUES ('1514', '151', '180206', 'SANTA ANA DE TUSI');
INSERT INTO `distritos` VALUES ('1515', '151', '180207', 'TAPUC');
INSERT INTO `distritos` VALUES ('1516', '151', '180208', 'VILCABAMBA');
INSERT INTO `distritos` VALUES ('1517', '152', '180301', 'OXAPAMPA');
INSERT INTO `distritos` VALUES ('1518', '152', '180302', 'CHONTABAMBA');
INSERT INTO `distritos` VALUES ('1519', '152', '180303', 'HUANCABAMBA');
INSERT INTO `distritos` VALUES ('1520', '152', '180304', 'PUERTO BERMUDEZ');
INSERT INTO `distritos` VALUES ('1521', '152', '180305', 'VILLA RICA');
INSERT INTO `distritos` VALUES ('1522', '152', '180306', 'POZUZO');
INSERT INTO `distritos` VALUES ('1523', '152', '180307', 'PALCAZU');
INSERT INTO `distritos` VALUES ('1524', '153', '190101', 'PIURA');
INSERT INTO `distritos` VALUES ('1525', '153', '190103', 'CASTILLA');
INSERT INTO `distritos` VALUES ('1526', '153', '190104', 'CATACAOS');
INSERT INTO `distritos` VALUES ('1527', '153', '190105', 'LA ARENA');
INSERT INTO `distritos` VALUES ('1528', '153', '190106', 'LA UNION');
INSERT INTO `distritos` VALUES ('1529', '153', '190107', 'LAS LOMAS');
INSERT INTO `distritos` VALUES ('1530', '153', '190109', 'TAMBO GRANDE');
INSERT INTO `distritos` VALUES ('1531', '153', '190113', 'CURA MORI');
INSERT INTO `distritos` VALUES ('1532', '153', '190114', 'EL TALLAN');
INSERT INTO `distritos` VALUES ('1533', '154', '190201', 'AYABACA');
INSERT INTO `distritos` VALUES ('1534', '154', '190202', 'FRIAS');
INSERT INTO `distritos` VALUES ('1535', '154', '190203', 'LAGUNAS');
INSERT INTO `distritos` VALUES ('1536', '154', '190204', 'MONTERO');
INSERT INTO `distritos` VALUES ('1537', '154', '190205', 'PACAIPAMPA');
INSERT INTO `distritos` VALUES ('1538', '154', '190206', 'SAPILLICA');
INSERT INTO `distritos` VALUES ('1539', '154', '190207', 'SICCHEZ');
INSERT INTO `distritos` VALUES ('1540', '154', '190208', 'SUYO');
INSERT INTO `distritos` VALUES ('1541', '154', '190209', 'JILILI');
INSERT INTO `distritos` VALUES ('1542', '154', '190210', 'PAIMAS');
INSERT INTO `distritos` VALUES ('1543', '155', '190301', 'HUANCABAMBA');
INSERT INTO `distritos` VALUES ('1544', '155', '190302', 'CANCHAQUE');
INSERT INTO `distritos` VALUES ('1545', '155', '190303', 'HUARMACA');
INSERT INTO `distritos` VALUES ('1546', '155', '190304', 'SONDOR');
INSERT INTO `distritos` VALUES ('1547', '155', '190305', 'SONDORILLO');
INSERT INTO `distritos` VALUES ('1548', '155', '190306', 'EL CARMEN DE LA FRONTERA');
INSERT INTO `distritos` VALUES ('1549', '155', '190307', 'SAN MIGUEL DE EL FAIQUE');
INSERT INTO `distritos` VALUES ('1550', '155', '190308', 'LALAQUIZ');
INSERT INTO `distritos` VALUES ('1551', '156', '190401', 'CHULUCANAS');
INSERT INTO `distritos` VALUES ('1552', '156', '190402', 'BUENOS AIRES');
INSERT INTO `distritos` VALUES ('1553', '156', '190403', 'CHALACO');
INSERT INTO `distritos` VALUES ('1554', '156', '190404', 'MORROPON');
INSERT INTO `distritos` VALUES ('1555', '156', '190405', 'SALITRAL');
INSERT INTO `distritos` VALUES ('1556', '156', '190406', 'SANTA CATALINA DE MOSSA');
INSERT INTO `distritos` VALUES ('1557', '156', '190407', 'SANTO DOMINGO');
INSERT INTO `distritos` VALUES ('1558', '156', '190408', 'LA MATANZA');
INSERT INTO `distritos` VALUES ('1559', '156', '190409', 'YAMANGO');
INSERT INTO `distritos` VALUES ('1560', '156', '190410', 'SAN JUAN DE BIGOTE');
INSERT INTO `distritos` VALUES ('1561', '157', '190501', 'PAITA');
INSERT INTO `distritos` VALUES ('1562', '157', '190502', 'AMOTAPE');
INSERT INTO `distritos` VALUES ('1563', '157', '190503', 'ARENAL');
INSERT INTO `distritos` VALUES ('1564', '157', '190504', 'LA HUACA');
INSERT INTO `distritos` VALUES ('1565', '157', '190505', 'PUEBLO NUEVO DE COLAN');
INSERT INTO `distritos` VALUES ('1566', '157', '190506', 'TAMARINDO');
INSERT INTO `distritos` VALUES ('1567', '157', '190507', 'VICHAYAL');
INSERT INTO `distritos` VALUES ('1568', '158', '190601', 'SULLANA');
INSERT INTO `distritos` VALUES ('1569', '158', '190602', 'BELLAVISTA');
INSERT INTO `distritos` VALUES ('1570', '158', '190603', 'LANCONES');
INSERT INTO `distritos` VALUES ('1571', '158', '190604', 'MARCAVELICA');
INSERT INTO `distritos` VALUES ('1572', '158', '190605', 'MIGUEL CHECA');
INSERT INTO `distritos` VALUES ('1573', '158', '190606', 'QUERECOTILLO');
INSERT INTO `distritos` VALUES ('1574', '158', '190607', 'SALITRAL');
INSERT INTO `distritos` VALUES ('1575', '158', '190608', 'IGNACIO ESCUDERO');
INSERT INTO `distritos` VALUES ('1576', '159', '190701', 'PARINAS');
INSERT INTO `distritos` VALUES ('1577', '159', '190702', 'EL ALTO');
INSERT INTO `distritos` VALUES ('1578', '159', '190703', 'LA BREA');
INSERT INTO `distritos` VALUES ('1579', '159', '190704', 'LOBITOS');
INSERT INTO `distritos` VALUES ('1580', '159', '190705', 'MANCORA');
INSERT INTO `distritos` VALUES ('1581', '159', '190706', 'LOS ORGANOS');
INSERT INTO `distritos` VALUES ('1582', '160', '190801', 'SECHURA');
INSERT INTO `distritos` VALUES ('1583', '160', '190802', 'VICE');
INSERT INTO `distritos` VALUES ('1584', '160', '190803', 'BERNAL');
INSERT INTO `distritos` VALUES ('1585', '160', '190804', 'BELLAVISTA DE LA UNION');
INSERT INTO `distritos` VALUES ('1586', '160', '190805', 'CRISTO NOS VALGA');
INSERT INTO `distritos` VALUES ('1587', '160', '190806', 'RINCONADA LLICUAR');
INSERT INTO `distritos` VALUES ('1588', '161', '200101', 'PUNO');
INSERT INTO `distritos` VALUES ('1589', '161', '200102', 'ACORA');
INSERT INTO `distritos` VALUES ('1590', '161', '200103', 'ATUNCOLLA');
INSERT INTO `distritos` VALUES ('1591', '161', '200104', 'CAPACHICA');
INSERT INTO `distritos` VALUES ('1592', '161', '200105', 'COATA');
INSERT INTO `distritos` VALUES ('1593', '161', '200106', 'CHUCUITO');
INSERT INTO `distritos` VALUES ('1594', '161', '200107', 'HUATA');
INSERT INTO `distritos` VALUES ('1595', '161', '200108', 'MANAZO');
INSERT INTO `distritos` VALUES ('1596', '161', '200109', 'PAUCARCOLLA');
INSERT INTO `distritos` VALUES ('1597', '161', '200110', 'PICHACANI');
INSERT INTO `distritos` VALUES ('1598', '161', '200111', 'SAN ANTONIO');
INSERT INTO `distritos` VALUES ('1599', '161', '200112', 'TIQUILLACA');
INSERT INTO `distritos` VALUES ('1600', '161', '200113', 'VILQUE');
INSERT INTO `distritos` VALUES ('1601', '161', '200114', 'PLATERIA');
INSERT INTO `distritos` VALUES ('1602', '161', '200115', 'AMANTANI');
INSERT INTO `distritos` VALUES ('1603', '162', '200201', 'AZANGARO');
INSERT INTO `distritos` VALUES ('1604', '162', '200202', 'ACHAYA');
INSERT INTO `distritos` VALUES ('1605', '162', '200203', 'ARAPA');
INSERT INTO `distritos` VALUES ('1606', '162', '200204', 'ASILLO');
INSERT INTO `distritos` VALUES ('1607', '162', '200205', 'CAMINACA');
INSERT INTO `distritos` VALUES ('1608', '162', '200206', 'CHUPA');
INSERT INTO `distritos` VALUES ('1609', '162', '200207', 'JOSE DOMINGO CHOQUEHUANCA');
INSERT INTO `distritos` VALUES ('1610', '162', '200208', 'MUNANI');
INSERT INTO `distritos` VALUES ('1611', '162', '200210', 'POTONI');
INSERT INTO `distritos` VALUES ('1612', '162', '200212', 'SAMAN');
INSERT INTO `distritos` VALUES ('1613', '162', '200213', 'SAN ANTON');
INSERT INTO `distritos` VALUES ('1614', '162', '200214', 'SAN JOSE');
INSERT INTO `distritos` VALUES ('1615', '162', '200215', 'SAN JUAN DE SALINAS');
INSERT INTO `distritos` VALUES ('1616', '162', '200216', 'STGO DE PUPUJA');
INSERT INTO `distritos` VALUES ('1617', '162', '200217', 'TIRAPATA');
INSERT INTO `distritos` VALUES ('1618', '163', '200301', 'MACUSANI');
INSERT INTO `distritos` VALUES ('1619', '163', '200302', 'AJOYANI');
INSERT INTO `distritos` VALUES ('1620', '163', '200303', 'AYAPATA');
INSERT INTO `distritos` VALUES ('1621', '163', '200304', 'COASA');
INSERT INTO `distritos` VALUES ('1622', '163', '200305', 'CORANI');
INSERT INTO `distritos` VALUES ('1623', '163', '200306', 'CRUCERO');
INSERT INTO `distritos` VALUES ('1624', '163', '200307', 'ITUATA');
INSERT INTO `distritos` VALUES ('1625', '163', '200308', 'OLLACHEA');
INSERT INTO `distritos` VALUES ('1626', '163', '200309', 'SAN GABAN');
INSERT INTO `distritos` VALUES ('1627', '163', '200310', 'USICAYOS');
INSERT INTO `distritos` VALUES ('1628', '164', '200401', 'JULI');
INSERT INTO `distritos` VALUES ('1629', '164', '200402', 'DESAGUADERO');
INSERT INTO `distritos` VALUES ('1630', '164', '200403', 'HUACULLANI');
INSERT INTO `distritos` VALUES ('1631', '164', '200406', 'PISACOMA');
INSERT INTO `distritos` VALUES ('1632', '164', '200407', 'POMATA');
INSERT INTO `distritos` VALUES ('1633', '164', '200410', 'ZEPITA');
INSERT INTO `distritos` VALUES ('1634', '164', '200412', 'KELLUYO');
INSERT INTO `distritos` VALUES ('1635', '165', '200501', 'HUANCANE');
INSERT INTO `distritos` VALUES ('1636', '165', '200502', 'COJATA');
INSERT INTO `distritos` VALUES ('1637', '165', '200504', 'INCHUPALLA');
INSERT INTO `distritos` VALUES ('1638', '165', '200506', 'PUSI');
INSERT INTO `distritos` VALUES ('1639', '165', '200507', 'ROSASPATA');
INSERT INTO `distritos` VALUES ('1640', '165', '200508', 'TARACO');
INSERT INTO `distritos` VALUES ('1641', '165', '200509', 'VILQUE CHICO');
INSERT INTO `distritos` VALUES ('1642', '165', '200511', 'HUATASANI');
INSERT INTO `distritos` VALUES ('1643', '166', '200601', 'LAMPA');
INSERT INTO `distritos` VALUES ('1644', '166', '200602', 'CABANILLA');
INSERT INTO `distritos` VALUES ('1645', '166', '200603', 'CALAPUJA');
INSERT INTO `distritos` VALUES ('1646', '166', '200604', 'NICASIO');
INSERT INTO `distritos` VALUES ('1647', '166', '200605', 'OCUVIRI');
INSERT INTO `distritos` VALUES ('1648', '166', '200606', 'PALCA');
INSERT INTO `distritos` VALUES ('1649', '166', '200607', 'PARATIA');
INSERT INTO `distritos` VALUES ('1650', '166', '200608', 'PUCARA');
INSERT INTO `distritos` VALUES ('1651', '166', '200609', 'SANTA LUCIA');
INSERT INTO `distritos` VALUES ('1652', '166', '200610', 'VILAVILA');
INSERT INTO `distritos` VALUES ('1653', '167', '200701', 'AYAVIRI');
INSERT INTO `distritos` VALUES ('1654', '167', '200702', 'ANTAUTA');
INSERT INTO `distritos` VALUES ('1655', '167', '200703', 'CUPI');
INSERT INTO `distritos` VALUES ('1656', '167', '200704', 'LLALLI');
INSERT INTO `distritos` VALUES ('1657', '167', '200705', 'MACARI');
INSERT INTO `distritos` VALUES ('1658', '167', '200706', 'NUNOA');
INSERT INTO `distritos` VALUES ('1659', '167', '200707', 'ORURILLO');
INSERT INTO `distritos` VALUES ('1660', '167', '200708', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('1661', '167', '200709', 'UMACHIRI');
INSERT INTO `distritos` VALUES ('1662', '168', '200801', 'SANDIA');
INSERT INTO `distritos` VALUES ('1663', '168', '200803', 'CUYOCUYO');
INSERT INTO `distritos` VALUES ('1664', '168', '200804', 'LIMBANI');
INSERT INTO `distritos` VALUES ('1665', '168', '200805', 'PHARA');
INSERT INTO `distritos` VALUES ('1666', '168', '200806', 'PATAMBUCO');
INSERT INTO `distritos` VALUES ('1667', '168', '200807', 'QUIACA');
INSERT INTO `distritos` VALUES ('1668', '168', '200808', 'SAN JUAN DEL ORO');
INSERT INTO `distritos` VALUES ('1669', '168', '200810', 'YANAHUAYA');
INSERT INTO `distritos` VALUES ('1670', '168', '200811', 'ALTO INAMBARI');
INSERT INTO `distritos` VALUES ('1671', '168', '200812', 'SAN PEDRO DE PUTINA PUNCO');
INSERT INTO `distritos` VALUES ('1672', '169', '200901', 'JULIACA');
INSERT INTO `distritos` VALUES ('1673', '169', '200902', 'CABANA');
INSERT INTO `distritos` VALUES ('1674', '169', '200903', 'CABANILLAS');
INSERT INTO `distritos` VALUES ('1675', '169', '200904', 'CARACOTO');
INSERT INTO `distritos` VALUES ('1676', '170', '201001', 'YUNGUYO');
INSERT INTO `distritos` VALUES ('1677', '170', '201002', 'UNICACHI');
INSERT INTO `distritos` VALUES ('1678', '170', '201003', 'ANAPIA');
INSERT INTO `distritos` VALUES ('1679', '170', '201004', 'COPANI');
INSERT INTO `distritos` VALUES ('1680', '170', '201005', 'CUTURAPI');
INSERT INTO `distritos` VALUES ('1681', '170', '201006', 'OLLARAYA');
INSERT INTO `distritos` VALUES ('1682', '170', '201007', 'TINICACHI');
INSERT INTO `distritos` VALUES ('1683', '171', '201101', 'PUTINA');
INSERT INTO `distritos` VALUES ('1684', '171', '201102', 'PEDRO VILCA APAZA');
INSERT INTO `distritos` VALUES ('1685', '171', '201103', 'QUILCA PUNCU');
INSERT INTO `distritos` VALUES ('1686', '171', '201104', 'ANANEA');
INSERT INTO `distritos` VALUES ('1687', '171', '201105', 'SINA');
INSERT INTO `distritos` VALUES ('1688', '172', '201201', 'ILAVE');
INSERT INTO `distritos` VALUES ('1689', '172', '201202', 'PILCUYO');
INSERT INTO `distritos` VALUES ('1690', '172', '201203', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('1691', '172', '201204', 'CAPASO');
INSERT INTO `distritos` VALUES ('1692', '172', '201205', 'CONDURIRI');
INSERT INTO `distritos` VALUES ('1693', '173', '201301', 'MOHO');
INSERT INTO `distritos` VALUES ('1694', '173', '201302', 'CONIMA');
INSERT INTO `distritos` VALUES ('1695', '173', '201303', 'TILALI');
INSERT INTO `distritos` VALUES ('1696', '173', '201304', 'HUAYRAPATA');
INSERT INTO `distritos` VALUES ('1697', '174', '210101', 'MOYOBAMBA');
INSERT INTO `distritos` VALUES ('1698', '174', '210102', 'CALZADA');
INSERT INTO `distritos` VALUES ('1699', '174', '210103', 'HABANA');
INSERT INTO `distritos` VALUES ('1700', '174', '210104', 'JEPELACIO');
INSERT INTO `distritos` VALUES ('1701', '174', '210105', 'SORITOR');
INSERT INTO `distritos` VALUES ('1702', '174', '210106', 'YANTALO');
INSERT INTO `distritos` VALUES ('1703', '175', '210201', 'SAPOSOA');
INSERT INTO `distritos` VALUES ('1704', '175', '210202', 'PISCOYACU');
INSERT INTO `distritos` VALUES ('1705', '175', '210203', 'SACANCHE');
INSERT INTO `distritos` VALUES ('1706', '175', '210204', 'TINGO DE SAPOSOA');
INSERT INTO `distritos` VALUES ('1707', '175', '210205', 'ALTO SAPOSOA');
INSERT INTO `distritos` VALUES ('1708', '175', '210206', 'EL ESLABON');
INSERT INTO `distritos` VALUES ('1709', '176', '210301', 'LAMAS');
INSERT INTO `distritos` VALUES ('1710', '176', '210303', 'BARRANQUITA');
INSERT INTO `distritos` VALUES ('1711', '176', '210304', 'CAYNARACHI');
INSERT INTO `distritos` VALUES ('1712', '176', '210305', 'CUNUMBUQUI');
INSERT INTO `distritos` VALUES ('1713', '176', '210306', 'PINTO RECODO');
INSERT INTO `distritos` VALUES ('1714', '176', '210307', 'RUMISAPA');
INSERT INTO `distritos` VALUES ('1715', '176', '210311', 'SHANAO');
INSERT INTO `distritos` VALUES ('1716', '176', '210313', 'TABALOSOS');
INSERT INTO `distritos` VALUES ('1717', '176', '210314', 'ZAPATERO');
INSERT INTO `distritos` VALUES ('1718', '176', '210315', 'ALONSO DE ALVARADO');
INSERT INTO `distritos` VALUES ('1719', '176', '210316', 'SAN ROQUE DE CUMBAZA');
INSERT INTO `distritos` VALUES ('1720', '177', '210401', 'JUANJUI');
INSERT INTO `distritos` VALUES ('1721', '177', '210402', 'CAMPANILLA');
INSERT INTO `distritos` VALUES ('1722', '177', '210403', 'HUICUNGO');
INSERT INTO `distritos` VALUES ('1723', '177', '210404', 'PACHIZA');
INSERT INTO `distritos` VALUES ('1724', '177', '210405', 'PAJARILLO');
INSERT INTO `distritos` VALUES ('1725', '178', '210501', 'RIOJA');
INSERT INTO `distritos` VALUES ('1726', '178', '210502', 'POSIC');
INSERT INTO `distritos` VALUES ('1727', '178', '210503', 'YORONGOS');
INSERT INTO `distritos` VALUES ('1728', '178', '210504', 'YURACYACU');
INSERT INTO `distritos` VALUES ('1729', '178', '210505', 'NUEVA CAJAMARCA');
INSERT INTO `distritos` VALUES ('1730', '178', '210506', 'ELIAS SOPLIN');
INSERT INTO `distritos` VALUES ('1731', '178', '210507', 'SAN FERNANDO');
INSERT INTO `distritos` VALUES ('1732', '178', '210508', 'PARDO MIGUEL');
INSERT INTO `distritos` VALUES ('1733', '178', '210509', 'AWAJUN');
INSERT INTO `distritos` VALUES ('1734', '179', '210601', 'TARAPOTO');
INSERT INTO `distritos` VALUES ('1735', '179', '210602', 'ALBERTO LEVEAU');
INSERT INTO `distritos` VALUES ('1736', '179', '210604', 'CACATACHI');
INSERT INTO `distritos` VALUES ('1737', '179', '210606', 'CHAZUTA');
INSERT INTO `distritos` VALUES ('1738', '179', '210607', 'CHIPURANA');
INSERT INTO `distritos` VALUES ('1739', '179', '210608', 'EL PORVENIR');
INSERT INTO `distritos` VALUES ('1740', '179', '210609', 'HUIMBAYOC');
INSERT INTO `distritos` VALUES ('1741', '179', '210610', 'JUAN GUERRA');
INSERT INTO `distritos` VALUES ('1742', '179', '210611', 'MORALES');
INSERT INTO `distritos` VALUES ('1743', '179', '210612', 'PAPAPLAYA');
INSERT INTO `distritos` VALUES ('1744', '179', '210616', 'SAN ANTONIO');
INSERT INTO `distritos` VALUES ('1745', '179', '210619', 'SAUCE');
INSERT INTO `distritos` VALUES ('1746', '179', '210620', 'SHAPAJA');
INSERT INTO `distritos` VALUES ('1747', '179', '210621', 'LA BANDA DE SHILCAYO');
INSERT INTO `distritos` VALUES ('1748', '180', '210701', 'BELLAVISTA');
INSERT INTO `distritos` VALUES ('1749', '180', '210702', 'SAN RAFAEL');
INSERT INTO `distritos` VALUES ('1750', '180', '210703', 'SAN PABLO');
INSERT INTO `distritos` VALUES ('1751', '180', '210704', 'ALTO BIAVO');
INSERT INTO `distritos` VALUES ('1752', '180', '210705', 'HUALLAGA');
INSERT INTO `distritos` VALUES ('1753', '180', '210706', 'BAJO BIAVO');
INSERT INTO `distritos` VALUES ('1754', '181', '210801', 'TOCACHE');
INSERT INTO `distritos` VALUES ('1755', '181', '210802', 'NUEVO PROGRESO');
INSERT INTO `distritos` VALUES ('1756', '181', '210803', 'POLVORA');
INSERT INTO `distritos` VALUES ('1757', '181', '210804', 'SHUNTE');
INSERT INTO `distritos` VALUES ('1758', '181', '210805', 'UCHIZA');
INSERT INTO `distritos` VALUES ('1759', '182', '210901', 'PICOTA');
INSERT INTO `distritos` VALUES ('1760', '182', '210902', 'BUENOS AIRES');
INSERT INTO `distritos` VALUES ('1761', '182', '210903', 'CASPIZAPA');
INSERT INTO `distritos` VALUES ('1762', '182', '210904', 'PILLUANA');
INSERT INTO `distritos` VALUES ('1763', '182', '210905', 'PUCACACA');
INSERT INTO `distritos` VALUES ('1764', '182', '210906', 'SAN CRISTOBAL');
INSERT INTO `distritos` VALUES ('1765', '182', '210907', 'SAN HILARION');
INSERT INTO `distritos` VALUES ('1766', '182', '210908', 'TINGO DE PONASA');
INSERT INTO `distritos` VALUES ('1767', '182', '210909', 'TRES UNIDOS');
INSERT INTO `distritos` VALUES ('1768', '182', '210910', 'SHAMBOYACU');
INSERT INTO `distritos` VALUES ('1769', '183', '211001', 'SAN JOSE DE SISA');
INSERT INTO `distritos` VALUES ('1770', '183', '211002', 'AGUA BLANCA');
INSERT INTO `distritos` VALUES ('1771', '183', '211003', 'SHATOJA');
INSERT INTO `distritos` VALUES ('1772', '183', '211004', 'SAN MARTIN');
INSERT INTO `distritos` VALUES ('1773', '183', '211005', 'SANTA ROSA');
INSERT INTO `distritos` VALUES ('1774', '184', '220101', 'TACNA');
INSERT INTO `distritos` VALUES ('1775', '184', '220102', 'CALANA');
INSERT INTO `distritos` VALUES ('1776', '184', '220104', 'INCLAN');
INSERT INTO `distritos` VALUES ('1777', '184', '220107', 'PACHIA');
INSERT INTO `distritos` VALUES ('1778', '184', '220108', 'PALCA');
INSERT INTO `distritos` VALUES ('1779', '184', '220109', 'POCOLLAY');
INSERT INTO `distritos` VALUES ('1780', '184', '220110', 'SAMA');
INSERT INTO `distritos` VALUES ('1781', '184', '220111', 'ALTO DE LA ALIANZA');
INSERT INTO `distritos` VALUES ('1782', '184', '220112', 'CIUDAD NUEVA');
INSERT INTO `distritos` VALUES ('1783', '184', '220113', 'CORONEL GREGORIO ALBARRACIN L.ALFONSO UGARTE');
INSERT INTO `distritos` VALUES ('1784', '185', '220201', 'TARATA');
INSERT INTO `distritos` VALUES ('1785', '185', '220205', 'CHUCATAMANI');
INSERT INTO `distritos` VALUES ('1786', '185', '220206', 'ESTIQUE');
INSERT INTO `distritos` VALUES ('1787', '185', '220207', 'ESTIQUE PAMPA');
INSERT INTO `distritos` VALUES ('1788', '185', '220210', 'SITAJARA');
INSERT INTO `distritos` VALUES ('1789', '185', '220211', 'SUSAPAYA');
INSERT INTO `distritos` VALUES ('1790', '185', '220212', 'TARUCACHI');
INSERT INTO `distritos` VALUES ('1791', '185', '220213', 'TICACO');
INSERT INTO `distritos` VALUES ('1792', '186', '220301', 'LOCUMBA');
INSERT INTO `distritos` VALUES ('1793', '186', '220302', 'ITE');
INSERT INTO `distritos` VALUES ('1794', '186', '220303', 'ILABAYA');
INSERT INTO `distritos` VALUES ('1795', '187', '220401', 'CANDARAVE');
INSERT INTO `distritos` VALUES ('1796', '187', '220402', 'CAIRANI');
INSERT INTO `distritos` VALUES ('1797', '187', '220403', 'CURIBAYA');
INSERT INTO `distritos` VALUES ('1798', '187', '220404', 'HUANUARA');
INSERT INTO `distritos` VALUES ('1799', '187', '220405', 'QUILAHUANI');
INSERT INTO `distritos` VALUES ('1800', '187', '220406', 'CAMILACA');
INSERT INTO `distritos` VALUES ('1801', '188', '230101', 'TUMBES');
INSERT INTO `distritos` VALUES ('1802', '188', '230102', 'CORRALES');
INSERT INTO `distritos` VALUES ('1803', '188', '230103', 'LA CRUZ');
INSERT INTO `distritos` VALUES ('1804', '188', '230104', 'PAMPAS DE HOSPITAL');
INSERT INTO `distritos` VALUES ('1805', '188', '230105', 'SAN JACINTO');
INSERT INTO `distritos` VALUES ('1806', '188', '230106', 'SAN JUAN DE LA VIRGEN');
INSERT INTO `distritos` VALUES ('1807', '189', '230201', 'ZORRITOS');
INSERT INTO `distritos` VALUES ('1808', '189', '230202', 'CASITAS');
INSERT INTO `distritos` VALUES ('1809', '189', '230203', 'CANOAS DE PUNTA SAL');
INSERT INTO `distritos` VALUES ('1810', '190', '230301', 'ZARUMILLA');
INSERT INTO `distritos` VALUES ('1811', '190', '230302', 'MATAPALO');
INSERT INTO `distritos` VALUES ('1812', '190', '230303', 'PAPAYAL');
INSERT INTO `distritos` VALUES ('1813', '190', '230304', 'AGUAS VERDES');
INSERT INTO `distritos` VALUES ('1814', '191', '240101', 'CALLAO');
INSERT INTO `distritos` VALUES ('1815', '191', '240102', 'BELLAVISTA');
INSERT INTO `distritos` VALUES ('1816', '191', '240103', 'LA PUNTA');
INSERT INTO `distritos` VALUES ('1817', '191', '240104', 'CARMEN DE LA LEGUA-REYNOSO');
INSERT INTO `distritos` VALUES ('1818', '191', '240105', 'LA PERLA');
INSERT INTO `distritos` VALUES ('1819', '191', '240106', 'VENTANILLA');
INSERT INTO `distritos` VALUES ('1820', '192', '250101', 'CALLERIA');
INSERT INTO `distritos` VALUES ('1821', '192', '250102', 'YARINACOCHA');
INSERT INTO `distritos` VALUES ('1822', '192', '250103', 'MASISEA');
INSERT INTO `distritos` VALUES ('1823', '192', '250104', 'CAMPOVERDE');
INSERT INTO `distritos` VALUES ('1824', '192', '250105', 'IPARIA');
INSERT INTO `distritos` VALUES ('1825', '192', '250106', 'NUEVA REQUENA');
INSERT INTO `distritos` VALUES ('1826', '192', '250107', 'MANANTAY');
INSERT INTO `distritos` VALUES ('1827', '193', '250201', 'PADRE ABAD');
INSERT INTO `distritos` VALUES ('1828', '193', '250202', 'YRAZOLA');
INSERT INTO `distritos` VALUES ('1829', '193', '250203', 'CURIMANA');
INSERT INTO `distritos` VALUES ('1830', '194', '250301', 'RAIMONDI');
INSERT INTO `distritos` VALUES ('1831', '194', '250302', 'TAHUANIA');
INSERT INTO `distritos` VALUES ('1832', '194', '250303', 'YURUA');
INSERT INTO `distritos` VALUES ('1833', '194', '250304', 'SEPAHUA');
INSERT INTO `distritos` VALUES ('1834', '195', '250401', 'PURUS');

-- ----------------------------
-- Table structure for escalafon
-- ----------------------------
DROP TABLE IF EXISTS `escalafon`;
CREATE TABLE `escalafon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activista_id` int(11) DEFAULT NULL,
  `cargo_estrategico_id` int(11) DEFAULT NULL,
  `grupo_persona_id` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `documento_inicio` varchar(150) DEFAULT NULL,
  `documento_final` varchar(150) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for escalafon_fichas
-- ----------------------------
DROP TABLE IF EXISTS `escalafon_fichas`;
CREATE TABLE `escalafon_fichas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `escalafon_id` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `desde` int(11) DEFAULT NULL,
  `hasta` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for escalafon_fichas_recepcion
-- ----------------------------
DROP TABLE IF EXISTS `escalafon_fichas_recepcion`;
CREATE TABLE `escalafon_fichas_recepcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `escalafon_ficha_id` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `fecha_recepcion` date DEFAULT NULL,
  `desde` int(11) DEFAULT NULL,
  `hasta` int(11) DEFAULT NULL,
  `buena` int(11) DEFAULT NULL,
  `mala` int(11) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for eventos
-- ----------------------------
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distrito_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `x` varchar(50) DEFAULT NULL,
  `y` varchar(50) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `e_grupo_id` (`grupo_id`),
  KEY `e_distrito_id` (`distrito_id`),
  CONSTRAINT `e_distrito_id` FOREIGN KEY (`distrito_id`) REFERENCES `distritos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `e_grupo_id` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of eventos
-- ----------------------------

-- ----------------------------
-- Table structure for fichas
-- ----------------------------
DROP TABLE IF EXISTS `fichas`;
CREATE TABLE `fichas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha` int(11) DEFAULT NULL,
  `escalafon_ficha_id` int(11) DEFAULT NULL,
  `escalafon_ficha_recepcion_id` int(11) DEFAULT NULL,
  `reniec_id` int(11) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `paterno` varchar(100) DEFAULT NULL,
  `materno` varchar(100) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `estado_ficha` int(1) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for firmas
-- ----------------------------
DROP TABLE IF EXISTS `firmas`;
CREATE TABLE `firmas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ficha` int(11) DEFAULT NULL,
  `dni` varchar(10) DEFAULT NULL,
  `estado_firma` int(1) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of firmas
-- ----------------------------

-- ----------------------------
-- Table structure for grupo_pregunta
-- ----------------------------
DROP TABLE IF EXISTS `grupo_pregunta`;
CREATE TABLE `grupo_pregunta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta_id` int(11) DEFAULT NULL,
  `grupo_id` int(11) DEFAULT NULL,
  `respuesta` longtext,
  `estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
-- ----------------------------
-- Table structure for grupos
-- ----------------------------
DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activista_id` int(11) NOT NULL,
  `distrito_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `fb_url` varchar(500) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `provincia` int(11) DEFAULT NULL,
  `distrito` int(11) DEFAULT NULL,
  `edad_desde` int(2) DEFAULT NULL,
  `edad_hasta` int(2) DEFAULT NULL,
  `sexo` varchar(100) DEFAULT NULL,
  `inactividad` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `g_activista_id` (`activista_id`),
  KEY `g_distrito` (`distrito_id`),
  CONSTRAINT `g_activista_id` FOREIGN KEY (`activista_id`) REFERENCES `activistas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `g_distrito` FOREIGN KEY (`distrito_id`) REFERENCES `distritos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for grupos_cargos
-- ----------------------------
DROP TABLE IF EXISTS `grupos_cargos`;
CREATE TABLE `grupos_cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_persona_id` int(11) DEFAULT NULL,
  `cargo_estrategico_id` int(11) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grupos_cargos
-- ----------------------------
INSERT INTO `grupos_cargos` VALUES ('2', '4', '23', '2016-06-21', '1', '2016-06-24 16:24:46', '2016-07-19 20:44:23', '3', '3');
INSERT INTO `grupos_cargos` VALUES ('4', '1', '23', '2029-06-16', '1', '2016-06-29 18:55:49', '2016-07-19 20:48:25', '3', '3');
INSERT INTO `grupos_cargos` VALUES ('5', '13', '23', '2016-07-12', '1', '2016-07-19 15:42:45', '2016-07-19 20:43:17', '3', '3');
INSERT INTO `grupos_cargos` VALUES ('6', '22', '23', '2016-07-20', '1', '2016-07-19 15:42:55', '2016-07-19 20:43:24', '3', '3');
INSERT INTO `grupos_cargos` VALUES ('8', '2', '23', '2016-07-19', '1', '2016-07-19 17:17:13', '2016-07-19 17:17:13', '3', null);
INSERT INTO `grupos_cargos` VALUES ('9', '3', '23', '2016-07-19', '1', '2016-07-19 17:17:25', '2016-07-19 17:17:25', '3', null);
INSERT INTO `grupos_cargos` VALUES ('10', '5', '23', '2016-07-19', '1', '2016-07-19 17:17:42', '2016-07-19 17:24:55', '3', '3');
INSERT INTO `grupos_cargos` VALUES ('11', '6', '23', '2016-07-19', '1', '2016-07-19 17:17:56', '2016-07-19 17:17:56', '3', null);
INSERT INTO `grupos_cargos` VALUES ('12', '7', '23', '2016-07-19', '1', '2016-07-19 17:18:06', '2016-07-19 20:29:45', '3', '3');
INSERT INTO `grupos_cargos` VALUES ('13', '8', '23', '2016-07-19', '1', '2016-07-19 17:18:17', '2016-07-19 20:29:51', '3', '3');
INSERT INTO `grupos_cargos` VALUES ('14', '9', '23', '2016-07-19', '1', '2016-07-19 17:20:42', '2016-07-19 17:20:42', '3', null);
INSERT INTO `grupos_cargos` VALUES ('15', '38', '2', '2016-07-21', '1', '2016-07-21 14:25:59', '2016-07-21 14:25:59', '3', null);
INSERT INTO `grupos_cargos` VALUES ('16', '38', '28', '2016-07-21', '1', '2016-07-21 14:26:26', '2016-07-21 14:26:26', '3', null);
INSERT INTO `grupos_cargos` VALUES ('17', '38', '10', '2016-07-21', '1', '2016-07-21 14:26:46', '2016-07-21 14:26:46', '3', null);
INSERT INTO `grupos_cargos` VALUES ('18', '38', '9', '2016-07-21', '1', '2016-07-21 14:27:12', '2016-07-21 14:27:12', '3', null);
INSERT INTO `grupos_cargos` VALUES ('20', '39', '28', '2016-07-21', '1', '2016-07-21 15:03:32', '2016-07-21 15:03:32', '3', null);
INSERT INTO `grupos_cargos` VALUES ('21', '39', '2', '2016-07-21', '1', '2016-07-21 15:03:50', '2016-07-21 15:03:50', '3', null);
INSERT INTO `grupos_cargos` VALUES ('22', '39', '9', '2016-07-28', '1', '2016-07-28 09:43:39', '2016-07-28 09:43:39', '3', null);
INSERT INTO `grupos_cargos` VALUES ('23', '7', '4', '2016-07-28', '1', '2016-07-28 09:56:40', '2016-07-28 09:56:40', '3', null);
INSERT INTO `grupos_cargos` VALUES ('24', '7', '21', '2016-07-28', '1', '2016-07-28 09:57:02', '2016-07-28 09:57:02', '3', null);
INSERT INTO `grupos_cargos` VALUES ('25', '41', '9', '2016-07-28', '1', '2016-07-28 11:41:36', '2016-07-28 11:41:36', '3', null);
INSERT INTO `grupos_cargos` VALUES ('26', '41', '27', '2016-07-28', '1', '2016-07-28 11:43:13', '2016-07-28 11:43:13', '3', null);

-- ----------------------------
-- Table structure for grupos_personas
-- ----------------------------
DROP TABLE IF EXISTS `grupos_personas`;
CREATE TABLE `grupos_personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_grupo_id` int(11) DEFAULT NULL,
  `distrito_id` int(11) DEFAULT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `localidad` varchar(150) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(500) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `estado` int(1) DEFAULT '1',
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of grupos_personas
-- ----------------------------
INSERT INTO `grupos_personas` VALUES ('1', '2', '1276', '127', '14', 'TAHUANTINSUYO ALTO', 'TAWA ALTO', '', '', '1', '3', '3', '2016-03-14 05:56:22', '2016-07-19 20:46:47');
INSERT INTO `grupos_personas` VALUES ('2', '2', '1276', '127', '14', 'TAHUANTINSUYO BAJO', 'TAWA BAJO', '', '', '1', '3', '3', '2016-03-14 07:15:40', '2016-07-19 20:47:23');
INSERT INTO `grupos_personas` VALUES ('3', '2', '1276', '127', '14', 'TUPAC AMARU ALTO', 'TUPAC AMARU ALTO', '', '', '1', '3', '3', '2016-03-16 17:48:48', '2016-07-19 19:35:13');
INSERT INTO `grupos_personas` VALUES ('4', '2', '1276', '127', '14', 'TUPAC AMARU MEDIO', 'TUPAC AMARU MEDIO', '', '', '1', '3', '3', '2016-03-16 17:48:59', '2016-07-19 19:34:55');
INSERT INTO `grupos_personas` VALUES ('5', '2', '1276', '127', '14', 'TUPAC AMARU BAJO', 'TUPAC AMARU BAJO', '', '', '1', '3', '3', '2016-03-16 17:49:12', '2016-07-19 19:35:31');
INSERT INTO `grupos_personas` VALUES ('6', '2', '1276', '127', '14', 'INDEPENDENCIA', 'INDEPENDENCIA', '', '', '1', '3', '3', '2016-03-16 17:49:41', '2016-07-19 15:27:16');
INSERT INTO `grupos_personas` VALUES ('7', '2', '1276', '127', '14', 'ERMITAÑO ALTO', 'ERMIT ALTO', '', '', '1', '3', '3', '2016-03-16 17:50:03', '2016-07-19 15:26:48');
INSERT INTO `grupos_personas` VALUES ('8', '2', '1276', '127', '14', 'ERMITAÑO BAJO', 'ERMIT BAJO', '', '', '1', '3', '3', '2016-03-16 17:50:25', '2016-07-19 15:24:37');
INSERT INTO `grupos_personas` VALUES ('9', '2', '1276', '127', '14', 'UNIFICADA ALTO', 'UNIFICADA ALTO', '', '', '1', '3', '3', '2016-03-16 17:50:45', '2016-07-19 20:46:16');
INSERT INTO `grupos_personas` VALUES ('10', '1', null, null, null, null, 'Clubes de Madres', '', '', '1', '3', '3', '2016-06-24 08:50:51', '2016-07-19 19:11:30');
INSERT INTO `grupos_personas` VALUES ('11', '1', null, null, null, null, 'Cocinas Familiares', '', '', '1', '3', '3', '2016-06-29 13:00:42', '2016-07-19 19:12:07');
INSERT INTO `grupos_personas` VALUES ('12', '3', null, null, null, null, 'Derecho y Cien Polít', '', '', '0', '3', '3', '2016-06-29 13:58:44', '2016-07-28 09:31:35');
INSERT INTO `grupos_personas` VALUES ('13', '3', null, null, null, null, 'Ingenieros', '', '', '0', '3', '3', '2016-06-29 13:58:58', '2016-07-28 09:31:37');
INSERT INTO `grupos_personas` VALUES ('14', '3', null, null, null, null, 'Ciencias Médicas', '', '', '0', '3', '3', '2016-06-29 14:00:57', '2016-07-28 09:31:39');
INSERT INTO `grupos_personas` VALUES ('15', '3', null, null, null, null, 'Profesores', '', '', '0', '3', '3', '2016-06-29 14:01:32', '2016-07-28 09:31:41');
INSERT INTO `grupos_personas` VALUES ('16', '3', null, null, null, null, 'Ciencias empresariales', '', '', '0', '3', '3', '2016-06-29 14:03:12', '2016-07-28 09:31:43');
INSERT INTO `grupos_personas` VALUES ('17', '3', null, null, null, null, 'Servicios Turis Hotel y Gastronómicas', '', '', '0', '3', '3', '2016-06-29 14:05:10', '2016-07-28 09:31:45');
INSERT INTO `grupos_personas` VALUES ('18', '3', null, null, null, null, 'Ciencias Eco Cont y Financ', '', '', '0', '3', '3', '2016-06-29 14:08:15', '2016-07-28 09:31:48');
INSERT INTO `grupos_personas` VALUES ('19', '3', null, null, null, null, 'Ciencias Sociales', '', '', '0', '3', '3', '2016-06-29 14:13:30', '2016-07-28 09:31:54');
INSERT INTO `grupos_personas` VALUES ('20', '4', null, null, null, null, 'Org. de Comerciantes Ambulantes', '', '', '0', '3', '3', '2016-06-29 14:20:07', '2016-07-28 09:32:08');
INSERT INTO `grupos_personas` VALUES ('21', '4', null, null, null, null, 'Org. de Transportistas', '', '', '0', '3', '3', '2016-06-29 14:20:38', '2016-07-28 09:32:21');
INSERT INTO `grupos_personas` VALUES ('22', '4', null, null, null, null, 'Org. de Artesanos', '', '', '0', '3', '3', '2016-06-29 14:20:54', '2016-07-28 09:32:32');
INSERT INTO `grupos_personas` VALUES ('23', '4', null, null, null, null, 'Confeccionistas', '', '', '0', '3', '3', '2016-06-29 18:34:33', '2016-07-28 09:32:38');
INSERT INTO `grupos_personas` VALUES ('24', '4', null, null, null, null, 'Restauranteros', '', '', '0', '3', '3', '2016-06-29 18:34:55', '2016-07-28 09:32:42');
INSERT INTO `grupos_personas` VALUES ('25', '1', null, null, null, null, 'Vaso de Leche', '', '', '1', '3', null, '2016-07-19 18:02:38', '2016-07-19 18:02:38');
INSERT INTO `grupos_personas` VALUES ('26', '1', null, null, null, null, 'Comedor Popular', '', '', '1', '3', null, '2016-07-19 18:04:07', '2016-07-19 18:04:07');
INSERT INTO `grupos_personas` VALUES ('27', '1', null, null, null, null, 'Centro Materno Infantil', '', '', '1', '3', '3', '2016-07-19 18:05:45', '2016-07-19 19:12:42');
INSERT INTO `grupos_personas` VALUES ('28', '1', null, null, null, null, 'Centros Familiares', '', '', '1', '3', null, '2016-07-19 19:13:31', '2016-07-19 19:13:31');
INSERT INTO `grupos_personas` VALUES ('29', '4', null, null, null, null, 'Org. de Comerc. de Mercados, de Galerías y otros', '', '', '0', '3', '3', '2016-07-19 19:14:56', '2016-07-28 09:32:49');
INSERT INTO `grupos_personas` VALUES ('30', '4', null, null, null, null, 'Org. de Trabajadores del Hogar', '', '', '0', '3', '3', '2016-07-19 19:15:27', '2016-07-28 09:32:54');
INSERT INTO `grupos_personas` VALUES ('31', '4', null, null, null, null, 'Org. de Canillitas y Expend. de Diarios y Revistas', '', '', '0', '3', '3', '2016-07-19 19:16:23', '2016-07-28 09:33:00');
INSERT INTO `grupos_personas` VALUES ('32', '4', null, null, null, null, 'Org. de Lustradores de Calzados', '', '', '0', '3', '3', '2016-07-19 19:17:15', '2016-07-28 09:33:05');
INSERT INTO `grupos_personas` VALUES ('33', '4', null, null, null, null, 'Org. de Estibadores', '', '', '0', '3', '3', '2016-07-19 19:17:35', '2016-07-28 09:33:09');
INSERT INTO `grupos_personas` VALUES ('34', '4', null, null, null, null, 'Org. de Recicladores', '', '', '0', '3', '3', '2016-07-19 19:17:52', '2016-07-28 09:33:18');
INSERT INTO `grupos_personas` VALUES ('35', '4', null, null, null, null, 'Org. de Transportistas', '', '', '0', '3', '3', '2016-07-19 19:18:11', '2016-07-28 09:33:51');
INSERT INTO `grupos_personas` VALUES ('36', '4', null, null, null, null, 'Org. de Emolienteros, Vivanderas y Comida al Paso', '', '', '0', '3', '3', '2016-07-19 19:18:49', '2016-07-28 09:33:43');
INSERT INTO `grupos_personas` VALUES ('37', '4', null, null, null, null, 'Org. de Pequeñas y Micro Empresas', '', '', '0', '3', '3', '2016-07-19 19:19:09', '2016-07-28 09:33:30');
INSERT INTO `grupos_personas` VALUES ('38', '22', '1279', '127', '14', 'URB. CHACARILLA DE OTERO', 'CCRF CHACARILLA DE OTERO', 'AV. PROCERES DE LA INDEPENDENCIA NRO 698', '3750497', '1', '3', '3', '2016-07-21 14:05:11', '2016-07-28 09:42:05');
INSERT INTO `grupos_personas` VALUES ('39', '22', '1279', '127', '14', 'URB. CAJA DE AGUA', 'CCRF CAJA DE AGUA', 'PJE. LAS MAGDOLIAS 1015', '7589685', '1', '3', '3', '2016-07-21 14:36:39', '2016-07-28 09:42:17');
INSERT INTO `grupos_personas` VALUES ('40', '22', '1279', '127', '14', 'LA HUARONA', 'LA HUARONA', 'AV. PROCESRES 3737', '7895689', '1', '3', '3', '2016-07-21 16:24:56', '2016-07-28 09:42:36');
INSERT INTO `grupos_personas` VALUES ('41', '22', '1283', '127', '14', 'ETAPA 2 V ES', 'VILLA EL SAL V PP', 'AHKDASD', '546456456', '1', '3', null, '2016-07-28 11:40:24', '2016-07-28 11:40:24');

-- ----------------------------
-- Table structure for informe_eventos
-- ----------------------------
DROP TABLE IF EXISTS `informe_eventos`;
CREATE TABLE `informe_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activista_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `estado_evento` int(11) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ie_evento_id` (`evento_id`),
  KEY `ie_activista_id` (`activista_id`),
  CONSTRAINT `ie_activista_id` FOREIGN KEY (`activista_id`) REFERENCES `activistas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ie_evento_id` FOREIGN KEY (`evento_id`) REFERENCES `eventos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of informe_eventos
-- ----------------------------

-- ----------------------------
-- Table structure for mensajerias
-- ----------------------------
DROP TABLE IF EXISTS `mensajerias`;
CREATE TABLE `mensajerias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activista_id` int(11) DEFAULT NULL,
  `cel` int(1) DEFAULT '0',
  `email` int(1) DEFAULT '0',
  `validado` int(1) DEFAULT '0',
  `aceptado` int(1) DEFAULT '0',
  `nrollamada` int(11) DEFAULT '0',
  `estado` int(1) DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `men_activista_id` (`activista_id`) USING BTREE,
  CONSTRAINT `mensajerias_ibfk_1` FOREIGN KEY (`activista_id`) REFERENCES `activistas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mensajes
-- ----------------------------
DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` longtext,
  `asunto` varchar(500) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `activista_id` int(11) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `estado` char(1) DEFAULT '0' COMMENT 'si esta respondido o no',
  `created_at` datetime DEFAULT NULL,
  `reponsed_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `activo` char(50) DEFAULT '1',
  `archivo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `ruta` varchar(100) DEFAULT NULL,
  `class_icono` varchar(50) NOT NULL COMMENT 'Clase del icono a mostrar',
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'Procesos', 'proceso', 'fa-gears', '1', '2015-10-18 20:58:53', null, '1', null);
INSERT INTO `menus` VALUES ('2', 'Mantenimiento', 'mantenimiento', 'fa-table', '1', '2015-10-18 20:58:53', null, '1', null);
INSERT INTO `menus` VALUES ('3', 'Reportes', 'reporte', 'fa-list-alt', '1', '2015-10-18 20:58:53', null, '1', null);

-- ----------------------------
-- Table structure for niveles
-- ----------------------------
DROP TABLE IF EXISTS `niveles`;
CREATE TABLE `niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of niveles
-- ----------------------------
INSERT INTO `niveles` VALUES ('1', 'Blanco', '1', '2016-01-07 16:34:41', null, '1', null);

-- ----------------------------
-- Table structure for opciones
-- ----------------------------
DROP TABLE IF EXISTS `opciones`;
CREATE TABLE `opciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `visible` int(1) DEFAULT '1',
  `estado` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `o_menu_id_idx` (`menu_id`) USING BTREE,
  CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of opciones
-- ----------------------------
INSERT INTO `opciones` VALUES ('1', '1', 'Mi Perfil', 'perfilView', '1', '0', '2015-10-18 21:10:17', null, '1', null);
INSERT INTO `opciones` VALUES ('2', '1', 'Editar Perfil', 'perfil', '0', '0', '2015-10-18 21:10:17', null, '1', null);
INSERT INTO `opciones` VALUES ('3', '1', 'Registrar textoSeguir', 'seguidor', '1', '1', '2015-10-18 21:10:17', null, '1', null);
INSERT INTO `opciones` VALUES ('4', '1', 'Gestionar Fan Pages', 'misgrupos', '1', '1', '2015-10-18 21:10:17', null, '1', null);
INSERT INTO `opciones` VALUES ('5', '1', 'Mensajes', 'comunicacion', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('22', '2', 'Gestión Niveles de Redes Sociales', 'cargo', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('23', '2', 'Gestión Personas', 'persona', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('24', '1', 'Respuestas', 'respuestas', '1', '0', null, null, null, null);
INSERT INTO `opciones` VALUES ('25', '3', 'Rep. Miembros', 'pornivel', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('26', '3', 'Rep. Consolidado', 'consolidadonivel', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('27', '3', 'Rep. Fan Page', 'fanpage', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('28', '2', 'Tipo Equipo', 'tipogrupopersona', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('29', '2', 'Gestionar Estructura Organizacional', 'grupopersona', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('30', '1', 'Asignar Grupo', 'asignargrupo', '1', '0', null, null, null, null);
INSERT INTO `opciones` VALUES ('31', '3', 'Rep. Miembros por Equipos', 'pornivelgrupo', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('32', '2', 'Editar Celular y Email', 'porniveledit', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('33', '2', 'Validar Celular y Email', 'pornivelvalida', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('34', '3', 'Rep. Consolidado por Equipo', 'consolidadogrupo', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('35', '2', 'Gestión de Escalafón de Personas', 'personaescalafon', '1', '1', '2016-07-04 00:00:00', null, '1', null);
INSERT INTO `opciones` VALUES ('37', '1', 'Fichas - Entregar', 'entregarfirma', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('38', '1', 'Fichas - Recepcionar', 'recepcionarfirma', '1', '1', null, null, null, null);
INSERT INTO `opciones` VALUES ('39', '1', 'Fichas - Validar Persona', 'validarfirma', '1', '0', null, null, null, null);
INSERT INTO `opciones` VALUES ('40', '1', 'Fichas - Validar Firma ', 'validarficha', '1', '1', null, null, null, null);

-- ----------------------------
-- Table structure for preguntas
-- ----------------------------
DROP TABLE IF EXISTS `preguntas`;
CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(500) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of preguntas
-- ----------------------------
INSERT INTO `preguntas` VALUES ('1', 'Comida y bebida', '1');
INSERT INTO `preguntas` VALUES ('2', 'Compras y moda', '1');
INSERT INTO `preguntas` VALUES ('3', 'Deportes y actividades al aire libre', '1');
INSERT INTO `preguntas` VALUES ('4', 'Entretenimiento', '1');
INSERT INTO `preguntas` VALUES ('5', 'Familia y relaciones', '1');
INSERT INTO `preguntas` VALUES ('6', 'FItnes y bienestar', '1');
INSERT INTO `preguntas` VALUES ('7', 'Negocios e industria', '1');
INSERT INTO `preguntas` VALUES ('8', 'Pasatiempo y actividades', '1');
INSERT INTO `preguntas` VALUES ('9', 'Tecnología', '1');

-- ----------------------------
-- Table structure for provincias
-- ----------------------------
DROP TABLE IF EXISTS `provincias`;
CREATE TABLE `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento_id` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iddepartamento` (`departamento_id`),
  CONSTRAINT `p_departamento_id` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of provincias
-- ----------------------------
INSERT INTO `provincias` VALUES ('1', '1', 'CHACHAPOYAS');
INSERT INTO `provincias` VALUES ('2', '1', 'BAGUA');
INSERT INTO `provincias` VALUES ('3', '1', 'BONGARA');
INSERT INTO `provincias` VALUES ('4', '1', 'LUYA');
INSERT INTO `provincias` VALUES ('5', '1', 'RODRIGUEZ DE MENDOZA');
INSERT INTO `provincias` VALUES ('6', '1', 'CONDORCANQUI');
INSERT INTO `provincias` VALUES ('7', '1', 'UTCUBAMBA');
INSERT INTO `provincias` VALUES ('8', '2', 'HUARAZ');
INSERT INTO `provincias` VALUES ('9', '2', 'AIJA');
INSERT INTO `provincias` VALUES ('10', '2', 'BOLOGNESI');
INSERT INTO `provincias` VALUES ('11', '2', 'CARHUAZ');
INSERT INTO `provincias` VALUES ('12', '2', 'CASMA');
INSERT INTO `provincias` VALUES ('13', '2', 'CORONGO');
INSERT INTO `provincias` VALUES ('14', '2', 'HUAYLAS');
INSERT INTO `provincias` VALUES ('15', '2', 'HUARI');
INSERT INTO `provincias` VALUES ('16', '2', 'MARISCAL LUZURIAGA');
INSERT INTO `provincias` VALUES ('17', '2', 'PALLASCA');
INSERT INTO `provincias` VALUES ('18', '2', 'POMABAMBA');
INSERT INTO `provincias` VALUES ('19', '2', 'RECUAY');
INSERT INTO `provincias` VALUES ('20', '2', 'SANTA');
INSERT INTO `provincias` VALUES ('21', '2', 'SIHUAS');
INSERT INTO `provincias` VALUES ('22', '2', 'YUNGAY');
INSERT INTO `provincias` VALUES ('23', '2', 'ANTONIO RAIMONDI');
INSERT INTO `provincias` VALUES ('24', '2', 'CARLOS FERMIN FITZCARRALD');
INSERT INTO `provincias` VALUES ('25', '2', 'ASUNCION');
INSERT INTO `provincias` VALUES ('26', '2', 'HUARMEY');
INSERT INTO `provincias` VALUES ('27', '2', 'OCROS');
INSERT INTO `provincias` VALUES ('28', '3', 'ABANCAY');
INSERT INTO `provincias` VALUES ('29', '3', 'AYMARAES');
INSERT INTO `provincias` VALUES ('30', '3', 'ANDAHUAYLAS');
INSERT INTO `provincias` VALUES ('31', '3', 'ANTABAMBA');
INSERT INTO `provincias` VALUES ('32', '3', 'COTABAMBAS');
INSERT INTO `provincias` VALUES ('33', '3', 'GRAU');
INSERT INTO `provincias` VALUES ('34', '3', 'CHINCHEROS');
INSERT INTO `provincias` VALUES ('35', '4', 'AREQUIPA');
INSERT INTO `provincias` VALUES ('36', '4', 'CAYLLOMA');
INSERT INTO `provincias` VALUES ('37', '4', 'CAMANA');
INSERT INTO `provincias` VALUES ('38', '4', 'CARAVELI');
INSERT INTO `provincias` VALUES ('39', '4', 'CASTILLA');
INSERT INTO `provincias` VALUES ('40', '4', 'CONDESUYOS');
INSERT INTO `provincias` VALUES ('41', '4', 'ISLAY');
INSERT INTO `provincias` VALUES ('42', '4', 'LA UNION');
INSERT INTO `provincias` VALUES ('43', '5', 'HUAMANGA');
INSERT INTO `provincias` VALUES ('44', '5', 'CANGALLO');
INSERT INTO `provincias` VALUES ('45', '5', 'HUANTA');
INSERT INTO `provincias` VALUES ('46', '5', 'LA MAR');
INSERT INTO `provincias` VALUES ('47', '5', 'LUCANAS');
INSERT INTO `provincias` VALUES ('48', '5', 'PARINACOCHAS');
INSERT INTO `provincias` VALUES ('49', '5', 'VICTOR FAJARDO');
INSERT INTO `provincias` VALUES ('50', '5', 'HUANCA SANCOS');
INSERT INTO `provincias` VALUES ('51', '5', 'VILCAS HUAMAN');
INSERT INTO `provincias` VALUES ('52', '5', 'PAUCAR DEL SARA SARA');
INSERT INTO `provincias` VALUES ('53', '5', 'SUCRE');
INSERT INTO `provincias` VALUES ('54', '6', 'CAJAMARCA');
INSERT INTO `provincias` VALUES ('55', '6', 'CAJABAMBA');
INSERT INTO `provincias` VALUES ('56', '6', 'CELENDIN');
INSERT INTO `provincias` VALUES ('57', '6', 'CONTUMAZA');
INSERT INTO `provincias` VALUES ('58', '6', 'CUTERVO');
INSERT INTO `provincias` VALUES ('59', '6', 'CHOTA');
INSERT INTO `provincias` VALUES ('60', '6', 'HUALGAYOC');
INSERT INTO `provincias` VALUES ('61', '6', 'JAEN');
INSERT INTO `provincias` VALUES ('62', '6', 'SANTA CRUZ');
INSERT INTO `provincias` VALUES ('63', '6', 'SAN MIGUEL');
INSERT INTO `provincias` VALUES ('64', '6', 'SAN IGNACIO');
INSERT INTO `provincias` VALUES ('65', '6', 'SAN MARCOS');
INSERT INTO `provincias` VALUES ('66', '6', 'SAN PABLO');
INSERT INTO `provincias` VALUES ('67', '7', 'CUSCO');
INSERT INTO `provincias` VALUES ('68', '7', 'ACOMAYO');
INSERT INTO `provincias` VALUES ('69', '7', 'ANTA');
INSERT INTO `provincias` VALUES ('70', '7', 'CALCA');
INSERT INTO `provincias` VALUES ('71', '7', 'CANAS');
INSERT INTO `provincias` VALUES ('72', '7', 'CANCHIS');
INSERT INTO `provincias` VALUES ('73', '7', 'CHUMBIVILCAS');
INSERT INTO `provincias` VALUES ('74', '7', 'ESPINAR');
INSERT INTO `provincias` VALUES ('75', '7', 'LA CONVENCION');
INSERT INTO `provincias` VALUES ('76', '7', 'PARURO');
INSERT INTO `provincias` VALUES ('77', '7', 'PAUCARTAMBO');
INSERT INTO `provincias` VALUES ('78', '7', 'QUISPICANCHIS');
INSERT INTO `provincias` VALUES ('79', '7', 'URUBAMBA');
INSERT INTO `provincias` VALUES ('80', '8', 'HUANCAVELICA');
INSERT INTO `provincias` VALUES ('81', '8', 'ACOBAMBA');
INSERT INTO `provincias` VALUES ('82', '8', 'ANGARAES');
INSERT INTO `provincias` VALUES ('83', '8', 'CASTROVIRREYNA');
INSERT INTO `provincias` VALUES ('84', '8', 'TAYACAJA');
INSERT INTO `provincias` VALUES ('85', '8', 'HUAYTARA');
INSERT INTO `provincias` VALUES ('86', '8', 'CHURCAMPA');
INSERT INTO `provincias` VALUES ('87', '9', 'HUANUCO');
INSERT INTO `provincias` VALUES ('88', '9', 'AMBO');
INSERT INTO `provincias` VALUES ('89', '9', 'DOS DE MAYO');
INSERT INTO `provincias` VALUES ('90', '9', 'HUAMALIES');
INSERT INTO `provincias` VALUES ('91', '9', 'MARANON');
INSERT INTO `provincias` VALUES ('92', '9', 'LEONCIO PRADO');
INSERT INTO `provincias` VALUES ('93', '9', 'PACHITEA');
INSERT INTO `provincias` VALUES ('94', '9', 'PUERTO INCA');
INSERT INTO `provincias` VALUES ('95', '9', 'HUACAYBAMBA');
INSERT INTO `provincias` VALUES ('96', '9', 'LAURICOCHA');
INSERT INTO `provincias` VALUES ('97', '9', 'YAROWILCA');
INSERT INTO `provincias` VALUES ('98', '10', 'ICA');
INSERT INTO `provincias` VALUES ('99', '10', 'CHINCHA');
INSERT INTO `provincias` VALUES ('100', '10', 'NAZCA');
INSERT INTO `provincias` VALUES ('101', '10', 'PISCO');
INSERT INTO `provincias` VALUES ('102', '10', 'PALPA');
INSERT INTO `provincias` VALUES ('103', '11', 'HUANCAYO');
INSERT INTO `provincias` VALUES ('104', '11', 'CONCEPCION');
INSERT INTO `provincias` VALUES ('105', '11', 'JAUJA');
INSERT INTO `provincias` VALUES ('106', '11', 'JUNIN');
INSERT INTO `provincias` VALUES ('107', '11', 'TARMA');
INSERT INTO `provincias` VALUES ('108', '11', 'YAULI');
INSERT INTO `provincias` VALUES ('109', '11', 'SATIPO');
INSERT INTO `provincias` VALUES ('110', '11', 'CHANCHAMAYO');
INSERT INTO `provincias` VALUES ('111', '11', 'CHUPACA');
INSERT INTO `provincias` VALUES ('112', '12', 'TRUJILLO');
INSERT INTO `provincias` VALUES ('113', '12', 'BOLIVAR');
INSERT INTO `provincias` VALUES ('114', '12', 'SANCHEZ CARRION');
INSERT INTO `provincias` VALUES ('115', '12', 'OTUZCO');
INSERT INTO `provincias` VALUES ('116', '12', 'PACASMAYO');
INSERT INTO `provincias` VALUES ('117', '12', 'PATAZ');
INSERT INTO `provincias` VALUES ('118', '12', 'SANTIAGO DE CHUCO');
INSERT INTO `provincias` VALUES ('119', '12', 'ASCOPE');
INSERT INTO `provincias` VALUES ('120', '12', 'CHEPEN');
INSERT INTO `provincias` VALUES ('121', '12', 'JULCAN');
INSERT INTO `provincias` VALUES ('122', '12', 'GRAN CHIMU');
INSERT INTO `provincias` VALUES ('123', '12', 'VIRU');
INSERT INTO `provincias` VALUES ('124', '13', 'CHICLAYO');
INSERT INTO `provincias` VALUES ('125', '13', 'FERRENAFE');
INSERT INTO `provincias` VALUES ('126', '13', 'LAMBAYEQUE');
INSERT INTO `provincias` VALUES ('127', '14', 'LIMA');
INSERT INTO `provincias` VALUES ('128', '14', 'CAJATAMBO');
INSERT INTO `provincias` VALUES ('129', '14', 'CANTA');
INSERT INTO `provincias` VALUES ('130', '14', 'CANETE');
INSERT INTO `provincias` VALUES ('131', '14', 'HUAURA');
INSERT INTO `provincias` VALUES ('132', '14', 'HUAROCHIRI');
INSERT INTO `provincias` VALUES ('133', '14', 'YAUYOS');
INSERT INTO `provincias` VALUES ('134', '14', 'HUARAL');
INSERT INTO `provincias` VALUES ('135', '14', 'BARRANCA');
INSERT INTO `provincias` VALUES ('136', '14', 'OYON');
INSERT INTO `provincias` VALUES ('137', '15', 'MAYNAS');
INSERT INTO `provincias` VALUES ('138', '15', 'ALTO AMAZONAS');
INSERT INTO `provincias` VALUES ('139', '15', 'LORETO');
INSERT INTO `provincias` VALUES ('140', '15', 'REQUENA');
INSERT INTO `provincias` VALUES ('141', '15', 'UCAYALI');
INSERT INTO `provincias` VALUES ('142', '15', 'MARISCAL RAMON CASTILLA');
INSERT INTO `provincias` VALUES ('143', '15', 'DATEM DEL MARA�ON');
INSERT INTO `provincias` VALUES ('144', '16', 'TAMBOPATA');
INSERT INTO `provincias` VALUES ('145', '16', 'MANU');
INSERT INTO `provincias` VALUES ('146', '16', 'TAHUAMANU');
INSERT INTO `provincias` VALUES ('147', '17', 'MARISCAL NIETO');
INSERT INTO `provincias` VALUES ('148', '17', 'GENERAL SANCHEZ CERRO');
INSERT INTO `provincias` VALUES ('149', '17', 'ILO');
INSERT INTO `provincias` VALUES ('150', '18', 'PASCO');
INSERT INTO `provincias` VALUES ('151', '18', 'DANIEL ALCIDES CARRION');
INSERT INTO `provincias` VALUES ('152', '18', 'OXAPAMPA');
INSERT INTO `provincias` VALUES ('153', '19', 'PIURA');
INSERT INTO `provincias` VALUES ('154', '19', 'AYABACA');
INSERT INTO `provincias` VALUES ('155', '19', 'HUANCABAMBA');
INSERT INTO `provincias` VALUES ('156', '19', 'MORROPON');
INSERT INTO `provincias` VALUES ('157', '19', 'PAITA');
INSERT INTO `provincias` VALUES ('158', '19', 'SULLANA');
INSERT INTO `provincias` VALUES ('159', '19', 'TALARA');
INSERT INTO `provincias` VALUES ('160', '19', 'SECHURA');
INSERT INTO `provincias` VALUES ('161', '20', 'PUNO');
INSERT INTO `provincias` VALUES ('162', '20', 'AZANGARO');
INSERT INTO `provincias` VALUES ('163', '20', 'CARABAYA');
INSERT INTO `provincias` VALUES ('164', '20', 'CHUCUITO');
INSERT INTO `provincias` VALUES ('165', '20', 'HUANCANE');
INSERT INTO `provincias` VALUES ('166', '20', 'LAMPA');
INSERT INTO `provincias` VALUES ('167', '20', 'MELGAR');
INSERT INTO `provincias` VALUES ('168', '20', 'SANDIA');
INSERT INTO `provincias` VALUES ('169', '20', 'SAN ROMAN');
INSERT INTO `provincias` VALUES ('170', '20', 'YUNGUYO');
INSERT INTO `provincias` VALUES ('171', '20', 'SAN ANTONIO DE PUTINA');
INSERT INTO `provincias` VALUES ('172', '20', 'EL COLLAO');
INSERT INTO `provincias` VALUES ('173', '20', 'MOHO');
INSERT INTO `provincias` VALUES ('174', '21', 'MOYOBAMBA');
INSERT INTO `provincias` VALUES ('175', '21', 'HUALLAGA');
INSERT INTO `provincias` VALUES ('176', '21', 'LAMAS');
INSERT INTO `provincias` VALUES ('177', '21', 'MARISCAL CACERES');
INSERT INTO `provincias` VALUES ('178', '21', 'RIOJA');
INSERT INTO `provincias` VALUES ('179', '21', 'SAN MARTIN');
INSERT INTO `provincias` VALUES ('180', '21', 'BELLAVISTA');
INSERT INTO `provincias` VALUES ('181', '21', 'TOCACHE');
INSERT INTO `provincias` VALUES ('182', '21', 'PICOTA');
INSERT INTO `provincias` VALUES ('183', '21', 'EL DORADO');
INSERT INTO `provincias` VALUES ('184', '22', 'TACNA');
INSERT INTO `provincias` VALUES ('185', '22', 'TARATA');
INSERT INTO `provincias` VALUES ('186', '22', 'JORGE BASADRE');
INSERT INTO `provincias` VALUES ('187', '22', 'CANDARAVE');
INSERT INTO `provincias` VALUES ('188', '23', 'TUMBES');
INSERT INTO `provincias` VALUES ('189', '23', 'CONTRALMIRANTE VILLAR');
INSERT INTO `provincias` VALUES ('190', '23', 'ZARUMILLA');
INSERT INTO `provincias` VALUES ('191', '24', 'CALLAO');
INSERT INTO `provincias` VALUES ('192', '25', 'CORONEL PORTILLO');
INSERT INTO `provincias` VALUES ('193', '25', 'PADRE ABAD');
INSERT INTO `provincias` VALUES ('194', '25', 'ATALAYA');
INSERT INTO `provincias` VALUES ('195', '25', 'PURUS');

-- ----------------------------
-- Table structure for reniec
-- ----------------------------
DROP TABLE IF EXISTS `reniec`;
CREATE TABLE `reniec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paterno` varchar(100) DEFAULT NULL,
  `materno` varchar(100) DEFAULT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `ficha_id` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for respuestas
-- ----------------------------
DROP TABLE IF EXISTS `respuestas`;
CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje_id` int(11) DEFAULT NULL,
  `respondido_por` int(11) DEFAULT NULL,
  `respondido_at` datetime DEFAULT NULL,
  `respuesta` longtext,
  `estado` char(1) DEFAULT NULL,
  `tipo_acceso_id` int(11) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `url` int(1) DEFAULT '0',
  `archivo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of roles
-- ----------------------------

-- ----------------------------
-- Table structure for tipo_accesos
-- ----------------------------
DROP TABLE IF EXISTS `tipo_accesos`;
CREATE TABLE `tipo_accesos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acceso` varchar(400) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tipo_accesos
-- ----------------------------
INSERT INTO `tipo_accesos` VALUES ('1', 'al mismo activista', '1');
INSERT INTO `tipo_accesos` VALUES ('2', 'Todos', '1');

-- ----------------------------
-- Table structure for tipo_grupos_personas
-- ----------------------------
DROP TABLE IF EXISTS `tipo_grupos_personas`;
CREATE TABLE `tipo_grupos_personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `ubigeo` int(1) NOT NULL DEFAULT '1',
  `estado` int(1) DEFAULT '1',
  `usuario_created_at` int(11) DEFAULT NULL,
  `usuario_updated_at` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
