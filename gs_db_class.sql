-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2024-08-27 16:59:20
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db_class`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `content`, `date`) VALUES
(1, 'こすげたつや', 'test@test.jp', '内容', '2024-07-11 19:36:01'),
(2, 'ながのまいこ', 'test2@test.jp', '永野', '2024-07-11 19:39:29'),
(3, 'てすとたろう', 'test3@test.jp', 'テスト', '2024-07-11 19:39:52'),
(4, '田中　太郎', 'tanaka@test.com', 'おもしろい', '2024-07-11 20:23:55'),
(5, '鈴木　一郎', 'suzuki@test.com', 'イチロー', '2024-07-11 20:30:11'),
(6, '田中', 'tanaka@test.com', 'test2', '2024-07-15 16:41:37');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bookmark_table`
--

CREATE TABLE `gs_bookmark_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `book_name` varchar(64) NOT NULL,
  `book_url` text NOT NULL,
  `book_comment` text NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `gs_bookmark_table`
--

INSERT INTO `gs_bookmark_table` (`id`, `user_id`, `book_name`, `book_url`, `book_comment`, `image`, `date`) VALUES
(1, 1, 'G\'s Learning System', 'https://www.learning.gsacademy.jp/', 'G\'s Academyのラーニングシステム', NULL, '2024-07-15 17:39:05'),
(2, 2, 'MIL7th Potal Web', 'https://castero.notion.site/MIL7th-Portal-Web-d225d2103d7f4c24a621324798f2ad96', '講義の資料', NULL, '2024-07-15 18:06:13'),
(3, 3, 'GitHub', 'https://github.com/', 'ソースコード管理', NULL, '2024-07-15 18:33:14'),
(4, 4, 'Download XAMPP', 'https://www.apachefriends.org/jp/download.html', 'Xamppのダウンロード画面', NULL, '2024-07-15 18:44:09'),
(5, 5, 'Download FileZilla Client for Windows', 'https://filezilla-project.org/download.php?platform=win64', 'FileZillaダウンロード', NULL, '2024-07-15 19:21:57'),
(10, 1, 'MIL7th ZOOM URL', 'https://us02web.zoom.us/j/87921477898?pwd=U1pDWDNJUVVGYllCaDBmSEhCWG83QT09', 'ZOOMのURL', NULL, '2024-07-28 23:38:40'),
(11, 1, 'Docker Desktop', 'https://www.docker.com/get-started/', 'Docker Desktopのインストール画面', NULL, '2024-08-25 19:42:38'),
(16, 1, 'test', 'https://test.com', 'test', 'img/66cb3e253cd28.png', '2024-08-25 20:47:59'),
(17, 2, 'test2', 'https://test2.com', 'test2', 'img/66cb3e4761ed1.png', '2024-08-25 22:36:37'),
(19, 3, 'test3', 'https://test3.com', 'test3', 'img/66cde740b792e.png', '2024-08-25 23:25:07'),
(20, 5, 'test5', 'https://test5.com', 'test5', 'img/66cde9451dc3a.png', '2024-08-27 23:57:09');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(255) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'テスト1管理者', 'test1', '$2y$10$Pr88gmepgk33StYTQfJ6XeqczYcy/.AXKEm/RX97qRu7/gsk52OwW', 1, 0),
(2, 'テスト2一般', 'test2', '$2y$10$SBhGR.QjfDw4nkjiuBvkBuSP1z7CQbmJwIiPbci96U5kn3ujzurWK', 0, 0),
(3, 'テスト3一般', 'test3', '$2y$10$L6p.N9hVwkTKeQF.B4.aKeGELE.nI0tHSS.GpiyrxTB8HpryfzBBu', 0, 0),
(4, 'テスト4一般', 'test4', '$2y$10$Br0ynh8BRXb4Xkb2HC3Eh.d6FT/tMzJ/9w7HsPcJ5TuVc8ANh21DC', 0, 0),
(5, 'テスト5管理者', 'test5', '$2y$10$OTjQ2AmvONFVPUg5SMGvsOx7rsrUNp9Ipn3G0pYhIrlNrxV5NDJsa', 1, 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_bookmark_table`
--
ALTER TABLE `gs_bookmark_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `gs_bookmark_table`
--
ALTER TABLE `gs_bookmark_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- テーブルの AUTO_INCREMENT `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
