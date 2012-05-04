################################################################ 
## ADMINISTRATION
################################################################ 

TRUNCATE TABLE `ADMIN_User`;
ALTER TABLE `ADMIN_User` AUTO_INCREMENT =1;
INSERT INTO `ADMIN_User` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `name`, `surname`) VALUES
(1, 'etienne', 'etienne', 'etienne.lemontreer@batna.fr', 'etienne.lemontreer@batna.fr', 1, '1lboty2lsbdws8w48kks4cs0sccgks0', '5W5IX9/i9BR0GhIu1t0mcWy/fe6pjygkuDfEJQvFkwBkAukv9HAn+oCneYRec3fQltvswY9zLL52HVFM0MZ9ZA==', NULL, 0, 0, NULL, '20fgllbhfokgg0okkc80gc4k448gwcw8swgokkko4c4gg00ko8', NULL, 'a:4:{i:0;s:16:"ROLE_SUPER_ADMIN";i:1;s:13:"ROLE_REF_VIEW";i:2;s:10:"ROLE_ADMIN";i:3;s:13:"ROLE_REF_EDIT";}', 0, NULL, 'Etienne', 'Le Montreer'),
(2, 'mohammed', 'mohammed', 'mohammed.ghaciri@batna.fr', 'mohammed.ghaciri@batna.fr', 1, 'l3nysfwnaps0g8o804gsss4o4ggksgs', '4VvB1XnkxoFQ3MiXarR3STC4fAfImcYcNX/niyr1sRCAsHxNFIP9GhfxnmeeS6W5FMCAWSF2OOCqKf7panbmmg==', NULL, 0, 0, NULL, '48klpdbcmq4g4wok0w4c000040w88cg8wogkwo408c4k0sokss', NULL, 'a:0:{}', 0, NULL, 'Mohammed', 'Ghaciri');

TRUNCATE TABLE `ADMIN_Group`;
ALTER TABLE `ADMIN_Group` AUTO_INCREMENT =1;
INSERT INTO `ADMIN_Group` (`id`, `name`, `roles`) VALUES
(1, 'Administrateurs', 'a:2:{i:0;s:16:"ROLE_SUPER_ADMIN";i:1;s:10:"ROLE_ADMIN";}'),
(2, 'Equipe de production', 'a:2:{i:0;s:13:"ROLE_REF_VIEW";i:1;s:13:"ROLE_REF_EDIT";}'),
(3, 'Equipe projet', 'a:1:{i:0;s:13:"ROLE_REF_VIEW";}');

TRUNCATE TABLE `ADMIN_User_Group`;
ALTER TABLE `ADMIN_User_Group` AUTO_INCREMENT =1;
INSERT INTO `ADMIN_User_Group` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3);

TRUNCATE TABLE `ADMIN_Role`;
ALTER TABLE `ADMIN_Role` AUTO_INCREMENT =1;
INSERT INTO `monitoring`.`ADMIN_Role` (`name`) VALUES 
('ROLE_SUPER_ADMIN'),
('ROLE_ADMIN'), 
('ROLE_REF_VIEW'),
('ROLE_REF_EDIT');

################################################################
## ARCHITECTURE
################################################################

TRUNCATE TABLE `ARCHI_Contexte`;
ALTER TABLE `ARCHI_Contexte` AUTO_INCREMENT =1;
INSERT INTO `ARCHI_Contexte` (`id`, `name`) VALUES
(1, 'Développement'),
(2, 'Intégration'),
(3, 'Recette'),
(4, 'PréProduction'),
(5, 'Production');

TRUNCATE TABLE `ARCHI_Environnement`;
ALTER TABLE `ARCHI_Environnement` AUTO_INCREMENT =1;
INSERT INTO `ARCHI_Environnement` (`contexte_id`, `shortName`, `longName`, `description`) VALUES
(1, 'DEV1', 'Développement Hot Channel', 'Environnement destiné Ã  réaliser le développement de patch pour une mise en production rapide');

