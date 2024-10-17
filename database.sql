-- Tạo cơ sở dữ liệu
CREATE DATABASE IF NOT EXISTS beach_db;
USE beach_db;

-- Bảng Roles (Vai trò)
CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL,
    description TEXT
);

-- Chèn vai trò admin và user
INSERT INTO roles (name, description)
VALUES
    ('user', 'Standard user'),
    ('admin', 'Admin');
   
-- Bảng Users (Người dùng)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    phone VARCHAR(20),
    country VARCHAR(100),
    img VARCHAR(255),
    birth_date DATE,
    otp VARCHAR(4) NULL,
    status INT DEFAULT 1,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

INSERT INTO users (name, email, password, role_id, created_at, updated_at) 
VALUES 
    ('Ad', 'admin@gmail.com', '$2y$12$5DmI10FxrRq2wEiFwZCMeOuMUx.bIKzk51iDfOzkYNXVit.dhavPq', 1, NOW(), NOW()),
    ('U', 'user@gmail.com', '$$2y$12$5DmI10FxrRq2wEiFwZCMeOuMUx.bIKzk51iDfOzkYNXVit.dhavPq', 2, NOW(), NOW());



-- Bảng Areas (Khu vực bãi biển: Đông, Tây, Nam, Bắc)
CREATE TABLE areas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

-- Tạo Bảng country_direction (Quốc gia)
CREATE TABLE country_direction (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) UNIQUE NOT NULL, -- Tên quốc gia
    code VARCHAR(10) UNIQUE NOT NULL, -- Mã quốc gia (ví dụ: VN cho Việt Nam)
    latitude DECIMAL(10, 7) NULL,
    longitude DECIMAL(10, 7) null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO country_direction (name, code, latitude, longitude)
VALUES
    ('Vietnam', 'VN', 14.0583, 108.2772),
    ('India', 'IN', 20.5937, 78.9629),
    ('United States', 'US', 37.0902, -95.7129),
    ('Germany', 'DE', 51.1657, 10.4515),
    ('Australia', 'AU', -25.2744, 133.7751),
    ('United Kingdom', 'GB', 55.3781, -3.4360),
    ('Italy', 'IT', 41.8719, 12.5674),
    ('Brazil', 'BR', -14.2350, -51.9253),
    ('Mexico', 'MX', 23.6345, -102.5528),
    ('Thailand', 'TH', 15.8700, 100.9925),
    ('Maldives', 'MV', 3.2028, 73.2207),
    ('Greece', 'GR', 39.0742, 21.8243),
    ('Spain', 'ES', 40.4637, -3.7492),
    ('Portugal', 'PT', 39.3999, -8.2245),
    ('Philippines', 'PH', 12.8797, 121.7740),
    ('South Africa', 'ZA', -30.5595, 22.9375),
    ('Indonesia', 'ID', -0.7893, 113.9213),
    ('Jamaica', 'JM', 18.1096, -77.2975),
    ('Cuba', 'CU', 21.5218, -77.7812),
    ('Turkey', 'TR', 38.9637, 35.2433),
    ('Egypt', 'EG', 26.8206, 30.8025);


-- Bảng Beaches (Bãi biển)
CREATE TABLE beaches (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    location VARCHAR(255),
    country VARCHAR(255),
    area_id INT,
    country_id INT,
    image_url VARCHAR(255),
    direction VARCHAR(255) NULL,
    longitude DECIMAL(10, 7) null,
    latitude DECIMAL(10, 7) null,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status INT DEFAULT 1,
    FOREIGN KEY (country_id) REFERENCES country_direction(id)
);


-- Bảng Beach_Gallery (Bộ sưu tập hình ảnh bãi biển)

CREATE TABLE beach_galleries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    beach_id INT,
    image_url VARCHAR(255),
    caption VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (beach_id) REFERENCES beaches(id)
);


-- Bảng Feedback (Phản hồi người dùng)
CREATE TABLE feedbacks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    beach_id INT,
    rating TINYINT CHECK (rating >= 1 AND rating <= 5),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (beach_id) REFERENCES beaches(id)
);

