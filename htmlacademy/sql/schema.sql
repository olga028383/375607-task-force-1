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
`lat` DOUBLE,
`long` DOUBLE
);
CREATE TABLE `users` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`city_id` INT,
`district` CHAR(200),
`lat` DOUBLE,
`long` DOUBLE,
`email`CHAR(155) NOT NULL,
`name` CHAR(155) NOT NULL,
`password` VARCHAR(525) NOT NULL,
`registered` DATETIME NOT NULL,
 FOREIGN KEY (`city_id`)  REFERENCES cities (`id`)
);
CREATE TABLE `profiles` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`avatar` CHAR(100),
`birthday` DATE NOT NULL,
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
`last_active_at` DATETIME NOT NULL,
 FOREIGN KEY (`user_id`)  REFERENCES categories (`id`)
);
CREATE TABLE `photos` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`link` CHAR(150),
FOREIGN KEY (`user_id`)  REFERENCES users (`id`)
);
CREATE TABLE `user_specialization_category` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`categories_id` INT,
FOREIGN KEY (`user_id`)  REFERENCES users (`id`),
FOREIGN KEY (`categories_id`)  REFERENCES users (`id`)
);
CREATE TABLE `favourite_users` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_current` INT,
`user_added` INT,
FOREIGN KEY (`user_current`)  REFERENCES users (`id`),
FOREIGN KEY (`user_added`)  REFERENCES users (`id`)
);
CREATE TABLE `notifications` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`name` ENUM('respond_new', 'message_new', 'task_start', 'task_complete', 'task_failed_executor')
);
CREATE TABLE `events` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`notification_id` INT NOT NULL,
`message` TEXT NOT NULL,
`event_new` TINYINT(1),
`sent_on` DATETIME NOT NULL,
FOREIGN KEY (`user_id`)  REFERENCES users (`id`),
FOREIGN KEY (`notification_id`)  REFERENCES notifications (`id`)
);
CREATE TABLE `tasks` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`customer_id` INT NOT NULL,
`category_id` INT NOT NULL,
`executor_id` INT,
`city_id` INT,
`district` CHAR(200),
`lat` DOUBLE,
`long` DOUBLE,
`name` CHAR(255) NOT NULL,
`description` TEXT NOT NULL,
`sum` INT,
`status` ENUM('new','on execution', 'completed', 'canceled', 'failed'),
`deadline` DATETIME,
`created` DATETIME NOT NULL,
`closed` DATETIME,
 FOREIGN KEY (`category_id`)  REFERENCES categories (`id`),
 FOREIGN KEY (`customer_id`)  REFERENCES users (`id`),
 FOREIGN KEY (`executor_id`)  REFERENCES users (`id`),
 FOREIGN KEY (`city_id`)  REFERENCES cities (`id`)
);
CREATE TABLE `task_files` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`task_id` INT NOT NULL,
`link` CHAR(150) NOT NULL,
FOREIGN KEY (`task_id`)  REFERENCES tasks (`id`)
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
FOREIGN KEY (`task_id`)  REFERENCES tasks (`id`),
 FOREIGN KEY (`sender_id`)  REFERENCES users (`id`),
 FOREIGN KEY (`recipient_id`)  REFERENCES users (`id`)
);
CREATE TABLE `chats` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`task_id` INT NOT NULL,
`executor_id` INT NOT NULL,
`is_closed` TINYINT(1),
FOREIGN KEY (`task_id`)  REFERENCES tasks (`id`),
 FOREIGN KEY (`executor_id`)  REFERENCES users (`id`)
);
CREATE TABLE `chat_messages` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`chat_id` INT NOT NULL,
`sender_id` INT NOT NULL,
`recipient_id` INT NOT NULL,
`message` TEXT NOT NULL,
`created` DATETIME NOT NULL,
FOREIGN KEY (`chat_id`)  REFERENCES chats (`id`),
FOREIGN KEY (`sender_id`)  REFERENCES users (`id`),
FOREIGN KEY (`recipient_id`)  REFERENCES users (`id`)
);
CREATE TABLE `responses` (
`id` INT AUTO_INCREMENT PRIMARY KEY,
`user_id` INT NOT NULL,
`task_id` INT NOT NULL,
`message` TEXT NOT NULL,
`sum` INT,
`created` DATETIME NOT NULL,
FOREIGN KEY (`user_id`)  REFERENCES users (`id`),
FOREIGN KEY (`task_id`)  REFERENCES tasks (`id`)
);


