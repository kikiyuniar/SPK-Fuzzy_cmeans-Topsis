/*
SQLyog Ultimate v9.50 
MySQL - 5.5.5-10.4.14-MariaDB : Database - fcm_topsis
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fcm_topsis` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `fcm_topsis`;

/*Table structure for table `tb_admin` */

DROP TABLE IF EXISTS `tb_admin`;

CREATE TABLE `tb_admin` (
  `user` varchar(16) NOT NULL,
  `pass` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`user`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `tb_admin` */

insert  into `tb_admin`(`user`,`pass`) values ('admin','admin');

/*Table structure for table `tb_alternatif` */

DROP TABLE IF EXISTS `tb_alternatif`;

CREATE TABLE `tb_alternatif` (
  `nama_alternatif varchar(16) NOT NULL,
  `judul_alternatif` varchar(255) DEFAULT NULL,
  `ket_alternatif` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_alternatif`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tb_alternatif` */
nama_alternatif
insert  into `tb_alternatif`(`kode_alternatif`,`judul_alternatif`,`ket_alternatif`) values ('A001','Lestari Nurhajati','Lestari Nurhajati'),('A002','Gunawan Ardianto','Gunawan Ardianto'),('A003','val Clark','val Clark'),('A004','iin hasim','iin hasim'),('A005','gunawan adriyanto','gunawan adriyanto'),('A006','Qalbinur Nawawi','Qalbinur Nawawi'),('A007','rahmat makmur','rahmat makmur'),('A008','Robert Gordon','Robert Gordon'),('A009','James Kayui Li','James Kayui Li'),('A010','Gunawan Ardiyanto','Gunawan Ardiyanto'),('A011','M. Rudyanto Arief (STIMIK AMIKOM)','M. Rudyanto Arief (STIMIK AMIKOM)'),('A012','MADCOMS','MADCOMS'),('A013','MADCOMS','MADCOMS'),('A014','Wahana Komputer','Wahana Komputer'),('A015','Iman Suja','Iman Suja'),('A016','David M. Kroenke','David M. Kroenke'),('A017','David M. Kroenke','David M. Kroenke'),('A018','Kani','Kani'),('A019','MT. Heru Purwanto','MT. Heru Purwanto'),('A020','DIDIT N UTAMA','DIDIT N UTAMA'),('A021','Harlianto Tanudjaja,Ir.,M.Kom','Harlianto Tanudjaja,Ir.,M.Kom'),('A022','Rustam Effendi','Rustam Effendi'),('A023','RADITA ARINDYA, ST, MT','RADITA ARINDYA, ST, MT'),('A024','Djiteng Marsudi','Djiteng Marsudi'),('A025','William  H. Hyat JR','William  H. Hyat JR'),('A026','E. Sutarman','E. Sutarman'),('A027','Prof. Dr. Tata Surdia MS','Prof. Dr. Tata Surdia MS'),('A028','Cekmas Cekdin','Cekmas Cekdin'),('A029','Bonar Pandjaitan','Bonar Pandjaitan'),('A030','R.H. Sianipar, I.K.Wiryajati','R.H. Sianipar, I.K.Wiryajati'),('A031','Andi Nalwan','Andi Nalwan'),('A032','EKO BUDI PURWANTO','EKO BUDI PURWANTO'),('A033','JITENG MARSUDI','JITENG MARSUDI'),('A034','Hany Ferdinando','Hany Ferdinando'),('A035','Widodo Budiharto & Sigit Firmansyah','Widodo Budiharto & Sigit Firmansyah');

/*Table structure for table `tb_atribut` */

DROP TABLE IF EXISTS `tb_atribut`;

CREATE TABLE `tb_atribut` (
  `kode_atribut` varchar(16) NOT NULL,
  `nama_atribut` varchar(255) DEFAULT NULL,
  `atribut` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`kode_atribut`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tb_atribut` */

insert  into `tb_atribut`(`kode_atribut`,`nama_atribut`,`atribut`) values ('C01','Tahun Terbit Buku','benefit'),('C02','Penerbit','benefit'),('C03','Harga Buku','benefit'),('C04','Stok Buku di Perpus','benefit'),('C05','Jumlah Peminjaman','benefit');

/*Table structure for table `tb_cluster` */

DROP TABLE IF EXISTS `tb_cluster`;

CREATE TABLE `tb_cluster` (
  `kode_buku` varchar(16) NOT NULL,
  `cluster` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `tb_cluster` */

/*Table structure for table `tb_rel_alternatif` */

DROP TABLE IF EXISTS `tb_rel_alternatif`;

CREATE TABLE `tb_rel_alternatif` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kode_alternatif` varchar(16) DEFAULT NULL,
  `kode_atribut` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=176 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Data for the table `tb_rel_alternatif` */

insert  into `tb_rel_alternatif`(`ID`,`kode_alternatif`,`kode_atribut`,`nilai`) values (1,'A001','C01',2),(2,'A001','C02',1),(3,'A001','C03',4),(4,'A001','C04',2),(5,'A001','C05',1),(6,'A002','C01',3),(7,'A002','C02',4),(8,'A002','C03',2),(9,'A002','C04',2),(10,'A002','C05',3),(11,'A003','C01',5),(12,'A003','C02',3),(13,'A003','C03',3),(14,'A003','C04',2),(15,'A003','C05',2),(16,'A004','C01',5),(17,'A004','C02',4),(18,'A004','C03',5),(19,'A004','C04',3),(20,'A004','C05',1),(21,'A005','C01',4),(22,'A005','C02',3),(23,'A005','C03',2),(24,'A005','C04',1),(25,'A005','C05',1),(26,'A006','C01',2),(27,'A006','C02',2),(28,'A006','C03',2),(29,'A006','C04',1),(30,'A006','C05',1),(31,'A007','C01',2),(32,'A007','C02',4),(33,'A007','C03',4),(34,'A007','C04',3),(35,'A007','C05',2),(36,'A008','C01',4),(37,'A008','C02',4),(38,'A008','C03',1),(39,'A008','C04',2),(40,'A008','C05',4),(41,'A009','C01',4),(42,'A009','C02',1),(43,'A009','C03',4),(44,'A009','C04',2),(45,'A009','C05',2),(46,'A010','C01',3),(47,'A010','C02',3),(48,'A010','C03',5),(49,'A010','C04',2),(50,'A010','C05',1),(51,'A011','C01',1),(52,'A011','C02',4),(53,'A011','C03',5),(54,'A011','C04',3),(55,'A011','C05',4),(56,'A012','C01',2),(57,'A012','C02',4),(58,'A012','C03',2),(59,'A012','C04',1),(60,'A012','C05',2),(61,'A013','C01',3),(62,'A013','C02',3),(63,'A013','C03',4),(64,'A013','C04',2),(65,'A013','C05',2),(66,'A014','C01',4),(67,'A014','C02',4),(68,'A014','C03',1),(69,'A014','C04',3),(70,'A014','C05',4),(71,'A015','C01',1),(72,'A015','C02',2),(73,'A015','C03',4),(74,'A015','C04',3),(75,'A015','C05',5),(76,'A016','C01',2),(77,'A016','C02',1),(78,'A016','C03',3),(79,'A016','C04',4),(80,'A016','C05',2),(81,'A017','C01',3),(82,'A017','C02',2),(83,'A017','C03',3),(84,'A017','C04',5),(85,'A017','C05',1),(86,'A018','C01',4),(87,'A018','C02',2),(88,'A018','C03',4),(89,'A018','C04',1),(90,'A018','C05',2),(91,'A019','C01',2),(92,'A019','C02',1),(93,'A019','C03',4),(94,'A019','C04',4),(95,'A019','C05',2),(96,'A020','C01',2),(97,'A020','C02',4),(98,'A020','C03',5),(99,'A020','C04',2),(100,'A020','C05',1),(101,'A021','C01',5),(102,'A021','C02',3),(103,'A021','C03',3),(104,'A021','C04',2),(105,'A021','C05',2),(106,'A022','C01',2),(107,'A022','C02',2),(108,'A022','C03',2),(109,'A022','C04',2),(110,'A022','C05',2),(111,'A023','C01',3),(112,'A023','C02',4),(113,'A023','C03',2),(114,'A023','C04',5),(115,'A023','C05',1),(116,'A024','C01',2),(117,'A024','C02',2),(118,'A024','C03',3),(119,'A024','C04',4),(120,'A024','C05',5),(121,'A025','C01',4),(122,'A025','C02',3),(123,'A025','C03',2),(124,'A025','C04',3),(125,'A025','C05',1),(126,'A026','C01',4),(127,'A026','C02',3),(128,'A026','C03',3),(129,'A026','C04',4),(130,'A026','C05',4),(131,'A027','C01',2),(132,'A027','C02',3),(133,'A027','C03',5),(134,'A027','C04',3),(135,'A027','C05',1),(136,'A028','C01',2),(137,'A028','C02',5),(138,'A028','C03',4),(139,'A028','C04',2),(140,'A028','C05',2),(141,'A029','C01',3),(142,'A029','C02',5),(143,'A029','C03',2),(144,'A029','C04',3),(145,'A029','C05',2),(146,'A030','C01',5),(147,'A030','C02',2),(148,'A030','C03',5),(149,'A030','C04',3),(150,'A030','C05',4),(151,'A031','C01',2),(152,'A031','C02',3),(153,'A031','C03',2),(154,'A031','C04',1),(155,'A031','C05',2),(156,'A032','C01',4),(157,'A032','C02',2),(158,'A032','C03',3),(159,'A032','C04',3),(160,'A032','C05',4),(161,'A033','C01',4),(162,'A033','C02',1),(163,'A033','C03',3),(164,'A033','C04',3),(165,'A033','C05',4),(166,'A034','C01',2),(167,'A034','C02',5),(168,'A034','C03',4),(169,'A034','C04',4),(170,'A034','C05',3),(171,'A035','C01',4),(172,'A035','C02',2),(173,'A035','C03',2),(174,'A035','C04',3),(175,'A035','C05',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
