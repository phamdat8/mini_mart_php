DROP DATABASE mini_mart;
create database mini_mart;
use mini_mart;
create table users(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  username nvarchar(30) unique NOT NULL,
  password nvarchar(30) NOT NULL,
  role nvarchar(30) default 'customer',
  cookie_token VARCHAR(30)
);

create table categories(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  name nvarchar(30) not null
);

create table products(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  user_id int(6),
  category_id INT(6),
  name nvarchar(30),
  description text,
  img_link nvarchar(100),
  quantity int(6),
  unit_type nvarchar(10),
  price int(10),
  discount int(3)
);

create table slides(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  user_id int(6),
  name nvarchar(30),
  img_link nvarchar(100),
  active boolean
);

create table orders(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  user_id int(6),
  created_at TIMESTAMP default current_timestamp,
  total_price int(20)
);

create table order_details(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  order_id int(6),
  product_id int(6),
  quantity int(6)
);

create table carts(
  id INT(6) AUTO_INCREMENT PRIMARY KEY,
  user_id int(6),
  product_id int(6),
  quantity int(6)
)

alter table users add cart_quantity int(6);

ALTER TABLE orders ADD FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE orders_details ADD FOREIGN KEY (order_id) REFERENCES orders(id);
ALTER TABLE orders_details ADD FOREIGN KEY (product_id) REFERENCES products(id);
ALTER TABLE carts ADD FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE carts ADD FOREIGN KEY (product_id) REFERENCES products(id);



