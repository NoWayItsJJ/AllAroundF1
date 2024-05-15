-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 07:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `all_around_f1`
--

-- --------------------------------------------------------

--
-- Table structure for table `articoli`
--

CREATE TABLE `articoli` (
  `id_articolo` int(11) NOT NULL,
  `numero_inventario` varchar(32) NOT NULL,
  `tipologia` set('cappellino','maglietta','felpa','bomber') NOT NULL,
  `quantita` int(64) NOT NULL,
  `img` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendario`
--

CREATE TABLE `calendario` (
  `id_evento` int(11) NOT NULL,
  `tipologia` set('Meeting','Call','Conference','Interview','Test','Race Weekend') NOT NULL,
  `data_evento` datetime(6) NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendario`
--

INSERT INTO `calendario` (`id_evento`, `tipologia`, `data_evento`, `fk_id_utente`) VALUES
(1, 'Test', '2024-04-28 06:00:00.000000', 2),
(2, 'Meeting', '2024-04-28 18:53:05.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `componenti`
--

CREATE TABLE `componenti` (
  `id_componente` int(11) NOT NULL,
  `numero_inventario` varchar(32) NOT NULL,
  `tipologia` set('chassis','floor','suspension','brake','front wing','rear wing','power unit','sidepod') NOT NULL,
  `versione` int(16) NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `componenti`
--

INSERT INTO `componenti` (`id_componente`, `numero_inventario`, `tipologia`, `versione`, `fk_id_utente`) VALUES
(1, '123', 'floor', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contratti`
--

CREATE TABLE `contratti` (
  `id_contratto` int(11) NOT NULL,
  `stipendio` int(16) NOT NULL,
  `bonus` int(16) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contratti`
--

INSERT INTO `contratti` (`id_contratto`, `stipendio`, `bonus`, `data_inizio`, `data_fine`, `fk_id_utente`) VALUES
(1, 10000000, 0, '2024-04-30', '2024-09-08', 1),
(2, 500000, 250000, '2024-05-05', '2026-05-01', 2),
(3, 150000, 50000, '2024-03-12', '2025-04-16', 3),
(4, 12000000, 500000, '2024-09-01', '2025-09-07', 5),
(5, 50000, 20000, '2024-05-05', '2024-05-11', 6),
(6, 30000, 30000, '2024-05-12', '2024-08-18', 7),
(7, 50000, 5000, '2024-05-05', '2024-05-27', 8),
(9, 400000, 5000, '0000-00-00', '2024-05-28', 11);

-- --------------------------------------------------------

--
-- Table structure for table `finanze`
--

CREATE TABLE `finanze` (
  `id_transazione` int(11) NOT NULL,
  `tipo` set('entrata','uscita') NOT NULL,
  `importo` double NOT NULL,
  `causale` set('contratto','nuovo componente','logistica','multa','sponsor','sviluppo','marketing','ordini') NOT NULL,
  `descrizione` varchar(128) NOT NULL,
  `fk_id_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finanze`
--

INSERT INTO `finanze` (`id_transazione`, `tipo`, `importo`, `causale`, `descrizione`, `fk_id_item`) VALUES
(1, 'entrata', 70000000, 'sponsor', 'budget', 1),
(2, 'entrata', 500000, 'sponsor', 'hp sponsor', 2),
(3, 'uscita', 12000000, 'contratto', 'ayrton senna', 4),
(4, 'uscita', 10000000, 'contratto', 'riccardo saro', 1),
(5, 'uscita', 500000, 'contratto', 'fabio pauletta', 2),
(6, 'uscita', 150000, 'contratto', 'pippo de pippis', 3),
(7, 'uscita', 50000, 'contratto', 'fatturo tanto', 5),
(8, 'uscita', 30000, 'contratto', 'ocyo kecasko', 6),
(9, 'uscita', 50000, 'contratto', 'test ingegnere', 7),
(14, 'uscita', 400000, 'contratto', 'Nuovo contratto - test finanze', 9);

-- --------------------------------------------------------

--
-- Table structure for table `logistica`
--

CREATE TABLE `logistica` (
  `id_spostamento` int(11) NOT NULL,
  `partenza` varchar(32) NOT NULL,
  `destinazione` varchar(32) NOT NULL,
  `mezzo_trasporto` set('airplane','ship','truck','car','bus') NOT NULL,
  `data_partenza` datetime(6) NOT NULL,
  `data_arrivo` datetime(6) NOT NULL,
  `tipo` set('person','item') NOT NULL,
  `fk_id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logistica`
--

INSERT INTO `logistica` (`id_spostamento`, `partenza`, `destinazione`, `mezzo_trasporto`, `data_partenza`, `data_arrivo`, `tipo`, `fk_id_item`) VALUES
(1, 'miami', 'imola', 'airplane', '2024-05-06 16:50:10.000000', '2024-05-15 16:50:10.000000', 'item', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nazionalita`
--

CREATE TABLE `nazionalita` (
  `id_nazionalita` int(11) NOT NULL,
  `nome_nazionalita` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nazionalita`
--

INSERT INTO `nazionalita` (`id_nazionalita`, `nome_nazionalita`) VALUES
(1, 'italiana'),
(2, 'svizzera'),
(3, 'spagnola'),
(4, 'francese'),
(5, 'tedesca'),
(6, 'polacca'),
(7, 'albanese'),
(8, 'statunitense'),
(9, 'austriaca'),
(10, 'britannica'),
(11, 'irlandese'),
(12, 'cinese'),
(13, 'giapponese'),
(14, 'svedese'),
(15, 'norvegese'),
(16, 'finlandese'),
(17, 'russa'),
(18, 'danese'),
(19, 'brasiliana'),
(20, 'thailandese');

-- --------------------------------------------------------

--
-- Table structure for table `ordinazioni`
--

CREATE TABLE `ordinazioni` (
  `id_ordine` int(11) NOT NULL,
  `quantita` int(16) NOT NULL,
  `fk_id_articolo` int(11) NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produzioni`
--

CREATE TABLE `produzioni` (
  `id_produzione` int(11) NOT NULL,
  `tipologia` set('chassis','floor','suspension','brake','front wing','rear wing','power unit','sidepod') NOT NULL,
  `versione` int(16) NOT NULL,
  `data_fine` date NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruoli`
--

CREATE TABLE `ruoli` (
  `id_ruolo` int(11) NOT NULL,
  `nome_ruolo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruoli`
--

INSERT INTO `ruoli` (`id_ruolo`, `nome_ruolo`) VALUES
(1, 'pilota'),
(2, 'ingegnere di pista'),
(3, 'ingegnere meccanico'),
(4, 'dirigente'),
(5, 'cliente'),
(6, 'amministrazione'),
(7, 'marketing');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id_sponsor` int(11) NOT NULL,
  `tipologia` varchar(32) NOT NULL,
  `importo` double NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `img` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id_sponsor`, `tipologia`, `importo`, `data_inizio`, `data_fine`, `img`) VALUES
(1, 'budget cap', 70000000, '2024-01-01', '2024-12-31', ''),
(2, 'tecnologia', 50000, '2024-05-14', '2025-05-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `id_utente` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `data_nascita` date NOT NULL,
  `indirizzo` varchar(64) NOT NULL,
  `citta` varchar(32) NOT NULL,
  `CAP` int(16) NOT NULL,
  `stato` varchar(32) NOT NULL,
  `img` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `archiviato` tinyint(1) NOT NULL,
  `specializzazione` varchar(32) NOT NULL,
  `fk_id_ruolo` int(11) NOT NULL,
  `fk_id_nazionalita` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`id_utente`, `nome`, `cognome`, `data_nascita`, `indirizzo`, `citta`, `CAP`, `stato`, `img`, `email`, `password`, `archiviato`, `specializzazione`, `fk_id_ruolo`, `fk_id_nazionalita`) VALUES
(1, 'riccardo', 'saro', '2005-12-17', 'via amalteo 25', 'fontanafredda', 33074, 'italia', '1_sus.jpg', 'rickysaro17@gmail.com', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'hr', 4, 17),
(2, 'fabio', 'pauletta', '2005-06-17', 'via tasso 14', 'maniago', 33085, 'italia', '2_png.jpg', 'fabio.pauletta@gmail.com', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'freni', 3, 8),
(3, 'pippo', 'de pippis', '2000-04-20', 'via dalle palle 4', 'pramaggiore', 30020, 'italia', '', 'pippo@pippo.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'termocoperte', 2, 3),
(4, 'paperon', 'de paperoni', '2000-01-23', 'piazza cavour 69', 'pordenone', 33170, 'italia', '', 'paperon@depaperoni.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'spendere', 5, 12),
(5, 'ayrton', 'senna', '1960-03-21', 'via imola 1994', 'imola', 40026, 'italia', '', 'ayrton@senna.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'tamburello', 1, 19),
(6, 'fatturo', 'tanto', '2016-05-01', 'via dei ricconi 777', 'montecarlo', 33170, 'monaco', '', 'fatturo@tanto.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'pubblicità', 7, 5),
(7, 'ocyo', 'kecasko', '1999-04-01', 'via metenho dhuro 000', 'sacile', 33077, 'italia', '', 'ocyo@kecasko.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'burocrazia', 6, 20),
(8, 'test', 'ingegnere', '2000-01-01', 'via testing 5', 'maniago', 33085, 'italia', '', 'test@ing.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 'testing', 3, 11),
(11, 'test', 'finanze', '2024-05-13', '', '', 0, '', '', 'test@finances.it', 'c21f969b5f03d33d43e04f8f136e7682', 0, 'spec', 7, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`id_articolo`);

--
-- Indexes for table `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indexes for table `componenti`
--
ALTER TABLE `componenti`
  ADD PRIMARY KEY (`id_componente`);

--
-- Indexes for table `contratti`
--
ALTER TABLE `contratti`
  ADD PRIMARY KEY (`id_contratto`),
  ADD KEY `fk_id_utente` (`fk_id_utente`);

--
-- Indexes for table `finanze`
--
ALTER TABLE `finanze`
  ADD PRIMARY KEY (`id_transazione`),
  ADD KEY `fk_id_item` (`fk_id_item`),
  ADD KEY `fk_id_item_2` (`fk_id_item`),
  ADD KEY `fk_id_item_3` (`fk_id_item`);

--
-- Indexes for table `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`id_spostamento`);

--
-- Indexes for table `nazionalita`
--
ALTER TABLE `nazionalita`
  ADD PRIMARY KEY (`id_nazionalita`);

--
-- Indexes for table `ordinazioni`
--
ALTER TABLE `ordinazioni`
  ADD PRIMARY KEY (`id_ordine`);

--
-- Indexes for table `produzioni`
--
ALTER TABLE `produzioni`
  ADD PRIMARY KEY (`id_produzione`);

--
-- Indexes for table `ruoli`
--
ALTER TABLE `ruoli`
  ADD PRIMARY KEY (`id_ruolo`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id_sponsor`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id_utente`),
  ADD KEY `fk_id_ruolo` (`fk_id_ruolo`),
  ADD KEY `fk_id_nazionalita` (`fk_id_nazionalita`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articoli`
--
ALTER TABLE `articoli`
  MODIFY `id_articolo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `componenti`
--
ALTER TABLE `componenti`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contratti`
--
ALTER TABLE `contratti`
  MODIFY `id_contratto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `finanze`
--
ALTER TABLE `finanze`
  MODIFY `id_transazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `logistica`
--
ALTER TABLE `logistica`
  MODIFY `id_spostamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nazionalita`
--
ALTER TABLE `nazionalita`
  MODIFY `id_nazionalita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ordinazioni`
--
ALTER TABLE `ordinazioni`
  MODIFY `id_ordine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produzioni`
--
ALTER TABLE `produzioni`
  MODIFY `id_produzione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ruoli`
--
ALTER TABLE `ruoli`
  MODIFY `id_ruolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contratti`
--
ALTER TABLE `contratti`
  ADD CONSTRAINT `contratti_ibfk_1` FOREIGN KEY (`fk_id_utente`) REFERENCES `utenti` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`fk_id_ruolo`) REFERENCES `ruoli` (`id_ruolo`),
  ADD CONSTRAINT `utenti_ibfk_2` FOREIGN KEY (`fk_id_nazionalita`) REFERENCES `nazionalita` (`id_nazionalita`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
