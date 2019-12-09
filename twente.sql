-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 dec 2019 om 22:13
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

--
-- Gegevens worden geëxporteerd voor tabel `hardware`
--

INSERT INTO `hardware` (`hardwareID`, `model`, `type`, `brand`) VALUES
(1, 'K280e', 'toetsenbord', 'Logitech'),
(2, 'LGT-M90', 'muis', 'Logitech'),
(3, '24MK400H-B', 'monitor', 'LG'),
(4, 'HP800G1i7', 'desktop', 'HP'),
(5, 'SM-T510NZKDPHN', 'tablet', 'Samsung');

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
  `time` float(3,2) DEFAULT NULL,
  `responsibleID` int(11) DEFAULT NULL,
  `cause` varchar(255) DEFAULT NULL,
  `solution` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp(),
  `type` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `incident`
--

INSERT INTO `incident` (`incidentID`, `statusID`, `description`, `shortDescription`, `impact`, `time`, `responsibleID`, `cause`, `solution`, `feedback`, `date`, `type`) VALUES
(1, 3, 'Mark Barney weet na zijn vakantie zijn wachtwoord niet meer.', 'Wachtwoord vergeten', 1, 0.10, 1, 'Niet van toepassing', 'Wachtwoord gereset naar standaard waarden. Optie Change password at next logon aagezet.', 'Gebruiker gebeld met nieuw tijdelijk wachtwoord.', '2019-12-02 15:32:00', 1),
(2, 2, 'Bestand staat niet meer in de map van het project. Bestand is vorige week dinsdag voor het laatst aangevuld en opgeslagen.', 'Bestand met planning van project is weg.', 2, 1.00, 1, 'Bestand gewist', 'Bestand teruggehaald van restore.', 'Gemeld dat bestand terug staat.', '2019-12-02 15:32:00', 1),
(3, 1, 'E-mailomgeving is niet te benaderen door kantoor en buitendienst medewerkers.', 'E-mail niet beschikbaar', 80, 2.00, 2, 'DNS-configuratie fout Hosting provider', 'Provider gecontact. deze hebben de fout in DNS-server opgelost. Aanpassing duurt 4 uur voordat deze overal doorwerkt.', 'Alle gebruikers een e-mail gestuurd dat het probleem opgelost is.', '2019-12-02 15:32:00', 1),
(4, 4, 'Gebruiker wil een pagina in een Word document landscape afdrukken. Pagina\'s voor en na deze pagina dienen portrait te blijven.', 'Secties in Word', 1, 0.50, 1, 'Secties gebruiken', 'Met gebruiker meegekeken. de werking van secties uitgelegd en samen ingesteld voor het document.', 'Niet van toepassing.', '2019-12-02 15:32:00', 1),
(5, 3, 'Als laptop opstart alleen drie piepjes te horen. Laptop doet verder niets.', 'Piepjes bij aanzetten laptop', 1, 1.50, 1, 'Geheugen vervangen', 'Geheugen blijkt defect. Geheugen vervangen. Geheugen wordt RMA gestuurd.', 'Gebruiker heeft laptop direct meegenomen.', '2019-12-02 15:32:00', 2),
(6, 7, 'Gebruiker wilt zakeljke e-mail op privétablet', 'E-mail op privétablet', 1, 0.25, 1, 'Standaard instellingen', 'Telefonisch samen met de gebruiker tablet ingesteld.', 'Niet van toepassing.', '2019-12-03 15:32:00', 1),
(7, 7, 'Laptop is gevallen. Er zit nu een breuk in scherm.', 'Breuk in laptopscherm', 1, 1.50, 1, 'Tijdelijk andere laptop', 'Data overgezet naar tijdelijke laptop. Deze laptop wordt opgestuurd naar leverancier voor reparatie.', 'Aan gebruiker gemeld dat nieuwe laptop opgehaald kan worden.', '2019-12-03 15:32:00', 2),
(8, 3, 'Ik wil e-mailinstellingen van een extern e-mailadres op mijn tablet instellen. maar ik weet het wachtwoord niet meer. Account met wachtwoord zit nog wel op laptop van de zaak.', 'Wachtwoord omzetten', 1, 1.00, 1, 'Wachtwoord terug gezocht.', 'Met behulp van wachtwoord tool wachtwoord in Outlook zichtbaar gemaakt.', 'Wachtwoord telefonisch aan gebruiker doorgegeven.', '2019-12-03 15:32:00', 1),
(9, 2, 'Alle buitendienstmedewerkers kunnen na de update niet meer inloggen op de urenadministratie.', 'Buitendienstmedewerkers geen toegang tot urenadministratie', 1, 3.00, 1, 'IP-routing niet goed', 'Route naar VPN server toegevoegd aan routing tabel van server.', 'Alle buitendienstmedewerkers gemaild.', '2019-12-04 15:32:00', 1),
(10, 6, 'Gebruiker wil tijdens vakantie afwezigheidsassistent aanzetten.', 'Hoe stel ik de afwezigheidsassistent in?', 1, 0.25, 1, 'Bedrijfsbeleid uitgelegd', 'Uitgelegd aan gebruiker dat deze optie niet aanstaat in het systeem. Bedrijfsbeleid is om collega\'s tijdens de vakantie toegang te geven tot je mailbox zodat deze de mail kunnen bijhouden.', 'Niet van toepassing.', '2019-12-04 15:32:00', 1),
(11, 3, 'Op de harddisk van mijn laptop heb ik per ongeluk een bestand verwijderd. Dit is een rapportage die ik nog niet had opgeslagen op de server. Hier zit drie weken werk in. Het is belangrijk dat deze terug komt.', 'per ongeluk een bestand verwijderd', 1, 3.00, 1, 'Bestand gerecoverd', 'Met tool bestand teruggehaald.', 'Bestand op server gezet en gebruiker gemaild.', '2019-12-04 15:32:00', 1),
(12, 6, 'Pc is traag. Ook nadat door ICT-afdeling een nieuwe image geïnstalleerd is.', 'Pc reageert heel traag ook na herstarten', 1, 2.00, 1, 'BIOS-instellingen goed zetten', 'Na draaien van performace tool bleken BIOS-instellingen geheugen niet goed te staan.', 'Gebruiker laptop terug gegeven.', '2019-12-05 15:32:00', 2),
(13, 3, 'Gebruiker is het wachtwoord van privélaptop vergeten. Graag wachtwoord verwijderen of instellen op ander wachtwoord.', 'Lokaal wachtwoord kwijt', 1, 1.50, 1, 'Wachtwoord teruggezocht', 'Met behulp van tool Windows wachtwoord achterhaald.', 'Wachtwoord telefonisch aan gebruiker doorgegeven.', '2019-12-05 15:32:00', 1),
(14, 6, 'Bij opstarten internetbrowser worden advertenties getoond. Bij wegklikken komen er steeds meer advertenties.', 'Vreemde pagina\'s op internet', 1, 1.00, 1, 'Malware verwijderd', 'Malware van laptop verwijderd.', 'Gebruiker gemeld en komt laptop weer ophalen.', '2019-12-05 15:32:00', 1),
(15, 7, 'Ik heb het idee dat iemand op afstand probeert in te loggen op mijn laptop. Is het mogelijk om hier iets van te achterhalen?', 'Iemand probeert in te loggen op laptop', 1, 0.50, 1, 'Logfiles bekeken', 'Remote log\'s bekeken en er probeert inderdaad iemand via remote desktop in te loggen. Remote desktop op laptop is nu uitgezet.', 'Telefonisch aan gebruiker doorgegeven.', '2019-12-06 15:32:00', 2),
(16, 1, 'Buitendienstmedewerkers hebben geen toegang meer tot het netwerk.', 'Geen VPN-toegang', 40, 4.00, 1, 'Interface in router defect', 'WAN-interface van router die werkt als VPN-server defect. Reservekaart geplaatst. opnieuw geconfigureerd en getest.', 'Alle buitendienstmedewerkers gemaild.', '2019-12-06 15:32:00', 1),
(17, 3, 'Er is een nieuwe medewerkster aangenomen voor projectplanning. Haar naam is Fee Willemse. Ze begint volgende week maandag. Graag account aanmaken met dezelfde rechten als die van haar collega Sigrid van der Wiel.', 'Nieuwe medewerker op projectplanning', 1, 0.25, 3, 'Niet van toepassing', 'Gebruiker is aangemaakt.', 'Mail met login gegevens verzonden aan hoofd van afdeling.', '2019-12-02 15:32:00', 1),
(18, 3, 'Detail informatie: Na een half uur werken met de pc wordt het scherm zwart en slaat de pc uit. Na 5 minuten kan de pc weer gebruikt worden. maar werkt dan nog ongeveer een kwartier voordat hij weer uitvalt.', 'PC loopt soms vast', 1, 3.00, 3, 'CPU-koeling zal vol met stof.', 'Pc schoongemaakt en getest. Probleem lijkt verholpen.', 'Pc terug geplaatst en aan gebruiker gemeld.', '2019-12-02 15:32:00', 2),
(19, 2, 'Alle pc\'s van het secretariaat geven aan dat ze niet verbonden zijn met een netwerk.', 'Secretariaat zonder netwerk', 6, 2.00, 3, 'Switch defect', 'Switch was defect. Deze is vervangen. Nieuwe switch is voorzien van de juiste configuratie-instellingen.', 'Bij afdeling langs gelopen om te vertellen dat het probleem verholpen is.', '2019-12-02 15:32:00', 2),
(20, 3, 'Sarisa de Hoogt weet na vakantie haar wachtwoord niet meer.', 'Wachtwoord vergeten', 1, 0.10, 3, 'Niet van toepassing', 'Wachtwoord gereset naar standaard waarden. Optie Change password at next logon aagezet.', 'Gebruiker gebeld met nieuw tijdelijk wachtwoord.', '2019-12-02 15:32:00', 1),
(21, 3, 'Bij het opstarten van de pc verschijnt de melding \"Boot failure. Reboot en Select proper Boot device or Insert Boot Media in selected Boot device\".', 'PC start niet meer op', 1, 1.50, 3, 'Defecte harddisk', 'Hardisk vervangen en standaard image terug gezet.', 'Persoonlijk aan gebuiker doorgegeven dat pc weer werkt.', '2019-12-03 15:32:00', 2),
(22, 6, 'Printer geeft melding \"Engine Error please contact administrator\". Gebruikers printen nu op printer van financiële administratie.', 'Papier zit vast in printer', 15, 0.25, 4, 'Tandwiel defect', 'Bij leverancier aangemeld; wordt binnen 4 werkdagen vervangen.', 'Gebruikers gemaild dat de printer binnen 4 werkdagen gerepareerd wordt door de leverancier.', '2019-12-03 15:32:00', 2),
(23, 6, 'Op alle kantoorwerkplekken verschijnt dagelijks meerdere malen de melding dat JAVA geupdate moet worden.', 'Java update melding', 40, 2.00, 3, 'Oude versie van JAVA was geïnstalleerd', 'Via AD nieuwe versie van JAVA uitgerold.', 'Niet direct teruggemeld aan gebruikers.', '2019-12-03 15:32:00', 1),
(24, 6, 'Het benaderen van data vanaf de servers en vanaf het internet is traag. Het gaat wel. maar heel langzaam.', 'Netwerk is traag bij financiele administratie', 4, 3.00, 3, 'Configuratiefout in switch', 'Alle poorten op 1000 mbps full duplex gezet.', 'Oplossing aan afdelingshoofd gemeld.', '2019-12-03 15:32:00', 2),
(25, 2, 'Er kunnen geen bestanden meer opgeslagen worden op de CAD-server. Het openen van bestanden gaat nog wel.', 'Geen oplag capaciteit meer op CAD-server', 6, 3.00, 3, 'Geen capaciteit meer op virtuele disken', 'Virtuele disken en partities vergroot.', 'Gemeld aan CAD-tekenaars dat er weer capaciteit is.', '2019-12-04 15:32:00', 1),
(26, 7, 'Evert de Vrind. een medewerker van de CAD-afdeling. is op staande voet ontslagen. Zijn account moet per direct afgelosten worden.', 'Ontslagen medewerker CAD-afdeling', 1, 0.25, 3, 'Account disabelen', 'Account gedisabeld.', 'Aan HRM doorgegeven dat account uitstaat.', '2019-12-04 15:32:00', 1),
(27, 7, 'Werkplek van secretariaat moet omgezet worden naar de afdeling HRM.', 'Verhuizen werkplek', 1, 2.00, 3, 'Niet van toepassing', 'Desktop verhuisd. nieuwe patch gemaakt en oude verwijderd. Patch documentatie is bijgewerkt.', 'Gebruiker ging direct op nieuwe plaats aan het werk.', '2019-12-04 15:32:00', 2),
(28, 5, 'Gebruiker wilt PDF maken met spreadsheet. In die voettekst moet datum en versie vermeld worden.', 'Voettekst op spreadsheet PDF', 1, 1.00, 3, 'Voetteksten in Excel', 'Gebruiker uitgelegd hoe voetteksten in Excel werken. En verteld van de werking van CutePDF. Enkele malen het hele proces gezamenlijk doorlopen. Gebruiker vindt dit lastig.', 'Niet van toepassing', '2019-12-05 15:32:00', 1),
(29, 1, 'Netwerk lijkt in zijn geheel niet meer te werken. ', 'Netwerk plat. ', 80, 2.50, 3, 'Patchfout', 'Patchfout heeft netwerkloop veroorzaakt.', 'Gemeld aan secretariaat. Die verzorgen communicatie naar rest van het bedrijf.', '2019-12-05 15:32:00', 1),
(30, 2, 'In verband met defecte printer wilt gebruiker dat prints automatisch uit de printer van HRM komen.', 'Standaard printer', 1, 0.25, 3, 'Andere standaard printer', 'Remote HRM printer ingesteld als standaard.', 'Niet van toepassing', '2019-12-05 15:32:00', 2),
(31, 3, 'Gebruiker kan niet inloggen op administratiepakket.', 'Administratie pakket niet toegangelijk', 1, 0.25, 3, 'Gebruiker aanmaken in administratiepakket', 'Gebuiker aangemaakt in administratiepakket. Gebruiker had nog geen account.', 'Aan hoofd van de afdeling gemeld dat de gebruiker kan inloggen.', '2019-12-06 15:32:00', 1),
(32, 6, 'Bij opstarten internetbrowser worden advertenties getoond. Bij weg klikken komen er steeds meer advertenties.', 'Vreemde pagina\'s op internet', 1, 1.00, 3, 'Malware verwijderd.', 'Malware van laptop verwijderd.', 'Gebruiker gemeld en komt laptop weer ophalen.', '2019-12-06 15:32:00', 1),
(33, 3, 'Is het wachtwoord van privélaptop vergeten. Graag wachtwoord verwijderen of instellen op ander wachtwoord.', 'Lokaal wachtwoord kwijt', 1, 1.50, 3, 'Wachtwoord terug gezocht.', 'Met behulp van tool Windows wachtwoord achterhaald.', 'Wachtwoord telefonisch aan gebruiker doorgegeven.', '2019-12-06 15:32:00', 1);

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
  `statusName` varchar(255) DEFAULT NULL,
  `statusImpact` varchar(3) DEFAULT NULL,
  `urgency` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `status`
