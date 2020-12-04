CREATE TABLE users (
  usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  usersFirstname varchar(128) NOT NULL,
  usersLastname varchar(128) NOT NULL,
  usersAddress varchar(128) NOT NULL,
  usersPostno int(4) NOT NULL,
  usersPostplace varchar(128) NOT NULL,
  usersPhone int(10) NOT NULL,
  usersRegdate date NOT NULL,
  usersEmail varchar(128) NOT NULL,
  usersUid varchar(128) NOT NULL,
  usersDob date NOT NULL,
  usersKjonn varchar(5) NOT NULL,
  usersPwd varchar(128) NOT NULL,
  user_level int(11) DEFAULT '0'
);
