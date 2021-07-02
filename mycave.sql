-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 01 juil. 2021 à 21:58
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mycave`
--

-- --------------------------------------------------------

--
-- Structure de la table `mes_vins`
--

DROP TABLE IF EXISTS `mes_vins`;
CREATE TABLE IF NOT EXISTS `mes_vins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cepage` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `millesime` int(11) NOT NULL,
  `stock` int(100) NOT NULL,
  `image_vin` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_vin` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mes_vins`
--

INSERT INTO `mes_vins` (`id`, `titre`, `cepage`, `pays`, `region`, `date`, `millesime`, `stock`, `image_vin`, `description_vin`) VALUES
(26, 'CHATEAU DE SAINT COSME', 'Grenache / Syrah', 'France', 'Southern Rhone / Gigondas', '2021-06-30 09:02:59', 2009, 12, '60dc1723ec8521.06637330.png', 'The aromas of fruit and spice give one a hint of the light drinkability of this lovely wine, which makes an excellent complement to fish dishes.'),
(27, 'LAN RIOJA CRIANZA', 'Tempranillo', 'Spain', 'Rioja', '2021-06-30 09:09:19', 2006, 6, '60dc189f256e83.71127922.png', 'A resurgence of interest in boutique vineyards has opened the door for this excellent foray into the dessert wine market. Light and bouncy, with a hint of black truffle, this wine will not fail to tickle the taste buds.'),
(28, 'MARGERUM SYBARITE', 'Sauvignon Blanc', 'USA', 'California Central Cosat', '2021-06-30 09:12:04', 2010, 10, '60dc1944725f35.23853641.png', '&quot;The cache of a fine Cabernet in ones wine cellar can now be replaced with a childishly playful wine bubbling over with tempting tastes of black cherry and licorice. This is a taste sure to transport you back in time.&quot;'),
(29, 'OWEN ROE &quot;EX UMBRIS&quot;', 'Syrah', 'USA', 'Washington', '2021-06-30 09:16:02', 2009, 8, '60dc1a3295d8b1.75672486.png', '&quot;A one-two punch of black pepper and jalapeno will send your senses reeling, as the orange essence snaps you back to reality. Don\'t miss this award-winning taste sensation.&quot;'),
(30, 'REX HILL', 'Pinot Noir', 'USA', 'Oregon', '2021-06-30 09:22:24', 2009, 6, '60dc1bb03e8049.66144348.png', '&quot;One cannot doubt that this will be the wine served at the Hollywood award shows, because it has undeniable star power. Be the first to catch the debut that everyone will be talking about tomorrow.&quot;'),
(31, 'VITICCIO CLASSICO RISERVA', 'Sangiovese Merlot', 'Italy', 'Tuscany', '2021-06-30 09:27:56', 2007, 10, '60dc1cfc203485.43492122.png', 'Though soft and rounded in texture, the body of this wine is full and rich and oh-so-appealing. This delivery is even more impressive when one takes note of the tender tannins that leave the taste buds wholly satisfied.'),
(32, 'CHATEAU LE DOYENNE', 'Merlot', 'France', 'Bordeaux', '2021-06-30 09:33:14', 2005, 24, '60dc1e3a92fea6.56304754.png', '&quot;Though dense and chewy, this wine does not overpower with its finely balanced depth and structure. It is a truly luxurious experience for the senses.&quot;'),
(33, 'DOMAINE DU BOUSCAT', 'Merlot', 'France', 'Bordeaux', '2021-06-30 09:43:23', 2009, 16, '60dc209bd0e442.99484300.png', 'The light golden color of this wine belies the bright flavor it holds. A true summer wine, it begs for a picnic lunch in a sun-soaked vineyard.'),
(34, 'BLOCK NINE', 'Pinot Noir', 'USA', 'California', '2021-06-30 09:49:20', 2009, 6, '60dc2200b77093.83192656.png', 'With hints of ginger and spice, this wine makes an excellent complement to light appetizer and dessert fare for a holiday gathering.'),
(35, 'DOMAINE SERENE', 'Pinot Noir', 'USA', 'Oregon', '2021-06-30 09:52:18', 2007, 6, '60dc22b2b5b875.95101614.png', 'Though subtle in its complexities, this wine is sure to please a wide range of enthusiasts. Notes of pomegranate will delight as the nutty finish completes the picture of a fine sipping experience.'),
(36, 'BODEGA LURTON', 'Pinot Gris', 'Argentina', 'Mendoza', '2021-06-30 09:59:08', 2011, 8, '60dc244c64c8c9.12974806.png', 'Solid notes of black currant blended with a light citrus make this wine an easy pour for varied palates.'),
(37, 'LES MORIZOTTES', 'Chardonnay', 'France', 'Burgundy', '2021-06-30 10:08:53', 2009, 8, '60dc2695342235.20972851.png', '&quot;Breaking the mold of the classics, this offering will surprise and undoubtedly get tongues wagging with the hints of coffee and tobacco in perfect alignment with more traditional notes. Breaking the mold of the classics, this offering will surprise and undoubtedly get tongues wagging with the hints of coffee and tobacco in perfect alignment with more traditional notes. Sure to please the late-night crowd with the slight jolt of adrenaline it brings.&quot;'),
(40, 'test', 'test', 'france', 'champagne', '2021-06-30 15:36:50', 2020, 5, '60dc77290008alan_rioja.png', 'c\'est bon le champagne');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(3, 'dimitri', '$2y$10$GsVEX9ywXtB7y5aKDTvO6e8ihVOZvQ4nQxb1ixK7gkC3iSfubf6se', '2021-07-01 14:29:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
