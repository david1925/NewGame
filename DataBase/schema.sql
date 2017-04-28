-- MySQL Script generated by MySQL Workbench
-- vie 28 abr 2017 13:53:35 CEST
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema newgame
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema newgame
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `newgame` DEFAULT CHARACTER SET utf8 ;
USE `newgame` ;

-- -----------------------------------------------------
-- Table `newgame`.`Countries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Countries` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Countries` (
  `countries_id_country` INT NOT NULL AUTO_INCREMENT,
  `countries_code` VARCHAR(2) NOT NULL,
  `countries_name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`countries_id_country`),
  UNIQUE INDEX `countries_name_UNIQUE` (`countries_name` ASC),
  UNIQUE INDEX `countries_code_UNIQUE` (`countries_code` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Countries';


-- -----------------------------------------------------
-- Table `newgame`.`Provinces`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Provinces` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Provinces` (
  `provinces_id_province` INT NOT NULL,
  `provinces_province` VARCHAR(100) NULL,
  `Countries_countries_id_country` INT NOT NULL,
  PRIMARY KEY (`provinces_id_province`, `Countries_countries_id_country`),
  UNIQUE INDEX `provinces_id_province_UNIQUE` (`provinces_id_province` ASC),
  UNIQUE INDEX `provinces_province_UNIQUE` (`provinces_province` ASC),
  INDEX `fk_Provinces_Countries1_idx` (`Countries_countries_id_country` ASC),
  CONSTRAINT `fk_Provinces_Countries1`
    FOREIGN KEY (`Countries_countries_id_country`)
    REFERENCES `newgame`.`Countries` (`countries_id_country`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Provinces table';


-- -----------------------------------------------------
-- Table `newgame`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Users` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Users` (
  `users_id_user` INT NOT NULL AUTO_INCREMENT,
  `users_username` VARCHAR(45) NOT NULL,
  `users_password` VARCHAR(45) NOT NULL,
  `users_name` VARCHAR(60) NOT NULL,
  `users_firstname` VARCHAR(60) NULL,
  `users_lastname` VARCHAR(45) NULL,
  `users_email` VARCHAR(60) NOT NULL,
  `users_phone` VARCHAR(45) NULL,
  `users_image` VARCHAR(200) NULL,
  `users_summary` VARCHAR(300) NULL,
  `users_address` VARCHAR(300) NULL,
  `users_public_profile` INT NOT NULL,
  `Provinces_provinces_id_province` INT NULL,
  `users_status` VARCHAR(45) NOT NULL,
  `users_language` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`users_id_user`),
  UNIQUE INDEX `usuarios_nombre_usuario_UNIQUE` (`users_username` ASC),
  UNIQUE INDEX `users_email_UNIQUE` (`users_email` ASC),
  UNIQUE INDEX `users_phone_UNIQUE` (`users_phone` ASC),
  INDEX `fk_Users_Provinces1_idx` (`Provinces_provinces_id_province` ASC),
  CONSTRAINT `fk_Users_Provinces1`
    FOREIGN KEY (`Provinces_provinces_id_province`)
    REFERENCES `newgame`.`Provinces` (`provinces_id_province`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Users table';


-- -----------------------------------------------------
-- Table `newgame`.`Genders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Genders` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Genders` (
  `genders_id_gender` INT NOT NULL AUTO_INCREMENT,
  `genders_name` VARCHAR(60) NOT NULL,
  PRIMARY KEY (`genders_id_gender`),
  UNIQUE INDEX `genders_name_UNIQUE` (`genders_name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Genders table';


-- -----------------------------------------------------
-- Table `newgame`.`Games`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Games` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Games` (
  `games_id_game` INT NOT NULL AUTO_INCREMENT,
  `games_name` VARCHAR(200) NOT NULL,
  `games_description` VARCHAR(500) NOT NULL,
  `games_price` DOUBLE NOT NULL,
  `games_publication_date` DATE NOT NULL,
  `games_url_image` VARCHAR(300) NOT NULL,
  `games_rating` FLOAT NULL,
  `Genders_genders_id_gender` INT NOT NULL,
  PRIMARY KEY (`games_id_game`, `Genders_genders_id_gender`),
  UNIQUE INDEX `games_name_UNIQUE` (`games_name` ASC),
  INDEX `fk_Games_Genders1_idx` (`Genders_genders_id_gender` ASC),
  UNIQUE INDEX `games_url_image_UNIQUE` (`games_url_image` ASC),
  CONSTRAINT `fk_Games_Genders1`
    FOREIGN KEY (`Genders_genders_id_gender`)
    REFERENCES `newgame`.`Genders` (`genders_id_gender`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Games table';


-- -----------------------------------------------------
-- Table `newgame`.`Bills`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Bills` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Bills` (
  `bills_id_bill` INT NOT NULL AUTO_INCREMENT,
  `bills_price` DOUBLE NOT NULL,
  `bills_date` DATE NOT NULL,
  `bills_payment` VARCHAR(45) NULL,
  `Users_users_id_user` INT NOT NULL,
  PRIMARY KEY (`bills_id_bill`, `Users_users_id_user`),
  INDEX `fk_Bills_Users1_idx` (`Users_users_id_user` ASC),
  CONSTRAINT `fk_Bills_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Bills table';


-- -----------------------------------------------------
-- Table `newgame`.`Bill_Details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Bill_Details` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Bill_Details` (
  `Bill_Details_counter` INT NOT NULL AUTO_INCREMENT,
  `Bills_bills_id_bill` INT NOT NULL,
  `Games_games_id_game` INT NOT NULL,
  `bill_details_quantity` INT NOT NULL,
  PRIMARY KEY (`Bill_Details_counter`, `Bills_bills_id_bill`, `Games_games_id_game`),
  INDEX `fk_Bill_Details_Bills1_idx` (`Bills_bills_id_bill` ASC),
  INDEX `fk_Bill_Details_Games1_idx` (`Games_games_id_game` ASC),
  CONSTRAINT `fk_Bill_Details_Bills1`
    FOREIGN KEY (`Bills_bills_id_bill`)
    REFERENCES `newgame`.`Bills` (`bills_id_bill`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Bill_Details_Games1`
    FOREIGN KEY (`Games_games_id_game`)
    REFERENCES `newgame`.`Games` (`games_id_game`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Bill_Details table';


-- -----------------------------------------------------
-- Table `newgame`.`Forums`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Forums` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Forums` (
  `forums_id_forum` INT NOT NULL AUTO_INCREMENT,
  `forums_title` VARCHAR(500) NOT NULL,
  `forums_created_date` DATETIME NOT NULL,
  `Games_games_id_game` INT NOT NULL,
  PRIMARY KEY (`forums_id_forum`, `Games_games_id_game`),
  INDEX `fk_Forums_Games1_idx` (`Games_games_id_game` ASC),
  CONSTRAINT `fk_Forums_Games1`
    FOREIGN KEY (`Games_games_id_game`)
    REFERENCES `newgame`.`Games` (`games_id_game`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Forums table';


-- -----------------------------------------------------
-- Table `newgame`.`Topics`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Topics` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Topics` (
  `topics_id_topic` INT NOT NULL AUTO_INCREMENT,
  `topics_title` VARCHAR(500) NOT NULL,
  `topics_text` VARCHAR(5000) NOT NULL,
  `topics_created_date` TIMESTAMP NOT NULL,
  `Forums_forums_id_forum` INT NOT NULL,
  `Users_users_id_user` INT NOT NULL,
  PRIMARY KEY (`topics_id_topic`, `Forums_forums_id_forum`, `Users_users_id_user`),
  INDEX `fk_Topics_Forums1_idx` (`Forums_forums_id_forum` ASC),
  INDEX `fk_Topics_Users1_idx` (`Users_users_id_user` ASC),
  CONSTRAINT `fk_Topics_Forums1`
    FOREIGN KEY (`Forums_forums_id_forum`)
    REFERENCES `newgame`.`Forums` (`forums_id_forum`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Topics_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Topics table';


-- -----------------------------------------------------
-- Table `newgame`.`Replies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Replies` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Replies` (
  `replies_id_replied` INT NOT NULL AUTO_INCREMENT,
  `replies_text` VARCHAR(10000) NOT NULL,
  `replies_created_date` TIMESTAMP NOT NULL,
  `Topics_topics_id_topic` INT NOT NULL,
  `Topics_Forums_forums_id_forum` INT NOT NULL,
  `Users_users_id_user` INT NOT NULL,
  PRIMARY KEY (`replies_id_replied`, `Topics_topics_id_topic`, `Topics_Forums_forums_id_forum`, `Users_users_id_user`),
  INDEX `fk_Replies_Topics1_idx` (`Topics_topics_id_topic` ASC, `Topics_Forums_forums_id_forum` ASC),
  INDEX `fk_Replies_Users1_idx` (`Users_users_id_user` ASC),
  CONSTRAINT `fk_Replies_Topics1`
    FOREIGN KEY (`Topics_topics_id_topic` , `Topics_Forums_forums_id_forum`)
    REFERENCES `newgame`.`Topics` (`topics_id_topic` , `Forums_forums_id_forum`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Replies_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Replies table';


-- -----------------------------------------------------
-- Table `newgame`.`Libraries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Libraries` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Libraries` (
  `libraries_id_library` INT NOT NULL AUTO_INCREMENT,
  `Users_users_id_user` INT NOT NULL,
  PRIMARY KEY (`libraries_id_library`, `Users_users_id_user`),
  INDEX `fk_Libraries_Users1_idx` (`Users_users_id_user` ASC),
  CONSTRAINT `fk_Libraries_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Libraries table';


-- -----------------------------------------------------
-- Table `newgame`.`Games_libraries`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Games_libraries` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Games_libraries` (
  `Libraries_libraries_id_library` INT NOT NULL,
  `Games_games_id_game` INT NOT NULL,
  INDEX `fk_Games_libraries_Libraries1_idx` (`Libraries_libraries_id_library` ASC),
  PRIMARY KEY (`Libraries_libraries_id_library`, `Games_games_id_game`),
  INDEX `fk_Games_libraries_Games1_idx` (`Games_games_id_game` ASC),
  CONSTRAINT `fk_Games_libraries_Libraries1`
    FOREIGN KEY (`Libraries_libraries_id_library`)
    REFERENCES `newgame`.`Libraries` (`libraries_id_library`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Games_libraries_Games1`
    FOREIGN KEY (`Games_games_id_game`)
    REFERENCES `newgame`.`Games` (`games_id_game`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Games_libraries table';


-- -----------------------------------------------------
-- Table `newgame`.`Friends`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Friends` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Friends` (
  `Users_users_id_user` INT NOT NULL,
  `Users_users_id_user1` INT NOT NULL,
  PRIMARY KEY (`Users_users_id_user`, `Users_users_id_user1`),
  INDEX `fk_Friends_Users2_idx` (`Users_users_id_user1` ASC),
  CONSTRAINT `fk_Friends_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Friends_Users2`
    FOREIGN KEY (`Users_users_id_user1`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `newgame`.`Reviews`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Reviews` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Reviews` (
  `reviews_id_review` INT NULL AUTO_INCREMENT,
  `reviews_text` VARCHAR(1000) NULL,
  `reviews_rating` INT NOT NULL,
  `Games_games_id_game` INT NOT NULL,
  `Users_users_id_user` INT NOT NULL,
  `reviews_datetime` TIMESTAMP NOT NULL,
  PRIMARY KEY (`Games_games_id_game`, `Users_users_id_user`),
  INDEX `fk_Reviews_Games1_idx` (`Games_games_id_game` ASC),
  INDEX `fk_Reviews_Users1_idx` (`Users_users_id_user` ASC),
  UNIQUE INDEX `reviews_id_review_UNIQUE` (`reviews_id_review` ASC),
  CONSTRAINT `fk_Reviews_Games1`
    FOREIGN KEY (`Games_games_id_game`)
    REFERENCES `newgame`.`Games` (`games_id_game`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Reviews_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `newgame`.`Chats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Chats` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Chats` (
  `chats_id_chat` INT NOT NULL AUTO_INCREMENT,
  `chats_text` VARCHAR(10000) NOT NULL,
  `chats_datetime` DATE NOT NULL,
  `Users_users_id_user_send` INT NOT NULL,
  `Users_users_id_user_receive` INT NOT NULL,
  `chats_user_image` VARCHAR(45) NULL,
  PRIMARY KEY (`chats_id_chat`, `Users_users_id_user_send`, `Users_users_id_user_receive`),
  INDEX `fk_Chats_Users1_idx` (`Users_users_id_user_send` ASC),
  INDEX `fk_Chats_Users2_idx` (`Users_users_id_user_receive` ASC),
  CONSTRAINT `fk_Chats_Users1`
    FOREIGN KEY (`Users_users_id_user_send`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Chats_Users2`
    FOREIGN KEY (`Users_users_id_user_receive`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Chat table';


-- -----------------------------------------------------
-- Table `newgame`.`Friendship_Solicitations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Friendship_Solicitations` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Friendship_Solicitations` (
  `friendship_solicitations_idfriendship_solicitation` INT NOT NULL AUTO_INCREMENT,
  `Users_users_id_send` INT NOT NULL,
  `Users_users_id_receive` INT NOT NULL,
  `friendship_solicitations_status` INT NOT NULL,
  `friendship_solicitations_timestamp` TIMESTAMP NOT NULL,
  PRIMARY KEY (`friendship_solicitations_idfriendship_solicitation`, `Users_users_id_send`, `Users_users_id_receive`),
  INDEX `fk_Friendship_Solicitations_Users1_idx` (`Users_users_id_send` ASC),
  INDEX `fk_Friendship_Solicitations_Users2_idx` (`Users_users_id_receive` ASC),
  CONSTRAINT `fk_Friendship_Solicitations_Users1`
    FOREIGN KEY (`Users_users_id_send`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Friendship_Solicitations_Users2`
    FOREIGN KEY (`Users_users_id_receive`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = 'Friendship_Solicitations table';


-- -----------------------------------------------------
-- Table `newgame`.`Walls`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Walls` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Walls` (
  `walls_id_wall` INT NOT NULL AUTO_INCREMENT,
  `Users_users_id_user` INT NOT NULL,
  PRIMARY KEY (`walls_id_wall`, `Users_users_id_user`),
  INDEX `fk_Walls_Users1_idx` (`Users_users_id_user` ASC),
  CONSTRAINT `fk_Walls_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `newgame`.`Messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `newgame`.`Messages` ;

CREATE TABLE IF NOT EXISTS `newgame`.`Messages` (
  `messages_id_message` INT NOT NULL AUTO_INCREMENT,
  `walls_walls_id_wall` INT NOT NULL,
  `messages_text` VARCHAR(1000) NOT NULL,
  `messages_datetime` TIMESTAMP NOT NULL,
  `Users_users_id_user` INT NOT NULL,
  PRIMARY KEY (`messages_id_message`, `walls_walls_id_wall`, `Users_users_id_user`),
  INDEX `fk_Messages_Walls1_idx` (`walls_walls_id_wall` ASC),
  INDEX `fk_Messages_Users1_idx` (`Users_users_id_user` ASC),
  CONSTRAINT `fk_Messages_Walls1`
    FOREIGN KEY (`walls_walls_id_wall`)
    REFERENCES `newgame`.`Walls` (`walls_id_wall`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Messages_Users1`
    FOREIGN KEY (`Users_users_id_user`)
    REFERENCES `newgame`.`Users` (`users_id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

USE `newgame`;

DELIMITER $$

USE `newgame`$$
DROP TRIGGER IF EXISTS `newgame`.`Users_AFTER_INSERT` $$
USE `newgame`$$
CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Users_AFTER_INSERT` AFTER INSERT ON `Users` FOR EACH ROW

BEGIN

DECLARE userId int;

SELECT Users.users_id_user FROM Users ORDER BY Users.users_id_user DESC LIMIT 1 INTO userId;

INSERT INTO Libraries (Users_users_id_user) VALUES (userId);
INSERT INTO Walls (Users_users_id_user) VALUES (userId);
END$$


USE `newgame`$$
DROP TRIGGER IF EXISTS `newgame`.`Games_AFTER_INSERT` $$
USE `newgame`$$
CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Games_AFTER_INSERT` AFTER INSERT ON `Games` FOR EACH ROW

BEGIN

DECLARE gameId int;

DECLARE gameName varchar(200);

SELECT Games.games_id_game FROM Games
 ORDER BY Games.games_id_game DESC LIMIT 1 INTO gameId;

SELECT Games.games_name FROM Games 
ORDER BY Games.games_id_game DESC LIMIT 1 INTO gameName;



INSERT INTO Forums (forums_title,forums_created_date,Games_games_id_game) VALUES (gameName,now(),gameId);

END$$


USE `newgame`$$
DROP TRIGGER IF EXISTS `newgame`.`Bill_Details_AFTER_INSERT` $$
USE `newgame`$$
CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Bill_Details_AFTER_INSERT` AFTER INSERT ON `Bill_Details` FOR EACH ROW
BEGIN
DECLARE gameId int;

DECLARE userId int;

SELECT Bill_Details.Games_games_id_game FROM Bill_Details
ORDER BY Bill_Details.Bill_Details_counter DESC LIMIT 1 INTO gameId;

SELECT Libraries.libraries_id_library FROM Bills
INNER JOIN Users ON Users.users_id_user=Bills.Users_users_id_user
INNER JOIN Libraries ON Libraries.Users_users_id_user=Users.users_id_user
INNER JOIN Bill_Details ON Bill_Details.Bills_bills_id_bill=Bills.Users_users_id_user
ORDER BY Bill_Details.Bill_Details_counter DESC LIMIT 1 INTO userId;


INSERT INTO Games_libraries (Libraries_libraries_id_library,Games_games_id_game) VALUES (userId,gameId);

END$$


USE `newgame`$$
DROP TRIGGER IF EXISTS `newgame`.`Reviews_AFTER_INSERT` $$
USE `newgame`$$
CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Reviews_AFTER_INSERT` AFTER INSERT ON `Reviews` FOR EACH ROW
BEGIN
DECLARE gameId int;

DECLARE gameRating float;

SELECT Reviews.Games_games_id_game FROM Reviews 
ORDER BY Reviews.reviews_id_review DESC LIMIT 1 INTO gameId;

SELECT IF(Total=1,1,Total) AS 'Total' FROM (
SELECT ROUND(SUM(Reviews.reviews_rating)/(SELECT COUNT(Reviews.Games_games_id_game) FROM Reviews WHERE Reviews.Games_games_id_game=gameId),1) AS 'Total' 
FROM Reviews WHERE Reviews.Games_games_id_game=gameId) AS c1 INTO gameRating;


UPDATE Games
SET Games.games_rating = gameRating
WHERE Games.games_id_game = gameId;

END$$


USE `newgame`$$
DROP TRIGGER IF EXISTS `newgame`.`Friendship_Solicitations_AFTER_UPDATE` $$
USE `newgame`$$
CREATE DEFINER = CURRENT_USER TRIGGER `newgame`.`Friendship_Solicitations_AFTER_UPDATE` AFTER UPDATE ON `Friendship_Solicitations` FOR EACH ROW
BEGIN
 
DECLARE accepted int;
DECLARE user1 int;
DECLARE user2 int;
 
SELECT Friendship_Solicitations.friendship_solicitations_status FROM Friendship_Solicitations
LEFT JOIN Friends ON Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_send OR Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_receive
WHERE Friendship_Solicitations.friendship_solicitations_status=1
LIMIT 1 INTO accepted;


SELECT Friendship_Solicitations.Users_users_id_send FROM Friendship_Solicitations
LEFT JOIN Friends ON Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_send OR Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_receive
WHERE Friendship_Solicitations.friendship_solicitations_status=1
ORDER BY Friendship_Solicitations.friendship_solicitations_timestamp DESC
LIMIT 1 INTO user1;


SELECT Friendship_Solicitations.Users_users_id_receive FROM Friendship_Solicitations
LEFT JOIN Friends ON Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_send OR Friends.Users_users_id_user=Friendship_Solicitations.Users_users_id_receive
WHERE Friendship_Solicitations.friendship_solicitations_status=1
ORDER BY Friendship_Solicitations.friendship_solicitations_timestamp DESC
LIMIT 1 INTO user2;
 
IF accepted = 1 THEN
INSERT INTO Friends (Users_users_id_user,Users_users_id_user1) VALUES(user1,user2),(user2,user1);
END IF;
END$$


DELIMITER ;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
