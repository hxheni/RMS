-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2018 at 07:02 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cen`
--

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `id` int(20) NOT NULL,
  `name` text NOT NULL,
  `photo` text NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `category` enum('dishes','pasta','pizza','desert','drink') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `photo`, `description`, `price`, `category`) VALUES
(1, 'Burger', 'burger.jpg', 'panera bread, chicken, mayonnaise', 15, 'dishes'),
(2, 'Chicken Salad', 'chickensalad.jpg', 'chicken, salad, tomatoes', 20, 'dishes'),
(3, 'Fish pie', 'fish.jpg', 'A very special pie made of fish', 40, 'dishes'),
(4, 'Lasagne', 'lasagna.jpg', 'Italian Lasagna, very delicious', 40, 'dishes'),
(5, 'Risotto', 'risoto.jpg', 'rice, bacon, zuchhini', 20, 'dishes'),
(6, 'Caesar Salad', 'caesarsalad.jpg', 'a special type of salad', 24, 'dishes'),
(7, 'Pizza Margherita', 'pizzamargherita.jpg', 'world''s most famous pizza', 33, 'pizza'),
(8, 'Pizza Capricciosa', 'pizzacapriciosa.jpg', 'olives, tomato sauce, mushrooms', 40, 'pizza'),
(9, 'White Pizza', 'whitepizza.jpg', 'eggs, bacon', 40, 'pizza'),
(10, 'Pizza Romana', 'pizzaromania.jpg', 'olives, brie cheese, salami, zuchhini', 50, 'pizza'),
(11, 'Pizza Viennese', 'pizza vienesse.jpg', 'olives, tomatoes, pepper, ham', 45, 'pizza'),
(12, 'Spaghetti', 'sphageti.jpg', 'tomato sauce, grated cheese', 23, 'pasta'),
(13, 'Cheesecake', 'cheescake.jpg', 'one of our best cheesecakes', 20, 'desert'),
(14, 'Apple pie', 'applepie.jpg', 'apple pie', 20, 'desert'),
(15, 'Strawberry Cake', 'strawberrycake.jpg', 'a wonderful dessert! must try', 29, 'desert'),
(34, 'Spaghetti Carbonara', 'sphageti.jpg', 'carbonara', 20, 'pasta');

-- --------------------------------------------------------

--
-- Table structure for table `d_pr`
--

CREATE TABLE `d_pr` (
  `dishId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_pr`
--

INSERT INTO `d_pr` (`dishId`, `productId`, `quantity`) VALUES
(1, 5, 0.05),
(1, 11, 0.1),
(1, 9, 0.1),
(1, 20, 0.05),
(1, 21, 0.1),
(1, 22, 0.05),
(2, 5, 0.1),
(2, 9, 0.3),
(2, 20, 0.3),
(2, 22, 0.08),
(3, 30, 0.1),
(3, 25, 0.2),
(4, 8, 0.3),
(4, 30, 0.05),
(4, 19, 0.2),
(4, 20, 0.05),
(4, 22, 0.05),
(5, 18, 0.1),
(5, 6, 0.05),
(5, 31, 0.1),
(6, 5, 0.1),
(6, 9, 0.2),
(6, 11, 0.1),
(6, 20, 0.1),
(6, 22, 0.05),
(7, 5, 0.2),
(7, 11, 0.2),
(7, 20, 0.1),
(7, 32, 0.2),
(7, 30, 0.2),
(8, 30, 0.2),
(8, 20, 0.1),
(8, 11, 0.3),
(9, 5, 0.1),
(9, 11, 0.2),
(8, 33, 0.3),
(8, 32, 0.1),
(9, 33, 0.2),
(9, 32, 0.1),
(9, 30, 0.1),
(10, 11, 0.2),
(10, 20, 0.1),
(10, 30, 0.1),
(10, 32, 0.1),
(10, 33, 0.2),
(11, 5, 0.1),
(11, 20, 0.2),
(11, 30, 0.1),
(11, 32, 0.1),
(11, 33, 0.2),
(12, 34, 0.1),
(12, 20, 0.1),
(12, 22, 0.05),
(12, 8, 0.1),
(12, 24, 0.05),
(13, 1, 0.1),
(13, 35, 0.2),
(13, 36, 0.2),
(13, 37, 0.01),
(13, 6, 0.1),
(14, 1, 0.1),
(14, 6, 0.1),
(14, 38, 0.2),
(14, 39, 0.01),
(14, 37, 0.01),
(14, 30, 0.1),
(15, 1, 0.1),
(15, 4, 0.1),
(15, 6, 0.1),
(15, 26, 0.2),
(15, 35, 0.1),
(15, 30, 0.1),
(15, 37, 0.01),
(34, 19, 0.015),
(34, 9, 0.024),
(34, 20, 0.019);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `text` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `senderId`, `receiverId`, `text`, `status`) VALUES
(106, 1, 1, 'Rroga e ketij muaji u fut me sukses.', 0),
(227, 9, 3, 'Rroga e ketij muaji u fut me sukses.', 0),
(348, 9, 5, 'Rroga e ketij muaji u fut me sukses.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `tableId` int(5) NOT NULL,
  `chefId` int(5) DEFAULT '0',
  `isReady` tinyint(1) NOT NULL,
  `amount` double NOT NULL,
  `waiterId` int(5) NOT NULL,
  `description` varchar(70) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tableId`, `chefId`, `isReady`, `amount`, `waiterId`, `description`, `status`, `paid`) VALUES
