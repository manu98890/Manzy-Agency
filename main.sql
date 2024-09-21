CREATE DATABASE manzy;

USE manzy;

CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE places (
    id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    district VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    weather VARCHAR(255) NOT NULL,
    cost INT
);

INSERT INTO places VALUES
(1, 'Galle', 'Galle Fort', 'galle-fort.jpg', 'normal', 2300),
(2, 'Galle', 'Galle Lighthouse', 'galle-lighthouse.jpg', 'normal', 2100),
(3, 'Galle', 'Galle Fort Clock', 'galle-fort-clock.jpg', 'normal', 2400),
(4, 'Galle', 'Jungle Beach', 'jungle-beach.jpg', 'normal', 3400),
(5, 'Galle', 'Japanese Peaces Pagoda', 'japanese-peace-pagoda.jpg', 'normal', 2500),
(6, 'Galle', 'Galle International Cricket Stadium', 'galle-international-cricket-stadium.jpg', 'normal', 3600),
(7, 'Galle', 'Unawatuna Beach', 'Unawatuna-Beach.webp', 'normal', 3900),
(8, 'Galle', 'National Museum Beach', 'Galle-National-Museum.jpg', 'normal', 2100);


INSERT INTO places VALUES
(9, 'Nuwara Eliya', 'One tree Hill', 'single-tree-hill.jpg', 'normal', 3400),
(10, 'Nuwara Eliya', 'Holy trinity church', '10.jpg', 'normal', 2400),
(11, 'Nuwara Eliya', 'Nanu Oya Falls', 'nanuoya-waterfall.jpg', 'normal', 3200),
(12, 'Nuwara Eliya', 'Sri Bhakta Hanuman Temple', 'sri-bhakta-hanuman-temple.jpg', 'normal', 2100),
(13, 'Nuwara Eliya', 'Kolapathana Falls', 'Kolapathana-waterfall.jpg', 'normal', 3200),
(14, 'Nuwara Eliya', 'Adams Peak', 'adams-peak.jpg', 'normal', 4500),
(15, 'Nuwara Eliya', 'Kirigalpoththa', 'kirigaloththa.jpg', 'normal', 3600),
(16, 'Nuwara Eliya', 'Victoria Park', 'victoria-park.jpg', 'normal', 6500);

INSERT INTO places VALUES
(17, 'Anuradhapura', 'Mihintale', '17.jpg', 'normal', 2300),
(18, 'Anuradhapura', 'Ruwanwelisaya', '18.jpg', 'normal', 3200),
(19, 'Anuradhapura', 'Wilpattu National Park', '19.jpg', 'normal', 6200),
(20, 'Anuradhapura', 'Sigiriya', '20.jpg', 'normal', 3200),
(21, 'Anuradhapura', 'Ritigala Forest', '21.jpg', 'normal', 2400),
(22, 'Anuradhapura', 'Jaya Sri Maha Vidyalaya', '22.jpg', 'normal', 3600),
(23, 'Anuradhapura', 'Isurumuniya', '23.jpg', 'normal', 1200),
(24, 'Anuradhapura', 'Jethawanaramaya', '24.jpg', 'normal', 2000);

INSERT INTO places VALUES
(25, 'Trincomalee', 'Koneswaram Temple', '25.jpg', 'normal', 3000),
(26, 'Trincomalee', 'Fort Frederick', '26.jpg', 'normal', 2000),
(27, 'Trincomalee', 'Nilaveli Beach', '27.jpg', 'normal', 3200),
(28, 'Trincomalee', 'Uppuveli Beach', '28.jpg', 'normal', 4300),
(29, 'Trincomalee', 'Whale Watching', '29.jpg', 'normal', 5500),
(30, 'Trincomalee', 'Kanniya Hot Spring', '30.jpg', 'normal', 2400),
(31, 'Trincomalee', 'Dutch Bay Beach', '31.jpg', 'normal', 3100),
(32, 'Trincomalee', 'British War Cemetry', '32.jpg', 'normal', 2000);

CREATE TABLE travel_packages (
    id INT PRIMARY KEY,
    package_name VARCHAR(255),
    total_cost INT,
    duration VARCHAR(50),
    weather VARCHAR(50),
    image VARCHAR(255),
    district VARCHAR(50)
);

CREATE TABLE package_attractions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_id INT,
    attraction_name VARCHAR(255),
    attraction_cost INT,
    places_id INT UNSIGNED,
    FOREIGN KEY (package_id) REFERENCES travel_packages(id),
    FOREIGN KEY (places_id) REFERENCES places(id)
);


