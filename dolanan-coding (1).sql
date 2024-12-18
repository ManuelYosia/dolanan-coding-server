-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 04:07 AM
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
-- Database: `dolanan-coding`
--

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` int(11) NOT NULL,
  `question` varchar(800) NOT NULL,
  `answer` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `question`, `answer`) VALUES
(1, 'Tuliskan Sintaks untuk menampilkan tulisan \"Hello World!\"', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  cout << \"Hello World!\";\r\n  return 0;\r\n}'),
(2, 'Tuliskan sintaks untuk mendeklarasikan variabel umur', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  int umur;\r\n\r\n  return 0;\r\n}'),
(3, 'Tuliskan sintaks untuk menampilkan variabel umur', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  int umur;\r\n  \r\n  cout << umur << endl;\r\n\r\n  return 0;\r\n}'),
(4, 'Tuliskan sintaks untuk mendeklarasikan variabel dengan tipe data boolean dan memiliki nama status', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  bool status;\r\n  \r\n  cout << umur << endl;\r\n\r\n  return 0;\r\n}'),
(5, 'Tuliskan sintaks untuk mendeklarasikan variabel dengan tipe data char dan memiliki nama char', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  char char;\r\n  \r\n  cout << umur << endl;\r\n\r\n  return 0;\r\n}'),
(6, 'Buatlah variabel dengan tipe data boolean dan nama variabel status lalu tampilkan', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  bool status;\r\n  \r\n  cout << status << endl;\r\n\r\n  return 0;\r\n}'),
(7, 'Buatlah perkondisian if dengan kondisi atau syarat a > 1', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  if(a > 1) {\r\n    \r\n  }\r\n\r\n  return 0;\r\n}'),
(8, 'Buatlah perkondisian if else dengan kondisi atau syarat a > 1', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  if(a > 1) {\r\n    \r\n  } else {\r\n \r\n  }\r\n\r\n  return 0;\r\n}'),
(9, 'Buatlah perulangan for dengan ketentuan i = 0 dan melakukan perulangan sebanyak 10 kali', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  for(int i = 0; i < 10 ; i++) {\r\n\r\n  }\r\n\r\n  return 0;\r\n}'),
(10, 'Buatlah perulangan while dengan ketentuan i = 0 dan melakukan perulangan sebanyak 10 kali', '#include <iostream>\r\nusing namespace std;\r\n\r\nint main() {\r\n  int i = 0;\r\n  while(i < 10) {\r\n    i++;\r\n  }\r\n\r\n  return 0;\r\n}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_depan` varchar(20) NOT NULL,
  `nama_belakang` varchar(20) NOT NULL,
  `poin` int(100) NOT NULL,
  `level` int(10) NOT NULL,
  `map` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
