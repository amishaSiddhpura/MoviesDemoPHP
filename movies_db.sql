-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 01 août 2019 à 20:10
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `movies_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `Category_ID` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`Category_ID`, `Name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Animation'),
(4, 'Comedy'),
(5, 'Drama'),
(6, 'Family'),
(7, 'Horror'),
(8, 'Romance'),
(9, 'Science-Fiction'),
(10, 'Superhero'),
(11, 'Thriller'),
(12, 'Western');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `Movie_ID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Actors` varchar(250) NOT NULL,
  `Year` int(4) NOT NULL,
  `Status` varchar(15) NOT NULL DEFAULT 'Available',
  `Category_ID` int(11) NOT NULL,
  `Image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`Movie_ID`, `Title`, `Actors`, `Year`, `Status`, `Category_ID`, `Image`) VALUES
(1, 'Avatar', 'James Cameron and starring Sam ', 2009, 'Reserved', 9, 'movie_avatar.jpg'),
(2, 'The Dark Knight', ' Christian Bale and Michael Caine', 2008, 'Reserved', 10, 'movie_dark_night.jpg'),
(3, 'The Bourne Ultimatum', 'Matt Damon, Julia Stiles, and Joan Allen', 2007, 'Available', 1, 'movie_bourne.jpg'),
(4, 'Inside Out', 'Pete Docter and Ronnie del Carmen', 2015, 'Available', 3, 'movie_inside_out.jpg'),
(5, 'The Lost World: Jurassic Park', 'Jeff Goldblum , Julianne Moore , and Pete Postlethwaite', 1997, 'Available', 2, 'movie_jurassic_park.jpg'),
(6, 'Big Momma\'s House 2', 'Martin Lawrence , Nia Long , and Zachary Levi', 2006, 'Reserved', 4, 'movie_big_mommas_house_2.jpg'),
(7, 'Winchester', '	\r\nHelen Mirren, Jason Clarke, and \r\nSarah Snook', 2018, 'Reserved', 7, 'movie_winchester.png'),
(8, 'The Jungle Book ', 'Bill Murray , Ben Kingsley , and Idris Elba', 2016, 'Available', 2, 'movie_the_Jungle_Book.jpg'),
(9, 'Titanic', 'Leonardo DiCaprio and Kate Winslet', 1997, 'Available', 5, 'movie_titanic.jpg'),
(10, 'Home Alone', 'Macaulay Culkin, Joe Pesci , Daniel Stern , and John Heard', 1990, 'Available', 6, 'movie_home_alone.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`Movie_ID`),
  ADD KEY `Category_FK` (`Category_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `Movie_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `Category_FK` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`Category_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
