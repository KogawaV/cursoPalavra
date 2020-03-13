-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Mar-2020 às 02:40
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `curso_palavra`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_aluno` int(11) NOT NULL,
  `nome_aluno` varchar(50) NOT NULL,
  `email_aluno` varchar(50) NOT NULL,
  `cpf_aluno` varchar(14) DEFAULT NULL,
  `senha_aluno` varchar(50) NOT NULL,
  `nome_escola` varchar(100) NOT NULL,
  `id_escola` int(11) NOT NULL,
  `tipo_plano` int(11) NOT NULL,
  `limite_redacoes` int(11) NOT NULL,
  `acesso` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome_aluno`, `email_aluno`, `cpf_aluno`, `senha_aluno`, `nome_escola`, `id_escola`, `tipo_plano`, `limite_redacoes`, `acesso`) VALUES
(1, 'aluno', 'aluno@gmail.com', '111.111.111-11', '123', 'individual', 0, 3, 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `identificador_carrinho` int(11) NOT NULL,
  `identificador_compra` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL,
  `valor_venda` decimal(10,0) NOT NULL,
  `qtd_plano` int(11) NOT NULL,
  `data_compra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`identificador_carrinho`, `identificador_compra`, `id_aluno`, `valor_venda`, `qtd_plano`, `data_compra`) VALUES
(1, 3, 1, '50', 1, '2020-02-27 05:58:41');

-- --------------------------------------------------------

--
-- Estrutura da tabela `correcao_enem`
--

CREATE TABLE `correcao_enem` (
  `id_aluno_redacao` int(11) NOT NULL,
  `id_redacao` int(11) NOT NULL,
  `criterio_1` int(11) DEFAULT 0,
  `criterio_2` int(11) NOT NULL DEFAULT 0,
  `criterio_3` int(11) NOT NULL DEFAULT 0,
  `criterio_4` int(11) NOT NULL DEFAULT 0,
  `criterio_5` int(11) NOT NULL DEFAULT 0,
  `nota_final` int(11) NOT NULL DEFAULT 0,
  `trecho_selecionado` text DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `correcao_enem`
--

INSERT INTO `correcao_enem` (`id_aluno_redacao`, `id_redacao`, `criterio_1`, `criterio_2`, `criterio_3`, `criterio_4`, `criterio_5`, `nota_final`, `trecho_selecionado`, `comentario`) VALUES
(1, 1, 40, 80, 120, 160, 200, 600, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Do', 'asdasd 1'),
(1, 1, 40, 80, 120, 160, 200, 600, 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id', 'asdasd 2'),
(1, 2, 120, 120, 160, 120, 160, 680, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem.', 'asdasdas 1'),
(1, 2, 120, 120, 160, 120, 160, 680, '\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam f', 'asdasdas 2asdas'),
(1, 2, 120, 120, 160, 120, 160, 680, 'Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', 'dlkjlksjglksdjflksdjf 3'),
(1, 3, 0, 120, 160, 120, 80, 480, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dict', 'comentário 1'),
(1, 3, 0, 120, 160, 120, 80, 480, 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque,', 'comentário 2'),
(1, 10, 80, 160, 160, 200, 40, 640, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum varius pharetra facilisis. Integer dignissim ultrices nulla ut scelerisque. Pellentesque aliquet pellentesque ipsum, et posuere dui auctor sed. Praesen', 'ASDASDAD 1111'),
(1, 12, 80, 120, 80, 40, 160, 480, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam ', 'comentário 1'),
(1, 12, 80, 120, 80, 40, 160, 480, 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam ', 'comentário 2'),
(1, 12, 120, 80, 160, 40, 200, 600, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit ', 'comentário 1'),
(1, 12, 120, 80, 160, 40, 200, 600, '\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula', 'comentário 2'),
(1, 13, 80, 120, 200, 80, 120, 600, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nul', 'comentário 1'),
(1, 11, 80, 120, 120, 160, 160, 640, 'asdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdas', 'comnetário 1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `correcao_fuvest`
--

CREATE TABLE `correcao_fuvest` (
  `id_aluno_redacao` int(11) NOT NULL,
  `id_redacao` int(11) NOT NULL,
  `criterio_a` int(11) NOT NULL,
  `criterio_b` int(11) NOT NULL,
  `criterio_c` int(11) NOT NULL,
  `nota_final` int(11) NOT NULL,
  `trecho_selecionado` text DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `correcao_fuvest`
--

INSERT INTO `correcao_fuvest` (`id_aluno_redacao`, `id_redacao`, `criterio_a`, `criterio_b`, `criterio_c`, `nota_final`, `trecho_selecionado`, `comentario`) VALUES
(1, 4, 0, 2, 2, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesq', 'asdas 1'),
(1, 7, 2, 2, 2, 6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a', 'comentário 1'),
(1, 7, 2, 2, 2, 6, 'Nunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eg', 'comentário 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `correcao_unicamp`
--

CREATE TABLE `correcao_unicamp` (
  `id_aluno_redacao` int(11) NOT NULL,
  `id_redacao` int(11) NOT NULL,
  `criterio_1` int(11) NOT NULL,
  `criterio_2` int(11) NOT NULL,
  `criterio_3` int(11) NOT NULL,
  `criterio_4` int(11) NOT NULL,
  `nota_final` int(11) NOT NULL,
  `trecho_selecionado` text NOT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `correcao_unicamp`
--

INSERT INTO `correcao_unicamp` (`id_aluno_redacao`, `id_redacao`, `criterio_1`, `criterio_2`, `criterio_3`, `criterio_4`, `nota_final`, `trecho_selecionado`, `comentario`) VALUES
(1, 5, 2, 2, 3, 2, 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat eg', 'asdasd 1'),
(1, 5, 2, 2, 3, 2, 9, 'habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit matt', 'asdasd 1asd'),
(1, 8, 2, 1, 2, 3, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet', 'ASASDASD 1'),
(1, 8, 2, 1, 2, 3, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet', 'ASASDASD 1'),
(1, 8, 2, 1, 2, 3, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet', 'ASASDASD 1'),
(1, 8, 2, 1, 2, 3, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet', 'ASASDASD 1'),
(1, 8, 2, 1, 2, 3, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet', 'ASASDASD 1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `correcao_vunesp`
--

CREATE TABLE `correcao_vunesp` (
  `id_aluno_redacao` int(11) NOT NULL,
  `id_redacao` int(11) NOT NULL,
  `criterio_a` int(11) NOT NULL,
  `criterio_b` int(11) NOT NULL,
  `criterio_c` int(11) NOT NULL,
  `nota_final` int(11) NOT NULL,
  `trecho_selecionado` text DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `correcao_vunesp`
--

INSERT INTO `correcao_vunesp` (`id_aluno_redacao`, `id_redacao`, `criterio_a`, `criterio_b`, `criterio_c`, `nota_final`, `trecho_selecionado`, `comentario`) VALUES
(1, 6, 2, 3, 2, 7, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus', 'adadasdasdasdasdasdasdasd 1'),
(1, 9, 1, 1, 3, 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a', 'asdasdasasd'),
(1, 9, 1, 1, 3, 5, 'habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. N', 'asdasdasasd 1111');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_adm`
--

CREATE TABLE `dados_adm` (
  `email_adm` varchar(50) NOT NULL,
  `senha_adm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_adm`
--

INSERT INTO `dados_adm` (`email_adm`, `senha_adm`) VALUES
('adm@gmail.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_corretor`
--

CREATE TABLE `dados_corretor` (
  `id_corretor` int(11) NOT NULL,
  `nome_corretor` varchar(100) NOT NULL,
  `email_corretor` varchar(50) NOT NULL,
  `senha_corretor` varchar(50) NOT NULL,
  `cpf_corretor` varchar(14) NOT NULL,
  `qtd_red_corrigidas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_corretor`
--

INSERT INTO `dados_corretor` (`id_corretor`, `nome_corretor`, `email_corretor`, `senha_corretor`, `cpf_corretor`, `qtd_red_corrigidas`) VALUES
(1, 'corretor', 'corretor@gmail.com', '123', '222.222.222-22', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_graficos`
--

CREATE TABLE `dados_graficos` (
  `id_aluno` int(11) NOT NULL,
  `universidade` varchar(50) NOT NULL,
  `nota_total` int(11) NOT NULL,
  `mes_envio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dados_graficos`
--

INSERT INTO `dados_graficos` (`id_aluno`, `universidade`, `nota_total`, `mes_envio`) VALUES
(1, 'Unicamp', 8, '0000-00-00'),
(1, 'Unicamp', 8, 'February'),
(1, 'Vunesp', 7, 'February'),
(1, 'Vunesp', 5, 'February'),
(1, 'Enem', 480, 'February'),
(1, 'Enem', 600, 'February'),
(1, 'Enem', 600, 'March'),
(1, 'Enem', 640, 'March');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

CREATE TABLE `escola` (
  `id_escola` int(11) NOT NULL,
  `nome_escola` varchar(100) NOT NULL,
  `email_escola` varchar(100) NOT NULL,
  `senha_escola` varchar(100) NOT NULL,
  `qtd_aluno_escola` int(11) NOT NULL,
  `limite_redacao_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `identificador_pagamento` int(11) NOT NULL,
  `tipo_pagamento` int(11) NOT NULL,
  `cod_transacao` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `status_pagamento` int(2) NOT NULL,
  `link_boleto` text COLLATE latin1_general_ci DEFAULT NULL,
  `link_deb_online` text COLLATE latin1_general_ci DEFAULT NULL,
  `identificador_carrinho` int(11) NOT NULL,
  `data_compra` date NOT NULL,
  `modificacao_compra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `redacoes_enviadas`
--

CREATE TABLE `redacoes_enviadas` (
  `id_red` int(11) NOT NULL,
  `nome_aluno` varchar(70) NOT NULL,
  `caminho_redacao` varchar(255) NOT NULL,
  `universidade_redacao` varchar(80) NOT NULL,
  `tema_redacao` varchar(255) NOT NULL,
  `tema_sem_acento` varchar(255) NOT NULL,
  `nome_corretor` varchar(80) DEFAULT NULL,
  `id_corretor` int(11) DEFAULT NULL,
  `id_aluno_redacao` int(11) NOT NULL,
  `status_corrigida` int(1) NOT NULL,
  `numero_redacoes_enviadas` int(11) NOT NULL,
  `tipo_redacao` int(11) DEFAULT NULL,
  `redacao_alterada` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `redacoes_escritas`
--

CREATE TABLE `redacoes_escritas` (
  `id_red` int(11) NOT NULL,
  `nome_aluno` varchar(70) NOT NULL,
  `caminho_redacao` varchar(255) NOT NULL,
  `universidade_redacao` varchar(80) NOT NULL,
  `tema_redacao` varchar(255) NOT NULL,
  `tema_sem_acento` varchar(255) NOT NULL,
  `nome_corretor` varchar(80) DEFAULT NULL,
  `id_corretor` int(11) DEFAULT NULL,
  `id_aluno_redacao` int(11) NOT NULL,
  `status_corrigida` int(1) NOT NULL,
  `numero_redacoes_enviadas` int(11) NOT NULL,
  `tipo_redacao` int(11) DEFAULT NULL,
  `texto_redacao_escrita` text NOT NULL,
  `redacao_alterada` text NOT NULL,
  `comentario_final` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `redacoes_escritas`
--

INSERT INTO `redacoes_escritas` (`id_red`, `nome_aluno`, `caminho_redacao`, `universidade_redacao`, `tema_redacao`, `tema_sem_acento`, `nome_corretor`, `id_corretor`, `id_aluno_redacao`, `status_corrigida`, `numero_redacoes_enviadas`, `tipo_redacao`, `texto_redacao_escrita`, `redacao_alterada`, `comentario_final`) VALUES
(1, 'aluno', 'vazio', 'Enem', 'A importância de um combate ao estresse causado pelo trabalho', 'A-importancia-de-um-combate-ao-estresse-causado-pelo-trabalho', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\r\n\r\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\n\n (2) Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\n\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ''),
(2, 'aluno', 'vazio', 'Enem', 'A nova política sobre drogas em questão no Brasil hoje', 'A-nova-politica-sobre-drogas-em-questao-no-Brasil-hoje', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\r\n\r\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\n (2) \nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\n\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex.  (3) Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ''),
(3, 'aluno', 'vazio', 'Enem', 'A questão do direito ao trabalho para os presos no Brasil hoje', 'A-questao-do-direito-ao-trabalho-para-os-presos-no-Brasil-hoje', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\r\n\r\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\n\n (2) Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\n\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ''),
(4, 'aluno', 'vazio', 'Fuvest', 'A mentira pode ser aceita pela sociedade?', 'A-mentira-pode-ser-aceita-pela-sociedade-', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\r\n\r\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\n\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ''),
(5, 'aluno', 'vazio', 'Unicamp', 'A educação pela bala', 'A-educacao-pela-bala', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\r\n\r\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque  (2) habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\n\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ''),
(6, 'aluno', 'vazio', 'Vunesp', 'A POLÍTICA DE COTAS PARA DEFICIENTES NAS EMPRESAS É ADEQUADA?', 'A-POLiTICA-DE-COTAS-PARA-DEFICIENTES-NAS-EMPRESAS-e-ADEQUADA-', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\r\n\r\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\n\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ''),
(7, 'aluno', 'vazio', 'Fuvest', 'A ausência do silêncio na sociedade contemporânea.', 'A-ausencia-do-silencio-na-sociedade-contemporanea.', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\r\n\r\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\n\n (2) Nunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ''),
(8, 'aluno', 'vazio', 'Unicamp', 'A educação pela bala', 'A-educacao-pela-bala', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\r\n\r\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\n\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ''),
(9, 'aluno', 'vazio', 'Vunesp', 'A EDUCAÇÃO SEXUAL DEVE SER TRATADA EM SALA DE AULA?', 'A-EDUCAcaO-SEXUAL-DEVE-SER-TRATADA-EM-SALA-DE-AULA-', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\r\n\r\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce enim mi, pulvinar eu libero pellentesque, feugiat egestas ipsum. Cras arcu massa, dignissim in erat ac, congue tristique mi. Mauris a tellus malesuada, pulvinar leo vel, volutpat purus. Vestibulum laoreet quam sed augue mattis, sit amet sagittis diam eleifend. Integer eget tellus in urna dignissim laoreet. Pellentesque  (2) habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam at magna pharetra, scelerisque metus nec, convallis nibh. Aliquam erat volutpat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque pharetra urna ac leo malesuada, at vestibulum ligula finibus. Nullam malesuada sem vel nunc vehicula, nec tempus ipsum luctus. Integer blandit mattis dapibus. Proin tincidunt elit orci, ut dictum velit mattis ut. Ut vitae risus sit amet turpis tincidunt viverra eget a nunc. Vestibulum commodo libero eget purus volutpat interdum. In feugiat fermentum maximus.\n\nNunc sit amet metus commodo, commodo elit id, maximus neque. Quisque eget rutrum magna, ac laoreet dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla facilisi. Ut auctor eget augue sed efficitur. Aliquam mi magna, interdum id leo et, pellentesque luctus tortor. Cras ac sapien id leo egestas facilisis. Morbi tempus ultrices est. Nunc dictum lorem justo, tincidunt viverra risus rutrum ac. Etiam feugiat imperdiet tellus, at vehicula leo lobortis at. Morbi lacinia felis urna, eget facilisis felis eleifend eu. Maecenas euismod neque purus, vitae varius odio lacinia eu. Donec ornare hendrerit mauris vitae pharetra.', ''),
(10, 'aluno', 'vazio', 'Enem', 'Acidentes de trânsito no Brasil: um desafio que precisa ser vencido', 'Acidentes-de-transito-no-Brasil--um-desafio-que-precisa-ser-vencido', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum varius pharetra facilisis. Integer dignissim ultrices nulla ut scelerisque. Pellentesque aliquet pellentesque ipsum, et posuere dui auctor sed. Praesent ac faucibus erat, ac rutrum nisi. Quisque blandit facilisis nunc, at congue urna ornare et. Vivamus sed pulvinar nunc. Aliquam elit dui, imperdiet quis leo non, laoreet sagittis erat. Duis sed nisi eleifend, pellentesque sapien et, convallis ipsum. Etiam lectus lacus, aliquet consectetur urna vitae, blandit hendrerit odio.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi purus elit, tempor ac molestie vel, posuere vel nisl. Pellentesque massa tortor, tincidunt eu cursus eget, viverra eget tortor. Sed efficitur ligula in arcu consectetur, nec dapibus nunc suscipit. Suspendisse consequat in justo quis consequat. Nunc vitae justo a enim convallis hendrerit. Pellentesque et scelerisque erat. Nullam euismod vestibulum lacus, at bibendum ante molestie non. Vestibulum laoreet tempus odio, vel fermentum justo auctor id. Phasellus feugiat tincidunt semper. Phasellus sit amet felis interdum, maximus justo non, lobortis augue. Fusce vel elit non lectus blandit dictum congue fringilla nisl. Curabitur molestie mi vel varius gravida.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum varius pharetra facilisis. Integer dignissim ultrices nulla ut scelerisque. Pellentesque aliquet pellentesque ipsum, et posuere dui auctor sed. Praesent ac faucibus erat, ac rutrum nisi. Quisque blandit facilisis nunc, at congue urna ornare et. Vivamus sed pulvinar nunc. Aliquam elit dui, imperdiet quis leo non, laoreet sagittis erat. Duis sed nisi eleifend, pellentesque sapien et, convallis ipsum. Etiam lectus lacus, aliquet consectetur urna vitae, blandit hendrerit odio.\n\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi purus elit, tempor ac molestie vel, posuere vel nisl. Pellentesque massa tortor, tincidunt eu cursus eget, viverra eget tortor. Sed efficitur ligula in arcu consectetur, nec dapibus nunc suscipit. Suspendisse consequat in justo quis consequat. Nunc vitae justo a enim convallis hendrerit. Pellentesque et scelerisque erat. Nullam euismod vestibulum lacus, at bibendum ante molestie non. Vestibulum laoreet tempus odio, vel fermentum justo auctor id. Phasellus feugiat tincidunt semper. Phasellus sit amet felis interdum, maximus justo non, lobortis augue. Fusce vel elit non lectus blandit dictum congue fringilla nisl. Curabitur molestie mi vel varius gravida.', ''),
(11, 'aluno', 'vazio', 'Enem', 'A nova política sobre drogas em questão no Brasil hoje', 'A-nova-politica-sobre-drogas-em-questao-no-Brasil-hoje', 'corretor', 1, 1, 1, 1, 2, 'asdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssss.', ' (1) asdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssssasdadadasdasdasddsdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdssssssssssssssssssssssssssssssssssssssss.', 'comnetário final teste'),
(12, 'aluno', 'vazio', 'Enem', 'A redução da maioridade penal em questão no Brasil hoje', 'A-reducao-da-maioridade-penal-em-questao-no-Brasil-hoje', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\r\n\r\n\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\r\n\r\n\r\n\r\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\n\n\n (2) \nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\n\n\n\n (3) Integer volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', 'comentário 1'),
(13, 'aluno', 'vazio', 'Enem', 'Flexibilização do acesso às armas de fogo no Brasil, uma questão controversa', 'Flexibilizacao-do-acesso-as-armas-de-fogo-no-Brasil,-uma-questao-controversa', 'corretor', 1, 1, 1, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\r\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', ' (1) Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis egestas quam eu ultrices ullamcorper. Etiam hendrerit tristique dui, non ornare arcu vulputate tempus. Donec hendrerit vel neque eu consequat. Nulla ultrices arcu in gravida posuere. Aliquam et nisi sed nunc luctus imperdiet. Quisque et faucibus lorem. Ut dictum ex a mauris porta viverra. Nulla nibh turpis, faucibus quis urna vel, tempor dictum odio. Donec aliquam quam in tincidunt pretium. Fusce diam est, feugiat ac massa ut, lobortis luctus risus. Sed consectetur est a sem pulvinar pellentesque tincidunt ut mi. In viverra tortor eu metus pharetra tincidunt et vel urna.\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas congue augue nec lectus aliquet, sit amet suscipit risus placerat. Suspendisse bibendum sem mi, ut suscipit ligula commodo a. Sed bibendum quam ut nunc aliquam auctor sit amet at nisl. Aliquam aliquet, nibh id aliquam bibendum, nibh ligula tempor massa, ac sollicitudin enim elit quis leo. Aliquam nec porta nibh. Nullam facilisis id ipsum vel accumsan. Fusce erat massa, malesuada non mollis nec, laoreet eget justo. Mauris velit neque, imperdiet sit amet ligula eu, cursus mollis quam. Vestibulum porta volutpat sapien, non tincidunt quam eleifend at.\nInteger volutpat metus eleifend, venenatis sem sed, finibus nunc. Sed euismod sem ac dignissim sodales. Vivamus malesuada eget mauris ac dictum. Quisque a accumsan ante. Maecenas vitae porttitor tellus, eget consectetur ante. Ut feugiat, arcu ac placerat egestas, massa urna placerat odio, ut aliquet nunc lectus quis ex. Suspendisse condimentum dolor quis augue volutpat eleifend. In aliquet nisi sed mauris vehicula molestie.', 'comentário final da redação');
INSERT INTO `redacoes_escritas` (`id_red`, `nome_aluno`, `caminho_redacao`, `universidade_redacao`, `tema_redacao`, `tema_sem_acento`, `nome_corretor`, `id_corretor`, `id_aluno_redacao`, `status_corrigida`, `numero_redacoes_enviadas`, `tipo_redacao`, `texto_redacao_escrita`, `redacao_alterada`, `comentario_final`) VALUES
(14, 'aluno', 'vazio', 'Fuvest', 'A autonomia dos indivíduos é uma mera ilusão no mundo contemporâneo?', 'A-autonomia-dos-individuos-e-uma-mera-ilusao-no-mundo-contemporaneo-', 'corretor', 1, 1, 2, 1, 2, 'Led Zeppelin foi uma banda britânica de rock formada em Londres, em 1968. Consistia no guitarrista Jimmy Page, no vocalista Robert Plant, no baixista e tecladista John Paul Jones e no baterista John Bonham. Seu som pesado e violento de guitarra, enraizado no blues e música psicodélica de seus dois primeiros álbuns, é frequentemente reconhecido como um dos fundadores do heavy metal. Seu estilo foi inspirado em uma grande variedade de influências, incluindo a música folk, psicodélica e o blues.\r\n\r\nDepois de mudar seu antigo nome de New Yardbirds, o Led Zeppelin assinou um contrato favorável com a Atlantic Records, que lhes ofereceu uma considerável liberdade artística. O grupo não gostava de lançar suas canções como singles, pois viam os seus álbuns como indivisíveis e completas experiências de escuta. Embora inicialmente impopular com os críticos, o grupo conseguiu um impacto comercial significativo nas vendas com Led Zeppelin (1969), Led Zeppelin II (1969), Led Zeppelin III (1970), o quarto álbum sem título (1971), Houses of the Holy (1973), e Physical Graffiti (1975). O quarto álbum, com a música \"Stairway to Heaven\", está entre as obras mais populares e influentes do rock e ajudou a consolidar a popularidade do grupo.\r\n\r\nÁlbuns posteriores da banda visaram uma experimentação maior e foram acompanhados por extensos recordes e concertos que renderam à banda uma reputação pelos seus excessos e sua devassidão. Apesar de terem permanecido bem sucedidos comercialmente e criticamente, a sua produção e agenda de shows foram limitadas no final da década de 1970, e o grupo se desfez após a morte repentina de Bonham, em 1980. Desde então os membros sobreviventes esporadicamente colaboraram e participaram de raras reuniões juntos. A mais bem sucedida deles foi em 2007 no Ahmet Ertegun Tribute Concert, em Londres, com Jason Bonham no lugar de seu pai.', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `temas_redacao`
--

CREATE TABLE `temas_redacao` (
  `id_tema` int(11) NOT NULL,
  `nome_tema` varchar(255) NOT NULL,
  `nome_tema_sem_acento` varchar(255) NOT NULL,
  `modelo_tema` varchar(100) NOT NULL,
  `caminho_arquivo_tema` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `temas_redacao`
--

INSERT INTO `temas_redacao` (`id_tema`, `nome_tema`, `nome_tema_sem_acento`, `modelo_tema`, `caminho_arquivo_tema`) VALUES
(1, 'Tragédias ambientais no Brasil: a culpa estatal e a responsabilidade dos setores privados', 'Tragedias-ambientais-no-Brasil--a-culpa-estatal-e-a-responsabilidade-dos-setores-privados', 'Enem', 'arquivo_temas/tema_1_Enem.pdf'),
(2, 'Acidentes de trânsito no Brasil: um desafio que precisa ser vencido', 'Acidentes-de-transito-no-Brasil--um-desafio-que-precisa-ser-vencido', 'Enem', 'arquivo_temas/idtema_2_Enem.pdf'),
(3, 'Flexibilização do acesso às armas de fogo no Brasil, uma questão controversa', 'Flexibilizacao-do-acesso-as-armas-de-fogo-no-Brasil,-uma-questao-controversa', 'Enem', 'arquivo_temas/idtema_3_Enem.pdf'),
(4, 'A questão do direito ao trabalho para os presos no Brasil hoje', 'A-questao-do-direito-ao-trabalho-para-os-presos-no-Brasil-hoje', 'Enem', 'arquivo_temas/idtema_4_Enem.pdf'),
(5, 'A redução da maioridade penal em questão no Brasil hoje', 'A-reducao-da-maioridade-penal-em-questao-no-Brasil-hoje', 'Enem', 'arquivo_temas/idtema_5_Enem.pdf'),
(6, 'Tragédias representadas pelas enchentes nas grandes cidades, um mal que precisa ser evitado', 'Tragedias-representadas-pelas-enchentes-nas-grandes-cidades,-um-mal-que-precisa-ser-evitado', 'Enem', 'arquivo_temas/idtema_6_Enem.pdf'),
(7, 'Massacres em escolas brasileiras, mal que exige uma urgente prevenção', 'Massacres-em-escolas-brasileiras,-mal-que-exige-uma-urgente-prevencao', 'Enem', 'arquivo_temas/idtema_7_Enem.pdf'),
(8, 'População em situação de rua, um urgente desafio a ser enfrentado pelo Brasil hoje', 'Populacao-em-situacao-de-rua,-um-urgente-desafio-a-ser-enfrentado-pelo-Brasil-hoje', 'Enem', 'arquivo_temas/idtema_8_Enem.pdf'),
(9, 'A importância de um combate ao estresse causado pelo trabalho', '-A-importancia-de-um-combate-ao-estresse-causado-pelo-trabalho', 'Enem', 'arquivo_temas/idtema_9_Enem.pdf'),
(10, 'Os males representados pela pobreza e a urgência de combatê-la no Brasil', 'Os-males-representados-pela-pobreza-e-a-urgencia-de-combate-la-no-Brasil', 'Enem', 'arquivo_temas/idtema_10_Enem.pdf'),
(11, 'A nova política sobre drogas em questão no Brasil hoje', 'A-nova-politica-sobre-drogas-em-questao-no-Brasil-hoje', 'Enem', 'arquivo_temas/idtema_11_Enem.pdf'),
(12, 'Mulheres encampam empoderamento feminino com armas após decreto de Bolsonaro', 'Mulheres-encampam-empoderamento-feminino-com-armas-apos-decreto-de-Bolsonaro', 'Unicamp', 'arquivo_temas/idtema_12_Unicamp.pdf'),
(13, 'Resposta à pergunta: O que é Esclarecimento?', 'Resposta-a-pergunta--O-que-e-Esclarecimento-', 'Unicamp', 'arquivo_temas/idtema_13_Unicamp.pdf'),
(14, 'Iguais diante da lei?', 'Iguais-diante-da-lei-', 'Unicamp', 'arquivo_temas/idtema_14_Unicamp.pdf'),
(15, 'Maioria quer redução da maioridade penal de 18 para 16 anos, segundo Datafolha', 'Maioria-quer-reducao-da-maioridade-penal-de-18-para-16-anos,-segundo-Datafolha', 'Unicamp', 'arquivo_temas/idtema_15_Unicamp.pdf'),
(16, 'Distância tem cura', 'Distancia-tem-cura', 'Unicamp', 'arquivo_temas/idtema_16_Unicamp.pdf'),
(17, 'A educação pela bala', 'A-educacao-pela-bala', 'Unicamp', 'arquivo_temas/idtema_17_Unicamp.pdf'),
(18, 'Equívocos superiores', 'Equivocos-superiores', 'Unicamp', 'arquivo_temas/idtema_18_Unicamp.pdf'),
(19, 'O que é solidariedade?', 'O-que-e-solidariedade-', 'Unicamp', 'arquivo_temas/idtema_19_Unicamp.pdf'),
(20, 'Se redução de imposto elevar consumo de cigarro, medida será descartada, diz Moro', 'Se-reducao-de-imposto-elevar-consumo-de-cigarro,-medida-sera-descartada,-diz-Moro', 'Unicamp', 'arquivo_temas/idtema_20_Unicamp.pdf'),
(21, 'O desafio das drogas', 'O-desafio-das-drogas', 'Unicamp', 'arquivo_temas/idtema_21_Unicamp.pdf'),
(22, 'A mentira pode ser aceita pela sociedade?', 'A-mentira-pode-ser-aceita-pela-sociedade-', 'Fuvest', 'arquivo_temas/idtema_22_Fuvest.pdf'),
(23, 'A autonomia dos indivíduos é uma mera ilusão no mundo contemporâneo?', 'A-autonomia-dos-individuos-e-uma-mera-ilusao-no-mundo-contemporaneo-', 'Fuvest', 'arquivo_temas/idtema_23_Fuvest.pdf'),
(24, 'A sociedade brasileira está vivendo uma crise de valores morais?', 'A-sociedade-brasileira-esta-vivendo-uma-crise-de-valores-morais-', 'Fuvest', 'arquivo_temas/idtema_24_Fuvest.pdf'),
(25, 'A ciência e a tecnologia acarretam sempre necessariamente a felicidade dos seres humanos?', 'A-ciencia-e-a-tecnologia-acarretam-sempre-necessariamente-a-felicidade-dos-seres-humanos-', 'Fuvest', 'arquivo_temas/idtema_25_Fuvest.pdf'),
(26, 'A ausência do silêncio na sociedade contemporânea.', 'A-ausencia-do-silencio-na-sociedade-contemporanea.', 'Fuvest', 'arquivo_temas/idtema_26_Fuvest.pdf'),
(27, 'O ato de ofender alguém deve ser compreendido como liberdade de expressão?', 'O-ato-de-ofender-alguem-deve-ser-compreendido-como-liberdade-de-expressao-', 'Fuvest', 'arquivo_temas/idtema_27_Fuvest.pdf'),
(28, 'O Brasil do século XXI, entre a civilização e a barbárie.', 'O-Brasil-do-seculo-XXI,-entre-a-civilizacao-e-a-barbarie.', 'Fuvest', 'arquivo_temas/idtema_28_Fuvest.pdf'),
(29, 'A EDUCAÇÃO SEXUAL DEVE SER TRATADA EM SALA DE AULA?', 'A-EDUCAcaO-SEXUAL-DEVE-SER-TRATADA-EM-SALA-DE-AULA-', 'Vunesp', 'arquivo_temas/idtema_29_Vunesp.pdf'),
(30, 'É CORRETA A CRIMINALIZAÇÃO DA HOMOFOBIA NO BRASIL?', 'e-CORRETA-A-CRIMINALIZAcaO-DA-HOMOFOBIA-NO-BRASIL-', 'Vunesp', 'arquivo_temas/idtema_30_Vunesp.pdf'),
(31, 'A TELEMEDICINA PODE REPRESENTAR AVANÇOS À SAÚDE DO PAÍS?', 'A-TELEMEDICINA-PODE-REPRESENTAR-AVANcOS-a-SAuDE-DO-PAiS-', 'Vunesp', 'arquivo_temas/idtema_31_Vunesp.pdf'),
(32, 'FAZ SENTIDO HAVER IDADES DIFERENTES PARA APOSENTADORIAS DE HOMENS E MULHERES?', 'FAZ-SENTIDO-HAVER-IDADES-DIFERENTES-PARA-APOSENTADORIAS-DE-HOMENS-E-MULHERES-', 'Vunesp', 'arquivo_temas/idtema_32_Vunesp.pdf'),
(33, 'A POLÍTICA DE COTAS PARA DEFICIENTES NAS EMPRESAS É ADEQUADA?', 'A-POLiTICA-DE-COTAS-PARA-DEFICIENTES-NAS-EMPRESAS-e-ADEQUADA-', 'Vunesp', 'arquivo_temas/idtema_33_Vunesp.pdf'),
(34, 'A REDUÇÃO DA TRIBUTAÇÃO DO CIGARRO É UMA MEDIDA CORRETA?', 'A-REDUcaO-DA-TRIBUTAcaO-DO-CIGARRO-e-UMA-MEDIDA-CORRETA-', 'Vunesp', 'arquivo_temas/idtema_34_Vunesp.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_planos`
--

CREATE TABLE `tipos_planos` (
  `id_tipo_plano` int(11) NOT NULL,
  `nome_plano` varchar(50) NOT NULL,
  `preco` float(5,2) NOT NULL,
  `caracteristicas` varchar(255) NOT NULL,
  `limite_redacao_por_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipos_planos`
--

INSERT INTO `tipos_planos` (`id_tipo_plano`, `nome_plano`, `preco`, `caracteristicas`, `limite_redacao_por_aluno`) VALUES
(1, 'Enem Básico', 27.00, 'car 1', 3),
(2, 'Enem Mais', 70.00, 'car 2', 10),
(3, 'Unicamp', 50.00, 'car 3', 5),
(4, 'Uniamp Mais', 80.00, 'car 4', 10),
(5, 'Fuvest/Unesp', 64.00, 'car 5', 8),
(6, 'Temas Vocacionados: Medicina e áreas da saúde', 64.00, 'car 6', 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `universidades`
--

CREATE TABLE `universidades` (
  `id_universidade` int(11) NOT NULL,
  `nome_universidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `universidades`
--

INSERT INTO `universidades` (`id_universidade`, `nome_universidade`) VALUES
(1, 'Unicamp'),
(2, 'Fuvest'),
(3, 'Enem'),
(4, 'Vunesp');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`identificador_carrinho`);

--
-- Índices para tabela `dados_corretor`
--
ALTER TABLE `dados_corretor`
  ADD PRIMARY KEY (`id_corretor`);

--
-- Índices para tabela `escola`
--
ALTER TABLE `escola`
  ADD PRIMARY KEY (`id_escola`);

--
-- Índices para tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`identificador_pagamento`);

--
-- Índices para tabela `redacoes_enviadas`
--
ALTER TABLE `redacoes_enviadas`
  ADD PRIMARY KEY (`id_red`);

--
-- Índices para tabela `redacoes_escritas`
--
ALTER TABLE `redacoes_escritas`
  ADD PRIMARY KEY (`id_red`);

--
-- Índices para tabela `temas_redacao`
--
ALTER TABLE `temas_redacao`
  ADD PRIMARY KEY (`id_tema`);

--
-- Índices para tabela `tipos_planos`
--
ALTER TABLE `tipos_planos`
  ADD PRIMARY KEY (`id_tipo_plano`);

--
-- Índices para tabela `universidades`
--
ALTER TABLE `universidades`
  ADD PRIMARY KEY (`id_universidade`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `identificador_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `dados_corretor`
--
ALTER TABLE `dados_corretor`
  MODIFY `id_corretor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `id_escola` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `identificador_pagamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redacoes_enviadas`
--
ALTER TABLE `redacoes_enviadas`
  MODIFY `id_red` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `redacoes_escritas`
--
ALTER TABLE `redacoes_escritas`
  MODIFY `id_red` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `temas_redacao`
--
ALTER TABLE `temas_redacao`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `tipos_planos`
--
ALTER TABLE `tipos_planos`
  MODIFY `id_tipo_plano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `universidades`
--
ALTER TABLE `universidades`
  MODIFY `id_universidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
