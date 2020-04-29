
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `email`, `telefono`, `password`, `tipoUsuario`, `saldo`, `imagen`) VALUES
(1, 'Sara P', 'saraperez@gmail.com', 612654687, '$2y$10$DDQBORmx7lzkGnvdVUXYfuWV7sXxHdMQOUiIF.c5pHqnnptc8ssX2', 0, 50, 'Sara P.jpg'),
(2, 'Carlos12', 'carsanper@hotmail.es', 658459632, '$2y$10$wOkGu7zqU24qAEapKEAANefv15T1z0gMEKmIY66vFjFJv99POBm66', 0, 50, 'Carlos12.jpg'),
(3, 'Patripat', 'plopez97@gmail.com', 622588947, '$2y$10$eqq0JRhNlC6.BJqEYnS5eOfDpowfQjp1VfoOIs/VlhLxzWgLKvqjq', 0, 50, 'Patripat.jpg'),
(4, 'Amueblador', 'amueblador_27@gmail.com', 644589325, '$2y$10$3SHlmZ7Z8Rt.b3Z5GWmn7OUkmMkwTb2lifk/IS6Gntk.Fz1.KLCc2', 0, 50, 'Amueblador.JPG'),
(5, 'elee.03', 'elenagonzalez@yahoo.es', 687523149, '$2y$10$QxZonX/ZxaPxv1.nY9GAHO6gJdO9DW5Co8iv2yatuD6RKgnVD1RQi', 0, 50, 'elee.03.jpg'),
(6, '.Ana.', 'a.lopsan@gmail.com', 685214789, '$2y$10$rzQEhneSA1OCxX5/mtVGEu0rLYcxUGoS2GvdxB4AquXy/AKgCMYjq', 0, 50, '.Ana..jpg'),
(7, 'JoseSanz', 'jsanz547@yahoo.es', 614365896, '$2y$10$H/oD4t1.qWxN/mXbgapn0.hvqRuTjonsCjXVRDZwkeZQ8XEPnPj2y', 0, 50, 'JoseSanz.JPG'),
(8, 'ZamoranoMartin', 'l.zammart@hotmail.com', 648752369, '$2y$10$Gck6CWJGivuavrrTK4dP1.VPi3wkMrNkns2ua4LNlWjOsVLJQTxIK', 0, 50, 'ZamoranoMartin.jpg'),
(9, 'm.sanchez', 'm.sanchez@msn.com', 648752396, '$2y$10$4aS5fwMycvzKe4Os9sdzze1kAlyOc2mX.OGeVTA1ktUoEqawa.Use', 0, 50, 'm.sanchez.jpg'),
(10, 'armariodeschrodinger', 'armariodeschrodinger@gmail.com', 632658941, '$2y$10$GwMV45Mac9lquoDLfAR/XeDa4rTovBGRJhQdY58.AmlJyGu1JtAzu', 0, 50, 'armariodeschrodinger.JPG'),
(11, 'Yass', 'yas.badalyan@gmail.com', 698745210, '$2y$10$54s1XAXTBbWJesi8nyZlbuGmRer8tEvYs4sJikkieqU1Y9VquZMZW', 0, 50, 'Yass.JPG'),
(12, 'Fran.53', 'franciscomenendez@hotmail.com', 674123658, '$2y$10$7TArxHqTNcCiA8T/M533.uDoajzIy20500PHZG9I9kVWdP3.7L31q', 0, 50, 'Fran.53.jpg'),
(13, 'maaryhelen', 'el.dominguez@gmail.com', 612584369, '$2y$10$GPF1JQqCDH8Appe98A3gwOfH9aTy0hDmqZGE/gwmBfk7a1Ap1C9lG', 0, 50, 'maaryhelen.jpg'),
(14, 'd_sanlo', 'd_sanlo@hotmail.com', 602584130, '$2y$10$Uz8uK34E1xdSas/aoFkRlOEeGQ1m02GaohK4ZpzutdgSkp4fQA4/.', 0, 50, 'd_sanlo.jpg'),
(15, 'begooooooo', 'begolopmart@msn.com', 667859632, '$2y$10$MrXMkOs05wL7TVgpWnhhzO0pvDg/hEok9Yj2ZII5BXzPHLzbUCJgO', 0, 50, 'begooooooo.jpg'),
(16, 'lamesadepablo', 'pablodiaz5396@gmail.com', 600214589, '$2y$10$Q97XYj95g3YKogIHpWzB3elJNkMTdCB.e0y4e3M5Izeao72LrLCum', 0, 50, 'lamesadepablo.jpg'),
(17, 'monillo_loco', 'm.ruizcardiel@hotmail.com', 630258965, '$2y$10$.hNWj1MALfWdfAlo3zV6OerMGOH5033EqnHdbsCWyEoPMggS9TKAi', 0, 50, 'monillo_loco.JPG'),
(18, 'j.vazquez', 'j.vazquez@gmail.com', 645201369, '$2y$10$QP04FYvu5ECzqHlpGL9uL.nIELteynfhyVGQg89lm4pBspy1zDfga', 0, 50, 'j.vazquez.jpg'),
(19, 'Natalia_94', 'nat_rodriguez_94@gmail.com', 658902313, '$2y$10$saKsWHL/uLBQbdAS5geMV.ddK2kDsllvzmQE56bHnxjXCP0EhyhJS', 0, 50, 'Natalia_94.jpg');

