-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 20, 2024 alle 11:49
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

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
-- Struttura della tabella `articoli`
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
-- Struttura della tabella `calendario`
--

CREATE TABLE `calendario` (
  `id_evento` int(11) NOT NULL,
  `tipologia` varchar(32) NOT NULL,
  `data` datetime(6) NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `componenti`
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
-- Struttura della tabella `contratti`
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
-- Struttura della tabella `finanze`
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
-- Struttura della tabella `logistica`
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
-- Struttura della tabella `ordinazioni`
--

CREATE TABLE `ordinazioni` (
  `id_ordine` int(11) NOT NULL,
  `quantita` int(16) NOT NULL,
  `fk_id_articolo` int(11) NOT NULL,
  `fk_id_utente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `produzioni`
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
-- Struttura della tabella `ruoli`
--

CREATE TABLE `ruoli` (
  `id_ruolo` int(11) NOT NULL,
  `nome_ruolo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ruoli`
--

INSERT INTO `ruoli` (`id_ruolo`, `nome_ruolo`) VALUES
(1, 'pilota'),
(2, 'ingegnere di pista'),
(3, 'ingegnere meccanico'),
(4, 'dirigente'),
(5, 'cliente');

-- --------------------------------------------------------

--
-- Struttura della tabella `sponsor`
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
-- Struttura della tabella `utenti`
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
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `articoli`
--
ALTER TABLE `articoli`
  ADD PRIMARY KEY (`id_articolo`);

--
-- Indici per le tabelle `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indici per le tabelle `componenti`
--
ALTER TABLE `componenti`
  ADD PRIMARY KEY (`id_componente`);

--
-- Indici per le tabelle `finanze`
--
ALTER TABLE `finanze`
  ADD PRIMARY KEY (`id_transazione`);

--
-- Indici per le tabelle `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`id_spostamento`);

--
-- Indici per le tabelle `ordinazioni`
--
ALTER TABLE `ordinazioni`
  ADD PRIMARY KEY (`id_ordine`);

--
-- Indici per le tabelle `produzioni`
--
ALTER TABLE `produzioni`
  ADD PRIMARY KEY (`id_produzione`);

--
-- Indici per le tabelle `ruoli`
--
ALTER TABLE `ruoli`
  ADD PRIMARY KEY (`id_ruolo`);

--
-- Indici per le tabelle `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id_sponsor`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id_utente`),
  ADD KEY `fk_id_ruolo` (`fk_id_ruolo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `articoli`
--
ALTER TABLE `articoli`
  MODIFY `id_articolo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `calendario`
--
ALTER TABLE `calendario`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `componenti`
--
ALTER TABLE `componenti`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `finanze`
--
ALTER TABLE `finanze`
  MODIFY `id_transazione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `logistica`
--
ALTER TABLE `logistica`
  MODIFY `id_spostamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ordinazioni`
--
ALTER TABLE `ordinazioni`
  MODIFY `id_ordine` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `produzioni`
--
ALTER TABLE `produzioni`
  MODIFY `id_produzione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ruoli`
--
ALTER TABLE `ruoli`
  MODIFY `id_ruolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id_sponsor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id_utente` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `utenti`
--
ALTER TABLE `utenti`
  ADD CONSTRAINT `utenti_ibfk_1` FOREIGN KEY (`fk_id_ruolo`) REFERENCES `ruoli` (`id_ruolo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
