-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 09:03 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `contratti`
--

CREATE TABLE `contratti` (
  `id_contratto` int(11) NOT NULL,
  `stipendio` int(16) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `fk_id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 'cliente');

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

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `id_utente` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `indirizzo` varchar(64) NOT NULL,
  `citta` varchar(32) NOT NULL,
  `CAP` int(16) NOT NULL,
  `stato` varchar(32) NOT NULL,
  `img` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `archiviato` tinyint(1) NOT NULL,
  `fk_id_ruolo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`id_utente`, `nome`, `cognome`, `indirizzo`, `citta`, `CAP`, `stato`, `img`, `email`, `password`, `archiviato`, `fk_id_ruolo`) VALUES
(1, 'riccardo', 'saro', 'via amalteo 25', 'fontanafredda', 33074, 'italia', '', 'rickysaro17@gmail.com', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 4),
(2, 'fabio', 'pauletta', 'via tasso 14', 'maniago', 33085, 'italia', '', 'fabio.pauletta@gmail.com', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 3),
(3, 'pippo', 'de pippis', 'via dalle palle 4', 'pramaggiore', 30020, 'italia', '', 'pippo@pippo.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 2),
(4, 'paperon', 'de paperoni', 'piazza cavour 69', 'pordenone', 33170, 'italia', '', 'paperon@depaperoni.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 5),
(5, 'ayrton', 'senna', 'via imola 1994', 'imola', 40026, 'italia', '', 'ayrton@senna.it', '0c88028bf3aa6a6a143ed846f2be1ea4', 0, 1);

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
-- Indexes for table `finanze`
--
ALTER TABLE `finanze`
  ADD PRIMARY KEY (`id_transazione`);

--
-- Indexes for table `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`id_spostamento`);

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
  ADD KEY `fk_id_ruolo` (`fk_id_ruolo`);

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
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `componenti`
--
ALTER TABLE `componenti`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `finanze`
--
ALTER TABLE `finanze`
  MODIFY `id_transazione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logistica`
--
ALTER TABLE `logistica`
  MODIFY `id_spostamento` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_ruolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`fk_id_ruolo`) REFERENCES `ruoli` (`id_ruolo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