-- --------------------------------------------------------

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `descripcion`, `precio`, `idEstado`, `idCategoria`, `nombre`, `idUsuario`, `imagen`) VALUES
(1, 'Vitrina de madera con puertas de cristal', '30', 0, 4, 'Vitrina blanca', 11, 'Vitrina blanca.jpg'),
(2, 'Mesa baja rústica hecha con un barril', '25', 0, 3, 'Mesa barril', 12, 'Mesa barril.jpg'),
(3, 'Tres sillas altas para barra', '45', 0, 1, 'Juego de sillas', 19, 'Juego de sillas.jpg'),
(4, 'Estantería grande de madera y metal', '40', 0, 4, 'Estantería de pared', 3, 'Estantería de pared.jpg'),
(5, 'Mesa de comedor para 8 personas', '40', 0, 3, 'Mesa redonda', 4, 'Mesa redonda.jpg'),
(6, 'Armario de madera con puertas de cristal', '45', 0, 2, 'Armario aparador', 4, 'Armario aparador.jpg'),
(7, 'Con este armario Schrodinger lo habría tenido claro', '35', 0, 2, 'Armario de madera', 10, 'Armario de madera y mimbre.jpg'),
(8, 'Estantería grande con hueco para televisión (240x40x202cm)', '100', 0, 4, 'Estantería para saló', 14, 'Estantería para salón.jpg'),
(9, 'Silla verde tapizada con estructura metáica', '15', 0, 1, 'Silla verde', 13, 'Silla verde.jpg'),
(10, 'Mesa y banco de madera y acero', '60', 0, 3, 'Mesa con banco', 8, 'Mesa con banco.jpg'),
(11, 'Mesa cuadrada de madera, las sillas no están incluidas', '30', 0, 3, 'Mesa con cuatro patas', 9, 'Mesa con cuatro patas.jpg'),
(12, 'Estantería de madera con tres baldas y dos cajones', '35', 0, 4, 'Estantería blanca', 1, 'Estantería blanca.jpg'),
(13, 'Estantería de madera con baldas de altura regulable', '40', 0, 4, 'Estantería alta', 5, 'Estantería alta.jpg'),
(14, 'Armario con tres cajones y puerta de madera', '35', 0, 2, 'Armario bajo', 5, 'Armario bajo.jpg'),
(15, 'Armario para pasillo con cuatro cajones grandes', '25', 0, 2, 'Armario estrecho', 6, 'Armario estrecho.jpg'),
(16, 'Mesa de centro con tablero regulable', '30', 0, 3, 'Mesa baja', 16, 'Mesa baja.jpg'),
(17, 'Estantería alta con 5 baldas y acabado de madera natural', '15', 0, 4, 'Escalera con estantes', 18, 'Escalera con estantes.jpg'),
(18, 'Estantería grande con cinco baldas, cuatro cajones y dos puertas.', '65', 0, 4, 'Estantería grande', 15, 'Estantería grande.jpg');

-- --------------------------------------------------------

