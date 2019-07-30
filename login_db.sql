-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2018 at 07:01 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `countIssuedBooks` (IN `studentName` VARCHAR(255))  BEGIN
 SELECT *
 FROM issue_books
 WHERE student_username = studentName AND books_return_date = 'N';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `add_books`
--

CREATE TABLE `add_books` (
  `ISBN` varchar(20) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_image` varchar(500) NOT NULL,
  `book_author_name` varchar(255) NOT NULL,
  `book_publication_name` varchar(255) NOT NULL,
  `book_purchase_date` varchar(255) NOT NULL,
  `book_price` float NOT NULL,
  `book_quantity` int(11) NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `librarian_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_books`
--

INSERT INTO `add_books` (`ISBN`, `book_title`, `book_image`, `book_author_name`, `book_publication_name`, `book_purchase_date`, `book_price`, `book_quantity`, `available_quantity`, `librarian_username`) VALUES
('9788131788226', 'Automata, Computability and Complexity', './books_image/f663f97c7b4d85194a2e22cc2c482be7elane rich atc.jpg', 'Elaine Rich', 'Pearson', '22/06/2018', 550, 50, 50, 'admin'),
('9780070636774', 'Java - The Complete Reference', './books_image/af829d31a27f0a9568bc4fbf3c10e242java 7th ed.jpg', 'Herbert Schildt', 'McGrawHill', '05/05/2018', 750, 120, 120, 'admin'),
('9780198065302', 'Object Oriented Programming with C++', './books_image/7be88d4cfa09ea1f9482bff4d7ea7a5bc++ sahay.jpg', 'Sourav Sahay', 'Oxford University Press', '24/01/2018', 450, 30, 30, 'admin'),
('9780070635463', 'UNIX Concepts and Applications', './books_image/3ff643b53ced2399ce8ff0ad942461f6unix das.jpg', 'Sumithabha Das', 'McGrawHill', '20/10/2017', 500, 70, 70, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `issue_books`
--

CREATE TABLE `issue_books` (
  `id` int(5) NOT NULL,
  `student_enrollment` varchar(50) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `books_name` varchar(50) NOT NULL,
  `books_issue_date` varchar(50) NOT NULL,
  `books_return_date` varchar(50) NOT NULL,
  `student_username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_books`
--

INSERT INTO `issue_books` (`id`, `student_enrollment`, `student_name`, `books_name`, `books_issue_date`, `books_return_date`, `student_username`) VALUES
(118, '4bd17cs087', 'davs hbjb', 'Automata, Computability and Complexity', '21/11/18', '21/11/18', 'hhhbd');

--
-- Triggers `issue_books`
--
DELIMITER $$
CREATE TRIGGER `available_quantity_trigger` AFTER INSERT ON `issue_books` FOR EACH ROW update add_books 
set available_quantity=available_quantity-1 
where book_title= NEW.books_name
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `phno` varchar(15) NOT NULL,
  `enroll_no` varchar(15) NOT NULL,
  `validation_code` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `phno`, `enroll_no`, `validation_code`, `active`) VALUES
(4, 'admin_f', 'admin_l', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '', '', '0', 1),
(5, 'ad1', 'ad2', 'ad122', 'ad122@gmail.com', '6cb75f652a9b52798eb6cf2201057c73', '', '', '0', 1),
(6, 'aaa', 'aaa', 'aaa', 'aaa@aaa.com', '94b8cea57c49a3007225a0c70c475450', '', '', 'dcc5190dfa6a197bcad46ef576ab4533', 0),
(7, 'aaa', 'ccc', 'acaca', 'acaca@gmail.com', '94b8cea57c49a3007225a0c70c475450', '222', '222', '51ef8e7c66bd2d3a63b546ac946302e5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(5) NOT NULL,
  `librarian_username` varchar(50) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `student_read` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `librarian_username`, `student_username`, `title`, `message`, `student_read`) VALUES
(43, 'admin', 'pjsharath', 'welcome', 'welcome to you\r\n                                            ', 'n'),
(44, 'admin', 'pjsharath', 'aa', 'aa\r\n                                            ', 'n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `phno` varchar(15) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `enroll_no` varchar(15) NOT NULL,
  `librarian_approval` varchar(5) NOT NULL,
  `validation_code` text NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `phno`, `semester`, `enroll_no`, `librarian_approval`, `validation_code`, `active`) VALUES
(1, 'davs', 'hbjb', 'hhhbd', 'nidsn@gmail.com', '202cb962ac59075b964b07152d234b70', '0', '', '4bd17cs087', 'yes', '5acad243087437d55110627bd811e91d', 0),
(2, 'djrng', 'kdjfg', 'kfdb', 'fkdj@gmail.com', '202cb962ac59075b964b07152d234b70', '0', '', '', 'no', '8a4d9f45b68878c09706ba44cb8da605', 0),
(3, 'Sharath', 'Pj', 'pjsharath', 'pjsharath28@gmail.com', '6cb75f652a9b52798eb6cf2201057c73', '9900617700', '5th', '4BD16CS082', 'yes', '0', 1),
(4, 'abcd', 'wxyz', 'johndoe', 'abcdwxyz@gmail.com', '6cb75f652a9b52798eb6cf2201057c73', '9876543210', '5', '4BDCS001', '', '0', 1),
(5, 'aaa', 'bbb', 'aaabbb', 'aaabbb@gmail.com', '6cb75f652a9b52798eb6cf2201057c73', '9898989898', '4', '4BD16EC086', 'yes', '4bf811e8e865065f5db42bcab375c780', 0),
(6, 'Sangeetha', 'M J', 'sangeethamj', 'sangeethamj@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9898989898', '5', '4BD16CS077', 'yes', '0', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_books`
--
ALTER TABLE `add_books`
  ADD PRIMARY KEY (`book_title`),
  ADD KEY `librarian_username` (`librarian_username`);

--
-- Indexes for table `issue_books`
--
ALTER TABLE `issue_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_name` (`books_name`),
  ADD KEY `student_username` (`student_username`);

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_username` (`student_username`),
  ADD KEY `librarian_username` (`librarian_username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issue_books`
--
ALTER TABLE `issue_books`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_books`
--
ALTER TABLE `add_books`
  ADD CONSTRAINT `add_books_ibfk_1` FOREIGN KEY (`librarian_username`) REFERENCES `librarians` (`username`);

--
-- Constraints for table `issue_books`
--
ALTER TABLE `issue_books`
  ADD CONSTRAINT `issue_books_ibfk_1` FOREIGN KEY (`books_name`) REFERENCES `add_books` (`book_title`),
  ADD CONSTRAINT `issue_books_ibfk_2` FOREIGN KEY (`student_username`) REFERENCES `users` (`username`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`student_username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`librarian_username`) REFERENCES `librarians` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
