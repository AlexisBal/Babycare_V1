-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 07 mars 2022 à 09:34
-- Version du serveur : 10.5.13-MariaDB-cll-lve
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `2YasfoxhZv_babycare`
--

-- --------------------------------------------------------

--
-- Structure de la table `Allergie`
--

CREATE TABLE `Allergie` (
  `idAllergie` int(10) NOT NULL,
  `idEnfant` int(10) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Allergie`
--

INSERT INTO `Allergie` (`idAllergie`, `idEnfant`, `type`) VALUES
(23, 2, 'Ambroisies'),
(24, 2, 'Olivier'),
(25, 2, 'Armoise'),
(26, 2, 'Noisetier'),
(27, 8, 'Plantain'),
(28, 8, 'Armoise'),
(29, 8, 'Chene');

-- --------------------------------------------------------

--
-- Structure de la table `Boitier`
--

CREATE TABLE `Boitier` (
  `idBoitier` int(10) NOT NULL,
  `idActivation` varchar(23) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Boitier`
--

INSERT INTO `Boitier` (`idBoitier`, `idActivation`, `isActive`) VALUES
(46, 'ecfe6bccc4ae97d4', 1),
(47, 'b09dddf39dad921a', 1),
(48, '686e4e7de4b3dc8d', 1),
(50, '0eaa664986b33f43', 0),
(56, '7f722bb994553aa5', 1),
(57, '761845048a3e7d72', 1),
(59, '9360927f1cc610b2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Capteur`
--

CREATE TABLE `Capteur` (
  `idCapteur` int(10) NOT NULL,
  `idBoitier` int(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `sensibilite` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Capteur`
--

INSERT INTO `Capteur` (`idCapteur`, `idBoitier`, `type`, `sensibilite`) VALUES
(1, 50, 'son', 1),
(2, 50, 'co2', 0.9),
(4, 47, 'temp', 1),
(12, 47, 'fc-cardiaque', 50),
(13, 47, 'co2', 0.5),
(14, 46, 'son', 0.62),
(15, 48, 'son', 0.67),
(16, 48, 'co2', 0.5),
(17, 48, 'temp', 0.35),
(18, 48, 'son', 1),
(19, 56, 'son', 0.33),
(20, 50, 'fc-cardiaque', 50),
(21, 50, 'temp', 0.35),
(22, 50, 'hum', 0.35),
(23, 46, 'c02', 0.06);

-- --------------------------------------------------------

--
-- Structure de la table `CGU`
--

CREATE TABLE `CGU` (
  `idArticle` int(20) NOT NULL,
  `categorie` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `CGU`
--

INSERT INTO `CGU` (`idArticle`, `categorie`, `titre`, `texte`) VALUES
(1, 'Conditions générales d\'utilisation du compte Babycare', 'Article 1 - Services et avantages du Compte', 'Votre Compte est exclusivement réservé aux clients FNAC pour la réalisation d\'un achat de produit ou service sur le site fnac.com et au suivi de votre relation commerciale avec FNAC suite à un achat en ligne ou en magasin si vous êtes adhérent.\r\n\r\nEn créant un compte Fnac, vous devenez un client FNAC et vous en acceptez les conditions. Si vous ne souhaitez pas réaliser de commande immédiatement ou devenir Client FNAC, il n\'est pas nécessaire de créer de compte. Vous pouvez continuer à naviguer et consulter nos produits sans cela.\r\n\r\nEn tant que Client FNAC, suite à une commande ou un achat, votre compte, vous permet de disposer de services ou avantages tels que notamment :\r\n\r\nL\'accès à tout moment dans un espace dédié à vos historiques de commandes ainsi qu\'à vos factures concernant vos commandes de produits ou services sur le site fnac.com, en magasin ou chez certains partenaires (ex Kobo.com) ;\r\nLa commande en magasin de produits non disponibles dans les stocks du magasin où vous vous trouvez pour une livraison directement chez vous ou en magasin (Clic &amp; Collect) ;\r\nL\'accès à des ebooks gratuits sur notre site ou les applications Kobo by Fnac.\r\nUne expérience de navigation personnalisée, notamment l\'affichage de produits ou services liés à ceux que vous recherchez ou consultez sur le site fnac.com et à des contenus ou offres susceptibles de vous intéresser ;\r\nDes commandes sécurisées grâce à un système de prévention de la fraude\r\nLa gestion et le suivi en ligne de vos programmes de fidélité FNAC et FNAC+\r\nDes avantages dans les enseignes et programmes de fidélité des sociétés du groupe FNAC DARTY (par exemple : la livraison illimitée FNAC en cas de souscription à la carte DARTY+) ;\r\nLes messages liés à l\'exécution de nos services ou à des avantages et promotions FNAC DARTY liés aux produits ou services sur le site fnac.com que vous avez consultés et qui sont susceptibles de vous intéresser ;\r\nLa possibilité de poster des avis et notations sur les produits du site fnac.com\r\nLa possibilité de vous exprimer sur votre expérience dans notre enseigne suite à la réception d\'un email de sondage (NPS) ;\r\nLe service de paiement du portefeuille électronique - wallet Fnac\r\nLe service d\'achat rapide en 1 clic\r\nL\'accès à la vente de produits sur la marketplace de Fnac.com\r\nL\'accès à la vente de spectacles sur notre site de billetterie fnacspectacles.com\r\nCes Services et les fonctionnalités attachées à l\'utilisation de votre Compte ne sont pas optionnels et constituent des éléments inhérents à votre Compte FNAC.\r\n\r\nCertains de ces Services sont détaillés ci-après dans les présentes CGU.'),
(2, 'Conditions générales d\'utilisation du compte Babycare', 'Article 2 - Conditions d\'accès aux Services et d\'utilisation du compte Babycare', 'Pour accéder aux services de fnac.com et bénéficier des fonctionnalités et avantages du Compte (ci-après les « Services »), vous devez avoir ou créer un Compte fnac.com.\r\n\r\nVous pouvez créer un compte directement depuis le site www.fnac.com, en magasin à l\'occasion d\'une commande clic&amp;Mag ou suite à la souscription d\'une adhésion FNAC ou FNAC+.\r\n\r\nLe renseignement de votre adresse email en magasin lors d\'une commande la souscription d\'une adhésion ou d\'un service, ou la récupération d\'une facture a pour effet de créer automatiquement un compte fnac.com dont vous pourrez finaliser l\'inscription en ligne.\r\n\r\nPour souscrire au contrat de création de Compte vous permettant d\'accéder aux Services, il vous est demandé de valider expressément votre acceptation des présentes CGU. Vous confirmez à ce titre avoir pris connaissance et accepter les présentes CGU qui établissent une relation contractuelle entre vous et la Fnac.\r\n\r\nToute violation des CGU pourra entraîner la clôture de votre Compte et la cessation de tout ou partie des Services ou l\'interdiction d\'y accéder.\r\n\r\nPour créer votre Compte et bénéficier pleinement des Services, certaines données à caractère personnel sont nécessaires, telles que vos identifiants de connexion, vos nom et prénom, votre adresse e-mail, votre adresse postale, et votre numéro de téléphone.\r\n\r\nSocial Connect\r\n\r\nPour créer un compte, ou vous connecter, FNAC vous propose de vous identifier grâce aux comptes liées à vos services web habituels comme votre messagerie, votre espace de stockage, vos services de paiement ou bien vos comptes sociaux.\r\n\r\nCette fonction vous permet de vous connecter à notre site avec les identifiants de vos services web habituels (réseaux sociaux comme Facebook, services web comme Apple, Google ou PayPal...) pour faciliter vos achats et l\'accès à nos services. Lorsque vous vous connectez à notre site avec ces comptes tiers, FNAC DARTY peut accéder à certaines informations afin de vous offrir une expérience personnalisée et sociale. Des informations supplémentaires à celles déjà présentes dans vos comptes sociaux pourront vous être demandées par FNAC DARTY pour les finalités décrites ci-dessus. Les informations collectées par FNAC DARTY sur nos sites et applications ne sont pas transmises aux réseaux sociaux sans votre accord. Il vous appartient de gérer vos paramètres de confidentialité sur les réseaux sociaux lorsque vous souhaitez vous connecter aux services FNAC DARTY avec vos identifiants de réseaux sociaux.\r\n\r\nVous acceptez de veiller à ce que les informations de votre Compte demeurent exactes, complètes et à jour. Vous pouvez consulter vos informations et les modifier à tout moment en vous rendant dans votre compte rubrique « mes infos ».\r\n\r\nÀ défaut d\'informations exactes, complètes et à jour, notamment en cas d\'indication de données invalides ou ayant expiré, vous ne pourriez plus être en mesure de bénéficier pleinement des Services et de les utiliser dans la perspective d\'un achat.\r\n\r\nNous nous réservons le droit d\'accepter ou de refuser votre inscription pour tous motifs légitimes et dans les limites autorisées par la loi applicable.'),
(3, 'Conditions générales d\'utilisation du compte Babycare', 'Article 3 - Services et avantages du Compte Fnac', 'Votre Compte est exclusivement réservé aux clients FNAC pour la réalisation d\'un achat de produit ou service sur le site fnac.com et au suivi de votre relation commerciale avec FNAC suite à un achat en ligne ou en magasin si vous êtes adhérent.\r\n\r\nEn créant un compte Fnac, vous devenez un client FNAC et vous en acceptez les conditions. Si vous ne souhaitez pas réaliser de commande immédiatement ou devenir Client FNAC, il n\'est pas nécessaire de créer de compte. Vous pouvez continuer à naviguer et consulter nos produits sans cela.\r\n\r\nEn tant que Client FNAC, suite à une commande ou un achat, votre compte, vous permet de disposer de services ou avantages tels que notamment :\r\n\r\nL\'accès à tout moment dans un espace dédié à vos historiques de commandes ainsi qu\'à vos factures concernant vos commandes de produits ou services sur le site fnac.com, en magasin ou chez certains partenaires (ex Kobo.com) ;\r\nLa commande en magasin de produits non disponibles dans les stocks du magasin où vous vous trouvez pour une livraison directement chez vous ou en magasin (Clic &amp; Collect) ;\r\nL\'accès à des ebooks gratuits sur notre site ou les applications Kobo by Fnac.\r\nUne expérience de navigation personnalisée, notamment l\'affichage de produits ou services liés à ceux que vous recherchez ou consultez sur le site fnac.com et à des contenus ou offres susceptibles de vous intéresser ;\r\nDes commandes sécurisées grâce à un système de prévention de la fraude\r\nLa gestion et le suivi en ligne de vos programmes de fidélité FNAC et FNAC+\r\nDes avantages dans les enseignes et programmes de fidélité des sociétés du groupe FNAC DARTY (par exemple : la livraison illimitée FNAC en cas de souscription à la carte DARTY+) ;\r\nLes messages liés à l\'exécution de nos services ou à des avantages et promotions FNAC DARTY liés aux produits ou services sur le site fnac.com que vous avez consultés et qui sont susceptibles de vous intéresser ;\r\nLa possibilité de poster des avis et notations sur les produits du site fnac.com\r\nLa possibilité de vous exprimer sur votre expérience dans notre enseigne suite à la réception d\'un email de sondage (NPS) ;\r\nLe service de paiement du portefeuille électronique - wallet Fnac\r\nLe service d\'achat rapide en 1 clic\r\nL\'accès à la vente de produits sur la marketplace de Fnac.com\r\nL\'accès à la vente de spectacles sur notre site de billetterie fnacspectacles.com\r\nCes Services et les fonctionnalités attachées à l\'utilisation de votre Compte ne sont pas optionnels et constituent des éléments inhérents à votre Compte FNAC.\r\n\r\nCertains de ces Services sont détaillés ci-après dans les présentes CGU.'),
(4, 'Conditions générales d\'utilisation du compte Babycare', 'Article 4 - Services et avantages du Compte Fnac', 'Votre Compte est exclusivement réservé aux clients FNAC pour la réalisation d\'un achat de produit ou service sur le site fnac.com et au suivi de votre relation commerciale avec FNAC suite à un achat en ligne ou en magasin si vous êtes adhérent.\r\n\r\nEn créant un compte Fnac, vous devenez un client FNAC et vous en acceptez les conditions. Si vous ne souhaitez pas réaliser de commande immédiatement ou devenir Client FNAC, il n\'est pas nécessaire de créer de compte. Vous pouvez continuer à naviguer et consulter nos produits sans cela.\r\n\r\nEn tant que Client FNAC, suite à une commande ou un achat, votre compte, vous permet de disposer de services ou avantages tels que notamment :\r\n\r\nL\'accès à tout moment dans un espace dédié à vos historiques de commandes ainsi qu\'à vos factures concernant vos commandes de produits ou services sur le site fnac.com, en magasin ou chez certains partenaires (ex Kobo.com) ;\r\nLa commande en magasin de produits non disponibles dans les stocks du magasin où vous vous trouvez pour une livraison directement chez vous ou en magasin (Clic &amp; Collect) ;\r\nL\'accès à des ebooks gratuits sur notre site ou les applications Kobo by Fnac.\r\nUne expérience de navigation personnalisée, notamment l\'affichage de produits ou services liés à ceux que vous recherchez ou consultez sur le site fnac.com et à des contenus ou offres susceptibles de vous intéresser ;\r\nDes commandes sécurisées grâce à un système de prévention de la fraude\r\nLa gestion et le suivi en ligne de vos programmes de fidélité FNAC et FNAC+\r\nDes avantages dans les enseignes et programmes de fidélité des sociétés du groupe FNAC DARTY (par exemple : la livraison illimitée FNAC en cas de souscription à la carte DARTY+) ;\r\nLes messages liés à l\'exécution de nos services ou à des avantages et promotions FNAC DARTY liés aux produits ou services sur le site fnac.com que vous avez consultés et qui sont susceptibles de vous intéresser ;\r\nLa possibilité de poster des avis et notations sur les produits du site fnac.com\r\nLa possibilité de vous exprimer sur votre expérience dans notre enseigne suite à la réception d\'un email de sondage (NPS) ;\r\nLe service de paiement du portefeuille électronique - wallet Fnac\r\nLe service d\'achat rapide en 1 clic\r\nL\'accès à la vente de produits sur la marketplace de Fnac.com\r\nL\'accès à la vente de spectacles sur notre site de billetterie fnacspectacles.com\r\nCes Services et les fonctionnalités attachées à l\'utilisation de votre Compte ne sont pas optionnels et constituent des éléments inhérents à votre Compte FNAC.\r\n\r\nCertains de ces Services sont détaillés ci-après dans les présentes CGU.'),
(6, 'Test', 'Article 5 - Services et avantages du Compte Fnac', 'Votre Compte est exclusivement réservé aux clients FNAC pour la réalisation d\'un achat de produit ou service sur le site fnac.com et au suivi de votre relation commerciale avec FNAC suite à un achat en ligne ou en magasin si vous êtes adhérent.\r\n\r\nEn créant un compte Fnac, vous devenez un client FNAC et vous en acceptez les conditions. Si vous ne souhaitez pas réaliser de commande immédiatement ou devenir Client FNAC, il n\'est pas nécessaire de créer de compte. Vous pouvez continuer à naviguer et consulter nos produits sans cela.\r\n\r\nEn tant que Client FNAC, suite à une commande ou un achat, votre compte, vous permet de disposer de services ou avantages tels que notamment :\r\n\r\nL\'accès à tout moment dans un espace dédié à vos historiques de commandes ainsi qu\'à vos factures concernant vos commandes de produits ou services sur le site fnac.com, en magasin ou chez certains partenaires (ex Kobo.com) ;\r\nLa commande en magasin de produits non disponibles dans les stocks du magasin où vous vous trouvez pour une livraison directement chez vous ou en magasin (Clic &amp; Collect) ;\r\nL\'accès à des ebooks gratuits sur notre site ou les applications Kobo by Fnac.\r\nUne expérience de navigation personnalisée, notamment l\'affichage de produits ou services liés à ceux que vous recherchez ou consultez sur le site fnac.com et à des contenus ou offres susceptibles de vous intéresser ;\r\nDes commandes sécurisées grâce à un système de prévention de la fraude\r\nLa gestion et le suivi en ligne de vos programmes de fidélité FNAC et FNAC+\r\nDes avantages dans les enseignes et programmes de fidélité des sociétés du groupe FNAC DARTY (par exemple : la livraison illimitée FNAC en cas de souscription à la carte DARTY+) ;\r\nLes messages liés à l\'exécution de nos services ou à des avantages et promotions FNAC DARTY liés aux produits ou services sur le site fnac.com que vous avez consultés et qui sont susceptibles de vous intéresser ;\r\nLa possibilité de poster des avis et notations sur les produits du site fnac.com\r\nLa possibilité de vous exprimer sur votre expérience dans notre enseigne suite à la réception d\'un email de sondage (NPS) ;\r\nLe service de paiement du portefeuille électronique - wallet Fnac\r\nLe service d\'achat rapide en 1 clic\r\nL\'accès à la vente de produits sur la marketplace de Fnac.com\r\nL\'accès à la vente de spectacles sur notre site de billetterie fnacspectacles.com\r\nCes Services et les fonctionnalités attachées à l\'utilisation de votre Compte ne sont pas optionnels et constituent des éléments inhérents à votre Compte FNAC.\r\n\r\nCertains de ces Services sont détaillés ci-après dans les présentes CGU.');

-- --------------------------------------------------------

--
-- Structure de la table `Data`
--

CREATE TABLE `Data` (
  `idData` int(100) NOT NULL,
  `idCapteur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `valeur` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Data`
--

INSERT INTO `Data` (`idData`, `idCapteur`, `nom`, `valeur`, `timestamp`) VALUES
(13, 4, 'Température', 37, '2022-01-17 16:01:13'),
(14, 12, 'Fréquence cardiaque', 180, '2022-01-20 18:16:15'),
(15, 13, 'Quantité de CO2', 570, '2022-01-21 13:28:31'),
(16, 17, 'Température', 37, '2022-01-17 16:01:13'),
(17, 16, 'Quantité de CO2', 570, '2022-01-21 13:28:31'),
(18, 22, 'Humidité', 50, '2022-01-28 08:41:28'),
(19, 21, 'Température', 36.5, '2022-01-28 08:47:50'),
(20, 20, 'Fréquence cardiaque', 120, '2022-01-28 08:47:50'),
(21, 21, 'Température', 36.6, '2022-01-28 08:48:00'),
(22, 20, 'Fréquence cardiaque', 122, '2022-01-28 08:48:00'),
(23, 21, 'Température', 36.7, '2022-01-28 08:48:10'),
(24, 20, 'Fréquence cardiaque', 130, '2022-01-28 08:48:10'),
(25, 21, 'Température', 37, '2022-01-28 08:48:20'),
(26, 20, 'Fréquence cardiaque', 110, '2022-01-28 08:48:20'),
(27, 21, 'Température', 36.5, '2022-01-28 08:48:30'),
(28, 20, 'Fréquence cardiaque', 120, '2022-01-28 08:48:31'),
(29, 21, 'Température', 36.4, '2022-01-28 08:48:41'),
(30, 20, 'Fréquence cardiaque', 125, '2022-01-28 08:48:41'),
(31, 2, 'Quantité de CO2', 570, '2022-01-21 13:28:31'),
(32, 1, 'Intensité Sonore', 40, '2022-01-28 08:51:16'),
(33, 21, 'Température', 36.5, '2022-01-28 09:49:56'),
(34, 20, 'Fréquence cardiaque', 120, '2022-01-28 09:49:56'),
(35, 21, 'Température', 36.6, '2022-01-28 09:50:06'),
(36, 20, 'Fréquence cardiaque', 122, '2022-01-28 09:50:07'),
(37, 21, 'Température', 36.7, '2022-01-28 09:50:17'),
(38, 20, 'Fréquence cardiaque', 130, '2022-01-28 09:50:17'),
(39, 21, 'Température', 37, '2022-01-28 09:50:27'),
(40, 20, 'Fréquence cardiaque', 110, '2022-01-28 09:50:27'),
(41, 21, 'Température', 36.5, '2022-01-28 09:50:37'),
(42, 20, 'Fréquence cardiaque', 120, '2022-01-28 09:50:37'),
(43, 21, 'Température', 36.5, '2022-01-28 10:30:14'),
(44, 20, 'Fréquence cardiaque', 110, '2022-01-28 10:30:14'),
(45, 21, 'Température', 36.6, '2022-01-28 10:30:24'),
(46, 20, 'Fréquence cardiaque', 140, '2022-01-28 10:30:24'),
(47, 21, 'Température', 36.7, '2022-01-28 10:30:34'),
(48, 20, 'Fréquence cardiaque', 150, '2022-01-28 10:30:34'),
(49, 21, 'Température', 37, '2022-01-28 10:30:44'),
(50, 20, 'Fréquence cardiaque', 130, '2022-01-28 10:30:44'),
(51, 21, 'Température', 36.5, '2022-01-28 10:30:54'),
(52, 20, 'Fréquence cardiaque', 120, '2022-01-28 10:30:54'),
(53, 21, 'Température', 36.5, '2022-01-28 13:55:00'),
(54, 20, 'Fréquence cardiaque', 110, '2022-01-28 13:55:00'),
(55, 21, 'Température', 36.6, '2022-01-28 13:55:10'),
(56, 20, 'Fréquence cardiaque', 140, '2022-01-28 13:55:11'),
(57, 21, 'Température', 36.7, '2022-01-28 13:55:21'),
(58, 20, 'Fréquence cardiaque', 150, '2022-01-28 13:55:21'),
(59, 21, 'Température', 37, '2022-01-28 13:55:31'),
(60, 20, 'Fréquence cardiaque', 130, '2022-01-28 13:55:31'),
(61, 21, 'Température', 36.5, '2022-01-28 13:55:41'),
(62, 20, 'Fréquence cardiaque', 120, '2022-01-28 13:55:41'),
(63, 21, 'Température', 36.4, '2022-01-28 13:55:51'),
(64, 20, 'Fréquence cardiaque', 125, '2022-01-28 13:55:51');

-- --------------------------------------------------------

--
-- Structure de la table `Enfant`
--

CREATE TABLE `Enfant` (
  `idEnfant` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `idBoitier` int(11) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `sexe` tinyint(1) DEFAULT NULL,
  `poids` float DEFAULT NULL,
  `activerSon` tinyint(1) NOT NULL DEFAULT 1,
  `activerNotifPush` tinyint(1) NOT NULL DEFAULT 1,
  `activerNotifMail` tinyint(1) NOT NULL DEFAULT 1,
  `seuilAlerteFreq` float DEFAULT NULL,
  `seuilAlerteTemp` float DEFAULT NULL,
  `seuilAlerteHum` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Enfant`
--

INSERT INTO `Enfant` (`idEnfant`, `idUtilisateur`, `idBoitier`, `prenom`, `dateNaissance`, `sexe`, `poids`, `activerSon`, `activerNotifPush`, `activerNotifMail`, `seuilAlerteFreq`, `seuilAlerteTemp`, `seuilAlerteHum`) VALUES
(1, 58, 46, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL),
(2, 59, 50, 'Tim', '2021-04-15', 0, 38, 1, 1, 1, 39, 30, 0),
(3, 59, 48, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL),
(4, 60, 47, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, NULL, NULL),
(8, 66, 56, 'Roméo', '2021-01-15', 0, 37, 1, 1, 0, 31, 31, 4),
(9, 60, 57, 'Test', '2022-01-28', 0, NULL, 1, 1, 1, NULL, NULL, NULL),
(10, 59, 59, 'guillaume', '2001-07-23', 0, NULL, 1, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Equipe`
--

CREATE TABLE `Equipe` (
  `idPersonne` int(10) NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='membre de l''équipe de développement du site babycare';

--
-- Déchargement des données de la table `Equipe`
--

INSERT INTO `Equipe` (`idPersonne`, `nom`, `prenom`, `role`) VALUES
(1, 'Balayre', 'Alexis', 'Directeur 1'),
(2, 'Delestre', 'Clément', 'Directeur 2'),
(3, 'Bernard', 'Francois', 'Directeur 3'),
(4, 'Duffau', 'Guillaume', 'Directeur 4'),
(5, 'Itzkowitch', 'Sacha', 'Directeur 5'),
(6, 'Pinton', 'Tom', 'Directeur 6');

-- --------------------------------------------------------

--
-- Structure de la table `FAQ`
--

CREATE TABLE `FAQ` (
  `idQuestion` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `question` mediumtext NOT NULL,
  `reponse` longtext NOT NULL,
  `creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `FAQ`
--

INSERT INTO `FAQ` (`idQuestion`, `categorie`, `question`, `reponse`, `creation`) VALUES
(1, 'Boitier', 'Le boitier de Babycare assure t’il la bonne santé de mon enfant ?', 'Le boitier que vous recevrez est à titre préventif de la santé de votre enfant, nous ne fournissons pas de solution médicale en cas de crise de votre enfant. Nous conseillons donc de rester en contact avec un médecin malgré l’acquisition du boitier.', '2021-12-25 15:46:49'),
(2, 'Boitier', 'Que puis-je faire en cas de disfonctionnement ou d’insatisfaction du produit ?', 'Si le boitier présente des disfonctionnements, nous tenons tout d’abord à vous présenter nos excuses. Si le problème persiste ou que vous n’êtes pas satisfait, nous vous invitons à nous contactez sur la page contact de notre site et de nous présenter votre problème.', '2021-12-25 15:47:54'),
(3, 'Boitier', 'Les données concernant la santé de mon enfant sont-elles conservées ?', 'Oui, notre boitier se voulant à cadre préventif, nous estimons qu’un rapport consultable quant à la santé de l’enfant ou de l’environnement qui l’entoure est important. Cela peut permettre aussi de transférer ces données à un médecin (sous votre autorisation), pour lui permettre d’analyser l’état de santé de votre enfant.', '2021-12-25 15:48:09'),
(4, 'Boitier', 'Est-il nécessaire d’obtenir un boitier pour accéder à mon compte ?', 'Comme vous pouvez le voir sur la page d’inscription, il est nécessaire d’avoir connaissance du numéro de votre boitier pour se créer un compte. Cette fonctionnalité nous permet d’éviter la création de faux profil et garantir la sécurité des informations de nos clients au sein de Babycare.', '2021-12-25 15:48:21'),
(5, 'Santé 1', 'Mon enfant montre-t-il des signes d’asthme ?', 'Si votre enfant montre des signes de difficulté respiratoire, de toux sévère ou une respiration sifflante, alors il est probable que votre enfant soit asthmatique. Nous vous conseillons donc de consulter un medecin pour confirmer la présence de la maladie avant d’envisagé de prendre l’un de nos boitiers.', '2021-12-25 15:48:33'),
(6, 'Santé 1', 'Quel problème l’asthme peut-elle engendrée ?', 'L’asthme à des impacts directs sur le domaine scolaire, social et physique de l’enfant. Il est possible également que des crises répétées ai un impact sentimental et relationnel sur le malade. Faites attention à ce que votre enfant ne s’enferme pas dans une bulle où il est un problème pour ces camarades, car l’activité physique est un facteur important dans l’intégration sociale d’un enfant.', '2021-12-25 15:48:51');

-- --------------------------------------------------------

--
-- Structure de la table `Modal`
--

CREATE TABLE `Modal` (
  `idModal` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `titre` mediumtext NOT NULL,
  `texte` longtext NOT NULL,
  `creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Modal`
--

INSERT INTO `Modal` (`idModal`, `categorie`, `titre`, `texte`, `creation`) VALUES
(8, 'son', 'Quels sont les risques d\'un volume sonore trop élevé ?', 'Lm nisi. Praesent a tristique nibh, nec faucibus elit. Proin quis velit eu nibh consequat aliquet. Donec consectetur eros mi, ut volutpat dui malesuada ut. Nulla imperdiet egestas nulla non sagittis. Proin rhoncus, augue ac placerat tempus, velit enim ornare tellus, sed vestibulum nibh ligula maximus odio. Nam nisl mi, efficitur vel dui sed, aliquam tincidunt felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2022-01-14 12:58:19'),
(9, 'gaz', 'Quels sont les risques des gaz naturels pour un nourrisson ?', 'Lm nisi. Praesent a tristique nibh, nec faucibus elit. Proin quis velit eu nibh consequat aliquet. Donec consectetur eros mi, ut volutpat dui malesuada ut. Nulla imperdiet egestas nulla non sagittis. Proin rhoncus, augue ac placerat tempus, velit enim ornare tellus, sed vestibulum nibh ligula maximus odio. Nam nisl mi, efficitur vel dui sed, aliquam tincidunt felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2022-01-14 12:59:07'),
(10, 'co2', 'Quels dangers pour un nourrison confronté à un taux élevé de CO2 ?', 'Lm nisi. Praesent a tristique nibh, nec faucibus elit. Proin quis velit eu nibh consequat aliquet. Donec consectetur eros mi, ut volutpat dui malesuada ut. Nulla imperdiet egestas nulla non sagittis. Proin rhoncus, augue ac placerat tempus, velit enim ornare tellus, sed vestibulum nibh ligula maximus odio. Nam nisl mi, efficitur vel dui sed, aliquam tincidunt felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2022-01-14 12:59:52'),
(11, 'pollen', 'Comment déceler une allergie au pollen ?', 'Lm nisi. Praesent a tristique nibh, nec faucibus elit. Proin quis velit eu nibh consequat aliquet. Donec consectetur eros mi, ut volutpat dui malesuada ut. Nulla imperdiet egestas nulla non sagittis. Proin rhoncus, augue ac placerat tempus, velit enim ornare tellus, sed vestibulum nibh ligula maximus odio. Nam nisl mi, efficitur vel dui sed, aliquam tincidunt felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2022-01-14 13:00:20'),
(12, 'fc-cardiaque', 'Que signifie une fréquence trop élevée ? ', 'Lm nisi. Praesent a tristique nibh, nec faucibus elit. Proin quis velit eu nibh consequat aliquet. Donec consectetur eros mi, ut volutpat dui malesuada ut. Nulla imperdiet egestas nulla non sagittis. Proin rhoncus, augue ac placerat tempus, velit enim ornare tellus, sed vestibulum nibh ligula maximus odio. Nam nisl mi, efficitur vel dui sed, aliquam tincidunt felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2022-01-14 13:02:08'),
(13, 'temp', 'Que signifie une température trop élevée ?', 'Lm nisi. Praesent a tristique nibh, nec faucibus elit. Proin quis velit eu nibh consequat aliquet. Donec consectetur eros mi, ut volutpat dui malesuada ut. Nulla imperdiet egestas nulla non sagittis. Proin rhoncus, augue ac placerat tempus, velit enim ornare tellus, sed vestibulum nibh ligula maximus odio. Nam nisl mi, efficitur vel dui sed, aliquam tincidunt felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2022-01-14 13:02:40'),
(14, 'hum', 'Que signifie une humidité corporelle trop élevée ?', 'Lm nisi. Praesent a tristique nibh, nec faucibus elit. Proin quis velit eu nibh consequat aliquet. Donec consectetur eros mi, ut volutpat dui malesuada ut. Nulla imperdiet egestas nulla non sagittis. Proin rhoncus, augue ac placerat tempus, velit enim ornare tellus, sed vestibulum nibh ligula maximus odio. Nam nisl mi, efficitur vel dui sed, aliquam tincidunt felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', '2022-01-14 13:03:11');

-- --------------------------------------------------------

--
-- Structure de la table `Notification`
--

CREATE TABLE `Notification` (
  `idNotif` int(10) NOT NULL,
  `idBoitier` int(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Texte`
--

CREATE TABLE `Texte` (
  `idTexte` int(20) NOT NULL,
  `nom` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texte` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `Texte`
--

INSERT INTO `Texte` (`idTexte`, `nom`, `texte`) VALUES
(1, 'accueil-présentation_entreprise', 'En se basant sur les données recueillies par les différents capteurs, Baby Care fournit des conseils adaptés aux parents. Grâce aux nombreux paramètres pris en charge (comme la présence d’allergènes ou le niveau de pollution), les parents sont libérés d’un poids et les sorties avec leur enfant se font sans inquiétudes. Il est aussi possible de planifier ses activités en fonction des prévisions de la qualité de l’air. Baby Care ouvre un horizon de possibilités pour faciliter la vie des parents et profiter pleinement de chaque moment en famille. Ce produit dispose de nombreux atouts pour vous proposer un accompagnement personnalisé et complet. En se basant sur les données recueillies par les différents capteurs, Baby Care fournit des conseils adaptés aux parents. Grâce aux nombreux paramètres pris en charge (comme la présence d’allergènes ou le niveau de pollution), les parents sont libérés d’un poids et les sorties avec leur enfant se font sans inquiétudes. Il est aussi possible de planifier ses activités en fonction des prévisions de la qualité de l’air. Baby Care ouvre un horizon de possibilités pour faciliter la vie des parents et profiter pleinement de chaque moment en famille. Ce produit dispose de nombreux atouts pour vous proposer un accompagnement personnalisé et complet.');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `idUtilisateur` int(10) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `cp` int(5) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'utilisateur',
  `token` varchar(255) NOT NULL,
  `creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `prenom`, `nom`, `cp`, `email`, `motDePasse`, `role`, `token`, `creation`) VALUES
(0, 'Sacha', 'Itzkowitch', 92200, 'sacha.itzkowitch@gmail.com', '$2y$10$9xOruhIWDPSlmg8lJCtt6OnIcVRxmRlf9QUqH6JmfH91fP7uIO74m', 'admin', 'eaaad3f33fe80f2d65d1813dc09a6597', '2022-01-17 13:39:06'),
(5, 'Alexis', 'Balayre', 63636, 'alexis.balayre@gmail.com', '$2y$10$shfHFZohFg.vid9y3jtORuMwSxbvm.z8NaKbUYjuVXo1T/wmYhNre', 'superuser', '762e08727a81bce96d7f6bc07422d206', '2021-11-19 14:03:03'),
(8, 'Superuser', '1', NULL, 'admin@babycare.com', '$2y$10$pE1adceJZY7lkSN1SZNiS.JFyALGis4rubRtt/i66s5/3/6OIYt0e', 'superuser', '844a2d1dae08bb08c8574614d92b2fa4', '2021-11-28 14:23:20'),
(9, 'Superuser', '2', NULL, 'admin2@babycare.fr', '$2y$10$t6zK21ljhh2q.vQrldDLduVD9x8ltDrmOUHRe8d/izITI7Rphikuu', 'superuser', 'c70edec1842c7da4ec7005fe2aa0cd66', '2021-11-28 14:25:09'),
(34, 'Superuser', 'Superuser', NULL, 'test2@gmail.com', '$2b$12$fEnr14mCiKwo72X9Hq5Vgu.rkRajgyKOs7Ev.VPTwVnmfudLgeaVm', 'superuser', '9cc58b3ec0daa35e28cedeac6d4cbb32', '2021-11-30 08:27:25'),
(58, 'Francois', 'Bernard', 78636, 'francois8484@gmail.com', '$2y$10$G/PJUlHrhFFAEkScgIx4WumvzGGoDsrhbEHCWOIF8JbE043SLj7KG', 'superuser', 'b4a17f4fb4afb1649854f504bbf623e0', '2021-12-25 14:29:57'),
(59, 'User', 'Test', 58002, 'user@babycare.com', '$2y$10$VFfBE3VAPGuhgFXKt7oUFOPOupp8mSdWnCwVjsvH.QnAE2kDHlgmu', 'utilisateur', 'debcd33ee6535f014ad639b0861c00a6', '2021-12-25 15:12:33'),
(60, 'Clément', 'Delestre', 75007, 'cd@gmail.com', '$2y$10$.d5RXfz5MOFLS8FchHSDqudAokwPUdb8OXacTQ.08NUooKZoJBpnC', 'utilisateur', '151558278381ecd7c114024b78970f5d', '2022-01-17 12:48:37'),
(61, 'Tom', 'Pinton', 93500, 'tom.snak00s@gmail.com', '$2y$10$Ym9BF6cIQ7TFPCfJFIwR1uL3DVflhiuAwDt9hvOWF2EdViJ37Nwba', 'utilisateur', '4e6e6fa69b319e6daa25fa0e4cddcd00', '2022-01-17 13:22:23'),
(66, 'Alexis', 'Balayre', 78490, 'alexis.balayre@orange.fr', '$2y$10$WsPp47TLfgq5aaquz21vteLQU/hl3IE5t7lqla2cWBdqUcVZmt.eO', 'utilisateur', '43f2c5070177fd0b39bc3872e7879cfc', '2022-01-27 21:18:00'),
(69, 'Sacha', 'Itzkowitch', NULL, 'gestionnaire@babycare.com', '$2y$10$C16L9mSF9ps5Bt31cnmHjuwq5Ehz6T46HIDhs3tocn4x0VbDVdBJu', 'admin', 'fdd6b6fd0095073807895f66eee16dbd', '2021-11-28 14:23:20');

-- --------------------------------------------------------

--
-- Structure de la table `UtilisateurBanni`
--

CREATE TABLE `UtilisateurBanni` (
  `idUtilisateurBanni` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Allergie`
--
ALTER TABLE `Allergie`
  ADD PRIMARY KEY (`idAllergie`),
  ADD KEY `allergie_ibfk_1` (`idEnfant`);

--
-- Index pour la table `Boitier`
--
ALTER TABLE `Boitier`
  ADD PRIMARY KEY (`idBoitier`),
  ADD UNIQUE KEY `idActivation` (`idActivation`);

--
-- Index pour la table `Capteur`
--
ALTER TABLE `Capteur`
  ADD PRIMARY KEY (`idCapteur`),
  ADD KEY `capteur_ibfk_1` (`idBoitier`);

--
-- Index pour la table `CGU`
--
ALTER TABLE `CGU`
  ADD PRIMARY KEY (`idArticle`);

--
-- Index pour la table `Data`
--
ALTER TABLE `Data`
  ADD PRIMARY KEY (`idData`),
  ADD KEY `data_ibfk_1_idx` (`idCapteur`);

--
-- Index pour la table `Enfant`
--
ALTER TABLE `Enfant`
  ADD PRIMARY KEY (`idEnfant`),
  ADD UNIQUE KEY `idBoitier` (`idBoitier`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `Equipe`
--
ALTER TABLE `Equipe`
  ADD PRIMARY KEY (`idPersonne`);

--
-- Index pour la table `FAQ`
--
ALTER TABLE `FAQ`
  ADD PRIMARY KEY (`idQuestion`),
  ADD UNIQUE KEY `idQuestion_UNIQUE` (`idQuestion`);

--
-- Index pour la table `Modal`
--
ALTER TABLE `Modal`
  ADD PRIMARY KEY (`idModal`),
  ADD UNIQUE KEY `idModal_UNIQUE` (`idModal`);

--
-- Index pour la table `Notification`
--
ALTER TABLE `Notification`
  ADD PRIMARY KEY (`idNotif`),
  ADD KEY `notification_ibfk_1` (`idBoitier`);

--
-- Index pour la table `Texte`
--
ALTER TABLE `Texte`
  ADD PRIMARY KEY (`idTexte`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `UtilisateurBanni`
--
ALTER TABLE `UtilisateurBanni`
  ADD PRIMARY KEY (`idUtilisateurBanni`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Allergie`
--
ALTER TABLE `Allergie`
  MODIFY `idAllergie` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `Boitier`
--
ALTER TABLE `Boitier`
  MODIFY `idBoitier` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT pour la table `Capteur`
--
ALTER TABLE `Capteur`
  MODIFY `idCapteur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `CGU`
--
ALTER TABLE `CGU`
  MODIFY `idArticle` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Data`
--
ALTER TABLE `Data`
  MODIFY `idData` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `Enfant`
--
ALTER TABLE `Enfant`
  MODIFY `idEnfant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Equipe`
--
ALTER TABLE `Equipe`
  MODIFY `idPersonne` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `FAQ`
--
ALTER TABLE `FAQ`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Modal`
--
ALTER TABLE `Modal`
  MODIFY `idModal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `Notification`
--
ALTER TABLE `Notification`
  MODIFY `idNotif` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Texte`
--
ALTER TABLE `Texte`
  MODIFY `idTexte` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `idUtilisateur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT pour la table `UtilisateurBanni`
--
ALTER TABLE `UtilisateurBanni`
  MODIFY `idUtilisateurBanni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Allergie`
--
ALTER TABLE `Allergie`
  ADD CONSTRAINT `enfant_contraint` FOREIGN KEY (`idEnfant`) REFERENCES `Enfant` (`idEnfant`);

--
-- Contraintes pour la table `Capteur`
--
ALTER TABLE `Capteur`
  ADD CONSTRAINT `capteur_ibfk_1` FOREIGN KEY (`idBoitier`) REFERENCES `Boitier` (`idBoitier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Data`
--
ALTER TABLE `Data`
  ADD CONSTRAINT `data_ibfk_1` FOREIGN KEY (`idCapteur`) REFERENCES `Capteur` (`idCapteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Enfant`
--
ALTER TABLE `Enfant`
  ADD CONSTRAINT `enfant_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enfant_ibfk_2` FOREIGN KEY (`idBoitier`) REFERENCES `Boitier` (`idBoitier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Notification`
--
ALTER TABLE `Notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`idBoitier`) REFERENCES `Boitier` (`idBoitier`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
