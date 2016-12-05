-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.9-MariaDB - mariadb.org binary distribution
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4800
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных mvc
CREATE DATABASE IF NOT EXISTS `mvc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mvc`;


-- Дамп структуры для таблица mvc.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы mvc.messages: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT IGNORE INTO `messages` (`id`, `name`, `email`, `message`) VALUES
	(17, 'Andrii', 'andruew@mail.ru', 'dsf sdf sdf sd sd');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


-- Дамп структуры для таблица mvc.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) NOT NULL DEFAULT '0',
  `title` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы mvc.pages: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT IGNORE INTO `pages` (`id`, `alias`, `title`, `content`) VALUES
	(1, 'test', 'Progress bars', '<div class="progress">\r\n  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">\r\n    <span class="sr-only">40% Complete (success)</span>\r\n  </div>\r\n</div>\r\n<div class="progress">\r\n  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">\r\n    <span class="sr-only">20% Complete</span>\r\n  </div>\r\n</div>\r\n<div class="progress">\r\n  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">\r\n    <span class="sr-only">60% Complete (warning)</span>\r\n  </div>\r\n</div>\r\n<div class="progress">\r\n  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">\r\n    <span class="sr-only">80% Complete (danger)</span>\r\n  </div>\r\n</div>'),
	(2, 'bootstrap', 'Some data', '<div class="alert alert-danger" role="alert">\r\n  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>\r\n  <span class="sr-only">Error:</span>\r\n  Enter a valid email address\r\n</div>\r\n<div class="alert alert-danger" role="alert">\r\n  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>\r\n  <span class="sr-only">Error:</span>\r\n  Enter a valid email address\r\n</div><div class="alert alert-danger" role="alert">\r\n  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>\r\n  <span class="sr-only">Error:</span>\r\n  Enter a valid email address\r\n</div><div class="alert alert-danger" role="alert">\r\n  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>\r\n  <span class="sr-only">Error:</span>\r\n  Enter a valid email address\r\n</div><div class="alert alert-danger" role="alert">\r\n  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>\r\n  <span class="sr-only">Error:</span>\r\n  Enter a valid email address\r\n</div><div class="alert alert-danger" role="alert">\r\n  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>\r\n  <span class="sr-only">Error:</span>\r\n  Enter a valid email address\r\n</div>');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;


-- Дамп структуры для таблица mvc.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `image` text,
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Дамп данных таблицы mvc.products: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT IGNORE INTO `products` (`id`, `title`, `description`, `image`, `price`) VALUES
	(1, 'iPhone 1', 'iPhone is extremely thin (only 11.6 millimeters thick) but wider and longer than many comparable devices. The display area is a 3.5-inch wide screen multi-touch interface with unusually high resolution (160 pixels per inch). Unlike most other smartphones, iPhone does not use a hardware keyboard or a stylus. ', 'https://media.carphonewarehouse.com/is/image/cpw2/iphone-6GREY?$xl-standard$', 100),
	(2, 'iPhone 2', 'iPhone is extremely thin (only 11.6 millimeters thick) but wider and longer than many comparable devices. The display area is a 3.5-inch wide screen multi-touch interface with unusually high resolution (160 pixels per inch). Unlike most other smartphones, iPhone does not use a hardware keyboard or a stylus. ', 'https://media.carphonewarehouse.com/is/image/cpw2/iphone-6GREY?$xl-standard$', 200),
	(3, 'iPhone 3', 'iPhone is extremely thin (only 11.6 millimeters thick) but wider and longer than many comparable devices. The display area is a 3.5-inch wide screen multi-touch interface with unusually high resolution (160 pixels per inch). Unlike most other smartphones, iPhone does not use a hardware keyboard or a stylus. ', 'https://media.carphonewarehouse.com/is/image/cpw2/iphone-6GREY?$xl-standard$', 300),
	(4, 'iPhone 4', 'iPhone is extremely thin (only 11.6 millimeters thick) but wider and longer than many comparable devices. The display area is a 3.5-inch wide screen multi-touch interface with unusually high resolution (160 pixels per inch). Unlike most other smartphones, iPhone does not use a hardware keyboard or a stylus. ', 'https://media.carphonewarehouse.com/is/image/cpw2/iphone-6GREY?$xl-standard$', 400),
	(5, 'Nokia', 'Nokia is a global leader in the technologies that connect people and things. Powered by the pioneering work of Nokia Bell Labs, our research and innovation division, and Nokia Technologies, we are at the forefront of creating and licensing the technologies that are increasingly at the heart of our connected lives.', 'http://curiousmindbox.com/wp-content/uploads/2016/04/Nokia-1110.jpg', 50);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
