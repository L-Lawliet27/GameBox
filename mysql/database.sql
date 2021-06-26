DROP TABLE IF EXISTS _user;
DROP TABLE IF EXISTS discussion;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS stream;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS game;
DROP TABLE IF EXISTS sell;
DROP TABLE IF EXISTS friends;


SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `discussion`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastTime` datetime NOT NULL,
  `type` int NOT NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;



INSERT INTO `discussion` (`id`, `name`, `_user`, `lastTime`, `type`, `active`) VALUES
(1, 'Discussion 1', 'User 1', '2021-04-13 15:00:00', 0, 1),
(2, 'Discussion 2', 'User 2', '2021-04-13 15:00:00', 0, 1),
(3, 'Discussion 3', 'User 3', '2021-04-13 15:00:00', 0, 1),
(4, 'Discussion 4', 'User 4', '2021-04-13 15:00:00', 0, 1),
(5, 'Discussion 5', 'User 5', '2021-04-13 15:00:00', 0, 1),
(6, 'Discussion 6', 'User 6', '2021-04-13 15:00:00', 0, 0),
(7, 'Discussion 7', 'User 7', '2021-04-13 15:00:00', 0, 1),
(8, 'Discussion 8', 'User 8', '2021-04-13 15:00:00', 0, 1),
(9, 'Discussion 9', 'User 9', '2021-04-13 15:00:00', 0, 1),
(10, 'Discussion 10', 'User 10', '2021-04-13 15:00:00', 0, 1),
(11, 'Discussion 11', 'User 11', '2021-04-13 15:00:00', 0, 1),
(12, 'Comments', 'User 1', '2021-04-13 15:00:00', 1, 1);



CREATE TABLE `friends`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `id_user_friend` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;



CREATE TABLE `game`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6, 2) NOT NULL,
  `_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(240) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `releaseDate` date NOT NULL,
  `genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `physical` tinyint(1) NOT NULL,
  `digital` tinyint(1) NOT NULL,
  `visits` int NOT NULL,
  `link` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;



INSERT INTO `game` (`id`, `name`, `price`, `_user`, `description`, `releaseDate`, `genre`, `physical`, `digital`, `visits`, `link`, `active`) VALUES
(1, 'Devil May Cry', '4.99', 'Andres', 'Killing Demons for Cash', '2020-04-12', 'action', 0, 1, 4, 'https://youtu.be/dQw4w9WgXcQ', 1),
(2, 'Hades', '25.99', 'Andres', 'Swords and Sandals', '2021-05-11', 'adventure', 0, 1, 1, 'https://youtu.be/dQw4w9WgXcQ', 1),
(3, 'Cowboy Bebop', '22.00', 'Andres', 'Space Cowboys', '2021-03-05', 'action', 1, 0, 0, 'https://youtu.be/dQw4w9WgXcQ', 1),
(4, 'Evangelion', '10.00', 'Andres', 'Robot Bible', '2021-05-01', 'horror', 1, 1, 1, 'https://youtu.be/dQw4w9WgXcQ', 1),
(5, 'Free Fire', '9999.99', 'tenken', 'The game received the award for the &quot;Best Popular Vote Game&quot; by the Google Play Store in 2019.[', '2021-06-09', 'action', 0, 1, 1, 'http://ff.garena.com/index/en/', 0),
(6, 'Jum', '100.00', 'tenken', 'trañldmas', '2021-06-23', 'horror', 1, 0, 0, 'http://ff.garena.com/index/en/', 1),
(7, 'Game Name', '0.05', 'tenken', 'The game received the award for the &quot;Best Popular Vote Game&quot; by the Google Play Store in 2019.[', '2021-06-17', 'rpg', 0, 1, 0, 'http://ff.garena.com/index/en/', 0),
(8, 'Game Name', '0.05', 'tenken', 'The game received the award for the &quot;Best Popular Vote Game&quot; by the Google Play Store in 2019.[', '2021-06-10', 'rpg', 0, 1, 0, 'http://ff.garena.com/index/en/', 0),
(9, 'Game Name', '0.04', 'tenken', 'The game received the award for the &quot;Best Popular Vote Game&quot; by the Google Play Store in 2019.[', '2021-06-10', 'action', 1, 0, 0, 'http://ff.garena.com/index/en/', 0),
(10, 'Dune', '0.06', 'user', 'Space Jesus', '2021-06-04', 'adventure', 0, 1, 3, 'https://worldofwarcraft.com/en-us/', 1),
(11, 'Resident Evil', '24.99', 'Kvothe', '2020 The Game', '2021-02-11', 'horror', 1, 1, 1, 'https://www.youtube.com/watch?v=mD8x5xLHRho&amp;ab_channel=Nintendo', 1),
(12, 'Dune', '23.99', 'Kvothe', 'Space Jesus', '2021-06-08', 'adventure', 1, 0, 0, 'https://www.youtube.com/watch?v=mD8x5xLHRho&amp;ab_channel=Nintendo', 1),
(13, 'World of Warcraft', '0.00', 'Kvothe', 'The price is your life', '2021-06-05', 'rpg', 0, 1, 0, 'https://worldofwarcraft.com/en-us/', 1),
(14, 'Godfather', '10.00', 'Kvothe', 'Offer You Can\'t Refuse', '2020-08-15', 'action', 1, 0, 0, 'https://www.youtube.com/watch?v=mD8x5xLHRho&amp;ab_channel=Nintendo', 1),
(15, 'FFXX', '20.99', 'Kvothe', 'Not The Final Fantasy', '2021-03-28', 'rpg', 0, 1, 0, 'https://www.youtube.com/watch?v=mD8x5xLHRho&amp;ab_channel=Nintendo', 1),
(16, 'Formula1', '1.99', 'Kvothe', 'Coches Rapidos', '2020-10-10', 'rpg', 0, 1, 0, 'https://www.youtube.com/watch?v=mD8x5xLHRho&amp;ab_channel=Nintendo', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message`  (
  `id` int NOT NULL,
  `discussion` int NOT NULL,
  `responding` int NOT NULL,
  `_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`, `discussion`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `discussion`, `responding`, `_user`, `content`) VALUES
