#
# Table structure for table `ticket`
#

DROP TABLE IF EXISTS ticket;
CREATE TABLE ticket (
  Ticket_ID int(12) NOT NULL auto_increment,
  Email_Address varchar(125) NOT NULL default '',
  DrawDate date NOT NULL default '0000-00-00',
  Number_1 int(5) NOT NULL default '0',
  Number_2 int(5) NOT NULL default '0',
  Pick_1 int(5) NOT NULL default '0',
  Pick_2 int(5) NOT NULL default '0',
  Pick_3 int(5) NOT NULL default '0',
  Pick_4 int(5) NOT NULL default '0',
  Show_1 enum('Y','N') NOT NULL default 'N',
  Show_2 enum('Y','N') NOT NULL default 'N',
  Show_3 enum('Y','N') NOT NULL default 'N',
  Show_4 enum('Y','N') NOT NULL default 'N',
  Played enum('Y','N') NOT NULL default 'N',
  PRIMARY KEY  (Ticket_ID),
  KEY Email_Address (Email_Address),
  KEY DrawDate (DrawDate)
) TYPE=MyISAM;

#
# Dumping data for table `ticket`
#

#
# Table structure for table `users`
#

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  Users_ID int(3) NOT NULL auto_increment,
  Users_Name varchar(16) NOT NULL default '',
  Users_Password varchar(16) NOT NULL default '',
  Users_Access int(1) NOT NULL default '0',
  PRIMARY KEY  (Users_ID)
) TYPE=MyISAM;

#
# Dumping data for table `users`
#

INSERT INTO users (Users_ID, Users_Name, Users_Password, Users_Access) VALUES (1, 'admin', '1234', 2);

