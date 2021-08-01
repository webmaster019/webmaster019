-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 22, 2021 at 12:51 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasejec`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id_agent` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `role_agent` varchar(25) NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT current_timestamp(),
  `date_modof` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id_agent`, `id_user`, `role_agent`, `date_ajout`, `date_modof`) VALUES
(1, 1, 'Administrateur', '2021-05-31 05:57:06', NULL),
(2, 2, 'Administrateur', '2021-05-31 21:05:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_cat` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `breve_description` varchar(255) NOT NULL,
  `Type_du_categorie` int(11) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `Description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `datec` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_cat`, `designation`, `breve_description`, `Type_du_categorie`, `id_parent`, `Description`, `img`, `datec`) VALUES
(1, 'Prospert', 'boutique d\'habillement ', 1, NULL, 'test', '199586704fklogo.png', '2021-06-21 05:57:28'),
(2, 'electonic', 'mon shop', 2, NULL, 'tests', '2039596360fkc.jpg', '2021-06-21 06:16:02'),
(3, 'telephone ', 'telephone', 3, NULL, 'test ', '1886081748fklogo.png', '2021-06-21 06:17:09'),
(4, 'habillement', 'boutique d\'habillement ', 1, NULL, 'testjvhvh vivh hvhkhvbxch busdkjvlsglvvvhsuxvdvcxgvucxhubvcbvbvbdsgubmjjbcvxbjbjbsducgjbcubuvdsbubuvubuvbubvububvubcubvd', '1183333009fk01.jpg', '2021-06-21 06:18:21'),
(5, 'plastique', 'plastique', 1, NULL, 'Homo naledi, extinct species of hominin, known from 1500 fossil specimens from a cave complex in South Africa. It is thought to have evolved during the late ...Homo naledi, extinct species of hominin, known from 1500 fossil specimens from a cave complex in South Africa. It is thought to have evolvedHomo naledi, extinct species of hominin, known from 1500 fossil specimens from a cave complex in South Africa. It is thought to have evolved during the late ...Homo naledi, extinct species of hominin, known from 1500 fossil specimens from a cave complex in South Africa. It is thought to have evolved', '1683237556fk01.jpg', '2021-06-21 07:18:02');

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `id_produits` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `couleur` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `poids` varchar(255) DEFAULT NULL,
  `quantites` int(11) NOT NULL,
  `Prix_unitaire` float NOT NULL,
  `prix_de_Solde` float DEFAULT NULL,
  `Courte_Description` varchar(255) NOT NULL,
  `Longue_Description` text NOT NULL,
  `img_princ` varchar(255) NOT NULL,
  `shop` int(11) NOT NULL,
  `datec` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`id_produits`, `designation`, `id_cat`, `couleur`, `size`, `poids`, `quantites`, `Prix_unitaire`, `prix_de_Solde`, `Courte_Description`, `Longue_Description`, `img_princ`, `shop`, `datec`) VALUES
