-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 24, 2022 lúc 08:19 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `my_dictionary`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaitu`
--

CREATE TABLE `loaitu` (
  `id_loai` int(11) NOT NULL,
  `tenloaitu` varchar(50) NOT NULL,
  `kyhieu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaitu`
--

INSERT INTO `loaitu` (`id_loai`, `tenloaitu`, `kyhieu`) VALUES
(1, 'Danh từ', 'n'),
(9, 'Tính từ', 'adj'),
(10, 'Động từ', 'v');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tuvung`
--

CREATE TABLE `tuvung` (
  `id_tu` int(11) NOT NULL,
  `tentuvung` varchar(50) NOT NULL,
  `phienam` varchar(50) NOT NULL,
  `phatam` varchar(50) NOT NULL,
  `nghia` varchar(50) NOT NULL,
  `vidu` varchar(50) NOT NULL,
  `id_loaitu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tuvung`
--

INSERT INTO `tuvung` (`id_tu`, `tentuvung`, `phienam`, `phatam`, `nghia`, `vidu`, `id_loaitu`) VALUES
(1, 'Information', '/,infə&#039;mei∫n/', 'information.mp3', 'Thông tin', 'a mine of information', 1),
(3, 'Sort', '', '', 'Sắp xếp', '', 10),
(4, 'Run', '/rʌn/', 'run.mp3', 'Chạy', 'I run', 10),
(5, 'Red', '', '', 'Màu đỏ', '', 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `taikhoan` varchar(50) NOT NULL,
  `matkhau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `taikhoan`, `matkhau`) VALUES
(1, 'admin', 'admin123'),
(2, 'admin', 'admin123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `loaitu`
--
ALTER TABLE `loaitu`
  ADD PRIMARY KEY (`id_loai`);

--
-- Chỉ mục cho bảng `tuvung`
--
ALTER TABLE `tuvung`
  ADD PRIMARY KEY (`id_tu`),
  ADD KEY `id_loai` (`id_loaitu`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `loaitu`
--
ALTER TABLE `loaitu`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tuvung`
--
ALTER TABLE `tuvung`
  MODIFY `id_tu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tuvung`
--
ALTER TABLE `tuvung`
  ADD CONSTRAINT `tuvung_ibfk_1` FOREIGN KEY (`id_loaitu`) REFERENCES `loaitu` (`id_loai`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