-- Bảng Ads (Quảng cáo về phương tiện di chuyển)
CREATE TABLE ads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255),
    link_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bảng Visitor Logs (Đếm số lượng người truy cập)
CREATE TABLE visitor_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    page_name VARCHAR(255) NOT NULL,
    visit_count INT DEFAULT 0,
    session_id varchar(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ip_address VARCHAR(45),
	FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Bảng Ticker Messages (Thông báo dạng chạy chữ)
CREATE TABLE ticker_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng Contacts (Quản lý liên hệ)
CREATE TABLE contacts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng Downloads (Quản lý tải xuống)
CREATE TABLE downloads (
    id INT PRIMARY KEY AUTO_INCREMENT,
    file_name VARCHAR(255) NOT NULL,
    file_url VARCHAR(255) NOT NULL,
    download_count INT DEFAULT 0,
    beach_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (beach_id) REFERENCES beaches(id) ON DELETE CASCADE
);



CREATE TABLE blogs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,  -- Người sở hữu blog
    title VARCHAR(255) NOT NULL,  -- Tiêu đề blog
    description TEXT,  -- Mô tả blog
    image_url VARCHAR(255),
    status INT DEFAULT 2,  -- Trạng thái blog
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Thời gian tạo blog
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Thời gian cập nhật blog
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Ràng buộc khoá ngoại với bảng users
);


CREATE TABLE blog_images (
    id INT PRIMARY KEY AUTO_INCREMENT,
    blog_id INT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (blog_id) REFERENCES blogs(id) ON DELETE CASCADE
);
   
CREATE TABLE blog_feedbacks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,  -- Người dùng đưa ra phản hồi
    blog_id INT,  -- Liên kết đến blog
    rating TINYINT CHECK (rating >= 1 AND rating <= 5),  -- Đánh giá (1-5 sao)
    comment TEXT,  -- Nội dung phản hồi
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (blog_id) REFERENCES blogs(id)
);


DELIMITER //

CREATE TRIGGER update_direction_after_insert
BEFORE INSERT ON beaches
FOR EACH ROW
BEGIN
    DECLARE country_latitude DECIMAL(10, 7);
    DECLARE country_longitude DECIMAL(10, 7);

    -- Lấy latitude và longitude của quốc gia từ bảng country_direction
    SELECT latitude, longitude INTO country_latitude, country_longitude
    FROM country_direction
    WHERE name = NEW.country LIMIT 1;

    -- Tính toán direction dựa trên latitude và longitude
    SET NEW.direction = 
        CASE 
            WHEN NEW.latitude > country_latitude AND NEW.longitude > country_longitude THEN 'North East'
            WHEN NEW.latitude > country_latitude AND NEW.longitude < country_longitude THEN 'North West'
            WHEN NEW.latitude < country_latitude AND NEW.longitude > country_longitude THEN 'South East'
            WHEN NEW.latitude < country_latitude AND NEW.longitude < country_longitude THEN 'South West'
            WHEN NEW.latitude > country_latitude THEN 'North'
            WHEN NEW.latitude < country_latitude THEN 'South'
            WHEN NEW.longitude > country_longitude THEN 'East'
            WHEN NEW.longitude < country_longitude THEN 'West'
            ELSE 'Unknown'
        END;
END;

DELIMITER ;



CREATE TABLE beach_galleries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    beach_id INT,
    image_url VARCHAR(255),
    caption VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (beach_id) REFERENCES beaches(id)
);



