CREATE TABLE `auth_user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` datetime DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `auth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `admin` tinyint(4) DEFAULT '0',
  `active` tinyint(4) DEFAULT '1',
  `active_to` datetime DEFAULT NULL,
  `moderator` tinyint(4) DEFAULT '0',
  `ip_address` varchar(15) DEFAULT NULL,
  `last_ip_address` varchar(15) DEFAULT NULL,
  `time_stamp` datetime DEFAULT NULL,
  `last_time_stamp` datetime DEFAULT NULL,
  `time_stamp_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
