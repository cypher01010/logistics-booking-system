INSERT INTO `settings` (`id`, `groups`, `keyword`, `value`) VALUES (NULL, 'cron', 'hour', '18:00:00');
INSERT INTO `settings` (`id`, `groups`, `keyword`, `value`) VALUES (NULL, 'cron', 'flag', 'listen');


CREATE TABLE `cron` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `time` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;