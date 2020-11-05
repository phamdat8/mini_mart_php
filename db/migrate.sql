DROP DATABASE mini_mart;
create database mini_mart;
use mini_mart;
create table users(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  role VARCHAR(30) default 'customer',
  cookie_token VARCHAR(30)
);

create table categories(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  name varchar(30) not null
);

create table products(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  user_id int(6),
  category_id INT(6),
  name varchar(30),
  description text,
  img_link varchar(100),
  quantity int(6),
  unit_type varchar(10),
  price int(10)
);

create table slides(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  user_id int(6),
  name varchar(30),
  img_link varchar(100),
  active boolean
);

ALTER TABLE products ADD FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE slides ADD FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE products ADD FOREIGN KEY (category_id) REFERENCES categories(id);



