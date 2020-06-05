CREATE DATABASE `estore` COLLATE 'utf8_general_ci';

use estore;

CREATE TABLE `products` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name_pt` VARCHAR(200) NULL DEFAULT NULL,
	`name_en` VARCHAR(200) NULL DEFAULT NULL,
	`name_fr` VARCHAR(200) NULL DEFAULT NULL,
	`price_pt` FLOAT NULL DEFAULT NULL,
	`price_en` FLOAT NULL DEFAULT NULL,
	`price_fr` FLOAT NULL DEFAULT NULL,
	`sale_start` DATETIME NULL DEFAULT NULL,
	`sale_end` DATETIME NULL DEFAULT NULL,
	`sale_price_pt` FLOAT NULL DEFAULT NULL,
	`sale_price_en` FLOAT NULL DEFAULT NULL,
	`sale_price_fr` FLOAT NULL DEFAULT NULL,

	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;


insert into products (name_pt, name_en, name_fr, price_pt, price_en, price_fr, sale_start, sale_end) 
values('Skin Bomba Halloween', 'Bomb Skin Halloween', 'Peau de pompe Halloween', '10.00', '5.50', '2.10', null, null);

insert into products (name_pt, name_en, name_fr, price_pt, price_en, price_fr, sale_start, sale_end, sale_price_fr, sale_price_pt, sale_price_en) 
values('Metal Pass 1', 'Metal Pass 1', 'Passe métallique 1', '50.00', '25.50', '10.10', '2019-01-01 00:00:00', '2019-01-31 00:00:00', '25.00', '12.75', '5.5');


insert into products (name_pt, name_en, name_fr, price_pt, price_en, price_fr, sale_start, sale_end, sale_price_fr, sale_price_pt, sale_price_en) 
values('Metal Pass 2', 'Metal Pass 2', 'Passe métallique 2', '60.00', '30.50', '20.10', '2019-02-01 00:00:00', '2019-02-28 00:00:00', '30.00', '15.75', '10.5');

insert into products (name_pt, name_en, name_fr, price_pt, price_en, price_fr, sale_start, sale_end, sale_price_fr, sale_price_pt, sale_price_en) 
values('Metal Pass 3', 'Metal Pass 3', 'Passe métallique 3', '70.00', '35.50', '30.10', '2019-03-01 00:00:00', '2019-03-31 00:00:00', '40.00', '18.75', '14.5');



CREATE TABLE `history` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`product_id` INT(10) NOT NULL,
	`language` VARCHAR(2) NOT NULL,
	`price` FLOAT(2) NOT NULL,
	`sale`  INT(1) NOT NULL,
	`date` DATETIME NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