(1, 1, 3, 1, 104, 5, 'hmm', 1, 1),
(2, 3, 3, 1, 300, 0, 'kjhk', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `or_dish`
--

CREATE TABLE `or_dish` (
  `orderId` int(11) NOT NULL,
  `dishId` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `or_dish`
--

INSERT INTO `or_dish` (`orderId`, `dishId`, `amount`) VALUES
(1, 1, 3),
(1, 2, 4),
(1, 3, 5),
(1, 1, 1),
(1, 14, 1),
(1, 15, 1),
(1, 34, 2);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `task` enum('admin','accountant','chef','waiter','other') NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `salary` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `surname`, `username`, `password`, `phone`, `task`, `photo`, `salary`) VALUES
(1, 'Aron', 'Hoxha', 'aron.hoxha', '9d61126748f303c385510c45eaf63f', '0689321402', 'admin', 'photo1.jpg', 200),
(2, 'Marjon', 'Hala', 'marjon.hala', '9d61126748f303c385510c45eaf63f', '0698754321', 'chef', 'photo2.jpg', 300),
(3, 'Marlind', 'Sejdini', 'malind.sejdini', '9d61126748f303c385510c45eaf63f', '0694567832', 'chef', 'photo3.jpg', 100),
(4, 'Kevi', 'Doda', 'kevi.doda', '9d61126748f303c385510c45eaf63f', '0692345678', 'waiter', 'photo4.jpg', 300),
(5, 'Bledar', 'Kaca', 'bledar.kaca', 'ff551fe5733d16002ce0b146dfd2a1', '+355698106722', 'waiter', 'photo2.jpg', 200),
(6, 'Endri', 'Balla', 'endri.balla', '9d61126748f303c385510c45eaf63f', '0698967543', 'waiter', 'photo6.jpg', 200),
(7, 'Armir', 'Kurti', 'armir.kurti', '9d61126748f303c385510c45eaf63f', '0691234567', 'waiter', 'photo7.jpg', 300),
(8, 'Saed', 'Hasa', 'saed.hasa', '9d61126748f303c385510c45eaf63f', '0699653214', 'waiter', 'photo8.jpg', 300),
(9, 'Artur', 'Paja', 'artur.paja', 'ff551fe5733d16002ce0b146dfd2a1', '+355698106722', 'accountant', 'photo1.jpg', 500),
(11, 'Andel', 'Gugu', 'andel.gugu', '9d61126748f303c385510c45eaf63f', '0698765445', 'admin', 'photo1.jpg', 500),
(19, 'halim', 'hoxha', 'halim.hoxha', '9d61126748f303c385510c45eaf63f', '0689321402', 'admin', 'photo1.jpg', 600),
(20, 'halim', 'cela', 'halim.cela', '9d61126748f303c385510c45eaf63f', '0695213569', 'admin', 'photo1.jpg', 500),
(21, 'halim', 'miri', 'halim.miri', '9d61126748f303c385510c45eaf63f', '0695213569', 'admin', 'photo2.jpg', 300),
(22, 'Kasem', 'Fiku', 'kasem.fiku', '9d61126748f303c385510c45eaf63f', '0695213569', 'admin', 'photo2.jpg', 452);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` smallint(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `quantity` double NOT NULL,
  `price` double NOT NULL,
  `measurement` enum('kg','L','can/bottle','piece') NOT NULL,
  `threshold` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`, `measurement`, `threshold`) VALUES
