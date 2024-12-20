-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 10:07 AM
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
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(225) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Tersedia','Tidak Tersedia') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gdrive_link` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `user_id`, `title`, `author`, `description`, `status`, `created_at`, `updated_at`, `category_id`, `image`, `gdrive_link`, `deleted_at`, `is_archived`) VALUES
(2, 1, 'Bulan', 'Tere Liye', 'Kelanjutan dari novel \"Bumi\", menceritakan petualangan Raib, Seli, dan Ali di dunia paralel Bulan. Kisah ini dipenuhi dengan misteri, aksi, dan pelajaran tentang persahabatan serta keberanian.', 'Tersedia', '2024-12-05 23:14:34', '2024-12-13 01:47:30', 1, 'Bulan.jpg', 'https://drive.google.com/file/d/1rzvvoufQcZzOFvFkgtLNlLus9RazAl13/view?usp=drive_link', NULL, 0),
(3, 1, 'Bumi', 'Tere Liye', 'Kisah petualangan fantasi dengan latar dunia paralel yang penuh misteri.', 'Tersedia', '2024-12-05 23:16:02', '2024-12-13 01:48:06', 1, 'Bumi.jpg', 'https://drive.google.com/file/d/1zJC5WYjUzydPlvn0cNXIuSt67BLffEPl/view?usp=drive_link', NULL, 0),
(4, 1, 'Cantik Itu Luka', 'Eka Kurniawan', 'Sebuah karya sastra yang epik, mengisahkan kehidupan Dewi Ayu dan keluarganya di latar belakang sejarah Indonesia. Novel ini mengeksplorasi cinta, dendam, kecantikan, dan tragedi dengan narasi yang unik dan magis.', 'Tersedia', '2024-12-05 23:16:50', '2024-12-13 01:50:02', 1, 'Cantik Itu Luka.jpg', 'https://drive.google.com/file/d/13I1FR8VHTa30BG9Wi-fkvd1RRU_uA6_s/view?usp=drive_link', NULL, 0),
(5, 1, 'Hujan', 'Tere Liye', 'Sebuah kisah yang berlatar masa depan, tentang seorang gadis bernama Lail dan perjuangannya menghadapi trauma serta kehilangan setelah bencana besar melanda dunia.', 'Tersedia', '2024-12-05 23:17:35', '2024-12-13 01:51:31', 1, 'Hujan.jpg', 'https://drive.google.com/file/d/1LZViS9-8ED3y-L6xhB7iTqfFXSd0aOrO/view?usp=drive_link', NULL, 0),
(6, 1, 'ILY', 'Tere Liye', 'Novel ILY (I Love You) bercerita tentang perjuangan cinta dan persahabatan. Kisah ini mengangkat dinamika emosi, kejujuran, dan pengorbanan yang harus dihadapi karakter utamanya. Dengan alur yang khas Tere Liye, novel ini menyentuh hati pembaca dan memberikan pelajaran tentang arti cinta sejati.', 'Tersedia', '2024-12-05 23:18:22', '2024-12-13 01:53:30', 3, 'ILY.jpeg', 'https://drive.google.com/file/d/1JuIobNNNMHYoTzZ84lEJQdRK-sO76-7J/view?usp=drive_link', NULL, 0),
(7, 1, 'Funiculi Funicula', 'Toshikazu Kawaguchi', 'Novel ini bercerita tentang sebuah kafe misterius di Tokyo yang memungkinkan pelanggannya melakukan perjalanan waktu, namun dengan aturan yang ketat. Cerita ini penuh dengan emosi, introspeksi, dan kehangatan.', 'Tersedia', '2024-12-05 23:19:46', '2024-12-13 01:55:18', 1, 'Funiculi Funicula.jpg', 'https://drive.google.com/file/d/1eL5y3inG6W3Uij9ZQ6BOXCs2tJfjJPFf/view?usp=drive_link', NULL, 0),
(8, 1, 'Hello', 'Tere Liye', '\"Hello\" adalah salah satu novel romantis karya Tere Liye yang mengisahkan hubungan antara Disa dan Kai, dua individu dengan latar belakang yang berbeda. Novel ini mengeksplorasi tema cinta, kejujuran, dan penerimaan diri, dengan gaya bahasa yang khas dan cerita yang menyentuh hati.', 'Tersedia', '2024-12-05 23:20:24', '2024-12-15 06:55:14', 3, 'Hello.jpg', 'https://drive.google.com/file/d/1mCNCXAFE58xbh-lAb789JaPcE_qa0Rn_/view?usp=drive_link', NULL, 0),
(10, 1, 'Lelaki Harimau', 'Eka Kurniawan', 'Cerita tentang seorang pemuda yang membawa kutukan harimau putih dalam dirinya, dengan tema balas dendam dan tragedi.', 'Tersedia', '2024-12-05 23:21:52', '2024-12-15 06:55:17', 1, 'img/nAscIBQAus0FfygdzwnLGqNX8y7RvVHHE4wCjJeb.jpg', NULL, NULL, 0),
(12, 1, 'Ronggeng Dukuh Paruk', 'Ahmad Tohari', 'Kisah tentang Srintil, seorang ronggeng yang terjebak dalam tradisi dan politik desa kecil di Jawa.', 'Tersedia', '2024-12-05 23:23:57', '2024-12-15 08:01:38', 1, 'img/qTKof6HbnuFksGj9RRdbNaDBDG73VyGqhRcFK2xm.jpg', NULL, NULL, 0),
(13, 1, 'Hujan', 'Tere Liye', 'Sebuah kisah tentang persahabatan, cinta, dan pengorbanan di dunia yang mengalami bencana besar.', 'Tersedia', '2024-12-05 23:25:12', '2024-12-15 18:25:14', 5, 'img/Gaw42G4ubkyhILoJeqqAnaxgfvOIlFQPOZEQiQsb.jpg', NULL, NULL, 0),
(14, 1, 'Pulang', 'Leila S. Chudori', 'Sebuah kisah tentang pengasingan politik, kerinduan akan tanah air, dan perjuangan melawan rezim otoriter.', 'Tersedia', '2024-12-05 23:25:57', '2024-12-15 06:55:41', 6, 'img/ASkXLmyhLx0zulgafw0y0rnAGbgBZUU44CvppV77.jpg', NULL, NULL, 0),
(15, 1, 'Laut Bercerita', 'Leila S. Chudori', 'Mengisahkan aktivis yang hilang pada era Orde Baru dan dampaknya pada keluarga serta teman-temannya.', 'Tersedia', '2024-12-05 23:27:16', '2024-12-15 06:55:42', 6, 'img/3VwGDxrg930K4ddyqMqv0dK4alEtSMBhif2lqLVR.jpg', NULL, NULL, 0),
(16, 1, 'Filosofi Kopi', 'Dee Lestari', 'Kumpulan cerita pendek yang menggambarkan filosofi kehidupan melalui pengalaman sederhana seperti secangkir kopi.', 'Tersedia', '2024-12-05 23:28:09', '2024-12-15 06:55:44', 1, 'img/6lGB6Prs68Pg83zLVm1y0oh4V6oF5hn25PRBZVqt.jpg', NULL, NULL, 0),
(17, 1, 'Dilan 1990', 'Pidi Baiq', 'Kisah romantis remaja dengan latar belakang Bandung tahun 1990, penuh humor dan nostalgia.', 'Tersedia', '2024-12-05 23:29:04', '2024-12-15 06:55:45', 3, 'img/rv2GSkmxerrjYzqPX7xktzQNYSfmBiCPMTA7tF83.jpg', NULL, NULL, 0),
(18, 1, 'Rectoverso', 'Dee Lestari', 'Kumpulan cerita pendek dan puisi tentang cinta, kehilangan, dan harapan, dipadukan dengan album musik.', 'Tersedia', '2024-12-05 23:29:53', '2024-12-15 18:19:56', 1, 'img/01RRmiFtvsgFMf8NNy2T9r7rn7G0IutfWYrH7KkG.jpg', NULL, NULL, 0),
(19, 1, 'Tenggelamnya Kapal Van der Wijck', 'Hamka', 'Kisah cinta tragis antara Zainuddin dan Hayati, yang terhalang oleh perbedaan status sosial.', 'Tersedia', '2024-12-05 23:30:36', '2024-12-15 18:19:30', 5, 'img/nBwm4JpkLbQc0MI0k9LsAwkkLavmbVUKqXGFGSUF.jpg', NULL, NULL, 1),
(21, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-14 02:43:13', NULL, NULL, NULL, '2024-12-14 02:43:13', 0),
(22, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-14 02:46:35', NULL, NULL, NULL, '2024-12-14 02:46:35', 0),
(23, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-14 02:55:07', NULL, NULL, NULL, '2024-12-14 02:55:07', 0),
(24, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-15 06:04:04', NULL, NULL, NULL, '2024-12-15 06:04:04', 0),
(25, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-15 06:04:18', NULL, NULL, NULL, NULL, 1),
(26, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-15 06:15:52', NULL, NULL, NULL, NULL, 1),
(27, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-15 06:15:55', NULL, NULL, NULL, '2024-12-15 06:15:55', 0),
(28, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(29, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(30, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(31, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(32, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(33, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(34, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(35, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(36, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(37, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(38, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(39, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(40, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, NULL, NULL, NULL, 0),
(41, 1, 'aab', 'aab', 'aaa', 'Tersedia', '2024-12-14 20:29:06', '2024-12-14 20:30:04', 1, NULL, NULL, '2024-12-14 20:30:04', 0),
(42, NULL, 'aa', 'aaa', NULL, 'Tersedia', '2024-12-14 23:00:19', '2024-12-14 23:00:19', NULL, NULL, NULL, NULL, 0),
(43, NULL, 'bbb', 'bbb', NULL, 'Tersedia', '2024-12-14 23:38:45', '2024-12-14 23:38:45', NULL, NULL, NULL, NULL, 0),
(45, NULL, 'abc', 'abca', NULL, 'Tersedia', '2024-12-15 23:48:29', '2024-12-16 00:43:49', NULL, NULL, NULL, NULL, 0),
(46, 1, 'abcde', 'abcd', 'abcd', 'Tersedia', '2024-12-16 00:41:40', '2024-12-16 00:42:40', 1, NULL, NULL, NULL, 0),
(47, NULL, 'abbbb', 'abbb', NULL, 'Tersedia', '2024-12-16 01:47:32', '2024-12-16 01:47:32', NULL, NULL, NULL, NULL, 0),
(48, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(49, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(50, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(51, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(52, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(53, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(54, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(55, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(56, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(57, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(58, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(59, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(60, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(61, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(62, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(63, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(64, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(65, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(66, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0),
(67, NULL, 'required|max:255', 'required|max:225', 'nullable|string', 'Tersedia', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('abc@gmail.com|127.0.0.1', 'i:1;', 1734323366),
('abc@gmail.com|127.0.0.1:timer', 'i:1734323366;', 1734323366),
('admin123@gmail.com|127.0.0.1', 'i:1;', 1733722208),
('admin123@gmail.com|127.0.0.1:timer', 'i:1733722208;', 1733722208),
('test@example.com|127.0.0.1', 'i:2;', 1733463066),
('test@example.com|127.0.0.1:timer', 'i:1733463066;', 1733463066);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`, `is_archived`) VALUES
(1, 'Fiksi', 'Buku yang berisi cerita imajinatif yang dibuat oleh pengarang. Meskipun bisa terinspirasi oleh kehidupan nyata, cerita dalam buku fiksi biasanya bersifat khayalan atau tidak sepenuhnya berdasarkan kejadian yang sebenarnya.', NULL, NULL, NULL, 0),
(2, 'Non-fiksi', 'Buku yang berisi fakta atau informasi berdasarkan kenyataan. Buku non-fiksi mencakup berbagai topik, seperti biografi, sejarah, sains, dan panduan praktis.', NULL, NULL, NULL, 0),
(3, 'Romantis', 'Buku yang mengangkat tema cinta dan hubungan antar karakter, sering kali dengan fokus pada perjuangan atau konflik dalam hubungan romantis.', NULL, NULL, NULL, 0),
(4, 'Fiksi Ilmiah', 'Buku yang mengangkat cerita tentang dunia atau kejadian yang tidak mungkin terjadi di dunia nyata, sering kali melibatkan teknologi canggih, luar angkasa, atau masa depan yang jauh.', NULL, NULL, NULL, 0),
(5, 'Fantasi', 'Buku yang berisi cerita imajinatif dengan elemen-elemen yang tidak ada di dunia nyata, seperti makhluk fantasi, sihir, dan dunia lain yang tidak terikat pada hukum fisika dunia nyata.', NULL, '2024-12-09 00:02:05', NULL, 0),
(6, 'Sejarah', 'Buku yang mengulas peristiwa-peristiwa sejarah, baik dari sudut pandang individu maupun peristiwa besar, dengan tujuan memberikan pemahaman lebih dalam tentang masa lalu.', NULL, NULL, NULL, 0),
(7, 'Biografi', 'Buku yang menceritakan kisah hidup seseorang, baik tokoh terkenal maupun orang biasa, dan dapat berfokus pada pencapaian, perjuangan, atau pengalaman hidup mereka.', NULL, NULL, NULL, 0),
(8, 'Motivasi', 'Buku yang dirancang untuk memberikan inspirasi atau dorongan kepada pembaca agar mencapai tujuan atau mengatasi kesulitan dalam hidup, seringkali dengan cerita nyata atau panduan praktis.', NULL, NULL, NULL, 0),
(9, 'Pendidikan', 'Buku yang berfokus pada pengembangan pengetahuan dan keterampilan dalam berbagai bidang, bisa berupa teks pelajaran atau panduan untuk pengajaran dan pembelajaran.', NULL, NULL, NULL, 0),
(10, 'Psikologi', 'Buku yang mengulas berbagai konsep dan teori tentang perilaku manusia, proses mental, dan bagaimana orang berpikir, merasakan, serta bertindak dalam berbagai situasi.', NULL, '2024-12-15 18:10:16', NULL, 0),
(11, 'Petualangan', 'Cerita tentang perjalanan atau eksplorasi, sering kali menghadapi tantangan yang mendebarkan.', '2024-12-05 23:34:31', '2024-12-15 18:10:35', NULL, 0),
(12, 'Pendidikan', 'Buku pelajaran atau panduan untuk memperluas wawasan dalam bidang tertentu.', '2024-12-05 23:35:58', '2024-12-05 23:35:58', NULL, 0),
(13, 'Sains', 'Buku yang membahas fenomena alam, teknologi, atau penemuan ilmiah dengan pendekatan analitis.', '2024-12-05 23:36:23', '2024-12-05 23:36:23', NULL, 0),
(14, 'Teknologi', 'Buku yang menjelaskan perkembangan, penggunaan, atau dampak teknologi pada kehidupan manusia.', '2024-12-05 23:36:57', '2024-12-05 23:36:57', NULL, 0),
(15, 'Filosofi', 'Buku yang membahas pertanyaan-pertanyaan mendasar tentang kehidupan, eksistensi, dan nilai-nilai.', '2024-12-05 23:37:32', '2024-12-05 23:37:32', NULL, 0),
(16, 'Keuangan', 'Buku yang membahas manajemen keuangan pribadi, investasi, atau strategi bisnis.', '2024-12-05 23:37:56', '2024-12-05 23:37:56', NULL, 0),
(17, 'Politik', 'Buku yang membahas ideologi, kebijakan, atau sistem pemerintahan.', '2024-12-05 23:38:21', '2024-12-05 23:38:21', NULL, 0),
(18, 'Religi', 'Buku yang berisi panduan, cerita, atau refleksi tentang keyakinan agama atau spiritualitas.', '2024-12-05 23:38:49', '2024-12-05 23:38:49', NULL, 0),
(19, 'Anak-Anak', 'Buku yang ditujukan untuk pembaca anak-anak, dengan cerita yang ringan dan ilustrasi menarik.', '2024-12-05 23:39:14', '2024-12-05 23:39:14', NULL, 0),
(20, 'Misteri', 'Buku dengan alur cerita penuh ketegangan, teka-teki, atau investigasi.', '2024-12-05 23:39:48', '2024-12-05 23:39:48', NULL, 0),
(21, 'Sastra', 'Buku yang memiliki nilai seni tinggi, sering kali dengan gaya bahasa yang khas dan mendalam.', '2024-12-05 23:40:23', '2024-12-14 02:53:38', '2024-12-14 02:53:38', 0),
(22, 'Humor', 'Buku yang ditulis dengan tujuan menghibur pembaca melalui humor atau sindiran lucu.', '2024-12-05 23:40:45', '2024-12-14 02:53:09', '2024-12-14 02:53:09', 0),
(23, 'required|string|max:255', 'nullable|string', '2024-12-11 23:25:27', '2024-12-14 02:52:29', '2024-12-14 02:52:29', 0),
(24, 'required|string|max:255', 'nullable|string', '2024-12-11 23:25:27', '2024-12-11 23:25:27', NULL, 0),
(25, 'required|string|max:255', 'nullable|string', '2024-12-11 23:25:27', '2024-12-11 23:25:27', NULL, 0),
(26, 'required|string|max:255', 'nullable|string', '2024-12-11 23:25:27', '2024-12-11 23:25:27', NULL, 0),
(27, 'required|string|max:255', 'nullable|string', '2024-12-11 23:25:27', '2024-12-11 23:25:27', NULL, 0),
(28, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:20', '2024-12-11 23:26:20', NULL, 0),
(29, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:20', '2024-12-11 23:26:20', NULL, 0),
(30, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:20', '2024-12-11 23:26:20', NULL, 0),
(31, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:20', '2024-12-11 23:26:20', NULL, 0),
(32, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:20', '2024-12-11 23:26:20', NULL, 0),
(33, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, 0),
(34, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, 0),
(35, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, 0),
(36, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, 0),
(37, 'required|string|max:255', 'nullable|string', '2024-12-11 23:26:39', '2024-12-11 23:26:39', NULL, 0),
(39, 'aaa', 'aab', '2024-12-15 21:42:51', '2024-12-15 21:43:19', '2024-12-15 21:43:19', 0),
(40, 'abcdd', 'abcdddee', '2024-12-16 00:44:12', '2024-12-16 00:44:39', '2024-12-16 00:44:39', 0),
(41, 'required|string|max:255', 'nullable|string', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, 0),
(42, 'required|string|max:255', 'nullable|string', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, 0),
(43, 'required|string|max:255', 'nullable|string', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, 0),
(44, 'required|string|max:255', 'nullable|string', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, 0),
(45, 'required|string|max:255', 'nullable|string', '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `book_id` bigint(20) DEFAULT NULL,
  `loan_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('Dipinjam','Dikembalikan','Terlambat') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `book_id`, `loan_date`, `due_date`, `status`, `created_at`, `updated_at`, `deleted_at`, `is_archived`) VALUES
(16, 4, 2, '2024-12-16', '2024-12-17', 'Dipinjam', '2024-12-15 22:48:39', '2024-12-15 22:48:39', NULL, 0),
(17, 4, 4, '2024-12-16', '2024-12-17', 'Dipinjam', '2024-12-16 00:45:08', '2024-12-16 00:45:40', NULL, 0),
(18, 22, 5, '2024-12-16', '2024-12-18', 'Dipinjam', '2024-12-16 00:47:46', '2024-12-16 01:43:01', NULL, 0),
(19, 22, 5, '2024-12-16', '2024-12-17', 'Dipinjam', '2024-12-16 01:42:36', '2024-12-16 01:42:43', '2024-12-16 01:42:43', 0),
(20, 24, 8, '2024-12-16', '2024-12-17', 'Dipinjam', '2024-12-16 01:44:18', '2024-12-16 01:56:26', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '0001_01_01_000000_create_users_table', 1),
(11, '0001_01_01_000001_create_cache_table', 1),
(12, '0001_01_01_000002_create_jobs_table', 1),
(13, '2024_12_06_034730_create_permission_tables', 2),
(14, '2024_12_09_070358_add_image_to_books_table', 3),
(15, '2024_12_12_141746_add_gdrive_link_to_books_table', 4),
(16, '2024_12_13_091833_add_soft_deletes_to_books_table', 5),
(17, '2024_12_13_092055_add_soft_deletes_to_loans_table', 6),
(18, '2024_12_13_092210_add_soft_deletes_to_categories_table', 7),
(19, '2024_12_13_092310_add_soft_deletes_to_users_table', 8),
(20, '2024_12_14_031604_add_is_archived_to_books_table', 9),
(21, '2024_12_14_033146_add_is_archived_to_loans_table', 10),
(22, '2024_12_14_033912_add_is_archived_to_categories_table', 11),
(23, '2024_12_15_054814_create_personal_access_tokens_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 25),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$CEM8vPkAaOmcbSggpXaeMuKECjL/DaBfZftyTX8wuy43afU5Fa.y2', '2024-12-08 22:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view posts', 'web', '2024-12-05 21:31:41', '2024-12-05 21:31:41'),
(2, 'create posts', 'web', '2024-12-05 21:31:52', '2024-12-05 21:31:52'),
(3, 'delete posts', 'web', '2024-12-05 21:32:05', '2024-12-05 21:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '2c255fcad63f50ab7ec0c2e406191aaa3dba3d4a8a036a4b6f89f81b70859ed6', '[\"view posts\",\"create posts\"]', '2024-12-14 23:38:45', NULL, '2024-12-14 23:25:12', '2024-12-14 23:38:45'),
(2, 'App\\Models\\User', 1, 'auth_token', 'a65d32362074bb8a6f892f0ac7a79d02c3f6288a01a57a9451eeec24013dd6d7', '[\"view posts\",\"create posts\"]', NULL, NULL, '2024-12-15 03:33:11', '2024-12-15 03:33:11'),
(3, 'App\\Models\\User', 1, 'auth_token', '04535c7526e1c6c3d5fbd63fc2ef03b9bd59de121dbfd9b0b05a3c787ba8019a', '[\"view posts\",\"create posts\"]', '2024-12-15 23:48:29', NULL, '2024-12-15 23:47:55', '2024-12-15 23:48:29'),
(4, 'App\\Models\\User', 1, 'auth_token', '3f791dbf16f424acb20d5e51a4fa3b4989d758d05ffc9c836b5bd8062492cef0', '[\"view posts\",\"create posts\"]', '2024-12-15 23:53:17', NULL, '2024-12-15 23:50:44', '2024-12-15 23:53:17'),
(5, 'App\\Models\\User', 1, 'auth_token', '58e15eead707776a4a27e19d6c6c800b5d40ceb5ce524b9988d12c700a709c47', '[\"view posts\",\"create posts\"]', '2024-12-16 01:47:32', NULL, '2024-12-16 01:45:21', '2024-12-16 01:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-12-05 21:22:03', '2024-12-05 21:22:03'),
(2, 'user', 'web', '2024-12-05 21:31:29', '2024-12-05 21:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('sq3hcg4CIuA67XZQtYQkNcMn0ONM1MknvjYocsUM', NULL, '127.0.0.1', 'PostmanRuntime/7.43.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczlGNHBMeE9ORzRMdlhyM3dCN0hudEY2ejY3S1FqcFA5d1pybTFBUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734331951),
('YdwofvEgS8KlxPOKtoW0O1g89MDm28SOG5ok15nY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaXJraTZFZ0FmUW1RclFTaFZyenhtZlJTRXhTQ21xSzgyNlNMbDBGciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzP3BhZ2U9NCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1734339495);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$xm07X4QPhs/KosvJTHB1reoRpEt/2hmjJqgQ.BOEzlv2KqqQ0T06a', NULL, '2024-12-05 21:40:53', '2024-12-15 21:49:50', 'admin', NULL),
(4, 'User', 'user@gmail.com', NULL, '$2y$12$DuesFLmKBt63mPVpXQm.Ve.rBgjjfdCYMsCRIeyavBKYiYEqJ/.vG', NULL, '2024-12-09 08:45:58', '2024-12-15 23:24:41', 'user', NULL),
(22, 'user2', 'user2@gmail.com', NULL, '$2y$12$mG3P/MqDWH1QzbtnWesVF.xnHI0IvEnbaJiuAxi1phk8gf.LJa0Wu', NULL, '2024-12-15 23:45:39', '2024-12-15 23:45:39', NULL, NULL),
(23, 'Rian', 'rian123@gmail.com', NULL, '$2y$12$q6gsaFefvvZz23NWN4KpJOPUK8KFMdkaBS/29GQwbjdmmOL2ky.vq', NULL, '2024-12-16 01:39:29', '2024-12-16 01:39:29', NULL, NULL),
(24, 'User12', 'user12@gmail.com', NULL, '$2y$12$ze05YdelCgtZwe1lRq.A8uWBWojN0JQ7d7wbYOr1OHjDBeIXkX9Ca', NULL, '2024-12-16 01:40:18', '2024-12-16 01:40:18', NULL, NULL),
(25, 'Test User', 'test@example.com', NULL, '$2y$12$F1jXW6nUyBZQmJeNVj493erOzee3U9C4NlyaVJVE9Kax3lY3oJlgi', NULL, '2024-12-16 01:56:58', '2024-12-16 01:56:58', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_category_id_foreign` (`category_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loans_book_id_foreign` (`book_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
