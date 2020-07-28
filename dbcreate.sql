create database compartilhando;

use compartilhando;

drop table if exists todos;

create table todos(
    id integer PRIMARY KEY AUTO_INCREMENT,
    descricao varchar(100),
    concluida tinyint
);
