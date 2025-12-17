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
-- Table structure for table `errores`
--

DROP TABLE IF EXISTS `errores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `errores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `errores`
--

LOCK TABLES `errores` WRITE;
/*!40000 ALTER TABLE `errores` DISABLE KEYS */;
/*!40000 ALTER TABLE `errores` ENABLE KEYS */;
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
  `marca` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `id_categoria` int(11) NOT NULL,
  `descripcion_detallada` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'iPhone 14','128GB, Color Blanco','Apple',899.99,12,'Activo',1,'iPhone 14 de 128GB en color blanco, ideal para quienes buscan alto rendimiento, excelente cámara y ecosistema Apple. Perfecto para uso diario, redes sociales y fotografía.','productos/iphone14.jpg'),(2,'Samsung Galaxy S23','256GB, Color Negro','Samsung',600.99,5,'Activo',1,'Samsung Galaxy S23 de 256GB en color negro, con pantalla AMOLED y excelente desempeño para juegos y multitarea. Ideal para usuarios Android exigentes.','productos/s23.jpg'),(3,'Xiaomi Redmi Note 12','128GB, Color Azul','Xiaomi',299.99,15,'Activo',1,'Xiaomi Redmi Note 12 de 128GB en color azul. Un equipo balanceado con buena batería, rendimiento correcto y gran relación calidad-precio.','productos/redmi_note12.jpg'),(4,'Huawei P60 Pro','256GB, Color Plata','Huawei',749.99,5,'Activo',1,'Huawei P60 Pro de 256GB en color plata, con enfoque en fotografía y diseño elegante. Recomendado para quienes priorizan la cámara y un look premium.','productos/p60pro.jpg'),(5,'Motorola Edge 40','256GB, Color Negro','Motorola',599.99,4,'Activo',1,'Motorola Edge 40 de 256GB en color negro. Smartphone con diseño delgado, pantalla fluida y buena autonomía, ideal para uso diario y multimedia.','productos/edge40.jpg'),(6,'Laptop HP Pavilion','15.6 pulgadas, Intel i5, 8GB RAM','HP',650.00,6,'Activo',2,'Laptop HP Pavilion de 15.6\" con Intel i5 y 8GB de RAM. Equipo versátil para estudio, oficina y tareas de productividad con buen desempeño general.','productos/hp_pavilion.jpg'),(7,'Asus TUF Gaming F15','Intel i7, RTX 3050, 16GB RAM','Asus',1199.99,4,'Activo',2,'Asus TUF Gaming F15 con Intel i7, RTX 3050 y 16GB de RAM. Pensada para gaming y programas exigentes como edición de video y diseño.','productos/asus_tuf_f15.jpg'),(8,'MacBook Air M2','13 pulgadas, 256GB SSD','Apple',1249.00,3,'Activo',2,'MacBook Air M2 de 13\" con 256GB SSD. Portátil liviano, silencioso y con gran autonomía, ideal para desarrollo ligero, oficina y estudio.','productos/macbook_air_m2.jpg'),(9,'Lenovo IdeaPad 3','AMD Ryzen 5, 8GB RAM, 512GB SSD','Lenovo',499.00,7,'Activo',2,'Lenovo IdeaPad 3 con Ryzen 5, 8GB de RAM y 512GB SSD. Portátil equilibrado para trabajo, estudio y uso diario con buen rendimiento.','productos/ideapad3.jpg'),(10,'Acer Aspire 5','Intel i5, 12GB RAM, 512GB SSD','Acer',579.00,10,'Activo',2,'Acer Aspire 5 con Intel i5, 12GB RAM y 512GB SSD. Equipo versátil para multitarea, ideal para estudiantes y profesionales.','productos/acer_aspire5.jpg'),(11,'Cargador USB-C','20W original universal','Generic',19.99,30,'Activo',3,'Cargador USB-C de 20W universal, ideal para cargar rápidamente teléfonos y tablets compatibles con carga rápida.','productos/cargador_usbc_20w.jpg'),(12,'Audífonos Bluetooth JBL','Sonido Pure Bass','JBL',49.99,20,'Activo',3,'Audífonos Bluetooth JBL con sonido Pure Bass, cómodos para uso diario, ideales para música, videollamadas y ejercicio.','productos/jbl_purebass.jpg'),(13,'Mouse Logitech M170','Inalámbrico color negro','Logitech',15.99,25,'Activo',3,'Mouse inalámbrico Logitech M170 en color negro. Compacto, cómodo y confiable para uso en oficina, estudio o casa.','productos/logitech_m170.jpg'),(14,'Teclado Mecánico Redragon','Switch rojo retroiluminado','Redragon',69.99,10,'Activo',3,'Teclado mecánico Redragon con switch rojo y retroiluminación. Ideal para gamers y usuarios que disfrutan de escribir con sensación mecánica.','productos/redragon_mecanico.jpg'),(15,'Cable HDMI 2.1','1.5 metros, 8K compatible','Ugreen',12.99,40,'Activo',3,'Cable HDMI 2.1 de 1.5 metros, compatible con hasta 8K. Perfecto para consolas de nueva generación, PCs y monitores modernos.','productos/hdmi_21_15m.jpg'),(16,'Monitor LG 24\"','Full HD, panel IPS','LG',149.99,5,'Activo',4,'Monitor LG de 24\" Full HD con panel IPS, excelente para trabajo de oficina, estudio y consumo de contenido multimedia.','productos/monitor_lg_24.jpg'),(17,'Monitor Samsung 27\"','Curvo, 144Hz','Samsung',299.99,6,'Activo',4,'Monitor Samsung de 27\" curvo con 144Hz. Ideal para gaming fluido y experiencia inmersiva.','productos/monitor_samsung_27.jpg'),(18,'Tarjeta Gráfica RTX 4060','NVIDIA 8GB GDDR6','NVIDIA',499.99,2,'Activo',5,'Tarjeta gráfica NVIDIA RTX 4060 con 8GB GDDR6. Diseñada para gaming en 1080p/1440p y aplicaciones de creación de contenido.','productos/rtx4060.jpg'),(19,'Memoria RAM 16GB DDR4','3200MHz Kingston','Kingston',69.99,20,'Activo',5,'Módulo de memoria RAM de 16GB DDR4 a 3200MHz de Kingston. Ideal para mejorar el rendimiento de equipos de escritorio.','productos/ram_16gb_ddr4_kingston.jpg'),(20,'Disco SSD 1TB','Samsung EVO 870 SATA','Samsung',119.99,15,'Activo',5,'Disco SSD de 1TB Samsung EVO 870 SATA. Excelente opción para acelerar el sistema operativo y tiempos de carga de aplicaciones.','productos/ssd_1tb_evo870.jpg'),(21,'Samsung A54','128GB, Verde Lime','Samsung',379.99,10,'Activo',1,'Samsung A54 de 128GB en color verde, con pantalla AMOLED y excelente rendimiento para aplicaciones, juegos y redes sociales.','productos/samsung_a54.jpg'),(22,'Samsung Galaxy Z Flip 5','256GB, Plegable de última generación','Samsung',999.99,5,'Activo',1,'Samsung Galaxy Z Flip 5 plegable con pantalla dinámica, ideal para quienes buscan diseño moderno y compacto sin sacrificar potencia.','productos/galaxy_z_flip5.jpg'),(23,'iPhone SE 2022','128GB, Rojo, chip A15 Bionic','Apple',429.99,8,'Activo',1,'iPhone SE 2022 de 128GB con chip A15 Bionic, tamaño compacto y gran potencia, perfecto para uso diario y ecosistema Apple.','productos/iphone_se_2022.jpg'),(24,'Xiaomi Poco X5 Pro','256GB, Negro, pantalla 120Hz','Xiaomi',329.99,12,'Activo',1,'Xiaomi Poco X5 Pro de 256GB, pensado para gaming y multitarea, con pantalla de alta tasa de refresco y buena autonomía.','productos/poco_x5_pro.jpg'),(25,'Xiaomi 13 Lite','256GB, Azul, cámara dual avanzada','Xiaomi',449.99,7,'Activo',1,'Xiaomi 13 Lite de 256GB, muy ligero y delgado, ideal para selfies y videollamadas gracias a su cámara frontal avanzada.','productos/xiaomi_13_lite.jpg'),(26,'Motorola G73','256GB, Blanco, batería de larga duración','Motorola',289.99,15,'Activo',1,'Motorola G73 de 256GB, con batería de larga duración y rendimiento sólido para tareas diarias, redes sociales y multimedia.','productos/moto_g73.jpg'),(27,'Huawei Nova 11','256GB, Verde, cámara de alto nivel','Huawei',449.99,6,'Activo',1,'Huawei Nova 11 de 256GB, centrado en fotografía y diseño estilizado, ideal para usuarios que priorizan estilo y cámara.','productos/huawei_nova_11.jpg'),(28,'Nokia G50','128GB, Azul, excelente batería','Nokia',219.99,9,'Activo',1,'Nokia G50 de 128GB, teléfono robusto con buena autonomía, perfecto para quienes buscan durabilidad y sencillez.','productos/nokia_g50.jpg'),(29,'Realme 11 Pro','256GB, Negro, cámara 100MP','Realme',399.99,11,'Activo',1,'Realme 11 Pro de 256GB, con cámara de hasta 100MP y pantalla fluida, ideal para fotografía y contenido multimedia.','productos/realme_11_pro.jpg'),(30,'OnePlus Nord CE 3 Lite','128GB, Verde, carga rápida','OnePlus',329.99,10,'Activo',1,'OnePlus Nord CE 3 Lite con carga rápida y buena optimización de software, recomendado para quienes buscan fluidez al mejor precio.','productos/nord_ce3_lite.jpg'),(31,'Dell Inspiron 15','Intel i5, 12GB RAM, 512GB SSD','Dell',699.99,6,'Activo',2,'Dell Inspiron 15 con procesador Intel i5, 12GB de RAM y SSD de 512GB, ideal para estudio, oficina y multitarea diaria.','productos/dell_inspiron_15.jpg'),(32,'Dell XPS 13','Intel i7, OLED, ultraliviana','Dell',1299.99,3,'Activo',2,'Dell XPS 13 con Intel i7 y pantalla OLED, ultraligera y premium, ideal para profesionales que viajan y necesitan potencia.','productos/dell_xps_13.jpg'),(33,'HP Omen 16','Ryzen 7, RTX 4060, 16GB RAM','HP',1499.99,4,'Activo',2,'HP Omen 16 con Ryzen 7 y RTX 4060, pensada para gaming exigente y creación de contenido con buen sistema de refrigeración.','productos/hp_omen_16.jpg'),(34,'Acer Nitro 5','i5, RTX 3050, 16GB RAM','Acer',999.99,5,'Activo',2,'Acer Nitro 5 con i5 y RTX 3050, laptop gamer equilibrada para juegos populares y edición de video básica.','productos/acer_nitro_5.jpg'),(35,'Asus ZenBook 14','Ryzen 7, 512GB SSD, ultrabook','Asus',899.99,7,'Activo',2,'Asus ZenBook 14 con procesador Ryzen 7 y SSD de 512GB, ultrabook ideal para trabajo, estudio y movilidad.','productos/asus_zenbook_14.jpg'),(36,'Lenovo ThinkPad T14','Ryzen 5 PRO, 512GB SSD','Lenovo',1099.99,4,'Activo',2,'Lenovo ThinkPad T14 con Ryzen 5 PRO, orientada a uso empresarial, muy resistente y con teclado cómodo.','productos/thinkpad_t14.jpg'),(37,'MacBook Pro M1','512GB SSD, 13 pulgadas','Apple',1499.99,3,'Activo',2,'MacBook Pro con chip M1 y SSD de 512GB, enfocada en rendimiento profesional, edición de video y desarrollo.','productos/macbook_pro_m1.jpg'),(38,'MSI GF63 Thin','Intel i7, 512GB SSD','MSI',899.99,5,'Activo',2,'MSI GF63 Thin con Intel i7, ideal para gaming ligero y productividad, con diseño delgado y buena ventilación.','productos/msi_gf63_thin.jpg'),(39,'Samsung Galaxy Book2','i5 12th Gen, 256GB SSD','Samsung',749.99,6,'Activo',2,'Samsung Galaxy Book2 con procesador Intel i5 de 12 generación, portátil ligero integrado al ecosistema Samsung.','productos/galaxy_book2.jpg'),(40,'Huawei MateBook D15','Ryzen 5, 256GB SSD','Huawei',599.99,8,'Activo',2,'Huawei MateBook D15 con Ryzen 5, pantalla amplia y diseño metálico, ideal para trabajo de oficina y estudio.','productos/matebook_d15.jpg'),(41,'Cargador MagSafe Apple','15W carga inalámbrica','Apple',49.99,20,'Activo',3,'Cargador MagSafe de Apple con carga inalámbrica de hasta 15W, ideal para iPhone compatibles y uso diario.','productos/magsafe_apple.jpg'),(42,'Audífonos Sony WH-CH720N','Bluetooth con cancelación de ruido','Sony',129.99,12,'Activo',3,'Audífonos Sony WH-CH720N con conexión Bluetooth y cancelación de ruido, cómodos para trabajo y entretenimiento.','productos/sony_wh_ch720n.jpg'),(43,'Teclado Logitech K380','Multidispositivo Bluetooth','Logitech',39.99,25,'Activo',3,'Teclado Logitech K380 inalámbrico multidispositivo, compacto y silencioso, ideal para usar con laptop, tablet y celular.','productos/logitech_k380.jpg'),(44,'Mouse Razer DeathAdder Essential','Sensor óptico gamer','Razer',34.99,18,'Activo',3,'Mouse Razer DeathAdder Essential con sensor óptico para gaming, ergonómico y preciso para juegos y uso diario.','productos/razer_deathadder_essential.jpg'),(45,'Alfombrilla Redragon Kunlun','RGB XL','Redragon',29.99,30,'Activo',3,'Alfombrilla Redragon Kunlun con iluminación RGB y tamaño XL, perfecta para setups gamer y mayor comodidad con el mouse.','productos/redragon_kunlun.jpg'),(46,'Parlantes Logitech Z200','Sonido estéreo 2.0','Logitech',49.99,14,'Activo',3,'Parlantes Logitech Z200 2.0 con sonido estéreo claro, ideales para escritorio, películas y música en espacios pequeños.','productos/logitech_z200.jpg'),(47,'Cargador Samsung Fast Charge','Cargador inalámbrico 15W','Samsung',59.99,10,'Activo',3,'Cargador inalámbrico Samsung Fast Charge de 15W, compatible con dispositivos con carga inalámbrica rápida.','productos/samsung_fast_charge_15w.jpg'),(48,'Batería Anker PowerCore 20k','20,000 mAh','Anker',39.99,22,'Activo',3,'Batería portátil Anker PowerCore de 20,000 mAh, ideal para viajes y carga múltiple de dispositivos.','productos/anker_powercore_20k.jpg'),(49,'Soporte Belkin para Laptop','Metálico, ajustable','Belkin',34.99,16,'Activo',3,'Soporte Belkin para laptop, metálico y ajustable, mejora la ergonomía y ventilación del equipo.','productos/soporte_belkin_laptop.jpg'),(50,'Webcam Logitech C920 Pro','Full HD 1080p','Logitech',79.99,9,'Activo',3,'Webcam Logitech C920 Pro con resolución Full HD 1080p, ideal para videollamadas, streaming y clases en línea.','productos/logitech_c920_pro.jpg'),(51,'LG UltraGear 24\"','IPS 144Hz gaming','LG',199.99,7,'Activo',4,'Monitor LG UltraGear de 24 pulgadas con panel IPS y 144Hz, ideal para gaming competitivo y respuesta rápida.','productos/lg_ultragear_24.jpg'),(52,'LG UltraWide 34\"','Panel curvo panorámico','LG',349.99,5,'Activo',4,'LG UltraWide de 34 pulgadas con pantalla curva, perfecto para multitarea, edición y productividad.','productos/lg_ultrawide_34.jpg'),(53,'Samsung Odyssey G5 32\"','144Hz, curvo','Samsung',399.99,4,'Activo',4,'Samsung Odyssey G5 de 32 pulgadas, monitor curvo con 144Hz, ideal para juegos inmersivos y simuladores.','productos/odyssey_g5_32.jpg'),(54,'Acer Predator XB273','27 pulgadas, gamer','Acer',429.99,3,'Activo',4,'Acer Predator XB273 de 27 pulgadas, monitor gamer con alta tasa de refresco y gran calidad de imagen.','productos/acer_predator_xb273.jpg'),(55,'AOC 24G2','144Hz, IPS','AOC',229.99,9,'Activo',4,'AOC 24G2 de 24 pulgadas y 144Hz, uno de los monitores más populares para gaming competitivo.','productos/aoc_24g2.jpg'),(56,'Dell Ultrasharp U2722D','27 pulgadas, profesional IPS','Dell',369.99,6,'Activo',4,'Dell Ultrasharp U2722D de 27 pulgadas con panel IPS, ideal para diseño, oficina y trabajo profesional.','productos/dell_u2722d.jpg'),(57,'MSI Optix G271','27 pulgadas, 144Hz','MSI',289.99,5,'Activo',4,'MSI Optix G271 de 27 pulgadas y 144Hz, monitor pensado para juegos fluidos y buena reproducción de color.','productos/msi_optix_g271.jpg'),(58,'HP M24f','IPS 24 pulgadas','HP',159.99,11,'Activo',4,'HP M24f de 24 pulgadas con panel IPS, ideal para oficina, estudio y consumo de contenido.','productos/hp_m24f.jpg'),(59,'BenQ Zowie XL2411K','144Hz eSports','BenQ',249.99,4,'Activo',4,'BenQ Zowie XL2411K de 24 pulgadas y 144Hz, enfocado en eSports con baja latencia.','productos/benq_xl2411k.jpg'),(60,'Philips 27\" IPS','75Hz, profesional','Philips',179.99,6,'Activo',4,'Monitor Philips de 27 pulgadas con panel IPS y 75Hz, ideal para uso general y trabajo.','productos/philips_27_ips.jpg'),(61,'LG UltraGear 24\"','IPS 144Hz gaming','LG',199.99,7,'Activo',4,'Monitor LG UltraGear de 24 pulgadas con panel IPS y 144Hz, ideal para gaming competitivo y respuesta rápida.','productos/lg_ultragear_24.jpg'),(62,'LG UltraWide 34\"','Panel curvo panorámico','LG',349.99,5,'Activo',4,'LG UltraWide de 34 pulgadas con pantalla curva, perfecto para multitarea, edición y productividad.','productos/lg_ultrawide_34.jpg'),(63,'Samsung Odyssey G5 32\"','144Hz, curvo','Samsung',399.99,4,'Activo',4,'Samsung Odyssey G5 de 32 pulgadas, monitor curvo con 144Hz, ideal para juegos inmersivos y simuladores.','productos/odyssey_g5_32.jpg'),(64,'Acer Predator XB273','27 pulgadas, gamer','Acer',429.99,3,'Activo',4,'Acer Predator XB273 de 27 pulgadas, monitor gamer con alta tasa de refresco y gran calidad de imagen.','productos/acer_predator_xb273.jpg'),(65,'AOC 24G2','144Hz, IPS','AOC',229.99,9,'Activo',4,'AOC 24G2 de 24 pulgadas y 144Hz, uno de los monitores más populares para gaming competitivo.','productos/aoc_24g2.jpg'),(66,'Dell Ultrasharp U2722D','27 pulgadas, profesional IPS','Dell',369.99,6,'Activo',4,'Dell Ultrasharp U2722D de 27 pulgadas con panel IPS, ideal para diseño, oficina y trabajo profesional.','productos/dell_u2722d.jpg'),(67,'MSI Optix G271','27 pulgadas, 144Hz','MSI',289.99,5,'Activo',4,'MSI Optix G271 de 27 pulgadas y 144Hz, monitor pensado para juegos fluidos y buena reproducción de color.','productos/msi_optix_g271.jpg'),(68,'HP M24f','IPS 24 pulgadas','HP',159.99,11,'Activo',4,'HP M24f de 24 pulgadas con panel IPS, ideal para oficina, estudio y consumo de contenido.','productos/hp_m24f.jpg'),(69,'BenQ Zowie XL2411K','144Hz eSports','BenQ',249.99,4,'Activo',4,'BenQ Zowie XL2411K de 24 pulgadas y 144Hz, enfocado en eSports con baja latencia.','productos/benq_xl2411k.jpg'),(70,'Philips 27\" IPS','75Hz, profesional','Philips',179.99,6,'Activo',4,'Monitor Philips de 27 pulgadas con panel IPS y 75Hz, ideal para uso general y trabajo.','productos/philips_27_ips.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tberror`
--

DROP TABLE IF EXISTS `tberror`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tberror` (
  `ConsecutivoError` int(11) NOT NULL AUTO_INCREMENT,
  `Mensaje` varchar(8000) NOT NULL,
  `FechaHora` datetime NOT NULL,
  PRIMARY KEY (`ConsecutivoError`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tberror`
--

LOCK TABLES `tberror` WRITE;
/*!40000 ALTER TABLE `tberror` DISABLE KEYS */;
/*!40000 ALTER TABLE `tberror` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `usuarios` VALUES (116770298,'Andy','Rodríguez','Rodríguez','8466-3405','josue.rodriguez97.ar@gmail.com','1234','Administrador','Activo'),(117500254,'Luis','Ugalde','Castrillo','8888-2882','luis@mail.com','1234','Cliente','Activo'),(189750359,'Carlos','Salas','Alpízar','8888-3342','carlos@mail.com','1234','Cliente','Activo'),(307890147,'Jorge','Víquez','Espinoza','8888-7585','jorge@mail.com','1234','Administrador','Activo'),(357800871,'Andres','Bonilla','Castro','8888-7894','ronny@mail.com','1234','Cliente','Activo');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'tienda'
--
/*!50003 DROP PROCEDURE IF EXISTS `(ValidarCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `(ValidarCuenta`( 
	IN pCorreo VARCHAR(50), 
	IN pContrasena VARCHAR(60) 
)
BEGIN 
	SELECT 
	ced_usuario, 
	nombre, 
	apellido1, 
	apellido2, 
	telefono, 
	correo, 
	contrasena, 
	rol, 
	estado 
	FROM usuarios 
	WHERE correo = pCorreo 
	AND contrasena = pContrasena 
	AND estado = 'Activo'; 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ActualizarContrasenna` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarContrasenna`(
    IN pCedula INT(9),
    IN pNuevaContrasena VARCHAR(60)
)
BEGIN
    UPDATE usuarios
    SET contrasena = pNuevaContrasena
    WHERE ced_usuario = pCedula;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ActualizarPerfil` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPerfil`(
    IN pCedula VARCHAR(20), 
    IN pNombre VARCHAR(100),
    IN pApellido1 VARCHAR(100),
    IN pApellido2 VARCHAR(100),
    IN pTelefono VARCHAR(20),
    IN pCorreo VARCHAR(100)
)
BEGIN
    UPDATE usuarios
    SET 
        nombre = pNombre,
        apellido1 = pApellido1,
        apellido2 = pApellido2,
        telefono = pTelefono,
        correo = pCorreo
    WHERE ced_usuario = pCedula;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ConsultarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarUsuario`(
    IN pCedula VARCHAR(20)
)
BEGIN
    SELECT 
        ced_usuario,
        nombre,
        apellido1,
        apellido2,
        telefono,
        correo,
        contrasena,
        rol,
        estado
    FROM usuarios
    WHERE ced_usuario = pCedula;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `CrearCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `CrearCuenta`(
    IN pCedula INT(9),
    IN pNombre VARCHAR(15),
    IN pApellido1 VARCHAR(30),
    IN pApellido2 VARCHAR(30),
    IN pTelefono VARCHAR(20),
    IN pCorreo VARCHAR(50),
    IN pContrasena VARCHAR(60),
    IN pRol ENUM('Cliente','Administrador'),
    IN pEstado ENUM('Activo','Inactivo')
)
BEGIN
    INSERT INTO usuarios (
        ced_usuario,
        nombre,
        apellido1,
        apellido2,
        telefono,
        correo,
        contrasena,
        rol,
        estado
    )
    VALUES (
        pCedula,
        pNombre,
        pApellido1,
        pApellido2,
        pTelefono,
        pCorreo,
        pContrasena,
        pRol,
        pEstado
    );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RegistrarError` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarError`(IN pMensaje VARCHAR(8000))
BEGIN
  INSERT INTO errores (mensaje, fecha)
  VALUES (pMensaje, NOW());
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ValidarCorreo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidarCorreo`(
    IN pCorreo VARCHAR(50)
)
BEGIN
    SELECT 
        ced_usuario,
        nombre,
        apellido1,
        apellido2,
        telefono,
        correo,
        contrasena,
        rol,
        estado
    FROM usuarios
    WHERE correo = pCorreo
      AND estado = 'Activo';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ValidarCuenta` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidarCuenta`(
    IN pCorreo VARCHAR(50),
    IN pContrasena VARCHAR(60)
)
BEGIN
    SELECT 
        ced_usuario,
        nombre,
        apellido1,
        apellido2,
        telefono,
        correo,
        contrasena,
        rol,
        estado
    FROM usuarios
    WHERE correo = pCorreo
      AND contrasena = pContrasena
      AND estado = 'Activo';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-01 12:57:09

DELIMITER $$

CREATE PROCEDURE sp_historial_producto(
    IN pIdProducto INT
)
BEGIN
    SELECT 
        pe.fecha,
        dp.cantidad,
        dp.precio_unitario,
        dp.total_linea
    FROM detalle_pedidos dp
    INNER JOIN pedidos pe ON pe.id_pedido = dp.id_pedido
    WHERE pe.estado = 'Confirmado'
      AND dp.id_producto = pIdProducto
    ORDER BY pe.fecha ASC;
END $$

DELIMITER ;

CREATE PROCEDURE sp_top_vendidos_rango(
    IN pInicio DATETIME,
    IN pFin DATETIME
)
BEGIN
    SELECT 
        p.id_producto,
        p.nombre,
        SUM(dp.cantidad) AS total_vendido,
        SUM(dp.total_linea) AS total_ingresos
    FROM detalle_pedidos dp
    INNER JOIN pedidos pe ON pe.id_pedido = dp.id_pedido
    INNER JOIN productos p ON p.id_producto = dp.id_producto
    WHERE pe.estado = 'Confirmado'
      AND pe.fecha BETWEEN pInicio AND pFin
    GROUP BY p.id_producto, p.nombre
    ORDER BY total_vendido DESC;
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE sp_historial_producto(
    IN pIdProducto INT
)
BEGIN
    SELECT 
        pe.fecha,
        dp.cantidad,
        dp.precio_unitario,
        dp.total_linea
    FROM detalle_pedidos dp
    INNER JOIN pedidos pe ON pe.id_pedido = dp.id_pedido
    WHERE pe.estado = 'Confirmado'
      AND dp.id_producto = pIdProducto
    ORDER BY pe.fecha ASC;
END $$

DELIMITER ;





















