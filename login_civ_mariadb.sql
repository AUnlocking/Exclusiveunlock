--
-- Database: `login_civ_mariadb`
--
DROP DATABASE IF EXISTS `login_civ_mariadb`;
CREATE DATABASE IF NOT EXISTS `login_civ_mariadb` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `login_civ_mariadb`;

-- --------------------------------------------------------

--
-- Table structure for table `ajx_posts`
--

DROP TABLE IF EXISTS `ajx_posts`;
CREATE TABLE IF NOT EXISTS `ajx_posts` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `fc_post` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `act_post` tinyint(4) NOT NULL DEFAULT 1,
  `nom_post` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL,
  `desc_post` varchar(512) COLLATE utf8_spanish_ci DEFAULT NULL,
  `img_post` varchar(180) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'default_post.svg',
  `slug_post` varchar(120) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'none-s',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `ajx_posts`
--

INSERT INTO `ajx_posts` (`id_post`, `fc_post`, `act_post`, `nom_post`, `desc_post`, `img_post`, `slug_post`, `user_id`) VALUES
(2, '2020-12-06 03:32:37', 0, 'Extensión de gnome-shell que no te deben faltar', '', 'default_post.svg', 'post-2', 2),
(3, '2020-12-06 03:32:37', 0, 'Cambiando imagen del login de fedora', '', 'default_post.svg', 'post-3', 2),
(4, '2020-12-06 03:32:37', 0, 'Cambiando íconos en fedora 20', '', 'default_post.svg', 'post-4', 2),
(5, '2020-12-06 03:32:37', 0, 'Optimizar el peso de archivos pdf', '', 'default_post.svg', 'post-5', 2),
(6, '2020-12-06 03:32:37', 0, 'Una consola elegante...', '', 'default_post.svg', 'post-6', 2),
(8, '2020-12-06 03:32:37', 0, 'Hacer que una maquina virtual detecte USB fedora 20', '', 'default_post.svg', 'post-8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `name` varchar(100) NOT NULL COMMENT 'Name',
  `type` varchar(255) NOT NULL COMMENT 'file type',
  `ext` varchar(30) NOT NULL DEFAULT 'png',
  `size` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Created date',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1 COMMENT='demo table';

--
-- Table structure for table `resets`
--

DROP TABLE IF EXISTS `resets`;
CREATE TABLE IF NOT EXISTS `resets` (
  `id_res` int(11) NOT NULL AUTO_INCREMENT,
  `fc_res` timestamp NOT NULL DEFAULT current_timestamp(),
  `uuid` varchar(255) COLLATE latin1_spanish_ci DEFAULT NULL,
  `fe_res` varchar(523) COLLATE latin1_spanish_ci DEFAULT NULL,
  `edo_res` int(11) DEFAULT 0,
  `ip_res` varchar(40) COLLATE latin1_spanish_ci DEFAULT '',
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_res`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `act_user` tinyint(4) NOT NULL DEFAULT 1,
  `fc_user` datetime NOT NULL DEFAULT current_timestamp(),
  `nom_user` varchar(200) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `firstname` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `lastname` varchar(50) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `resets`
--
ALTER TABLE `resets`
  ADD CONSTRAINT `resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
