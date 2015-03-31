-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2015 at 09:44 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_gb`
--
CREATE DATABASE IF NOT EXISTS `db_gb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_gb`;

-- --------------------------------------------------------

--
-- Table structure for table `sys_control`
--

CREATE TABLE IF NOT EXISTS `sys_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `url` varchar(100) NOT NULL DEFAULT '',
  `position` int(4) NOT NULL DEFAULT '0',
  `help` longtext NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `sys_control`
--

INSERT INTO `sys_control` (`id`, `pid`, `name`, `url`, `position`, `help`, `active`, `deleted`) VALUES
(1, 0, 'Главная', 'homepage', 1, '', 1, 0),
(2, 0, 'Гостевая', 'guest', 2, '', 1, 0),
(3, 0, 'Вход', 'enter', 3, '', 0, 1),
(23, 0, 'Профиль', 'profile', 100, '', 1, 0),
(37, 0, 'Выход', 'exit', 0, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_glob_storage`
--

CREATE TABLE IF NOT EXISTS `tbl_glob_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIK` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=202 ;

--
-- Dumping data for table `tbl_glob_storage`
--

INSERT INTO `tbl_glob_storage` (`id`, `name`, `value`) VALUES
(196, 'project_name', 'Гостевая книга'),
(197, 'login_enter', 'Вход'),
(198, 'login_exit', 'Выход'),
(199, 'global_slogan', 'Добро пожаловать в нашу гостевую книгу, вы можете оставить пожелание, отзыв и все что бы хотели сказать о нашем сервисе.'),
(200, 'global_title_main', 'WEB TRANING'),
(201, 'global_title_second', 'КОМПЛЕКСНАЯ СИСТЕМА ОБУЧЕНИЯ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_glob_templates`
--

CREATE TABLE IF NOT EXISTS `tbl_glob_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `templ` text NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `name_2` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_glob_templates`
--

INSERT INTO `tbl_glob_templates` (`id`, `name`, `templ`, `deleted`) VALUES
(1, 'gb_main', '<div id="gb_gontainer">\n<div id="gb_addform" class=""></div>\n <div id="gb_list">\n  <div id="gb_pagination"></div>\n  <div id="gb_messages"> </div>\n </div>\n</div>', 0),
(2, 'gb_feedback_form', '\n<div id="gb_alert"></div>\n	  <form action="" method="post" id="add_form">\n		  <div class="fieldset"><fieldset>\n              <input type="text" class="form-control" id="name" placeholder="Имя" aria-describedby="basic-addon1">\n          </fieldset></div>\n          <div class="fieldset"><fieldset>\n              <input type="text" class="form-control" id="email" placeholder="Эл Почта" aria-describedby="basic-addon1">\n          </fieldset></div>\n          <div class="fieldset"><fieldset>\n              <textarea class="form-control" id="message" placeholder="Сообщение"></textarea>\n          </fieldset></div>\n          <div class="fieldset"><fieldset>\n              <div class="btn-group">\n                <button id="gb_add_button" type="button" class="btn btn-primary">Отправить</button>\n                <button id="gb_reset_button"type="button" class="btn">Востановить</button>\n              </div>\n          </fieldset></div>\n      </form>\n', 0),
(3, 'login_form', '<center>                \r\n<div class="span8">\r\n    <form name="login" action="" method="post">\r\n        <div class="row-fluid">\r\n            <div class="span2"><img src="assets/images/login_icon_smal2.gif" width="80" height="72"></div>\r\n            <div class="span8">\r\n                <div class="row-fluid">\r\n                    <div class="span8">\r\n                        <div class="row-fluid">\r\n                            <div class="span8"><input type="text" name="sLogin" align="middle" value="" placeholder="#login_please#"/></div>\r\n                        </div>\r\n                        <div class="row-fluid">\r\n                            <div class="span8"><input type="password" name="sPassword" align="middle" placeholder="#login_password#" /></div>\r\n                        </div>\r\n                        <div class="row-fluid">\r\n                            <div class="span8">\r\n                                <span class="center">\r\n                                    <input class="btn" name="go" value="#login_enter#" type="submit" ><input type="hidden" name="formTokenKey" value="#formTokenKey#">\r\n                                </span>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>    \r\n            </div>\r\n        </div>\r\n   </form>\r\n</div>\r\n</center>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `moderated` tinyint(4) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `pid`, `name`, `email`, `message`, `date`, `moderated`, `deleted`) VALUES
(1, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:33:10', 1, 0),
(2, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(3, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(4, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(5, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(6, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(7, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(8, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(9, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(10, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(11, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0),
(12, 0, 'Dilshod', 'prodilshod@gmail.com', 'Я надеюсь, мая работа вам понравится, так как использовано практически нативный код.', '2015-03-31 10:40:57', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