--

INSERT INTO `status` (`statusID`, `statusName`, `statusImpact`, `urgency`) VALUES
(1, 'Niemand kan nog werken', '>10', '1'),
(2, 'Kunnen niet werken. orders worden gemist en/of afspraken worden niet gehaald', '<10', '1'),
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
-- Gegevens worden geëxporteerd voor tabel `user2incident`
--

INSERT INTO `user2incident` (`ID`, `userID`, `incidentID`) VALUES
(9, 1, 9),
(24, 3, 24),
(11, 4, 11),
(25, 5, 25),
(27, 6, 27),
(1, 7, 1),
(5, 8, 5),
(8, 9, 8),
(12, 10, 12),
(19, 13, 19),
(21, 14, 21),
(29, 15, 29),
(33, 16, 33),
(3, 19, 3),
(20, 20, 20),
(26, 21, 26),
(4, 23, 4),
(17, 24, 17),
(13, 25, 13),
(22, 27, 22),
(28, 28, 28),
(14, 33, 14),
(16, 34, 16),
(23, 36, 23),
(31, 37, 31),
(32, 38, 32),
(2, 40, 2),
(7, 41, 7),
(10, 42, 10),
(18, 43, 18),
(15, 44, 15),
(30, 45, 30),
(6, 47, 6);

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
  MODIFY `hardwareID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `incident`
--
ALTER TABLE `incident`
  MODIFY `incidentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
