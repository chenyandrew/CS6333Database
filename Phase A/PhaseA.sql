CREATE TABLE users (
    `id` int NOT NULL auto_increment,
    `role` tinyint NOT NULL default 1,
    `username` varchar(200),
    `password` varchar(250),
    PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

CREATE TABLE product (
    `id` int NOT NULL auto_increment,
    `name` varchar(200),
    `cost` decimal(7,2),
    PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

CREATE TABLE product_orders (
    `id` int NOT NULL auto_increment,
    `user_id` int NOT NULL,
    `product_id` int NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(user_id) REFERENCES users(`id`),
    FOREIGN KEY(product_id) REFERENCES product(`id`)
) AUTO_INCREMENT=1;

INSERT INTO product (`name`,`cost`) VALUES ("Fishing Rod", 12.99),("Cell Phone", 999.99),("Luxury Car", 87829.82);
INSERT INTO users (`role`, `username`, `password`) VALUES (null, "user1", "password1"), (3,"user2","password2"), (2, "user3", "password3");
INSERT INTO product_orders (`user_id`, `product_id`) VALUES (1,2),(1,3),(2,3),(3,1);


