-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Jun-2021 às 20:38
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `consultorio`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dentistas`
--

CREATE TABLE `dentistas` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dentistas`
--

INSERT INTO `dentistas` (`id`, `nome`) VALUES
(1, 'Dra Vanessa'),
(2, 'Dra Klecia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `procedimento` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacoes` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dentista_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `startdate`, `starttime`, `endtime`, `start`, `end`, `procedimento`, `observacoes`, `dentista_id`) VALUES
(96, 'bruno', '#228B22', '2021-04-19', '09:00:00', '09:15:00', '2021-04-19 09:00:00', '2021-04-19 09:15:00', 'Avaliação', 'teste', 1),
(95, 'bruno', '#228B22', '2021-04-19', '09:30:00', '09:45:00', '2021-04-19 09:30:00', '2021-04-19 09:45:00', 'Avaliação', 'teste', 1),
(93, 'bruno', '#8B0000', '2021-04-15', '08:00:00', '08:15:00', '2021-04-15 08:00:00', '2021-04-15 08:15:00', 'Avaliação', 'teste', 1),
(92, 'fabio', '#228B22', '2021-04-15', '08:30:00', '09:00:00', '2021-04-15 08:30:00', '2021-04-15 09:00:00', '', '', 1),
(94, 'vanessa', '#8B0000', '2021-04-15', '09:30:00', '09:45:00', '2021-04-15 09:30:00', '2021-04-15 09:45:00', 'Implante', 'teste', 2),
(107, 'fabio', '#228B22', '2021-06-22', '08:30:00', '08:45:00', '2021-06-22 08:30:00', '2021-06-22 08:45:00', 'Selecione', 'teste', 1),
(97, 'bruno', '#228B22', '2021-04-26', '08:00:00', '08:15:00', '2021-04-26 08:00:00', '2021-04-26 08:15:00', 'Selecione', 'teste', 1),
(98, 'fabio', '#40E0D0', '2021-04-26', '08:15:00', '08:30:00', '2021-04-26 08:15:00', '2021-04-26 08:30:00', 'Ortodontia', 'teste', 2),
(99, 'bruno', '#228B22', '2021-05-04', '08:00:00', '08:15:00', '2021-05-04 08:00:00', '2021-05-04 08:15:00', 'Avaliação', 'teste', 1),
(100, 'bruno', '#228B22', '2021-05-06', '08:00:00', '08:15:00', '2021-05-06 08:00:00', '2021-05-06 08:15:00', 'Avaliação', 'teste', 1),
(101, 'fabio', '#8B0000', '2021-05-06', '08:15:00', '08:45:00', '2021-05-06 08:15:00', '2021-05-06 08:45:00', 'Ortodontia', 'teste', 2),
(102, 'bruno', '#228B22', '2021-05-11', '08:00:00', '08:15:00', '2021-05-11 08:00:00', '2021-05-11 08:15:00', 'Avaliação', 'teste', 1),
(103, 'bruno', '#228B22', '2021-05-21', '08:00:00', '08:15:00', '2021-05-21 08:00:00', '2021-05-21 08:15:00', 'Avaliação', 'teste', 1),
(104, 'fabio', '#8B0000', '2021-05-21', '08:15:00', '08:30:00', '2021-05-21 08:15:00', '2021-05-21 08:30:00', 'Ortodontia', 'teste', 2),
(105, 'bruno', '#228B22', '2021-06-22', '08:00:00', '08:15:00', '2021-06-22 08:00:00', '2021-06-22 08:15:00', 'Avaliação', 'teste', 1),
(106, 'fabio', '#FF4500', '2021-06-22', '08:45:00', '09:00:00', '2021-06-22 08:45:00', '2021-06-22 09:00:00', 'Ortodontia', 'teste', 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `dentistas`
--
ALTER TABLE `dentistas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_events_dentista` (`dentista_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dentistas`
--
ALTER TABLE `dentistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
