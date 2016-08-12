/*
MySQL Backup
Source Server Version: 5.5.8
Source Database: ljcms
Date: 2012-2-13 21:04:33
*/

DROP TABLE IF EXISTS `ljcms_admin`;

CREATE TABLE IF NOT EXISTS `ljcms_admin` (
  `adminid` mediumint(8) unsigned NOT NULL default '0',
  `adminname` varchar(50) default NULL,
  `password` varchar(50) default NULL,
  `groupid` mediumint(8) unsigned default '0',
  `super` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `logintimeline` int(10) unsigned default '0',
  `logintimes` int(10) unsigned default '0',
  `loginip` varchar(50) default NULL,
  `memo` varchar(500) default NULL,
  PRIMARY KEY  (`adminid`),
  KEY `flag` (`flag`),
  KEY `groupid` (`groupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_adsfigure`;

CREATE TABLE IF NOT EXISTS `ljcms_adsfigure` (
  `adsid` mediumint(8) unsigned NOT NULL default '0',
  `adsname` varchar(255) default NULL,
  `zoneid` mediumint(8) unsigned default '0',
  `uploadfiles` varchar(255) default NULL,
  `url` varchar(255) default NULL,
  `width` smallint(2) unsigned default '0',
  `height` smallint(2) unsigned default '0',
  `orders` mediumint(8) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `content` text,
  `timeline` int(10) unsigned default '0',
  PRIMARY KEY  (`adsid`),
  KEY `zoneid` (`zoneid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_adszone`;

CREATE TABLE IF NOT EXISTS `ljcms_adszone` (
  `zoneid` mediumint(8) unsigned NOT NULL default '0',
  `zonename` varchar(255) default NULL,
  `zonelabel` varchar(255) default NULL,
  `skinid` mediumint(8) unsigned default '0',
  `orders` mediumint(8) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `width` smallint(2) unsigned default '0',
  `height` smallint(2) unsigned default '0',
  `slide` smallint(2) unsigned default '0',
  `zonetype` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  PRIMARY KEY  (`zoneid`),
  KEY `skinid` (`skinid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_applyjob`;

CREATE TABLE IF NOT EXISTS `ljcms_applyjob` (
  `aid` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `jobid` int(6) NOT NULL,
  `userid` int(11) NOT NULL default '0',
  `sex` int(2) NOT NULL,
  `brothday` varchar(10) default '',
  `chinatext` varchar(200) default '',
  `telno` varchar(100) default '',
  `email` varchar(200) default '',
  `degree` varchar(200) default '',
  `prosesion` varchar(200) default '',
  `school` varchar(200) default '',
  `address` varchar(200) default '',
  `awards` text,
  `experience` text,
  `hobby` text,
  `flag` smallint(2) NOT NULL default '0',
  `ip` varchar(50) NOT NULL,
  `addtime` varchar(20) NOT NULL,
  `RelyContent` text NOT NULL,
  PRIMARY KEY  (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

DROP TABLE IF EXISTS `ljcms_article`;

CREATE TABLE IF NOT EXISTS `ljcms_article` (
  `articleid` mediumint(8) unsigned NOT NULL default '0',
  `cateid` mediumint(8) unsigned default '0',
  `title` varchar(255) default NULL,
  `thumbfiles` varchar(255) default NULL,
  `uploadfiles` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `timeline` int(10) unsigned default '0',
  `author` varchar(50) default NULL,
  `cfrom` varchar(50) default NULL,
  `flag` smallint(2) unsigned default '0',
  `istop` smallint(2) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `headline` smallint(2) unsigned default '0',
  `slide` smallint(2) unsigned default '0',
  `hits` int(10) unsigned default '0',
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `delimitname` varchar(255) default NULL,
  `deleted` smallint(2) unsigned default '0',
  `tag` varchar(255) default NULL,
  PRIMARY KEY  (`articleid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_articlecate`;

CREATE TABLE IF NOT EXISTS `ljcms_articlecate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` mediumint(8) unsigned default '0',
  `orders` mediumint(8) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `cssname` varchar(50) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `orders` (`orders`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_authgroup`;

CREATE TABLE IF NOT EXISTS `ljcms_authgroup` (
  `groupid` mediumint(8) unsigned NOT NULL default '0',
  `groupname` varchar(50) default NULL,
  `auths` text,
  `flag` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `orders` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  PRIMARY KEY  (`groupid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_case`;

CREATE TABLE IF NOT EXISTS `ljcms_case` (
  `caseid` mediumint(8) unsigned NOT NULL default '0',
  `title` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `delimitname` varchar(255) default NULL,
  `thumbfiles` varchar(255) default NULL,
  `uploadfiles` varchar(255) default NULL,
  `intro` text,
  `content` text,
  `cateid` mediumint(8) unsigned default '0',
  `hits` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `isnew` smallint(2) unsigned default '0',
  `hots` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `ugroupid` varchar(100) NOT NULL,
  `exclusive` varchar(20) NOT NULL,
  `timeline` int(10) unsigned default '0',
  `deleted` smallint(2) unsigned default '0',
  `tag` varchar(255) default NULL,
  PRIMARY KEY  (`caseid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_casecate`;

CREATE TABLE IF NOT EXISTS `ljcms_casecate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` mediumint(8) unsigned default '0',
  `orders` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `cssname` varchar(50) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `flag` (`flag`),
  KEY `orders` (`orders`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_config`;

CREATE TABLE IF NOT EXISTS `ljcms_config` (
  `sitename` varchar(255) default NULL,
  `sitetitle` varchar(255) default NULL,
  `siteurl` varchar(255) default NULL,
  `metadescription` varchar(500) default NULL,
  `metakeyword` varchar(500) default NULL,
  `sitecopyright` text,
  `icpcode` varchar(255) default NULL,
  `tjcode` text,
  `about` text,
  `contact` text,
  `logoimg` varchar(255) default NULL,
  `logowidth` smallint(2) unsigned default '0',
  `logoheight` smallint(2) unsigned default '0',
  `bannerimg` varchar(255) default NULL,
  `bannerwidth` smallint(2) unsigned default '0',
  `bannerheight` smallint(2) unsigned default '0',
  `licestatus` smallint(2) unsigned default '0',
  `softkey` varchar(50) default NULL,
  `htmltype` varchar(50) default NULL,
  `routeurltype` smallint(2) unsigned default '0',
  `maxthumbwidth` smallint(2) unsigned default '0',
  `maxthumbheight` smallint(2) unsigned default '0',
  `thumbwidth` smallint(2) unsigned default '0',
  `thumbheight` smallint(2) unsigned default '0',
  `productthumbwidth` smallint(2) unsigned default '0',
  `productthumbheight` smallint(2) unsigned default '0',
  `casethumbwidth` smallint(2) unsigned default '0',
  `casethumbheight` smallint(2) unsigned default '0',
  `solutionthumbwidth` smallint(2) unsigned default '0',
  `solutionthumbheight` smallint(2) unsigned default '0',
  `watermarkflag` smallint(2) unsigned default '0',
  `watermarkfile` varchar(255) default NULL,
  `watermarkpos` smallint(2) unsigned default '0',
  `newspagesize` smallint(2) unsigned default '15',
  `newsnum` smallint(2) unsigned default '10',
  `newslen` smallint(2) unsigned default '10',
  `articlepagesize` smallint(2) unsigned default '15',
  `articlenum` smallint(2) unsigned default '10',
  `articlelen` smallint(2) unsigned default '10',
  `productpagesize` smallint(2) unsigned default '15',
  `productnum` smallint(2) unsigned default '10',
  `productlen` smallint(2) unsigned default '10',
  `casepagesize` smallint(2) unsigned default '15',
  `casenum` smallint(2) unsigned default '10',
  `caselen` smallint(2) unsigned default '10',
  `jobpagesize` smallint(2) unsigned default '15',
  `jobnum` smallint(2) unsigned default '10',
  `joblen` smallint(2) unsigned default '10',
  `downpagesize` smallint(2) unsigned default '15',
  `downnum` smallint(2) unsigned default '10',
  `downlen` smallint(2) unsigned default '10',
  `solutionpagesize` smallint(2) unsigned default '15',
  `solutionnum` smallint(2) unsigned default '10',
  `solutionlen` smallint(2) unsigned default '10',
  `eliteproductnum` smallint(2) unsigned default '15',
  `eliteproductlen` smallint(2) unsigned default '10',
  `qqstatus` smallint(2) unsigned default '0',
  `cachstatus` smallint(2) unsigned default '0',
  `cachtime` mediumint(8) unsigned default '0',
  `tagrange` smallint(2) unsigned default '0',
  `tagurlnum` smallint(2) unsigned default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_delimitlabel`;

CREATE TABLE IF NOT EXISTS `ljcms_delimitlabel` (
  `labelid` mediumint(8) unsigned NOT NULL default '0',
  `skinid` mediumint(8) unsigned default '0',
  `labeltitle` varchar(255) default NULL,
  `labelname` varchar(255) default NULL,
  `labelcontent` text,
  `flag` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `intro` varchar(500) default NULL,
  PRIMARY KEY  (`labelid`),
  KEY `skinid` (`skinid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_download`;

CREATE TABLE IF NOT EXISTS `ljcms_download` (
  `downid` mediumint(8) unsigned NOT NULL default '0',
  `title` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `uploadfiles` varchar(255) default NULL,
  `filesize` varchar(50) default NULL,
  `intro` text,
  `content` text,
  `cateid` mediumint(8) unsigned default '0',
  `hits` int(10) unsigned default '0',
  `downs` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `hots` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `ugroupid` varchar(100) NOT NULL,
  `exclusive` varchar(20) NOT NULL,
  `dateline` int(10) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `deleted` smallint(2) unsigned default '0',
  `tag` varchar(255) default NULL,
  PRIMARY KEY  (`downid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_downloadcate`;

CREATE TABLE IF NOT EXISTS `ljcms_downloadcate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` mediumint(8) unsigned default '0',
  `orders` mediumint(8) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `cssname` varchar(50) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `orders` (`orders`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_guestbook`;

CREATE TABLE IF NOT EXISTS `ljcms_guestbook` (
  `bookid` int(10) unsigned NOT NULL default '0',
  `title` varchar(255) default NULL,
  `bookuser` varchar(255) default NULL,
  `gender` smallint(2) unsigned default '0',
  `jobs` varchar(50) default NULL,
  `telephone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `mobile` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `qqmsn` varchar(255) default NULL,
  `companyname` varchar(255) default NULL,
  `address` varchar(255) default NULL,
  `trade` varchar(255) default NULL,
  `homepage` varchar(255) default NULL,
  `content` text,
  `booktimeline` int(10) unsigned default '0',
  `ip` varchar(50) default NULL,
  `userid` int(4) NOT NULL,
  `flag` smallint(2) unsigned default '0',
  `replyuser` varchar(50) default NULL,
  `replytimeline` int(10) unsigned default '0',
  `replycontent` text,
  PRIMARY KEY  (`bookid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_info`;

CREATE TABLE IF NOT EXISTS `ljcms_info` (
  `infoid` mediumint(8) unsigned NOT NULL default '0',
  `cateid` mediumint(8) unsigned default '0',
  `title` varchar(255) default NULL,
  `thumbfiles` varchar(255) default NULL,
  `uploadfiles` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `ugroupid` varchar(100) NOT NULL,
  `exclusive` varchar(20) NOT NULL,
  `hits` int(10) unsigned default '0',
  `orders` mediumint(8) unsigned default '0',
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `delimitname` varchar(255) default NULL,
  `tag` varchar(255) default NULL,
  PRIMARY KEY  (`infoid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_infocate`;

CREATE TABLE IF NOT EXISTS `ljcms_infocate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` mediumint(8) unsigned default '0',
  `orders` mediumint(8) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `cssname` varchar(50) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `orders` (`orders`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_job`;

CREATE TABLE IF NOT EXISTS `ljcms_job` (
  `jobid` mediumint(8) unsigned NOT NULL default '0',
  `cateid` mediumint(8) unsigned default '0',
  `title` varchar(255) default NULL,
  `workarea` varchar(50) default NULL,
  `number` smallint(2) unsigned default '0',
  `jobdescription` text,
  `jobrequest` text,
  `jobotherrequest` text,
  `jobcontact` text,
  `timeline` int(10) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `hits` int(10) unsigned default '0',
  PRIMARY KEY  (`jobid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_jobcate`;

CREATE TABLE IF NOT EXISTS `ljcms_jobcate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` mediumint(8) unsigned default '0',
  `orders` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `cssname` varchar(255) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `orders` (`orders`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_link`;

CREATE TABLE IF NOT EXISTS `ljcms_link` (
  `linkid` mediumint(8) unsigned NOT NULL default '0',
  `linktitle` varchar(255) default NULL,
  `fontcolor` varchar(50) default NULL,
  `linkurl` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '0',
  `logoimg` varchar(255) default NULL,
  `timeline` int(10) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(255) default NULL,
  `orders` smallint(2) unsigned default '0',
  PRIMARY KEY  (`linkid`),
  KEY `flag` (`flag`),
  KEY `linktype` (`linktype`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_log`;

CREATE TABLE IF NOT EXISTS `ljcms_log` (
  `logid` int(10) unsigned NOT NULL default '0',
  `username` varchar(50) default NULL,
  `ip` varchar(50) default NULL,
  `content` varchar(255) default NULL,
  `logtype` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  PRIMARY KEY  (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_onlinechat`;

CREATE TABLE IF NOT EXISTS `ljcms_onlinechat` (
  `onid` mediumint(8) unsigned NOT NULL default '0',
  `ontype` smallint(2) unsigned default '0',
  `title` varchar(255) default NULL,
  `number` varchar(255) default NULL,
  `sitetitle` varchar(255) default NULL,
  `orders` mediumint(8) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  PRIMARY KEY  (`onid`),
  KEY `flag` (`flag`),
  KEY `orders` (`orders`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_order`;

CREATE TABLE IF NOT EXISTS `ljcms_order` (
  `id` int(10) unsigned NOT NULL default '0',
  `ordername` varchar(255) default NULL,
  `remark` varchar(255) default NULL,
  `userid` int(6) unsigned default '0',
  `username` varchar(255) default NULL,
  `sex` varchar(50) default NULL,
  `company` varchar(50) default NULL,
  `address` varchar(255) default NULL,
  `zipcode` varchar(255) default NULL,
  `telephone` varchar(255) default NULL,
  `fax` varchar(255) default NULL,
  `mobile` varchar(255) default NULL,
  `email` varchar(255) default NULL,
  `addtime` int(11) NOT NULL default '0',
  `flag` smallint(2) unsigned NOT NULL,
  `ip` varchar(100) NOT NULL,
  `replyuser` varchar(500) NOT NULL,
  `replycontent` text,
  `replytime` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_page`;

CREATE TABLE IF NOT EXISTS `ljcms_page` (
  `pageid` mediumint(8) unsigned NOT NULL default '0',
  `cateid` mediumint(8) unsigned default '0',
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(500) default NULL,
  `target` smallint(2) unsigned default '1',
  `title` varchar(255) default NULL,
  `content` text,
  `flag` smallint(2) unsigned default '0',
  `navshow` smallint(2) unsigned default '0',
  `orders` mediumint(8) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `delimitname` varchar(255) default NULL,
  `tag` varchar(255) default NULL,
  PRIMARY KEY  (`pageid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`),
  KEY `showstatus` (`navshow`),
  KEY `orders` (`orders`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_pagecate`;

CREATE TABLE IF NOT EXISTS `ljcms_pagecate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` smallint(2) unsigned default '0',
  `orders` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `cssname` varchar(50) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_product`;

CREATE TABLE IF NOT EXISTS `ljcms_product` (
  `productid` mediumint(8) unsigned NOT NULL default '0',
  `cateid` mediumint(8) unsigned default '0',
  `productnum` varchar(50) default NULL,
  `productname` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `delimitname` varchar(255) default NULL,
  `thumbfiles` varchar(255) default NULL,
  `uploadfiles` varchar(255) default NULL,
  `img1` varchar(255) default NULL,
  `img2` varchar(255) default NULL,
  `img3` varchar(255) default NULL,
  `img4` varchar(255) default NULL,
  `img5` varchar(255) default NULL,
  `img6` varchar(255) default NULL,
  `img7` varchar(255) default NULL,
  `img8` varchar(255) default NULL,
  `intro` text,
  `content` text,
  `price` decimal(18,2) unsigned default '0.00',
  `ugroupid` varchar(100) NOT NULL,
  `exclusive` varchar(20) NOT NULL,
  `hits` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `isnew` smallint(2) unsigned default '0',
  `hots` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `deleted` smallint(2) unsigned default '0',
  `tag` varchar(255) default NULL,
  PRIMARY KEY  (`productid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_productcate`;

CREATE TABLE IF NOT EXISTS `ljcms_productcate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` mediumint(8) unsigned default '0',
  `orders` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `cssname` varchar(50) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `orders` (`orders`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_skin`;

CREATE TABLE IF NOT EXISTS `ljcms_skin` (
  `skinid` mediumint(8) unsigned NOT NULL default '0',
  `skinname` varchar(255) default NULL,
  `skindir` varchar(50) default NULL,
  `skinext` varchar(50) default NULL,
  `thumbfiles` varchar(255) default NULL,
  `orders` mediumint(8) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `remark` varchar(500) default NULL,
  PRIMARY KEY  (`skinid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_solution`;

CREATE TABLE IF NOT EXISTS `ljcms_solution` (
  `solutionid` mediumint(8) unsigned NOT NULL default '0',
  `cateid` mediumint(8) unsigned default '0',
  `title` varchar(255) default NULL,
  `thumbfiles` varchar(255) default NULL,
  `uploadfiles` varchar(255) default NULL,
  `summary` text,
  `content` text,
  `timeline` int(10) unsigned default '0',
  `author` varchar(50) default NULL,
  `cfrom` varchar(50) default NULL,
  `flag` smallint(2) unsigned default '0',
  `ugroupid` varchar(100) NOT NULL,
  `exclusive` varchar(20) NOT NULL,
  `istop` smallint(2) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `headline` smallint(2) unsigned default '0',
  `slide` smallint(2) unsigned default '0',
  `hits` int(10) unsigned default '0',
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `delimitname` varchar(255) default NULL,
  `deleted` smallint(2) unsigned default '0',
  `tag` varchar(255) default NULL,
  PRIMARY KEY  (`solutionid`),
  KEY `cateid` (`cateid`),
  KEY `flag` (`flag`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_solutioncate`;

CREATE TABLE IF NOT EXISTS `ljcms_solutioncate` (
  `cateid` mediumint(8) unsigned NOT NULL default '0',
  `catename` varchar(255) default NULL,
  `metatitle` varchar(255) default NULL,
  `metakeyword` varchar(255) default NULL,
  `metadescription` varchar(255) default NULL,
  `pathname` varchar(50) default NULL,
  `parentid` mediumint(8) unsigned default '0',
  `depth` mediumint(8) unsigned default '0',
  `orders` smallint(2) unsigned default '0',
  `flag` smallint(2) unsigned default '0',
  `intro` varchar(500) default NULL,
  `timeline` int(10) unsigned default '0',
  `elite` smallint(2) unsigned default '0',
  `cssname` varchar(50) default NULL,
  `img` varchar(255) default NULL,
  `linktype` smallint(2) unsigned default '1',
  `linkurl` varchar(255) default NULL,
  `target` smallint(2) unsigned default '1',
  PRIMARY KEY  (`cateid`),
  KEY `parentid` (`parentid`),
  KEY `flag` (`flag`),
  KEY `orders` (`orders`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_tag`;

CREATE TABLE IF NOT EXISTS `ljcms_tag` (
  `tagid` mediumint(8) unsigned NOT NULL default '0',
  `tag` varchar(255) default NULL,
  `channel` varchar(50) default NULL,
  `orders` smallint(2) unsigned default '0',
  `url` varchar(500) default NULL,
  `flag` smallint(2) unsigned default '0',
  `timeline` int(10) unsigned default '0',
  `target` smallint(2) unsigned default '0',
  `color` varchar(10) default NULL,
  `strong` smallint(2) unsigned default '0',
  PRIMARY KEY  (`tagid`),
  KEY `flag` (`flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ljcms_user`;

CREATE TABLE IF NOT EXISTS `ljcms_user` (
  `userid` int(11) NOT NULL auto_increment,
  `loginname` varchar(30) NOT NULL default '',
  `salt` varchar(32) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `postnums` int(11) NOT NULL default '0',
  `realname` varchar(30) default '',
  `explam` text,
  `url` varchar(200) default '',
  `email` varchar(200) default '',
  `regdate` int(11) NOT NULL default '0',
  `stopdate` int(11) NOT NULL default '0',
  `usergroupid` int(11) NOT NULL default '0',
  `pointnum` int(11) NOT NULL default '0',
  `flag` smallint(2) NOT NULL default '0',
  `nicename` varchar(30) default '',
  `address` varchar(200) default '',
  `headimg` varchar(200) default '',
  `brothday` varchar(10) default '',
  `sex` int(11) NOT NULL default '0',
  `im` varchar(200) default '',
  `telno` varchar(100) default '',
  `lastlogindate` int(11) NOT NULL default '0',
  `lastloginip` varchar(100) default '',
  `forgetpwd` varchar(200) default '',
  `memo` text,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

DROP TABLE IF EXISTS `ljcms_usergroup`;

CREATE TABLE IF NOT EXISTS `ljcms_usergroup` (
  `usergroupid` mediumint(8) unsigned NOT NULL default '0',
  `grupname` varchar(255) default NULL,
  `level` varchar(50) NOT NULL default '0',
  `menu` text,
  `gpurview` int(4) NOT NULL default '0',
  `flag` smallint(2) NOT NULL,
  `addtime` varchar(100) default NULL,
  `intro` varchar(255) default NULL,
  PRIMARY KEY  (`usergroupid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ljcms_adsfigure` (`adsid`, `adsname`, `zoneid`, `uploadfiles`, `url`, `width`, `height`, `orders`, `flag`, `content`, `timeline`) VALUES(4, 's', 3, 'data/attachment/201202/12/7b1081c81c7bb36ee68ef27d3d05fc1e.jpg', '', 0, 0, 4, 1, '', 1317031391);

INSERT INTO `ljcms_adsfigure` (`adsid`, `adsname`, `zoneid`, `uploadfiles`, `url`, `width`, `height`, `orders`, `flag`, `content`, `timeline`) VALUES(3, 's', 2, 'data/attachment/201202/12/5251b2586a5df2d70669b8bf9eabd8a4.jpg', '', 0, 0, 3, 1, '', 1317031377);

INSERT INTO `ljcms_adsfigure` (`adsid`, `adsname`, `zoneid`, `uploadfiles`, `url`, `width`, `height`, `orders`, `flag`, `content`, `timeline`) VALUES(2, '2', 1, 'data/attachment/201202/12/92b4fa6cbd8596c42d7b745bdd96f7dc.jpg', 'index.php', 0, 0, 1, 1, '', 1317031316);

INSERT INTO `ljcms_adsfigure` (`adsid`, `adsname`, `zoneid`, `uploadfiles`, `url`, `width`, `height`, `orders`, `flag`, `content`, `timeline`) VALUES(1, '1', 1, 'data/attachment/201202/12/6239ff11ab3ecef5088061268aa41507.jpg', 'index.php', 0, 0, 1, 1, '', 1317031301);

INSERT INTO `ljcms_adsfigure` (`adsid`, `adsname`, `zoneid`, `uploadfiles`, `url`, `width`, `height`, `orders`, `flag`, `content`, `timeline`) VALUES(5, 'tttt', 1, 'data/attachment/201205/23/a86e853928689f1d00ad341a3775091d.jpg', '#', 0, 0, 5, 1, '', 1337760294);

INSERT INTO `ljcms_adsfigure` (`adsid`, `adsname`, `zoneid`, `uploadfiles`, `url`, `width`, `height`, `orders`, `flag`, `content`, `timeline`) VALUES(6, '22', 1, 'data/attachment/201205/23/e2ac825779f96333c57fe620cf03d27d.jpg', '', 0, 0, 6, 1, '', 1337760311);

INSERT INTO `ljcms_adsfigure` (`adsid`, `adsname`, `zoneid`, `uploadfiles`, `url`, `width`, `height`, `orders`, `flag`, `content`, `timeline`) VALUES(7, 'q', 1, 'data/attachment/201205/23/4d5fcbfd77851485d0ed7dd672fb9765.jpg', 'q', 0, 0, 7, 1, 'q', 1337760330);

INSERT INTO `ljcms_adszone` (`zoneid`, `zonename`, `zonelabel`, `skinid`, `orders`, `flag`, `intro`, `width`, `height`, `slide`, `zonetype`, `timeline`) VALUES(1, '首页_通栏广告', '', 0, 1, 1, '', 990, 200, 1, 0, 1314244583);

INSERT INTO `ljcms_adszone` (`zoneid`, `zonename`, `zonelabel`, `skinid`, `orders`, `flag`, `intro`, `width`, `height`, `slide`, `zonetype`, `timeline`) VALUES(2, '首页_广告一', '', 0, 2, 1, '', 160, 120, 0, 0, 1314244778);

INSERT INTO `ljcms_adszone` (`zoneid`, `zonename`, `zonelabel`, `skinid`, `orders`, `flag`, `intro`, `width`, `height`, `slide`, `zonetype`, `timeline`) VALUES(3, '频道_广告图一', '', 0, 3, 1, '', 990, 200, 0, 0, 1314682240);

INSERT INTO `ljcms_applyjob` (`aid`, `username`, `jobid`, `userid`, `sex`, `brothday`, `chinatext`, `telno`, `email`, `degree`, `prosesion`, `school`, `address`, `awards`, `experience`, `hobby`, `flag`, `ip`, `addtime`, `RelyContent`) VALUES(1, 'sdfdsf1111111', 1, 1, 0, '2008-10-11', '中国', '010-66884112', 'sdfsdfs@126.com', '大专', '计算机', '北京大学', '北京', 'sdfsfsdfs', 'fsdfsdfsd', 'sdfsdfsdfsd', 1, '127.0.0.1', '1341295834', '');

INSERT INTO `ljcms_applyjob` (`aid`, `username`, `jobid`, `userid`, `sex`, `brothday`, `chinatext`, `telno`, `email`, `degree`, `prosesion`, `school`, `address`, `awards`, `experience`, `hobby`, `flag`, `ip`, `addtime`, `RelyContent`) VALUES(4, 'itf4', 1, 6, 0, '1980', '北京', '81991660', 'asp3721@hotmail.com', '', '', '', '', '', '', '', 1, '192.168.1.104', '1343297294', '');

INSERT INTO `ljcms_applyjob` (`aid`, `username`, `jobid`, `userid`, `sex`, `brothday`, `chinatext`, `telno`, `email`, `degree`, `prosesion`, `school`, `address`, `awards`, `experience`, `hobby`, `flag`, `ip`, `addtime`, `RelyContent`) VALUES(3, 'adminsa', 1, 1, 0, '2008-10-11', '中国', '010-66884112', 'sdfsdfs@126.com', '大专', '计算机', '北京大学', '北京', '停停停停停停停停停停停停', '停停停停停停停停停停停停停', '钱钱钱钱钱钱钱钱钱钱钱钱钱钱钱钱钱钱', 1, '127.0.0.1', '1341364191', '');

INSERT INTO `ljcms_authgroup` (`groupid`, `groupname`, `auths`, `flag`, `timeline`, `orders`, `intro`) VALUES(1, '信息录入', '', 1, 1313898288, 1, '主要给信息录入员录入数据');

INSERT INTO `ljcms_case` (`caseid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `intro`, `content`, `cateid`, `hits`, `elite`, `isnew`, `hots`, `flag`, `ugroupid`, `exclusive`, `timeline`, `deleted`, `tag`) VALUES(7, '客户成功案例07', '', '', '', '', 'data/attachment/201202/12/ef811330877649b5906eaa310e808589.jpg.thumb.jpg', 'data/attachment/201202/12/ef811330877649b5906eaa310e808589.jpg', '', '<p>客户成功案例07</p>\r\n<p>客户成功案例07</p>\r\n<p>客户成功案例07</p>\r\n<p>客户成功案例07</p>\r\n<p>客户成功案例07</p>\r\n<p>客户成功案例07</p>\r\n<p>客户成功案例07</p>\r\n<p>客户成功案例07</p>', 1, 1, 0, 0, 0, 1, '6868668868', '>=', 1329042914, 0, '');

INSERT INTO `ljcms_case` (`caseid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `intro`, `content`, `cateid`, `hits`, `elite`, `isnew`, `hots`, `flag`, `ugroupid`, `exclusive`, `timeline`, `deleted`, `tag`) VALUES(8, '客户成功案例08', '', '', '', '', 'data/attachment/201202/12/9cf6761f61b23181dea0ef91a9b6c361.jpg.thumb.jpg', 'data/attachment/201202/12/9cf6761f61b23181dea0ef91a9b6c361.jpg', '', '<p>客户成功案例08</p>\r\n<p>客户成功案例08</p>\r\n<p>客户成功案例08</p>\r\n<p>客户成功案例08</p>\r\n<p>客户成功案例08</p>\r\n<p>客户成功案例08</p>\r\n<p>客户成功案例08</p>\r\n<p>客户成功案例08</p>', 1, 9, 0, 0, 0, 1, '6868668868', '>=', 1329042955, 0, '');

INSERT INTO `ljcms_case` (`caseid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `intro`, `content`, `cateid`, `hits`, `elite`, `isnew`, `hots`, `flag`, `ugroupid`, `exclusive`, `timeline`, `deleted`, `tag`) VALUES(9, '客户成功案例09', '', '', '', '', 'data/attachment/201202/12/a47e58f18b226191994cf816de4a7e57.jpg.thumb.jpg', 'data/attachment/201202/12/a47e58f18b226191994cf816de4a7e57.jpg', '', '<p>客户成功案例09</p>\r\n<p>客户成功案例09</p>\r\n<p>客户成功案例09</p>\r\n<p>客户成功案例09</p>\r\n<p>客户成功案例09</p>\r\n<p>客户成功案例09</p>\r\n<p>客户成功案例09</p>\r\n<p>客户成功案例09</p>', 1, 32, 0, 0, 0, 1, '6868668868', '>=', 1329042988, 0, '');

INSERT INTO `ljcms_case` (`caseid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `intro`, `content`, `cateid`, `hits`, `elite`, `isnew`, `hots`, `flag`, `ugroupid`, `exclusive`, `timeline`, `deleted`, `tag`) VALUES(10, '客户成功案例10', '', '', '', '', 'data/attachment/201202/12/0d9da185208b6dd83706599a61c34b62.jpg.thumb.jpg', 'data/attachment/201202/12/0d9da185208b6dd83706599a61c34b62.jpg', '', '<p>客户成功案例10</p>\r\n<p>客户成功案例10</p>\r\n<p>客户成功案例10</p>\r\n<p>客户成功案例10</p>\r\n<p>客户成功案例10</p>\r\n<p>客户成功案例10</p>\r\n<p>客户成功案例10</p>\r\n<p>客户成功案例10</p>', 1, 23, 0, 0, 0, 1, '6868668868', '>=', 1329043019, 0, '');

INSERT INTO `ljcms_casecate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(2, '商城网店类型', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 2, 1, '', 1329038411, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_casecate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(3, '政府医院类型', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 3, 1, '', 1329038448, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_casecate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(1, '企业公司类型', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 1, 1, '', 1329038396, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_casecate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(4, '团购建站类型', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 4, 1, '', 1329038462, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_casecate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(5, '行业教育类型', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 5, 1, '', 1329038508, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_config` (`sitename`, `sitetitle`, `siteurl`, `metadescription`, `metakeyword`, `sitecopyright`, `icpcode`, `tjcode`, `about`, `contact`, `logoimg`, `logowidth`, `logoheight`, `bannerimg`, `bannerwidth`, `bannerheight`, `licestatus`, `softkey`, `htmltype`, `routeurltype`, `maxthumbwidth`, `maxthumbheight`, `thumbwidth`, `thumbheight`, `productthumbwidth`, `productthumbheight`, `casethumbwidth`, `casethumbheight`, `solutionthumbwidth`, `solutionthumbheight`, `watermarkflag`, `watermarkfile`, `watermarkpos`, `newspagesize`, `newsnum`, `newslen`, `articlepagesize`, `articlenum`, `articlelen`, `productpagesize`, `productnum`, `productlen`, `casepagesize`, `casenum`, `caselen`, `jobpagesize`, `jobnum`, `joblen`, `downpagesize`, `downnum`, `downlen`, `solutionpagesize`, `solutionnum`, `solutionlen`, `eliteproductnum`, `eliteproductlen`, `qqstatus`, `cachstatus`, `cachtime`, `tagrange`, `tagurlnum`) VALUES('良精企业网站系统', '站点SEO标题-良精PHP企业网站管理系统', 'http://www.liangjing.org/', 'meta描述,meta描述', 'meta关键meta关键', 'CopyRight 2006-2011&nbsp;&nbsp; 良精企业建站系统&nbsp;', '京ICP备08002262号', '<script src="http://tongji.liangjing.org/cf.asp?username=lj"></script>', '北京良精志诚科技有限责任公司 成立于1998年2月9日，专门从事于简单实用企业网站建设、企业应用软件开发、网页设计、网站托管(什么是网站托管见<a href="http://www.liangjing.org/zh/HTML/News_237.html),UI">http://www.liangjing.org/</a>设计等服务项目。北京良精志诚科技有限责任公司 拥有多名专业设计人员，均从事网页、软件、广告设计、平面设计工作多年，具有独到的设计意识和丰富的工作经验，能为您提供完善的服务、一流的设计和全面的解决方案。<br />\r\n&nbsp;<br />\r\n　　 根据国家工商局数据调查，2006年全国中小型企业已经超过2300多万家，目前以平均每年超过10万的数量继续诞生。良精系列建站程序，以特有的安全、稳定、高效、易用而快捷的优势，受到广大建站用户的青睐，已成为广大建站用户的最为欢迎的程序。<br />\r\n&nbsp;<br />\r\n　　 在我们的服务领域，我们的专业化程度、技术服务水平、工程质量以及先进的服务理念得到了客户的充分认可，这也使得我们能与客户保持长期友好的合作关系。同时，我们还与多家IT企业有着良好的伙伴关系，使我们在各方面得到更加完善的支持，从而更好地为客户提供服务。', '<p>业务邮箱:<a href="mailto:asp3721@hotmail.com">asp3721@hotmail.com</a></p>\r\n<p>业务 QQ：82993936</p>\r\n<p>Email:<a href="mailto:asp3721@hotmail.com">asp3721@hotmail.com</a></p>\r\n<p>服务热线: +86 010-81991660</p>', 'data/attachment/201205/23/2303ce640f6a1fd00e9626b4450214a1.jpg', 290, 84, '', 0, 0, 0, '', 'php', 1, 580, 650, 145, 120, 145, 125, 145, 125, 145, 125, 1, '', 4, 15, 10, 16, 15, 10, 10, 12, 6, 12, 12, 10, 10, 12, 10, 10, 15, 10, 10, 10, 10, 10, 15, 10, 1, 0, 60, 0, 0);

INSERT INTO `ljcms_delimitlabel` (`labelid`, `skinid`, `labeltitle`, `labelname`, `labelcontent`, `flag`, `timeline`, `intro`) VALUES(3, 1, '底部链接导航', 'footerlink', '<a href="{$url_link}">{$lang_link}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$url_guestbook}">{$lang_guestbook}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$url_sitemap}">{$lang_sitemap}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$url_job}">{$lang_job}</a>', 1, 1314604050, '');

INSERT INTO `ljcms_delimitlabel` (`labelid`, `skinid`, `labeltitle`, `labelname`, `labelcontent`, `flag`, `timeline`, `intro`) VALUES(2, 1, '头部收藏', 'tiplink', '良精开源、免费企业网站系统，欢迎下载使用', 1, 1313935721, '');

INSERT INTO `ljcms_delimitlabel` (`labelid`, `skinid`, `labeltitle`, `labelname`, `labelcontent`, `flag`, `timeline`, `intro`) VALUES(4, 1, '联系方式', 'tel', '<p style="padding-left:1em;color:#7a7a7a;"><strong>客服QQ</strong></p>\r\n<p style="padding-left:1em;">81993936</p>\r\n<p style="padding-left:1em;color:#7a7a7a;"><strong>手机</strong></p>\r\n<p style="padding-left:1em;">+86-010-81991660</p>', 1, 1314699408, '');

INSERT INTO `ljcms_delimitlabel` (`labelid`, `skinid`, `labeltitle`, `labelname`, `labelcontent`, `flag`, `timeline`, `intro`) VALUES(5, 1, '联系我们标签', 'contact', '<p><strong>良精免费php企业网站系统</strong><br />\r\n<strong>地址</strong>：北京市海淀区中关村08号</p>\r\n<p>\r\n<strong>电话:&nbsp;&nbsp; </strong>010-81991660<br />\r\n<strong>Email</strong>：asp3721@hotmail.com<br />\r\n<strong>官方网站</strong>：<a href="http://www.liangjing.org" target="_blank">www.liangjing.org<br />\r\n</a></p>', 1, 1316770088, '');

INSERT INTO `ljcms_delimitlabel` (`labelid`, `skinid`, `labeltitle`, `labelname`, `labelcontent`, `flag`, `timeline`, `intro`) VALUES(6, 4, '公告', 'notice', '良精通用网站管理系统V3.9 新增功能 兼容Firefox、Maxthon、TT等常用浏览器 公告可以切换成视频播放', 1, 1332914542, '网站公告');

INSERT INTO `ljcms_delimitlabel` (`labelid`, `skinid`, `labeltitle`, `labelname`, `labelcontent`, `flag`, `timeline`, `intro`) VALUES(7, 4, '底部导航', 'footernvation', '<a href="{$url_link}">{$lang_link}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$url_guestbook}">{$lang_guestbook}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$url_member}">{$lang_menbercenter}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$url_sitemap}">{$lang_sitemap}</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{$url_job}">{$lang_job}</a>', 1, 1333957062, '良精v3.9底部导航');

INSERT INTO `ljcms_delimitlabel` (`labelid`, `skinid`, `labeltitle`, `labelname`, `labelcontent`, `flag`, `timeline`, `intro`) VALUES(8, 5, '底部导航', 'footerlink', '<a href="{$url_link}">{$lang_link}</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="{$url_guestbook}">{$lang_guestbook}</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="{$url_sitemap}">{$lang_sitemap}</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="{$url_member}">{$lang_menbercenter}</a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="{$url_job}">{$lang_job}</a>', 1, 1337911915, '底部导航');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(1, '小精灵Asp服务', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.liangjing.org/down/aspWebServer.rar', '', '', '<p><img border="0" src="http://liangjing.org/qiyejianzhan/uploadfile/20111222100228874.jpg" /></p>\r\n<p><br />\r\n1.将网站源码放置在www文件夹内</p>\r\n<p>2.是双击良精小精灵Asp服务器.exe)即可运行，绿色免安装</p>\r\n<p><br />\r\n测试和使用：</p>\r\n<p>www文件夹为网站主目录index.asp&nbsp; 为默认网站头文件 </p>\r\n<p>1.默认打开演示CMS系统<br />\r\n2.右击图标，则弹出系统菜单<br />\r\n3.选择系统菜单顶部的打开网站菜单进行测试</p>\r\n<p><br />\r\n官方网站 http://www.liangjing.org/<br />\r\n</p>', 2, 0, 0, 0, 0, 1, '', '', 1328976000, 1329042214, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(2, '良精微博 免费', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.liangjing.org/down/LJwb.rar', '', '', '<p><span style="font-family:Verdana;">良精微博网站管理系统</span></p>\r\n<p><span style="font-family:Verdana;">官方网址 <a href="http://www.liangjing.org/">http://www.liangjing.org/</a></span></p>\r\n<p><span style="font-family:Verdana;">演示地址 <a href="http://t.itf4.com/">http://t.itf4.com/</a></span></p>\r\n<p><span style="font-family:Verdana;">下载地址 <a href="http://www.liangjing.org/down/LJwb.rar">http://www.liangjing.org/down/LJwb.rar</a></span></p>\r\n<p><span style="font-family:Verdana;">分流下载 <br />\r\n&nbsp;站长站<a href="http://down.chinaz.com/soft/27336.htm">http://down.chinaz.com/soft/27336.htm</a></span><span style="font-family:Verdana;"><br />\r\n&nbsp;源码之家<a href="http://www.mycodes.net/18/1797.htm">http://www.mycodes.net/18/1797.htm</a><br />\r\n&nbsp;admin5&nbsp; <a href="http://down.admin5.com/code_asp/60728.html">http://down.admin5.com/code_asp/60728.html</a></span></p>\r\n<p><span style="font-family:Verdana;">良精微博asp源码描述<br />\r\n良精微博源码系统具有了微博系统中所具备的8%以上的功能适合于中型微博用户</span></p>\r\n<p><span style="font-family:Verdana;">特色功能<br />\r\n1.顶帖子；&nbsp; 2.发表评论；.微博公告<br />\r\n4.大图浏览&nbsp; 5.发布图片；.用户自定义标签；<br />\r\n7.站内留言&nbsp; 8.上传头像&nbsp; 9.发布链接 10.内容搜索</span></p>\r\n<span style="font-family:Verdana;"> <p><br />\r\n浏览微博方式多样化：1.最新顶贴2.最新发贴3.人气帖排行4.评论贴排行5.最新评论帖</p>\r\n<p>演示站点：http://t.itf4.com/<br />\r\n管理后台：admin/default.asp<br />\r\n账号：admin<br />\r\n密码：admin</p>\r\n<p>源码是良精科技开发成员开发而成 <br />\r\n使用本源码只需在贵站做好良精科技http://www.liangjing.org的链接即</p>\r\n<p>免费版用户请登陆<a href="http://server.liangjing.org/">http://server.liangjing.org/</a>&nbsp;以发帖的形式获得技术支持 </span></p>', 1, 0, 0, 0, 0, 1, '', '', 1328976000, 1329042241, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(3, '良精中英文博客网站管理系统免费', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.liangjing.org/down/LJblog.rar', '', '', '<p>演示地址 http://blog.liangjing.org/Ch/index.html</p>\r\n<p>下载地址 http://www.liangjing.org/down/LJblog.rar</p>\r\n<p>使用许可协议 http://blog.liangjing.org/Ch/New-51.html</p>\r\n<p>分流下载 http://down.admin5.com/code_asp/11726.html</p>\r\n<p>&nbsp;</p>\r\n<p>源码之家 http://www.mycodes.net/18/2307.htm<br />\r\n&nbsp;<br />\r\n一、在本地调试要注意几点：<br />\r\n1、程序必须在根目<br />\r\n2、必须开启父路径<br />\r\n3、硬盘为NTFS格式的时候，请设置硬盘属性&gt;安全属性标签，设置成evryone和user为完全控制<br />\r\n4，网站LOGO修改地址 Chimagelogo.jpg<br />\r\n二、后台管<br />\r\n管理演示登录/admin/admin_Login.asp<br />\r\n管理帐号：admin 密码：admin<br />\r\n&nbsp;<br />\r\n三、多级分类显示修<br />\r\nch tr en语言目录下有关文<br />\r\n*list.asp *代表不同文件<br />\r\n*view.asp *代表不同文件<br />\r\nSearch.asp<br />\r\n查找&nbsp;&nbsp; &lt;%=WebMenu(0,0,2)%&gt;<br />\r\n其中最后一个数字表示显示分类的级数,这里,表示显示二级分类，根据用户需要可以修改成1以上的数字，但为了网页美观，建议不要超过3<br />\r\n&nbsp;<br />\r\n使用此程序请保留低部信息,良精制作链接及版权信息谢谢!<br />\r\n（不保留低部信息,良精制作链接及版权信息按侵权处理）解释权良精保<br />\r\n&nbsp;<br />\r\n如果您在使用中遇到问题，请先查看压缩包中的程序说明和常见问题，可能问题可以马上解决。为了能给您提供更好的服务，请在提交问题时遵守下列规则<br />\r\n&nbsp;<br />\r\n准确：不要提“你的产品有问题”这样的问题，要尽量的表达准确，请写出发生错误的现象或者程序代码片段等与问题相关的信息<br />\r\n&nbsp;<br />\r\n简练：把您问题的特征描述尽量只要写成几个简单的句子，尽量限制附加很多的代码，如不要把一个完整程序每个页面的代码都附加进来<br />\r\n&nbsp;<br />\r\n耐心：因为我们要回答的问题可能较多，所以您的问题得到回复可能需要几分钟、几小时、甚至几天，请耐心等待<br />\r\n&nbsp;<br />\r\n技术支持：<br />\r\n您在使用我们的产品时(良精网站管理系统)，遇到问题寻求技术支持解决，或者您找到程序的bug要报告，发送到asp3721@hotmail.com<br />\r\n&nbsp;<br />\r\n帮助中心网址 http://help.liangjing.org/</p>', 1, 0, 0, 0, 0, 1, '', '', 1328976000, 1329042270, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(4, '良精地方分类信息网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.liangjing.org/down/itf4.rar', '', '', '<p>良精地方分类信息网站管理系统</p>\r\n<p>演示地址 http://www.itf4.cn/</p>\r\n<p>官方网址 http://www.liangjing.org/</p>\r\n<p>下载地址 http://www.liangjing.org/down/itf4.rar</p>\r\n<p>后台登陆地址 http://localhost/manage/login.asp</p>\r\n<p>开源源</p>\r\n<p>用户 admin 密码 admin</p>\r\n<p>采用asp+access开发 运行稳定，快速，安全性能优良,功能更枪法是一套通用的信息网站源码,分类网站源码,</p>\r\n<p>地区分类信息网源码分类信息网站,分类信息网站程序,北京分类信息网站.</p>\r\n<p>本分类信网程序基于ASP+Access技术开发的分类信息程序，是经过多年的经验积累，完善设计</p>\r\n<p>精心打造的适用于各种服务器环境的安全、稳定、快速、强大、高效、易用、优秀的网站建设解决方案</p>\r\n<p>采用人性化的Windows操作方式开发，运行速度快，服务器资源占用更少；</p>\r\n<p>无论在稳定性、负载能力、安全等方面都有可靠的保证并赢得了广大用户的良好称赞</p>', 1, 2, 0, 0, 0, 1, '', '', 1328976000, 1329042298, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(5, 'EditPlus V2.20 Build 303 简体中文版', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.myszw.com/EditPlus.rar', '', '', '一套状态相当强大，完全取代记事本的文词处理工具软件，它拥有完全无限制的Undo/Redo(还原)、英文拼写检查、自动换行、列数标记、查找取代、同时还可编辑多个文档、全屏浏览.等状态。而它还有一个很好用的状态，就是它有监视剪贴板的状态，能够同步于剪贴板而自动将文词贴进EditPlus的编辑窗口中，让你省去做贴上的步骤&nbsp;<br />\r\n<br />\r\n另外它也是一个好用的HTML网页编辑软件，除了可以颜色标记HTML&nbsp;Tag&nbsp;(同时支援&nbsp;C/C++、Perl、Java)&nbsp;外，还内置完整的HTML&nbsp;CSS1&nbsp;指令状态，支持&nbsp;HTML,&nbsp;CSS,&nbsp;PHP,&nbsp;ASP,&nbsp;Perl,&nbsp;C/C++,&nbsp;Java,Java<i>script</i>&nbsp;and&nbsp;VB<i>script</i>；对于习惯用记事本编辑网页的朋友，它可帮你节省一半以上的网页制作时间。倘若你有安装&nbsp;IE&nbsp;3.0以上版本，它还会结合&nbsp;IE&nbsp;浏览器于EditPlus的窗口中，让你可以直接预览编辑好的网页若没安装IE，也可指定浏览器路径)。是一个相当棒又多用途多状态的编辑软件<br />', 2, 3, 1, 0, 0, 1, '', '', 1328976000, 1329042322, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(6, 'iis 备份软件', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.liangjing.org/down/IISBackUp.rar', '', '', '本软件用于备份移植 IIS 的站点配置信息，可以导出或导入IIS 服务器的所有站点（Web MS Ftp）的配置信息<br />\r\n&nbsp; 当您需要重启IIS 服务器时，或者需要将一个IIS 服务器的站点配置移至另外一个IIS 服务器时，使用IIS 本身的“备份还原配置”功能是无法实现的，一般情况下只能通过手工的方法重新逐个地创建站点，而使用本软件则可以简单地自动完成任务<br />\r\n&nbsp; v0.2版本在程序上做了优化，比之前的v0.1版本更兼容于WINXP/WIN2003操作系统', 2, 0, 0, 0, 0, 1, '', '', 1328976000, 1329042349, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(7, 'WinRAR 简体美化版', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.asp99.cn/WRAR351.EXE', '', '', '<span style="font-family:Verdana;">WinRAR 是强大的压缩文件管理器。它提供RAR ZIP 文件的完整支持，能解 ARJ、CAB、LZH、ACE、TAR、GZ、UUE、BZ2、JAR、ISO 格式文件。WinRAR 的功能包括强力压缩、分卷、加密、自解压模块、备份简易</span>', 2, 0, 0, 0, 0, 1, '', '', 1328976000, 1329042379, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(8, '建站留言本程', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://down.asp99.cn/book.rar', '', '', '<p><span style="font-family:Verdana;">安装方法<br />\r\n只需将此目录下的全部文件上传到网站的任一目录即可<br />\r\n例如上传到您的网站的book目录，则以http://域名/book/index.asp 的方式打开留言本</span></p>\r\n<p><span style="font-family:Verdana;"><br />\r\n管理方法<br />\r\n点击留言本右下角的小书本图标即可进入管理页<br />\r\n默认的管理员名称和密码均为：admin（小写，前后无空格）</span></p>', 1, 4, 0, 0, 0, 1, '', '', 1328976000, 1329042407, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(9, '解析Flash动画.swf文件.exe文件）的工具', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.asp99.cn/swf.rar', '', '', '硕思闪客精灵是一款用于浏览和解析Flash动画.swf文件.exe文件）的工具。最新版本有着强大的功能，可以将swf文件导出成FLA文件。它还能够将flash动画中的图片、矢量图、声音、视频（*.flv）、文字、按钮、影片片段、帧等基本元素完全分解，最重要的是可以对动作的脚本(Action&nbsp;<i>script</i>)进行解析，清楚的显示其动作的代码，让对Flash动画的构造一目了然。最新版本能更好的支持Flash&nbsp;MX和动作脚本2.0.&nbsp;她不仅能够从IE浏览器中或临时文件缓存中直接采集flash动画，还能够通过分析和反编译将flash动画中的声音，图像，动画短片等元素提取出来，甚至能分析出该动画中包含的动作，并转化为清晰可读的代码&nbsp;<br />', 2, 5, 0, 0, 0, 1, '', '', 1328976000, 1329042430, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(10, '在线客服 插件 下载', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://down.asp99.cn/left-kf.rar', '', '', '<p><img border="0" src="http://liangjing.org/qiyejianzhan/uploadfile/20100826105522154.jpg" /></p>\r\n<p><img border="0" src="http://liangjing.org/qiyejianzhan/uploadfile/20100826105548816.jpg" /></p>\r\n<p>使用此客服功能，把下面一段代码加入到默认首页文件(例如index.asp)最底部保存即可<br />\r\n修改客服号码等内容，打开kefu.htm文件修改<br />\r\n------------------------------------------------------------<br />\r\n欢迎经常登录我们的网站，获取最新最全的程序代码<br />\r\n演示地址&nbsp;<a href="http://admin.asp99.cn/web26/Index.Asp" target="_blank">http://admin.asp99.cn/web26/Index.Asp</a><br />\r\n</p>', 1, 4, 0, 0, 0, 1, '', '', 1328976000, 1329042453, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(11, 'FTP软件', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.myszw.com/ftp.rar', '', '', '<span style="font-family:Verdana;">使用容易且很受欢迎的FTP软件，下载文件支持续传、可下载或上传整个目录、具有不会因闲置过久而被站台踢出站台。可以上载下载队列，上载断点续传，整个目录覆盖和删除等</span>', 2, 5, 0, 0, 0, 1, '', '', 1328976000, 1329042483, 0, '');

INSERT INTO `ljcms_download` (`downid`, `title`, `metatitle`, `metakeyword`, `metadescription`, `uploadfiles`, `filesize`, `intro`, `content`, `cateid`, `hits`, `downs`, `elite`, `hots`, `flag`, `ugroupid`, `exclusive`, `dateline`, `timeline`, `deleted`, `tag`) VALUES(12, '良精net企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', 'http://www.liangjing.org/down/LJnetCMS.rar', '', '', '<p>分流下载</p>\r\n<p>源码之家&nbsp;&nbsp; <a href="http://www.mycodes.net/101/4637.htm">http://www.mycodes.net/101/4637.htm</a></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;&nbsp; <a href="http://down.chinaz.com/soft/30358.htm">http://down.chinaz.com/soft/30358.htm</a></p>\r\n<p>&nbsp;</p>\r\n<p>admin5&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://down.admin5.com/net/4009.html">http://down.admin5.com/net/4009.html</a></p>\r\n<p>&nbsp;</p>\r\n<p>2011年7月1日更新如下...</p>\r\n<p>新增 后台上传视频功能</p>\r\n<p>更新 兼火狐浏览器 用户注册时间</p>\r\n<p>更新 后台上传图片管理</p>\r\n<p>新增 产品排序</p>\r\n<p>(新增了skin22风格)共两个风格可用</p>\r\n<p>新增功能 静态生生 风格切换 模版管理</p>\r\n<p>中英文加繁体三语版本</p>\r\n<p>常见错误请见 http://help.liangjing.org/HTML/200812111337159375.html</p>\r\n<p>使用说明书请见帮助中&nbsp; http://help.liangjing.org/index.html<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />\r\n前台访问地址：http://网址/Default.aspx</p>\r\n<p>打开首页后会看到下面有后台访问地址</p>\r\n<p>编码UTF-8 用户名admin密码admin</p>\r\n<p>后台主要功能如下</p>\r\n<p>1、系统管理：管理员管理，网站配置，上传文件管理,QQ-MSN 在线客服设置，文件浏览，模版的编辑，样式表的编辑</p>\r\n<p>2、企业信息：后台自由添加修改企业的各类信息及介绍</p>\r\n<p>3、产品管理：产品类别新增修改管理，产品添加修改以及产品的审核</p>\r\n<p>4、订单管理：查看订单的详细信息及订单处理</p>\r\n<p>5、会员管理：查看修改删除会员资料，及锁定解锁功能。可在线给会员发信！</p>\r\n<p>6、新闻管理：能分大类和小类新闻，不再受新闻栏目的限制<br />\r\n</p>', 1, 48, 6, 0, 0, 1, '6868668868', '>=', 1328976000, 1329042510, 0, '');

INSERT INTO `ljcms_downloadcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(2, '常用软件', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 2, 1, '', 1329042177, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_downloadcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(1, '网站源码', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 1, 1, '', 1329042168, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_guestbook` (`bookid`, `title`, `bookuser`, `gender`, `jobs`, `telephone`, `fax`, `mobile`, `email`, `qqmsn`, `companyname`, `address`, `trade`, `homepage`, `content`, `booktimeline`, `ip`, `userid`, `flag`, `replyuser`, `replytimeline`, `replycontent`) VALUES(1, '', '张三', 1, '普通职', '020-12345678', '020-87654321', '13812345678', 'admin@qq.com', '123456', '北京良精科技有限公司', '北京市海淀区中关村08', 'IT互联', '', '苏丹解放了接待来访\r\n第三方加了斯蒂芬\r\n是否是否', 1314271072, '127.0.0.1', 0, 1, '管理', 1314271315, '谢谢您的支持');

INSERT INTO `ljcms_guestbook` (`bookid`, `title`, `bookuser`, `gender`, `jobs`, `telephone`, `fax`, `mobile`, `email`, `qqmsn`, `companyname`, `address`, `trade`, `homepage`, `content`, `booktimeline`, `ip`, `userid`, `flag`, `replyuser`, `replytimeline`, `replycontent`) VALUES(2, '', '张山', 1, '普通职', '020-12345678', '020-87654321', '13812345678', 'asp3721@hotmail.com', '', '北京市某某科技公司', '北京市海淀区中关村08', 'IT互联', '', '这是测试留言！！', 1314615718, '127.0.0.1', 0, 1, 'admin', 1341307118, 'testestset');

INSERT INTO `ljcms_guestbook` (`bookid`, `title`, `bookuser`, `gender`, `jobs`, `telephone`, `fax`, `mobile`, `email`, `qqmsn`, `companyname`, `address`, `trade`, `homepage`, `content`, `booktimeline`, `ip`, `userid`, `flag`, `replyuser`, `replytimeline`, `replycontent`) VALUES(3, '', '张三', 1, '普通职', '020-12345678', '020-87654321', '13812345678', 'asp3721@hotmail.com', '', '广州市某某科技公司', '北京市海淀区中关村08', 'IT互联', '', '斯蒂芬斯蒂芬地方师傅', 1314615990, '127.0.0.1', 0, 1, '', 0, '');

INSERT INTO `ljcms_guestbook` (`bookid`, `title`, `bookuser`, `gender`, `jobs`, `telephone`, `fax`, `mobile`, `email`, `qqmsn`, `companyname`, `address`, `trade`, `homepage`, `content`, `booktimeline`, `ip`, `userid`, `flag`, `replyuser`, `replytimeline`, `replycontent`) VALUES(4, '', 'adminsa', 1, '软件工程师', '010-35143213', '010-6868222', '13223423423', 'sdfsdfs@126.com', '', '良精科技', '北京', 'IT', '', '良精科技企业网站正式发布了', 1341280983, '127.0.0.1', 1, 1, NULL, 0, NULL);

INSERT INTO `ljcms_info` (`infoid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `elite`, `flag`, `ugroupid`, `exclusive`, `hits`, `orders`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `tag`) VALUES(1, 1, '发布公司新闻-标题-01', '', '', '该新闻资讯的简单文字介', '详细的文字内', 1329038798, 0, 1, '6868668868', '>=', 115, 0, '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', '');

INSERT INTO `ljcms_info` (`infoid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `elite`, `flag`, `ugroupid`, `exclusive`, `hits`, `orders`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `tag`) VALUES(7, 1, '中国中东部将出现大风降温天气', '', '', '核心提示：据中央气象台预报，12 5日，中国黄淮以南大部地区将出现一次大范围雨雪天气过程。昨日，全国大部地区气温有所回升，但从今天开始，中东部降水将逐渐增多，并自北向南出现大风降温天气', '<div style="text-align:center;"><img alt="中国中东部将出现大风降温天气 苏皖鲁豫有雨雪" src="http://img1.cache.netease.com/catchpic/5/53/537DE2D6394042B081B8E90E362E8166.jpg" /></div>\r\n<div style="text-align:left;text-indent:2em;margin:5px 0px;"></div>\r\n<p>中新&nbsp;&nbsp;2日电 据中央气象台预报&nbsp;2&nbsp;5日，中国黄淮以南大部地区将出现一次大范围雨雪天气过程，长江以南地区以降雨为主，西北地区东南部、黄淮、江淮北部等地的部分地区有小到中雪或雨夹雪</p>\r\n<p>昨日，中国雨雪天气较弱，南方大部地区降雨量不&nbsp;毫米，全国大部地区气温有所回升。但从今天开始，中国中东部的降水将逐渐增多，预计未&nbsp;4小时，雨雪主要出现在黄淮、江淮等地，明日，雨雪范围将继续扩大；与此同时，中东部地区将自北向南先后出现大风降温天气，周末好不容易爬升了几度的气温又将继续被打压</p>\r\n<p>今天白天到夜间，黄淮大部、陕西东南部以及新疆北部、西藏西部和东部、青海南部、川西高原西部等地有小到中雪或雨夹雪；江淮、江汉、江南大部、华南西部以及西南地区东部等地有小到中雨或阵&nbsp;附图)。预计周一(13&nbsp;，雨雪范围会进一步扩大，江淮大部、江南北部将有中雨</p>\r\n<p>除雨雪天气的影响外，13&nbsp;6日，受冷空气影响，中东部大部地区将自北向南出&nbsp;&nbsp;℃降温，局&nbsp;0℃；内蒙古中东部、华北大部、东北地区、黄淮有4&nbsp;级偏北风，东部海域先后有6&nbsp;级大风</p>\r\n<p>气象专家提醒，目前正值春运后期，大范围雨雪天气将对交通出行产生一定影响，请上述地区的居民注意天气变化，合理安排行程。同时，近期气温多波动，起伏较大，大家要注意做好防寒保暖工作，以免生病感冒</p>', 1329039653, 1, 1, '6868668868', '>=', 21, 0, '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '', '');

INSERT INTO `ljcms_info` (`infoid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `elite`, `flag`, `ugroupid`, `exclusive`, `hits`, `orders`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `tag`) VALUES(10, 7, '罗姆尼赢得缅因州共和党总统初', '', '', '核心提示：美国缅因州共和党党部负责人称，罗姆尼赢得了该州11日举行的总统初选，得票率为39%。此前，罗姆尼连续在佛罗里达与内华达州获胜，而桑托勒姆则取得了密苏里、明尼苏达与科罗拉多等三州的胜利', '<p>中新&nbsp;&nbsp;2日电 据外电报道，美国缅因州共和党党部负责人称，共和党总统候选人罗姆尼赢得了该州11日举行的总统初选，其得票率&nbsp;9%</p>\r\n<p>得克萨斯州众议员保罗得票&nbsp;6%，位居第二</p>\r\n<p>前参议员桑托勒姆获得18%选票的支持，前众议院议长金里&nbsp;%</p>\r\n<p>当地时间7日，密苏里、明尼苏达与科罗拉多等三州同时举行总统初选，桑托勒姆夺得这三州的胜利</p>\r\n<p>此前，罗姆尼连续在佛罗里达与内华达州获胜</p>\r\n<p></p>', 1329039751, 1, 1, '2147483647', '>=', 22, 0, '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '', '');

INSERT INTO `ljcms_info` (`infoid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `elite`, `flag`, `ugroupid`, `exclusive`, `hits`, `orders`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `tag`) VALUES(11, 7, '欧洲严寒致&nbsp50人死 数十万人交通受', '', '', '核心提示：据“中央社  2日报道，欧洲超强寒流已夺走 50条生命，部分地区积雪深及民宅屋顶，数十万偏远地区的民众受困屋内。多瑙河已因结冰而关闭数百公里的航运。意大利多地航班受到影响，而塞尔维亚电力吃紧，政府已采取限电措施。气象预报预测寒流将持续 月中旬', '<p>中新&nbsp;&nbsp;2日电 据“中央社&nbsp;2日报道，欧洲部分地区积雪已深及民宅屋顶，导致数十万偏远地区民众受困屋内，欧洲超强寒流已夺走&nbsp;50条生命</p>\r\n<p>欧洲巴尔干半岛地区和意大利迎接更大降雪。多瑙河已因结了厚厚的冰而关闭数百公里的航运，其保加利亚河段也结冻，&nbsp;7年首次</p>\r\n<p>意大利各地持续降下大雪，首都罗马成白茫茫的大地，山区村落对外交通断绝，各地公路、铁路大乱，航班也受到影响</p>\r\n<p>这是罗马&nbsp;0世纪80年代以来最大的一场雪，迫使罗马竞技场冰封关闭，但也让观光客和居民有机会一睹圣伯多禄广&nbsp;Saint Peter''s Square)和特莱维喷泉(Trevi fountain)白雪皑皑美景</p>\r\n<p>意大利民航局声明，罗马费乌米奇诺机场(Fiumicino airport)格林尼治时间11日下&nbsp;点起取消一半航班。境内其它机场也将关闭或减少航班</p>\r\n<p>在黑山，首都波德戈里察积雪创&nbsp;0年新高的50厘米，迫机场关闭，并因雪崩意外暂停通往塞尔维亚的铁路运输，城市几乎陷入瘫痪</p>\r\n<p>罗马尼亚接获的通报丧生人数目前&nbsp;5人，塞尔维亚3人，捷克和奥地利各有1人罹难</p>\r\n<p>罗马尼亚一&nbsp;8岁老妇告诉摄影师：“我这辈子没看过那么多雪。</p>\r\n<p>各国有关单位表示，估计罗马尼亚目前仍&nbsp;万人受困，巴尔干地区各国有&nbsp;1万人受困，其中黑山就&nbsp;万人动弹不得，占该国人口的近10%</p>\r\n<p>在塞尔维亚，当地电力吃紧，政府因此采取限电措施，并呼吁企业将用电量降至最低</p>\r\n<p>15日&nbsp;6日为塞尔维亚国庆，政府已宣布17日连续放假，将假期延伸至下一周</p>\r\n<p><br />\r\n在科索沃，当局表示南部瑞斯特里（Restelica)小村庄发生雪崩，造成至少7人丧生，另外3人失踪</p>\r\n<p>警方表示，雪崩吞噬至&nbsp;5间民房，但当时仅有两间民宅内有人</p>\r\n<p>居民和紧急救难人员协助清除民宅时，发&nbsp;名年纪约&nbsp;&nbsp;岁的女孩生还，她目前已被送往医院</p>\r\n<p>在波兰，消防大队发言人佛拉卡（Pawel Fratcak)表示，暖气设备故障引发多处民宅和公寓爆发致命大火，过去两夜酿11死</p>\r\n<p>气象预报预测这波两周前袭欧的寒流将持续至2月中旬。比利时气象学家表示，比利时遭遇70年来历时最长的寒流，布鲁塞尔市郊气温连&nbsp;3天下将到摄氏0度以下</p>\r\n<p>&nbsp;</p>', 1329041347, 1, 1, '2147483647', '>=', 41, 0, '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '', '');

INSERT INTO `ljcms_info` (`infoid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `elite`, `flag`, `ugroupid`, `exclusive`, `hits`, `orders`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `tag`) VALUES(12, 7, '卡扎菲第三子称利比亚即将爆发起义', '', '', '核心提示：卡扎菲第三子萨阿迪日前称，利比亚即将爆发针对执政当局的“起义”，起义将席卷全国。另外，他称希望“随时”回国，见证这场起义', '<p>首先，这将不会是一场仅限于部分地区的起义。起义将席卷全国，我将跟随并见证这场确实存在的起义，它将逐日壮大</p>\r\n<p>——卡扎菲三子萨阿</p>\r\n<p>据新华社&nbsp;利比亚过渡政&nbsp;1日敦促邻国尼日尔引渡利前领导人穆阿迈尔·卡扎菲的第三子萨阿迪·卡扎菲，指认萨阿迪部分言论“威胁两国关系”</p>\r\n<p>萨阿迪前一天经阿拉伯卫星电视台发声，希望“随时”回国，称利比亚即将爆发针对执政当局的“起义”</p>\r\n<p><br />\r\n利比亚通讯&nbsp;1日援引过渡政府外交部长阿舒尔·本·哈伊勒和尼日尔外长巴祖姆·穆罕默德当天通话内容报道，利方对萨阿迪“攻击性言论”表达“强烈不满”。哈伊勒向尼方重申，萨阿迪言论威胁两国双边关系，尼政府应当对他采取严厉措施，包括引渡回利比亚接受调查</p>\r\n<p>萨阿迪和部分家人去年8月在反卡扎菲武装控制首都的黎波里后逃往尼首都尼亚美，受到居住监视。尼方先前表态，萨阿迪将留在这一西非国家，直至联合国取消他的旅行禁令</p>\r\n<p>按照利比亚通讯社的说法，尼外长巴祖姆当天向利政府和民众致歉，承诺将与总统穆罕默杜·优素福会商。“他（巴祖姆）希望向利方确认，（引渡）要求将依照法律和惯例得到回应。</p>\r\n<p>&nbsp;</p>', 1329041379, 1, 1, '2147483647', '>=', 114, 0, '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '', '');

INSERT INTO `ljcms_infocate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(1, '国内新闻', 'meta动', 'meta动态关键字', 'meta动态描', '', 0, 0, 1, 1, '', 1314323798, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_infocate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(7, '国外新闻', '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '企业网站开发，OA办公系统、政府网站、旅游网站', '', 0, 0, 7, 1, '良精新闻发布系统', 1333956364, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_infocate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(3, '军事新闻', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 3, 1, '', 1332724078, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_infocate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(4, '体育新闻', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 4, 1, '', 1332724102, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_infocate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(5, '财经新闻', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 5, 1, '', 1332724123, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_infocate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(6, '科技新闻', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 6, 1, '', 1332724132, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_job` (`jobid`, `cateid`, `title`, `workarea`, `number`, `jobdescription`, `jobrequest`, `jobotherrequest`, `jobcontact`, `timeline`, `flag`, `hits`) VALUES(1, 2, '技术支持', '北京', 0, '<p>1、编写开发计划</p>\r\n<p>负责公司旗下网站功能改进计划和网络安全计划的编写。 </p>\r\n<p>2、网站功能修改和升级</p>\r\n<p>按照计划的时间和质量要求，对网站前后台功能进行修改和升级；负责网站代码的优化和维护，保证网站的运行效率。</p>\r\n<p>3、日常业务开发</p>\r\n<p>每天程序员根据公司网站业务需要开发，制作和程序修改要求，必须按时按质按量地完成日常公司网站业务的编程开发技术工作。 </p>\r\n<p>4、网站测试</p>\r\n<p>网站开发前期必需先测试，测试成功后方可上传。如因违规操作造成的公司损失由个人全部负责。 </p>\r\n<p>5、软硬件维护</p>\r\n<p>负责每半个月必须对公司旗下网站软硬设施进行安全和稳定性巡检；并负责统计和监视系统日志。同时，也要做好内部局域网和网站机房的系统和网络故障的检修排除工作。</p>\r\n<p>6、防毒防黑</p>\r\n<p>负责即时监控互联网上发现的最新病毒和黑客程序及查杀方法，并及时为每台工作机和服务器查堵系统安全漏洞。每半月定期杀毒和升级防黑策略，排除因此出现的网络故障。 </p>\r\n<p>7、数据管理</p>\r\n<p>每三天必须对网站的重要数据（包括网站程序、网站数据库和网站运行日志等）做增量备份，并半个月对程序和数据库做完全备份。日常负责管理网站的备份数据，一旦出现问题，及时安全恢复数据。 </p>\r\n<p>8、技术支持</p>\r\n<p>每日为客户提出的、客服人员无法解答的专业技术问题提供支持和回馈，保证客户的满意度。 </p>\r\n<p>9、软硬件采购</p>\r\n<p>负责公司旗下网站发展所需要的软硬件的采购和选型；同时对外包编程工作的质量和进度加以监督和管理 </p>\r\n<p><br />\r\n10、外包 (网站合作)</p>\r\n<p>项目技术控制对于外包的软件项目的技术方面进行设计、实施跟踪和交付成果的控制和验证。保证外包项目能完全按照我方技术要求和规划完成。 <br />\r\n</p>', '<p>1、 具备丰富Web开发经验，具备网站设计经验。熟悉PHP、ASP等网站程序开发语言，熟悉SqlServer、MySql等数据库的管理及开发。了解VSS或CVS等源代码管理工具的使用。 </p>\r\n<p>2、 具有良好的沟通能力，理解力强，有团队合作意识，具备敬业负责的精神。 </p>\r\n<p>3、 具备良好的程序设计功底，要求不低于一年行业工作经验. </p>\r\n<p>4、出易于维有良好的编码习惯，能够编写护的代码。有良好的程序设计功底。 </p>\r\n<p>5、 精通 JAVA, C++, FLASH,DIV</p>\r\n<p>6、 能吃苦耐劳，有工作热情，能够按时完成公司交给的设计及编程任务。<br />\r\n</p>', '', '82993936@qq.com', 1329270968, 1, 0);

INSERT INTO `ljcms_jobcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(1, '产品交互', '', '', '', '', 0, 0, 1, 1, '', 1314257257, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_jobcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(2, '技术研发类', '', '', '', '', 0, 0, 2, 1, '', 1314257314, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_jobcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(3, '数据平台', '', '', '', '', 0, 0, 3, 1, '', 1314257321, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_jobcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(4, '测试及支持类', '', '', '', '', 0, 0, 4, 1, '', 1314257326, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_jobcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(5, '产品运营', '', '', '', '', 0, 0, 5, 1, '', 1314257332, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_jobcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(6, '市场商务', '', '', '', '', 0, 0, 6, 1, '', 1314257336, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_link` (`linkid`, `linktitle`, `fontcolor`, `linkurl`, `linktype`, `logoimg`, `timeline`, `flag`, `intro`, `orders`) VALUES(6, '婚纱摄影工作室', '', 'http://www.itf4.net', 1, '', 1315218371, 1, '', 5);

INSERT INTO `ljcms_link` (`linkid`, `linktitle`, `fontcolor`, `linkurl`, `linktype`, `logoimg`, `timeline`, `flag`, `intro`, `orders`) VALUES(3, '官方网站', '', 'http://www.liangjing.org/', 1, '', 1314254196, 1, '', 1);

INSERT INTO `ljcms_link` (`linkid`, `linktitle`, `fontcolor`, `linkurl`, `linktype`, `logoimg`, `timeline`, `flag`, `intro`, `orders`) VALUES(4, '企业黄页', '', 'http://yp.liangjing.org/', 1, '', 1314254219, 1, '企业黄页', 4);

INSERT INTO `ljcms_link` (`linkid`, `linktitle`, `fontcolor`, `linkurl`, `linktype`, `logoimg`, `timeline`, `flag`, `intro`, `orders`) VALUES(5, '文章阅卖网', '', 'http://www.itf4.com', 1, '', 1315218352, 1, '', 3);

INSERT INTO `ljcms_link` (`linkid`, `linktitle`, `fontcolor`, `linkurl`, `linktype`, `logoimg`, `timeline`, `flag`, `intro`, `orders`) VALUES(7, '网址导航', '', 'http://url.itf4.com/', 1, '', 1332724366, 1, '网址导航', 6);

INSERT INTO `ljcms_link` (`linkid`, `linktitle`, `fontcolor`, `linkurl`, `linktype`, `logoimg`, `timeline`, `flag`, `intro`, `orders`) VALUES(8, '北京酒水批发', '', 'http://www.itf4.net/', 1, '', 1339409968, 1, '北京酒水批发', 7);

INSERT INTO `ljcms_log` (`logid`, `username`, `ip`, `content`, `logtype`, `timeline`) VALUES(1, 'admin', '127.0.0.1', '登录后台成功.', 1, 1340943494);

INSERT INTO `ljcms_log` (`logid`, `username`, `ip`, `content`, `logtype`, `timeline`) VALUES(2, 'admin', '127.0.0.1', '登录后台成功.', 1, 1340943495);

INSERT INTO `ljcms_log` (`logid`, `username`, `ip`, `content`, `logtype`, `timeline`) VALUES(3, 'admin', '127.0.0.1', '删除操作日志成功[id=Array]', 1, 1343264288);

INSERT INTO `ljcms_onlinechat` (`onid`, `ontype`, `title`, `number`, `sitetitle`, `orders`, `flag`, `timeline`) VALUES(1, 1, '业务咨询', '82993936', 'LJcms', 1, 1, 1314844796);

INSERT INTO `ljcms_onlinechat` (`onid`, `ontype`, `title`, `number`, `sitetitle`, `orders`, `flag`, `timeline`) VALUES(2, 1, '技术支', '65961930', 'LJcms', 2, 1, 1315218622);

INSERT INTO `ljcms_onlinechat` (`onid`, `ontype`, `title`, `number`, `sitetitle`, `orders`, `flag`, `timeline`) VALUES(4, 3, 'MSN咨询', 'asp3721@hotmail.com', '', 4, 1, 1317050957);

INSERT INTO `ljcms_order` (`id`, `ordername`, `remark`, `userid`, `username`, `sex`, `company`, `address`, `zipcode`, `telephone`, `fax`, `mobile`, `email`, `addtime`, `flag`, `ip`, `replyuser`, `replycontent`, `replytime`) VALUES(6, '订购产品如下：良精商城网店系统<br/>产品的编号为：1329042063', 'fsdffsdfsd', 0, 'sdsdf', '1', 'test', 'testest', '100031', '1321241341', '010-2313131', '1312415241', 'sdfsdfs@dsfsd.com', 1342591877, 1, '127.0.0.1', 'admin', '我们已经发货了', 1343187162);

INSERT INTO `ljcms_order` (`id`, `ordername`, `remark`, `userid`, `username`, `sex`, `company`, `address`, `zipcode`, `telephone`, `fax`, `mobile`, `email`, `addtime`, `flag`, `ip`, `replyuser`, `replycontent`, `replytime`) VALUES(4, '订购产品如下：良精商城网店系统产品的编号为：1329042063', 'sdfdsfsfsfsdfsdfsdf', 1, 'adminsa', '1', 'tsetse', 'testest', '100031', '1321241341', '010-2313131', '1312415241', 'sdfsdfs@dsfsd.com', 1342581749, 1, '127.0.0.1', 'admin', 'sdfsdsdfsdfsdfsfsdf', 1343187222);

INSERT INTO `ljcms_order` (`id`, `ordername`, `remark`, `userid`, `username`, `sex`, `company`, `address`, `zipcode`, `telephone`, `fax`, `mobile`, `email`, `addtime`, `flag`, `ip`, `replyuser`, `replycontent`, `replytime`) VALUES(5, '订购产品如下：企业建站系统V8.6<br/>产品的编号为：1329041563', 'dsfsdsdsfsdfsdf', 1, 'adminsa', '1', 'testsete', 'testestest', '100031', '1321241341', '010-2313131', '13718215123', 'sdfsdfs@dsfsd.com', 1342582002, 1, '127.0.0.1', '', NULL, 0);

INSERT INTO `ljcms_order` (`id`, `ordername`, `remark`, `userid`, `username`, `sex`, `company`, `address`, `zipcode`, `telephone`, `fax`, `mobile`, `email`, `addtime`, `flag`, `ip`, `replyuser`, `replycontent`, `replytime`) VALUES(7, '订购产品如下：良精商城网店系统<br/>产品的编号为：1329042063', 'test', 6, 'itf4', '1', '', 'test', '', '', '', '13621388118', 'asp3721@hotmail.com', 1343297387, 1, '192.168.1.104', '', NULL, 0);

INSERT INTO `ljcms_page` (`pageid`, `cateid`, `linktype`, `linkurl`, `target`, `title`, `content`, `flag`, `navshow`, `orders`, `timeline`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `tag`) VALUES(1, 1, 1, '', 1, 'LJcms介绍', '<p>良精中英文企业网站管理系统V8.6</p>\r\n<p>前台演示 <a href="http://admin.itf4.com/LJv86/Index.html">http://admin.itf4.com/LJv86/Index.html</a></p>\r\n<p>后台演示 <a href="http://admin.itf4.com/LJv86/admin/Admin_Login.asp">http://admin.itf4.com/LJv86/admin/Admin_Login.asp</a></p>\r\n<p>下载地址 <a href="http://www.liangjing.org/down/LJwebFree.rar">http://www.liangjing.org/down/LJwebFree.rar</a></p>\r\n<p>用户名 admin 密码 admin</p>\r\n<p>良精通用网站管理系统V8.6兼容Firefox、Maxthon、TT等常用浏览器！</p>\r\n<p>后台可先切换 动态和静态 asp+html <br />\r\n主要功能模块介绍 <br />\r\n1. 企业信息：发布介绍企业的各类信息，如企业简介、组织机构、营销网络、企业荣誉、联系方式，并可随意增加新的栏目等。 <br />\r\n2. 新闻动态：发布企业新闻和业内资讯，从后台到前台真正实现无限级分类显示，并随意控制显示级数，大大增加信息发布的灵活性。 <br />\r\n3. 产品展示：发布企业产品，按产品类别显示及搜索产品，并可多选产品直接下订单询盘，无限级分类，大大增加信息发布的灵活性。 <br />\r\n4. 下载资源：发布供网站浏览者和客户下载的资料等，如使用手册、销售合同、软件等，无限级分类。 <br />\r\n5. 人力资源：发布招聘信息，人才策略，浏览者可在线递交简历。 <br />\r\n6. 其他信息：相当于无限扩展栏，并可进行无限分类，可以用于发布网站主栏目未归类的信息，如解决方案、成功案例、购买流程等。 <br />\r\n7. 会员中心：会员可任意设置级别，并可根据级别限制浏览相关内容，会员机制与订购、应聘、留言三大模块有机结合的，我们充分考虑到了网站访问者的惰性，所以会员机制与三大模块又可完全脱离，即未注册也同样能留言、下订单、递交简历。 <br />\r\n8. 留言反馈：以留<br />\r\n</p>', 1, 0, 1, 1314267244, '', '', '', '', '');

INSERT INTO `ljcms_pagecate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(1, '单页分类一', '', '', '', '', 0, 0, 1, 1, '', 1314262501, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(1, 5, '1329041563', '企业建站系统V8.6', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/bd77ef11371f56626094951b088ac5ef.jpg.thumb.jpg', 'data/attachment/201202/12/bd77ef11371f56626094951b088ac5ef.jpg', '', '', '', '', '', '', '', '', '演示地址：http://admin.itf4.com/LJv86/Index.html\r\n后台测试：http://admin.itf4.com/LJv86/admin/Admin_Login.asp\r\n下载地址：http://www.liangjing.org/down/LJwebFree.rar', '&nbsp;<p>良精中文企业网站管理系统V8.6</p>\r\n<p>前台演示 <a href="http://admin.itf4.com/LJv86/Index.html">http://admin.itf4.com/LJv86/Index.html</a></p>\r\n<p>后台演示 <a href="http://admin.itf4.com/LJv86/admin/Admin_Login.asp">http://admin.itf4.com/LJv86/admin/Admin_Login.asp</a></p>\r\n<p>下载地址 <a href="http://www.liangjing.org/down/LJwebFree.rar">http://www.liangjing.org/down/LJwebFree.rar</a></p>\r\n<p>用户 admin 密码 admin</p>\r\n<p>良精通用网站管理系统V8.6兼容Firefox、Maxthon、TT等常用浏览器</p>\r\n<p>后台可先切换 动态和静 asp+html <br />\r\n主要功能模块介绍 <br />\r\n1. 企业信息：发布介绍企业的各类信息，如企业简介、组织机构、营销网络、企业荣誉、联系方式，并可随意增加新的栏目等 <br />\r\n2. 新闻动态：发布企业新闻和业内资讯，从后台到前台真正实现无限级分类显示，并随意控制显示级数，大大增加信息发布的灵活性 <br />\r\n3. 产品展示：发布企业产品，按产品类别显示及搜索产品，并可多选产品直接下订单询盘，无限级分类，大大增加信息发布的灵活性 <br />\r\n4. 下载资源：发布供网站浏览者和客户下载的资料等，如使用手册、销售合同、软件等，无限级分类 <br />\r\n5. 人力资源：发布招聘信息，人才策略，浏览者可在线递交简历 <br />\r\n6. 其他信息：相当于无限扩展栏，并可进行无限分类，可以用于发布网站主栏目未归类的信息，如解决方案、成功案例、购买流程等 <br />\r\n7. 会员中心：会员可任意设置级别，并可根据级别限制浏览相关内容，会员机制与订购、应聘、留言三大模块有机结合的，我们充分考虑到了网站访问者的惰性，所以会员机制与三大模块又可完全脱离，即未注册也同样能留言、下订单、递交简历 <br />\r\n</p>', '0.00', '', '', 2, 0, 0, 0, 1, 1329041563, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(2, 5, '1329041609', '企业建站系统V7.4', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/b692aaf0a247536bf55054aacf34b213.jpg.thumb.jpg', 'data/attachment/201202/12/b692aaf0a247536bf55054aacf34b213.jpg', '', '', '', '', '', '', '', '', '', '&nbsp;<p>良精中文企业网站管理系统V7.4</p>\r\n<p>前台演示 <a href="http://admin.itf4.com/LJV74/index.html">http://admin.itf4.com/LJV74/index.html</a></p>\r\n<p>后台演示 <a href="http://admin.itf4.com/LJV74/admin/admin_login.asp">http://admin.itf4.com/LJV74/admin/admin_login.asp</a></p>\r\n<p>下载地址 <a href="http://www.liangjing.org/down/LJwebFree.rar">http://www.liangjing.org/down/LJwebFree.rar</a></p>\r\n<p>用户 admin 密码 admin</p>\r\n<p>良精通用网站管理系统V7.4 兼容Firefox、Maxthon、TT等常用浏览器</p>\r\n<p>后台可先切换 动态和静 asp+html <br />\r\n主要功能模块介绍 <br />\r\n1. 企业信息：发布介绍企业的各类信息，如企业简介、组织机构、营销网络、企业荣誉、联系方式，并可随意增加新的栏目等 <br />\r\n2. 新闻动态：发布企业新闻和业内资讯，从后台到前台真正实现无限级分类显示，并随意控制显示级数，大大增加信息发布的灵活性 <br />\r\n3. 产品展示：发布企业产品，按产品类别显示及搜索产品，并可多选产品直接下订单询盘，无限级分类，大大增加信息发布的灵活性 <br />\r\n4. 下载资源：发布供网站浏览者和客户下载的资料等，如使用手册、销售合同、软件等，无限级分类 <br />\r\n5. 人力资源：发布招聘信息，人才策略，浏览者可在线递交简历 <br />\r\n6. 其他信息：相当于无限扩展栏，并可进行无限分类，可以用于发布网站主栏目未归类的信息，如解决方案、成功案例、购买流程等 <br />\r\n7. 会员中心：会员可任意设置级别，并可根据级别限制浏览相关内容，会员机制与订购、应聘、留言三大模块有机结合的，我们充分考虑到了网站访问者的惰性，所以会员机制与三大模块又可完全脱离，即未注册也同样能留言、下订单、递交简历 <br />\r\n</p>', '0.00', '', '', 6, 0, 0, 0, 1, 1329041609, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(3, 5, '1329041637', '企业建站系统V8.5', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/0714b887d41f693e99307af29dba8ee0.jpg.thumb.jpg', 'data/attachment/201202/12/0714b887d41f693e99307af29dba8ee0.jpg', '', '', '', '', '', '', '', '', '', '&nbsp;<p>良精中文企业网站管理系统V8.5</p>\r\n<p>前台演示 <a href="http://admin.itf4.com/LJCMSV85/index.html">http://admin.itf4.com/LJCMSV85/index.html</a></p>\r\n<p>后台演示 <a href="http://admin.itf4.com/LJCMSV85/admin/Admin_Login.asp">http://admin.itf4.com/LJCMSV85/admin/Admin_Login.asp</a></p>\r\n<p>下载地址 <a href="http://www.liangjing.org/down/LJwebFree.rar">http://www.liangjing.org/down/LJwebFree.rar</a></p>\r\n<p>用户 admin 密码 admin</p>\r\n<p>良精通用网站管理系统V8.5 兼容Firefox、Maxthon、TT等常用浏览器</p>\r\n<p>后台可先切换 动态和静 asp+html <br />\r\n主要功能模块介绍 <br />\r\n1. 企业信息：发布介绍企业的各类信息，如企业简介、组织机构、营销网络、企业荣誉、联系方式，并可随意增加新的栏目等 <br />\r\n2. 新闻动态：发布企业新闻和业内资讯，从后台到前台真正实现无限级分类显示，并随意控制显示级数，大大增加信息发布的灵活性 <br />\r\n3. 产品展示：发布企业产品，按产品类别显示及搜索产品，并可多选产品直接下订单询盘，无限级分类，大大增加信息发布的灵活性 <br />\r\n4. 下载资源：发布供网站浏览者和客户下载的资料等，如使用手册、销售合同、软件等，无限级分类 <br />\r\n5. 人力资源：发布招聘信息，人才策略，浏览者可在线递交简历 <br />\r\n6. 其他信息：相当于无限扩展栏，并可进行无限分类，可以用于发布网站主栏目未归类的信息，如解决方案、成功案例、购买流程等 <br />\r\n7. 会员中心：会员可任意设置级别，并可根据级别限制浏览相关内容，会员机制与订购、应聘、留言三大模块有机结合的，我们充分考虑到了网站访问者的惰性，所以会员机制与三大模块又可完全脱离，即未注册也同样能留言、下订单、递交简历 <br />\r\n</p>', '0.00', '', '', 4, 0, 0, 0, 1, 1329041637, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(4, 5, '1329041665', '企业建站系统V7.3', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/d99a003b376fb3133da1d004d823a2de.jpg.thumb.jpg', 'data/attachment/201202/12/d99a003b376fb3133da1d004d823a2de.jpg', '', '', '', '', '', '', '', '', '', '&nbsp;<p>良精中文企业网站管理系统V7.3</p>\r\n<p>前台演示 <a href="http://admin.itf4.com/LJV73/index.html">http://admin.itf4.com/LJV73/index.html</a></p>\r\n<p>后台演示 <a href="http://admin.itf4.com/LJV73/admin/admin_login.asp">http://admin.itf4.com/LJV73/admin/admin_login.asp</a></p>\r\n<p>下载地址 <a href="http://www.liangjing.org/down/LJwebFree.rar">http://www.liangjing.org/down/LJwebFree.rar</a></p>\r\n<p>用户 admin 密码 admin</p>\r\n<p>良精通用网站管理系统V7.3 兼容Firefox、Maxthon、TT等常用浏览器</p>\r\n<p>后台可先切换 动态和静 asp+html <br />\r\n主要功能模块介绍 <br />\r\n1. 企业信息：发布介绍企业的各类信息，如企业简介、组织机构、营销网络、企业荣誉、联系方式，并可随意增加新的栏目等 <br />\r\n2. 新闻动态：发布企业新闻和业内资讯，从后台到前台真正实现无限级分类显示，并随意控制显示级数，大大增加信息发布的灵活性 <br />\r\n3. 产品展示：发布企业产品，按产品类别显示及搜索产品，并可多选产品直接下订单询盘，无限级分类，大大增加信息发布的灵活性 <br />\r\n4. 下载资源：发布供网站浏览者和客户下载的资料等，如使用手册、销售合同、软件等，无限级分类 <br />\r\n5. 人力资源：发布招聘信息，人才策略，浏览者可在线递交简历 <br />\r\n6. 其他信息：相当于无限扩展栏，并可进行无限分类，可以用于发布网站主栏目未归类的信息，如解决方案、成功案例、购买流程等 <br />\r\n7. 会员中心：会员可任意设置级别，并可根据级别限制浏览相关内容，会员机制与订购、应聘、留言三大模块有机结合的，我们充分考虑到了网站访问者的惰性，所以会员机制与三大模块又可完全脱离，即未注册也同样能留言、下订单、递交简历 <br />\r\n</p>', '0.00', '', '', 3, 0, 0, 0, 1, 1329041665, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(5, 6, '1329041706', '旅游建站系统V1.3', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/e987b421545a57f63766d1c850866fe5.jpg.thumb.jpg', 'data/attachment/201202/12/e987b421545a57f63766d1c850866fe5.jpg', '', '', '', '', '', '', '', '', '', '<div style="line-height:24px;display:block;" id="con1">\r\n<p><span style="font-family:Verdana;">良精旅游建站系统1.3</span></p>\r\n<p>演示地址　<span style="font-family:Verdana;"><a href="http://admin.itf4.com/lvyou3/Index.html">http://admin.itf4.com/lvyou3/Index.html</a></span></p>\r\n<p>后台测试 <span style="font-family:Verdana;"><a href="http://admin.itf4.com/lvyou3/admin/Admin_Login.asp">http://admin.itf4.com/lvyou3/admin/Admin_Login.asp</a></span></p>\r\n<p>用户 admin 密码 admin</p>\r\n</div>', '0.00', '', '', 2, 0, 0, 0, 1, 1329041706, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(6, 6, '1329041762', '剧团建站系统V1.0', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/2d3d8a34c32f40eeab8ab8f2e8460c7f.jpg.thumb.jpg', 'data/attachment/201202/12/2d3d8a34c32f40eeab8ab8f2e8460c7f.jpg', '', '', '', '', '', '', '', '', '', '<div style="line-height:24px;display:block;" id="con1">\r\n<div style="line-height:24px;display:block;" id="con1"><span style="font-family:Verdana;"> <div style="line-height:24px;display:block;" id="con1">\r\n<p><span style="font-family:Verdana;">良精剧团建站系统V1.0</span></p>\r\n<p>演示地址　<a href="http://admin.itf4.com/jutuan/index.html">http://admin.itf4.com/jutuan/index.html</a></p>\r\n<p>后台测试 <a href="http://admin.itf4.com/jutuan/admin/admin_login.asp">http://admin.itf4.com/jutuan/admin/admin_login.asp</a></p>\r\n<p><a href="http://www.liangjing.org/down/LJwebFree.rar">下载地址 http://www.liangjing.org/down/LJwebFree.rar</a></p>\r\n<p>用户 admin 密码 admin</p>\r\n</div>\r\n</span></div>\r\n</div>', '0.00', '', '', 1, 0, 0, 0, 1, 1329041762, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(7, 6, '1329041784', '政府建站系统 V2.1', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/d047f6b83b63d9e2a1263879026b2aff.jpg.thumb.jpg', 'data/attachment/201202/12/d047f6b83b63d9e2a1263879026b2aff.jpg', '', '', '', '', '', '', '', '', '', '<p>良精政府网站管理系统 V2.1</p>\r\n<p>演示地址：http://admin.itf4.com/zf21</p>\r\n<p><br />\r\n后台测试：http://admin.itf4.com/zf21/admin</p>\r\n<p><br />\r\n下载地址：http://www.liangjing.org/down/LJwebFree.rar</p>\r\n<p><br />\r\n后台测试：用户名 admin 密码 admin</p>', '0.00', '', '', 2, 0, 0, 0, 1, 1329041784, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(8, 6, '1329041803', '政府建站系统 V2.0', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/2a0b2bea856bb073c670b7b1877fb4fa.jpg.thumb.jpg', 'data/attachment/201202/12/2a0b2bea856bb073c670b7b1877fb4fa.jpg', '', '', '', '', '', '', '', '', '', '<p>良精政府网站管理系统 V2.0</p>\r\n<p>演示地址<a href="http://admin.itf4.com/zf02">http://admin.itf4.com/zf02</a></p>\r\n<p><br />\r\n后台测试<a href="http://admin.itf4.com/zf02/admin">http://admin.itf4.com/zf02/admin</a><br />\r\n</p>\r\n<p>下载地址<a href="http://www.liangjing.org/down/LJwebFree.rar">http://www.liangjing.org/down/LJwebFree.rar</a></p>\r\n<p><br />\r\n后台测试：用户名 admin 密码 admin</p>', '0.00', '6868668868', '>=', 2, 0, 0, 0, 1, 1329041803, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(9, 7, '1329041925', '中英文网店系统V2.2', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/f03a6d615808781adb1c36c18b316ce8.jpg.thumb.jpg', 'data/attachment/201202/12/f03a6d615808781adb1c36c18b316ce8.jpg', '', '', '', '', '', '', '', '', '', '<p><span style="font-family:Verdana;">良精<span style="font-family:Verdana;">中英文网店系统V2.2</span></span></p>\r\n<p><span style="font-family:Verdana;">前台演示 <a href="http://admin.itf4.com/LJshopV22/Ch/index.html">http://admin.itf4.com/LJshopV22/Ch/index.html</a></span></p>\r\n<p><span style="font-family:Verdana;">后台演示 <a href="http://admin.itf4.com/LJshopV22/admin/Admin_Login.asp">http://admin.itf4.com/LJshopV22/admin/Admin_Login.asp</a></span></p>\r\n<p><span style="font-family:Verdana;">下载地址 <a href="http://www.liangjing.org/down/LJshop20091216.rar">http://www.liangjing.org/down/LJshop20091216.rar</a></span></p>\r\n<p><span style="font-family:Verdana;">用户 admin 密码 admin</span></p>\r\n<p><span style="font-family:Verdana;">后台可先切换 动态和静 asp+html+ACCESS </span></p>\r\n<p><span style="font-family:Verdana;">在线实时支付 兼容Firefox、Maxthon、TT等常用浏览器</span></p>\r\n<p><span style="font-family:Verdana;">不含SQL数据 如需SQL数据库加 000<br />\r\n主要功能模块介绍 <br />\r\n1. 企业信息：发布介绍企业的各类信息，如企业简介、组织机构、营销网络、企业荣誉、联系方式，并可随意增加新的栏目等 <br />\r\n2. 新闻动态：发布企业新闻和业内资讯，从后台到前台真正实现无限级分类显示，并随意控制显示级数，大大增加信息发布的灵活性 <br />\r\n3. 商品展示：发布企业商品，按商品类别显示及搜索商品，并可多选商品直接下订单询盘，无限级分类，大大增加信息发布的灵活性 <br />\r\n4. 下载资源：发布供网站浏览者和客户下载的资料等，如使用手册、销售合同、软件等，无限级分类 <br />\r\n5. 人力资源：发布招聘信息，人才策略，浏览者可在线递交简历 <br />\r\n6. 其他信息：相当于无限扩展栏，并可进行无限分类，可以用于发布网站主栏目未归类的信息，如解决方案、成功案例、购买流程等 <br />\r\n7. 会员中心：会员可任意设置级别，并可根据级别限制浏览相关内容，会员机制与订购、应聘、留言三大模块有机结合的，我们充分考虑到了网站访问者的惰性，所以会员机制与三大模块又可完全脱离，即未注册也同样能留言、下订单、递交简历 <br />\r\n8. 留言反馈：以留言板的模式让有意见和建议的浏览者反馈回来，可设悄悄话留言方式，可设默认是否通过审核后显示留言<br />\r\n</span></p>', '0.00', '', '', 2, 1, 0, 0, 1, 1329041925, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(10, 7, '1329041956', '中英文网店系统V2.0', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/9faedbd6bc3bdb72108468a03b6ceb0b.jpg.thumb.jpg', 'data/attachment/201202/12/9faedbd6bc3bdb72108468a03b6ceb0b.jpg', '', '', '', '', '', '', '', '', '', '<div style="line-height:24px;display:block;" id="con1">\r\n<p><span style="font-family:Verdana;">良精<span style="font-family:Verdana;">中英文网店系统V2.0</span></span></p>\r\n<p><span style="font-family:Verdana;">前台演示 http://admin.itf4.com/LJshopV20/Ch/index.html</span></p>\r\n<p><span style="font-family:Verdana;">后台演示 http://admin.itf4.com/LJshopV20/admin/Admin_Login.asp</span></p>\r\n<p><span style="font-family:Verdana;">下载地址 http://www.liangjing.org/down/LJshop20091216.rar</span></p>\r\n<p><span style="font-family:Verdana;">用户 admin 密码 admin</span></p>\r\n<p><span style="font-family:Verdana;">后台可先切换 动态和静 asp+html+ACCESS </span></p>\r\n<p><span style="font-family:Verdana;">在线实时支付 兼容Firefox、Maxthon、TT等常用浏览器</span></p>\r\n<p><span style="font-family:Verdana;">不含SQL数据 如需SQL数据库加 000<br />\r\n主要功能模块介绍 <br />\r\n1. 企业信息：发布介绍企业的各类信息，如企业简介、组织机构、营销网络、企业荣誉、联系方式，并可随意增加新的栏目等 <br />\r\n2. 新闻动态：发布企业新闻和业内资讯，从后台到前台真正实现无限级分类显示，并随意控制显示级数，大大增加信息发布的灵活性 <br />\r\n3. 商品展示：发布企业商品，按商品类别显示及搜索商品，并可多选商品直接下订单询盘，无限级分类，大大增加信息发布的灵活性 <br />\r\n4. 下载资源：发布供网站浏览者和客户下载的资料等，如使用手册、销售合同、软件等，无限级分类 <br />\r\n5. 人力资源：发布招聘信息，人才策略，浏览者可在线递交简历 <br />\r\n6. 其他信息：相当于无限扩展栏，并可进行无限分类，可以用于发布网站主栏目未归类的信息，如解决方案、成功案例、购买流程等 <br />\r\n7. 会员中心：会员可任意设置级别，并可根据级别限制浏览相关内容，会员机制与订购、应聘、留言三大模块有机结合的，我们充分考虑到了网站访问者的惰性，所以会员机制与三大模块又可完全脱离，即未注册也同样能留言、下订单、递交简历 <br />\r\n8. 留言反馈：以留言板的模式让有意见和建议的浏览者反馈回来，可设悄悄话留言方式，可设默认是否通过审核后显示留言<br />\r\n</span></p>\r\n</div>', '0.00', '', '', 5, 1, 0, 0, 1, 1329041956, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(11, 7, '1329041986', '良精商城网店V1.3', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/12e80b0b3f19cb816e48822dfb056e9a.jpg.thumb.jpg', 'data/attachment/201202/12/12e80b0b3f19cb816e48822dfb056e9a.jpg', '', '', '', '', '', '', '', '', '', '<div style="line-height:24px;display:block;" id="con1">建一个网站，就像修改QQ个资料一样方便 <p>演示地址 <span style="font-family:Verdana;"><a href="http://admin.asp99.cn/LJhtmlShopV3/index.html">http://admin.asp99.cn/LJhtmlShopV3/index.html</a></span></p>\r\n<p>后台演示 <span style="font-family:Verdana;"><a href="http://admin.asp99.cn/shop2009/admin/index.asp">http://admin.asp99.cn/shop2009/admin/index.asp</a></span></p>\r\n<p>下载地址 <span style="font-family:Verdana;"><a href="http://www.asp99.cn/ljnetshop.rar"><span style="font-family:Verdana;">http://www.liangjing.org/down/LJshop20091216.rar</span></a></span></p>\r\n<p>分流下载 <span style="font-family:Verdana;"><a href="http://down.admin5.com/code_asp/17681.html">http://down.admin5.com/code_asp/17681.html</a></span></p>\r\n<p>后台用户名密码admin<br />\r\n<span style="font-family:Verdana;">良精网店购物系统是一套能够适合不同类型商品、超强灵活的多功能在线商店系统，为您提供了一个完整的在线开店解决方案。良精网店购物系统除了拥有一般网上商店系统所具有的所有功能，还拥有着其它网店系统没有的许多超强功能。多种独创的技术使得系统能满足各行业广大用户的各种各样的需求，是一个经过完善设计并适用于各种服务器环境的高效、全新、快速和优秀的网上购物软件解决方案</span></p>\r\n<p><span style="font-family:Verdana;">良精网店购物系统无论在稳定性、代码优化、运行效率、负载能力、安全等级、功能可操控性和权限严密性等方面都居国内外同类产品领先地位。经过长期创新性开发，成为目前国内最具性价比、最受欢迎的网上购物软件之一。如果您寻求一款能按您的想法随意发挥的网上购物软件，那么良精网店购物系统将是您最佳的选择</span></p>\r\n<p><span style="font-family:Verdana;">良精网店商城系统是向中小企业及个人快速构建个性化网上商店,网店系统，是目前国内最受欢迎的网店系统之一。其安全实用的商品管理、订单管理、销售管理、客户和代理商管理，批发管理、支付管理、模板管理等众多强大功能，让您可以快速低成本地构建个性化网上商店</span></p>\r\n</div>', '0.00', '6868668868', '', 4, 0, 0, 0, 1, 1329041986, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(12, 7, '1329042008', '良精商城网店V1.2', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/a4ea1ccdc263947de8a83a06ef56cfa4.jpg.thumb.jpg', 'data/attachment/201202/12/a4ea1ccdc263947de8a83a06ef56cfa4.jpg', '', '', '', '', '', '', '', '', '', '<div style="line-height:24px;display:block;" id="con1">\r\n<p><span style="font-family:Verdana;">建一个网站，就像修改QQ个资料一样方便 <br />\r\n演示地址 <a href="http://admin.asp99.cn/LJhtmlShopV2/index.html">http://admin.asp99.cn/LJhtmlShopV2/index.html</a></span></p>\r\n<p><span style="font-family:Verdana;">后台演示 http://admin.asp99.cn/shop2009/admin/index.asp</span></p>\r\n<p><span style="font-family:Verdana;">下载地址 <span style="font-family:Verdana;">http://www.liangjing.org/down/LJshop20091216.rar</span></span></p>\r\n<p><span style="font-family:Verdana;">后台用户名密码admin<br />\r\n良精网店购物系统是一套能够适合不同类型商品、超强灵活的多功能在线商店系统，为您提供了一个完整的在线开店解决方案。良精网店购物系统除了拥有一般网上商店系统所具有的所有功能，还拥有着其它网店系统没有的许多超强功能。多种独创的技术使得系统能满足各行业广大用户的各种各样的需求，是一个经过完善设计并适用于各种服务器环境的高效、全新、快速和优秀的网上购物软件解决方案</span></p>\r\n<p><span style="font-family:Verdana;">良精网店购物系统无论在稳定性、代码优化、运行效率、负载能力、安全等级、功能可操控性和权限严密性等方面都居国内外同类产品领先地位。经过长期创新性开发，成为目前国内最具性价比、最受欢迎的网上购物软件之一。如果您寻求一款能按您的想法随意发挥的网上购物软件，那么良精网店购物系统将是您最佳的选择</span></p>\r\n<p><span style="font-family:Verdana;">良精网店商城系统是向中小企业及个人快速构建个性化网上商店,网店系统，是目前国内最受欢迎的网店系统之一。其安全实用的商品管理、订单管理、销售管理、客户和代理商管理，批发管理、支付管理、模板管理等众多强大功能，让您可以快速低成本地构建个性化网上商店<br />\r\n</span></p>\r\n</div>', '0.00', '', '', 13, 1, 0, 0, 1, 1329042008, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(13, 7, '1329042037', '良精商城网店系统V1.1', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/48960354a46969d246a1cd9af990e03a.jpg.thumb.jpg', 'data/attachment/201202/12/48960354a46969d246a1cd9af990e03a.jpg', '', '', '', '', '', '', '', '', '', '<table class="tf ke-zeroborder" border="0" width="98%">\r\n<tbody>\r\n<tr>\r\n<td class="bw"><span class="htd">演示地址&nbsp;<img border="0" align="absMiddle" src="http://www.asp99.net/skin/skin_3/small/url.gif" /><a href="http://admin.asp99.cn/newshop/" target="_blank">http://admin.asp99.cn/newshop/</a><br />\r\n<br />\r\n后台测试&nbsp;<img border="0" align="absMiddle" src="http://www.asp99.net/skin/skin_3/small/url.gif" /><a href="http://admin.asp99.cn/newshop/admin.asp" target="_blank">http://admin.asp99.cn/newshop/admin.asp</a><br />\r\n<br />\r\n下载地址&nbsp;<img border="0" align="absMiddle" src="http://www.asp99.net/skin/skin_3/small/url.gif" /><a href="http://down.asp99.cn/shop20061220.rar" target="_blank"><span style="font-family:Verdana;">http://www.liangjing.org/down/LJshop20091216.rar</span></a>&nbsp;<br />\r\n后台测试&nbsp;帐号&nbsp;密码admin</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><span style="font-family:Verdana;">良精网店购物系统是一套能够适合不同类型商品、超强灵活的多功能在线商店系统，为您提供了一个完整的在线开店解决方案。良精网店购物系统除了拥有一般网上商店系统所具有的所有功能，还拥有着其它网店系统没有的许多超强功能。多种独创的技术使得系统能满足各行业广大用户的各种各样的需求，是一个经过完善设计并适用于各种服务器环境的高效、全新、快速和优秀的网上购物软件解决方案</span></p>\r\n<p><span style="font-family:Verdana;">良精网店购物系统无论在稳定性、代码优化、运行效率、负载能力、安全等级、功能可操控性和权限严密性等方面都居国内外同类产品领先地位。经过长期创新性开发，成为目前国内最具性价比、最受欢迎的网上购物软件之一。如果您寻求一款能按您的想法随意发挥的网上购物软件，那么良精网店购物系统将是您最佳的选择</span></p>\r\n<p><span style="font-family:Verdana;">良精网店商城系统是向中小企业及个人快速构建个性化网上商店,网店系统，是目前国内最受欢迎的网店系统之一。其安全实用的商品管理、订单管理、销售管理、客户和代理商管理，批发管理、支付管理、模板管理等众多强大功能，让您可以快速低成本地构建个性化网上商店<br />\r\n</span></p>', '0.00', '', '', 25, 0, 0, 0, 1, 1329042037, 0, '');

INSERT INTO `ljcms_product` (`productid`, `cateid`, `productnum`, `productname`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `thumbfiles`, `uploadfiles`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `intro`, `content`, `price`, `ugroupid`, `exclusive`, `hits`, `elite`, `isnew`, `hots`, `flag`, `timeline`, `deleted`, `tag`) VALUES(14, 7, '1329042063', '良精商城网店系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 'data/attachment/201202/12/673643d43790a1d95e34a2abf55beb63.jpg.thumb.jpg', 'data/attachment/201202/12/673643d43790a1d95e34a2abf55beb63.jpg', '', '', '', '', '', '', '', '', '', '<div style="line-height:24px;display:block;" id="con1">\r\n<p>&nbsp;商城网店系统正式<br />\r\n<br />\r\n建一个网站，就像修改QQ个资料一样方便</p>\r\n<p><span style="font-size:18px;"><span style="font-family:宋体;font-size:18px;">后台用户名密码admin</span><br />\r\n</span>多风格商城功能太强大了</p>\r\n<p><span style="font-family:Verdana;">良精网店购物系统是一套能够适合不同类型商品、超强灵活的多功能在线商店系统，为您提供了一个完整的在线开店解决方案。良精网店购物系统除了拥有一般网上商店系统所具有的所有功能，还拥有着其它网店系统没有的许多超强功能。多种独创的技术使得系统能满足各行业广大用户的各种各样的需求，是一个经过完善设计并适用于各种服务器环境的高效、全新、快速和优秀的网上购物软件解决方案</span></p>\r\n<p><span style="font-family:Verdana;">良精网店购物系统无论在稳定性、代码优化、运行效率、负载能力、安全等级、功能可操控性和权限严密性等方面都居国内外同类产品领先地位。经过长期创新性开发，成为目前国内最具性价比、最受欢迎的网上购物软件之一。如果您寻求一款能按您的想法随意发挥的网上购物软件，那么良精网店购物系统将是您最佳的选择</span></p>\r\n<p><span style="font-family:Verdana;">良精网店商城系统是向中小企业及个人快速构建个性化网上商店,网店系统，是目前国内最受欢迎的网店系统之一。其安全实用的商品管理、订单管理、销售管理、客户和代理商管理，批发管理、支付管理、模板管理等众多强大功能，让您可以快速低成本地构建个性化网上商店</span></p>\r\n</div>', '0.00', '2147483647', '>=', 105, 0, 0, 0, 1, 1329042063, 0, '');

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(10, '显卡', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 3, 1, 9, 1, 0, '', 1329037773, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(6, '政府网站源码', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 4, 1, 5, 1, 0, '', 1329037658, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(15, '热水', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 2, 1, 14, 1, 0, '', 1329037824, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(14, '洗衣', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 2, 1, 13, 1, 0, '', 1329037817, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(13, '冰箱', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 2, 1, 12, 1, 0, '', 1329037810, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(12, '电视', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 2, 1, 11, 1, 0, '', 1329037801, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(11, '硬盘', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 3, 1, 10, 1, 0, '', 1329037783, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(7, '商城网店源码', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 4, 1, 6, 1, 0, '', 1329037696, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(8, 'CPU', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 3, 1, 7, 1, 0, '', 1329037747, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(9, '主板', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 3, 1, 8, 1, 0, '', 1329037764, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(5, '企业网站源码', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 4, 1, 4, 1, 0, '', 1329037632, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(4, '网站源码', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 1, 1, 0, '', 1329037579, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(3, '电脑配件', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 2, 1, 0, '', 1329037501, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(2, '家用电器', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 3, 1, 0, '', 1329037465, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(16, '良精源码', '良精源码', '良精源码', '良精源码', '', 0, 0, 15, 1, 0, '良精源码', 1332578443, '', '', 1, '', 1);

INSERT INTO `ljcms_productcate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `elite`, `intro`, `timeline`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(17, '其他源码', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 16, 1, 0, '', 1332578839, '', '', 1, '', 1);

INSERT INTO `ljcms_skin` (`skinid`, `skinname`, `skindir`, `skinext`, `thumbfiles`, `orders`, `flag`, `timeline`, `remark`) VALUES(1, '良精蓝色通用', 'blue', 'tpl', 'data/attachment/201206/11/d602cb754e3a8995f85f1bc915118252.jpg', 0, 0, 1313905723, '良精蓝色通用');

INSERT INTO `ljcms_skin` (`skinid`, `skinname`, `skindir`, `skinext`, `thumbfiles`, `orders`, `flag`, `timeline`, `remark`) VALUES(3, '良精企业建站V3.5', 'Ljcms1', 'tpl', 'data/attachment/201206/11/fa086afb9f03e15918d577fe1712a5bb.jpg', 0, 0, 1332464415, '良精企业建站V3.5');

INSERT INTO `ljcms_skin` (`skinid`, `skinname`, `skindir`, `skinext`, `thumbfiles`, `orders`, `flag`, `timeline`, `remark`) VALUES(4, '良精企业网站3.9', 'Ljcms39', 'tpl', 'data/attachment/201206/11/21222e07c25e43f51d301c79ceaa9027.jpg', 0, 0, 1332901239, '良精企业网站3.9');

INSERT INTO `ljcms_skin` (`skinid`, `skinname`, `skindir`, `skinext`, `thumbfiles`, `orders`, `flag`, `timeline`, `remark`) VALUES(5, '良精仿小米官方站', 'LjimitateIm', 'html', 'data/attachment/201206/11/75302241c42a0fabb1df252cc6cbadaa.gif', 0, 1, 1337752082, '良精仿小米官方企业站');

INSERT INTO `ljcms_solution` (`solutionid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `author`, `cfrom`, `flag`, `ugroupid`, `exclusive`, `istop`, `elite`, `headline`, `slide`, `hits`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `deleted`, `tag`) VALUES(1, 2, '解决方案1011', 'data/attachment/201202/12/351b27ec8e7a700b47165be887625cae.jpg.thumb.jpg', 'data/attachment/201202/12/351b27ec8e7a700b47165be887625cae.jpg', '', '<p>解决方案1011</p>\r\n<p>解决方案1011</p>\r\n<p>解决方案1011</p>\r\n<p>解决方案1011</p>\r\n<p>解决方案1011</p>\r\n<p>解决方案1011</p>\r\n<p>解决方案1011</p>\r\n<p>解决方案1011</p>', 1329044073, '', '', 1, '', '', 0, 1, 0, 0, 4, '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, '');

INSERT INTO `ljcms_solution` (`solutionid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `author`, `cfrom`, `flag`, `ugroupid`, `exclusive`, `istop`, `elite`, `headline`, `slide`, `hits`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `deleted`, `tag`) VALUES(2, 2, '公司企业相关问题的解决方案编号102', '', '', '', '<p>公司企业相关问题的解决方案编号102</p>\r\n<p>公司企业相关问题的解决方案编号102</p>\r\n<p>公司企业相关问题的解决方案编号102</p>', 1329044109, '', '', 1, '', '', 0, 1, 0, 0, 4, '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, '');

INSERT INTO `ljcms_solution` (`solutionid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `author`, `cfrom`, `flag`, `ugroupid`, `exclusive`, `istop`, `elite`, `headline`, `slide`, `hits`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `deleted`, `tag`) VALUES(3, 2, '公司企业相关问题的解决方案编号103', '', '', '', '<p>公司企业相关问题的解决方案编号103</p>\r\n<p>公司企业相关问题的解决方案编号103</p>\r\n<p>公司企业相关问题的解决方案编号103</p>\r\n<p>&nbsp;</p>\r\n<p>公司企业相关问题的解决方案编号103</p>\r\n<p>公司企业相关问题的解决方案编号103</p>', 1329044121, '', '', 1, '', '', 0, 1, 0, 0, 8, '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, '');

INSERT INTO `ljcms_solution` (`solutionid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `author`, `cfrom`, `flag`, `ugroupid`, `exclusive`, `istop`, `elite`, `headline`, `slide`, `hits`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `deleted`, `tag`) VALUES(4, 1, '公司企业相关问题的解决方案编号1031', '', '', '', '<p>公司企业相关问题的解决方案编号1031</p>\r\n<p>公司企业相关问题的解决方案编号1031</p>\r\n<p>公司企业相关问题的解决方案编号1031</p>\r\n<p>公司企业相关问题的解决方案编号1031</p>\r\n<p>公司企业相关问题的解决方案编号1031</p>\r\n<p>公司企业相关问题的解决方案编号1031</p>\r\n<p>公司企业相关问题的解决方案编号1031</p>', 1329044142, 'admin', 'admin', 1, '6868668868', '>=', 0, 1, 0, 0, 12, '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, '');

INSERT INTO `ljcms_solution` (`solutionid`, `cateid`, `title`, `thumbfiles`, `uploadfiles`, `summary`, `content`, `timeline`, `author`, `cfrom`, `flag`, `ugroupid`, `exclusive`, `istop`, `elite`, `headline`, `slide`, `hits`, `metatitle`, `metakeyword`, `metadescription`, `delimitname`, `deleted`, `tag`) VALUES(5, 1, '公司企业相关问题的解决方案编号1032', '', '', '', '<p>公司企业相关问题的解决方案编号1032</p>\r\n<p>公司企业相关问题的解决方案编号1032</p>\r\n<p>公司企业相关问题的解决方案编号1032</p>\r\n<p>公司企业相关问题的解决方案编号1032</p>\r\n<p>公司企业相关问题的解决方案编号1032</p>\r\n<p>公司企业相关问题的解决方案编号1032</p>\r\n<p>公司企业相关问题的解决方案编号1032</p>\r\n<p>公司企业相关问题的解决方案编号1032</p>', 1329044156, '', '', 1, '', '', 0, 1, 0, 0, 17, '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, '');

INSERT INTO `ljcms_solutioncate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(1, '网站报错', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 1, 1, '', 1332723699, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_solutioncate` (`cateid`, `catename`, `metatitle`, `metakeyword`, `metadescription`, `pathname`, `parentid`, `depth`, `orders`, `flag`, `intro`, `timeline`, `elite`, `cssname`, `img`, `linktype`, `linkurl`, `target`) VALUES(2, 'seo优化', '良精php企业网站管理系统', '良精php企业网站管理系统', '良精php企业网站管理系统', '', 0, 0, 2, 1, '', 1332723725, 0, '', '', 1, '', 1);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(1, 'adminsa', '1', 'e10adc3949ba59abbe56e057f20f883e', 0, '', '1111', '2222', '2222', 1341203150, 0, 1, 55, 1, '1111', '1111', '1111', '1111', 0, '111', '', 1344299779, '127.0.0.1', '11111', '大家好');

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(12, '11111', '', '96e79218965eb72c92a549dd5a330112', 0, '', NULL, '', '', 1343194395, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(11, 'test23', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343194252, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(10, 'test220', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343194153, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(3, 'test11', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', 'sdfsdfs@126.com', 1341276533, 0, 1, 3, 1, '', 'testestes', '', '2009-10-11', 0, '', '010-6684214', 1341468162, '127.0.0.1', '', 'sdfsfsfdfsf');

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(4, 'test22', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', 'sdfsdfs@126.com', 1341308536, 0, 1, 0, 1, '', '', '', '2008-10-11', 1, '', '010-66884112', 0, '', '', '');

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(13, '1122', '', '202cb962ac59075b964b07152d234b70', 0, '', NULL, '', '', 1343194685, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(6, 'itf4', '', 'a10e774504c45fb60a5643105ba6093c', 0, '', NULL, '', 'asp3721@163.com', 1341388598, 0, 1, 2, 1, '', '', '', '', 1, '', '81991660', 1343297221, '192.168.1.104', '', '');

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(9, 'test123', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343192969, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(7, 'test110', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343182525, 0, 1, 3, 1, '', '', '', '', 0, '', '', 1343187287, '127.0.0.1', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(8, 'test120', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343183961, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(14, '1q1', '', '202cb962ac59075b964b07152d234b70', 0, '', NULL, '', '', 1343195043, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(15, '123sa', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343195138, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(16, '1qw', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343195256, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(17, '1231', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343195458, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(18, 'qwewq', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343195850, 0, 1, 0, 1, '', '', '', '', 0, '', '', 0, '', '', NULL);

INSERT INTO `ljcms_user` (`userid`, `loginname`, `salt`, `password`, `postnums`, `realname`, `explam`, `url`, `email`, `regdate`, `stopdate`, `usergroupid`, `pointnum`, `flag`, `nicename`, `address`, `headimg`, `brothday`, `sex`, `im`, `telno`, `lastlogindate`, `lastloginip`, `forgetpwd`, `memo`) VALUES(19, 'test1123', '', 'e10adc3949ba59abbe56e057f20f883e', 0, '', NULL, '', '', 1343196219, 0, 1, 1, 1, '', '', '', '', 0, '', '', 1343196219, '127.0.0.1', '', NULL);

INSERT INTO `ljcms_usergroup` (`usergroupid`, `grupname`, `level`, `menu`, `gpurview`, `flag`, `addtime`, `intro`) VALUES(1, '普通会员', '2147483647', '', 1, 1, 'new.php', '普通会员普通会员');

INSERT INTO `ljcms_usergroup` (`usergroupid`, `grupname`, `level`, `menu`, `gpurview`, `flag`, `addtime`, `intro`) VALUES(2, '高级会员', '666666666', '', 6, 1, '1340955505', '高级会员');

INSERT INTO `ljcms_usergroup` (`usergroupid`, `grupname`, `level`, `menu`, `gpurview`, `flag`, `addtime`, `intro`) VALUES(3, '合作伙伴', '99999999', '', 9, 1, '1340955539', '合作伙伴');

INSERT INTO `ljcms_usergroup` (`usergroupid`, `grupname`, `level`, `menu`, `gpurview`, `flag`, `addtime`, `intro`) VALUES(4, '临时游客', '6868668868', '', 0, 1, '1341387474', '临时游客');
