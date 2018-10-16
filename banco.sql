create database teste_guilhermebertol;

use teste_guilhermebertol;

create table usuario(
	id_usuario int(11) not null auto_increment,
	email varchar(80) not null,
	senha varchar(80) not null,
	primary key(id_usuario)
);

insert into usuario(email, senha) values('@adm', '123');

create table estabelecimento(
	id_estabelecimento int(11) not null auto_increment,
	nome varchar(80) not null,
	endereco varchar(80) not null,
	cep varchar(80) not null,
	primary key(id_estabelecimento)
);