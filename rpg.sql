-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jun-2023 às 05:46
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rpg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `evs`
--

CREATE TABLE `evs` (
  `id_poke` int(10) DEFAULT NULL,
  `ev_hp` int(4) DEFAULT 0,
  `ev_atk` int(4) DEFAULT 0,
  `ev_def` int(4) DEFAULT 0,
  `ev_satk` int(4) DEFAULT 0,
  `ev_sdef` int(4) DEFAULT 0,
  `ev_speed` int(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mochila`
--

CREATE TABLE `mochila` (
  `id_per` int(10) DEFAULT NULL,
  `peso_max` varchar(20) DEFAULT NULL,
  `peso_usado` varchar(3) DEFAULT NULL,
  `nome_item` varchar(30) DEFAULT NULL,
  `qnt_item` int(4) DEFAULT NULL,
  `id_item` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `npc`
--

CREATE TABLE `npc` (
  `id_npc` int(10) NOT NULL,
  `nome_npc` varchar(50) DEFAULT NULL,
  `classe_npc` varchar(50) DEFAULT NULL,
  `time_npc` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(10) NOT NULL,
  `id_per` int(10) DEFAULT NULL,
  `nomeper` varchar(20) DEFAULT NULL,
  `regiao` varchar(20) DEFAULT NULL,
  `cidade` varchar(20) DEFAULT NULL,
  `idade` int(4) DEFAULT NULL,
  `id_trei` varchar(4) DEFAULT NULL,
  `mundial` varchar(4) DEFAULT NULL,
  `pt_mundial` int(10) NOT NULL DEFAULT 0,
  `insig` varchar(4) DEFAULT NULL,
  `hp` varchar(4) NOT NULL DEFAULT '20',
  `stamina` varchar(4) NOT NULL DEFAULT '20',
  `determinacao` varchar(4) NOT NULL DEFAULT '20',
  `altura` varchar(3) NOT NULL,
  `peso` varchar(3) NOT NULL,
  `dex` int(11) NOT NULL,
  `mtrei` varchar(20) NOT NULL,
  `torneios` varchar(3) NOT NULL DEFAULT '0',
  `contest` varchar(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `persona`
--

INSERT INTO `persona` (`id_persona`, `id_per`, `nomeper`, `regiao`, `cidade`, `idade`, `id_trei`, `mundial`, `pt_mundial`, `insig`, `hp`, `stamina`, `determinacao`, `altura`, `peso`, `dex`, `mtrei`, `torneios`, `contest`) VALUES
(4, 18, 'Violetta Sold', 'Unova', 'Opelucid', 12, '524', '1800', 121, '2', '20', '20', '20', '1.5', '45', 0, 'Emcorajador', '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `personagem`
--

CREATE TABLE `personagem` (
  `id` int(10) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `personagem`
--

INSERT INTO `personagem` (`id`, `nome`, `email`, `password`) VALUES
(18, 'Vi', 'vi123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Estrutura da tabela `poke`
--

CREATE TABLE `poke` (
  `id_poke` int(10) NOT NULL,
  `id_per` int(10) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `tipo` varchar(200) NOT NULL,
  `regiao` varchar(100) NOT NULL DEFAULT 'kanto',
  `xp_combate` tinyint(1) NOT NULL DEFAULT 0,
  `crescimento` varchar(200) NOT NULL,
  `t_type` varchar(50) DEFAULT NULL,
  `hab` varchar(20) DEFAULT NULL,
  `nature` varchar(20) DEFAULT NULL,
  `xp` int(10) DEFAULT NULL,
  `lv` int(10) DEFAULT NULL,
  `hp` int(4) DEFAULT NULL,
  `atk` int(4) DEFAULT NULL,
  `satk` int(4) DEFAULT NULL,
  `def` int(4) DEFAULT NULL,
  `sdef` int(4) DEFAULT NULL,
  `speed` int(4) DEFAULT NULL,
  `desloc` int(10) DEFAULT NULL,
  `ami` int(4) DEFAULT 0,
  `moves` varchar(500) NOT NULL,
  `tcap` varchar(20) DEFAULT NULL,
  `shyni` varchar(20) NOT NULL DEFAULT 'normal',
  `status` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `poke`
--

INSERT INTO `poke` (`id_poke`, `id_per`, `nome`, `tipo`, `regiao`, `xp_combate`, `crescimento`, `t_type`, `hab`, `nature`, `xp`, `lv`, `hp`, `atk`, `satk`, `def`, `sdef`, `speed`, `desloc`, `ami`, `moves`, `tcap`, `shyni`, `status`) VALUES
(2, 18, 'lucario', 'fighting, steel', 'Unova', 0, '', 'none', 'Protean', 'naughty', 3314, 12, 70, 121, 115, 70, 63, 90, NULL, 0, 'grwol / thander wave / quick atack / tail whip', NULL, 'normal', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_fotos`
--

CREATE TABLE `tbl_fotos` (
  `id_foto` int(10) NOT NULL,
  `id_per` int(10) DEFAULT NULL,
  `nome_foto` varchar(20) DEFAULT NULL,
  `nomemd5_foto` varchar(200) DEFAULT NULL,
  `tamanho_foto` varchar(20) DEFAULT NULL,
  `status_fotos` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tbl_fotos`
--

INSERT INTO `tbl_fotos` (`id_foto`, `id_per`, `nome_foto`, `nomemd5_foto`, `tamanho_foto`, `status_fotos`) VALUES
(4, 18, 'vi(4).jpg', '4f9cef801fa9783b8456ae1638ffa135.jpg', '109749', '1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `evs`
--
ALTER TABLE `evs`
  ADD KEY `id_poke` (`id_poke`);

--
-- Índices para tabela `mochila`
--
ALTER TABLE `mochila`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_per` (`id_per`);

--
-- Índices para tabela `npc`
--
ALTER TABLE `npc`
  ADD PRIMARY KEY (`id_npc`);

--
-- Índices para tabela `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `id_per` (`id_per`);

--
-- Índices para tabela `personagem`
--
ALTER TABLE `personagem`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `poke`
--
ALTER TABLE `poke`
  ADD PRIMARY KEY (`id_poke`),
  ADD KEY `id_per` (`id_per`);

--
-- Índices para tabela `tbl_fotos`
--
ALTER TABLE `tbl_fotos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_per` (`id_per`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `mochila`
--
ALTER TABLE `mochila`
  MODIFY `id_item` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `personagem`
--
ALTER TABLE `personagem`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `poke`
--
ALTER TABLE `poke`
  MODIFY `id_poke` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbl_fotos`
--
ALTER TABLE `tbl_fotos`
  MODIFY `id_foto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `evs`
--
ALTER TABLE `evs`
  ADD CONSTRAINT `evs_ibfk_1` FOREIGN KEY (`id_poke`) REFERENCES `poke` (`id_poke`);

--
-- Limitadores para a tabela `mochila`
--
ALTER TABLE `mochila`
  ADD CONSTRAINT `mochila_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `personagem` (`id`);

--
-- Limitadores para a tabela `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `personagem` (`id`);

--
-- Limitadores para a tabela `poke`
--
ALTER TABLE `poke`
  ADD CONSTRAINT `poke_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `personagem` (`id`);

--
-- Limitadores para a tabela `tbl_fotos`
--
ALTER TABLE `tbl_fotos`
  ADD CONSTRAINT `tbl_fotos_ibfk_1` FOREIGN KEY (`id_per`) REFERENCES `personagem` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
