-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2018 at 07:07 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lofi`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'Reputation', 1, 2, 'assets/images/artwork/reputation.jpg'),
(2, 'Take My Breath Away', 4, 5, 'assets/images/artwork/takeMyBreathAway.jpg'),
(3, 'All Falls Down', 6, 7, 'assets/images/artwork/allFallsDown.jpg'),
(4, 'Despacito ', 8, 8, 'assets/images/artwork/despacito.png'),
(5, 'Dirty Sexy Money', 9, 7, 'assets/images/artwork/dirtySexyMoney.jpg'),
(6, 'Divide', 10, 2, 'assets/images/artwork/divide.jpg'),
(7, 'Evolve', 11, 2, 'assets/images/artwork/evolve.jpg'),
(8, 'Fifty Shades Freed', 12, 2, 'assets/images/artwork/fiftyShadeFreed.jpg'),
(9, 'Finesse [Remix]', 14, 3, 'assets/images/artwork/finesse.png'),
(10, 'Thank You', 15, 2, 'assets/images/artwork/thankyou.jpg'),
(11, 'The Beautiful and Dammed', 16, 4, 'assets/images/artwork/theBeautifulAndDammed.jpg'),
(12, 'Understand Me', 17, 2, 'assets/images/artwork/understandMe.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'Taylor Swift'),
(4, 'Alesso'),
(5, 'Noah Cyrus'),
(6, 'Alan Walker'),
(7, 'Justin Beiber'),
(8, 'Luis Fonsi'),
(9, 'David Guetta'),
(10, 'Ed Sheeran'),
(11, 'Imagine Dragons'),
(12, 'Dua Lipa'),
(13, 'Cardi B'),
(14, 'Bruno Mars'),
(15, 'Meghan Trainor'),
(16, 'G-Eazy'),
(17, 'Conor Maynard');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Hip-Hop'),
(4, 'RAP'),
(5, 'EDM'),
(6, 'Classical'),
(7, 'ElectroPop'),
(8, 'Latin Pop'),
(9, 'R&B soul');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(5, 'Demo', 'root', '2018-02-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(7, 6, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `artist` int(5) NOT NULL,
  `album` int(5) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'Take my breath away', 4, 2, 2, '03.08', 'assets/music/takeMyBreathAway/takeMyBreathAway.mp3', 1, 72),
(2, 'Ready For It', 1, 1, 7, '03.28', 'assets/music/reputation/readyForIt.mp3', 1, 79),
(3, 'End Game', 1, 1, 7, '04.04', 'assets/music/reputation/endGame.mp3', 2, 77),
(4, 'Dancing with our hands tied', 1, 1, 2, '03.31', 'assets/music/reputation/dancingWithOurHandsTied.mp3', 11, 2),
(5, 'Look what you made me do', 1, 1, 2, '03.31', 'assets/music/reputation/lookWhatYouMadeMeDo.mp3', 6, 1),
(6, 'This is why we cant have nice things', 1, 1, 2, '03.27', 'assets/music/reputation/thisIsWhyWeCantHaveNiceThings.mp3', 5, 3),
(7, 'All Falls Down', 6, 3, 7, '03.19', 'assets/music/allFallsDown/allFallsDown.mp3', 1, 3),
(8, 'Despacito', 8, 4, 8, '03.47', 'assets/music/despacito/despacito.mp3', 1, 5),
(9, 'Dirty Sexy Money ft Afrojack', 9, 5, 7, '02.52', 'assets/music/dirtySexyMoney/dirtySexyMoneyftCharli.mp3', 1, 3),
(10, 'Perfect', 10, 6, 2, '04.23', 'assets/music/divide_deluxe/perfect.mp3', 5, 2),
(11, 'Shape of you', 10, 6, 2, '03.53', 'assets/music/divide_deluxe/shapeOfYou.mp3', 1, 2),
(12, 'Believer', 11, 7, 2, '03.23', 'assets/music/evolve/believer.mp3', 1, 1),
(13, 'Thunder', 11, 7, 2, '03.07', 'assets/music/evolve/thunder.mp3', 2, 2),
(14, 'High (& ft. Dua Lipa)', 12, 8, 2, '03.16', 'assets/music/fiftyShadesFreed/high&duaLipa.mp3', 1, 3),
(15, 'Finesse(Remix) ft CardiB', 14, 9, 3, '03.37', 'assets/music/finesse(remix)cardiB/finesse_remix.mp3', 1, 4),
(16, 'No', 15, 10, 2, '03.40', 'assets/music/thankyou/no.mp3', 2, 1),
(17, 'Me Too', 15, 10, 2, '03.01', 'assets/music/thankyou/meToo.mp3', 1, 2),
(18, 'Him & I', 16, 11, 4, '04.28', 'assets/music/theBeautifulAndDamned/himAndI.mp3', 1, 4),
(19, 'Understand Me', 17, 12, 2, '03.37', 'assets/music/understandMe/understandMe.mp3', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(6, 'root', 'Default', 'User', 'someone@example.com', '95f44e0321ed96ba9d2961a54daab05e', '2018-02-13 00:00:00', 'assets/images/profile/boy.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
