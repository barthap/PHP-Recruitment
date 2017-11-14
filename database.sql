-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Czas wygenerowania: 14 Lis 2017, 18:32
-- Wersja serwera: 5.7.18-16-log
-- Wersja PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `bcp49421_zst`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zst_applications`
--

CREATE TABLE IF NOT EXISTS `zst_applications` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(40) DEFAULT NULL,
  `addr_street` varchar(255) DEFAULT NULL,
  `addr_city` varchar(80) DEFAULT NULL,
  `addr_zip` varchar(50) DEFAULT NULL,
  `addr_province` varchar(50) NOT NULL,
  `addr_region` tinyint(8) DEFAULT NULL,
  `tel` varchar(13) NOT NULL,
  `pesel` varchar(12) DEFAULT NULL,
  `specs` varchar(40) DEFAULT NULL,
  `sel_langs` varchar(40) DEFAULT NULL,
  `secondary_name` varchar(255) NOT NULL,
  `secondary_langs` varchar(140) NOT NULL,
  `user_id` mediumint(9) DEFAULT '-1',
  `edited` tinyint(1) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `note` text,
  `register_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Zrzut danych tabeli `zst_applications`
--

INSERT INTO `zst_applications` (`id`, `first_name`, `last_name`, `birth_date`, `birth_place`, `addr_street`, `addr_city`, `addr_zip`, `addr_province`, `addr_region`, `tel`, `pesel`, `specs`, `sel_langs`, `secondary_name`, `secondary_langs`, `user_id`, `edited`, `accepted`, `note`, `register_date`) VALUES
(1, 'Colt', 'Vargas', '1986-02-09', 'Promo-Control', '778-5157 Rhoncus. Avenue', 'Tredegar', '76899', '', 3, '', '165210026459', '7, 4, 3', 'ru, de', '', '', -1, 0, 0, 'Test', '2017-05-10 11:50:43'),
(3, 'Zephr', 'Morales', '1972-07-10', 'Ketchikan', '1157 Quisque St.', 'Comano', '912413', '', 10, '', '163311195719', '6, 9, 2', 'ru, en', '', '', -1, 0, 0, 'Lorem ipsum dolor sit amet', '2017-05-10 11:50:43'),
(4, 'Cyrus', 'Terry', '1992-04-20', 'Etalle', 'Ap #410-9868 Augue Road', 'Livingston', '1969', '', 14, '', '162103241349', '11, 14, 19', 'de, ru', '', '', -1, 0, 0, NULL, '2017-05-10 11:50:43'),
(5, 'Georgia', 'Downs', '2003-04-08', 'Araban', 'P.O. Box 576, 7483 Mauris Rd.', 'Worksop', '76091', '', 15, '', '163404103979', '20, 6, 18', 'en, de', '', '', -1, 0, 0, 'Test2', '2017-05-10 11:50:43'),
(6, 'Daquan', 'Lowe', '2000-11-07', 'Colwood', '925-9800 Mattis Street', 'Shawinigan', '65122', '', 4, '', '160808270169', '17, 10, 1', 'en, ru', '', '', -1, 0, 1, '', '2017-05-10 11:50:43'),
(7, 'Eustachy', 'Kot', '2017-04-26', 'Łódź', 'ul. Kanclerska 15', 'Poznań', '22-000', 'Powiat, gmina', 13, '606123987', '99887712345', '16, 6, 1', 'de, ru', 'Gimnazjum w Giedlarowej', 'angielski, niemiecki', -1, 0, 1, NULL, '2017-05-10 11:50:43'),
(8, 'Lucius', 'Valentine', '2017-02-01', 'Allerona', '7091 Mi. Street', 'Monticelli d''Ongina', 'BC91 2KD', '', 1, '', '166304127319', '1, 18, 10', 'en, ru', '', '', -1, 0, 0, NULL, '2017-05-10 11:50:43'),
(9, 'Lawrence', 'Graham', '1973-01-17', 'Idaho', '9469 Quam. Road', 'Lehrte', '4679', 'Required field', 4, '', '16870902534', '17, 19, 16', 'en, ru', 'Name and gimba adres', 'none', -1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua1. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-05-10 11:50:43'),
(10, 'August', 'Crosby', '1977-11-19', 'Sachs Harbour', 'Ap #959-6253 Sed Street', 'Torno', '90406', '', 6, '', '167906091609', '19, 6, 21', 'de, ru', '', '', -1, 0, 0, '', '2017-05-10 11:50:43'),
(11, 'First', 'Last', '2017-01-11', 'Place', 'Street', 'City', 'Zip', '', 6, '', '11223312345', '8, 18, 17', 'en, de', '', '', -1, 0, 0, NULL, '2017-05-10 11:50:43'),
(12, 'Jan', 'Nowak', '2000-02-28', 'Warszawa', 'Wiejska 2', 'Warszawa', '00-222 Warszawa', '', 6, '', '11223312345', '0, 3, 4', 'en, de', '', '', -1, 0, 0, 'Katapulta elit', '2017-05-10 11:50:43'),
(15, 'Rafł', 'ZHR', '2000-08-20', 'Łódź', 'Kochanowskiego 1c', 'Rzeszów', '37-301', '', 7, '', '0028200234', '0, 2, 3', 'en, de', '', '', 5, 0, 0, '', '2017-05-12 08:10:00'),
(17, 'Bartłomiej', 'Nawisko', '2017-04-25', 'Warszawa', 'Wrocław, 1142', 'Warszawa', '00-123', '', 8, '', '11223312344', '0, 0, 0', 'en', 'Eustachy Motyka', 'f', -1, 0, 0, NULL, '2017-05-10 11:50:43'),
(21, 'Jacek', 'Nowak', '2017-04-26', 'Łódź', 'ul. Kanclerska 15', 'Poznań', '22-000', 'Powiat, gmina', 8, '606123987', '99887712345', '19, 6, 21', 'en, ru', 'Gimnazjum w Giedlarowej', 'angielski, niemiecki', 7, 0, 1, 'Lorem ipsum', '2017-05-10 11:50:43'),
(22, 'Kolejny', 'Wniosek', '2016-03-08', 'Nie wiem', 'Tak', 'Nie', 'xD', 'Test', 10, '', '19184351234', '7, 15, 17', 'de, ru', 'Nie chodziłem', 'Nie', -1, 0, 0, NULL, '2017-05-10 11:52:09'),
(25, 'Jan', 'Kowalski', '2001-01-13', 'Warszawa', 'ul. Mickiewicza 42', 'Warszawa', '00-123 Warszawa', 'Warszawski', 8, '', '01011307835', '0, 5, 17', 'en, de', 'Gimnazjum miejskie w Bździszewie', 'angielski, rosyjski', 10, 0, 0, NULL, '2017-06-13 13:58:25');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zst_students`
--

CREATE TABLE IF NOT EXISTS `zst_students` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `app_id` int(11) NOT NULL DEFAULT '-1',
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `zst_students`
--

INSERT INTO `zst_students` (`id`, `app_id`, `email`, `password`) VALUES
(4, 14, 'email@email.mail', 'aa5b70d2ccd0b96cf248f7a64b5cf6257ab69cb964b65bf47e861515caa7bedc'),
(5, 15, 'rniemiec@vp.pl', 'd2dae9791ffea4e7a63660895dcf808a83212683094efd3845b0a0e15077d77d'),
(6, 16, 'email@email2', '3fb51a89aa4eb56645ee022f82d8a955a4d6789af598f0512d2bb661776da095'),
(7, 21, 'admin@example.com', '3fb51a89aa4eb56645ee022f82d8a955a4d6789af598f0512d2bb661776da095'),
(10, 25, 'mail@example.com', '017a5e5d5a155c02f52da5a44f15f16b05376f3f3ef096baf5bce48949fdca31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
