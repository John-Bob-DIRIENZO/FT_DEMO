CREATE DATABASE IF NOT EXISTS ft_perso;

USE ft_perso;

CREATE TABLE IF NOT EXISTS `personnage`
(
    id          INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    `force`     INT          NOT NULL DEFAULT 0,
    defense     INT          NOT NULL DEFAULT 0,
    pv          INT          NOT NULL DEFAULT 100,
    last_asleep DATETIME              DEFAULT NULL,
    last_spell  DATETIME              DEFAULT NULL,
    type        VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `user`
(
    id               INT          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username         VARCHAR(255) NOT NULL,
    password         VARCHAR(255) NOT NULL,
    token            VARCHAR(255),
    token_expiration DATETIME
)
