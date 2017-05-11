drop database if exists barwang;

create database barwang;

use barwang;

CREATE TABLE socio(Cod_soci int(11) NOT NULL  PRIMARY KEY, Nom VARCHAR(30),apellidos varchar(40), ciudad varchar(40),cuenta (), telefono int, correo());
CREATE TABLE cliente(Codigo int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, Nom VARCHAR(30),apellidos varchar(40),password (), ciudad varchar(40), correo (), socio boolean);
CREATE TABLE compra(IDcompra int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, fecha date, cliente int(11), articulo int(11), talla (),cantidad int(4),forma_pago varchar(20),precio_total double(5,2));
CREATE TABLE articulo(IDART int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, Nom varchar(20), descripcion VARCHAR(45),  precio double(5,2), stock_s int(4), stock_m int(4), stock_l int(4),);



CREATE TABLE suma_pedido(IDped_total int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, IDART int(11), fecha date, cliente int(11), articulo int(11), ());


ALTER TABLE compra ADD FOREIGN KEY (cliente) REFERENCES cliente(Codigo) ON DELETE CASCADE on update cascade;
ALTER TABLE compra ADD FOREIGN KEY (articulo) REFERENCES articulo(IDART) ON DELETE CASCADE on update cascade;
ALTER TABLE compra ADD FOREIGN KEY (IDcompra) REFERENCES compra(IDcompra) ON DELETE CASCADE on update cascade;


insert into articulo values ('camiseta','',30.00, 20,20,20), ('pantalon','', 40.00, 20,20,20),('botas','',60.00, 10,10,10),
( 'pelota','',50.00, 20,20,20), ('guantes','',25.00, 20,20,20),('chandal', '',100.00, 20,20,20),('chandal', '',100.00, 20,20,20),('socio','', 100.00, 20,20,20);


delimiter //

