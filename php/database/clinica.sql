-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 25, 2024 at 10:02 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinica`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultas`
--

DROP TABLE IF EXISTS `consultas`;
CREATE TABLE IF NOT EXISTS `consultas` (
  `id_consulta` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `data_consulta` date DEFAULT NULL,
  `hora_consulta` time DEFAULT NULL,
  `notas_obs` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `fk_pacConsulta` (`id_paciente`),
  KEY `fk_medConsulta` (`id_medico`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `id_paciente`, `id_medico`, `data_consulta`, `hora_consulta`, `notas_obs`) VALUES
(77, 14, 9, '2024-10-21', '14:00:00', 'Renovação de baixa médica.'),
(80, 11, 9, '2024-11-20', '14:30:00', 'Verificação de dados para primeira consulta.'),
(5, 1, 3, '2024-09-20', '09:30:00', 'Revisão de exame de sangue.'),
(6, 2, 5, '2024-09-21', '10:00:00', 'Consulta de rotina.'),
(7, 3, 7, '2024-09-22', '11:15:00', 'Dor lombar, solicitar raio-X'),
(8, 4, 2, '2024-09-23', '14:30:00', 'Acompanhamento de diabetes.'),
(9, 5, 6, '2024-09-24', '08:45:00', 'Dores de cabeça recorrentes.'),
(10, 6, 8, '2024-09-25', '13:00:00', 'Avaliação de pressão alta.'),
(76, 11, 9, '2024-11-04', '10:00:00', 'Verificar resultados de análises.'),
(12, 8, 4, '2024-09-27', '16:30:00', 'Avaliação pós-cirurgia.'),
(13, 9, 9, '2024-09-28', '09:00:00', 'Consulta de ortopedia.'),
(14, 10, 10, '2024-09-29', '12:00:00', 'Revisão de exames laboratoriais.'),
(15, 11, 11, '2024-09-30', '10:30:00', 'Consulta ginecológica.'),
(16, 12, 12, '2024-10-01', '14:00:00', 'Consulta para dor abdominal.'),
(17, 13, 13, '2024-10-02', '08:30:00', 'Avaliação de alergias.'),
(18, 14, 14, '2024-10-03', '09:45:00', 'Avaliação pós-tratamento.'),
(19, 15, 15, '2024-10-04', '11:00:00', 'Acompanhamento pós-COVID.'),
(84, 15, 9, '2024-11-30', '10:00:00', 'Consulta para marcar exames.'),
(83, 9, 9, '2024-11-13', '12:00:00', 'Primeira Consulta.'),
(81, 5, 7, '2024-11-20', '10:13:00', 'Checkup - análises.'),
(79, 14, 9, '2024-11-19', '17:17:00', 'Resultados de análises ao sangue.'),
(78, 12, 9, '2024-11-11', '14:30:00', 'Análises de checkup.'),
(74, 13, 1, '2024-10-12', '08:40:00', 'Resultados de exames'),
(73, 18, 1, '2024-11-01', '13:40:00', 'Análises de checkup.'),
(72, 6, 1, '2024-11-27', '17:45:00', 'Renovação de baixa.'),
(71, 11, 1, '2024-10-31', '20:19:00', 'Análises médicas.'),
(70, 3, 1, '2024-10-21', '18:13:00', 'Exames.'),
(69, 9, 1, '2024-10-29', '13:05:00', 'Alteração de medicação.'),
(75, 1, 9, '2024-10-31', '09:40:00', 'Consulta para marcar exames.'),
(67, 2, 0, '2024-09-29', '18:41:00', 'Nova consulta de rotina.'),
(64, 1, 25, '2024-09-29', '13:44:00', 'Checkup.'),
(65, 1, 25, '2024-09-29', '13:44:00', 'Checkup.'),
(66, 2, 25, '2024-09-30', '07:49:00', 'Check rotina.');

-- --------------------------------------------------------

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id_especialidade` int NOT NULL AUTO_INCREMENT,
  `nome_especialidade` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_especialidade`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `especialidades`
--

INSERT INTO `especialidades` (`id_especialidade`, `nome_especialidade`) VALUES
(1, 'Pediatria'),
(2, 'Dermatologia'),
(3, 'Psiquiatria'),
(4, 'Cardiologia'),
(5, 'Nutrição'),
(6, 'Psicologia'),
(7, 'Obstetrícia'),
(8, 'Cirurgia'),
(9, 'Neurologia');

-- --------------------------------------------------------

--
-- Table structure for table `medicos`
--

DROP TABLE IF EXISTS `medicos`;
CREATE TABLE IF NOT EXISTS `medicos` (
  `id_medico` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  `id_especialidade` int DEFAULT NULL,
  `contato` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_medico`),
  KEY `fk_espMedico` (`id_especialidade`),
  KEY `fk_user_id_medico` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`id_medico`, `nome`, `apelido`, `id_especialidade`, `contato`, `email`, `user_id`) VALUES
(1, 'Petra', 'Vasconcelos', 2, '929128391', 'petra.v@gmail.com', 25),
(2, 'Jorge', 'Monteiro', 4, '+351912391421', 'jorge.m@gmail.com', 26),
(3, 'Mariana', 'Loureiro', 1, '+351921384274', 'mariana@gmail.com', 27),
(4, 'Luís', 'Gameiro', 3, '+35192832745', 'lgameiro@gmail.com', 28),
(5, 'Nuno', 'Silva', 5, '+351932874351', 'nunosilva@gmail.com', 29),
(6, 'Susana', 'Monteiro', 7, '+35191732564', 'susanam@gmail.com', 30),
(7, 'Bruna', 'Rogério', 6, '+351913467558', 'brunarogerio@gmail.com', 31),
(8, 'Godinho', 'Sousa', 8, '+351938756431', 'godinho@gmail.com', 32),
(9, 'Amaral', 'Pinheiro', 9, '+351927438191', 'amaralpinheiro@gmail.com', 33),
(10, 'Carlos', 'Ferreira', 1, '912345678', 'carlos.ferreira@hospital.com', 12),
(11, 'Ana', 'Moreira', 2, '913456789', 'ana.moreira@hospital.com', 13),
(12, 'Pedro', 'Oliveira', 3, '914567890', 'pedro.oliveira@hospital.com', 14),
(13, 'Mariana', 'Costa', 4, '915678901', 'mariana.costa@hospital.com', 15),
(14, 'Rui', 'Martins', 5, '916789012', 'rui.martins@hospital.com', 16),
(15, 'Joana', 'Silva', 6, '917890123', 'joana.silva@hospital.com', 17),
(16, 'Manuel', 'Gomes', 7, '918901234', 'manuel.gomes@hospital.com', 18),
(17, 'Sofia', 'Pereira', 8, '919012345', 'sofia.pereira@hospital.com', 19),
(18, 'Miguel', 'Santos', 9, '910123456', 'miguel.santos@hospital.com', 20);

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `sexo` enum('M','F') DEFAULT NULL,
  `contato` varchar(15) DEFAULT NULL,
  `morada` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nome`, `apelido`, `data_nascimento`, `sexo`, `contato`, `morada`, `email`, `user_id`) VALUES
(1, 'Mateus', 'Oliveira', '1989-03-09', 'M', '+351919838282', 'Rua do Canto, 19, Coimbra', 'm.oliveira@gmail.com', 21),
(2, 'Sofia', 'Barbosa', '1978-11-02', 'F', '+351929818299', 'Praceta Luis, 12, Leiria', 'sofia.b@gmail.com', 22),
(3, 'Maria', 'Helena', '1967-12-11', 'F', '+351939282812', 'Rua Cooperativa, 11, Leiria', 'maria.helena@gmail.com', 23),
(4, 'João', 'Costa', '1991-05-09', 'M', '+351913828399', 'Rua do Marquês, 29, Marrazes', 'joaocosta@gmail.com', 24),
(5, 'Ana', 'Silva', '1990-02-15', 'F', '912345678', 'Rua das Flores, 123', 'ana.silva@example.com', 1),
(6, 'João', 'Pereira', '1985-08-20', 'M', '933456789', 'Avenida do Mar, 45', 'joao.pereira@example.com', 2),
(7, 'Maria', 'Santos', '1975-11-03', 'F', '914567891', 'Rua das Árvores, 56', 'maria.santos@example.com', 3),
(8, 'Carlos', 'Fernandes', '1992-07-10', 'M', '915678123', 'Praça do Comércio, 78', 'carlos.fernandes@example.com', 4),
(9, 'Lucia', 'Rodrigues', '1988-05-25', 'F', '916789234', 'Rua da Praia, 91', 'lucia.rodrigues@example.com', 5),
(10, 'Pedro', 'Martins', '1993-12-05', 'M', '917890123', 'Rua da Estação, 23', 'pedro.martins@example.com', 6),
(11, 'Beatriz', 'Almeida', '1987-09-14', 'F', '918901234', 'Rua da Liberdade, 76', 'beatriz.almeida@example.com', 7),
(12, 'Miguel', 'Costa', '1981-04-18', 'M', '919012345', 'Rua do Sol, 88', 'miguel.costa@example.com', 8),
(13, 'Carla', 'Oliveira', '1995-03-30', 'F', '910123456', 'Avenida da República, 102', 'carla.oliveira@example.com', 9),
(14, 'Fernando', 'Lopes', '1979-01-09', 'M', '911234567', 'Rua do Mercado, 67', 'fernando.lopes@example.com', 10),
(15, 'Sara', 'Vieira', '1990-11-22', 'F', '912345678', 'Rua do Parque, 41', 'sara.vieira@example.com', 11),
(18, 'Tatiana', 'Sousa', '1994-09-03', 'F', '919191212', 'Rua da Praça, 123, Leiria', 't.sousa@email.com', 34);

-- --------------------------------------------------------

--
-- Table structure for table `prescricoes`
--

DROP TABLE IF EXISTS `prescricoes`;
CREATE TABLE IF NOT EXISTS `prescricoes` (
  `id_prescricao` int NOT NULL AUTO_INCREMENT,
  `id_consulta` int DEFAULT NULL,
  `nome_medicamento` varchar(100) DEFAULT NULL,
  `dosagem` varchar(50) DEFAULT NULL,
  `frequencia` varchar(50) DEFAULT NULL,
  `duracao` varchar(50) DEFAULT NULL,
  `instrucoes` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_prescricao`),
  KEY `fk_consPre` (`id_consulta`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prescricoes`
--

INSERT INTO `prescricoes` (`id_prescricao`, `id_consulta`, `nome_medicamento`, `dosagem`, `frequencia`, `duracao`, `instrucoes`) VALUES
(1, 2, 'Verquvo', '2 comprimidos', '2 vezes por dia', '1 ano', 'Cuidado com alimentação'),
(2, 1, 'Uriage', 'Aplicar creme.', '3 vezes por dia', '1 mês', 'Não irritar a pele'),
(3, 3, 'Pulmiben', '1 dose xarope', '2 vezes por dia', '2 semanas', ''),
(4, 4, 'Doloron', '2 comprimidos', '2 vezes por dia', '1 mês', ''),
(5, 1, 'Paracetamol', '500mg', '2 vezes por dia', '5 dias', 'Tomar após as refeições.'),
(6, 2, 'Ibuprofeno', '400mg', '3 vezes por dia', '7 dias', 'Tomar com um copo de água.'),
(7, 3, 'Omeprazol', '20mg', '1 vez por dia', '14 dias', 'Tomar em jejum.'),
(8, 4, 'Metformina', '850mg', '2 vezes por dia', '30 dias', 'Tomar de manhã e à noite.'),
(9, 5, 'Aspirina', '100mg', '1 vez por dia', 'indeterminado', 'Tomar de manhã.'),
(10, 6, 'Lisinopril', '10mg', '1 vez por dia', '30 dias', 'Tomar à noite.'),
(11, 7, 'Atorvastatina', '20mg', '1 vez por dia', '30 dias', 'Tomar antes de dormir.'),
(12, 8, 'Azitromicina', '500mg', '1 vez por dia', '3 dias', 'Tomar uma hora antes das refeições.'),
(13, 9, 'Diclofenaco', '50mg', '2 vezes por dia', '10 dias', 'Tomar com alimentos.'),
(14, 10, 'Levotiroxina', '50mcg', '1 vez por dia', 'indeterminado', 'Tomar em jejum.'),
(15, 64, 'Paracetamol Soluvel', '1', '1 vez por dia', '1 semana', ''),
(16, 7, 'Brufen Soluvel', '1 Saqueta', '1 vez por dia', '1 semana', 'Aumentar para 2 saquetas se dor persistir'),
(17, 7, 'Aspirina', '1', '2 vezes por dia', '2 semanas', 'Marcar nova consulta se dor não aliviar.'),
(18, 7, 'Tramadol', '3 comprimidos', '2 vezes por dia', '1 ano', 'Tomar com um copo de água.'),
(19, 77, 'Descontran', '2 comprimidos', '1 vez por dia', '1 semana', 'Ir a consulta se a dor persistir.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'ana.silva', 'senha123'),
(2, 'joao.pereira', 'joao2024'),
(3, 'maria.santos', 'maria1975'),
(4, 'carlos.fernandes', 'carfern123'),
(5, 'lucia.rodrigues', 'lucia88'),
(6, 'pedro.martins', 'pedro93'),
(7, 'beatriz.almeida', 'beatriz1987'),
(8, 'miguel.costa', 'miguel81'),
(9, 'carla.oliveira', 'carla1995'),
(10, 'fernando.lopes', 'fernando1979'),
(11, 'sara.vieira', 'sara2024'),
(12, 'admin.carlos', 'carlosAdmin2024'),
(13, 'admin.ana', 'anaAdmin2024'),
(14, 'admin.pedro', 'pedroAdmin2024'),
(15, 'admin.mariana', 'marianaAdmin2024'),
(16, 'admin.rui', 'ruiAdmin2024'),
(17, 'admin.joana', 'joanaAdmin2024'),
(18, 'admin.manuel', 'manuelAdmin2024'),
(19, 'admin.sofia', 'sofiaAdmin2024'),
(20, 'admin.miguel', 'miguelAdmin2024'),
(21, 'm.oliveira@gmail.com', 'mateus123'),
(22, 'sofia.b@gmail.com', 'sofia1978'),
(23, 'maria.helena@gmail.com', 'maria1967'),
(24, 'joaocosta@gmail.com', 'joao1991'),
(25, 'admin.petra', 'petra2024'),
(26, 'admin.jorge', 'jorge2024'),
(27, 'admin.loureiro', 'mariana2024'),
(28, 'admin.luis', 'luis2024'),
(29, 'admin.nuno', 'nuno2024'),
(30, 'admin.susana', 'susana2024'),
(31, 'admin.bruna', 'bruna2024'),
(32, 'admin.godinho', 'godinho2024'),
(33, 'admin.amaral', 'amaral2024'),
(35, 'elvira.cardosa', 'elvira2024'),
(34, 'tatiana.sousa', 'pass123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
