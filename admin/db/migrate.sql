DROP DATABASE [IF EXISTS] mini_mart;
create database mini_mart;
use mini_mart;
create table users(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL,
  role VARCHAR(10),
  cookie_token VARCHAR(30)
);

create table categories(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name varchar(30) not null
);

create table products(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  category_id INT(6),
  name varchar(30),
  description text,
  img_link varchar(100),
  quantity int(6),
  unit_type varchar(10),
  price int(10),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);

create table slides(
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name varchar(30),
  img_link varchar(100),
  active boolean;
);



