CREATE SCHEMA IF NOT EXISTS `crowdsourcing` DEFAULT CHARACTER SET utf8 ;
USE `crowdsourcing` ;

DROP TABLE IF EXISTS `crowdsourcing`.`users` ;
CREATE TABLE IF NOT EXISTS `crowd`.`users` (
  `userid` VARCHAR(255) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `type` TINYINT(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userid`),
  UNIQUE INDEX `userid_UNIQUE` (`userid` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
