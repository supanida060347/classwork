-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.11
-- Generation Time: Oct 03, 2024 at 05:11 PM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u299560388_651227`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_City`
--

CREATE TABLE `tbl_City` (
  `CityID` int(11) NOT NULL,
  `CityName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_City`
--

INSERT INTO `tbl_City` (`CityID`, `CityName`) VALUES
(1, 'กรุงเทพ'),
(2, 'สมุทรปราการ'),
(3, 'พิษณุโลก'),
(4, 'สุโขทัย'),
(5, 'เพชรบูรณ์'),
(6, 'พิจิตร'),
(7, 'กำแพงเพชร'),
(8, 'นครสวรรค์'),
(9, 'ลพบุรี'),
(10, 'ชัยนาท'),
(11, 'อุทัยธานี'),
(12, 'สิงห์บุรี'),
(13, 'อ่างทอง'),
(14, 'สระบุรี'),
(15, 'พระนครศรีอยุธยา'),
(16, 'สุพรรณบุรี'),
(17, 'นครนายก'),
(18, 'ปทุมธานี'),
(19, 'นนทบุรี'),
(20, 'นครปฐม'),
(21, 'สมุทรสาคร'),
(22, 'สมุทรสงคราม'),
(23, 'สระแก้ว'),
(24, 'ปราจีนบุรี'),
(25, 'ฉะเชิงเทรา'),
(26, 'ชลบุรี'),
(27, 'ระยอง'),
(28, 'จันทบุรี'),
(29, 'ตราด'),
(30, 'ตาก'),
(31, 'กาญจนบุรี'),
(32, 'ราชบุรี'),
(33, 'เพชรบุรี'),
(34, 'ประจวบคีรีขันธ์'),
(35, 'ชุมพร'),
(36, 'ระนอง'),
(37, 'สุราษฎร์ธานี'),
(38, 'นครศรีธรรมราช'),
(39, 'กระบี่'),
(40, 'พังงา'),
(41, 'ภูเก็ต'),
(42, 'พัทลุง'),
(43, 'ตรัง'),
(44, 'ปัตตานี'),
(45, 'สงขลา'),
(46, 'สตูล'),
(47, 'นราธิวาส'),
(48, 'ยะลา'),
(49, 'หนองคาย\r\n'),
(50, 'นครพนม'),
(51, 'สกลนคร'),
(52, 'อุดรธานี'),
(53, 'หนองบัวลำภู'),
(54, 'เลย'),
(55, 'มุกดาหาร'),
(56, 'กาฬสินธุ์'),
(57, 'ขอนแก่น \r\n'),
(58, 'อำนาจเจริญ'),
(59, 'ยโสธร'),
(60, 'ร้อยเอ็ด'),
(61, 'มหาสารคาม'),
(62, 'ชัยภูมิ'),
(63, 'นครราชสีมา'),
(64, 'บุรีรัมย์'),
(65, 'สุรินทร์'),
(66, 'ศรีสะเกษ'),
(67, 'อุบลราชธานี'),
(68, 'บึงกาฬ'),
(69, 'เชียงราย'),
(70, 'น่าน'),
(71, 'พะเยา'),
(72, 'เชียงใหม่ '),
(73, 'แม่ฮ่องสอน'),
(74, 'แพร่'),
(75, 'ลำปาง'),
(76, 'ลำพูน'),
(77, 'อุตรดิตถ์');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Department`
--

CREATE TABLE `tbl_Department` (
  `DepID` int(11) NOT NULL,
  `Department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_Department`
--

INSERT INTO `tbl_Department` (`DepID`, `Department`) VALUES
(1, 'วิทยาการคอมพิวเตอร์'),
(2, 'วิทยาการข้อมูล'),
(3, 'วิทยาศาสตร์และสิ่งแวดล้อม'),
(4, 'เครื่องสำอางและการชะลอวัย'),
(5, 'วัสดุศาสตร์อุตสาหกรรม');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Hobby`
--

CREATE TABLE `tbl_Hobby` (
  `HobbyID` int(11) NOT NULL,
  `HobbyName` varchar(100) NOT NULL,
  `HobbyNameEng` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_Hobby`
--

INSERT INTO `tbl_Hobby` (`HobbyID`, `HobbyName`, `HobbyNameEng`) VALUES
(1, 'เล่นเกม', 'Play game'),
(2, 'เล่นกีฬา', 'Play sport'),
(3, 'ออกกำลังกาย', 'Exercise'),
(4, 'ดูยูทูป', 'Watch Youtube'),
(5, 'ดูติ๊กตอก', 'Watch Tiktok'),
(6, 'อ่านหนังสือ', 'Read book'),
(7, 'ทำอาหาร', 'Cooking'),
(8, 'นอน', 'Sleepy'),
(9, 'คุยกับเพื่อน', 'Talk with friends'),
(10, 'ท่องเที่ยว', 'Travel'),
(11, 'ปิคนิค', 'Picnic'),
(12, 'ตั้งแคมป์', 'Camping'),
(13, 'ซื้อของ', 'Shopping'),
(14, 'เล่นกีต้า', 'Play guitar'),
(15, 'วาดรูป', 'Drawing'),
(16, 'ฟังเพลง', 'Listen music'),
(17, 'ทำขนม', 'baking'),
(18, 'ถ่ายรูป', 'photography'),
(19, 'ปลูกต้นไม้', 'gardening'),
(20, 'เต้น', 'dancing');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Student`
--

CREATE TABLE `tbl_Student` (
  `StuID` int(11) NOT NULL,
  `Prefix` enum('นาย','นางสาว') NOT NULL,
  `StudentName` varchar(30) NOT NULL,
  `StudentLastName` varchar(30) NOT NULL,
  `StudentNameEng` varchar(30) NOT NULL,
  `StudentLastNameEng` varchar(30) NOT NULL,
  `Age` int(2) NOT NULL,
  `DepID` int(11) NOT NULL,
  `CityID` int(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Domicile` varchar(100) NOT NULL,
  `PhoneNumber` varchar(10) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `YearID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_Student`
--

INSERT INTO `tbl_Student` (`StuID`, `Prefix`, `StudentName`, `StudentLastName`, `StudentNameEng`, `StudentLastNameEng`, `Age`, `DepID`, `CityID`, `Address`, `Domicile`, `PhoneNumber`, `SubjectID`, `YearID`) VALUES
(1, 'นาย', 'นิติพนธ์', 'ฉิมสอาด', 'Nitipon', 'Chimsaard', 20, 1, 2, '5/388 ต.บางเสาธง อ.บางเสาธง', 'ไทย', '0903147806', 2, 3),
(2, 'นางสาว', 'สุภนิดา ', 'จันเขียว', 'Supanida', 'Jankieaw', 20, 1, 29, '655/6 อ.เมือง', 'ตราด', '0957603321', 5, 3),
(3, 'นาย', 'ลามีน', 'ยามาล', 'Ramel', 'Yamal', 18, 3, 48, '999/99 อ.เมือง', 'ไทย', '099999999', 10, 1),
(4, 'นางสาว', 'เอ็มมา', 'วัตสัน', 'Emma', 'Watson', 19, 4, 26, '654/33 อ.ศรีราชา', 'ไทย', '0659887785', 7, 2),
(5, 'นาย', 'ครีสเตียโน่', 'โรนัลโด้', 'Christiano', 'Ronaldo', 21, 3, 1, '88/455 ลาดพร้าว', 'โปรตุเกต', '0885456655', 9, 4),
(6, 'นาย', 'ลีโอเนล', 'เมสซี่', 'Leonel', 'Messi', 19, 2, 19, '366/41 ติวานนท์', 'อาเจนตินา', '0894552145', 1, 2),
(7, 'นาย', 'เนย์มา', 'จูเนียร', 'Neymar', 'Jr', 18, 5, 2, '22/77 บางพลี', 'บลาซิล', '0854459778', 5, 1),
(8, 'นาย', 'วินิซิอุส', 'จูเนีบร', 'Vinicius', 'Jr', 18, 1, 60, '889/444 เมือง', 'บลาซิล', '0889742258', 8, 1),
(9, 'นาย', 'แฮรี่', 'เคน', 'Harry', 'Kane', 20, 4, 1, '446/7 บางโพ', 'อังกฤษ', '0965523746', 4, 2),
(10, 'นาย', 'เทียรี่', 'อองรี', 'Thierry', 'Henry', 22, 1, 26, '598/5 เมือง', 'ฝรั่งเศษ', '0885441111', 2, 4),
(11, 'นาย', 'เป็ป', 'กวาดิโอล่า', 'Pep', 'Guadiora', 21, 2, 50, '777/77 เมือง', 'สเปน', '0866933554', 10, 3),
(12, 'นาย', 'เจน', 'ลี', 'Jane', 'lee', 21, 1, 11, '66/44 เมือง', 'อังกฤษ', '0993452256', 5, 3),
(13, 'นาย', 'เอริค', 'เทนฮาก', 'Eric', 'Ten Hak', 19, 2, 44, '225/5 เมือง', 'เนเธอแลนด์', '0998224753', 7, 1),
(14, 'นาย', 'ซาติเอโก', 'เบอนาบิล', 'Santiaco', 'Bernabil', 22, 3, 63, '72/6 เมือง', 'สเปน', '0895555555', 1, 4),
(15, 'นาย', 'แฟรงกี้', 'เดอยอง', 'Franky', 'De Jong', 21, 2, 1, '883/41 บางซื่อ', 'เนเธอแลนด์', '0887652144', 9, 3),
(16, 'นาย', 'โมหัมเม็ต', 'ซาร่า', 'Mohamed', 'Salah', 20, 1, 57, '223/88 เมือง', 'อียิปซ์', '0944558888', 4, 3),
(17, 'นาย', 'ดาวิน', 'นูนเยส', 'Dawin', 'Nunez', 18, 5, 1, '951/7 พระราม2', 'อุรุกวัย', '095674412', 8, 1),
(18, 'นาย', 'อลัน', 'เชียรเล่อ', 'Allan', 'Shearer', 21, 1, 68, '722/6 เมือง', 'อังกฤษ', '0889445652', 10, 3),
(19, 'นาย', 'โทนี', 'ครูส', 'Tony', 'Kroos', 20, 3, 43, '556/7 เมือง', 'เยอรมัน', '0896633298', 6, 3),
(20, 'นาย', 'ลูก้า', 'โมดริช', 'Luka', 'Modric', 22, 4, 10, '59/7 เมือง', 'โครเอเชีย', '0865545782', 5, 4),
(21, 'นาย', 'ศรัน', 'กเกเ', 'กเเ', 'กดเกเ', 0, 1, 1, 'กดเกเ', 'กเดเ', 'กดเกเ', 1, 1),
(22, 'นาย', 'ดิกิ', 'กิกิ', 'กดิก', 'ผกดิ', 0, 1, 1, 'กิผิ', 'กผดิ', 'กผดิ', 1, 1),
(23, 'นาย', 'กก้', 'กด้', 'กด้', 'กด้', 21, 1, 1, 'กด้', 'กด้', 'กด้', 1, 1),
(24, 'นาย', 'fhf', 'fgh', 'fh', 'fgh', 44, 1, 1, 'ghm', 'ghcm', '0', 1, 1),
(25, 'นาย', 'vdfv', 'dfv', 'dfv', 'dfv', 60, 1, 1, 'dfv', 'dfv', '0', 1, 1),
(26, 'นาย', 'ืดืเดื', 'ดเืดื', 'ดเืดเื', 'ดเืดื', 12, 1, 16, 'เ้่เ้่', 'เ้่เ้่', '42424', 9, 2),
(27, 'นาย', 'ffffffffff', 'fffffffff', 'ffffffffff', 'fffffffffff', 55, 1, 18, 'ffffffffff', 'fffffffffff', '0', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_StudentDetail`
--

CREATE TABLE `tbl_StudentDetail` (
  `DetailID` int(11) NOT NULL,
  `StuID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_StudentDetail`
--

INSERT INTO `tbl_StudentDetail` (`DetailID`, `StuID`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Student_Hobby`
--

CREATE TABLE `tbl_Student_Hobby` (
  `ID` int(11) NOT NULL,
  `HobbyID` int(11) NOT NULL,
  `StuID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_Student_Hobby`
--

INSERT INTO `tbl_Student_Hobby` (`ID`, `HobbyID`, `StuID`) VALUES
(1, 1, 1),
(5, 3, 2),
(6, 2, 3),
(7, 20, 4),
(8, 10, 5),
(9, 4, 6),
(10, 17, 7),
(11, 8, 8),
(12, 13, 9),
(13, 1, 10),
(14, 12, 11),
(16, 15, 13),
(17, 7, 14),
(18, 6, 15),
(19, 7, 16),
(20, 5, 17),
(21, 6, 18),
(22, 2, 19),
(23, 6, 20),
(24, 7, 12),
(25, 9, 12),
(26, 12, 12),
(37, 3, 23),
(38, 8, 23),
(39, 11, 23),
(40, 4, 24),
(41, 6, 24),
(42, 15, 24),
(43, 16, 24),
(47, 3, 25),
(48, 4, 25),
(49, 6, 25),
(50, 15, 25),
(51, 5, 26),
(52, 8, 26),
(53, 11, 26),
(54, 3, 27);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Subject`
--

CREATE TABLE `tbl_Subject` (
  `SubjectID` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_Subject`
--

INSERT INTO `tbl_Subject` (`SubjectID`, `SubjectName`) VALUES
(1, 'HCI'),
(2, 'ภาษาอังกฤษ'),
(3, 'ฟิสิกส์'),
(4, 'เขียนโปรแกรมภาษาC'),
(5, 'Visual Basic'),
(6, 'ภาษาไทย'),
(7, 'แคลคูลัส'),
(8, 'คณิตดีสกรีต'),
(9, 'สัมนาการทางวิทยาศาสตร์'),
(10, 'ลีลาศ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_Year`
--

CREATE TABLE `tbl_Year` (
  `YearID` int(11) NOT NULL,
  `YearName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_Year`
--

INSERT INTO `tbl_Year` (`YearID`, `YearName`) VALUES
(1, 'ปี1'),
(2, 'ปี2'),
(3, 'ปี3'),
(4, 'ปี4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_City`
--
ALTER TABLE `tbl_City`
  ADD PRIMARY KEY (`CityID`);

--
-- Indexes for table `tbl_Department`
--
ALTER TABLE `tbl_Department`
  ADD PRIMARY KEY (`DepID`);

--
-- Indexes for table `tbl_Hobby`
--
ALTER TABLE `tbl_Hobby`
  ADD PRIMARY KEY (`HobbyID`);

--
-- Indexes for table `tbl_Student`
--
ALTER TABLE `tbl_Student`
  ADD PRIMARY KEY (`StuID`),
  ADD KEY `CityID` (`CityID`),
  ADD KEY `DepID` (`DepID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `YearID` (`YearID`);

--
-- Indexes for table `tbl_StudentDetail`
--
ALTER TABLE `tbl_StudentDetail`
  ADD PRIMARY KEY (`DetailID`),
  ADD KEY `StuID` (`StuID`);

--
-- Indexes for table `tbl_Student_Hobby`
--
ALTER TABLE `tbl_Student_Hobby`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `HobbyID` (`HobbyID`),
  ADD KEY `StuID` (`StuID`);

--
-- Indexes for table `tbl_Subject`
--
ALTER TABLE `tbl_Subject`
  ADD PRIMARY KEY (`SubjectID`);

--
-- Indexes for table `tbl_Year`
--
ALTER TABLE `tbl_Year`
  ADD PRIMARY KEY (`YearID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_Student_Hobby`
--
ALTER TABLE `tbl_Student_Hobby`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_Student`
--
ALTER TABLE `tbl_Student`
  ADD CONSTRAINT `tbl_Student_ibfk_1` FOREIGN KEY (`CityID`) REFERENCES `tbl_City` (`CityID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_Student_ibfk_2` FOREIGN KEY (`DepID`) REFERENCES `tbl_Department` (`DepID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_Student_ibfk_4` FOREIGN KEY (`SubjectID`) REFERENCES `tbl_Subject` (`SubjectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_Student_ibfk_5` FOREIGN KEY (`YearID`) REFERENCES `tbl_Year` (`YearID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_StudentDetail`
--
ALTER TABLE `tbl_StudentDetail`
  ADD CONSTRAINT `tbl_StudentDetail_ibfk_1` FOREIGN KEY (`StuID`) REFERENCES `tbl_Student` (`StuID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_Student_Hobby`
--
ALTER TABLE `tbl_Student_Hobby`
  ADD CONSTRAINT `tbl_Student_Hobby_ibfk_1` FOREIGN KEY (`HobbyID`) REFERENCES `tbl_Hobby` (`HobbyID`),
  ADD CONSTRAINT `tbl_Student_Hobby_ibfk_2` FOREIGN KEY (`StuID`) REFERENCES `tbl_Student` (`StuID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
