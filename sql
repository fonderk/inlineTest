CREATE TABLE `ilkaskh8_inline`.`post` ( `id` INT(3) NOT NULL , `userId` INT(3) NOT NULL , `title` VARCHAR(100) NOT NULL , `body` VARCHAR(250) NOT NULL ) ENGINE = InnoDB;
ALTER TABLE `post` ADD PRIMARY KEY( `id`);
SELECT * FROM `post`
CREATE TABLE `ilkaskh8_inline`.`comments` ( `id` INT NOT NULL , `postId` INT NOT NULL , `name` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `body` VARCHAR(250) NOT NULL ) ENGINE = InnoDB;
SELECT * FROM `comments`
ALTER TABLE `comments` ADD PRIMARY KEY( `id`);
