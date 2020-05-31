
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `email`, `telefono`, `password`, `tipoUsuario`, `saldo`, `imagen`, `bloq`, `valoracion`) VALUES
(1, 'admin', 'ecomueble.admin@gmail.com', 602548003, '$2y$10$DDQBORmx7lzkGnvdVUXYfuWV7sXxHdMQOUiIF.c5pHqnnptc8ssX2', 1, 500, 'default_profile.jpg', 0, 10),
(2, 'Sara P', 'saraperez@gmail.com', 612654687, '$2y$10$wOkGu7zqU24qAEapKEAANefv15T1z0gMEKmIY66vFjFJv99POBm66', 0, 85, 'Sara P_profile.jpg', 0, 10),
(3, 'Carlos12', 'carsanper@hotmail.es', 658459632, '$2y$10$eqq0JRhNlC6.BJqEYnS5eOfDpowfQjp1VfoOIs/VlhLxzWgLKvqjq', 0, 20, 'Carlos12_profile.jpg', 0, 10),
(4, 'Patripat', 'plopez97@gmail.com', 622588947, '$2y$10$3SHlmZ7Z8Rt.b3Z5GWmn7OUkmMkwTb2lifk/IS6Gntk.Fz1.KLCc2', 0, 90, 'Patripat_profile.jpg', 0, 10),
(5, 'Amueblador', 'amueblador_27@gmail.com', 644589325, '$2y$10$QxZonX/ZxaPxv1.nY9GAHO6gJdO9DW5Co8iv2yatuD6RKgnVD1RQi', 0, 30, 'Amueblador_profile.JPG', 0, 10),
(6, 'elee.03', 'elenagonzalez@yahoo.es', 687523149, '$2y$10$rzQEhneSA1OCxX5/mtVGEu0rLYcxUGoS2GvdxB4AquXy/AKgCMYjq', 0, 15, 'elee.03_profile.jpg', 0, 10),
(7, '.Ana.', 'a.lopsan@gmail.com', 685214789, '$2y$10$H/oD4t1.qWxN/mXbgapn0.hvqRuTjonsCjXVRDZwkeZQ8XEPnPj2y', 0, 50, '.Ana._profile.jpg', 0, 10),
(8, 'JoseSanz', 'jsanz547@yahoo.es', 614365896, '$2y$10$Gck6CWJGivuavrrTK4dP1.VPi3wkMrNkns2ua4LNlWjOsVLJQTxIK', 0, 50, 'JoseSanz_profile.JPG', 0, 10),
(9, 'ZamoranoMartin', 'l.zammart@hotmail.com', 648752369, '$2y$10$4aS5fwMycvzKe4Os9sdzze1kAlyOc2mX.OGeVTA1ktUoEqawa.Use', 0, 70, 'ZamoranoMartin_profile.jpg', 0, 10),
(10, 'm.sanchez', 'm.sanchez@msn.com', 648752396, '$2y$10$GwMV45Mac9lquoDLfAR/XeDa4rTovBGRJhQdY58.AmlJyGu1JtAzu', 0, 15, 'm.sanchez_profile.jpg', 0, 10),
(11, 'armariodeschrodinger', 'armariodeschrodinger@gmail.com', 632658941, '$2y$10$54s1XAXTBbWJesi8nyZlbuGmRer8tEvYs4sJikkieqU1Y9VquZMZW', 0, 85, 'armariodeschrodinger_profile.JPG', 0, 10),
(12, 'Yass', 'yas.badalyan@gmail.com', 698745210, '$2y$10$7TArxHqTNcCiA8T/M533.uDoajzIy20500PHZG9I9kVWdP3.7L31q', 0, 55, 'Yass_profile.JPG', 0, 10),
(13, 'Fran.53', 'franciscomenendez@hotmail.com', 674123658, '$2y$10$GPF1JQqCDH8Appe98A3gwOfH9aTy0hDmqZGE/gwmBfk7a1Ap1C9lG', 0, 75, 'Fran.53_profile.jpg', 0, 10),
(14, 'maaryhelen', 'el.dominguez@gmail.com', 612584369, '$2y$10$Uz8uK34E1xdSas/aoFkRlOEeGQ1m02GaohK4ZpzutdgSkp4fQA4/.', 0, 25, 'maaryhelen_profile.jpg', 0, 10),
(15, 'd_sanlo', 'd_sanlo@hotmail.com', 602584130, '$2y$10$MrXMkOs05wL7TVgpWnhhzO0pvDg/hEok9Yj2ZII5BXzPHLzbUCJgO', 0, 25, 'd_sanlo_profile.jpg', 0, 10),
(16, 'begooooooo', 'begolopmart@msn.com', 667859632, '$2y$10$Q97XYj95g3YKogIHpWzB3elJNkMTdCB.e0y4e3M5Izeao72LrLCum', 0, 70, 'begooooooo_profile.jpg', 0, 10),
(17, 'lamesadepablo', 'pablodiaz5396@gmail.com', 600214589, '$2y$10$.hNWj1MALfWdfAlo3zV6OerMGOH5033EqnHdbsCWyEoPMggS9TKAi', 0, 115, 'lamesadepablo_profile.jpg', 0, 10),
(18, 'monillo_loco', 'm.ruizcardiel@hotmail.com', 630258965, '$2y$10$QP04FYvu5ECzqHlpGL9uL.nIELteynfhyVGQg89lm4pBspy1zDfga', 0, 50, 'monillo_loco_profile.JPG', 0, 10),
(19, 'j.vazquez', 'j.vazquez@gmail.com', 645201369, '$2y$10$saKsWHL/uLBQbdAS5geMV.ddK2kDsllvzmQE56bHnxjXCP0EhyhJS', 0, 15, 'j.vazquez_profile.jpg', 0, 10),
(20, 'Natalia_94', 'nat_rodriguez_94@gmail.com', 658902313, '$2y$10$465TIzAyxfvk3lBnSQOf1OxQ0iOyr6.uGFlUYPMeKEc6Y7UKCcmrC', 0, 10, 'Natalia_94_profile.jpg', 0, 10),
(21, 'wilson', 'guilleov@ucm.es', 684216696, '$2y$10$h681e.VAdpki37HrDiRlF.lG5v9W420s1QAfFxcWjLVjNgleAVqUa', 1, 999, 'wilson.png', 0, 10),
(22, 'prueba', 'prueba@prueba.com', 657845213, '$2y$10$A36aJIWPRxz7oEkhZoKzveiYxtmPKqu4eczI/sn8qJYDX3.tfszH6', 1, 999, 'default_profile.jpg', 0, 10);

