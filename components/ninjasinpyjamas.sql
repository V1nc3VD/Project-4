-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 02 jul 2020 om 02:04
-- Serverversie: 10.4.10-MariaDB
-- PHP-versie: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ninjasinpyjamas`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

DROP TABLE IF EXISTS `bestelling`;
CREATE TABLE IF NOT EXISTS `bestelling` (
  `BestellingID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `Bestellingdatum` datetime NOT NULL,
  `Totaalprijs` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`BestellingID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling_producten`
--

DROP TABLE IF EXISTS `bestelling_producten`;
CREATE TABLE IF NOT EXISTS `bestelling_producten` (
  `BestellingID` int(11) NOT NULL,
  `BestellingproductID` int(11) NOT NULL AUTO_INCREMENT,
  `PyjamaID` int(11) NOT NULL,
  `Hoeveelheid` int(4) NOT NULL,
  `Producteindprijs` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`BestellingproductID`),
  KEY `BestellingID` (`BestellingID`),
  KEY `PyjamaID` (`PyjamaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pyjamas`
--

DROP TABLE IF EXISTS `pyjamas`;
CREATE TABLE IF NOT EXISTS `pyjamas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(50) NOT NULL,
  `Foto` varchar(100) NOT NULL,
  `Beschrijving` varchar(200) DEFAULT NULL,
  `Prijs` decimal(5,2) DEFAULT NULL,
  `Voorraad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `pyjamas`
--

INSERT INTO `pyjamas` (`id`, `Naam`, `Foto`, `Beschrijving`, `Prijs`, `Voorraad`) VALUES
(1, 'Raccoon', 'raccoon', 'Net als de enige echte RaccoonEggs Yeet!', '24.99', 100),
(2, 'Bunny', 'bunny', 'Dit mooie konijnekostuum is een must have!.', '200.00', 120),
(5, 'Squirtle', 'squirtle', 'Deze Onesie is een echte must have voor pokemon fans', '24.99', 8000),
(6, 'Mascotte!!', 'hauto', 'Onze enige echte Hauto nu te koop voor een prikkie!', '999.99', 12),
(7, 'I love Daddy', 'daddy', 'Deze daddy pyjama is een must have voor alle nette dames (of mannen)', '24.99', 5),
(8, 'Lizard', 'Lizard', 'Deze pyjama is een must have voor alle coole kikkers', '19.99', 1000),
(9, 'Eend', 'Eend', 'Dit is wel een Hele mooie eend die je wil hebben.', '29.99', 120),
(10, 'Draak', 'Draak', 'Een draak, wat wil je nog meer?', '29.99', 120),
(11, 'Poema', 'Poema', 'Ben jij een echte sluiper, koop deze pyjama dan!', '29.99', 120),
(12, 'Pumba', 'Pumba', 'Een mooie pumba pyjama!!', '29.99', 1240),
(13, 'Bananenpyjama', 'Banaan', 'Hou jij van bananen, dand is deze pyjama echt iets voor jou!', '29.99', 1240),
(14, 'Squirtle', 'pokemon', 'Voor een lage prijs kan jij een pokemon zijn!', '29.99', 1240);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(30) NOT NULL,
  `userrole` enum('root','admin','support','customer') NOT NULL DEFAULT 'customer',
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`USER_ID`, `email`, `password`, `name`, `userrole`) VALUES
(5, 'koosvanlosenoord@gmail.com', '$2y$10$SGLCrbpl.pvnC5B.Ia1Oa.bpcG01vd8nNc7MzK0IeGEWWokFutMBW', 'koos', 'customer'),
(6, 'vincevandoorn@gmail.com', '$2y$10$FCXLcnAR9oyqeJWY.7/JeORxZrXMnuLR58uKL98ZUAsfU5UBD1.8.', 'Vince van Doorn', 'customer'),
(7, '', '$2y$10$N8spwPGJnjfXx7IVMNqDfuFORTzUS1OCtOk/0PPuJiYqhm0kv/GMS', '', 'customer');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `bestelling_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`);

--
-- Beperkingen voor tabel `bestelling_producten`
--
ALTER TABLE `bestelling_producten`
  ADD CONSTRAINT `bestelling_producten_ibfk_1` FOREIGN KEY (`BestellingID`) REFERENCES `bestelling` (`BestellingID`),
  ADD CONSTRAINT `bestelling_producten_ibfk_2` FOREIGN KEY (`PyjamaID`) REFERENCES `pyjamas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
