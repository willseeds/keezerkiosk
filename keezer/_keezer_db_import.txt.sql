-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2020 at 11:30 AM
-- Server version: 10.1.23-MariaDB-9+deb9u1
-- PHP Version: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keezer`
--

-- --------------------------------------------------------

--
-- Table structure for table `beers`
--

CREATE TABLE `beers` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'PRIMARY KEY - DO NOT DISTURB',
  `beername` varchar(30) NOT NULL COMMENT 'This is used throughout the site as a primary key. Dont move or rename.',
  `abv` varchar(30) NOT NULL COMMENT 'for entering ABV level in the Add page. decimals can be used.',
  `ibu` int(3) NOT NULL COMMENT '3 numbers but can change.',
  `stylename` varchar(50) NOT NULL COMMENT 'Free-form field for style types.',
  `stylecolor` int(2) NOT NULL COMMENT 'This field is used for the style page to look up beers of similar type.',
  `datebrewed` date NOT NULL COMMENT 'Default first date field for showing beers in future for the UPCOMING page.',
  `datekegged` date NOT NULL COMMENT 'Using this with the tapno field is how beers are shown on index pages. Do not change.',
  `datekicked` date NOT NULL COMMENT 'This has to be an active date to show in the HISTORY page.',
  `comments` text NOT NULL COMMENT 'Use for brewing comments or just tasting comments to share with readers on the site.',
  `tapno` varchar(2) NOT NULL DEFAULT '0' COMMENT 'Can be updated to be any tap no, but make sure its an available one from the amount of taps you have.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beers`
--

INSERT INTO `beers` (`id`, `beername`, `abv`, `ibu`, `stylename`, `stylecolor`, `datebrewed`, `datekegged`, `datekicked`, `comments`, `tapno`) VALUES
(1, 'Test Hefe', '5.0', 15, 'American Wheat Ale', 3, '2018-08-06', '2018-08-06', '2018-08-06', 'My first kegged beer. Put on a single-tap 5 gallon keg in my fridge. ', '1'),
(2, 'Test Lager', '4.73', 10, 'German Lager', 1, '2019-02-17', '2019-02-24', '2019-03-24', 'Was a little darker than the style criteria is, but a good beer for getting stuff done around the house. ', '1'),
(3, 'Test Lager', '4.74', 10, 'German Lager', 1, '2019-03-02', '2019-03-09', '2019-04-09', 'Clear and refreshing with a shining golden color. Gelatin fining is a great idea for this style. ', '3'),
(4, 'Test Hefe', '6.2', 20, 'American Wheat Ale', 3, '2019-08-16', '2019-08-23', '2019-09-23', 'A good extract beer made in 30 min. Hops are a little more present than style calls for, but the fresh-hop season always calls for this style. ', '1'),
(5, 'Test Irish Red', '4.2', 20, 'Irish Red Ale', 7, '2019-08-03', '2019-08-11', '2019-09-11', 'A light alc alternative in this caramel-sweetness creation. The Reds and Ambers always have a low-hop profile, so this is a good one if you aren\'t sure what you want. ', '2'),
(6, 'Test Pale Ale', '6.23', 30, 'American IPA', 4, '2019-09-22', '2019-09-29', '2019-10-29', 'OG: 1.059 FG: 1.011 (6.23%abv). mmm mmm good. Nice hop range for this style of beer. ', '3'),
(7, 'Test Brown Ale', '4.9', 20, 'Brown Ale', 8, '2019-10-01', '2019-10-09', '2019-11-09', 'Crisp and clean for a dark beer. This came out more roasted that I liked, so some changes will happen later. ', '2'),
(8, 'Test Porter Ale', '5.51', 20, 'American Ale', 9, '2019-10-05', '2019-10-12', '2019-11-12', 'Used alternate recipe for dialing back some bitterness caused by a single grain in the bill. Swapped that with another and its very malty and low-hop profile. ', '1'),
(9, 'Test Hazy IPA', '5.57', 30, 'American IPA', 5, '2019-11-02', '2019-11-10', '2019-12-10', 'This ended up a little less ABV than I wanted, but the hops and sweetness were worth it to have a few more. Juicy style hazy, with an ABV that allows a couple more.', '1'),
(10, 'Test Stout ', '6.7', 25, 'American Ale', 2, '2019-11-09', '2019-11-16', '0000-00-00', 'This was left over from a barrel that was filled. Its ok, but you have to like stouts. ', '1'),
(18, 'Test Pale Ale', '5.5', 40, 'American IPA', 4, '2020-06-20', '2020-07-03', '0000-00-00', 'Another round of this beer. Always good for holiday times with friends and family.', '4'),
(19, 'Test Double IPA', '7.5', 65, 'American IPA', 5, '2020-07-15', '2020-07-18', '0000-00-00', 'This is a single-glass type of beer. You will not be functional after a second glass. The residual sweetness and high-hop sting balance too well.', '6'),
(20, 'Test Amber', '5.2', 30, 'American Ale', 6, '2020-12-31', '0000-00-00', '0000-00-00', 'This beer is for a future date so it can be seen in the \"Upcoming\" selections. A nice glass of clear Amber clears the mind...', '0'),
(22, 'Test Amber Ale', '5.5', 20, 'American Ale', 0, '0000-00-00', '0000-00-00', '0000-00-00', 'This style is always a pleasure in early fall. ', '0');

