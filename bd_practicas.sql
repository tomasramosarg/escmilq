



create table materia(
 id int auto_increment primary key,
 profesores varchar(50), 
 nombre varchar(15),
 curso varchar (10)
);

create table contenido(
id int auto_increment primary key,
programa_r varchar(100),
programa_L varchar(100),
id_materia int,
foreign key (id_materia) references materia(id)
);

create table profesores (
id int auto_increment primary key,
NyA varchar (50),
id_materia int,
foreign key (id_materia) references materia (id)
);


create table faltas (
id_profesor int ,
nom_materia varchar(20),
fecha date,
foreign key (id_profesor) references profesores (id)
);