INSERT INTO beaches (name, description, location, country, area_id, country_id, image_url, direction, longitude, latitude, created_at, updated_at, status) VALUES
('Phu Quoc Beach', 'Phu Quoc Beach is one of the most beautiful beaches in Vietnam, located on Phu Quoc Island. It is famous for its fine white sand and clear blue water, perfect for swimming, snorkeling, and enjoying fresh seafood. The sunset view here is also stunning, attracting many visitors for relaxation and sightseeing.', 'Phu Quoc Island', 'Vietnam', 1, 1, 'assets/images/beaches/1728880410.png', 'South West', 103.9840000, 10.2899000, '2024-10-13 20:23:20', '2024-10-15 13:58:14', 1),
('Miami Beach', 'Miami Beach is a famous destination in the United States, known for its beautiful long beach and vibrant arts culture. This beach is a paradise for sun lovers, water sports enthusiasts, and nightlife lovers. Visitors can enjoy activities like surfing, kayaking, or simply relaxing on the golden sand.', 'Miami', 'United States', 2, 3, 'assets/images/beaches/1728973205.jpg', 'South East', -80.1300000, 25.7907000, '2024-10-13 20:23:20', '2024-10-15 13:20:05', 1),
('Santa Monica Beach', 'Santa Monica Beach is a famous beach located in California, USA. With its long shoreline and nearby amusement park, it attracts millions of visitors each year. Visitors can engage in sports activities, stroll along the beach, or enjoy meals at seaside restaurants.', 'Santa Monica', 'United States', 2, 3, 'assets/images/beaches/1728973246.jpg', 'South West', -118.4965000, 34.0194000, '2024-10-13 20:23:20', '2024-10-15 13:20:46', 1),
('Whitehaven Beach', 'Whitehaven Beach is located on Whitsunday Island, Australia, and is famous for its powdery white sand and turquoise waters. This beach is considered one of the most beautiful beaches in the world. Visitors can take boat tours to explore the untouched natural beauty of this location.', 'Whitsunday Island', 'Australia', 3, 5, 'assets/images/beaches/1728972865.jpg', 'North East', 149.0377000, -20.2827000, '2024-10-13 20:23:20', '2024-10-15 13:14:25', 1),
('Patong Beach', 'Patong Beach is the most famous beach in Phuket, Thailand, known for its vibrant nightlife and diverse water sports activities. Visitors can enjoy swimming, snorkeling, or exploring the local shops and restaurants that line the beach.', 'Phuket', 'Thailand', 4, 10, 'assets/images/beaches/1728972786.jpg', 'South West', 98.2923000, 7.8917000, '2024-10-13 20:23:20', '2024-10-15 13:13:06', 1),
('Railay Beach', 'Railay Beach is a stunning beach in Krabi, Thailand, known for its dramatic limestone cliffs and crystal-clear waters. This beach is a favorite among rock climbers and nature lovers, offering breathtaking views and a relaxing atmosphere.', 'Krabi', 'Thailand', 4, 10, 'assets/images/beaches/1728973513.png', 'South West', NULL, NULL, '2024-10-13 20:23:20', '2024-10-15 13:25:13', 1),
('Copacabana Beach', 'Copacabana Beach is a world-famous beach located in Rio de Janeiro, Brazil. Known for its vibrant atmosphere, beautiful scenery, and lively beach culture, it attracts millions of visitors each year who come to sunbathe, swim, and enjoy beachside entertainment.', 'Rio de Janeiro', 'Brazil', 5, 8, 'assets/images/beaches/1728973674.jpg', 'South East', -43.1789000, -22.9714000, '2024-10-13 20:23:20', '2024-10-15 13:27:54', 1),
('Ipanema Beach', 'Ipanema Beach is another iconic beach in Rio de Janeiro, Brazil, known for its stunning views, trendy atmosphere, and vibrant nightlife. This beach is popular with both locals and tourists, offering a perfect spot for relaxation and socializing.', 'Rio de Janeiro', 'Brazil', 5, 8, 'assets/images/ipanema.jpg', 'South East', -43.2075000, -22.9869000, '2024-10-13 20:23:20', '2024-10-15 13:22:06', 0),
('Playa del Carmen', 'Playa del Carmen is a beautiful beach town located in Quintana Roo, Mexico. Known for its white sandy beaches and lively atmosphere, it offers visitors a variety of water sports, shopping, and dining options, making it a popular tourist destination.', 'Quintana Roo', 'Mexico', 6, 9, 'assets/images/beaches/1728973384.png', 'South East', -87.0739000, 20.6296000, '2024-10-13 20:23:20', '2024-10-15 13:23:04', 1),
('Tulum Beach', 'Tulum Beach is famous for its breathtaking natural beauty and ancient Mayan ruins. Located in Tulum, Mexico, this beach offers visitors a unique blend of history, relaxation, and stunning coastal views.', 'Tulum', 'Mexico', 6, 9, 'assets/images/beaches/1728973591.png', 'South East', -87.4667000, 20.2110000, '2024-10-13 20:23:20', '2024-10-15 13:26:31', 1),
('Navagio Beach', 'Navagio Beach, also known as Shipwreck Beach, is located on the island of Zakynthos, Greece. This picturesque beach is famous for its crystal-clear waters and stunning cliffs, making it a must-visit destination for travelers.', 'Zakynthos', 'Greece', 7, 12, 'assets/images/beaches/1728973659.jpg', 'South West', 20.6245000, 37.8599000, '2024-10-13 20:23:20', '2024-10-15 13:27:39', 1),
('Elafonissi Beach', 'Elafonissi Beach is located on the island of Crete, Greece, known for its pink sand and shallow waters. It is a popular spot for families and beach lovers, offering a unique and beautiful setting for relaxation and fun.', 'Crete', 'Greece', 7, 12, 'assets/images/beaches/1728973724.jpg', 'South East', 23.5383000, 35.2720000, '2024-10-13 20:23:20', '2024-10-15 13:28:44', 1),
('Barceloneta Beach', 'Barceloneta Beach is a popular beach in Barcelona, Spain. Known for its lively atmosphere, beach bars, and water sports, it attracts both locals and tourists looking to enjoy the sun and sea.', 'Barcelona', 'Spain', 8, 13, 'assets/images/beaches/1728973827.png', 'North East', 2.1958000, 41.3851000, '2024-10-13 20:23:20', '2024-10-15 13:30:27', 1),
('Playa de la Concha', 'Playa de la Concha is a beautiful beach located in San Sebastian, Spain. Renowned for its picturesque bay and vibrant promenade, this beach offers a perfect spot for sunbathing and enjoying local cuisine.', 'San Sebastian', 'Spain', 8, 13, 'assets/images/beaches/1728973905.png', 'North East', -1.9833000, 43.3183000, '2024-10-13 20:23:20', '2024-10-15 13:31:45', 1),
('Spiaggia dei Conigli', 'Spiaggia dei Conigli, or Rabbit Beach, is located on the island of Lampedusa, Italy. It is known for its crystal-clear waters and stunning natural beauty, making it a top destination for beach lovers and nature enthusiasts.', 'Lampedusa', 'Italy', 9, 7, 'assets/images/beaches/1728973954.png', 'South East', 12.5882000, 35.4967000, '2024-10-13 20:23:20', '2024-10-15 13:32:34', 1),
('Cala Goloritze', 'Cala Goloritze is a breathtaking beach located in Sardinia, Italy. Surrounded by steep cliffs and crystal-clear waters, this secluded beach is perfect for those seeking tranquility and natural beauty.', 'Sardinia', 'Italy', 9, 7, 'assets/images/beaches/1728974010.png', 'South East', 9.6508000, 40.1258000, '2024-10-13 20:23:20', '2024-10-15 13:33:18', 1);

