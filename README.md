# sage_inacct

Data Base stucture

create database sage;
use sage;

DROP TABLE IF EXISTS `sage_cource_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sage_cource_info` (
  `course_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `cource` varchar(250) NOT NULL COMMENT 'First name',
  `c_detail` varchar(250) NOT NULL COMMENT 'Last Name',
  `created_by` int unsigned NOT NULL COMMENT 'created user',
  `updated_by` int unsigned NOT NULL COMMENT 'updated user',
  `created_at` int unsigned NOT NULL COMMENT 'Create Time',
  `updated_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'Update Time',
  PRIMARY KEY (`course_id`),
  UNIQUE KEY `uk_cource` (`cource`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Cource Info';


DROP TABLE IF EXISTS `sage_student_course_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sage_student_course_info` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `student_id` int unsigned NOT NULL COMMENT 'Student Id',
  `cource_id` int unsigned NOT NULL COMMENT 'Cource Id',
  `created_by` int unsigned NOT NULL COMMENT 'created user',
  `updated_by` int unsigned NOT NULL COMMENT 'updated user',
  `created_at` int unsigned NOT NULL COMMENT 'Create Time',
  `updated_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'Update Time',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_srudent_cource` (`student_id`,`cource_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Student Cource Info';

DROP TABLE IF EXISTS `sage_student_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sage_student_info` (
  `student_id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `fname` varchar(250) NOT NULL COMMENT 'First name',
  `lname` varchar(250) NOT NULL COMMENT 'Last Name',
  `phone` varchar(20) NOT NULL COMMENT 'Phone name',
  `dob` int unsigned NOT NULL COMMENT 'Date Of Birth',
  `created_by` int unsigned NOT NULL COMMENT 'created user',
  `updated_by` int unsigned NOT NULL DEFAULT '0' COMMENT 'updated user',
  `created_at` int unsigned NOT NULL COMMENT 'Create Time',
  `updated_at` int unsigned NOT NULL DEFAULT '0' COMMENT 'Update Time',
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `uk_phone` (`phone`),
  KEY `idx_phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='Student Info';