-- --------------------------------------------------------

--
-- Table structure for table `stylelist`
--

CREATE TABLE `stylelist` (
  `id` int(11) NOT NULL COMMENT 'PRIMARY KEY - DO NOT DISTURB',
  `stylename` text NOT NULL COMMENT 'General info based on what style of beer your are brewing. ',
  `stylecolor` int(2) NOT NULL COMMENT 'Do Not disturb - Used for references in the Style page.',
  `iburange` text NOT NULL COMMENT 'General info',
  `htmlcolor` varchar(6) NOT NULL COMMENT 'Sets the color of the type on the page. Can update to reflect a better view on your screen.',
  `stylecomment` text NOT NULL COMMENT 'General info'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stylelist`
--

INSERT INTO `stylelist` (`id`, `stylename`, `stylecolor`, `iburange`, `htmlcolor`, `stylecomment`) VALUES
(1, 'Lager', 1, '8 to 18', 'FBFE8C', 'Carbonation that is higher than normal, with usually a smooth freshing finish. Almost zero hop presence. '),
(2, 'Blonde Ale', 2, '15 to 28', 'FAFE58', 'Mild malt flavor with a low-hop presence. May taste hops a little more in this style. '),
(3, 'Hefeweizen', 3, '15 to 30', 'F9FE3C', 'Known for its cloudy appearance and wheat flavor, it also contains a forward yeast character. '),
(4, 'Pale Ale', 4, '30 to 50', 'F9FE30', 'Spicy, earthy or aromatic flavors. Bitterness units can vary from bitter only to various forms of hopping. '),
(5, 'India Pale Ale', 5, '40 to 70', 'F7FD01', 'IPA sytles are known for not only floral arrangements in all stages of brewing, but also used in the fermentation stages.'),
(6, 'Amber Ale', 6, '25 to 40', 'A60F02', 'Balance of low to medium hop bitterness and malt profile. '),
(7, 'Irish Red Ale', 7, '18 to 28', '5F0B07', 'Malty caramel sweetness. Can be sweet or dry, but low hop profile. '),
(8, 'Brown Ale', 8, '20 to 30', '673300', 'Darker malts with hints of toffee and caramel. '),
(9, 'Porter', 9, '25 to 50', '4E2700', 'Notes of chocolate and mild roast malt. '),
(10, 'Stout', 10, '35 to 75', '1F0506', 'Coffee, chocolate, molassess and medium to highly roasted malt flavors. ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beers`
--
ALTER TABLE `beers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stylelist`
--
ALTER TABLE `stylelist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beers`
--
ALTER TABLE `beers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY KEY - DO NOT DISTURB', AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `stylelist`
--
ALTER TABLE `stylelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY KEY - DO NOT DISTURB', AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
