/*
Creates a table that stores information about users. 
Also, user_level must be changed to "1" directly in database to access admin page and functions.
*/
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
  usersGender varchar(5) NOT NULL,
  usersPwd varchar(128) NOT NULL,
  user_level int(11) DEFAULT '0',
  userInterests varchar(120),
  userContigent int(1) DEFAULT '0'
);

/* 
Creates a table that stores activities.
*/
CREATE TABLE activity (
  activityId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  activityDesc varchar(200) NOT NULL,
  activityDate date NOT NULL,
  activityOrganizer varchar(120) NOT NULL,
  activityStarttime time NOT NULL,
  activityEndtime time NOT NULL,
  activityPlace varchar(120) NOT NULL
);

/*
Creates a many-to-many connection between the users and activity tables.
One user can participate in many activities, and one activity can have many users.
*/
CREATE TABLE booking (
  booking_activityId int(11) NOT NULL,
  booking_userId int(11) NOT NULL,
  CONSTRAINT FK_activity_id FOREIGN KEY (booking_activityId) REFERENCES activity(activityId),
  CONSTRAINT FK_users_id3 FOREIGN KEY (booking_userId) REFERENCES users(usersId)
)