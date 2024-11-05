create database Longa_vida;

drop database Longa_vida

create table plano(
       plan_codigo int primary key auto_increment,
       numero varchar(2),
       descricao varchar(30),
       valor decimal(10,2)
);


create table associado(
       asso_codigo int primary key auto_increment,
       plano char(2),
       nome char(40),
       endereco char(35),
       cidade char(20),
       estado char(2),
       CEP char(9)
);

alter table associado 
add column plan_codigo int,
add constraint fk_plan_codigo foreign key (plan_codigo) references plano (plan_codigo);

