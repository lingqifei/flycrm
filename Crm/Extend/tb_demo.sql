

DROP TABLE IF EXISTS `tb_demo`;
CREATE TABLE `tb_demo` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `content` text,
  `time` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