INSERT INTO feedbacks (user_id, beach_id, rating, message) VALUES
(1, 1, 5, 'Absolutely stunning beach! The water is crystal clear and the sunset views are breathtaking.'),
(2, 1, 4, 'Great place for relaxation. Would recommend visiting during the weekdays to avoid crowds.'),
(3, 2, 5, 'Miami Beach is fantastic! The atmosphere is vibrant and there are plenty of activities to enjoy.'),
(1, 2, 3, 'Nice beach but a bit crowded. The facilities could use some improvement.'),
(4, 3, 5, 'Santa Monica Beach is perfect for families. We had a great time playing in the sand!'),
(5, 3, 4, 'Loved the pier and the nearby restaurants. A must-visit when in California.'),
(2, 4, 5, 'Whitehaven Beach is a slice of paradise! The sand is so soft and the water is warm.'),
(6, 5, 4, 'Patong Beach is lively and fun! Great for nightlife but can be busy during the day.'),
(3, 6, 5, 'Copacabana Beach offers a unique cultural experience. The street performers were amazing!'),
(4, 7, 5, 'Ipanema Beach is iconic! Loved the atmosphere and the beautiful people. Great vibes all around.');

INSERT INTO beach_galleries (beach_id, image_url, caption) VALUES
(1, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(1, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(1, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(1, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(1, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(1, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG');

INSERT INTO beach_galleries (beach_id, image_url, caption) VALUES
(2, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(2, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(2, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(2, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(2, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(2, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(3, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(3, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(3, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(3, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(3, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(3, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(4, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(4, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(4, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(4, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(4, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(4, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(5, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(5, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(5, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(5, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(5, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(5, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(6, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(6, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(6, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(6, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(6, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(6, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(7, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(7, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(7, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(7, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(7, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(7, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(8, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(8, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(8, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(8, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(8, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(8, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(9, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(9, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(9, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(9, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(9, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(9, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(10, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(10, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(10, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(10, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(10, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(10, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(11, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(11, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(11, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(11, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(11, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(11, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(12, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(12, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(12, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(12, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(12, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(12, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(13, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(13, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(13, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(13, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(13, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(13, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(14, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(14, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(14, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(14, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(14, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(14, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(15, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(15, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(15, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(15, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(15, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(15, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG'),
(16, 'assets/images/beaches/galleries/1729086041-grace1.JPG', 'grace1.JPG'),
(16, 'assets/images/beaches/galleries/1729086041-grace2.JPG', 'grace2.JPG'),
(16, 'assets/images/beaches/galleries/1729086041-grace3.JPG', 'grace3.JPG'),
(16, 'assets/images/beaches/galleries/1729086041-grace4.JPG', 'grace4.JPG'),
(16, 'assets/images/beaches/galleries/1729086041-grace5.JPG', 'grace5.JPG'),
(16, 'assets/images/beaches/galleries/1729086041-grace6.JPG', 'grace6.JPG');



INSERT INTO blogs (user_id, title, description, image_url, status) VALUES
(1, 'Exploring the Most Beautiful Beaches in Vietnam', 'A journey to the stunning beaches of Vietnam.', 'storage/assets/blogs/8osXJNt3tWaXJVKmfnYDRcVrM56rDbaoxgwQIVMn.jpg', 1),
(1, 'Fun Activities at the Beach', 'Discover exciting activities you can do at the beach.', 'storage/assets/blogs/8osXJNt3tWaXJVKmfnYDRcVrM56rDbaoxgwQIVMn.jpg', 1),
(1, 'Beach Travel Guide', 'A travel guide for beach lovers.', 'storage/assets/blogs/8osXJNt3tWaXJVKmfnYDRcVrM56rDbaoxgwQIVMn.jpg', 1),
(1, 'Delicious Foods at the Beaches', 'Explore the delicious dishes you must try when visiting the beach.', 'storage/assets/blogs/8osXJNt3tWaXJVKmfnYDRcVrM56rDbaoxgwQIVMn.jpg', 1),
(1, 'History and Culture of Beaches', 'Learn about the history and culture related to famous beaches.', 'storage/assets/blogs/8osXJNt3tWaXJVKmfnYDRcVrM56rDbaoxgwQIVMn.jpg', 1);

INSERT INTO blog_feedbacks (user_id, blog_id, rating, comment) VALUES
(1, 1, 5, 'Absolutely loved this blog! The beaches in Vietnam are breathtaking.'),
(2, 2, 4, 'Great tips on fun activities. I can\'t wait to try them!'),
(1, 3, 3, 'The travel guide is helpful, but I wish there were more photos.'),
(3, 4, 5, 'I tried the recommended dishes at the beach, and they were amazing!'),
(2, 5, 4, 'Interesting read about the history. Would love to learn more.'),
(1, 6, 2, 'I expected more details on the blog. It felt a bit lacking.');