TRUNCATE TABLE `ARCHI_OS_Type`;
ALTER TABLE `ARCHI_OS_Type` AUTO_INCREMENT =1;
INSERT INTO `monitoring`.`ARCHI_OS_Type` (`name`) VALUES 
('Linux'), 
('BSD'), 
('UNIX'), 
('Windows'), 
('Mac OS'), 
('Solaris'),
('OS/2'),
('AS400');

TRUNCATE TABLE `ARCHI_OS_Version`;
ALTER TABLE `ARCHI_OS_Version` AUTO_INCREMENT =1;
INSERT INTO `monitoring`.`ARCHI_OS_Version` (`name`, `os_id`) VALUES 
('Server 2003 Enterprise', '4'),
('Server 2003 Enterprise R2', '4'),
('Server 2003 Enterprise R2 SP1', '4'),
('Server 2003 Enterprise R2 SP2', '4'),
('Ubuntu 11.10', '1');

TRUNCATE TABLE `ARCHI_Host`;
ALTER TABLE `ARCHI_Host` AUTO_INCREMENT =1;
INSERT INTO `monitoring`.`ARCHI_Host` (`os_id`, `hostname`, `ip`, `ram`, `cpuCore`, `cpuFrequency`, `isPhysical`) VALUES 
('5', 'Batna-Dev-SadHill', '192.168.0.37', '2048', '2', '2800', '0'), 
('5', 'Batna-Prod-Leone', '192.168.0.35', '2048', '2', '2800', '0'), 
('5', 'Batna-Dev-Spare', '192.168.0.33', '2048', '2', '2800', '0'),
('5', 'BAT002', '192.168.0.23', '8192', '4', '2800', '1');

TRUNCATE TABLE `ARCHI_Variable`;
ALTER TABLE `ARCHI_Variable` AUTO_INCREMENT =1;
INSERT INTO `monitoring`.`ARCHI_Variable` (`name`, `type`) VALUES 
('Première variable de contexte', 'contexte'), 
('Deuxième variable de contexte', 'contexte'), 
('Troisième variable de contexte', 'contexte'),
("Première variable d'environnement", 'environnement'),
("Deuxième variable d'environnement", 'environnement'),
("Troisième variable d'environnement", 'environnement');

################################################################
## ALERTE
################################################################

TRUNCATE TABLE `ALERTE_Categorie`;
ALTER TABLE `ALERTE_Categorie` AUTO_INCREMENT =1;
INSERT INTO `ALERTE_Categorie` (`id`, `type`, `libelle`) VALUES
(1, 'INFRA', 'Surveillance des espaces disques'),
(2, 'SIEBEL', 'Taux d''utilisation des composants');

TRUNCATE TABLE `ALERTE_Diffusion`;
ALTER TABLE `ALERTE_Diffusion` AUTO_INCREMENT =1;
INSERT INTO `ALERTE_Diffusion` (`id`, `libelle`) VALUES
(1, 'Dépassement de seuil sur les composants');

TRUNCATE TABLE `ALERTE_Seuil`;
ALTER TABLE `ALERTE_Seuil` AUTO_INCREMENT =1;
INSERT INTO `ALERTE_Seuil` (`id`, `categorie_id`, `diffusion_id`, `debut`, `fin`, `unite`, `severite`, `titre`, `message`, `variables`) VALUES
(1, 2, 1, 80, 89, '%', 'Warning', 'Taux d''utilisation élevé', 'Le composant :component: est utilisé à :valeur:%. Merci de voir si une action est à réaliser.', 'component;valeur'),
(2, 2, 1, 90, 99, '%', 'Critic', 'Taux d''utilisation trop élevé', 'Le composant :component: est utilisé à :valeur:%. Merci de calmer le jeu.', 'component;valeur'),
(3, 2, 1, 100, 100, '%', 'Fatal', 'Trop tard..', 'Le composant :component: est mort, vive le composent !', 'component;valeur');

