CREATE USER 'a215865_spgtweb'@'localhost' IDENTIFIED WITH mysql_native_password BY 'QhcnpmhJ';
CREATE DATABASE d215865_spgtweb;
GRANT ALL PRIVILEGES ON d215865_spgtweb.* TO 'a215865_spgtweb'@'localhost';
CREATE TABLE `d215865_spgtweb`.`stdlogin` ( `username` VARCHAR(30) NOT NULL , `password` TINYTEXT NOT NULL , PRIMARY KEY (`username`(30)));