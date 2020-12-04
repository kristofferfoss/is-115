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
  info_id int(11),
  CONSTRAINT info_id FOREIGN KEY (info_id) REFERENCES userInfo(infoId)
);

CREATE TABLE userInfo (
  infoId int(11) PRIMARY KEY NOT NULL,
  infoInterests varchar(120) NOT NULL,
  infoActivity varchar(120) NOT NULL,
  infoStatus int(1) NOT NULL,
  info_usersId int NOT NULL,
  CONSTRAINT FK_users_id FOREIGN KEY (info_usersId) REFERENCES users(usersId)
);

CREATE TABLE rolls (
  rollId int(11) PRIMARY KEY NOT NULL,
  rollDescription varchar(200) NOT NULL,
  rolls_usersId int NOT NULL,
  CONSTRAINT FK_users_id2 FOREIGN KEY (rolls_usersId) REFERENCES users(usersId)
)