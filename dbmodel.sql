
-- ------
-- BGA framework: © Gregory Isabelli <gisabelli@boardgamearena.com> & Emmanuel Colin <ecolin@boardgamearena.com>
-- SayAnythingMU implementation : © <Your name here> <Your email address here>
-- 
-- This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
-- See http://en.boardgamearena.com/#!doc/Studio for more information.
-- -----

-- dbmodel.sql

-- This is the file where you are describing the database schema of your game
-- Basically, you just have to export from PhpMyAdmin your table structure and copy/paste
-- this export here.
-- Note that the database itself and the standard tables ("global", "stats", "gamelog" and "player") are
-- already created and must not be created here

-- Note: The database schema is created from this file when the game starts. If you modify this file,
--       you have to restart a game to see your changes in database.

-- Example 1: create a standard "card" table to be used with the "Deck" tools (see example game "hearts"):

CREATE TABLE IF NOT EXISTS `cards` (
   `card_id` 	int(10) unsigned NOT NULL AUTO_INCREMENT,
   `option1` 	varchar(80) NOT NULL,
   `option2` 	varchar(80) NOT NULL,
   `option3` 	varchar(80) NOT NULL,
   `option4` 	varchar(80) NOT NULL,
   `option5` 	varchar(80) NOT NULL,
   `selected` 	varchar(80),
   PRIMARY KEY (`card_id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `responses` (
   `response_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `player_no`   int(10) unsigned NOT NULL,
   `card_id`     int(10) unsigned NOT NULL,
   `response`    varchar(100) NOT NULL,
   `correct`  	 boolean 	DEFAULT false,
   PRIMARY KEY (`response_id`),
   FOREIGN KEY (`player_no`) REFERENCES player(`player_no`),
   FOREIGN KEY (`card_id`)   REFERENCES cards(`card_id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `chips` (
   `chip_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `player_no`   int(10) unsigned NOT NULL,
   `response_id` int(10) unsigned NOT NULL,
   `card_id`     int(10) unsigned NOT NULL,
   PRIMARY KEY (`chip_id`),
   FOREIGN KEY (`player_no`)  REFERENCES player(`player_no`),
   FOREIGN KEY (`response_id`) REFERENCES responses(`response_id`),
   FOREIGN KEY (`card_id`)    REFERENCES cards(`card_id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `roundInfo` (
   `round_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `selected_question` int(10) NOT NULL,
   `selected_response` int(10) NOT NULL,
   `selected_card` int(10) NOT NULL,
   PRIMARY KEY (`round_id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;





-- Example 2: add a custom field to the standard "player" table
-- ALTER TABLE `player` ADD `player_my_custom_field` INT UNSIGNED NOT NULL DEFAULT '0';

