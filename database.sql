create database MyNotes;
CREATE TABLE `mynotes`.`users` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` TEXT NOT NULL , `name` VARCHAR(255) NOT NULL , `mobNo` BIGINT(10) NOT NULL , `email` VARCHAR(255) NOT NULL , `country` TEXT NOT NULL , `dob` DATE NOT NULL , `password` VARCHAR(255) NOT NULL , `dt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;
CREATE TABLE `mynotes`.`notes` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `tittle` VARCHAR(255) NOT NULL , `description` VARCHAR(255) NOT NULL , `username` VARCHAR(225) NOT NULL , `dt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB;





























