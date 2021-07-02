create database fastParking;

use fastParking;

create table tblCarros(
	idCarros int not  null auto_increment primary key,
    idPrecos int not null,
    nome varchar(30) not null,
    placa varchar(10),
    dataEntrada date,
    horaEntrada time,

	constraint FK_precos_carros
    foreign key (idPrecos)
    references tblPrecos(idPrecos)
);

insert into tblCarros (idPrecos ,nome, placa, dataEntrada, horaEntrada) 
	values (1,'Emerson', 'ABC-1234', '2021-07-02', '09:35:00');
    
    select * from tblCarros;
    
create table tblPrecos(
	idPrecos int not  null auto_increment primary key,
    primeiraHora decimal,
    demaisHoras decimal
);

insert into tblPrecos (primeiraHora, demaisHoras)
	values ('5.00', '2.00');
    
     select * from tblPrecos;