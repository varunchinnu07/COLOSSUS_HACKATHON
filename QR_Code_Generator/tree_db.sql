create database tree_details;
use tree_details;

CREATE TABLE `trees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `family` varchar(255) NOT NULL,
  `uses` text NOT NULL,
  `required_nutrients` text NOT NULL,
  `college_or_garden_name` varchar(255) NOT NULL,
  `part_of_college_or_garden` varchar(255) NOT NULL,
  `qr_code_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);
