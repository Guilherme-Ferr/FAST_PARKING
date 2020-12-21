-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dbestacionamento
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `tblentradasaidacliente`
--

DROP TABLE IF EXISTS `tblentradasaidacliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblentradasaidacliente` (
  `idEntradaSaidaCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(80) NOT NULL,
  `numeroPlacaVeiculo` varchar(20) NOT NULL,
  `dataHorarioEntrada` datetime NOT NULL,
  `horarioSaida` datetime DEFAULT NULL,
  `idVaga` int(11) NOT NULL,
  `idValor` int(11) DEFAULT NULL,
  `diferenca` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEntradaSaidaCliente`),
  KEY `FK_Vagas_EntradaSaida` (`idVaga`),
  KEY `FK_Valores_EntradaSaida` (`idValor`),
  CONSTRAINT `FK_Vagas_EntradaSaida` FOREIGN KEY (`idVaga`) REFERENCES `tblvagas` (`idVaga`),
  CONSTRAINT `FK_Valores_EntradaSaida` FOREIGN KEY (`idValor`) REFERENCES `tblvalores` (`idValor`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblentradasaidacliente`
--

LOCK TABLES `tblentradasaidacliente` WRITE;
/*!40000 ALTER TABLE `tblentradasaidacliente` DISABLE KEYS */;
INSERT INTO `tblentradasaidacliente` VALUES (16,'Emilly','BRA0S17','2020-12-19 08:45:18','2020-12-17 21:40:55',2,1,35),(17,'Emilly','BRA0S17','2020-12-19 09:01:35','2020-12-19 19:03:38',2,1,10),(18,'Emilly','BRA0S17','2020-12-19 16:22:59','2020-12-19 18:26:03',2,NULL,2),(19,'Emilly','BRA0S17','2020-12-19 16:22:59','2020-12-19 18:26:31',2,NULL,2),(20,'Emilly','BRA0S17','2020-12-19 18:26:25','2020-12-19 19:12:18',2,1,0),(21,'Emilly','BRA0S17','2020-12-19 18:26:26','2020-12-19 18:26:45',2,NULL,0);
/*!40000 ALTER TABLE `tblentradasaidacliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblvagas`
--

DROP TABLE IF EXISTS `tblvagas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblvagas` (
  `idVaga` int(11) NOT NULL AUTO_INCREMENT,
  `disponibilidade` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idVaga`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblvagas`
--

LOCK TABLES `tblvagas` WRITE;
/*!40000 ALTER TABLE `tblvagas` DISABLE KEYS */;
INSERT INTO `tblvagas` VALUES (1,'Sim'),(2,'Não');
/*!40000 ALTER TABLE `tblvagas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblvalores`
--

DROP TABLE IF EXISTS `tblvalores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblvalores` (
  `idValor` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(10,0) NOT NULL,
  PRIMARY KEY (`idValor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblvalores`
--

LOCK TABLES `tblvalores` WRITE;
/*!40000 ALTER TABLE `tblvalores` DISABLE KEYS */;
INSERT INTO `tblvalores` VALUES (1,15),(2,30);
/*!40000 ALTER TABLE `tblvalores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vwrendimentostotais`
--

DROP TABLE IF EXISTS `vwrendimentostotais`;
/*!50001 DROP VIEW IF EXISTS `vwrendimentostotais`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vwrendimentostotais` AS SELECT 
 1 AS `Redimento Total`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vwrendimentostotais`
--

/*!50001 DROP VIEW IF EXISTS `vwrendimentostotais`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vwrendimentostotais` AS select concat('R$ ',(count(`tblentradasaidacliente`.`idValor`) * `tblvalores`.`valor`)) AS `Redimento Total` from (`tblentradasaidacliente` join `tblvalores` on(((`tblentradasaidacliente`.`idValor` = `tblvalores`.`idValor`) and (`tblentradasaidacliente`.`dataHorarioEntrada` like '%%')))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-21 18:49:41
