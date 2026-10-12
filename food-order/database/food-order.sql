-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2026 a las 00:30:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `food-order`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`, `email`) VALUES
(1, 'Paco Fernandez', 'Paco', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'prueba2@gmail.com'),
(24, 'Ruben García', 'Ruben', '81dc9bdb52d04dc20036dbd8313ed055', 'ruben@gmail.com'),
(29, 'Maria', 'Maria', '81dc9bdb52d04dc20036dbd8313ed055', 'prueba@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_aviso`
--

CREATE TABLE `tbl_aviso` (
  `id` int(11) NOT NULL,
  `num_mesa` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_aviso`
--

INSERT INTO `tbl_aviso` (`id`, `num_mesa`, `status`) VALUES
(15, '8', 'Cancelado'),
(16, '4', 'Llevar la Cuenta'),
(18, '2', 'Pagado'),
(27, '22', 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Pizzas', 'Food_Category_921.jpg', 'Si', 'Si'),
(11, 'Pescados', 'Food_Category_433.jpg', 'No', 'Si'),
(13, 'Bebidas', 'Food_Category_286.jpg', 'Si', 'Si'),
(15, 'Carnes', 'Food_Category_55.jpg', 'No', 'Si'),
(16, 'Pasta', 'Food_Category_523.jpg', 'No', 'Si'),
(17, 'Ensaladas', 'Food_Category_385.jpg', 'No', 'Si'),
(18, 'Postres', 'Food_Category_726.jpg', 'Si', 'Si'),
(20, 'Hamburguesas', 'Food_Category_240.jpg', 'Si', 'Si'),
(26, 'Desayunos', 'Food_Category_784.jpg', 'Si', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(7, 'RB-BURGER', '   Carne, Lechuga y Queso', 12.00, 'Food-Name-8125.jpg', '20', 'Si', 'Si'),
(10, 'Alitas de Pollo', '    Alitas de pollo con Salsa Picante', 8.00, 'Food-Name-5556.jpg', '15', 'Si', 'Si'),
(13, 'Pizza Tropical', '                  Queso, tomate, pepperoni, aceitunas negras', 9.00, 'Food-Name-6168.jpg', '1', 'Si', 'Si'),
(15, 'Agua', '                      Botella agua 1L', 2.00, 'Food-Name-9822.jpg', '13', 'No', 'No'),
(16, 'Coca-cola', '        Lata Coca-cola 33cl', 2.00, 'Food-Name-6603.jpg', '13', 'No', 'No'),
(17, 'Spaguetti', '              Spaguetti con albóndigas, tomate y queso ', 8.00, 'Food-Name-6532.jpg', '16', 'No', 'Si'),
(18, 'Ensalada Griega', '  Tomate, Cebolla Roja, Aceitunas y Queso', 7.00, 'Food-Name-7203.jpg', '17', 'No', 'Si'),
(19, 'Fanta Naranja', '        Lata 33CL', 2.00, 'Food-Name-7879.jpg', '13', 'No', 'No'),
(20, 'Combinado', '           Patatas fritas, huevo, pimiento y ternera.', 12.00, 'Food-Name-2785.jpg', '15', 'No', 'Si'),
(21, 'Salmón', '            Salmón a la plancha y espárragos', 7.00, 'Food-Name-8467.jpg', '11', 'No', 'Si'),
(31, 'Bacalao', '  Bacalao frito largo con verduras', 12.00, 'Food-Name-7493.jpg', '11', 'No', 'Si'),
(32, 'Bistec', '  Bistec a la plancha con espárragos', 12.00, 'Food-Name-4457.jpg', '15', 'No', 'Si'),
(33, 'Pasta', '  Pasta con espinacas y salchichas', 9.00, 'Food-Name-8601.jpg', '16', 'No', 'Si'),
(34, 'Macarrones', ' Macarrones con carne, salsa de tomate y verduras', 8.00, 'Food-Name-2868.jpg', '16', 'No', 'Si'),
(35, 'Poke bowl', ' Poke bowl con salmón, aguacate, quinua y pepino\r\n\r\n', 7.00, 'Food-Name-8143.jpg', '17', 'No', 'Si'),
(36, 'Pepperoni', ' Pizza pepperoni ', 8.00, 'Food-Name-5463.jpg', '1', 'No', 'Si'),
(47, 'Clásica', 'Carne, Queso, Lechuga, Tomate, Salsa a elección', 15.00, 'Food-Name-9122.jpg', '20', 'Si', 'Si'),
(48, 'Pollo', 'Carne pollo, Lechuga, Mayonesa', 10.00, 'Food-Name-7806.jpg', '20', 'Si', 'Si'),
(49, 'Café', 'Café Latte', 2.00, 'Food-Name-4732.jpg', '26', 'No', 'Si'),
(50, 'Tostada', 'Tostada Jamón y Tomate', 2.00, 'Food-Name-8973.jpg', '26', 'Si', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_password`
--

CREATE TABLE `tbl_password` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tbl_password`
--

INSERT INTO `tbl_password` (`email`, `token`, `expires`) VALUES
('', '3290f58b50f7e8c5da497767f127de210d956a857245f9ae661fd9e6072f1809869bdb81b46eebe59bf4ee8c215dfff82263', '2024-06-02 12:12:50'),
('', 'ae427f2eb5ddb8e717dfc556da60cdecd7813293eb290ea1bca02ee85b733b71db31b15e42d1120fad97b372069f999692cd', '2024-06-02 22:29:58'),
('elllanoruben@gmail.com', 'b011e57f788eeb94f5a0867ec9b5b1dcadd900a62211037673311646abceb81c69082f6397f91e9d8ebde854b1318eab77a4', '2024-06-02 22:41:34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_aviso`
--
ALTER TABLE `tbl_aviso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_password`
--
ALTER TABLE `tbl_password`
  ADD PRIMARY KEY (`token`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tbl_aviso`
--
ALTER TABLE `tbl_aviso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
