/*
SQLyog Ultimate v9.02 
MySQL - 5.5.5-10.4.13-MariaDB : Database - proyectolaravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `proyectolaravel`;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categorias_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`nombre`,`descripcion`,`condicion`,`created_at`,`updated_at`) values (1,'harinas','todas las harinas',1,NULL,NULL),(2,'pastas','todas las pastas',1,NULL,NULL),(3,'detergentes','todos los detergentes',1,'2019-04-25 18:14:31','2019-04-25 20:33:01'),(4,'refrescos','todos los refrescos',1,'2019-04-25 20:33:40','2019-04-25 20:33:40'),(5,'cervezas','todas las cervezas',1,'2019-04-26 23:08:12','2019-05-04 18:25:01');

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clientes_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `clientes` */

insert  into `clientes`(`id`,`nombre`,`tipo_documento`,`num_documento`,`direccion`,`telefono`,`email`,`created_at`,`updated_at`) values (0,'CLIENTE EVENTUAL','DNI','0','SIN ESPECIFICAR','SIN ESPECIFICAR','SIN ESPECIFICAR','2020-07-24 13:57:23',NULL),(1,'pedro','CEDULA','123456','av carlota','123456','pedro@gmail.com',NULL,NULL),(2,'daniel','CEDULA','123','av alemania','4569','daniel@gmail.com','2019-04-29 23:57:23','2019-04-30 00:23:09');

/*Table structure for table `compras` */

DROP TABLE IF EXISTS `compras`;

CREATE TABLE `compras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproveedor` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `tipo_identificacion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_compra` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `compras_idproveedor_foreign` (`idproveedor`),
  KEY `compras_idusuario_foreign` (`idusuario`),
  CONSTRAINT `compras_idproveedor_foreign` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`id`),
  CONSTRAINT `compras_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `compras` */

insert  into `compras`(`id`,`idproveedor`,`idusuario`,`tipo_identificacion`,`num_compra`,`fecha_compra`,`impuesto`,`total`,`estado`,`created_at`,`updated_at`) values (8,1,1,'FACTURA','1234','2020-07-24 00:00:00','12.00','2101.12','Registrado','2020-07-24 20:21:43','2020-07-24 20:21:43'),(9,1,1,'TICKET','0','2020-07-24 00:00:00','12.00','1881.60','Registrado','2020-07-24 20:23:59','2020-07-24 20:23:59'),(10,2,1,'TICKET','0','2020-07-24 00:00:00','12.00','840.00','Registrado','2020-07-24 20:39:02','2020-07-24 20:39:02'),(11,2,1,'FACTURA','12367','2020-07-24 00:00:00','12.00','1680.00','Registrado','2020-07-24 23:28:06','2020-07-24 23:28:06');

/*Table structure for table `detalle_compras` */

DROP TABLE IF EXISTS `detalle_compras`;

CREATE TABLE `detalle_compras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcompra` int(10) unsigned NOT NULL,
  `idproducto` int(10) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_compras_idcompra_foreign` (`idcompra`),
  KEY `detalle_compras_idproducto_foreign` (`idproducto`),
  CONSTRAINT `detalle_compras_idcompra_foreign` FOREIGN KEY (`idcompra`) REFERENCES `compras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `detalle_compras_idproducto_foreign` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalle_compras` */

insert  into `detalle_compras`(`id`,`idcompra`,`idproducto`,`cantidad`,`precio`) values (13,8,1,14,'134.00'),(14,9,3,12,'140.00'),(15,10,3,5,'150.00'),(16,11,2,10,'150.00');

/*Table structure for table `detalle_ventas` */

DROP TABLE IF EXISTS `detalle_ventas`;