(1, 1, 0, 'User 1', 'Message 1'),
(1, 2, 0, 'User 1', ' Message 1'),
(1, 3, 0, 'User 1', 'Message 1'),
(1, 4, 0, 'User 1', 'Message 1'),
(1, 5, 0, 'User 1', 'Message 1'),
(1, 6, 0, 'User 6', 'Message 1'),
(1, 7, 0, 'User 1', 'Message 1'),
(1, 8, 0, 'User 1', 'Message 1'),
(1, 9, 0, 'User 1', 'Message 1'),
(1, 10, 0, 'User 1', 'Message 1'),
(1, 11, 0, 'User 1', 'Message 1'),
(1, 12, 0, 'User 1', 'Message 1'),
(1, 14, 0, 'tenken', 'This a Disscusion for dev a InactiveDiscussion'),
(2, 1, 0, 'User 2', 'Message 2'),
(2, 2, 0, 'User 2', 'Message 2'),
(2, 6, 0, 'User 3', ' Message 2'),
(3, 1, 1, 'User 3', 'Message 3'),
(3, 2, 0, 'User 3', 'Message 3'),
(3, 6, 2, 'User 4', 'Message 3'),
(4, 1, 3, 'User 4', 'Message 4'),
(4, 6, 0, 'User 5', 'Message 4'),
(5, 1, 0, 'User 5', 'Message 5'),
(6, 1, 0, 'User 6', 'Message 6'),
(7, 1, 0, 'User 7', 'Message 7'),
(8, 1, 0, 'User 8', 'Message 8'),
(9, 1, 6, 'User 9', 'Message 9'),
(10, 1, 0, 'User 10', 'Message 10'),
(11, 1, 0, 'User 11', 'Message 11');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6, 2) NOT NULL,
  `_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(240) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `_user`, `type`, `description`, `link`, `active`) VALUES
(1, 'ffff', '333.00', 'nuevo', 'equipment', 'ddd', 'http://localhost/GameBox/store/product/addProduct.php', 0),
(2, 'DDDD', '0.01', 'tenken', 'equipment', 'ddd', 'http://localhost/GameBox/store/product/addProduct.php', 1),
(3, 'Console', '9999.99', 'tenken', 'console', 'nlkdsandlksandlsa', 'http://localhost/GameBox/store/product/addProduct.php', 1),
(4, 'Equiptment', '9999.99', 'tenken', 'equipment', 'dñmlfñldsfñs', 'http://localhost/GameBox/store/product/addProduct.php', 1),
(5, 'Nintendo Switch', '299.99', 'Kvothe', 'console', 'A console you can take...OUTSIDE?!', 'https://www.w3schools.com/js/js_htmldom_elements.asp', 1),
(6, 'PS5', '600.00', 'Kvothe', 'console', 'We don\'t have it', 'https://www.w3schools.com/js/js_htmldom_elements.asp', 1),
(7, 'Wii Nunchuck', '30.99', 'Kvothe', 'equipment', 'Lasts 1 Month', 'https://www.w3schools.com/js/js_htmldom_elements.asp', 1);


-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id` int(100) PRIMARY KEY,
  `category` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(6,2) NOT NULL
);

