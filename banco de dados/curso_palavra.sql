-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Mar-2020 às 23:18
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
(1, 'aluno1', 'aluno1@gmail.com', '475.644.788-02', '123', 'individual', 0, 3, 5, 1),
(2, 'vitor', 'vitor@gmail.com', NULL, '123', 'escola', 1, 0, 10, 0),
(3, 'a1', 'a1@gmail.com', '2', '123', 'individual', 0, 1, 3, 1),
(4, 'a2', 'a2@gmail.com', '3', '123', 'individual', 0, 2, 10, 1),
(5, 'a3', 'a3@gmail.com', '4', '123', 'individual', 0, 3, 5, 1),
(6, 'a4', 'a4@gmail.com', '5', '123', 'individual', 0, 4, 10, 1),
(7, 'a6', 'a6@gmail.com', '6', '123', 'individual', 0, 5, 8, 1),
(8, 'a7', 'a7@gmail.com', '7', '123', 'individual', 0, 6, 8, 1),
(9, 'aluno_obj1', 'aluno_obj1@gmail.com', NULL, '123', 'colégio objetivo santos', 2, 7, 5, 0);

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
(1, 3, 1, '50', 1, '2020-03-16 23:14:03'),
(2, 1, 3, '27', 1, '2020-03-25 01:44:35'),
(3, 2, 4, '70', 1, '2020-03-25 01:44:57'),
(4, 3, 5, '50', 1, '2020-03-25 01:45:13'),
(5, 4, 6, '80', 1, '2020-03-25 01:45:24'),
(6, 5, 7, '64', 1, '2020-03-25 01:45:36'),
(7, 6, 8, '64', 1, '2020-03-25 01:45:49');

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
(1, 'corretor', 'corretor@gmail.com', '123', '123.456.789.98', 0);

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

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`id_escola`, `nome_escola`, `email_escola`, `senha_escola`, `qtd_aluno_escola`, `limite_redacao_aluno`) VALUES
(1, 'escola', 'escola@gmail.com', '123', 20, 10),
(2, 'colégio objetivo santos', 'colegio_objetivo_santos@gmail.com', '123', 300, 5);

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
(1, 'aluno1', 'vazio', 'Fuvest', 'A ausÃªncia do silÃªncio na sociedade contemporÃ¢nea.', 'A-ausa?ncia-do-sila?ncio-na-sociedade-contempora?nea.', 'corretor', 1, 1, 2, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac massa sodales, consectetur eros et, egestas risus. Aenean tortor quam, consequat et sodales id, tincidunt ut eros. In eget bibendum diam. Nullam quis ligula eu dui sagittis sodales. Nunc pretium iaculis dolor. Cras sem odio, finibus at sagittis vel, mattis nec nisi. Quisque placerat rhoncus cursus. Morbi ut augue nunc. Ut ac orci sem. Nam lectus augue, sagittis et aliquam sed, sodales sit amet lectus. Curabitur porta ligula in quam aliquet, quis laoreet dui pulvinar. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit.\r\n\r\nSuspendisse aliquam mollis turpis, ut sollicitudin mauris semper nec. Nam sed felis turpis. Donec dignissim massa vitae maximus sagittis. Aenean efficitur placerat ligula, id ultrices eros congue a. Fusce pretium gravida neque, nec sagittis magna. In eu laoreet lectus, et dictum augue. Cras sed efficitur turpis. Etiam tincidunt nibh vel arcu pretium, eu sollicitudin purus blandit.\r\n\r\nSed interdum scelerisque justo, ac ultricies ante iaculis sed. Maecenas suscipit tortor ac pretium fermentum. Proin diam ante, fringilla quis orci nec, tempor dapibus nulla. Cras est magna, egestas ut viverra et, sodales a risus. Fusce pulvinar, est quis volutpat gravida, mauris dolor consectetur felis, a vulputate sem tortor nec lacus. Curabitur malesuada tellus velit, ut interdum tellus pellentesque eleifend. Nunc sodales dapibus lorem non viverra.', '', '');

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
(27, 'O ato de ofender alguém deve ser compreendido como liberdade de expressão?', 'O-ato-de-ofender-alguem-deve-ser-compreendido-como-liberdade-de-expressao-', 'Fuvest', 'arquivo_temas/idtema_27_Fuvest.pdf'),
(29, 'A EDUCAÇÃO SEXUAL DEVE SER TRATADA EM SALA DE AULA?', 'A-EDUCAcaO-SEXUAL-DEVE-SER-TRATADA-EM-SALA-DE-AULA-', 'Vunesp', 'arquivo_temas/idtema_29_Vunesp.pdf'),
(30, 'É CORRETA A CRIMINALIZAÇÃO DA HOMOFOBIA NO BRASIL?', 'e-CORRETA-A-CRIMINALIZAcaO-DA-HOMOFOBIA-NO-BRASIL-', 'Vunesp', 'arquivo_temas/idtema_30_Vunesp.pdf'),
(31, 'A TELEMEDICINA PODE REPRESENTAR AVANÇOS À SAÚDE DO PAÍS?', 'A-TELEMEDICINA-PODE-REPRESENTAR-AVANcOS-a-SAuDE-DO-PAiS-', 'Vunesp', 'arquivo_temas/idtema_31_Vunesp.pdf'),
(32, 'FAZ SENTIDO HAVER IDADES DIFERENTES PARA APOSENTADORIAS DE HOMENS E MULHERES?', 'FAZ-SENTIDO-HAVER-IDADES-DIFERENTES-PARA-APOSENTADORIAS-DE-HOMENS-E-MULHERES-', 'Vunesp', 'arquivo_temas/idtema_32_Vunesp.pdf'),
(33, 'A POLÍTICA DE COTAS PARA DEFICIENTES NAS EMPRESAS É ADEQUADA?', 'A-POLiTICA-DE-COTAS-PARA-DEFICIENTES-NAS-EMPRESAS-e-ADEQUADA-', 'Vunesp', 'arquivo_temas/idtema_33_Vunesp.pdf'),
(34, 'A REDUÇÃO DA TRIBUTAÇÃO DO CIGARRO É UMA MEDIDA CORRETA?', 'A-REDUcaO-DA-TRIBUTAcaO-DO-CIGARRO-e-UMA-MEDIDA-CORRETA-', 'Vunesp', 'arquivo_temas/idtema_34_Vunesp.pdf'),
(35, 'novo tema usp', 'novo-tema-usp', 'Fuvest', 'arquivo_temas/idtema_35_Fuvest.pdf'),
(38, 'titulo 1 objetivo', 'titulo-1-objetivo', 'Objetivo', 'arquivo_temas/idtema_36_Objetivo.pdf');

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
(4, 'Unicamp Mais', 80.00, 'car 4', 10),
(5, 'Fuvest/Unesp', 64.00, 'car 5', 8),
(6, 'Temas Vocacionados: Medicina e áreas da saúde', 64.00, 'car 6', 8),
(7, 'Objetivo', 0.00, 'car 1', 5);

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
(4, 'Vunesp'),
(6, 'Objetivo');

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
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `identificador_carrinho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `dados_corretor`
--
ALTER TABLE `dados_corretor`
  MODIFY `id_corretor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `escola`
--
ALTER TABLE `escola`
  MODIFY `id_escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_red` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `temas_redacao`
--
ALTER TABLE `temas_redacao`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `tipos_planos`
--
ALTER TABLE `tipos_planos`
  MODIFY `id_tipo_plano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `universidades`
--
ALTER TABLE `universidades`
  MODIFY `id_universidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
