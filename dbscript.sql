-- ---------------------------------------------------------------------------------- Create database--DROP DATABASE IF EXISTS seed;create database seed character set UTF8 collate utf8_bin;use seed;-- ---------------------------------------------------------------------------------- Codes--DROP TABLE IF EXISTS `codes`;CREATE TABLE `codes` (  `componentId` int(11) NOT NULL AUTO_INCREMENT,  `uniqueCode` varchar(128) NOT NULL,  `type` varchar(64) NOT NULL,  `value` varchar(255) NOT NULL,   `status` int(11) NOT NULL DEFAULT '0',  `version` int(11) DEFAULT '0',  `createddate` datetime DEFAULT NULL,  `createdby` bigint(20) DEFAULT NULL,  `updateddate` datetime DEFAULT NULL,  `updatedby` bigint(20) DEFAULT NULL,   PRIMARY KEY(`componentId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;CREATE UNIQUE INDEX codes_uniqueCode ON `codes`(uniqueCode, type);---- Dumping data for table `codes`--INSERT INTO `codes` (`componentId`, `uniqueCode`, `type`, `value`) VALUES(1, 'system_name', 'system_name', 'SEED'),(2, 'system_title', '', 'SEED');-- ------------------------------------------------------------ Table structure for table `functioncode`--DROP TABLE IF EXISTS `functioncode`;CREATE TABLE `functioncode` (  `componentId` bigint(20) NOT NULL AUTO_INCREMENT,  `uniqueCode` varchar(128) DEFAULT NULL,  `displayName` varchar(128) DEFAULT NULL,  `functionGroup` varchar(128) DEFAULT NULL,  `codeNumber` int(11) DEFAULT NULL,  `actionUrl` varchar(1024) DEFAULT NULL,  `isMenu` bit(1) DEFAULT NULL,  `status` int(11) NOT NULL DEFAULT '0',  `version` int(11) DEFAULT '0',  `createddate` datetime DEFAULT NULL,  `createdby` bigint(20) DEFAULT NULL,  `updateddate` datetime DEFAULT NULL,  `updatedby` bigint(20) DEFAULT NULL,   PRIMARY KEY(`componentId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;CREATE UNIQUE INDEX functioncode_uniqueCode ON functioncode(uniqueCode);---- Dumping data for table `functioncode`--INSERT INTO `functioncode` (`componentId`, `uniqueCode`, `displayName`, `functionGroup`, `codeNumber`, `actionUrl`, `isMenu`, `status`, `version`, `createddate`, `createdby`, `updateddate`, `updatedby`) VALUES(1, 'usersearch', 'Users', 'Config', 1001, 'user/search', b'1', 1, 0, NULL, NULL, NULL, NULL),(2, 'userget', 'User View', 'Config', 1002, 'user/get', b'0', 1, 0, NULL, NULL, NULL, NULL),(3, 'useradd', 'Add User', 'Config', 1003, 'user/add', b'0', 1, 0, NULL, NULL, NULL, NULL),(4, 'usermodify', 'Modify User', 'Config', 1004, 'user/modify', b'0', 1, 0, NULL, NULL, NULL, NULL),(5, 'userdelete', 'Delete User', 'Config', 1005, 'user/delete', b'0', 1, 0, NULL, NULL, NULL, NULL),(6, 'rolesearch', 'Roles', 'Config', 1006, 'role/search', b'1', 1, 0, NULL, NULL, NULL, NULL),(7, 'roleget', 'Role View', 'Config', 1007, 'role/get', b'0', 1, 0, NULL, NULL, NULL, NULL),(8, 'roleadd', 'Add Role', 'Config', 1008, 'role/add', b'0', 1, 0, NULL, NULL, NULL, NULL),(9, 'rolemodify', 'Modify Role', 'Config', 1009, 'role/modify', b'0', 1, 0, NULL, NULL, NULL, NULL),(10, 'roledelete', 'Delete Role', 'Config', 1010, 'role/delete', b'0', 1, 0, NULL, NULL, NULL, NULL),(11, 'functioncodesearch', 'Functions', 'Config', 1011, 'functioncode/search', b'1', 1, 0, NULL, NULL, NULL, NULL),(12, 'functioncodeget', 'Function View', 'Config', 1012, 'functioncode/get', b'0', 1, 0, NULL, NULL, NULL, NULL),(13, 'functioncodeadd', 'Add FunctionCode', 'Config', 1013, 'functioncode/add', b'0', 1, 0, NULL, NULL, NULL, NULL),(14, 'functioncodemodify', 'Modify FunctionCode', 'Config', 1014, 'functioncode/modify', b'0', 1, 0, NULL, NULL, NULL, NULL),(15, 'functioncodedelete', 'Delete FunctionCode', 'Config', 1015, 'functioncode/delete', b'0', 1, 0, NULL, NULL, NULL, NULL),(16, 'roleassignment', 'Role Assignment', 'Config', 1016, 'role/assignment', b'1', 1, 0, NULL, NULL, NULL, NULL),(17, 'functioncodeassignment', 'Function Assignment', 'Config', 1017, 'functioncode/assignment', b'1', 1, 0, NULL, NULL, NULL, NULL),(18, 'codesearch', 'Codes', 'Config', 1043, 'code/search', b'1', 1, 0, NULL, NULL, NULL, NULL),(19, 'codeadd', 'Code View', 'Config', 1044, 'code/add', b'0', 1, 0, NULL, NULL, NULL, NULL),(20, 'codesave', 'Code Save', 'Config', 1045, 'code/save', b'0', 1, 0, NULL, NULL, NULL, NULL),(21, 'codedelete', 'Code Delete', 'Config', 1046, 'code/delete', b'0', 1, 0, NULL, NULL, NULL, NULL);-- ------------------------------------------------------------ Table structure for table `functionrole`--DROP TABLE IF EXISTS `functionrole`;CREATE TABLE `functionrole` (  `componentId` bigint(20) NOT NULL AUTO_INCREMENT,  `functionId` bigint(20) NOT NULL,  `roleId` bigint(20) NOT NULL,  `status` int(11) NOT NULL DEFAULT '0',  `version` int(11) DEFAULT '0',  `createddate` datetime DEFAULT NULL,  `createdby` bigint(20) DEFAULT NULL,  `updateddate` datetime DEFAULT NULL,  `updatedby` bigint(20) DEFAULT NULL,   PRIMARY KEY(`componentId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;CREATE UNIQUE INDEX functionrole_functionId_roleId ON functionrole(functionId, roleId);---- Dumping data for table `functionrole`--INSERT INTO `functionrole` (`componentId`, `functionId`, `roleId`, `status`, `version`, `createddate`, `createdby`, `updateddate`, `updatedby`) VALUES(1, 1, 1, 0, 0, NULL, NULL, NULL, NULL),(2, 2, 1, 0, 0, NULL, NULL, NULL, NULL),(3, 3, 1, 0, 0, NULL, NULL, NULL, NULL),(4, 4, 1, 0, 0, NULL, NULL, NULL, NULL),(5, 5, 1, 0, 0, NULL, NULL, NULL, NULL),(6, 6, 1, 0, 0, NULL, NULL, NULL, NULL),(7, 7, 1, 0, 0, NULL, NULL, NULL, NULL),(8, 8, 1, 0, 0, NULL, NULL, NULL, NULL),(9, 9, 1, 0, 0, NULL, NULL, NULL, NULL),(10, 10, 1, 0, 0, NULL, NULL, NULL, NULL),(11, 11, 1, 0, 0, NULL, NULL, NULL, NULL),(12, 12, 1, 0, 0, NULL, NULL, NULL, NULL),(13, 13, 1, 0, 0, NULL, NULL, NULL, NULL),(14, 14, 1, 0, 0, NULL, NULL, NULL, NULL),(15, 15, 1, 0, 0, NULL, NULL, NULL, NULL),(16, 16, 1, 0, 0, NULL, NULL, NULL, NULL),(17, 17, 1, 0, 0, NULL, NULL, NULL, NULL),(18, 18, 1, 0, 0, NULL, NULL, NULL, NULL),(19, 19, 1, 0, 0, NULL, NULL, NULL, NULL),(20, 20, 1, 0, 0, NULL, NULL, NULL, NULL),(21, 21, 1, 0, 0, NULL, NULL, NULL, NULL),(22, 22, 1, 0, 0, NULL, NULL, NULL, NULL),(23, 23, 1, 0, 0, NULL, NULL, NULL, NULL),(24, 24, 1, 0, 0, NULL, NULL, NULL, NULL),(25, 25, 1, 0, 0, NULL, NULL, NULL, NULL);-- ------------------------------------------------------------ Table structure for table `role`--DROP TABLE IF EXISTS `role`;CREATE TABLE `role` (  `componentId` bigint(20) NOT NULL AUTO_INCREMENT,  `uniqueCode` varchar(128) DEFAULT NULL,  `description` varchar(512) DEFAULT NULL,  `status` int(11) NOT NULL DEFAULT '0',  `version` int(11) DEFAULT '0',  `createddate` datetime DEFAULT NULL,  `createdby` bigint(20) DEFAULT NULL,  `updateddate` datetime DEFAULT NULL,  `updatedby` bigint(20) DEFAULT NULL,   PRIMARY KEY(`componentId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;CREATE UNIQUE INDEX role_uniqueCode ON role(uniqueCode);---- Dumping data for table `role`--INSERT INTO `role` (`componentId`, `uniqueCode`, `description`, `status`, `version`, `createddate`, `createdby`, `updateddate`, `updatedby`) VALUES(1, 'System Admin', 'System Admin Role', 1, 0, NULL, NULL, NULL, NULL),(2, 'Customer', 'Customer Role', 1, 0, NULL, NULL, NULL, NULL),(3, 'Partner', 'Partner Role', 1, 0, NULL, NULL, NULL, NULL);---- Table structure for table `user`--DROP TABLE IF EXISTS `user`;CREATE TABLE `user` (  `componentId` bigint(20) NOT NULL AUTO_INCREMENT,  `uniqueCode` varchar(50) DEFAULT NULL,  `firstName` varchar(50) DEFAULT NULL,  `lastName` varchar(50) DEFAULT NULL,  `password` varchar(1024) DEFAULT NULL,  `email` varchar(255) DEFAULT NULL,  `contactNo` varchar(20) DEFAULT NULL,  `type` varchar(255) DEFAULT NULL,  `groupId` bigint(20) DEFAULT NULL,  `status` int(11) NOT NULL DEFAULT '0',  `version` int(11) DEFAULT '0',  `createddate` datetime DEFAULT NULL,  `createdby` bigint(20) DEFAULT NULL,  `updateddate` datetime DEFAULT NULL,  `updatedby` bigint(20) DEFAULT NULL,   PRIMARY KEY(`componentId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;CREATE UNIQUE INDEX user_uniqueCode ON user(uniqueCode);---- Dumping data for table `user`--INSERT INTO `user` (`componentId`, `uniqueCode`, `firstName`, `lastName`, `password`, `email`, `type`, `status`, `version`, `createddate`, `createdby`, `updateddate`, `updatedby`) VALUES(1, 'admin', 'Admin', '1', 'c5edac1b8c1d58bad90a246d8f08f53b', 'admin@xsoft.com', 'admin', 1, 0, NULL, NULL, NULL, NULL),(2, 'customer', 'Customer', '1', 'c5edac1b8c1d58bad90a246d8f08f53b', 'admin@xsoft.com', 'customer', 1, 0, NULL, NULL, NULL, NULL),(3, 'partner', 'Partner', '1', 'c5edac1b8c1d58bad90a246d8f08f53b', 'admin@xsoft.com', 'partner', 1, 0, NULL, NULL, NULL, NULL);-- ------------------------------------------------------------ Table structure for table `userrole`--DROP TABLE IF EXISTS `userrole`;CREATE TABLE `userrole` (  `componentId` bigint(20) NOT NULL AUTO_INCREMENT,  `userId` bigint(20) NOT NULL,  `roleId` bigint(20) NOT NULL,  `status` int(11) NOT NULL DEFAULT '0',  `version` int(11) DEFAULT '0',  `createddate` datetime DEFAULT NULL,  `createdby` bigint(20) DEFAULT NULL,  `updateddate` datetime DEFAULT NULL,  `updatedby` bigint(20) DEFAULT NULL,   PRIMARY KEY(`componentId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;CREATE UNIQUE INDEX userrole_userId_roleId ON userrole(userId, roleId);---- Dumping data for table `userrole`--INSERT INTO `userrole` (`componentId`, `userId`, `roleId`, `status`, `version`, `createddate`, `createdby`, `updateddate`, `updatedby`) VALUES(1, 1, 1, 1, 1, NULL, NULL, NULL, NULL),(2, 2, 2, 1, 1, NULL, NULL, NULL, NULL),(3, 3, 3, 1, 1, NULL, NULL, NULL, NULL);-- ------------------------------------------------------------ Structure for view `vfunctiongroups`--DROP VIEW IF EXISTS `vfunctiongroups`;CREATE  VIEW `vfunctiongroups`  AS  select `f`.`functionGroup` AS `functionGroup`,min(`f`.`componentId`) AS `functionid`,count(0) AS `rownum`,`u`.`userId` AS `userid` from ((`functioncode` `f` join `functionrole` `r` on((`f`.`componentId` = `r`.`functionId`))) join `userrole` `u` on((`r`.`roleId` = `u`.`roleId`))) group by `u`.`userId`,`f`.`functionGroup` ;-- ------------------------------------------------------------ Structure for view `vuserfunctions`--DROP VIEW IF EXISTS `vuserfunctions`;CREATE  VIEW `vuserfunctions`  AS  select `f`.`componentId` AS `componentId`,`f`.`uniqueCode` AS `uniqueCode`,`f`.`displayName` AS `displayName`,`f`.`functionGroup` AS `functionGroup`,`f`.`codeNumber` AS `codeNumber`,`f`.`actionUrl` AS `actionUrl`,`f`.`isMenu` AS `isMenu`,`f`.`status` AS `status`,`f`.`version` AS `version`,`f`.`createddate` AS `createddate`,`f`.`createdby` AS `createdby`,`f`.`updateddate` AS `updateddate`,`f`.`updatedby` AS `updatedby`,`u`.`userId` AS `userid` from ((`functioncode` `f` join `functionrole` `r` on((`f`.`componentId` = `r`.`functionId`))) join `userrole` `u` on((`r`.`roleId` = `u`.`roleId`))) ;---- Table structure for table `user`--DROP TABLE IF EXISTS `event`;CREATE TABLE `event` (  `componentId` bigint(20) NOT NULL AUTO_INCREMENT,  `uniqueCode` varchar(50) DEFAULT NULL,  `title` varchar(255) DEFAULT NULL,  `description` varchar(1024) DEFAULT NULL,  `locationAddr1` varchar(1024) DEFAULT NULL,  `locationAddr2` varchar(255) DEFAULT NULL,  `city` varchar(20) DEFAULT NULL,  `zip` varchar(255) DEFAULT NULL,  `status` int(11) NOT NULL DEFAULT '0',  `version` int(11) DEFAULT '0',  `createddate` datetime DEFAULT NULL,  `createdby` bigint(20) DEFAULT NULL,  `updateddate` datetime DEFAULT NULL,  `updatedby` bigint(20) DEFAULT NULL,   PRIMARY KEY(`componentId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;CREATE UNIQUE INDEX user_uniqueCode ON user(uniqueCode);INSERT INTO `functioncode` (`uniqueCode`, `displayName`, `functionGroup`, `codeNumber`, `actionUrl`, `isMenu`, `status`, `version`, `createddate`, `createdby`, `updateddate`, `updatedby`) VALUES('eventsearch', 'Events', 'Event', 1043, 'event/search', b'1', 1, 0, NULL, NULL, NULL, NULL),('eventadd', 'Event View', 'Event', 1044, 'event/add', b'0', 1, 0, NULL, NULL, NULL, NULL),('eventsave', 'Event Save', 'Event', 1045, 'event/save', b'0', 1, 0, NULL, NULL, NULL, NULL),('eventdelete', 'Event Delete', 'Event', 1046, 'event/delete', b'0', 1, 0, NULL, NULL, NULL, NULL);ALTER TABLE event ADD COLUMN `date` DATETIME DEFAULT NULL; 