(1, 'test', 3, 'rouge,noire', 'none', '11kg', 23, 123, 100, 'Vivamus sed nunc in arcu cursus mollis quis et orci. Interdum et malesuada', 'Mauris viverra cursus ante laoreet eleifend. Donec vel fringilla ante. Aenean finibus velit id urna vehicula, nec maximus est sollicitudin. Praesent at tempus lectus, eleifend blandit felis. Fusce augue arcu, consequat a nisl aliquet, consectetur elementum turpis. Donec iaculis lobortis nisl, et viverra risus imperdiet eu. Etiam mollis posuere elit non sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quis arcu a magna sodales venenatis. Integer non diam sit amet magna luctus mollis ac eu nisi. In accumsan tellus ut dapibus blandit.', '1775810747fk02.jpg', 5, '2021-06-21 12:41:25'),
(2, 'pain', 5, '', '45', '11', 12, 2, 12, '12', 'khfghgfdgfgfgwxkudfkcg', '1737847329fk02.jpg', 5, '2021-06-21 16:35:44'),
(3, 'Mackbook', 1, '', '', '', 12, 4, 0, 'otherwise, electron-builder will complain.', 'If you’re using a version of electron-builder that’s below 18.7.0, don’t forget to add the “author” property to the package.json file because otherwise, electron-builder will complain.\r\nIf you’re using a version of electron-builder that’s below 18.7.0, don’t forget to add the “author” property to the package.json file because otherwise, electron-builder will complain.', '373608364fkfeatured_7.png', 5, '2021-06-21 16:50:42'),
(4, 'Ecouteur', 2, 'marron', '', '', 4, 10, 0, 'un swich tp-link', 'ceci est un test, ', '1761505912fkbest_3.png', 8, '2021-06-21 17:06:16'),
(5, 'samsung', 3, 'cyan', '', '', 2, 60, 0, 'un swich tp-link', 'Répertoire des données\r\nCe script doit enregistrer des données dans un dossier qui n\'est pas accessible via le web. Il sera créé dans votre répertoire principal. Par exemple, si vous aviez indiqué rep le dossier /home/username/rep sera créé.', '1753699885fkbest_4.png', 5, '2021-06-21 17:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `Shops`
--

CREATE TABLE `Shops` (
  `id_shops` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `pays` varchar(55) NOT NULL,
  `province` varchar(55) NOT NULL,
  `ville` varchar(55) NOT NULL,
  `adresse_complete` text NOT NULL,
  `assujetus` int(11) NOT NULL,
  `breve_description` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `nproduit_a_ajpiter` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `etatShop` int(11) NOT NULL,
  `imgShop` varchar(255) NOT NULL,
  `abonnement` varchar(255) NOT NULL,
  `date_exp` datetime NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Shops`
--

INSERT INTO `Shops` (`id_shops`, `nom`, `pays`, `province`, `ville`, `adresse_complete`, `assujetus`, `breve_description`, `Description`, `nproduit_a_ajpiter`, `user`, `etatShop`, `imgShop`, `abonnement`, `date_exp`, `date_ajout`) VALUES
(5, 'emedi shop', 'RDCongo', 'nord-kivu', 'goma', 'Goma/Rdc', 1, 'desddcn', 'Voici la liste des pays du monde, avec leur capitale et continent. Il existe actuellement (en 2021) 196 pays membres ou observateurs des Nations Unies auxquels sont souvent ajoutés le Kosovo et Taïwan (qui sont toutefois non reconnus par certains Etats).\r\nLa liste des pays évolue régulièrement: par ', 10, 1, 1, '1730723820fkuser-bg.jpg', 'basic,15,j', '2021-07-05 14:01:45', '2021-06-20 14:01:45'),
(8, 'patrick shop', 'RDCongo', 'nord-kivu', 'goma', 'Goma/Rdc', 1, 'boutique d', 'test', 20, 2, 1, '1793045992fkfavicon.png', 'prospert,6,m', '2021-12-20 16:49:35', '2021-06-20 16:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `tarification`
--

CREATE TABLE `tarification` (
  `id_tarif` int(11) NOT NULL,
  `designation` varchar(55) NOT NULL,
  `nProduit` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `validite` int(11) NOT NULL,
  `type_valid` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tarification`
--

INSERT INTO `tarification` (`id_tarif`, `designation`, `nProduit`, `prix`, `validite`, `type_valid`, `description`, `date_ajout`) VALUES
(1, 'prospert', 20, 100, 6, 'm', 'test prop', '2021-06-20 05:42:44'),
(2, 'basic', 10, 10, 15, 'j', 'ytexts', '2021-06-20 06:07:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id_user` int(11) NOT NULL,
  `Nom_complet` varchar(55) NOT NULL,
  `Phone` varchar(24) NOT NULL,
  `Email` varchar(55) DEFAULT NULL,
  `Sexe` enum('M','F','Other') NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Etat_Compt` int(11) NOT NULL DEFAULT 0,
  `email_conf` int(11) NOT NULL DEFAULT 0,
  `Date_Ajout` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_Update` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id_user`, `Nom_complet`, `Phone`, `Email`, `Sexe`, `Password`, `Etat_Compt`, `email_conf`, `Date_Ajout`, `Date_Update`) VALUES
(1, 'David Kiitenge', '+243972673616', 'kingbestd030@gmail.com', 'M', '6bfa6eaddb4e8e3418709fc558b95ff517e4898e', 111, 0, '2021-05-30 19:32:14', '2021-06-17 16:03:15'),
(2, 'Eleazard', '+243993046718', 'eleazardmubalama@gmail.com', 'M', '6bfa6eaddb4e8e3418709fc558b95ff517e4898e', 111, 0, '2021-05-31 20:34:01', '2021-05-31 20:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `vendeur`
--

CREATE TABLE `vendeur` (
  `id_vendeur` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `shop` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `date_ajout` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id_agent`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`id_produits`);

--
-- Indexes for table `Shops`
--
ALTER TABLE `Shops`
  ADD PRIMARY KEY (`id_shops`);

--
-- Indexes for table `tarification`
--
ALTER TABLE `tarification`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id_agent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `id_produits` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Shops`
--
ALTER TABLE `Shops`
  MODIFY `id_shops` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tarification`
--
ALTER TABLE `tarification`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
