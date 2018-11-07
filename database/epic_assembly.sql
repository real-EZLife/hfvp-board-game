CREATE DATABASE IF NOT EXISTS `epic_assembly` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `epic_assembly`;


#------------------------------------------------------------
# Table: DECK
#------------------------------------------------------------

CREATE TABLE `deck`(
    `deck_id` INT AUTO_INCREMENT NOT NULL,
    `deck_name` VARCHAR (50) NOT NULL,
    PRIMARY KEY (`deck_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: AREA
#------------------------------------------------------------

CREATE TABLE `area`(
    `area_id` INT AUTO_INCREMENT NOT NULL,
    `area_name` VARCHAR (50) NOT NULL,
    PRIMARY KEY (`area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: FACTION
#------------------------------------------------------------

CREATE TABLE `faction`(
    `fac_id` INT AUTO_INCREMENT NOT NULL,
    `fac_name` VARCHAR (25) NOT NULL,
    PRIMARY KEY (`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#------------------------------------------------------------
# Table: TYPE
#------------------------------------------------------------

CREATE TABLE `type`(
    `type_id` INT AUTO_INCREMENT NOT NULL,
    `type_name` VARCHAR (60) NOT NULL,
    PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#------------------------------------------------------------
# Table: CARD
#------------------------------------------------------------

CREATE TABLE `card`(
    `card_id` INT AUTO_INCREMENT NOT NULL,
    `card_name` VARCHAR (75) NOT NULL,
    `card_mana` INT NOT NULL,
    `card_pv` INT NOT NULL,
    `card_atk` INT NOT NULL,
    `card_desc` VARCHAR (255) NOT NULL,
    `card_type` INT NOT NULL,
    `card_fx` VARCHAR (75) NOT NULL,
    `card_special` BOOL NOT NULL,
    `card_img` LONGTEXT NOT NULL,
    `card_fac_id` INT,
    PRIMARY KEY (`card_id`),
    CONSTRAINT `card_faction_fk` FOREIGN KEY (`card_fac_id`) REFERENCES `faction`(`fac_id`);
    CONSTRAINT `card_type_fk` FOREIGN KEY (`card_type`) REFERENCES `type`(`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: GAME
#------------------------------------------------------------

CREATE TABLE `game`(
    `gam_id` INT  AUTO_INCREMENT  NOT NULL,
    PRIMARY KEY (`gam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: ROLE
#------------------------------------------------------------

CREATE TABLE `role`(
    `role_id` INT  AUTO_INCREMENT  NOT NULL,
    `role_name` VARCHAR (50) NOT NULL,
    `role_power` INT NOT NULL,
    PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: USER
#------------------------------------------------------------

CREATE TABLE `user`(
    `user_pseudo` VARCHAR (75) NOT NULL,
    `user_name` VARCHAR (75) NOT NULL,
    `user_surname` VARCHAR (75) NOT NULL,
    `user_email` VARCHAR (255) NOT NULL,
    `user_password` VARCHAR (255) NOT NULL,
    `user_signup_date` Date NOT NULL,
    `user_role_id` INT NOT NULL,
    PRIMARY KEY (`user_pseudo`),
    CONSTRAINT `user_role_fk` FOREIGN KEY (`user_role_id`) REFERENCES `role`(`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: PERMISSIONS
#------------------------------------------------------------

CREATE TABLE `permissions`(
    `perm_id` INT AUTO_INCREMENT NOT NULL,
    `perm_name` VARCHAR (50) NOT NULL,
    CONSTRAINT PERMISSIONS_PK PRIMARY KEY (`perm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: HERO
#------------------------------------------------------------

CREATE TABLE `hero`(
    `hero_id` INT AUTO_INCREMENT NOT NULL,
    `hero_name` VARCHAR (50) NOT NULL,
    `hero_mana` INT NOT NULL,
    `hero_lp` INT NOT NULL,
    `hero_fac_id` INT NOT NULL,
    PRIMARY KEY (`hero_id`),
    CONSTRAINT `hero_faction_fk` FOREIGN KEY (`hero_fac_id`) REFERENCES `faction`(`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: TEMP_HERO
#------------------------------------------------------------

CREATE TABLE `temp_hero`(
    `temp_hero_id` INT AUTO_INCREMENT NOT NULL,
    `temp_hero_mana` INT NOT NULL,
    `temp_hero_lp` INT NOT NULL,
    `moment` DATETIME NOT NULL,
    `user_pseudo` VARCHAR (75) NOT NULL,
    `gam_id` INT NOT NULL,
    `hero_id` INT NOT NULL,
    PRIMARY KEY (`temp_hero_id`),
    CONSTRAINT `temp_hero_user_fk` FOREIGN KEY (`user_pseudo`) REFERENCES `user`(`user_pseudo`),
    CONSTRAINT `temp_hero_game_fk` FOREIGN KEY (`gam_id`) REFERENCES `game`(`gam_id`),
    CONSTRAINT `temp_hero_hero_fk` FOREIGN KEY (`hero_id`) REFERENCES `hero`(`hero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: TEMP_CARD
#------------------------------------------------------------

CREATE TABLE `temp_card`(
    `temp_card_id` INT AUTO_INCREMENT NOT NULL,
    `temp_card_mana` INT NOT NULL,
    `temp_card_pv` INT NOT NULL,
    `temp_card_atk` INT NOT NULL,
    `temp_card_type` INT NOT NULL,
    `temp_card_fx` VARCHAR (75) NOT NULL,
    `temp_card_special` BOOL NOT NULL,
    `card_id` INT NOT NULL,
    `temp_hero_id` INT NOT NULL,
    PRIMARY KEY (`temp_card_id`),
    CONSTRAINT `temps_card_card_fk` FOREIGN KEY (`card_id`) REFERENCES `card`(`card_id`),
    CONSTRAINT `temps_card_temp_hero_fk` FOREIGN KEY (`temp_hero_id`) REFERENCES `temp_hero`(`temp_hero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: COMPOSE
#------------------------------------------------------------

CREATE TABLE `compose`(
    `deck_id` INT NOT NULL,
    `user_pseudo` VARCHAR (75) NOT NULL,
    PRIMARY KEY (`deck_id`,`user_pseudo`),
    CONSTRAINT `compose_deck_fk` FOREIGN KEY (`deck_id`) REFERENCES `deck`(`deck_id`),
    CONSTRAINT `compose_user_fk` FOREIGN KEY (`user_pseudo`) REFERENCES `user`(`user_pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: IS_ON
#------------------------------------------------------------

CREATE TABLE `is_on`(
    `temp_card_id` INT NOT NULL,
    `area_id` INT NOT NULL,
    `moment` DATETIME NOT NULL,
    PRIMARY KEY (`temp_card_id`,`area_id`),
    CONSTRAINT `is_on_temp_card_fk` FOREIGN KEY (`temp_card_id`) REFERENCES `temp_card`(`temp_card_id`),
    CONSTRAINT `is_on_area_fk` FOREIGN KEY (`area_id`) REFERENCES `area`(`area_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: DRAW
#------------------------------------------------------------

CREATE TABLE `draw`(
    `card_id` INT NOT NULL,
    `deck_id` INT NOT NULL,
    PRIMARY KEY (`card_id`,`deck_id`),
    CONSTRAINT `draw_card_fk` FOREIGN KEY (`card_id`) REFERENCES `card`(`card_id`),
    CONSTRAINT `draw_deck_fk` FOREIGN KEY (`deck_id`) REFERENCES `deck`(`deck_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: HAVE_FACTION
#------------------------------------------------------------

CREATE TABLE `have_faction`(
    `temp_card_id` INT NOT NULL,
    `fac_id` INT NOT NULL,
    PRIMARY KEY (`temp_card_id`,`fac_id`),
    CONSTRAINT `have_faction_temp_card_fk` FOREIGN KEY (`temp_card_id`) REFERENCES `temp_card`(`temp_card_id`),
    CONSTRAINT `have_faction_faction_fk` FOREIGN KEY (`fac_id`) REFERENCES `faction`(`fac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: ATTACK
#------------------------------------------------------------

CREATE TABLE `attack`(
    `temp_card_id_attacked` INT NOT NULL,
    `temp_card_id_attack` INT NOT NULL,
    `moment` DATETIME NOT NULL,
    PRIMARY KEY (`temp_card_id_attacked`,`temp_card_id_attack`),
    CONSTRAINT `attack_temp_card_attacked_fk` FOREIGN KEY (`temp_card_id_attacked`) REFERENCES `temp_card`(`temp_card_id`),
    CONSTRAINT `attack_temp_card_attack_fk` FOREIGN KEY (`temp_card_id_attack`) REFERENCES `temp_card`(`temp_card_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


#------------------------------------------------------------
# Table: ATTACK_HERO
#------------------------------------------------------------

CREATE TABLE `attack_hero`(
    `temp_card_id` INT NOT NULL,
    `temp_hero_id` INT NOT NULL,
    `moment` DATETIME NOT NULL,
    PRIMARY KEY (`temp_card_id`,`temp_hero_id`),
    CONSTRAINT `attack_hero_temp_card_fk` FOREIGN KEY (`temp_card_id`) REFERENCES `temp_card`(`temp_card_id`),
    CONSTRAINT `attack_hero_temp_hero_fk` FOREIGN KEY (`temp_hero_id`) REFERENCES `temp_hero`(`temp_hero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `integrate`(
    `perm_id` INT NOT NULL,
    `role_id` INT NOT NULL,
    PRIMARY KEY (`perm_id`,`role_id`),
    CONSTRAINT `integrate_permissions_fk` FOREIGN KEY (`perm_id`) REFERENCES `permissions`(`perm_id`),
    CONSTRAINT `integrate_role_fk` FOREIGN KEY (`role_id`) REFERENCES `role`(`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;