-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 06:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `image` varchar(500) NOT NULL,
  `price` double NOT NULL,
  `author` varchar(200) NOT NULL,
  `pagenumber` int(11) NOT NULL,
  `publisher` varchar(500) NOT NULL,
  `supplier` varchar(500) NOT NULL,
  `weight` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `image`, `price`, `author`, `pagenumber`, `publisher`, `supplier`, `weight`) VALUES
(1, 'Bộ Đề Thi Môn Toán 9 Vào Lớp 10 (Tái Bản 2023)', 'Bộ Đề Thi Môn Toán Lớp 9 Vào Lớp 10\r\n\r\nCuốn sách tập hợp 40 bộ đề thi môn toán lớp 9 vào lớp 10 các trường chuyên và trường năng khiếu.\r\n\r\nCuối sách còn có phần hướng dẫn giải và đáp án các đề thi giúp các em học sinh dễ dàng đối chiếu kết quả bài làm.', 'bo de thi mon toan.jpg', 48000, 'Nguyễn Đức Chí', 191, 'Đà Nẵng', 'Dn Tư Nhân Thương Mại Toàn Phúc', 213),
(2, 'Làm Chủ Kiến Thức Ngữ Văn 9 Luyện Thi Vào 10 - Phần 1: Đọc - Hiểu Văn Bản (Tái Bản 2018)', 'Làm Chủ Kiến Thức Ngữ Văn 9 Luyện Thi Vào 10 - Phần 1: Đọc - Hiểu Văn Bản (Tái Bản 2018)\r\n\r\nKỳ thi chuyển cấp vào lớp 10 đang tới rất gần, hàng triệu học sinh trên cả nước đều đang rất lo lắng về kỳ thi này. Trong các môn thi môn Ngữ văn dường như vẫn là trở ngại lớn nhất với các em.', 'lam chu kien thuc ngu van 9.jpg', 97750, 'Phạm Trung Tình', 214, 'NXB Đại Học Quốc Gia Hà Nội', 'MCBooks', 220),
(3, 'Học Tốt Ngữ Văn 12 - Tập 2', 'Học Tốt Ngữ Văn 12 (Tập 2)\r\n\r\nSách bám sát nội dung của sách giáo khoa để trả lời hệ thống các câu hỏi, hướng dẫn làm bài tập; đồng thời đưa vào một số bài văn tham khảo, những đề văn mở nhằm giúp các em có thể tự học tốt môn Ngữ Văn một cách chủ động và sáng tạo.', 'hoc tot ngu van 12.jpg', 19000, 'Lê Thị Mỹ Trinh, Nguyễn Lê Ly Na', 148, 'NXB Đà Nẵng', 'Dn Tư Nhân Thương Mại Toàn Phúc', 210),
(4, 'Không Diệt Không Sinh Đừng Sợ Hãi - Bìa Cứng - Phiên Bản Đặc Biệt - Tặng Kèm Postcard + Bút Chì Khắc Tên Sách', 'Không Diệt Không Sinh Đừng Sợ Hãi - Bìa Cứng - Phiên Bản Đặc Biệt - FAHASA ĐỘC QUYỀN PHÁT HÀNH\r\n\r\nTrong suốt cuộc đời, đức Bụt cũng bị nhiều nhà thần học và các học giả nhiều lần chất vấn về hai triết thuyết đối nghịch nhau: bất diệt hay hư không. Khi được hỏi là có đời sống vĩnh cửu không thì Bụt trả lời: “Không có cái Ngã bất biến.” Khi trả lời về chuyện chết là không còn gì nữa chăng. Bụt nói không có gì trở thành hư vô cả. Ngài bác bỏ cả hai ý tưởng trên.', 'khong diet khong sinh dung so hai.jpg', 232000, 'Thích Nhất Hạnh', 224, 'Thế Giới', 'Saigon Books', 500),
(5, 'Đi Gặp Mùa Xuân - Hành Trạng Thiền Sư Thích Nhất Hạnh', 'Đi Gặp Mùa Xuân - Hành Trạng Thiền Sư Thích Nhất Hạnh\r\n\r\nĐức Trưởng lão Hòa thượng - Thiền sư Thích Nhất Hạnh một bậc danh Tăng không chỉ ở Việt Nam mà còn trên thế giới. Trong suốt cuộc đời hành đạo và hoằng pháp của mình, Thiền sư đã mang lời dạy của đức Bụt đến gần hơn với mọi người thông qua những phương pháp về thực tập chánh niệm, tỉnh thức. Bằng sự dung hòa các truyền thống Phật giáo Nguyên Thủy, Phật giáo Đại thừa, và các phát kiến của ngành Tâm lý học đương đại phương Tây, Thầy đã thiết lập cách tiếp cận hiện đại đối với thiền. Ngài được vinh danh như một lãnh đạo tinh thần của Phật giáo có sức ảnh hưởng chỉ sau Đức Đạt Lai Lạt Ma tại phương Tây.', 'di-gap-mua-xuan_bia.jpg', 305150, 'Tăng Thân Làng Mai', 408, 'NXB Thế Giới', 'Thái Hà', 400),
(10, 'Kaguya-Sama: Cuộc Chiến Tỏ Tình - Tập 26', 'Kaguya-Sama: Cuộc Chiến Tỏ Tình - Tập 26\r\n\r\nHội trưởng Shirogane Miyuki và hội phó Shinomiya Kaguya gặp nhau tại Hội Học Sinh của học viện Shuchiin, nơi hội tụ của những con người thuộc tầng lớp thượng lưu… Đây là câu chuyện tình cảm hài hước mới mẻ về hai thiên tài tuy trong lòng thích nhau lắm rồi nhưng vẫn ngày ngày bày mưu tính kế cầm cưa, bắt đối phương phải tỏ tình trước\r\n\r\nCuối cùng, hai người đã chính thức hẹn hò. Câu chuyện bước vào hồi cuối, “Quý cô Kaguya muốn được tỏ tình”!! Trong khi chỉ còn 1 tháng nữa là Shirogane đi du học thì biến cố ập đến với nhà Shinomiya. Kaguya bị cuốn vào cuộc chiến tranh quyền đoạt vị, buộc phải chia tay Shirogane vì không muốn làm liên luỵ tới cậu. Nhưng Shirogane cùng các thành viên trong Hội Học Sinh đã quyết định đứng lên giành lại Kaguya!! Mời đón đọc “Kế hoạchtác chiến giải cứu Shinomiya” đầy kịch tính trong tập 26!!', 'kaguya-sama-cuoc-chien-to-tinh_bia_tap-26.jpg', 40000, 'Aka Akasaka', 204, 'Kim Đồng', 'Nhà Xuất Bản Kim Đồng', 220),
(11, 'Học Tốt Vật Lí - Lớp 12', 'Học Tốt Vật Lí 12\r\n\r\nNội dung cuốn sách gồm:\r\n\r\nA. KIẾN THỨC CẦN NHỚ\r\n\r\nB. PHÂN LOẠI VÀ ĐỊNH DẠNG TOÁN VÀ PHƯƠNG PHÁP GIẢI\r\n\r\nCác bài tập được viết dưới nhiều hình thức khác nhau, từ dễ đến khó. Nội dung của sách đăng tải gần như đầy đủ kiến thức vật lí 12 dưới dạng bài tập tự luận - trắc nghiệm.\r\n\r\nNhà xuất bản Tổng hợp thành phố Hồ Chí Minh là cơ quan chính trị – tư tưởng – văn hóa của Đảng bộ và nhân dân thành phố Hồ Chí Minh được thành lập từ năm 1977. Hàng năm, Nhà xuất bản Tổng hợp xuất bản hàng ngàn tựa sách gồm nhiều thể loại về chính trị, lịch sử, văn hóa, kinh tế, pháp luật, khoa học - kỹ thuật, từ điển, ngoại ngữ, sách tham khảo cho học sinh từ mẫu giáo đến trung học phổ thông; giáo trình, tài liệu tham khảo, sách học ngoại ngữ cho sinh viên cao đẳng, đại học; bên cạnh đó còn có các ấn phẩm văn hóa như lịch, bưu ảnh, sổ tay, bản đồ....\r\n\r\nTrong những năm đổi mới, đặc biệt là từ khi đất nước tiến nhanh vào thời kỳ công nghiệp hóa, hiện đại hóa, Nhà xuất bản Tổng hợp TP. Hồ Chí Minh đã nỗ lực đầu tư cả về cơ sở vật chất lẫn chuyên môn nghiệp vụ, thực hiện công tác biên tập, cấp phép, in ấn, phát hành vừa nhanh chóng đáp ứng các yêu cầu của khách hàng vừa đảm bảo và không ngừng nâng cao chất lượng các ấn phẩm. Nhiều năm liền, ấn phẩm của Nhà xuất bản Tổng hợp được bạn đọc bình chọn là hàng Việt Nam chất lượng cao, một số ấn phẩm đã được nhận các Giải vàng, Giải bạc sách hay, sách đẹp của Hội Xuất bản Việt Nam tổ chức hàng năm.', 'hoc tot vat ly 12.jpg', 26000, 'Hoàng Tú', 168, 'NXB Đồng Nai', 'Dn Tư Nhân Thương Mại Toàn Phúc', 100),
(12, 'Trải Nghiệm Khách Hàng Xuất Sắc', 'Bạn đang cầm trên tay cuốn sách Trải nghiệm khách hàng xuất sắc được viết từ hơn 22 năm kinh nghiệm, qua nhiều vị trí, môi trường khác nhau của ông Nguyễn Dương, một chuyên gia cấp quốc tế, một trong những người nhiệt huyết và chuyên sâu nhất về trải nghiệm khách hàng.\r\n\r\nNgoài kinh nghiệm thực tế và kiến thức về quản trị nói chung và quản trị trải nghiệm khách hàng nói riêng, trong quá trình hoàn thành cuốn sách này, tác giả Nguyễn Dương đã thực hiện những đợt đi nghiên cứu nhiều công ty, bao gồm những chuyến đi, những cuộc nói chuyện, phỏng vấn, trao đổi, tìm hiểu và cập nhật cách mà nhiều công ty đã thực hiện để có thể cung cấp những trải nghiệm khách hàng tuyệt vời và tăng trưởng vượt bậc.\r\n\r\nBên cạnh đó, tác giả nghiên cứu cả những lý do và rào cản khiến các chiến lược trải nghiệm khách hàng thất bại. Những nguyên lý và phương pháp đã phát huy hiệu quả và trường tồn theo thời gian, được đúc kết từ nhiều trải nghiệm, bối cảnh, quy mô và môi trường khác nhau, trong và ngoài nước.\r\n\r\nTác giả là người ham thích nghiên cứu thực tiễn hoạt động của các công ty và luôn đúc kết các thực tiễn đó thành những nguyên tắc, phương pháp luận. Tác giả lý giải rằng, phương pháp luận đi vào bản chất vấn đề, nó trả lời câu hỏi tại sao, còn khi bạn nghe câu chuyện thực tế của doanh nhân này hay lãnh đạo kia, thì nó chỉ trả lời câu hỏi cái gì và như thế nào. Không nắm được điều tại sao sau câu chuyện của họ, bạn không nắm được bản chất vấn đề, bạn chịu rủi ro lớn khi áp dụng vì khách hàng, sản phẩm, tổ chức, văn hóa,… của bạn khác. Trong khi đó, khi hiểu một nguyên tắc và phương pháp luận thì nó tương đương với hàng trăm tình huống thực tế.', 'trai nghiem khach hang.jpg', 150000, 'Nguyễn Dương', 344, 'NXB Thế Giới', 'Saigon Books', 400),
(13, 'Essential Grammar in Use Book with Answers Fahasa Reprint Edition: A Self-Study Reference and Practice Book for Elementary Learners of English', 'Essential Grammar in Use is a self-study reference and practice book for elementary-level learners (A1-B1), used by millions of people around the world. With clear examples, easy-to-follow exercises and answer key, the Fourth edition is perfect for independent study, covering all the areas of grammar that you will need at this level. The book has an easy-to-use format of two-page units with clear explanations of grammar points on the left-hand page, and practice exercises on the right. It also includes plenty of additional exercises and a Study Guide to help you find the grammar units you need to study.', 'essential grammar in use.jpg', 169100, 'Raymond Murphy', 319, 'Cambridge University', 'Cambridge University Press', 550),
(14, 'Nhóc Miko! Cô Bé Nhí Nhảnh - Tập 37', 'hóc Miko! Cô Bé Nhí Nhảnh - Tập 37\r\n\r\nMiko là cô nhóc lớp 6 vô cùng hoạt bát, khỏe khoắn. Ngày nào cũng rộn ràng, náo nhiệt cùng gia đình và bạn bè xung quanh ☆ Trong những chuỗi ngày ấy, Mari rốt cuộc lại đóng vai thần tình yêu Cupid để tác hợp cho Miko và Tappei...!?♥ Và thế là tình cảm của hai cô cậu trở thành tâm điểm chú ý ★ Tập này còn đầy ắp những câu chuyện về cô nhóc Miko đáng yêu, như chạy tiếp sức trong hội thao cuối cùng của thời tiểu học, câu chuyện đau xót của Rinka hay những chuyện bí mật của con gái chúng mình! Lại còn bài phát biểu cực kỳ quan trọng nữa chứ!!!??? Trời ơi? Muốn đọc quá đi ~!!!', 'co be nhi nhanh.jpg', 22000, 'ONO Eriko', 168, 'Trẻ', 'NXB Trẻ', 180);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `phonenumber` int(11) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `fullname`, `phonenumber`, `address`) VALUES
('a', 'a', 'Nguyen Van A', 123456789, 'Ha Noi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
