-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 04 dec 2019 om 16:43
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twente`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `config2hardware`
--

CREATE TABLE `config2hardware` (
  `ID` int(11) NOT NULL,
  `hardwareID` int(11) DEFAULT NULL,
  `configurationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `config2incident`
--

CREATE TABLE `config2incident` (
  `ID` int(11) NOT NULL,
  `incidentID` int(11) DEFAULT NULL,
  `configurationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `configuration`
--

CREATE TABLE `configuration` (
  `configurationID` int(11) NOT NULL,
  `configuration` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `departments`
--

CREATE TABLE `departments` (
  `departmentID` int(11) NOT NULL,
  `departmentName` varchar(50) DEFAULT NULL,
  `location` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `departments`
--

INSERT INTO `departments` (`departmentID`, `departmentName`, `location`) VALUES
(2, 'CAD', 1),
(3, 'Directie', 1),
(4, 'Engeneering', 1),
(5, 'Financiele Administratie', 1),
(6, 'HRM', 1),
(7, 'ICT', 1),
(8, 'Onderzoek', 2),
(9, 'Planning', 1),
(10, 'Project planning', 1),
(11, 'Rapportage', 1),
(12, 'Secretariaat', 1),
(13, 'Verkoop en Marketing', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `hardware`
--

CREATE TABLE `hardware` (
  `hardwareID` int(11) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `incident`
--

CREATE TABLE `incident` (
  `incidentID` int(11) NOT NULL,
  `statusID` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `shortDescription` varchar(255) DEFAULT NULL,
  `impact` int(3) DEFAULT NULL,
  `time` int(3) DEFAULT NULL,
  `responsibleID` int(11) DEFAULT NULL,
  `cause` varchar(255) DEFAULT NULL,
  `solution` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `type` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `responsible`
--

CREATE TABLE `responsible` (
  `responsibleID` int(11) NOT NULL,
  `responsibleName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `responsible`
--

INSERT INTO `responsible` (`responsibleID`, `responsibleName`) VALUES
(1, 'MaTW - ICT Afdeling'),
(2, 'Hosting Provider'),
(3, 'MaLoZ - ICT Afdeling'),
(4, 'Leverancier printer');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE `status` (
  `statusID` int(11) NOT NULL,
  `statusName` varchar(50) DEFAULT NULL,
  `statusImpact` varchar(3) DEFAULT NULL,
  `urgency` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `status`
--

INSERT INTO `status` (`statusID`, `statusName`, `statusImpact`, `urgency`) VALUES
(1, 'Niemand kan nog werken', '>10', '1'),
(2, 'Kunnen niet werken. orders worden gemist en/of afs', '<10', '1'),
(3, 'kan niet werken', '1', '2'),
(4, 'kunnen niet werken met 1 programma', '>1', '2'),
(5, 'kan niet werken met 1 programma', '1', '3'),
(6, 'er is een workaround aanwezig', '>0', '3'),
(7, 'niet reproduceerbare fout', '>0', '4'),
(8, 'incident afgehandeld', '>0', '5');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `initials` varchar(1) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `departmentID` int(11) DEFAULT NULL,
  `interncell` varchar(3) DEFAULT NULL,
  `sex` int(3) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `userType` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`userID`, `initials`, `surname`, `middleName`, `departmentID`, `interncell`, `sex`, `email`, `password`, `userType`) VALUES
(1, 'V', 'Campbell', '', 2, '254', 1, 'vcampbell@cad.matwente.com', '', 1),
(2, 'S', 'Geerman', '', 2, '253', 1, 'sgeerman@cad.matwente.com', '', 1),
(3, 'S', 'Nahuys', ' Van', 2, '252', 2, 'snahuys@cad.matwente.com', '', 1),
(4, 'F', 'Çiçek', '', 3, '235', 2, 'fçiçek@directie.matwente.com', '', 3),
(5, 'O', 'Neville', '', 3, '236', 1, 'oneville@directie.matwente.com', '', 3),
(6, 'M', 'Oldeneel tot Oldenzeel', ' Van', 3, '234', 2, 'moldeneeltotoldenzeel@directie.matwente.com', '', 3),
(7, 'M', ' Barney', '', 4, '250', 1, 'mbarney@engeneering.matwente.com', '', 1),
(8, 'K', 'Ali', '', 4, '244', 2, 'kali@engeneering.matwente.com', '', 1),
(9, 'Z', 'Bozkurt', '', 4, '239', 1, 'zbozkurt@engeneering.matwente.com', '', 1),
(10, 'A', 'Conley', '', 4, '245', 2, 'aconley@engeneering.matwente.com', '', 1),
(11, 'H', 'Grotenhuis van Onstein', ' Van', 4, '241', 2, 'hgrotenhuisvanonstein@engeneering.matwente.com', '', 1),
(12, 'C', 'Hall', '', 4, '240', 1, 'chall@engeneering.matwente.com', '', 1),
(13, 'M', 'Hugenpoth', ' Van', 4, '242', 2, 'mhugenpoth@engeneering.matwente.com', '', 1),
(14, 'P', 'Koning', '', 4, '237', 1, 'pkoning@engeneering.matwente.com', '', 1),
(15, 'B', 'Rochussen', '', 4, '247', 1, 'brochussen@engeneering.matwente.com', '', 1),
(16, 'K', 'Schwartzenberg en Hohenlansberg', ' Thoe', 4, '246', 2, 'kschwartzenbergenhohenlansberg@engeneering.matwente.com', '', 1),
(17, 'J', 'Wilder', '', 4, '249', 2, 'jwilder@engeneering.matwente.com', '', 1),
(18, 'E', 'Yalçin', '', 4, '248', 2, 'eyalçin@engeneering.matwente.com', '', 1),
(19, 'J', 'Matse', '', 5, '290', 1, 'jmatse@financieleadministratie.matwente.com', '', 1),
(20, 'N', 'Kinschot', ' Van', 5, '290', 2, 'nkinschot@financieleadministratie.matwente.com', '', 1),
(21, 'K', 'Nguyen', '', 5, '290', 2, 'knguyen@financieleadministratie.matwente.com', '', 1),
(22, 'A', 'Girard de Mielet van Coehoorn', ' De', 6, '276', 1, 'agirarddemieletvancoehoorn@hrm.matwente.com', '', 1),
(23, 'H', 'Aktas', '', 7, '278', 2, 'haktas@ict.matwente.com', '', 2),
(24, 'S', 'Harrison', '', 7, '279', 1, 'sharrison@ict.matwente.com', '', 2),
(25, 'V', 'Delen', ' Van', 8, '263', 2, 'vdelen@onderzoek.matwente.com', '', 1),
(26, 'T', 'Gülcher', '', 8, '264', 1, 'tgülcher@onderzoek.matwente.com', '', 1),
(27, 'L', 'Leyden', ' Van', 8, '282', 2, 'lleyden@onderzoek.matwente.com', '', 1),
(28, 'A', 'Posson', ' De', 8, '261', 1, 'aposson@onderzoek.matwente.com', '', 1),
(29, 'M', 'Tahiri', '', 8, '265', 2, 'mtahiri@onderzoek.matwente.com', '', 1),
(30, 'J', 'Thompson', '', 8, '266', 1, 'jthompson@onderzoek.matwente.com', '', 1),
(31, 'L', 'Vos van Steenwijk', ' De', 8, '281', 1, 'lvosvansteenwijk@onderzoek.matwente.com', '', 1),
(32, 'E', 'Westreenen van Tiellandt', ' Van', 8, '280', 1, 'ewestreenenvantiellandt@onderzoek.matwente.com', '', 1),
(33, 'F', 'Erp', ' Van', 9, '260', 1, 'ferp@planning.matwente.com', '', 1),
(34, 'J', 'Flugi van Aspermont', '', 9, '262', 2, 'jflugivanaspermont@planning.matwente.com', '', 1),
(35, 'V', 'Harrison', '', 10, '259', 1, 'vharrison@projectplanning.matwente.com', '', 1),
(36, 'K', 'Malik', '', 10, '258', 2, 'kmalik@projectplanning.matwente.com', '', 1),
(37, 'L', 'Sasse van Ysselt', ' Van', 10, '257', 1, 'lsassevanysselt@projectplanning.matwente.com', '', 1),
(38, 'M', 'Schinne', ' Van', 10, '251', 2, 'mschinne@projectplanning.matwente.com', '', 1),
(39, 'T', 'Wolters', '', 10, '256', 2, 'twolters@projectplanning.matwente.com', '', 1),
(40, 'R', 'Jansz.', '', 11, '277', 1, 'rjansz.@rapportage.matwente.com', '', 1),
(41, 'D', 'Bergh', ' Van Benthem van den', 11, '268', 2, 'dbergh@rapportage.matwente.com', '', 1),
(42, 'O', 'Chamberlain', '', 11, '275', 1, 'ochamberlain@rapportage.matwente.com', '', 1),
(43, 'L', 'Hesselt van Dinter', '', 11, '267', 1, 'lhesseltvandinter@rapportage.matwente.com', '', 1),
(44, 'D', 'Festetics de Tolna', '', 12, '243', 2, 'dfesteticsdetolna@secretariaat.matwente.com', '', 1),
(45, 'S', 'Sandberg', '', 12, '238', 2, 'ssandberg@secretariaat.matwente.com', '', 1),
(46, 'B', 'Wydenbruck', ' Von', 12, '255', 2, 'bwydenbruck@secretariaat.matwente.com', '', 1),
(47, 'E', 'Aslan', '', 13, '270', 1, 'easlan@verkoopenmarketing.matwente.com', '', 1),
(48, 'F', 'Suasso', ' Lopes', 13, '270', 2, 'fsuasso@verkoopenmarketing.matwente.com', '', 1),
(49, 'J', 'Thompson', '', 13, '270', 2, 'jthompson@verkoopenmarketing.matwente.com', '', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user2configuration`
--

CREATE TABLE `user2configuration` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `configurationID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user2incident`
--

CREATE TABLE `user2incident` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `incidentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `config2hardware`
--
ALTER TABLE `config2hardware`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK` (`hardwareID`,`configurationID`);

--
-- Indexen voor tabel `config2incident`
--
ALTER TABLE `config2incident`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK` (`incidentID`,`configurationID`);

--
-- Indexen voor tabel `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`configurationID`);

--
-- Indexen voor tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexen voor tabel `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`hardwareID`);

--
-- Indexen voor tabel `incident`
--
ALTER TABLE `incident`
  ADD PRIMARY KEY (`incidentID`),
  ADD KEY `FK` (`statusID`,`responsibleID`);

--
-- Indexen voor tabel `responsible`
--
ALTER TABLE `responsible`
  ADD PRIMARY KEY (`responsibleID`);

--
-- Indexen voor tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `FK` (`departmentID`);

--
-- Indexen voor tabel `user2configuration`
--
ALTER TABLE `user2configuration`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK` (`userID`,`configurationID`);

--
-- Indexen voor tabel `user2incident`
--
ALTER TABLE `user2incident`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK` (`userID`,`incidentID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `config2hardware`
--
ALTER TABLE `config2hardware`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `config2incident`
--
ALTER TABLE `config2incident`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `configuration`
--
ALTER TABLE `configuration`
  MODIFY `configurationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `hardware`
--
ALTER TABLE `hardware`
  MODIFY `hardwareID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `incident`
--
ALTER TABLE `incident`
  MODIFY `incidentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `responsible`
--
ALTER TABLE `responsible`
  MODIFY `responsibleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT voor een tabel `user2configuration`
--
ALTER TABLE `user2configuration`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `user2incident`
--
ALTER TABLE `user2incident`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
