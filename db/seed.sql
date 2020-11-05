insert into users(username, password, role) values ('manager', '123456', 'manager');
insert into users(username, password, role) values ('admin1', '123456', 'admin');
insert into users(username, password, role) values ('admin2', '123456', 'admin');
insert into users(username, password, role) values ('customer1', '123456', 'customer');
insert into users(username, password, role) values ('customer2', '123456', 'customer');
insert into users(username, password, role) values ('customer3', '123456', 'customer');


insert into categories(name) values('Trái cây');
insert into categories(name) values('Rau củ');

insert into products(user_id, category_id, name, description, img_link, quantity, unit_type, price)
  values(1, 1, 'Táo', 'Vẫn còn trên cây','db/seed/images/product1.png', 10, 'Kg', 100000),
        (1, 1, 'Dưa hấu', 'Vẫn còn trên cây dưa','db/images/seed/product2.jpg', 20, 'Quả', 80000),
        (1, 1, 'Xoài', 'Chua lắm','db/seed/images/product3.jpg', 50, 'Kg', 40000),
        (1, 1, 'Mít', 'Mít !!!!','db/seed/images/product4.png', 10, 'Quả', 30000),
        (1, 1, 'Khế', 'Khế chua','db/seed/images/product5.jpg', 100, 'Quả', 5000);
insert into products(user_id, category_id, name, description, img_link, quantity, unit_type, price)
  values(1, 2, 'Cà chua', 'Màu đỏ','db/images/seed/product6.jpeg', 80, 'Kg', 15000),
        (1, 2, 'Khoai lang', 'Khoai lang vàng','db/images/seed/product7.jpg', 20, 'Củ', 80000),
        (1, 2, 'Hành Tây', 'Khiến bạn khóc thét','db/images/seed/product8.jpg', 20, 'Củ', 2000),
        (1, 2, 'Hành lá', 'aaaaaaaaaaaaaaaaaaaa','db/images/seed/product9.jpg', 10, 'Kg', 30000),
        (1, 2, 'Củ dền', 'Củ dền màu đỏ','db/images/seed/product10.jpg', 100, 'Củ', 15000);

insert into slides(user_id, name, img_link, active)
  values(1, 'This is slide 1','db/images/seed/slide1.jpg', true),
        (1, 'This is slide 2','db/images/seed/slide2.jpg', true),
        (1, 'This is slide 3','db/images/seed/slide3.jpg', true);