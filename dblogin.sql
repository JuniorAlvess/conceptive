use id8060145_conceptive;
default character set utf8 
default collate utf8_general_ci;
drop table if exists cptv_users;
create table cptv_users(
	uid int not null primary key auto_increment,
	user varchar(20) not null,
	nome varchar(40) not null,
	email varchar(40) not null,
	senha varchar(255) not null
);

drop table if exists cptv_anotacoes;
create table cptv_anotacoes(
	id int(4) primary key not null auto_increment,
	data_criacao date not null,
	user varchar(20) not null,
	titulo varchar(255) not null,
	anotacao text(10000) not null,
	data_finalizacao datetime
);

--RELEASE 1.2
alter table cptv_users add lvl int(1);
update cptv_users set lvl = 1 where lvl is null;
update cptv_users set lvl = 3 where user like 'rodcordeiro';

create table cptv_task(
	cod int(10) not null primary key auto_increment,
	titulo varchar(255) not null,
	prioridade int(1) not null,
	status varchar(10)
);

--release 1.3
alter table cptv_task add projeto varchar(20) not null;
alter table cptv_anotacoes add projeto varchar(20) not null;
update cptv_anotacoes set projeto = 'conceptive';
update cptv_task set projeto = 'conceptive';

drop table if exists cptv_acessos;
create table cptv_acessos(
uid int(3) not null primary key auto_increment,
user varchar(20),
acessos varchar(100)
);
insert into cptv_acessos(user,acessos) values('rodcordeiro','FanaticSports');
insert into cptv_acessos(user,acessos) values('rodcordeiro','devblog');
insert into cptv_acessos(user,acessos) values('rodcordeiro','conceptive');
insert into cptv_acessos(user,acessos) values('Junior','FanaticSports');
insert into cptv_acessos(user,acessos) values('teste','conceptive');
insert into cptv_acessos(user,acessos) values('Junior','devblog');
insert into cptv_acessos(user,acessos) values('Junior','conceptive');
insert into cptv_acessos(user,acessos) values('ChapaaQuente','FanaticSports');
insert into cptv_acessos(user,acessos) values('ChapaaQuente','conceptive');	

--release 1.4--
drop table if exists cptv_projetos;
create table cptv_projetos(
id int(3) not null primary key auto_increment,
projeto varchar(20),
status varchar(10),
data_criacao date not null,
data_encerramento date
);
insert into cptv_projetos(projeto, status,data_criacao) values
	('conceptive','aberto', current_date()),
	('FanaticSports','aberto', current_date()),
	('DevBlog','aberto', current_date());