CREATE TABLE `detalle_ventas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idventa` int(10) unsigned NOT NULL,
  `idproducto` int(10) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `descuento` decimal(4,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_ventas_idventa_foreign` (`idventa`),
  KEY `detalle_ventas_idproducto_foreign` (`idproducto`),
  CONSTRAINT `detalle_ventas_idproducto_foreign` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`),
  CONSTRAINT `detalle_ventas_idventa_foreign` FOREIGN KEY (`idventa`) REFERENCES `ventas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detalle_ventas` */

insert  into `detalle_ventas`(`id`,`idventa`,`idproducto`,`cantidad`,`precio`,`descuento`) values (14,9,3,5,'200.00','10.00'),(15,10,1,1,'190.00','0.00'),(16,10,3,3,'200.00','0.00'),(17,11,1,3,'190.00','0.00'),(18,12,2,5,'200.00','10.00'),(19,13,3,4,'200.00','0.00'),(20,13,1,2,'190.00','0.00');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_04_23_210438_create_categorias_table',1),(4,'2019_04_25_203705_create_productos_table',2),(5,'2019_04_29_144035_create_proveedores_table',3),(6,'2019_04_29_172617_create_clientes_table',4),(7,'2019_04_30_135525_create_roles_table',5),(8,'2019_04_30_000000_create_users_table',6),(9,'2019_05_03_141422_create_compras_table',7),(10,'2019_05_03_141516_create_detalle_compras_table',7),(11,'2019_05_04_193824_create_ventas_table',8),(12,'2019_05_04_193920_create_detalle_ventas_table',8);

/*Table structure for table `negocio` */

DROP TABLE IF EXISTS `negocio`;

CREATE TABLE `negocio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cuil` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

/*Data for the table `negocio` */

insert  into `negocio`(`id`,`razon_social`,`cuil`,`email`,`impuesto`,`direccion`,`telefono`) values (1,'Facundo','20389094367','facunditogarcia@gmail.com',12,'Pedro Goyena 1475','');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcategoria` int(10) unsigned NOT NULL,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_venta` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `imagen` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productos_nombre_unique` (`nombre`),
  KEY `productos_idcategoria_foreign` (`idcategoria`),
  CONSTRAINT `productos_idcategoria_foreign` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `productos` */

insert  into `productos`(`id`,`idcategoria`,`codigo`,`nombre`,`precio_venta`,`stock`,`condicion`,`imagen`,`created_at`,`updated_at`) values (1,1,'12345','harina de maiz','190.00',8,1,'1556309730.jpeg',NULL,'2020-07-24 20:37:57'),(2,1,'5666','harina de trigo','200.00',5,1,'1556309823.jpeg','2019-04-26 20:09:43','2020-07-24 23:28:29'),(3,5,'789','cerveza heineken','200.00',5,1,'1556309794.jpeg','2019-04-26 23:09:02','2020-07-24 20:37:39');

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proveedores_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `proveedores` */

insert  into `proveedores`(`id`,`nombre`,`tipo_documento`,`num_documento`,`direccion`,`telefono`,`email`,`created_at`,`updated_at`) values (1,'carlos','CEDULA','12345','av california','123655','carlos@gmail.com',NULL,NULL),(2,'luis','CEDULA','123456789','av new york','123456','luis@gmail.com','2019-04-29 19:51:44','2019-04-29 20:06:38');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`nombre`,`descripcion`,`condicion`) values (1,'Administrador','Administrador',1),(2,'Vendedor','Vendedor',1),(3,'Comprador','Comprador',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1,
  `idrol` int(10) unsigned NOT NULL,
  `imagen` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_usuario_unique` (`usuario`),
  KEY `users_idrol_foreign` (`idrol`),
  CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`nombre`,`tipo_documento`,`num_documento`,`direccion`,`telefono`,`email`,`usuario`,`password`,`condicion`,`idrol`,`imagen`,`remember_token`,`created_at`,`updated_at`) values (1,'Admin','CEDULA','123456','av carlota','123456','eyter@gmail.com','administrador','$2y$10$TCHZklk8q2lT33oAbIG3xerU.0xxEUTf.9LjQyHCftXDDQWEW.TVC',1,1,'1556657502.jpeg',NULL,NULL,'2020-07-26 21:59:49'),(2,'carlos','DNI','12345','av san jose','789456','carlos@gmail.com','vendedor','$2y$10$cB397wtaqhLk/GJioOIV1uvLCoIRihjB0nfLcF03PpdQDaZBNd7q6',1,2,'1556656697.jpeg',NULL,'2019-04-30 23:38:17','2020-07-28 21:20:03'),(3,'Alberto','CEDULA','12369','av italia','459666','alberto@gmail.com','alberto','$2y$10$xpHHqRaUPSKeUDAz9Ynkdes4vX09/lPzKdEgDaHgN7VLliXPxqPl2',1,3,'1556839376.png',NULL,'2019-05-03 02:22:56','2019-05-03 02:22:56');

