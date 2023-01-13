CREATE DATABASE IF NOT EXISTS mail2ru;

CREATE USER 'mail2ru_user'@'localhost' IDENTIFIED BY '12345';

USE mail2ru;

CREATE TABLE Mail2RUEmailAddresses (Email VARCHAR(500) NOT NULL UNIQUE);

CREATE TABLE SentEmailAddresses (Email VARCHAR(500) NOT NULL UNIQUE);

GRANT SELECT, INSERT ON Mail2RUEmailAddresses TO mail2ru_user@localhost;

GRANT SELECT, INSERT ON SentEmailAddresses TO mail2ru_user@localhost;