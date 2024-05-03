-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 03, 2024 alle 13:03
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servizio_noleggio_biciclette`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`ID`, `email`, `password`, `nome`, `cognome`) VALUES
(1, 'giuseppe.vincenti@vincentibike.com', ' 853cc6921c77b88', 'Giuseppe', 'Vincenti');

-- --------------------------------------------------------

--
-- Struttura della tabella `bici`
--

CREATE TABLE `bici` (
  `ID` int(11) NOT NULL,
  `inMovimento` tinyint(1) NOT NULL,
  `distanzaPercorsa` int(11) NOT NULL,
  `rfd` varchar(16) NOT NULL,
  `gps` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `bici`
--

INSERT INTO `bici` (`ID`, `inMovimento`, `distanzaPercorsa`, `rfd`, `gps`) VALUES
(5, 0, 281, '1902817263718262', '9191817281957463'),
(6, 0, 316, '9109261758493718', '1829103425183927'),
(7, 1, 818, '1839129103726181', '1816115882168111');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `cartaCredito` varchar(16) NOT NULL,
  `IDIndirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`ID`, `email`, `password`, `nome`, `cognome`, `cartaCredito`, `IDIndirizzo`) VALUES
(8, 'casalis_marco@tin.it', ' f414f4024495ae3ecdf4d9ede02b2ea', 'marco', 'casalis', '1192830192261524', 3),
(9, 'carna.satoshi@crypto.com', 'a482082a5a478c8ec64c23ca0fbfa1d0', 'Giuseppe', 'Carnabuci', '9182093728174563', 2),
(10, 'luca.bertiato@ismonnet.com', '83e4a96aed96436c621b9809e258b309', 'Luca', 'Bertiato', '2836170292837456', 3),
(11, 'riccardo.mognoni@ismonnet.com', '15b11cc44d2288cbbad6dca68c3c7e45', 'Riccado', 'Mognoni', '1223872909876142', 4),
(12, 'dennis.gallina@ismonnet.com', 'c02b7d24a066adb747fdeb12deb21bfa', 'Dennis', 'Gallina', '8291802937615294', 2),
(13, 'test', '098f6bcd4621d373cade4e832627b4f6', 'test', 'test', '0000000000000000', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `ID` int(11) NOT NULL,
  `via` varchar(64) NOT NULL,
  `cap` int(5) NOT NULL,
  `citta` varchar(32) NOT NULL,
  `provincia` varchar(32) NOT NULL,
  `regione` varchar(32) NOT NULL,
  `stato` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`ID`, `via`, `cap`, `citta`, `provincia`, `regione`, `stato`) VALUES
(1, 'via leoncavallo 13', 20833, 'Giussano', 'Monza e Brianza', 'Lombardia', 'Italia'),
(2, 'via cavour 3', 12653, 'Brescia', 'Brescia', 'Lombardia', 'Italia'),
(3, 'via tempera 81', 12653, 'Brescia', 'Brescia', 'Lombardia', 'Italia'),
(4, 'via testa 21', 21767, 'Senago', 'Monza e Brianza', 'Lombardia', 'Italia');

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `ID` int(11) NOT NULL,
  `tipoOperazione` enum('noleggio','consegna','','') NOT NULL,
  `oraInizio` datetime NOT NULL,
  `prezzo` float NOT NULL,
  `distanzaPercorsa` float NOT NULL,
  `IDCliente` int(11) NOT NULL,
  `IDBici` int(11) NOT NULL,
  `IDStazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `operazione`
--

INSERT INTO `operazione` (`ID`, `tipoOperazione`, `oraInizio`, `prezzo`, `distanzaPercorsa`, `IDCliente`, `IDBici`, `IDStazione`) VALUES
(3, 'noleggio', '2024-05-01 13:00:00', 12.2, 23.1, 9, 5, 2),
(4, 'consegna', '2024-05-01 14:02:56', 0, 0, 9, 5, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `ID` int(11) NOT NULL,
  `numeroSlot` int(11) NOT NULL,
  `IDIndirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`ID`, `numeroSlot`, `IDIndirizzo`) VALUES
(1, 12, 2),
(2, 12, 1),
(3, 12, 3),
(4, 12, 4);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `bici`
--
ALTER TABLE `bici`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDIndirizzo` (`IDIndirizzo`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDCliente` (`IDCliente`,`IDBici`),
  ADD KEY `IDAdmin` (`IDBici`),
  ADD KEY `IDStazione` (`IDStazione`);

--
-- Indici per le tabelle `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDIndirizzo` (`IDIndirizzo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `bici`
--
ALTER TABLE `bici`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`IDIndirizzo`) REFERENCES `indirizzo` (`ID`);

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`IDCliente`) REFERENCES `cliente` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`IDBici`) REFERENCES `bici` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_3` FOREIGN KEY (`IDStazione`) REFERENCES `stazione` (`ID`);

--
-- Limiti per la tabella `stazione`
--
ALTER TABLE `stazione`
  ADD CONSTRAINT `stazione_ibfk_1` FOREIGN KEY (`IDIndirizzo`) REFERENCES `indirizzo` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