/*Table structure for table `ventas` */

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcliente` int(10) unsigned NOT NULL,
  `idusuario` int(10) unsigned NOT NULL,
  `tipo_identificacion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_venta` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `impuesto` decimal(4,2) NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventas_idcliente_foreign` (`idcliente`),
  KEY `ventas_idusuario_foreign` (`idusuario`),
  CONSTRAINT `ventas_idcliente_foreign` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `ventas_idusuario_foreign` FOREIGN KEY (`idusuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ventas` */

insert  into `ventas`(`id`,`idcliente`,`idusuario`,`tipo_identificacion`,`num_venta`,`fecha_venta`,`impuesto`,`total`,`estado`,`created_at`,`updated_at`) values (9,1,1,'TICKET','0','2020-07-24 00:00:00','12.00','1008.00','Registrado','2020-07-24 20:42:21','2020-07-24 20:42:21'),(10,0,1,'TICKET','0','2020-07-24 00:00:00','12.00','884.80','Registrado','2020-07-24 21:05:23','2020-07-24 21:05:23'),(11,1,1,'CUENTA CORRIENTE','0','2020-07-24 00:00:00','12.00','638.40','Registrado','2020-07-24 22:46:48','2020-07-24 22:46:48'),(12,0,1,'TICKET','0','2020-07-24 00:00:00','12.00','1008.00','Registrado','2020-07-24 23:29:37','2020-07-24 23:29:37'),(13,0,1,'TICKET','0','2020-07-25 00:00:00','12.00','1321.60','Registrado','2020-07-25 19:20:03','2020-07-25 19:20:03');

/* Trigger structure for table `compras` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_updStockCompraAnular` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_updStockCompraAnular` AFTER UPDATE ON `compras` FOR EACH ROW BEGIN
  UPDATE productos p
    JOIN detalle_compras di
      ON di.idproducto = p.id
     AND di.idcompra = new.id
     set p.stock = p.stock - di.cantidad;
end */$$


DELIMITER ;

/* Trigger structure for table `detalle_compras` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_updStockCompra` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_updStockCompra` AFTER INSERT ON `detalle_compras` FOR EACH ROW BEGIN
 UPDATE productos SET stock = stock + NEW.cantidad 
 WHERE productos.id = NEW.idproducto;
END */$$


DELIMITER ;

/* Trigger structure for table `detalle_ventas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_updStockVenta` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_updStockVenta` AFTER INSERT ON `detalle_ventas` FOR EACH ROW BEGIN
 UPDATE productos SET stock = stock - NEW.cantidad 
 WHERE productos.id = NEW.idproducto;
END */$$


DELIMITER ;

/* Trigger structure for table `ventas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_updStockVentaAnular` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `tr_updStockVentaAnular` AFTER UPDATE ON `ventas` FOR EACH ROW BEGIN
  UPDATE productos p
    JOIN detalle_ventas dv
      ON dv.idproducto = p.id
     AND dv.idventa= new.id
     set p.stock = p.stock + dv.cantidad;
end */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
