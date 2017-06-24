-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2017 a las 21:46:02
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tiendastock`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcomprobante`
--

CREATE TABLE `tbcomprobante` (
  `idcomprobante` int(11) NOT NULL,
  `intCodComprob` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `dtPeriodo` date NOT NULL,
  `bitTipoCP` int(1) NOT NULL,
  `nvchCUD` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `bitTipoDocCliente` int(1) NOT NULL,
  `nvchNombreRazonSocial` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dtEmision` date NOT NULL,
  `bitTipoCambio` int(1) NOT NULL,
  `inttelefono` int(9) NOT NULL,
  `intIgvIva` double NOT NULL,
  `intImporteTotal` double NOT NULL,
  `intTipoPago` int(1) NOT NULL,
  `bitEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbcomprobante`
--

INSERT INTO `tbcomprobante` (`idcomprobante`, `intCodComprob`, `dtPeriodo`, `bitTipoCP`, `nvchCUD`, `bitTipoDocCliente`, `nvchNombreRazonSocial`, `dtEmision`, `bitTipoCambio`, `inttelefono`, `intIgvIva`, `intImporteTotal`, `intTipoPago`, `bitEstado`) VALUES
(11, '240617073153', '2017-06-17', 2, '73969785', 0, '7', '2017-06-24', 1, 12312323, 18, 12, 1, 1),
(13, '240617073157', '2017-06-24', 2, '73969785', 0, '9', '2017-06-24', 1, 64234543, 18, 12390, 1, 1),
(14, '240617075653', '2017-06-24', 2, '73969785', 0, '8', '2017-06-24', 1, 98989898, 18, 1200, 1, 2),
(15, '240617074815', '2017-06-16', 2, '73969785', 0, '8', '2017-06-24', 1, 12312323, 18, 12390, 1, 1),
(16, '240617074845', '2017-06-22', 2, '73969785', 0, '9', '2017-06-24', 1, 64234543, 18, 12390, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpagos`
--

CREATE TABLE `tbpagos` (
  `intCod` int(11) NOT NULL,
  `intCodComprobante` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `intMetodoPago` int(1) NOT NULL,
  `nvchCodigoBol` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fltMontoAbonado` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbpagos`
--

INSERT INTO `tbpagos` (`intCod`, `intCodComprobante`, `intMetodoPago`, `nvchCodigoBol`, `fltMontoAbonado`) VALUES
(1, '13', 1, '123123123', 1000.00),
(2, '13', 3, '123123123', 1200.00),
(3, '13', 3, '123123123', 1200.00),
(4, '11', 1, '123121', 123123.00),
(5, '11', 1, '123121', 123123.00),
(6, '15', 2, '123121', 123123.00),
(7, '13', 2, '1231232123', 1200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproducto`
--

CREATE TABLE `tbproducto` (
  `intidproducto` int(11) NOT NULL,
  `nvchproducto` varchar(50) NOT NULL,
  `nvchdescripcion` varchar(100) NOT NULL,
  `nvchcantidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbproducto`
--

INSERT INTO `tbproducto` (`intidproducto`, `nvchproducto`, `nvchdescripcion`, `nvchcantidad`) VALUES
(27, 'Engranes don Pepe', 'Distribuidor DE PERM SAC', '3'),
(28, 'Arroz hoja redonda', 'X1Kg hoja redonda', '2'),
(29, 'leche fresca', 'leche botellaXlitro', '3'),
(30, 'Leche enlatada soyvida', 'pollo descripcion', '2'),
(32, 'Tractor CAT', 'Tracto cat 6 llantas', '2'),
(33, 'Arroz rompe olla', 'Exquisito que domina tu paladar ', '3'),
(34, 'producto', 'Tracto cat 6 llantas', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbproveedor`
--

CREATE TABLE `tbproveedor` (
  `intidproveedor` int(11) NOT NULL,
  `intcodigo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nvchnombre` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nvchrazon_social` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `nvchdomicilio` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nvchlocalidad` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `intfax` int(9) NOT NULL,
  `inttelefono` int(9) NOT NULL,
  `intcelular` int(9) NOT NULL,
  `nvchsitio_web` text COLLATE utf8_unicode_ci NOT NULL,
  `nvchemail_1` text COLLATE utf8_unicode_ci NOT NULL,
  `nvchemail_2` text COLLATE utf8_unicode_ci NOT NULL,
  `inttipo_doc` int(1) NOT NULL,
  `intcod_doc` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tbproveedor`
--

INSERT INTO `tbproveedor` (`intidproveedor`, `intcodigo`, `nvchnombre`, `nvchrazon_social`, `nvchdomicilio`, `nvchlocalidad`, `intfax`, `inttelefono`, `intcelular`, `nvchsitio_web`, `nvchemail_1`, `nvchemail_2`, `inttipo_doc`, `intcod_doc`) VALUES
(7, '240617013432', 'Carlos adauto Ramos', 'Villegas SAC', 'Pje las urandas 126 huancayo', 'Peruana', 1212121, 64234543, 9875161, 'http://www.salinasvargas.com', 'salinasvargas@gmail.com', 'salinasvargas2@gmail.com', 1, 1047483645),
(8, '240617022411', 'analiza melchoto', 'salinasvargas SAC', 'Pje Alamedas 126 el tambo', 'Rusa', 123123, 12312323, 47483647, 'http://www.salinasvargas.com', 'edithlizano@gmail.com', 'juanarroyo@gmail.com', 1, 1047483647),
(9, '240617042915', 'hugo chave', 'villegas SAC', 'Pje las alamedas 1234', 'Peruana', 123123, 12312323, 123123, 'http://devhuayra.com', 'edithlizano@gmail.com', 'salinasvargas2@gmail.com', 1, 1047483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbstock`
--

CREATE TABLE `tbstock` (
  `intidstock` int(11) NOT NULL,
  `inidproducto` int(11) NOT NULL,
  `nvchcantidad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbstock`
--

INSERT INTO `tbstock` (`intidstock`, `inidproducto`, `nvchcantidad`) VALUES
(91, 25, -15),
(95, 26, 130),
(100, 25, 15),
(101, 31, -20),
(105, 25, -48),
(106, 26, 190),
(107, 25, 50),
(108, 25, -200),
(112, 32, 190),
(114, 30, -90),
(115, 28, -79);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `estado` int(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `estado`) VALUES
(4, 'luis sanchez', 'luissanchez@gmail.com', '9bdddfd73d9b5a28816a58bedff2f817', 0),
(5, 'junior yauricasa', 'junioryauricasa@gmail.com', 'b06aae61bf02537aa2f6146d6697e15d', 1),
(3, 'hector vivanco', 'hectorvivanco@gmail.com', 'f85097dddc73c0bf16ae8a9371aad425', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbcomprobante`
--
ALTER TABLE `tbcomprobante`
  ADD PRIMARY KEY (`idcomprobante`);

--
-- Indices de la tabla `tbpagos`
--
ALTER TABLE `tbpagos`
  ADD PRIMARY KEY (`intCod`);

--
-- Indices de la tabla `tbproducto`
--
ALTER TABLE `tbproducto`
  ADD PRIMARY KEY (`intidproducto`);

--
-- Indices de la tabla `tbproveedor`
--
ALTER TABLE `tbproveedor`
  ADD PRIMARY KEY (`intidproveedor`);

--
-- Indices de la tabla `tbstock`
--
ALTER TABLE `tbstock`
  ADD PRIMARY KEY (`intidstock`),
  ADD KEY `inidproducto` (`inidproducto`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbcomprobante`
--
ALTER TABLE `tbcomprobante`
  MODIFY `idcomprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tbpagos`
--
ALTER TABLE `tbpagos`
  MODIFY `intCod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tbproducto`
--
ALTER TABLE `tbproducto`
  MODIFY `intidproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `tbproveedor`
--
ALTER TABLE `tbproveedor`
  MODIFY `intidproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tbstock`
--
ALTER TABLE `tbstock`
  MODIFY `intidstock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
