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
  user_level int(11) DEFAULT '0',
  userInterests varchar(120),
  userActivity varchar(120),
  userKontigent int(1) DEFAULT '0',
);

CREATE TABLE rolls (
  rollId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  rollDescription varchar(200) NOT NULL,
  rolls_usersId int NOT NULL,
  CONSTRAINT FK_users_id2 FOREIGN KEY (rolls_usersId) REFERENCES users(usersId)
);

CREATE TABLE activity (
  activityId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  activityDesc varchar(200) NOT NULL,
  activityDate date NOT NULL,
  activityAnsvarlig varchar(120) NOT NULL,
  activityStarttid time NOT NULL,
  activitySlutttid time NOT NULL,
  activitySted varchar(120) NOT NULL
);

CREATE TABLE booking (
  booking_activityId int(11) NOT NULL,
  booking_userId int(11) NOT NULL,
  CONSTRAINT FK_activity_id FOREIGN KEY (booking_activityId) REFERENCES activity(activityId),
  CONSTRAINT FK_users_id3 FOREIGN KEY (booking_userId) REFERENCES users(usersId)
);