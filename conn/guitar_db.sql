drop database if exists guitarist_db;

CREATE DATABASE guitarist_db
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_general_ci;
    
use guitarist_db;

CREATE TABLE user(
	id INT PRIMARY KEY auto_increment,
	username VARCHAR(45) NOT NULL,
  passwrd VARCHAR(90) NOT NULL,
  genre VARCHAR(45) NOT NULL,
  admn BIT NOT NULL,
  skin INT
);

insert into user (username, passwrd,genre, admn, skin) values ('admin', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72','funk', 1, 0);
insert into user (username, passwrd,genre, admn, skin) values ('kisJozsó', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72','metal', 0, 0);
insert into user (username, passwrd,genre, admn, skin) values ('nagyFecó', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72','jazz', 0, 0);

CREATE TABLE types(
	id INT PRIMARY KEY auto_increment,
	name varchar(45) NOT NULL
);

insert into types(name) values('Fender Stratocaster');
insert into types(name) values('Jackson Dinky');
insert into types(name) values('Gibson Les Paul');

CREATE TABLE guitar(
	id INT PRIMARY KEY auto_increment,
	types_id INT NOT NULL,
  strings VARCHAR(45) NULL,
  girth FLOAT NULL,
  tuning VARCHAR(45) NULL,
  user_id INT NOT NULL,

  FOREIGN KEY (types_id) references types(id),
  FOREIGN KEY (user_id) references user(id)
);

insert into guitar(types_id,strings,girth,tuning,user_id) values('1','Elixir','9','E Standard',2);

