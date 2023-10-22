SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Actividad_Usuario` (IN `pID` INT(100), IN `pUser` VARCHAR(100), IN `pStatus` VARCHAR(100), IN `pTitle` VARCHAR(100), IN `pDescription` VARCHAR(100))  BEGIN

INSERT INTO user_activity
(user_id, username_ ,status, title, description) 
VALUES ( pID, pUser, pStatus, pTitle, pDescription);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Generar_Contraseña` (IN `pId` INT(100), IN `pPassword` VARCHAR(100), IN `pPasswordReset` BOOLEAN)  BEGIN

UPDATE users
SET `password` = pPassword, `password_reset` = pPasswordReset
WHERE `id` = pId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Info_Usuario` (IN `pCorreo` VARCHAR(100))  BEGIN

SELECT id, email, password, password_reset
FROM users
WHERE email = pCorreo;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Usuario_Existe` (IN `pCorreo` VARCHAR(100))  BEGIN

SELECT COUNT(*)
FROM users
WHERE email = pCorreo; 

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_reset` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `password_reset`, `created_at`) VALUES
(43, 'jacuna20934@ufide.ac.cr', '$2y$10$wyPDSaN7jOUc5qSxbGJnd.mo6EXkVngfs40TjJADVRUvQrICyAt5a', 0, '2023-10-23 11:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `user_id` int(100) NOT NULL,
  `username_` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`user_id`, `username_`, `status`, `title`, `description`, `created_at`) VALUES
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha terminado la sesion', '2023-10-17 23:26:24'),
(0, 'ffsdf', 'FAILED', 'Password', 'Usuario: <ffsdf> no existe en la base de datos. \r\n            El usuario ingresado no existe en la b', '2023-10-17 23:32:04'),
(0, 'dasd', 'FAILED', 'Password', 'Usuario: <dasd> no existe en la base de datos. \r\n            El usuario ingresado no existe en la ba', '2023-10-17 23:32:08'),
(0, '', 'FAILED', 'Password', 'Usuario: <> no existe en la base de datos. \r\n            El usuario ingresado no existe en la base d', '2023-10-18 11:45:27'),
(0, '', 'FAILED', 'Password', 'Usuario: <> no existe en la base de datos. \r\n            El usuario ingresado no existe en la base d', '2023-10-18 11:45:43'),
(0, '', 'FAILED', 'Password', 'Usuario: <> no existe en la base de datos. \r\n            El usuario ingresado no existe en la base d', '2023-10-18 11:45:50'),
(0, '', 'FAILED', 'Password', 'Usuario: <> no existe en la base de datos. \r\n            El usuario ingresado no existe en la base d', '2023-10-18 11:45:55'),
(0, 'dasdas', 'FAILED', 'Password', 'Usuario: <dasdas> no existe en la base de datos. \r\n            El usuario ingresado no existe en la ', '2023-10-18 17:07:58'),
(0, 'jacuna20934@ufide.ac.cr', 'FAILED', 'Password', 'Contraseña incorrecta. Se ingresó una contraseña que no coincide con la almacenada en la base de dat', '2023-10-18 17:15:36'),
(0, 'jacuna20934@ufide.ac.cr', 'FAILED', 'Password', 'Contraseña incorrecta. Se ingresó una contraseña que no coincide con la almacenada en la base de dat', '2023-10-18 17:16:00'),
(0, 'jacuna20934@ufide.ac.cr', 'FAILED', 'Password', 'Contraseña incorrecta. Se ingresó una contraseña que no coincide con la almacenada en la base de dat', '2023-10-18 17:17:03'),
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha autenticado de manera exitosa', '2023-10-18 17:41:22'),
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha terminado la sesion', '2023-10-18 17:41:27'),
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha autenticado de manera exitosa', '2023-10-18 20:00:44'),
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha terminado la sesion', '2023-10-18 20:09:21'),
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha autenticado de manera exitosa', '2023-10-18 20:09:39'),
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha terminado la sesion', '2023-10-18 20:31:58'),
(43, 'jacuna20934@ufide.ac.cr', 'SUCCESS', 'Authentication', 'Usuario ha autenticado de manera exitosa', '2023-10-18 20:32:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

