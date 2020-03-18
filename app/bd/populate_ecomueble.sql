INSERT INTO categoria (tipo) 
VALUES
    ('silla'),
    ('armario'),
    ('mesa'),
    ('estanteria');

INSERT INTO estado(idEstado, estado)
VALUES
    (0,'en venta'),
    (1,'vendido'),
    (2,'reservado');


INSERT INTO `usuario` (`nombre`, `email`, `telefono`, `password`, `tipoUsuario`, `saldo`, `imagen`) 
VALUES ('wilson', 'willwarcry99@gmail.com', '684216696', '$2y$10$h681e.VAdpki37HrDiRlF.lG5v9W420s1QAfFxcWjLVjNgleAVqUa', '0', '50', 'wilson.png');

INSERT INTO `producto` (`descripcion`, `precio`, `idEstado`, `idCategoria`, `nombre`, `idUsuario`, `imagen`) 
VALUES ('Una silla del AC', '50', '0', '1', 'Silla Froggy', '1', 'Silla Froggy.jpg');
