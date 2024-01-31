-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 21, 2023 alle 10:55
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 8.1.6
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS libreria;
CREATE DATABASE libreria;
USE libreria;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libreria`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `birth_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `author`
--

INSERT INTO `author` (`id`, `name`, `surname`, `birth_year`) VALUES
(1, 'Jane', 'Austen', 1775),
(2, 'Ernest', 'Hemingway', 1899),
(3, 'Agatha', 'Christie', 1890),
(4, 'F. Scott', 'Fitzgerald', 1896),
(5, 'Leo', 'Tolstoy', 1828);

-- --------------------------------------------------------

--
-- Struttura della tabella `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `summary` text DEFAULT NULL,
  `release_year` int(11) NOT NULL,
  `ISBN` char(17) NOT NULL,
  `price` double DEFAULT NULL,
  `cover_image` char(36) DEFAULT NULL,
  `copies` int(11) NOT NULL,
  `ordered` tinyint(1) DEFAULT 0,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `book`
--

INSERT INTO `book` (`id`, `title`, `summary`, `release_year`, `ISBN`, `price`, `cover_image`, `copies`, `ordered`, `author_id`, `publisher_id`) VALUES
(1, 'Pride and Prejudice', 'A classic romantic novel', 1813, '978-0-14-143951-8', 14.99, 'b26677a3-121f-4d32-acd2-f14158a3fbf1', 250, 0, 1, 2),
(2, 'The Old Man and the Sea', 'A novella about an aging Cuban fisherman', 1952, '978-0-451-20866-1', 12.99, '5bb4f033-da9d-4f22-9e31-47486c04a73b', 180, 0, 2, 1),
(3, 'Murder on the Orient Express', 'A famous detective novel', 1934, '978-0-06-269366-2', 16.99, '7c3ba31a-4181-4fe2-82d4-f3feb597a0b1', 120, 0, 3, 2),
(4, 'The Beautiful and Damned', 'A novel about the American Jazz Age', 1922, '978-0-06-191417-1', 18.99, '7c5d9437-2734-44f1-8e70-5851e6db3438', 200, 0, 1, 4),
(5, 'Anna Karenina', 'A tragic tale of love and infidelity', 1877, '978-0-14-303500-8', 19.99, 'eae0542b-409c-4b5d-a105-95b90e6f27b5', 150, 0, 4, 4),
(6, 'Sense and Sensibility', 'A novel about the Dashwood sisters', 1811, '978-1-85326-488-9', 15.99, 'e72a842f-8fac-45eb-ab8c-761815223714', 220, 0, 3, 3),
(7, 'For Whom the Bell Tolls', 'A novel set during the Spanish Civil War', 1940, '978-0-684-80122-9', 20.99, 'e52a3294-da38-4277-bb42-7cd0973190ee', 170, 0, 1, 1),
(8, 'Death on the Nile', 'A Hercule Poirot mystery novel', 1937, '978-0-06-207355-6', 17.99, '1f265332-42ce-4b35-ae6a-1d710af56853', 140, 0, 2, 1),
(9, 'The Brothers Karamazov', 'A philosophical novel by Fyodor Dostoevsky', 1880, '978-0-553-21282-3', 21.99, '456e11c7-bd18-479e-bfd3-222ef8f1a8ec', 190, 0, 3, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `publisher`
--

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `country` varchar(45) DEFAULT NULL,
  `foundation_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `publisher`
--

INSERT INTO `publisher` (`id`, `name`, `country`, `foundation_year`) VALUES
(1, 'HarperCollins', 'United States', 1989),
(2, 'Simon & Schuster', 'United States', 1924),
(3, 'Penguin Random House', 'United Kingdom', 2013),
(4, 'Vintage Books', 'United States', 1954),
(5, 'Hachette Livre', 'France', 1826);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` char(72) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `admin`) VALUES
(1, 'user', '$2y$10$BJn7KgQ5imRJlQ6ijNM4T.OvCmWkyHBFtfxv7lqRevWHUIas/itfq', 0),
(2, 'admin', '$2y$10$KQWcQVJS.bFK0vOnipF54eN/qSnd389TH3w85eW3yBLvi7UbNW4Xy', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_book` (`author_id`),
  ADD KEY `publisher_book` (`publisher_id`);

--
-- Indici per le tabelle `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `author_book` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`),
  ADD CONSTRAINT `publisher_book` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