CREATE TRIGGER azte_socio AFTER INSERT ON cliente
FOR EACH ROW
BEGIN
IF not exists (select Cod_soci from socio where Cod_soci=(select codigo from cliente where codigo=NEW.codigo)
if (NEW.socio=1)
call hazte_socio();
else
then
signal sqlstate‘12345’ set message_text= ‘puedes hacerte socio’;
end if;
end if;
END
//
delimiter ;


delimiter //
CREATE  PROCEDURE hazte_socio (in xcuenta int(11), in xtelefono int(),out codigo int(11))
BEGIN 
select * from cliente where codigo=NEW.codigo  then
INSERT INTO socio (Nom,apellidos,ciudad,cuenta,telefono,correo) select Nom,apellidos,ciudad,correo from cliente;
INSERT INTO socio (Nom,apellidos,ciudad,cuenta,telefono,correo) values (NEW.Nom,NEW.apellidos,NEW.ciudad,NEW.cuenta,NEW.telefono,NEW.correo);
END
//
delimiter ;


delimiter //

CREATE TRIGGER descuento BEFORE INSERT ON compra
FOR EACH ROW
BEGIN
$soci= SELECT socio from cliente where Codigo=(select NEW.cliente from compra);
if (soci=1)
update compra set precio_total=(precio_total*0.9) where IDcompra=New.IDcompra;
else
then
signal sqlstate‘12345’ set message_text= ‘no hay descuento’;
end if;
END
//
delimiter ;

delimiter //
CREATE  PROCEDURE socio (in xNom varchar (30), in xapellidos varchar(40), in xciudad varchar(40), in xcuenta int(11), in xtelefono int(),in xcorreo int(11), in xpassword ())
BEGIN 
DECLARE soci boolean
set soci=1
INSERT INTO socio (Nom,apellidos,ciudad,cuenta,telefono,correo) values (NEW.Nom,NEW.apellidos,NEW.ciudad,NEW.cuenta,NEW.telefono,NEW.correo);
INSERT INTO cliente(Nom,apellidos,password,ciudad,correo,socio)  values (NEW.Nom,NEW.apellidos,xpassword,NEW.ciudad,NEW.cuenta,xcorreo,NEW.correo,soci);         select Nom,apellidos,ciudad,correo from cliente;
END
//
delimiter ;



/*


delimiter //
DROP PROCEDURE IF EXISTS dades_departament2//
CREATE PROCEDURE dades_departament2 (IN departament VARCHAR(25))
BEGIN
SELECT AVG(Sou) AS "Promig dels sous", MAX(sou) AS "Sou maxim" FROM EMPLEAT WHERE Num_dpt =
(SELECT Num_dpt FROM DEPARTAMENT WHERE Nom = departament);
END
//
delimiter ;




delimiter //
DROP PROCEDURE IF EXISTS inserir_venta;
CREATE  PROCEDURE inserir_venta (in code int(11), in codigo int(11), in fecha datetime, in cantidad int(11), out preu_total double(5,2))
BEGIN

DECLARE preu_total DOUBLE;

SELECT precio INTO preu_total FROM libro;
preu_total= precio*cantidad;

INSERT INTO venta ( code, codigo, fecha, cantidad, precio_venta) VALUES (NEW.code, NEW.codigo, NOW(), NEW.cantidad, NEW.preu_total);

UPDATE libro
SET stock=stock-cantidad WHERE Num_code=code ;

END
//
delimiter ;

delimiter //

CREATE TRIGGER falta_stock BEGIN INSERT ON venta
FOR EACH ROW
BEGIN
select stock from libro WHERE Code=xcode;
if stock<cantidad then
signal sqlstate‘12345’ set message_text= ‘no tenemos tantos en stock’;
end if;
END
//
delimiter ;














CREATE PROCEDURE miProc (IN nomciudad char(45))
BEGIN
	SELECT * FROM equipo WHERE ciudad= nomciudad;
END
//
delimiter ;

call miProc("Barcelona");


show procedure status like 'miProc';
drop procedure if exists miProc;

Trigger : per a inserir

CREATE TRIGGER Inserta_auditoria_clientes AFTER INSERT ON clientes
FOR EACH ROW
INSERT INTO auditoria_clientes(nombre_nuevo, seccion_nueva, usuario, modificado, proceso, Id_Cliente)
VALUES (NEW.nombre, NEW.seccion, CURRENT_USER(), NOW(), NEW.Accion, NEW.id_cliente );

INSERT INTO clientes (nombre, seccion) 
VALUES('Xavier','Informatica'),
('Pepe','Papeleria');

/* Trigger: per a modificar 
CREATE TRIGGER  Modifica_auditoria_clientes BEFORE UPDATE ON clientes
FOR EACH ROW
INSERT INTO auditoria_clientes(nombre_anterior, seccion_anterior, nombre_nuevo, seccion_nueva, usuario, modificado, Id_Cliente)
VALUES (OLD.nombre, OLD.seccion, NEW.nombre, NEW.seccion, CURRENT_USER(), NOW(), NEW.id_cliente);

UPDATE clientes
SET nombre='Francisco' WHERE nombre='Xavier';

/* Trigger : per a eliminar 

CREATE TRIGGER Elimina_auditoria_clientes AFTER DELETE ON clientes
FOR EACH ROW
INSERT INTO auditoria_clientes(nombre_anterior, seccion_anterior, usuario, modificado, Id_Cliente)
VALUES (OLD.nombre, OLD.seccion, CURRENT_USER(), NOW(), OLD.id_cliente);

DELETE FROM clientes where nombre='Francisco';





 insert into lugar values ('Sala Profesors'), ('Aula25');
 
 insert into lugar values ('Aula25');
 insert into armament values ('clot 1911','','' , , 03);
 
 1-
 grant usage on *.* to cnorris@localhost identified by '1234',
 sseagal@localhost identified by '1234',
 fcastle@localhost identified by ´1234´, sprilgrim@localhost identified by '1234';
 
 2-
 grant select on enemics.* to cnorris@localhost, sseagal@localhost;
 
 
 3-
 grant update, insert, select on enemics.* to cnorris@localhost, sseagal@localhost;
 
 4-
 grant update, insert, select on recursos.* to fcastle@localhost;
 grant update, insert, select on supervivent.* to sprilgrim@localhost;
 
 5-
 
 show columns from user;
 
 show grants for cnorris@localhost;
 
 
 6-
 insert into lugar values ('C/Pelai');
 
 insert into lugar values ('');
 

 insert into debilidad values ('Sotam Stucom');
 
 
 insert into zombi values ('Zombi comú','Zombi comú, els mou una insaciable fam de carn humana.', , , );
 
 7-
 
 insert into lugar values ('Sala Profesors');
 insert into lugar values ('Aula25');
 
 insert into armament values ('clot 1911','','' , , );
 
 8-
 
 insert into comandant values ('Chuck Norris');
 insert into escuadro values ('Charlies',30 , );
 

 9-
 select a.nom, l.lugar from armament a, lugar l where REGEXP "M" and a.lugar=l.IDL;
 
 
 10-
 (Frank)
 select count(IDL),IDL,Nom from lugar where IDL in select Max(count(IDL))from armament where (select count(IDL) from armament group by IDL )
 
 11-
 (scott)
 select c.nom,e.count(*) group by NomE from c.comandant, e.escuadro order by num_soldados; 
 select nom,
 
  
 12-
 (Chuck)
 select Nomz, descripcio, from zombi where debilidad in=(select debilidad from zombi where debilidad=(select IDD from debilidad where vista='Foc'));
 
 13-
 Reboke all on *.* from cnorris@localhost;
 
 grant select on enemics.* to cnorris@localhost;
 
 14-
 show grants for cnorris@localhost;

 
 15-
 grant option on recursos.* to fcastle@localhost;
 grant option on supervivent.* to sprilgrim@localhost;
 
 16-
 (Frank&Scott)
 
 grant select on recursos.* to sseagal@localhost;
 
 
 sseagal
 use recursos; 
 select * from armament;
 
 
 
 17-
 
 show grants for sprilgrim@localhost;
 Reboke all on *.* from sprilgrim@localhost;
 Drop user sprilgrim@localhost;
 
 
 18-
 grant usage on *.* to jconnor@localhost identified by '1234';
 grant select on supervivent.* to jconnor@localhost;
 grant option on supervivent.* to jconnor@localhost;
 
 19-
 Reboke all on *.* from cnorris@localhost,sseagal@localhost,jconnor@localhost,fcastle@localhost;
 drop user fcastle@localhost,cnorris@localhost,sseagal@localhost,jconnor@localhost;
 drop databases if exists recursos;
 