TRUNCATE TABLE `ALERTE_Diffusion_Group`;
ALTER TABLE `ALERTE_Diffusion_Group` AUTO_INCREMENT =1;
INSERT INTO `ALERTE_Diffusion_Group` (`diffusion_id`, `group_id`) VALUES
(1, 1),
(1, 3);

TRUNCATE TABLE `ALERTE_Diffusion_User`;
ALTER TABLE `ALERTE_Diffusion_User` AUTO_INCREMENT =1;
INSERT INTO `ALERTE_Diffusion_User` (`diffusion_id`, `user_id`) VALUES
(1, 1);

################################################################
## SIEBEL
################################################################
#TRUNCATE TABLE `TOOLS_Document`;
#ALTER TABLE `TOOLS_Document` AUTO_INCREMENT =1;
INSERT INTO `monitoring`.`TOOLS_Document` (`id` ,`name`, `clientFileName` ,`path`) VALUES 
(NULL , 'siebns.dat', NULL , '/home/sentenza/workspace/Monitoring/web/upload/archi/gateways/siebns.dat_test');

TRUNCATE TABLE `SIEBEL_Gateway`;
ALTER TABLE `SIEBEL_Gateway` AUTO_INCREMENT =1;
INSERT INTO `SIEBEL_Gateway` (`host_id`, `environnement_id`, `port`, `version`, `name`, `description`, `fullName`, `enableState`, `objectId`, `createDefault`, `useDefault`, `enterprises`, `currentFile_id`) VALUES
(1, 1, 2320, '8.0 [20405] FRA', 'default', 'Siebel Gateway Server', 'Siebel Gateway', 'enabled', '0', 'SBA_80', 'SBA_80', 'a:0:{}', 1);

#TRUNCATE TABLE `SIEBEL_Enterprise`;
#ALTER TABLE `SIEBEL_Enterprise` AUTO_INCREMENT =1;
#INSERT INTO `monitoring`.`SIEBEL_Enterprise` (`gateway_id`, `name`, `fullName`, `description`, `signature`, `enableState`, `objectId`, `version`, `databasePlatform`, `useMSStored`, `attrDescription`, `databaseConStr`, `serverSequence`, `ComponentGroupSequence`, `ComponentSequence`, `namedSubsystemSequence`, `parameters`, `components`) VALUES 
#('1', 'ENT_PROD', 'foo', 'bar', 'foo', 'bar', 'foo', 'bar', 'foo', 'bar', 'foo', 'bar', 'foo', 'bar', 'foo', 'bar', 'a:0:{}', 'a:0:{}');

#TRUNCATE TABLE `SIEBEL_Server`;
#ALTER TABLE `SIEBEL_Server` AUTO_INCREMENT =1;
#INSERT INTO `SIEBEL_Server` (`host_id`, `enterprise_id`, `name`, `description`, `fullName`, `enableState`, `objectId`, `version`, `eventLog`, `parameters`, `attributes`) VALUES
#(1, 1, 'ENT_PROD_SVR1', 'foo', 'foo', 'foo', 'foo', 'foo', 'foo', 'a:0:{}', 'a:0:{}');

#TRUNCATE TABLE `SIEBEL_Component`;
#ALTER TABLE `SIEBEL_Component` AUTO_INCREMENT =1;
#INSERT INTO `SIEBEL_Component` (`name`, `runMode`, `incarnationNumber`, `fullName`, `description`, `componentType`, `serviceType`, `enableState`, `objectId`, `writeFlag`, `configFile`, `dataSource`, `namedDataSource`, `lang`, `parameters`) VALUES
#('dfg', 'fdg', 'fg', 'dfg', 'fg', 'dfgd', 'dfg', 'fdg', 'dfg', 'dfg', 'fdg', 'dfg', 'fdg', 'dfg', 'a:0:{}');


