DROP TABLE IF EXISTS _user;
DROP TABLE IF EXISTS discussion;
DROP TABLE IF EXISTS message;
DROP TABLE IF EXISTS stream;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS game;
DROP TABLE IF EXISTS sell;
DROP TABLE IF EXISTS friends;



CREATE TABLE `_user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `active` int(11) DEFAULT 1
);


CREATE TABLE `discussion` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `lastTime` datetime NOT NULL,
  `type` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT NULL
);


CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_user_friend` int(11) DEFAULT NULL
);


CREATE TABLE `game` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `description` varchar(240) NOT NULL,
  `releaseDate` date NOT NULL,
  `genre` varchar(50) NOT NULL,
  `physical` tinyint(1) NOT NULL,
  `digital` tinyint(1) NOT NULL,
  `visits` int(11) NOT NULL,
  `link` varchar(450) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
);


CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `description` varchar(240) NOT NULL,
  `link` varchar(450) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
);


CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `discussion` int(11) NOT NULL,
  `responding` int(11) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL
);



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



CREATE TABLE `stream` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `platform` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `_user` varchar(50) NOT NULL,
  `discussion` int(11) NOT NULL,
  `active` tinyint(1) DEFAULT NULL
);






--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`,`discussion`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `stream`
--
ALTER TABLE `stream`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stream`
--
ALTER TABLE `stream`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `_user`
--
ALTER TABLE `_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
