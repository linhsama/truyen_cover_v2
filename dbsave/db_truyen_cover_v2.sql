-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for truyen_cover_v2
CREATE DATABASE IF NOT EXISTS `truyen_cover_v2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `truyen_cover_v2`;

-- Dumping structure for table truyen_cover_v2.chapter
CREATE TABLE IF NOT EXISTS `chapter` (
  `chapter_id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_so` int(10) unsigned NOT NULL,
  `chapter_ten` mediumtext NOT NULL,
  `chapter_ngay_cap_nhat` datetime NOT NULL DEFAULT current_timestamp(),
  `chapter_trang_thai` tinyint(4) NOT NULL,
  `truyen_id` int(11) NOT NULL,
  PRIMARY KEY (`chapter_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table truyen_cover_v2.chapter: ~61 rows (approximately)
INSERT INTO `chapter` (`chapter_id`, `chapter_so`, `chapter_ten`, `chapter_ngay_cap_nhat`, `chapter_trang_thai`, `truyen_id`) VALUES
	(1, 1, 'Chap 1', '2024-01-01 18:46:52', 1, 1),
	(2, 2, 'Chap 2', '2024-01-01 18:50:25', 1, 1),
	(3, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 1),
	(4, 1, 'Chap 1', '2024-01-01 18:50:29', 1, 2),
	(5, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 2),
	(6, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 2),
	(7, 4, 'Chap 4', '2024-01-01 18:50:29', 1, 2),
	(8, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 3),
	(9, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 3),
	(10, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 3),
	(11, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 4),
	(12, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 4),
	(13, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 4),
	(14, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 5),
	(15, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 5),
	(16, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 5),
	(17, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 6),
	(18, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 6),
	(19, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 6),
	(20, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 7),
	(21, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 7),
	(22, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 7),
	(23, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 8),
	(24, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 8),
	(25, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 8),
	(26, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 9),
	(27, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 9),
	(28, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 9),
	(29, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 10),
	(30, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 10),
	(31, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 10),
	(32, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 11),
	(33, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 11),
	(34, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 11),
	(35, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 12),
	(36, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 12),
	(37, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 12),
	(38, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 13),
	(39, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 13),
	(40, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 13),
	(41, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 14),
	(42, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 14),
	(43, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 14),
	(44, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 15),
	(45, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 15),
	(46, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 15),
	(47, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 16),
	(48, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 16),
	(49, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 16),
	(50, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 17),
	(51, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 17),
	(52, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 17),
	(53, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 18),
	(54, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 18),
	(55, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 18),
	(56, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 19),
	(57, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 19),
	(58, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 19),
	(59, 1, 'Chap 2', '2024-01-01 18:50:29', 1, 20),
	(60, 2, 'Chap 2', '2024-01-01 18:50:29', 1, 20),
	(61, 3, 'Chap 3', '2024-01-01 18:50:29', 1, 20);