INSERT INTO travel_packages (id, package_name, total_cost, duration, weather, image) VALUES
(1, 'Galle Adventure Package', 11400, '2 Days', 'Normal', 'galle-fort.jpg'),
(2, 'Nuwara Eliya Nature Package', 11300, '2 Days', 'Normal', '10.jpg'),
(3, 'Anuradhapuraya Heritage Package', 7500, '2 Days', 'Normal', '17.jpg'),
(4, 'Trincomalee Coastal Package', 13000, '2 Days', 'Normal', '29.jpg');

INSERT INTO package_attractions (package_id, attraction_name, attraction_cost, places_id) VALUES
(1, 'Galle Fort', 2300,1),
(1, 'Galle Lighthouse', 2100,2),
(1, 'Jungle Beach', 3400,4),
(1, 'Galle International Cricket Stadium', 3600, 6),

(2, 'Nanu Oya Falls', 3200, 11),
(2, 'Adams Peak', 4500, 14),
(2, 'Kirigalpoththa', 3600, 15),

(3, 'Mihintale', 2300, 17),
(3, 'Ruwanwelisaya', 3200, 18),
(3, 'Jethawanaramaya', 2000, 24),

(4, 'Nilaveli Beach', 3200, 27),
(4, 'Whale Watching', 5500, 29),
(4, 'Uppuveli Beach', 4300, 28);


SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
mysqli_query($conn, "SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");


CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(255) NOT NULL,
    package_id INT NOT NULL,
    package_name VARCHAR(255) NOT NULL,
    district VARCHAR(255),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE payments
ADD COLUMN user_id INT NOT NULL,
ADD COLUMN username VARCHAR(255) NOT NULL;


CREATE TABLE Booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    payment_id INT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activate VARCHAR(255) DEFAULT 'deactivate',
    FOREIGN KEY (payment_id) REFERENCES payments(id)
);


crontab -e
0 * * * * /usr/bin/php /path/to/your/script/check_weather.php

composer require phpmailer/phpmailer

CREATE TABLE Hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL,
    price INT NOT NULL
);


INSERT INTO Hotels (name, description, img, price)
VALUES 
('Jetwing Lighthouse', 
'A luxury hotel with stunning views of the Indian Ocean, located in Galle, Sri Lanka. Enjoy world-class amenities and exquisite dining.', 
'1.jpg', 
400);

-- Hotel 2: Cinnamon Lodge Habarana
INSERT INTO Hotels (name, description, img, price)
VALUES 
('Cinnamon Lodge Habarana', 
'An eco-friendly retreat in the heart of Sri Lanka’s cultural triangle, surrounded by nature and rich history.', 
'2.jpg', 
350);

-- Hotel 3: Heritance Kandalama
INSERT INTO Hotels (name, description, img, price)
VALUES 
('Heritance Kandalama', 
'A stunning eco-friendly hotel built into the rock face, offering panoramic views of the Kandalama Lake and surrounding jungle.', 
'3.jpg', 
500);

-- Hotel 4: Shangri-La's Hambantota Golf Resort & Spa
INSERT INTO Hotels (name, description, img, price)
VALUES 
('Shangri-La\'s Hambantota Golf Resort & Spa', 
'A luxurious beachfront resort featuring a world-class golf course, spa, and numerous recreational activities.', 
'4.jpg', 
600);


'


CREATE TABLE IF NOT EXISTS roomsBooking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    rooms INT NOT NULL,
    roomSize VARCHAR(255) NOT NULL,
    userid INT NOT NULL,
    price INT NOT NULL,
    FOREIGN KEY (hotel_id) REFERENCES Hotels(id)
); 

CREATE TABLE booking_payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    hotel_id INT NOT NULL,
    transaction_id VARCHAR(255) NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL,
    payment_status VARCHAR(50) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hotel_id) REFERENCES Hotels(id)
);

CREATE TABLE admin(
    id INT AUTO_INCREMENT PRIMARY KEY,
    usernames VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (usernames, password) VALUES ('admin', 'admin');

CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE review (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    package_name VARCHAR(255) NOT NULL,
    review VARCHAR(255) NOT NULL
);

ALTER TABLE roomsbooking ADD COLUMN days VARCHAR(255) NOT NULL;


CREATE TABLE request(
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    message VARCHAR(255) NOT NULL
);

CREATE TABLE city(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);