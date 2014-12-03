-- sample database

--
-- Database: `app`
--
CREATE DATABASE IF NOT EXISTS `app` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `app`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(3) unsigned NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `fullname`, `lastlogin`) VALUES
(11, 'Ali', '86318e52f5ed4801abe1d13d509443de', 'Ali Ibrahim', '2014-12-03 16:01:34'),
(12, 'Omar', 'd4466cce49457cfea18222f5a7cd3573', 'Omar Ali', '2014-12-03 05:04:06'),
(13, 'Husin', '4617206f09644eb1688aa9be28eca08f', 'Husin Abu', NULL),
(14, 'David', '172522ec1028ab781d9dfd17eaca4427', 'David Becham', NULL),
(15, 'Gopal', '054f6f018d61d9e639fe25324954e8df', 'Gopal Lingam', NULL),
(16, 'Ahsend', '50a23adf39cd71ba60a278dc4c75c24d', 'Ahseng', NULL),
(17, 'Ahlong', '612ffca56c5eb93808f881b901733459', 'Ahlong Bukit Beruntung', NULL),
(18, 'Jaya', 'ce9689abdeab50b5bee3b56c7aadee27', 'Jaya Kantan', NULL),
(19, 'Rosli', 'f11ae6deb12cfe5e9ec59d15a56682ad', 'Rosli', NULL),
(20, 'a10', '48881d728a96516e0e886c09603e7eee', 'a10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

DROP TABLE IF EXISTS `users_data`;
CREATE TABLE IF NOT EXISTS `users_data` (
`id` int(3) unsigned NOT NULL,
  `users_id` int(3) unsigned NOT NULL,
  `mobile` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`id`, `users_id`, `mobile`) VALUES
(2, 11, '1111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
 ADD PRIMARY KEY (`id`), ADD KEY `users_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
MODIFY `id` int(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_data`
--
ALTER TABLE `users_data`
ADD CONSTRAINT `users_data_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