-- Dumping structure for table truyen_cover_v2.chapter_noi_dung
CREATE TABLE IF NOT EXISTS `chapter_noi_dung` (
  `chapter_noi_dung_id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_noi_dung_image` mediumtext DEFAULT NULL,
  `chapter_id` int(11) NOT NULL,
  PRIMARY KEY (`chapter_noi_dung_id`),
  KEY `FK_chapter_noi_dung_chapter` (`chapter_id`),
  CONSTRAINT `FK_chapter_noi_dung_chapter` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table truyen_cover_v2.chapter_noi_dung: ~94 rows (approximately)
INSERT INTO `chapter_noi_dung` (`chapter_noi_dung_id`, `chapter_noi_dung_image`, `chapter_id`) VALUES
	(1, 'uploads/1/002_1706461693.png', 1),
	(2, 'uploads/1/003_1706461693.png', 1),
	(3, 'uploads/1/004_1706461693.png', 1),
	(4, 'uploads/1/005_1706461693.png', 1),
	(5, 'uploads/1/006_1706461693.png', 1),
	(6, 'uploads/1/007_1706461693.png', 1),
	(7, 'uploads/1/008_1706461693.png', 1),
	(8, 'uploads/1/009_1706461693.png', 1),
	(9, 'uploads/1/010_1706461693.png', 1),
	(10, 'uploads/1/011_1706461693.png', 1),
	(11, 'uploads/1/012_1706461693.png', 1),
	(12, 'uploads/1/013_1706461693.png', 1),
	(13, 'uploads/1/014_1706461693.png', 1),
	(14, 'uploads/1/015_1706461693.png', 1),
	(15, 'uploads/1/016_1706461693.png', 1),
	(16, 'uploads/1/017_1706461693.png', 1),
	(17, 'uploads/1/018_1706461693.png', 1),
	(18, 'uploads/1/019_1706461693.png', 1),
	(19, 'uploads/1/020_1706461693.png', 1),
	(20, 'uploads/1/021_1706461693.png', 1),
	(21, 'uploads/1/022_1706461693.png', 1),
	(22, 'uploads/1/023_1706461693.png', 1),
	(23, 'uploads/1/024_1706461693.png', 1),
	(24, 'uploads/1/025_1706461693.png', 1),
	(25, 'uploads/1/026_1706461693.png', 1),
	(26, 'uploads/1/027_1706461693.png', 1),
	(27, 'uploads/1/028_1706461693.png', 1),
	(28, 'uploads/1/029_1706461693.png', 1),
	(29, 'uploads/1/030_1706461693.png', 1),
	(30, 'uploads/1/031_1706461693.png', 1),
	(31, 'uploads/1/032_1706461693.png', 1),
	(32, 'uploads/1/033_1706461693.png', 1),
	(33, 'uploads/1/034_1706461693.png', 1),
	(34, 'uploads/1/035_1706461693.png', 1),
	(35, 'uploads/1/036_1706461693.png', 1),
	(36, 'uploads/1/037_1706461693.png', 1),
	(37, 'uploads/1/038_1706461693.png', 1),
	(38, 'uploads/1/039_1706461693.png', 1),
	(39, 'uploads/1/040_1706461693.png', 1),
	(40, 'uploads/1/041_1706461693.png', 1),
	(41, 'uploads/1/042_1706461693.png', 1),
	(42, 'uploads/1/043_1706461693.png', 1),
	(43, 'uploads/1/044_1706461693.png', 1),
	(44, 'uploads/1/045_1706461693.png', 1),
	(45, 'uploads/1/046_1706461693.png', 1),
	(46, 'uploads/1/047_1706461693.png', 1),
	(47, 'uploads/1/048_1706461693.png', 1),
	(48, 'uploads/1/049_1706461693.png', 1),
	(49, 'uploads/1/050_1706461693.png', 1),
	(50, 'uploads/1/051_1706461693.png', 1),
	(51, 'uploads/1/001_1706461707.png', 2),
	(52, 'uploads/1/002_1706461707.png', 2),
	(53, 'uploads/1/003_1706461707.png', 2),
	(54, 'uploads/1/004_1706461707.png', 2),
	(55, 'uploads/1/005_1706461707.png', 2),
	(56, 'uploads/1/006_1706461707.png', 2),
	(57, 'uploads/1/007_1706461707.png', 2),
	(58, 'uploads/1/008_1706461707.png', 2),
	(59, 'uploads/1/009_1706461707.png', 2),
	(60, 'uploads/1/010_1706461707.png', 2),
	(61, 'uploads/1/011_1706461707.png', 2),
	(62, 'uploads/1/012_1706461707.png', 2),
	(63, 'uploads/1/013_1706461707.png', 2),
	(64, 'uploads/1/014_1706461707.png', 2),
	(65, 'uploads/1/015_1706461707.png', 2),
	(66, 'uploads/1/016_1706461707.png', 2),
	(67, 'uploads/1/017_1706461707.png', 2),
	(68, 'uploads/1/018_1706461707.png', 2),
	(69, 'uploads/1/019_1706461707.png', 2),
	(70, 'uploads/1/020_1706461707.png', 2),
	(71, 'uploads/1/021_1706461707.png', 2),
	(72, 'uploads/1/022_1706461707.png', 2),
	(73, 'uploads/1/023_1706461707.png', 2),
	(74, 'uploads/1/001_1706461730.png', 3),
	(75, 'uploads/1/002_1706461730.png', 3),
	(76, 'uploads/1/003_1706461730.png', 3),
	(77, 'uploads/1/004_1706461730.png', 3),
	(78, 'uploads/1/005_1706461730.png', 3),
	(79, 'uploads/1/006_1706461730.png', 3),
	(80, 'uploads/1/007_1706461730.png', 3),
	(81, 'uploads/1/008_1706461730.png', 3),
	(82, 'uploads/1/009_1706461730.png', 3),
	(83, 'uploads/1/010_1706461730.png', 3),
	(84, 'uploads/1/011_1706461730.png', 3),
	(85, 'uploads/1/012_1706461730.png', 3),
	(86, 'uploads/1/013_1706461730.png', 3),
	(87, 'uploads/1/014_1706461730.png', 3),
	(88, 'uploads/1/015_1706461730.png', 3),
	(89, 'uploads/1/016_1706461730.png', 3),
	(90, 'uploads/1/017_1706461730.png', 3),
	(91, 'uploads/1/018_1706461730.png', 3),
	(92, 'uploads/1/019_1706461730.png', 3),
	(93, 'uploads/1/020_1706461730.png', 3),
	(94, 'uploads/1/021_1706461730.png', 3);

-- Dumping structure for table truyen_cover_v2.nhom_truyen
CREATE TABLE IF NOT EXISTS `nhom_truyen` (
  `nhom_truyen_id` int(11) NOT NULL AUTO_INCREMENT,
  `nhom_truyen_ten` varchar(50) NOT NULL,
  `nhom_truyen_mo_ta` mediumtext NOT NULL,
  PRIMARY KEY (`nhom_truyen_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table truyen_cover_v2.nhom_truyen: ~2 rows (approximately)
INSERT INTO `nhom_truyen` (`nhom_truyen_id`, `nhom_truyen_ten`, `nhom_truyen_mo_ta`) VALUES
	(1, 'Manga', 'Manga'),
	(2, 'Manhwa', 'Manhwa');

-- Dumping structure for table truyen_cover_v2.tai_khoan
CREATE TABLE IF NOT EXISTS `tai_khoan` (
  `tai_khoan_id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_hien_thi` varchar(255) NOT NULL,
  `ten_tai_khoan` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `phan_quyen` tinyint(4) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL,
  PRIMARY KEY (`tai_khoan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table truyen_cover_v2.tai_khoan: ~4 rows (approximately)
INSERT INTO `tai_khoan` (`tai_khoan_id`, `ten_hien_thi`, `ten_tai_khoan`, `mat_khau`, `phan_quyen`, `trang_thai`) VALUES
	(1, 'admin', 'admin', 'p5Au4Zo=', 0, 1),
	(2, 'manager', 'manager', 'q5Ut6ZOBQQ==', 1, 1),
	(3, 'user', 'user', 's4cm+g==', 2, 1),
	(4, 'linh', 'linh', 'qp0t4A==', 2, 1);

-- Dumping structure for table truyen_cover_v2.the_loai
CREATE TABLE IF NOT EXISTS `the_loai` (
  `the_loai_id` int(11) NOT NULL AUTO_INCREMENT,
  `the_loai_ten` varchar(50) NOT NULL,
  `the_loai_mo_ta` mediumtext NOT NULL,
  PRIMARY KEY (`the_loai_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table truyen_cover_v2.the_loai: ~12 rows (approximately)
INSERT INTO `the_loai` (`the_loai_id`, `the_loai_ten`, `the_loai_mo_ta`) VALUES
	(1, 'Fantasy', 'Fantasy'),
	(2, 'Isekai', 'Isekai'),
	(3, 'Action', 'Action'),
	(4, 'Comedy', 'Comedy'),
	(5, 'Adventure', 'Adventure'),
	(6, 'Shounen', 'Shounen'),
	(7, 'Drama', 'Drama'),
	(8, 'School Life', 'School Life'),
	(9, 'Slice of Life', 'Slice of Life'),
	(10, 'Harem', 'Harem'),
	(11, 'Romance', 'Romance'),
	(12, 'Mystery', 'Mystery');

-- Dumping structure for table truyen_cover_v2.truyen
CREATE TABLE IF NOT EXISTS `truyen` (
  `truyen_id` int(11) NOT NULL AUTO_INCREMENT,
  `truyen_ten` text NOT NULL,
  `truyen_tac_gia` varchar(255) NOT NULL,
  `truyen_mo_ta` text NOT NULL,
  `truyen_anh_bia` text DEFAULT NULL,
  `truyen_tinh_trang` tinyint(4) NOT NULL DEFAULT 1,
  `truyen_luot_xem` int(11) NOT NULL DEFAULT 0,
  `truyen_luot_thich` int(11) NOT NULL DEFAULT 0,
  `truyen_luot_theo_doi` int(11) NOT NULL DEFAULT 0,
  `truyen_ngay_dang` datetime NOT NULL DEFAULT current_timestamp(),
  `truyen_trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  `nhom_truyen_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`truyen_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table truyen_cover_v2.truyen: ~20 rows (approximately)
INSERT INTO `truyen` (`truyen_id`, `truyen_ten`, `truyen_tac_gia`, `truyen_mo_ta`, `truyen_anh_bia`, `truyen_tinh_trang`, `truyen_luot_xem`, `truyen_luot_thich`, `truyen_luot_theo_doi`, `truyen_ngay_dang`, `truyen_trang_thai`, `nhom_truyen_id`) VALUES
	(1, 'ONE PIECE', 'Eiichirou Oda', 'One Piece là câu truyện kể về Luffy và các thuyền viên của mình. Khi còn nhỏ, Luffy ước mơ trở thành Vua Hải Tặc. Cuộc sống của cậu bé thay đổi khi cậu vô tình có được sức mạnh có thể co dãn như cao su, nhưng đổi lại, cậu không bao giờ có thể bơi được nữa. Giờ đây, Luffy cùng những người bạn hải tặc của mình ra khơi tìm kiếm kho báu One Piece, kho báu vĩ đại nhất trên thế giới. Trong One Piece, mỗi nhân vật trong đều mang một nét cá tính đặc sắc kết hợp cùng các tình huống kịch tính, lối dẫn truyện hấp dẫn chứa đầy các bước ngoặt bất ngờ và cũng vô cùng hài hước đã biến One Piece trở thành một trong những bộ truyện nổi tiếng nhất không thể bỏ qua.', 'uploads/1/001_1706458340.png', 1, 15399024, 15398, 15398, '2024-01-01 17:21:15', 1, 1),
	(2, 'JUJUTSU KAISEN - CHÚ THUẬT HỒI CHIẾN', 'Akutami Gege', 'Yuuji Itadori là một thiên tài có tốc độ và sức mạnh, nhưng cậu ấy muốn dành thời gian của mình trong Câu lạc bộ Tâm Linh. Một ngày sau cái chết của ông mình, anh gặp Megumi Fushiguro, người đang tìm kiếm vật thể bị nguyền rủa mà các thành viên CLB đã tìm thấy. Đối mặt với những con quái vật khủng khiếp bị "Ám", Yuuji nuốt vật thể bị phong ấn để có được sức mạnh của nó và cứu bạn bè của mình! Nhưng giờ Yuuji là người bị "Ám", và cậu ấy sẽ bị kéo vào thế giới ma quỷ ly kỳ của Megumi và những con quái vật độc ác ...', 'uploads/2/002_1706458368.png', 1, 1751408, 1751, 1751, '2024-01-01 17:23:54', 1, 1),
	(3, 'THÁM TỬ LỪNG DANH CONAN', 'Gosho Aoyama', 'Mở đầu câu truyện, cậu học sinh trung học 16 tuổi Shinichi Kudo bị biến thành cậu bé Conan Edogawa. Shinichi trong phần đầu của Thám tử lừng danh Conan được miêu tả là một thám tử học đường. Trong một lần đi chơi công viên "Miền Nhiệt đới" với cô bạn từ thuở nhỏ (cũng là bạn gái) Ran Mori , cậu bị dính vào vụ án một hành khách trên Chuyến tàu tốc hành trong công viên, Kishida , bị giết trong một vụ án cắt đầu rùng rợn. Cậu đã làm sáng tỏ vụ án và trên đường về nhà, chứng kiến một vụ làm ăn mờ ám của những người đàn ông mặc toàn đồ đen. Kudo bị phát hiện, bị đánh ngất sau đó những người đàn ông áo đen đã cho cậu uống một thứ thuốc độc chưa qua thử nghiệm là Apotoxin-4869 (APTX4869) với mục đích thủ tiêu cậu. Tuy nhiên chất độc đã không giết chết Kudo. Khi tỉnh lại, cậu bàng hoàng nhận thấy thân thể mình đã bị teo nhỏ trong hình dạng của một cậu học sinh tiểu học....', 'uploads/3/003_1706458400.png', 1, 1470934, 1470, 1470, '2024-01-01 17:24:27', 1, 1),
	(4, 'BLACK CLOVER', 'Tabata Yuuki', 'Aster và Yuno là hai đứa trẻ bị bỏ rơi ở nhà thờ và cùng nhau lớn lên tại đó. Khi còn nhỏ, chúng đã hứa với nhau xem ai sẽ trở thành Ma pháp vương tiếp theo. Thế nhưng, khi cả hai lớn lên, mọi sô chuyện đã thay đổi. Yuno là thiên tài ma pháp với sức mạnh tuyệt đỉnh trong khi Aster lại không thể sử dụng ma pháp và cố gắng bù đắp bằng thể lực. Khi cả hai được nhận sách phép vào tuổi 15, Yuno đã được ban cuốn sách phép cỏ bốn bá (trong khi đa số là cỏ ba lá) mà Aster lại không có cuốn nào. Tuy nhiên, khi Yuno bị đe dọa, sự thật về sức mạnh của Aster đã được giải mã- cậu ta được ban cuốn sách phép cỏ năm lá, cuốn sách phá ma thuật màu đen. Bấy giờ, hai người bạn trẻ đang hướng ra thế giới, cùng chung mục tiêu.', 'uploads/4/004_1706458414.png', 1, 2377408, 2377, 2377, '2024-01-01 17:28:50', 1, 1),
	(5, 'SPY X FAMILY', 'Endou Tatsuya', 'Ông bố điệp viên lấy vợ là sát thủ, có đứa con là nhà ngoại cảm và chú chó tiên đoán tương lai.', 'uploads/5/005_1706458456.png', 1, 942388, 952, 952, '2024-01-01 17:29:11', 1, 1),
	(6, 'FAIRY TAIL NHIỆM VỤ 100 NĂM', 'Mashima Hiro', 'Fairy Tail nhiệm vụ 100 năm sẽ tiếp nối theo chương 545 của chính truyện Fairy Tail', 'uploads/6/006_1706458478.png', 1, 1746013, 1746, 1746, '2024-01-01 17:30:17', 1, 1),
	(7, 'TENSEI SHITARA SLIME DATTA KEN', 'Kawakami Taiki, Fuse', 'Một manga khác chuyển thể từ light novel đang hot ở nhật. Một anh chàng bị tên cướp đâm chết khi đang gặp vợ chưa cưới của đồng nghiệp. Khi đang thoi thóp trước khi chết, người đầy máu, anh ta nghe được một tiếng nói kỳ lạ. Giọng nói ấy chuyển thể sự tiếc nuối của anh chàng vì vẫn còn tân trước khi đi và ban cho anh ta chiêu thức đặc biệt [tiên nhân vĩ đại]. Liệu đây có phải là trò đùa?\r\n', 'uploads/7/007_1706458489.png', 1, 833186, 833, 833, '2024-01-01 17:31:10', 1, 1),
	(8, 'WORLD TRIGGER', 'Ashihara, Daisuke', 'Một thành phố đã mở cánh cổng đi vào thế giới song song... Từ thế giới bên kia cánh cổng, bọn xâm lược NAVER đã tiến vào gây náo động thành phố... Để bảo vệ cuộc sống của mọi người.... Một tổ chức đã được thành lập mang tên BORDER (Biên giới), thành viên của BORDER là những người mang sức mạnh TRIGGER Họ sẽ làm gì để bảo vệ thành phố của mình?', 'uploads/8/008_1706458529.png', 1, 713681, 713, 713, '2024-01-01 17:36:05', 1, 1),
	(9, 'ONE PUNCH-MAN', 'Murata Yuusuke', 'Onepunch-Man là một Manga thể loại siêu anh hùng với đặc trưng phồng tôm đấm phát chết luôn… Lol!!! Nhân vật chính trong Onepunch-man là Saitama, một con người mà nhìn đâu cũng thấy “tầm thường”, từ khuôn mặt vô hồn, cái đầu trọc lóc, cho tới thể hình long tong. Tuy nhiên, con người nhìn thì tầm thường này lại chuyên giải quyết những vấn đề hết sức bất thường. Anh thực chất chính là một siêu anh hùng luôn tìm kiếm cho mình một đối thủ mạnh. Vấn đề là, cứ mỗi lần bắt gặp một đối thủ tiềm năng, thì đối thủ nào cũng như đối thủ nào, chỉ ăn một đấm của anh là… chết luôn. Liệu rằng Onepunch-Man Saitaman có thể tìm được cho mình một kẻ ác dữ dằn đủ sức đấu với anh? Hãy theo bước Saitama trên con đường một đấm tìm đối cực kỳ hài hước của anh!!', 'uploads/9/009_1706458631.png', 1, 1071368, 1071, 1071, '2024-01-01 17:37:57', 1, 1),
	(10, 'OSHI NO KO', 'Akasaka Aka , Yokoyari Mengo', 'Câu chuyện xoay quanh một cô gái vô cùng tuyệt vời và một cái nhìn hoàn toàn mới về ngành giải trí đầy phức tạp', 'uploads/10/010_1706458641.png', 1, 1141368, 1141, 1141, '2024-01-01 17:38:49', 1, 1),
	(11, 'TÌNH YÊU GIẢ TẠO', 'Komi Naoshi', '"Em sẽ giữ chìa, còn anh sẽ giữ ổ khóa. Sau này nếu mình được gặp lại nhau thì đây sẽ là thứ chúng ta dùng để nhận ra nhau, và khi đó, chúng ta sẽ... cưới nhau". ', 'uploads/11/011_1706458653.png', 2, 731368, 731, 731, '2024-01-01 17:39:47', 1, 1),
	(12, 'NHẤT QUỶ NHÌ MA, THỨ BA TAKAGI', 'Yamamoto Souichirou', '“Đỏ mặt là thua!” Với niềm tin như vậy, mỗi ngày đến trường với Nishikata là một ngày thua. Cậu học sinh trung học đáng thương luôn bị “quê” bởi những trò chọc phá của cô nàng ngồi cạnh bàn Takagi-san, và dẫu cho cậu bé luôn ấp ủ mộng báo thù cũng như không ngừng bày mưu tính kế, thì cuối cùng những chiêu trò của cậu lại “gậy ông đập lưng ông”. Theo đánh giá của giới chuyên môn, cách biệt kèo trên và kèo dưới là rất xa, cửa thắng cho cậu bé là cực thấp, bởi có vẻ như cô bé Takagi còn có khả năng nắm bắt được hết những suy nghĩ toan tính của cậu. Song, nhìn về những gì Yokoi đã làm được trước Seki-kun trong Tonari no Seki-kun, liệu chúng ta có nên đặt chút niềm tin vào màn lật kèo phút chót của Nishikata?', 'uploads/12/012_1706458677.png', 1, 841368, 841, 841, '2024-01-01 17:40:24', 1, 1),
	(13, 'HORIMIYA', 'Hero, Hagiwara Daisuke', 'Hori-san là một nữ sinh nổi tiếng, nhìn tưởng chừng như một học sinh "không thực tế" trong lớp, nhưng trên thực tế, cô lại có lối sống vô cùng giản dị, thực dụng và hướng nội. Mặt khác, Miyamura-kun đeo kính nhìn trong như một fanboy cao trung, nhưng thực tế là một chàng trai vô cùng hấp dẫn, có xu hướng badboy, bấm khuyên tai và có cả hình xăm. Khi hai người bạn học giống nhau đến bất ngờ này gặp nhau vô tình bên ngoài giờ học, một câu chuyện ngọt ngào, sôi nổi về cuộc sống tuổi học sinh bắt đầu!', 'uploads/13/013_1706458806.png', 1, 741268, 741, 741, '2024-01-01 17:41:06', 1, 1),
	(14, 'SONO BISQUE DOLL WA KOI WO SURU', 'Fukuda Shinichi', 'Wakana Gojou là một cậu bé mười lăm tuổi, người bị chấn thương xã hội trong quá khứ do niềm đam mê của mình. Sự cố đó đã để lại dấu ấn cho anh khiến anh trở thành một người ẩn dật xã hội. Cho đến một ngày, anh đã gặp phải Kitagawa, một gyaru hòa đồng, hoàn toàn trái ngược với anh. Họ sớm chia sẻ niềm đam mê của họ với nhau mà dẫn đến mối quan hệ kỳ quặc của họ.', 'uploads/14/014_1706458823.png', 1, 441368, 441, 441, '2024-01-01 17:41:52', 1, 1),
	(15, 'TONIKAKU KAWAII', 'Hata, Kenjirou', 'Một tác phẩm “chứa đầy tình yêu và ước mơ".', 'uploads/15/015_1706458843.png', 1, 401368, 401, 401, '2024-01-01 17:42:49', 1, 1),
	(16, 'YAMADA-KUN TO LV999 NO KOI WO SURU', 'Mashiro', 'Khi Akane sắp từ bỏ trò chơi game mà cô từng chơi với bạn trai thì lại gặp Yamada trong một tựa game khác cùng thể loại. Yamada trong cuộc sống ngoài đời thực có thể được coi là một "huyền thoại". Vấn đề duy nhất là anh ta CHỈ quan tâm đến game thôi. Khi tình cảm của Akane dành cho cậu ngày càng lớn, liệu Yamada có tập trung chơi game nữa không?', 'uploads/16/016_1706458860.png', 1, 601368, 601, 601, '2024-01-01 17:44:53', 1, 1),
	(17, 'TSUKI GA MICHIBIKU ISEKAI DOUCHUU', 'Đang cập nhật', 'Học sinh trung học Misumi Makoto bị gọi vào thế giới khác bởi vị Nguyệt Thần Tsukuyomi để làm anh hùng. Tuy nhiên xấu trai cũng là một cái tội, vị thần ngứa mắt nên đá chàng trai xuống nhân gian với một chút sức mạnh được ban cho. Giờ đây, Makoto đang tự quyết định vận mệnh của mình...', 'uploads/17/017_1706458874.png', 1, 801368, 801, 801, '2024-01-01 17:45:30', 1, 1),
	(18, 'OWARI NO SERAPH', 'Kagami Takaya, Yamamoto Yamato', 'Vào ngày nọ, một loại vi rút bí ẩn lan rộng toàn cầu và lây nhiễm cho tất cả những ai hơn 13 tuổi, đưa họ tới cái chết. Cùng lúc đó, Vampire xuất hiện, đưa Trái Đất vào bóng tối và con người bị bắt làm nô lệ. Hyakuya Yuuichirou, một cậu bé sống tại trại trẻ mồ côi đã trốn thoát khỏi nơi giam giữ của bọn Vampire. Với quyết tâm giết tất cả bọn Vampire để trả thù cho gia đình đã bị giết hại của mình, cậu tham gia vào đội Nguyệt Quỷ. Nhưng những thứ xảy ra đôi lúc không như người ta mong chờ, Michaela, người bạn thuở nhỏ của cậu đã trở thành Vampire…..', 'uploads/18/018_1706458886.png', 1, 301369, 301, 301, '2024-01-01 17:56:21', 1, 1),
	(19, 'MAGI: BẬC THẦY PHÁP THUẬT', 'Ohtaka Shinobu', 'Sau khi điều tra được những thông tin từ "tổ chức" Al Sarmen, Aladdin và bạn bè của mình đã đi theo con đường riêng biệt vì lý do của mỗi cá nhân. Aladdin ghi danh ở Học viện Magnostadt để nghiên cứu ma thuật. Alibaba đã đến Đế Quốc Laem để cải thiện kiếm thuật của mình .Hakuryuu trở về cho Đế quốc Kou, và Morgiana khởi hành đến lục địa bóng tối để thực hiện ước mơ về thăm quê hương mình, một cuộc hành trình đầy hứa hẹn đang diễn ra để rồi ghép nối lại với nhau trong tương lai.', 'uploads/19/019_1706458899.png', 2, 431368, 431, 431, '2024-01-01 17:57:16', 1, 1),
	(20, 'KAGUYA-SAMA WA KOKURASETAI?: TENSAI-TACHI NO RENAI ZUNOUSEN', 'Akasaka, Aka (Story & Art)', 'Kaguya Shinomiya và Miyuki Shirogane cùng là thành viên của hội học sinh học viện Shuchi’in, được xem như là những thiên tài giữa các thiên tài. Thời gian bên nhau dần phát triển tình cảm họ dành cho nhau, nhưng lòng kiêu hãnh không cho phép họ là người thú nhận và ngỏ lời trước. Tình trường là chiến trường và trận chiến để khiến đối phương phải tỏ tình trước bắt đầu! Nhóm dịch: Love Heaven Manga', 'uploads/20/020_1706458917.png', 1, 351368, 351, 351, '2024-01-01 18:00:46', 1, 1);

-- Dumping structure for table truyen_cover_v2.truyen_the_loai
CREATE TABLE IF NOT EXISTS `truyen_the_loai` (
  `truyen_id` int(11) NOT NULL,
  `the_loai_id` int(11) NOT NULL,
  KEY `FK_truyen_the_loai_truyen` (`truyen_id`) USING BTREE,
  KEY `FK_truyen_the_loai_the_loai` (`the_loai_id`) USING BTREE,
  CONSTRAINT `truyen_the_loai_ibfk_1` FOREIGN KEY (`the_loai_id`) REFERENCES `the_loai` (`the_loai_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `truyen_the_loai_ibfk_2` FOREIGN KEY (`truyen_id`) REFERENCES `truyen` (`truyen_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table truyen_cover_v2.truyen_the_loai: ~71 rows (approximately)
INSERT INTO `truyen_the_loai` (`truyen_id`, `the_loai_id`) VALUES
	(1, 3),
	(1, 4),
	(1, 5),
	(1, 6),
	(2, 3),
	(2, 4),
	(2, 6),
	(2, 7),
	(3, 4),
	(3, 6),
	(3, 8),
	(3, 12),
	(4, 1),
	(4, 3),
	(4, 6),
	(5, 4),
	(5, 8),
	(5, 9),
	(5, 11),
	(5, 12),
	(6, 1),
	(6, 3),
	(6, 5),
	(6, 6),
	(7, 1),
	(7, 2),
	(7, 3),
	(7, 5),
	(7, 6),
	(8, 1),
	(8, 3),
	(9, 3),
	(9, 4),
	(9, 5),
	(10, 7),
	(10, 9),
	(10, 11),
	(11, 4),
	(11, 7),
	(11, 8),
	(11, 9),
	(11, 10),
	(11, 11),
	(12, 4),
	(12, 8),
	(12, 9),
	(12, 11),
	(13, 4),
	(13, 6),
	(13, 8),
	(13, 11),
	(14, 4),
	(14, 8),
	(14, 11),
	(15, 4),
	(15, 11),
	(16, 4),
	(16, 11),
	(17, 1),
	(17, 2),
	(17, 5),
	(18, 3),
	(18, 6),
	(18, 7),
	(19, 1),
	(19, 3),
	(19, 5),
	(19, 6),
	(20, 4),
	(20, 8),
	(20, 11);

-- Dumping structure for table truyen_cover_v2.tuong_tac
CREATE TABLE IF NOT EXISTS `tuong_tac` (
  `tuong_tac_id` int(11) NOT NULL AUTO_INCREMENT,
  `tuong_tac_ngay` datetime NOT NULL DEFAULT current_timestamp(),
  `tuong_tac_noi_dung` text DEFAULT NULL,
  `tuong_tac_loai` tinyint(4) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  PRIMARY KEY (`tuong_tac_id`),
  KEY `FK_tuong_tac_chapter` (`chapter_id`),
  KEY `FK_tuong_tac_tai_khoan` (`tai_khoan_id`),
  CONSTRAINT `FK_tuong_tac_chapter` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_tuong_tac_tai_khoan` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table truyen_cover_v2.tuong_tac: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
