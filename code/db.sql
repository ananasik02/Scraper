DROP DATABASE IF EXISTS scrapeshop;

CREATE DATABASE scrapeshop;

USE scrapeshop;

CREATE TABLE shopitems
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title TEXT NOT NULL,
    likes INT UNSIGNED,
    price INT UNSIGNED,
    image TEXT NOT NULL
) ENGINE = InnoDB;

SELECT * FROM shopitems;