INSERT INTO `sell` (`id`, `category`, `name`, `price`) VALUES
(1, 'consola', 'Nintendo Switch', '30.00'),
(2, 'consola', 'Playstation 5', '45.00'),
(3, 'consola', 'XBox ONE', '55.00'),
(4, 'consola', 'XBox SERIESx', '50.00'),
(5, 'consola', 'PSP3', '38.00'),
(6, 'consola', 'PSP4', '41.00'),
(7, 'consola', 'Nintendo 3DS-2DS', '33.00'),
(8, 'consola', 'Xbox 360', '60.00'),
(9, 'consola', 'WII', '65.00'),
(10, 'consola', 'WII U', '70.00'),
(11, 'consola', 'PS vitaTV', '20.00'),
(12, 'equipamiento', 'Mando inalambrico DualSense', '25.00'),
(13, 'equipamiento', 'Mando XBox', '28.00'),
(14, 'equipamiento', 'Auriculares Inalámbricos Pulse 3D', '15.00'),
(15, 'equipamiento', 'Estación de carga Dual Sense', '18.00'),
(16, 'equipamiento', 'Mando con cable PDP', '10.00'),
(17, 'equipamiento', 'Mouse', '8.00');



--
-- Dumping data for table `product`
--


-- --------------------------------------------------------

--
-- Table structure for table `stream`
--

CREATE TABLE `stream`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `platform` int NOT NULL,
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `_user` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `discussion` int NOT NULL,
  `active` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

--
-- Dumping data for table `stream`
--

INSERT INTO `stream` (`id`, `name`, `platform`, `link`, `_user`, `discussion`, `active`) VALUES
(1, 'Facebook', 1, '1131916223489418', 'User 1', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_user`
--

CREATE TABLE `_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rol` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NULL DEFAULT current_timestamp,
  `active` int NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

--
-- Dumping data for table `_user`
--

INSERT INTO `_user` (`id`, `name`, `password`, `rol`, `created_at`, `active`) VALUES
(1, 'tenken', '$2y$10$eF/GJRQR8gJ5Ukf.GPsRMurlVfBKtMFw4uEraqbZCQfceaOsA2ZvC', 'developer', '2021-06-08 16:54:18', 1),
(2, 'nuevo', '$2y$10$Vxmv/LTqhlBXYkWP9q9GIO.1uvVBg7bEY3Xevu9hR1YTK2OyIWAhu', 'gamer', '2021-06-08 17:05:48', 1),
(3, 'user', '$2y$10$wxfhqcKc195dlpAvLEAlNO6fv2MnN2V9lG4KApJRTjUN4BUkpboM2', 'developer', '2021-06-09 23:37:25', 1),
(4, 'usuarioAdmin', '$2y$10$YSH2WggRu7cy5ftyOlGcVOz0QK6bi6ScQG0sqRforE12rBFkPS52O', 'admin', '2021-06-10 15:23:58', 1),
(5, 'Kvothe', '$2y$10$oJ8XjN2MNj1lSUCjJ/CiNOUTxTBVW7uorOQN6WGfAk7/TgqiTjS2m', 'developer', '2021-06-10 15:50:38', 1),
(6, 'usuarioGamer', '$2y$10$O8VnOvfNzsSP5PBCAWnBL.FUFdqj7G4N1jmpea52ekT3rNSR9YAXe', 'gamer', '2021-06-10 19:34:56', 1),
(7, 'usuarioDeveloper', '$2y$10$nNkzWJvqaQSfPWrmu2IdfO6AQHRdX3nk5ZCMKnzB.WqBqUNDbQ46a', 'developer', '2021-06-10 19:37:16', 1);

--
-- Indexes for dumped tables
--


SET FOREIGN_KEY_CHECKS = 1;