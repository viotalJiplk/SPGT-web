CREATE USER 'a215865_spgtweb'@'localhost' IDENTIFIED WITH mysql_native_password BY 'QhcnpmhJ';
CREATE DATABASE d215865_spgtweb;
GRANT ALL PRIVILEGES ON d215865_spgtweb.* TO 'a215865_spgtweb'@'localhost';
CREATE TABLE `d215865_spgtweb`.`stdlogin` ( `username` VARCHAR(30) NOT NULL , `password` VARCHAR(255) NOT NULL , PRIMARY KEY (`username`(30)));
CREATE TABLE `d215865_spgtweb`.`zapisy` ( `id` INT NOT NULL AUTO_INCREMENT , `time` DATE NOT NULL , `program` TEXT NOT NULL , `zapis` TEXT NOT NULL , `materialy` TEXT NULL , `hlasovani` INT NULL , PRIMARY KEY (`id`), KEY `time` (`time`));