-- --------------------------------------------------------

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `descripcion`, `precio`, `idEstado`, `idCategoria`, `nombre`, `idUsuario`, `imagen`) VALUES
(1, 'Vitrina de madera con puertas de cristal', '30', 1, 4, 'Vitrina blanca', 12, 'Vitrina blanca_1.jpg'),
(2, 'Mesa baja rústica hecha con un barril', '25', 1, 3, 'Mesa barril', 13, 'Mesa barril_2.jpg'),
(3, 'Tres sillas altas para barra', '45', 0, 1, 'Juego de sillas', 20, 'Juego de sillas_3.jpg'),
(4, 'Estantería grande de madera y metal', '40', 1, 4, 'Estantería de pared', 4, 'Estanteria de pared_4.jpg'),
(5, 'Mesa de comedor para 8 personas', '40', 0, 3, 'Mesa redonda', 5, 'Mesa redonda_5.jpg'),
(6, 'Armario de madera con puertas de cristal', '45', 0, 2, 'Armario aparador', 5, 'Armario aparador_6.jpg'),
(7, 'Con este armario Schrodinger lo habría tenido claro', '35', 1, 2, 'Armario de madera', 11, 'Armario de madera y mimbre_7.jpg'),
(8, 'Estantería grande con hueco para televisión (240x40x202cm)', '100', 0, 4, 'Estantería para salón', 15, 'Estanteria para salon_8.jpg'),
(9, 'Silla verde tapizada con estructura metáica', '15', 0, 1, 'Silla verde', 14, 'Silla verde_9.jpg'),
(10, 'Mesa y banco de madera y acero', '60', 0, 3, 'Mesa con banco', 9, 'Mesa con banco_10.jpg'),
(11, 'Mesa cuadrada de madera, las sillas no están incluidas', '30', 0, 3, 'Mesa con cuatro patas', 10, 'Mesa con cuatro patas_11.jpg'),
(12, 'Estantería de madera con tres baldas y dos cajones', '35', 1, 4, 'Estantería blanca', 2, 'Estanteria blanca_12.jpg'),
(13, 'Estantería de madera con baldas de altura regulable', '40', 0, 4, 'Estantería alta', 6, 'Estanteria alta_13.jpg'),
(14, 'Armario con tres cajones y puerta de madera', '35', 0, 2, 'Armario bajo', 6, 'Armario bajo_14.jpg'),
(15, 'Armario para pasillo con cuatro cajones grandes', '25', 0, 2, 'Armario estrecho', 7, 'Armario estrecho_15.jpg'),
(16, 'Mesa de centro con tablero regulable', '30', 1, 3, 'Mesa baja', 17, 'Mesa baja_16.jpg'),
(17, 'Estantería alta con 5 baldas y acabado de madera natural', '15', 0, 4, 'Escalera con estantes', 19, 'Escalera con estantes_17.jpg'),
(18, 'Estantería grande con cinco baldas, cuatro cajones y dos puertas.', '65', 0, 4, 'Estantería grande', 16, 'Estanteria grande_18.jpg'),
(19, 'Estantería de cuatro baldas de madera con estructura metálica', '20', 0, 4, 'Estantería mediana', 3, 'Estanteria mediana_19.jpg'),
(20, 'Mesa redonda de madera ', '35', 0, 3, 'Mesa redonda', 3, 'Mesa redonda_20.jpg'),
(21, 'Mesa pequeña con taburetes incluidos', '25', 1, 3, 'Mesa azul', 8, 'Mesa azul_21.jpg'),
(22, 'Silla tapizada con motivo de flores y estructura metáica', '20', 0, 1, 'Silla de flores', 14, 'Silla de flores_22.jpg'),
(23, 'Mesa para trabajos de jardinería con herramientas incluidas', '25', 0, 3, 'Mesa de jardinería', 20, 'Mesa de jardineria_23.jpg'),
(24, 'Estantería con múltiples huecos y un par de cajones', '25', 1, 4, 'Estantería blanca', 12, 'Estanteria blanca_24.jpg'),
(25, 'Vendo boli bic y regalo nintendo switch', '230', 0, 1, 'Animal crossing', 18, 'Animal crossing_25.jpg'),
(26, 'Vendo boli bic y regalo nintendo switch', '230', 0, 2, 'Animal crossing', 18, 'Animal crossing_26.jpg'),
(27, 'Vendo boli bic y regalo nintendo switch', '230', 0, 3, 'Animal crossing', 18, 'Animal crossing_27.jpg'),
(28, 'Vendo boli bic y regalo nintendo switch', '230', 0, 4, 'Animal crossing', 18, 'Animal crossing_28.jpg'),
(29, 'Juego de tres sillas azules recién tapizadas', '65', 0, 1, 'Sillas azules', 10, 'Sillas azules_29.jpg'),
(30, 'Armario con cajones de madera', '60', 0, 2, 'Armario cajonera', 10, 'Armario cajonera_30.jpg'),
(31, 'Mesa de madera maciza con dos cajones', '75', 0, 3, 'Mesa escritorio', 15, 'Mesa escritorio_31.jpg'),
(32, 'Armario aparador con juego de texturas', '45', 0, 2, 'Armario aparador', 19, 'Armario aparador_32.jpg'),
(33, 'Juego de cuatro taburetes iguales de madera', '40', 0, 1, 'Sillas taburete', 17, 'Sillas taburete_33.jpg'),
(34, 'Carro con baldas y ruedas en perfecto estado', '30', 0, 4, 'Carro estantería', 4, 'Carro estanteria_34.jpg'),
(35, 'Estantería de madera natural con mueble en L', '35', 0, 4, 'Estantería de madera', 7, 'Estanteria de madera_35.jpg'),
(36, 'Armario aparador de madera con ruedas', '30', 0, 2, 'Aparador de madera', 9, 'Aparador de madera_36.jpg'),
(37, 'Mesa de trabajo con tablero abatible', '45', 0, 3, 'Mesa de trabajo', 11, 'Mesa de trabajo_37.jpg'),
(38, 'Mesa de centro de madera maciza', '35', 0, 3, 'Mesa de centro', 2, 'Mesa de centro_38.jpg'),
(39, 'Mesa de comedor de cristal', '40', 0, 3, 'Mesa de cristal', 12, 'Mesa de cristal_39.jpg'),
(40, 'Armario con puerta de vídrio', '35', 0, 2, 'Armario despensa', 6, 'Armario despensa_40.jpg'),
(41, 'Mesa con tablero de fibra resistente', '30', 0, 3, 'Mesa resistente', 11, 'Mesa resistente_41.jpg'),
(42, 'Juego de mesitas supletorias', '25', 0, 3, 'Mesitas supletorias', 10, 'Mesitas supletorias_42.jpg'),
(43, 'Armario de madera decapada con puertas de cristal', '40', 0, 2, 'Armario decapado', 5, 'Armario decapado_43.jpg'),
(44, 'Mesa de escritorio de madera', '15', 0, 3, 'Escritorio estrecho', 8, 'Escritorio estrecho_44.jpg'),
(45, 'Mesa de centro con tablero de mármol', '50', 0, 3, 'Mesa de mármol', 15, 'Mesa de marmol_45.jpg'),
(46, 'Silla de mimbre recostada', '15', 0, 1, 'Silla recostada', 14, 'Silla recostada_46.jpg'),
(47, 'Sillón pequeño acolchado y tapizado', '20', 0, 1, 'Sillón naranja', 14, 'Sillon naranja_47.jpg'),
(48, 'Mesa redonda con tablero de cristal y juego de cuatro sillas', '75', 0, 3, 'Mesa y sillas', 16, 'Mesa y sillas_48.jpg'),
(49, 'Mesa y banco de madera y metal', '55', 0, 3, 'Mesa y banco', 20, 'Mesa y banco_49.jpg'),
(50, 'Mesa de escritorio con tablero de fibra', '40', 0, 3, 'Escritorio de fibra', 4, 'Escritorio de fibra_50.jpg'),
(51, 'Mesa muy grande con tablero de madera conglomerada', '50', 1, 3, 'Mesa grande', 9, 'Mesa grande_51.jpg'),
(52, 'Mesa de centro con mesita baja extraíble', '45', 0, 3, 'Mesas de centro', 13, 'Mesas de centro_52.jpg'),
(53, 'Mesa redonda de madera conglomerada', '30', 0, 3, 'Mesa redonda', 16, 'Mesa redonda_53.jpg'),
(54, 'Mesa de centro con tablero de mármol', '35', 1, 3, 'Mesa de mármol', 17, 'Mesa de marmol_54.jpg'),
(55, 'Estantería simple de estructura metálica', '30', 0, 4, 'Estantería sencilla', 7, 'Estanteria sencilla_55.jpg'),
(56, 'Estantería con estructura metálica y ruedas', '25', 0, 4, 'Estantería con ruedas', 11, 'Estanteria con ruedas_56.jpg'),
(57, 'Librería con escalera', '65', 0, 4, 'Librería-estantería', 2, 'Libreria-estanteria_57.jpg'),
(58, 'Aparador de pared para vajilla', '10', 0, 4, 'Baldas para vajilla', 3, 'Baldas para vajilla_58.jpg'),
(59, 'Estantería de diseño con almacenaje', '40', 0, 4, 'Estantería de diseño', 10, 'Estanteria de diseno_59.jpg'),
(60, 'Estantería infantil de madera pintada de azul', '15', 0, 4, 'Estantería infantil', 12, 'Estanteria infantil_60.jpg'),
(61, 'Armario grande con baldas y cajonera baja', '70', 0, 2, 'Armario blanco', 8, 'Armario blanco_61.jpg'),
(62, 'Armario con doble puerta y cierre con tope', '40', 0, 2, 'Armario rústico', 19, 'Armario rustico_62.jpg'),
(63, 'Armario bajo con puertas de mimbre', '20', 1, 2, 'Armario bajo', 16, 'Armario bajo_63.jpg'),
(64, 'Armario vajillero con tiradores de forja', '50', 0, 2, 'Armario vajillero', 13, 'Armario vajillero_64.jpg'),
(65, 'Silla blanca de madera y respaldo alto', '15', 0, 1, 'Silla blanca', 20, 'Silla blanca_65.jpg'),
(66, 'Silla antigua de bambú y mimbre', '10', 0, 1, 'Silla de mimbre', 6, 'Silla de mimbre_66.jpg'),
(67, 'Sofa elegante de color gris', '50', 0, 5, 'Sofa gris', 15, 'sofa1.jpg'),
(68, 'Sofa clasico marron', '30', 0, 5, 'Sofa clasico', 6, 'sofa2.jpg'),
(69, 'Sofa de cuero blanco estilo clasico', '40', 0, 5, 'Sofa de cuero', 7, 'sofa3.jpg'),
(70, 'Sofa abatible electrico', '70', 0, 5, 'Sofa abatible', 13, 'sofa4.jpg'),
(71, 'Cama individual abatible', '50', 0, 6, 'Cama plegable', 2, 'cama1.jpg'),
(72, 'Cama matrimonio azul con cajonera', '60', 0, 6, 'Cama matrimonio', 3, 'cama2.jpg'),
(73, 'Cama infantil fantasia con cama inferior', '45', 0, 6, 'Cama infantil', 12, 'cama3.jpg'),
(74, 'Cama matrimonio alta con arcon espacioso', '65', 0, 6, 'Cama matrimonio', 17, 'cama4.jpg'),
(75, 'Lampara de techo con forma cilindrica elaborada en vidrio gris', '35', 0, 7, 'Lampara moderna', 7, 'lampara1.jpg'),
(76, 'Lampara de pie de metal color anticuario con flecos en beige', '45', 0, 7, 'Lampara de pie', 10, 'lampara2.jpg'),
(77, 'Lampara de noche cuadrada moderna', '20', 0, 7, 'Lampara de noche', 11, 'lampara3.jpg'),
(78, 'Lampara de araña de estilo antiguo', '60', 0, 7, 'Lampara de araña', 14, 'lampara4.jpg'),
(79, 'Cama individual simple de madera', '40', 0, 6, 'Cama individual', 17, 'cama5.jpg'),
(80, 'Litera moderna de madera color blanco', '75', 0, 6, 'Litera moderna', 8, 'cama6.jpg'),
(81, 'Cama plegable de matrimonio y de madera, sin colchon', '60', 0, 6, 'Cama plegable', 9, 'cama7.jpg'),
(82, 'Sofa simple a base de palets de madera', '45', 0, 5, 'Lampara moderna', 7, 'sofa5.jpg'),
(83, 'Sofa exterior con estructura de aluminio, color chocolate', '50', 0, 5, 'Sofa exterior', 10, 'sofa6.jpg'),
(84, 'Sofa azul de tres plazas con arcon', '50', 0, 5, 'Sofa con arcon', 3, 'sofa7.jpg'),
(85, 'Lampara de lava clasica de metal', '45', 0, 7, 'Lampara de lava', 5, 'lampara5.jpg'),
(86, 'Lampara de techo retro vintage negra', '50', 0, 7, 'Lampara de techo', 6, 'lampara6.jpg'),
(87, 'Lampara de techo led de metal', '70', 0, 7, 'Lampara de techo led', 18, 'lampara7.jpg');

-- --------------------------------------------------------

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `idTransaccion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`idTransaccion`, `idProducto`, `idComprador`, `fecha`) VALUES
(1, 2, 8, '2020-04-23'),
(2, 1, 3, '2020-04-25'),
(3, 21, 14, '2020-04-27'),
(4, 4, 20, '2020-04-30'),
(5, 12, 10, '2020-05-03'),
(6, 7, 19, '2020-05-04'),
(7, 54, 6, '2020-05-04'),
(8, 63, 5, '2020-05-05'),
(9, 51, 12, '2020-05-06'),
(10, 24, 15, '2020-05-09'),
(11, 16, 9, '2020-05-10');


-- --------------------------------------------------------

