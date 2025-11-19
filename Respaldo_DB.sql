CREATE DATABASE  IF NOT EXISTS `tienda` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `tienda`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: tienda
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carritos`
--

DROP TABLE IF EXISTS `carritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carritos` (
  `id_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `ced_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_carrito`),
  KEY `ced_usuario` (`ced_usuario`),
  CONSTRAINT `carritos_ibfk_1` FOREIGN KEY (`ced_usuario`) REFERENCES `usuarios` (`ced_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carritos`
--

LOCK TABLES `carritos` WRITE;
/*!40000 ALTER TABLE `carritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `carritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Celulares','Teléfonos inteligentes y accesorios','Activo'),(2,'Computadoras','Laptops, PC de escritorio, PC Gamer','Activo'),(3,'Accesorios','Cargadores, fundas, auriculares, Teclados y más','Activo'),(4,'Monitores','Pantallas LED y LCD de distintas pulgadas','Activo'),(5,'Componentes','Partes de hardware y actualizaciones','Activo');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_carritos`
--

DROP TABLE IF EXISTS `detalle_carritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_carritos` (
  `id_detalle_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id_detalle_carrito`),
  KEY `id_carrito` (`id_carrito`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_carritos_ibfk_1` FOREIGN KEY (`id_carrito`) REFERENCES `carritos` (`id_carrito`),
  CONSTRAINT `detalle_carritos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_carritos`
--

LOCK TABLES `detalle_carritos` WRITE;
/*!40000 ALTER TABLE `detalle_carritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_carritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_pedidos`
--

DROP TABLE IF EXISTS `detalle_pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_pedidos` (
  `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `total_linea` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id_detalle_pedido`),
  KEY `id_pedido` (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_pedidos`
--

LOCK TABLES `detalle_pedidos` WRITE;
/*!40000 ALTER TABLE `detalle_pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `ced_usuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT 0.00,
  `estado` enum('Confirmado','Cancelado') DEFAULT 'Confirmado',
  PRIMARY KEY (`id_pedido`),
  KEY `ced_usuario` (`ced_usuario`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`ced_usuario`) REFERENCES `usuarios` (`ced_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'iPhone 14','128GB, Color Blanco',899.99,12,'Activo',1),(2,'Samsung Galaxy S23','256GB, Color Negro',600.99,5,'Activo',1),(3,'Xiaomi Redmi Note 12','128GB, Color Azul',299.99,15,'Activo',1),(4,'Huawei P60 Pro','256GB, Color Plata',749.99,5,'Activo',1),(5,'Motorola Edge 40','256GB, Color Negro',599.99,4,'Activo',1),(6,'Laptop HP Pavilion','15.6 pulgadas, Intel i5, 8GB RAM',650.00,6,'Activo',2),(7,'Asus TUF Gaming F15','Intel i7, RTX 3050, 16GB RAM',1199.99,4,'Activo',2),(8,'MacBook Air M2','13 pulgadas, 256GB SSD',1249.00,3,'Activo',2),(9,'Lenovo IdeaPad 3','AMD Ryzen 5, 8GB RAM, 512GB SSD',499.00,7,'Activo',2),(10,'Acer Aspire 5','Intel i5, 12GB RAM, 512GB SSD',579.00,10,'Activo',2),(11,'Cargador USB-C','20W original universal',19.99,30,'Activo',3),(12,'Audífonos Bluetooth JBL','Sonido Pure Bass',49.99,20,'Activo',3),(13,'Mouse Logitech M170','Inalámbrico color negro',15.99,25,'Activo',3),(14,'Teclado Mecánico Redragon','Switch rojo retroiluminado',69.99,10,'Activo',3),(15,'Cable HDMI 2.1','1.5 metros, 8K compatible',12.99,40,'Activo',3),(16,'Monitor LG 24\"','Full HD, panel IPS',149.99,5,'Activo',4),(17,'Monitor Samsung 27\"','Curvo, 144Hz',299.99,6,'Activo',4),(18,'Tarjeta Gráfica RTX 4060','NVIDIA 8GB GDDR6',499.99,2,'Activo',5),(19,'Memoria RAM 16GB DDR4','3200MHz Kingston',69.99,20,'Activo',5),(20,'Disco SSD 1TB','Samsung EVO 870 SATA',119.99,15,'Activo',5);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;


CREATE TABLE errores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DELIMITER $$

CREATE PROCEDURE RegistrarError(
    IN p_mensaje TEXT
)
BEGIN
    INSERT INTO errores (mensaje)
    VALUES (p_mensaje);
END $$

DELIMITER ;




--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `ced_usuario` int(9) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellido1` varchar(30) NOT NULL,
  `apellido2` varchar(30) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `rol` enum('Cliente','Administrador') DEFAULT 'Cliente',
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  PRIMARY KEY (`ced_usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (116770298,'Andy','Rodríguez','Rodríguez','8888-8820','andy@mail.com','1234','Administrador','Activo'),(117500254,'Luis','Ugalde','Castrillo','8888-2882','luis@mail.com','1234','Cliente','Activo'),(189750359,'Carlos','Salas','Alpízar','8888-3342','carlos@mail.com','1234','Cliente','Activo'),(307890147,'Jorge','Víquez','Espinoza','8888-7585','jorge@mail.com','1234','Administrador','Activo'),(357800871,'Andres','Bonilla','Castro','8888-7894','ronny@mail.com','1234','Cliente','Activo');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'tienda'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-05 17:00:36
