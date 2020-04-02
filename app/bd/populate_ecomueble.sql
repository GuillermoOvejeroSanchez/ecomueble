ALTER TABLE usuario AUTO_INCREMENT = 1;
INSERT INTO `usuario` (`idUsuario`, `nombre`, `email`, `telefono`, `password`, `tipoUsuario`, `saldo`, `imagen`) VALUES
(1, 'wilson', 'guilleov@ucm.es', 684216696, '$2y$10$h681e.VAdpki37HrDiRlF.lG5v9W420s1QAfFxcWjLVjNgleAVqUa', 0, 510, 'wilson.png'),
(2, 'prueba', 'prueba@prueba.com', 657845213, '$2y$10$A36aJIWPRxz7oEkhZoKzveiYxtmPKqu4eczI/sn8qJYDX3.tfszH6', 0, 40, 'default_profile.jpg'),
(3, 'Noelia', 'noe@ucm.es', 0, '$2y$10$MzKMcG6p7VemzllPi.q1.eYxO5icpXpyBK88OLao0tftcxNNA3DPu', 0, 50, 'default_profile.jpg');

ALTER TABLE producto AUTO_INCREMENT = 1;
INSERT INTO `producto` (`idProducto`, `descripcion`, `precio`, `idEstado`, `idCategoria`, `nombre`, `idUsuario`, `imagen`) VALUES
(1, 'Una silla del AC', '50', 0, 1, 'Silla Froggy', 1, 'Silla Froggy.jpg'),
(2, 'prueba', '10', 0, 1, 'prueba', 1, 'default_profile.jpg'),
(3, 'prueba compra', '10', 1, 3, 'comprado', 1, 'default_profile.jpg');

ALTER TABLE producto AUTO_INCREMENT = 1;
INSERT INTO `transacciones` (`idTransaccion`, `idProducto`, `idComprador`, `fecha`) VALUES
(1, 3, 2, '2020-04-02');
