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
);
CREATE TABLE `users` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`city_id` INT,
`district` CHAR(200),
`lat` INT,
`long` INT,
`email`CHAR(155) NOT NULL,
`name` CHAR(155) NOT NULL,
`password` VARCHAR(525) NOT NULL,
`registered` DATETIME NOT NULL,
);
CREATE TABLE `profiles` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`avatar` CHAR(100),
`birthday` DATE NULLABLE,
`biography` TEXT,
`rating` INT,
`view_count` INT,
`order_count` INT,
`phone` CHAR(100),
`skype` CHAR(100),
`other_connect` CHAR(200),
`notification_message` TINYINT(1),
`notification_task_action` TINYINT(1),
`notification_reviews` TINYINT(1),
`show_contacts_customer` TINYINT(1),
`show_profile` TINYINT(1),
`last_active_at` DATETIME NOT NULL ,
);
CREATE TABLE `photos` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`link` CHAR(150),
)
CREATE TABLE `user_specialization_category` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`categories_id` INT,
)
CREATE TABLE `favourite_users` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_current` INT,
`user_added` INT,
);
CREATE TABLE `events` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`notification_id` INT NOT NULL,
`message` TEXT NOT NULL,
`event_new` TINYINT(1),
`sent_on` DATETIME NOT NULL
);
CREATE TABLE `notifications` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`name` CHAR(255) NOT NULL,
`notification_type` ENUM(`message`, `task_action`, `reviews`),
);
CREATE TABLE `tasks` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`customer_id` INT NOT NULL,
`category_id` INT NOT NULL,
`executor_id` INT,
`city_id` INT,
`district` CHAR(200),
`lat` INT,
`long` INT,
`name` CHAR(255) NOT NULL,
`description` TEXT NOT NULL,
`sum` INT,
`status` ENUM(`new`,`on execution`, `completed`, `canceled`, `failed`),
`deadline` DATETIME,
`created` DATETIME NOT NULL,
`closed` DATETIME NOT NULL,
);
CREATE TABLE `task_files` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`task_id` INT NOT NULL,
`link` CHAR(150) NOT NULL,
);
CREATE TABLE `reviews` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`sender_id` INT NOT NULL,
`recipient_id` INT NOT NULL,
`task_id` INT NOT NULL,
`message` TEXT NOT NULL,
`created` DATETIME NOT NULL,
`evaluation` INT,
`task_ready` TINYINT(1),
);
CREATE TABLE `chats` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`customer_id` INT NOT NULL,
`executor_id` INT NOT NULL,
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
CREATE INDEX user ON tasks(user_id);

