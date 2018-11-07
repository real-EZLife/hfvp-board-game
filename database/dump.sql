-- Création des rôles

INSERT INTO `role` (`role_id`,`role_name`,`role_power`) VALUES 
(1,'SuperAdmin', 1),
(2,'Admin', 10),
(3,'Player', 20);

-- Création du super-admin

INSERT INTO `user` VALUES ('epicadmin','Admin','EZLife','enterprise.ezlife@gmail.com','our-game-4-all','',1);

-- Création de l'utilisateur 'Designer'

INSERT INTO `user` VALUES ('epicdesign', 'Design', 'EZLife', 'enterprise.ezlife@gmail.com','design-my-life','',2);

-- Création des factions

INSERT INTO `faction`(`fac_name`) VALUES ('heroic');
INSERT INTO `faction`(`fac_name`) VALUES ('politic');

-- Création des types

INSERT INTO `type`(`type_name`) VALUES ('creature');
INSERT INTO `type`(`type_name`) VALUES ('spell');
INSERT INTO `type`(`type_name`) VALUES ('shield');
INSERT INTO `type`(`type_name`) VALUES ('special');