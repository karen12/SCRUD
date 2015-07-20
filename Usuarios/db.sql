CREATE DATABASE IF NOT EXISTS `crud_tipos_usuarios` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE `crud_usuarios`;

CREATE TABLE IF NOT EXISTS `tipos_usuarios` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`tipo` varchar(50) NOT NULL,
  	`descripcion` varchar(50) NOT NULL,
PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;