(1, 'sugar', 6.8, 4, 'kg', 5),
(2, 'salt', 13, 2, 'kg', 5),
(3, 'pepper', 12, 1, 'kg', 7),
(4, 'milk', 9.2, 2, 'L', 8),
(5, 'cheese', 17.1, 5, 'kg', 10),
(6, 'butter', 6, 3, 'kg', 5),
(7, 'olive oil', 10, 6, 'L', 5),
(8, 'beef', 5.6, 5, 'kg', 5),
(9, 'chicken', 4, 4, 'kg', 5),
(10, 'lamb', 6, 3, 'kg', 4),
(11, 'ham', 7.4, 5, 'kg', 4),
(12, 'water', 50, 1, 'L', 10),
(13, 'wine', 20, 10, 'L', 5),
(14, 'cola', 100, 5, 'can/bottle', 20),
(15, 'lemon soda', 100, 5, 'can/bottle', 20),
(16, 'beer', 100, 4, 'can/bottle', 20),
(17, 'fruit juice', 99.48, 5, 'can/bottle', 9),
(18, 'rice', 10, 2, 'kg', 5),
(19, 'pasta', 8.97, 2, 'kg', 5),
(20, 'tomato', 31.312, 2, 'kg', 6),
(21, 'potato', 13.8, 1, 'kg', 4),
(22, 'onions', 5.48, 1, 'kg', 4),
(24, 'garlic', 20, 1, 'kg', 5),
(25, 'fish', 22.4, 10, 'kg', 5),
(26, 'strawberry', 6.4, 5, 'kg', 4),
(27, 'banana', 9, 2, 'kg', 3),
(28, 'chocolate', 6, 14, 'kg', 3),
(29, 'coffee', 30, 4, 'kg', 6),
(30, 'flour', 89.3, 1, 'kg', 30),
(31, 'pea', 5, 3, 'kg', 3),
(32, 'olives', 50, 3, 'kg', 10),
(33, 'mozzarella', 50, 5, 'kg', 10),
(34, 'spaghetti ', 40, 3, 'kg', 10),
(35, 'mascarpone', 39.9, 5, 'kg', 7),
(36, 'cream cheese', 20, 5, 'kg', 6),
(37, 'vanilla', 79.98, 1, 'kg', 10),
(38, 'apple', 10.6, 2, 'kg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `staffId` int(11) NOT NULL,
  `month` varchar(10) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`staffId`, `month`, `year`) VALUES
