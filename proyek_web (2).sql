-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 05:03 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(123123, 'beauty'),
(123231, 'makeup'),
(123321, 'fashion');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(1, 41, 1, 'wiii keren banget kak', '2024-11-20 02:52:32'),
(3, 41, 1, 'wiii keren banget kak', '2024-11-20 03:05:24'),
(7, 39, 1, 'wiii keren banget kak', '2024-11-20 03:17:23'),
(8, 39, 2, 'waw, sangat bermanfaat sekali🥰', '2024-11-20 04:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `file_name` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `post_id`, `file_name`) VALUES
(17, 40, '1732069774119.jpg'),
(18, 40, '1732069782605.jpg'),
(19, 40, '1732069785130.jpg'),
(20, 40, '1732069787616.jpg'),
(21, 40, '1732069790006.jpg'),
(22, 40, '1732069792357.jpg'),
(23, 40, '1732069794892.jpg'),
(24, 40, '1732069797397.jpg'),
(25, 41, '1732070180932.jpg'),
(26, 41, '1732070183283.jpg'),
(27, 41, '1732070186779.jpg'),
(28, 41, '1732070189084.jpg'),
(29, 41, '1732070191502.jpg'),
(30, 41, '1732070193875.jpg'),
(31, 39, '1732069051674-1732073311.jpg'),
(32, 39, '1732069054396-1732073311.jpg'),
(33, 39, '1732069056853-1732073311.jpg'),
(34, 39, '1732069059250-1732073311.jpg'),
(35, 39, '1732069061624-1732073311.jpg'),
(36, 42, '1732068974363.jpg'),
(37, 42, '1732068976854.jpg'),
(38, 42, '1732068979253.jpg'),
(39, 42, '1732068981539.jpg'),
(40, 42, '1732068983916.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `category_id`, `author_id`, `views`, `created_at`, `comment_id`) VALUES
(39, 'Urutan Makeup Lengkap, Kamu harus tau', 'Hallo Sobat Glowify!🎀 siapa disini yang baru belajar makeup?\r\nkali ini aku mau share urutan makeup, versi full makeup, ya...\r\n.\r\n.\r\nkalau kalian ada pertanyaan atau request, please do leave your comments dibawah ya..\r\nhope it helps🎀 \r\n', 123231, 1, 0, '2024-11-20 02:28:24', NULL),
(40, 'Mix and Match pakai color theory', 'Hai glowify!\r\n\r\nkalian sudah tau belum color theory itu apa? dilansir dari Interaction Design Foundation, Color theory adalah pedoman yang digunakan oleh desainer untuk menyampaikan pesan kepada pengguna melalui warna.\r\n\r\nNah kali ini aku mau share cara mix and match outfit menggunakan color theory:\r\n1. tentukan warna primer (warna utama)\r\n2. pilih jenis skema warna yg ingin digunakan untuk mix and match (analogous, monochromatic complimentary)\r\n3. lihat color wheel untuk mix and match\r\n4. sesuaikan juga dengan warnaz baju yang kamu miliki ya\r\n\r\nsemoga bermanfaat.', 123321, 1, 0, '2024-11-20 02:35:06', NULL),
(41, 'Rahasia glowing alami dengan jus sehat', 'Hi glowify...\r\nSiapa sih yang gak pengen punya kulit glowing? Aku dulu juga sering minder karena kulit kusam. Tapi, setelah minum jus sehat rutin, eh, kulitku jadi lebih cerah dan kenyal!\r\n\r\nJus buah dan sayur kaya vitamin dan antioksidan yang bikin kulit kinclong. Coba deh jus wortel, apel, jeruk, atau bayam, apel, nanas. Rasanya enak dan bikin kulit glowing!\r\n\r\nGak perlu ribet beli produk mahal, lho. Buat jus sendiri di rumah aja. Tambahin bahan lain sesuai selera, dan minum setiap pagi.\r\n\r\nSelain bikin kulit glowing, jus sehat juga bikin badan lebih sehat dan segar. Yuk, mulai gaya hidup sehat dengan minum jus!\r\n\r\nMau kulit glowing bebas minder? Ayo coba jus sehat ini !!', 123123, 1, 0, '2024-11-20 02:40:32', NULL),
(42, 'Tips cantik tanpa makeup', 'tips biar kulitmu glowing natural, putih, dan muluss...\r\n\r\nini dia rahasianya guyss, tips ini harus digunakan secara rutin selama sebulan yah, agar hasilnya memuaskan🥰🥰', 123123, 2, 0, '2024-11-20 03:59:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`) VALUES
(1, 'admin gacor', 'wkwkwk'),
(2, 'ainy', 'ayinny'),
(3, 'finka', 'pink12345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123322;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `file_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
