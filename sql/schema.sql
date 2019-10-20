CREATE DATABASE `taskforce`;
USE `taskforce`;
CREATE TABLE `categories` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`name` CHAR(255) NOT NULL,
`icon` CHAR(100)
);
CREATE TABLE `cities` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`city` CHAR(255) NOT NULL,
`lat` CHAR(100),
`long` CHAR(100)
);
CREATE TABLE `notifications` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`name` CHAR(255) NOT NULL,
);
CREATE TABLE `users` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`city_id` INT,
`email`CHAR(155) NOT NULL,
`name` CHAR(155) NOT NULL,
`password` VARCHAR(525) NOT NULL,
`registered` DATETIME NOT NULL,
);
CREATE TABLE `profiles` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`categories_id` CHAR(100),
`notifications_id` CHAR(100),
`avatar` CHAR(100),
`birthday` DATETIME,
`rating` INT,
`popularity` INT,
`phone` CHAR(100),
`skype` CHAR(100),
`other_connect` CHAR(200),
`show` INT,
`active_date` DATETIME NOT NULL ,
);
CREATE TABLE `events` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`notification_id` INT NOT NULL,
`message` TEXT NOT NULL,
`sent_on` DATETIME NOT NULL
);
CREATE TABLE `tasks` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`customer_id` INT NOT NULL,
`category_id` INT NOT NULL,
`executor_id` INT,
`city_id` INT,
`name` CHAR(255) NOT NULL,
`description` TEXT NOT NULL,
`sum` INT,
`files` TEXT,
`status` CHAR(100) NOT NULL,
`deadline` DATETIME,
`created` DATETIME NOT NULL,
`closed` DATETIME NOT NULL,
);
CREATE TABLE `reviews` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`task_id` INT NOT NULL,
`message` TEXT NOT NULL,
`created` DATETIME NOT NULL,
);
CREATE TABLE `chats` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`task_id` INT NOT NULL,
`message` TEXT NOT NULL,
`created` DATETIME NOT NULL,
);
CREATE TABLE `responses` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`task_id` INT NOT NULL,
`message` TEXT NOT NULL,
`sum` INT,
`created` DATETIME NOT NULL,
);


CREATE UNIQUE INDEX email ON user(email);
CREATE INDEX user ON projects(user_id);
CREATE INDEX user ON tasks(user_id);

