ALTER TABLE `delivery` ADD `latitude` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL , ADD `longitude` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ;

INSERT INTO `settings` (`id`, `groups`, `keyword`, `value`) VALUES (NULL, 'map', 'latitude', '1.2800945'), (NULL, 'map', 'longitude', '103.8509491');