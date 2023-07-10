DROP DATABASE IF EXISTS AGmarkets;

CREATE DATABASE AGmarkets;

USE AGmarkets;

-- First Table: Buyer1

CREATE TABLE Buyer1 (
	userId INT AUTO_INCREMENT,
    firstName VARCHAR(70) NOT NULL,
    lastName VARCHAR(70) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dateOfBirth DATE,
    profileDescription TEXT,
    activated VARCHAR(3) DEFAULT 'no',
    PRIMARY KEY (userId)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

ALTER TABLE Buyer1 AUTO_INCREMENT=200;

-- Second Table: Seller1
CREATE TABLE Seller1 (
	userId INT AUTO_INCREMENT,
    firstName VARCHAR(70) NOT NULL,
    lastName VARCHAR(70) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dateOfBirth DATE,
    profileDescription TEXT,
    activated VARCHAR(3) DEFAULT 'no',
    PRIMARY KEY (userId)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- Third Table: Admin1
CREATE TABLE Admin1 (
	userId INT AUTO_INCREMENT,
    firstName VARCHAR(70) NOT NULL,
    lastName VARCHAR(70) NOT NULL,
    username VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    dateOfBirth DATE,
    marketName VARCHAR(70) NOT NULL,
    marketDescription TEXT,
    activated VARCHAR(3) DEFAULT 'no',
    PRIMARY KEY (userId)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

ALTER TABLE Admin1 AUTO_INCREMENT=1000;

-- Fourth Table: Product
CREATE TABLE Product (
	productId INT AUTO_INCREMENT,
    userId INT NOT NULL,
    productName VARCHAR(60) NOT NULL,
    productDescription TEXT,
    category VARCHAR(20) NOT NULL,
    buyNow DECIMAL(7,2) NOT NULL,
    PRIMARY KEY (productId),
    FOREIGN KEY (userId) REFERENCES Seller1(userId)
		ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

-- Select Tables:

SELECT * FROM Buyer1;
SELECT * FROM Seller1;
SELECT * FROM Admin1;
SELECT * FROM Product;

-- Make admin_frm_ara an activated admin:
UPDATE admin1
SET
	activated="yes"
WHERE
	userId=1000;