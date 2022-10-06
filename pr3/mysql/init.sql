CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE IF NOT EXISTS material (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    naming VARCHAR(64) NOT NULL,
    price VARCHAR(11) NOT NULL,
    PRIMARY KEY (ID)
    );

CREATE TABLE IF NOT EXISTS basket (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    naming VARCHAR(64) NOT NULL,
    price VARCHAR(11) NOT NULL,
    amount VARCHAR(11) NOT NULL,
    PRIMARY KEY (ID)
    );

CREATE TABLE IF NOT EXISTS auth (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY(ID)
);

INSERT INTO auth (login, password)
VALUES ('login', '{SHA}ewptqTgyrqsq+kOcgme0ut4x82A=');

INSERT INTO material (naming, price)
VALUES
    ('hidro-isolation', '1427'),
    ('block gazobetonniy', '94'),
    ('kirpich ryadovoi', '27'),
    ('skobi', '10'),
    ('profnastil c8', '788');

INSERT INTO basket (naming, price, amount)
VALUES
    ('hydro-isolation', '1427', '3'),
    ('kirpich ryadovoi', '27', '3'),
    ('profnastil c8', '788', '3');