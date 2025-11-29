-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Creato il: Nov 29, 2025 alle 12:09
-- Versione del server: 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Versione PHP: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Fabbrica`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Dipendenti`
--

CREATE TABLE `Dipendenti` (
  `Matricola` int(11) NOT NULL,
  `CF` char(16) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Cognome` varchar(50) NOT NULL,
  `Indirizzo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Dipendenti`
--

INSERT INTO `Dipendenti` (`Matricola`, `CF`, `Nome`, `Cognome`, `Indirizzo`) VALUES
(101, 'RSSMRA85C10H501X', 'Mario', 'Rossi', 'Via Roma 10, Milano'),
(102, 'VRDLGI90A45F205Q', 'Luigi', 'Verdi', 'Via Manzoni 21, Torino'),
(103, 'BNCFNC95D12L219Y', 'Francesca', 'Bianchi', 'Corso Italia 33, Firenze'),
(104, 'NGRPLA80B22H501L', 'Paola', 'Neri', 'Via Dante 12, Bologna'),
(105, 'MRLPLA92E30H703F', 'Luca', 'Morelli', 'Via Venezia 5, Genova'),
(106, 'CNTGFR88H14A662B', 'Gianfranco', 'Conti', 'Viale Verdi 18, Verona'),
(107, 'BRTSRA99F17F205E', 'Sara', 'Berti', 'Via Garibaldi 42, Roma'),
(108, 'LMNBNC84L11C351N', 'Nicola', 'Lombardi', 'Via Po 7, Torino'),
(109, 'RMNDNL91M08M082D', 'Daniela', 'Romano', 'Piazza Duomo 9, Milano'),
(110, 'FRTPLA86C15H501J', 'Paolo', 'Ferretti', 'Via Mazzini 25, Firenze');

-- --------------------------------------------------------

--
-- Struttura della tabella `Magazzini`
--

CREATE TABLE `Magazzini` (
  `Codice` int(11) NOT NULL,
  `Capienza` int(11) NOT NULL,
  `Indirizzo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Magazzini`
--

INSERT INTO `Magazzini` (`Codice`, `Capienza`, `Indirizzo`) VALUES
(1, 5000, 'Via dell’Industria 12, Milano'),
(2, 3000, 'Viale Europa 8, Torino'),
(3, 4500, 'Via del Progresso 45, Bologna'),
(4, 6000, 'Corso Vittorio Emanuele 99, Roma'),
(5, 4000, 'Via Lavoro 22, Firenze'),
(6, 5500, 'Via Cavour 10, Napoli'),
(7, 4800, 'Via Galileo Galilei 8, Verona'),
(8, 7000, 'Strada Statale 5, Genova'),
(9, 3500, 'Viale delle Scienze 13, Palermo'),
(10, 6200, 'Via Marconi 2, Padova');

-- --------------------------------------------------------

--
-- Struttura della tabella `MateriePrime`
--

CREATE TABLE `MateriePrime` (
  `Tipologia` int(11) NOT NULL,
  `CostoUnitario` decimal(10,2) NOT NULL,
  `PesoUnitario` decimal(10,2) NOT NULL,
  `Codice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `MateriePrime`
--

INSERT INTO `MateriePrime` (`Tipologia`, `CostoUnitario`, `PesoUnitario`, `Codice`) VALUES
(10, 5.50, 1.25, 1),
(11, 3.20, 0.80, 2),
(12, 8.75, 2.10, 3),
(13, 1.90, 0.50, 4),
(14, 12.30, 3.00, 5),
(15, 0.95, 0.20, 6),
(16, 4.60, 1.00, 7),
(17, 6.80, 1.50, 8),
(18, 2.75, 0.70, 9),
(19, 9.50, 2.25, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `Prodotti`
--

CREATE TABLE `Prodotti` (
  `Id` int(11) NOT NULL,
  `Codice` int(11) DEFAULT NULL,
  `Matricola` int(11) DEFAULT NULL,
  `Descrizione` varchar(200) DEFAULT NULL,
  `Nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Prodotti`
--

INSERT INTO `Prodotti` (`Id`, `Codice`, `Matricola`, `Descrizione`, `Nome`) VALUES
(1001, 1, 101, 'Componente meccanico in acciaio e rame', 'Puleggia'),
(1002, 2, 102, 'Corpo plastico per dispositivi elettronici', 'Involucro'),
(1003, 3, 103, 'Cavo elettrico con guaina isolante', 'Cavo Rame 2m'),
(1004, 4, 104, 'Piastra in alluminio anodizzato', 'Piastra A1'),
(1005, 5, 105, 'Vite in acciaio zincato M8', 'Vite M8'),
(1006, 6, 106, 'Circuito stampato doppia faccia', 'PCB Doppia Faccia'),
(1007, 7, 107, 'Custodia in plastica rigida per sensori', 'Box Sensor'),
(1008, 8, 108, 'Tubo flessibile in gomma rinforzata', 'Tubo Flessibile'),
(1009, 9, 109, 'Motore elettrico trifase 220V', 'Motore T220'),
(1010, 10, 110, 'Lampada LED industriale 24V', 'LED24');

-- --------------------------------------------------------

--
-- Struttura della tabella `Ricette`
--

CREATE TABLE `Ricette` (
  `Tipologia` int(11) NOT NULL,
  `Id` int(11) NOT NULL,
  `Qta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Ricette`
--

INSERT INTO `Ricette` (`Tipologia`, `Id`, `Qta`) VALUES
(10, 1001, 2.50),
(10, 1010, 1.25),
(11, 1002, 1.50),
(11, 1010, 0.80),
(12, 1001, 1.00),
(12, 1003, 1.75),
(12, 1007, 0.55),
(13, 1002, 0.80),
(13, 1008, 0.40),
(14, 1004, 0.50),
(14, 1006, 0.95),
(15, 1003, 0.25),
(15, 1009, 0.60),
(16, 1005, 2.00),
(17, 1006, 1.20),
(17, 1009, 0.75),
(18, 1005, 0.30),
(18, 1007, 0.90),
(19, 1004, 0.70),
(19, 1008, 1.10);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Dipendenti`
--
ALTER TABLE `Dipendenti`
  ADD PRIMARY KEY (`Matricola`),
  ADD UNIQUE KEY `CF` (`CF`);

--
-- Indici per le tabelle `Magazzini`
--
ALTER TABLE `Magazzini`
  ADD PRIMARY KEY (`Codice`);

--
-- Indici per le tabelle `MateriePrime`
--
ALTER TABLE `MateriePrime`
  ADD PRIMARY KEY (`Tipologia`),
  ADD KEY `Codice` (`Codice`);

--
-- Indici per le tabelle `Prodotti`
--
ALTER TABLE `Prodotti`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Codice` (`Codice`),
  ADD KEY `Matricola` (`Matricola`);

--
-- Indici per le tabelle `Ricette`
--
ALTER TABLE `Ricette`
  ADD PRIMARY KEY (`Tipologia`,`Id`),
  ADD KEY `Id` (`Id`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `MateriePrime`
--
ALTER TABLE `MateriePrime`
  ADD CONSTRAINT `MateriePrime_ibfk_1` FOREIGN KEY (`Codice`) REFERENCES `Magazzini` (`Codice`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `Prodotti`
--
ALTER TABLE `Prodotti`
  ADD CONSTRAINT `Prodotti_ibfk_1` FOREIGN KEY (`Codice`) REFERENCES `Magazzini` (`Codice`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `Prodotti_ibfk_2` FOREIGN KEY (`Matricola`) REFERENCES `Dipendenti` (`Matricola`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limiti per la tabella `Ricette`
--
ALTER TABLE `Ricette`
  ADD CONSTRAINT `Ricette_ibfk_1` FOREIGN KEY (`Tipologia`) REFERENCES `MateriePrime` (`Tipologia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Ricette_ibfk_2` FOREIGN KEY (`Id`) REFERENCES `Prodotti` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
