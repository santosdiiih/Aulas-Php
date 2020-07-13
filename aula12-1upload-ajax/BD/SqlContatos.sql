#Criacao do Database Contatos
create database dbContatos20201A;

#Ativa o Database a ser Utilizado
use dbContatos20201A;

#cria a tabela de estados
create table tblEstados(
	idEstado int auto_increment not null primary key,
    sigla varchar(2) not null,
    nome varchar(100) not null
);

#Cria a Tabela de Contatos
create table tblContatos(
	idContato int auto_increment not null,
    nome varchar(100) not null,
	endereco varchar(150) not null,
    bairro varchar (50) not null,
    cep varchar (100) not null,
	idEstado int not null,
    telefone varchar (15) not null,
    celular varchar(16) not null,
    email varchar(50) not null,
    dtNascimento date not null ,
    sexo varchar (1) not null,
    obs text not null,
    primary key(idContato),
	constraint FK_estados_contatos foreign key (idEstado) references tblEstados(idEstado) 
);

#Lista as tabelas
show tables;

# Permite visualizar a estrutura da tabela
desc tblContatos;

# Informações cadastradas pelo usuario
select tblEstados.* from tblEstados;

# Inserindo dados na tabela 
insert into tblEstados (sigla, nome) values ('SP', 'São Paulo');

select tblEstados.sigla, tblEstados.nome from tblEstados;

insert into tblEstados (sigla, nome) values ('RJ', 'Rio de Janeiro');

select * from tblEstados;

# Para deletar dados 
delete from tblEstados where idEstado = 2;

# Para atualizar um registro na tabela
update tblEstados set nome = 'SÃO PAULO', sigla = 'SP' where idEstado = 1;

ALTER USER 'root'@'localhost'identified with mysql_native_password
BY'bcd127';

