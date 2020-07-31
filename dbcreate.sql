create database compartilhando;

use compartilhando;

drop table if exists todos;

create table todos(
    id integer PRIMARY KEY AUTO_INCREMENT,
    descricao varchar(100),
    concluida tinyint default 0
);

INSERT INTO todos(descricao, concluida) VALUES('Limpar a casa', 0);
INSERT INTO todos(descricao, concluida) VALUES('Estudar C++', 0);
INSERT INTO todos(descricao, concluida) VALUES('Estudar Javascript', 0);