(2, 'May', 2018),
(1, 'May', 2018),
(3, 'May', 2018),
(4, 'May', 2018),
(11, 'May', 2018),
(9, 'May', 2018),
(8, 'May', 2018),
(1, 'Jun', 2018),
(3, 'Jun', 2018),
(5, 'Jun', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` text NOT NULL,
  `description` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `description`, `email`, `photo`) VALUES
(1, 'Big market', '0674523651', '', 'Bmarket@gmail.com', 'bigmarket.jpg'),
(2, 'Alb market', '0678976123', '', 'Amarket@gmail.com', 'albmarket.png'),
(3, 'Coca Cola', '0674698732', '', 'Ccola@gmail.com', 'coca.jpg'),
(4, 'Hako', '0681234675', '', 'Hako@gmail.com', 'hako.png'),
(5, 'Aldi Shpk', '0666543210', '', 'Aldishpk@gmail.com', 'aldi.png'),
(6, 'Blinat', '0698877665', '', 'Blinat02@gmail.com', 'blinat.jpg'),
(7, 'Someg', '069112233567', '', 'Someg18@yahoo.com', 'someg.jpg'),
(8, 'Point', '0686785943', '', 'Point2018@yahoo.com', 'point.png'),
(10, 'Eco Market', '0687689321', '', 'Emarket@gmail.com', 'echo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `tableNumber` tinyint(4) NOT NULL,
  `isAvailable` enum('yes','no') NOT NULL,
  `password` varchar(30) NOT NULL,
  `numChairs` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`tableNumber`, `isAvailable`, `password`, `numChairs`) VALUES
(1, 'yes', 'table1', 4),
(2, 'yes', 'table2', 5),
(3, 'yes', 'table3', 4),
(4, 'yes', 'table4', 6),
(5, 'yes', 'table5', 7),
(6, 'yes', 'table6', 8),
(7, 'yes', 'table7', 8),
(8, 'yes', 'table8', 3),
(9, 'yes', 'table9', 5),
(10, 'yes', 'table10', 6),
(15, 'yes', 'table15', 3),
(18, 'yes', 'table18', 5),
(25, 'yes', 'table25', 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `transmakerId` varchar(20) NOT NULL,
  `status` enum('hyrje','dalje') DEFAULT NULL,
  `amount` double NOT NULL,
  `description` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transmakerId`, `status`, `amount`, `description`) VALUES
(3, '1', 'dalje', 100, 'rroga'),
(4, '1', 'dalje', 200, 'rroga'),
(5, '1', 'dalje', 133, 'rroga'),
(6, '1', 'dalje', 110, 'rroga'),
(7, '1', 'dalje', 110, 'rroga'),
(8, '1', 'dalje', 110, 'rroga'),
(9, '1', 'hyrje', 100, 'rroga'),
(10, '1', 'hyrje', 100, 'pagese'),
(11, '5', 'hyrje', 64, 'porosi'),
(12, '5', 'hyrje', 50, 'porosi'),
(13, '4', 'hyrje', 122, 'porosi'),
(14, '1', 'dalje', 200, 'rroga'),
(15, '9', 'dalje', 6, 'porosi ushqime'),
(16, '9', 'dalje', 4, 'porosi ushqime'),
(17, '5', 'hyrje', 300, 'porosi'),
(18, '9', 'dalje', 2, 'porosi ushqime nga Artur Paja'),
(19, '9', 'dalje', 5, 'porosi ushqime nga Hako@gmail.com'),
(20, '9', 'dalje', 100, 'rroga'),
(21, '9', 'dalje', 200, 'rroga'),
(22, '9', 'dalje', 4, 'porosi ushqime'),
(23, '9', 'dalje', 4, 'porosi ushqime'),
(24, '9', 'dalje', 12, 'porosi ushqime'),
(25, '9', 'dalje', 20, 'porosi ushqime'),
(26, '9', 'dalje', 6, 'porosi ushqime'),
(27, '9', 'dalje', 6, 'porosi ushqime'),
(28, '9', 'dalje', 12, 'porosi ushqime'),
(29, '9', 'dalje', 5, 'porosi ushqime'),
(30, '9', 'hyrje', 100, 'borxh'),
(31, '5', 'hyrje', 104, 'porosi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `50` (`name`(50));

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD UNIQUE KEY `tableNumber` (`tableNumber`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
