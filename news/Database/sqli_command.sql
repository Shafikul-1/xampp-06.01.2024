-- Database Create Command
CREATE DATABASE news;

-- TAble Create Command
CREATE TABLE users (
    id INT NOT NULL	AUTO_INCREMENT,
    username VARCHAR(200) NOT NULL ,
    email VARCHAR(200),
    password VARCHAR(400),
    number INT,
    gender VARCHAR(100),
    role INT,
    date VARCHAR(200),
    PRIMARY KEY (id)
);

-- Insert Users Table => admin user
INSERT INTO users (username, email, password, number, gender, role)  VALUES ('admin', 'admin@gmail.com', 'f8450a97cc7e38e6d109425c87b41634', '01756867220', '1', '1')

-- Create Table Category 
CREATE TABLE category (
    category_id INT AUTO_INCREMENT,
    category_name VARCHAR (200),
    post VARCHAR(100),
    PRIMARY KEY (category_id)
)

-- Insert Data Category Table
INSERT INTO category (category_name, post) VALUES 
('islam', '0'),
('sport', '0'),
('entenment', '0'),
('business', '0'),
('marketing', '0')

-- Create Table Post
CREATE TABLE post (
    post_id INT AUTO_INCREMENT,
   	title VARCHAR(400),
    description VARCHAR(25535),
    category INT,
    post_date VARCHAR(100),
    author INT,
    post_img VARCHAR(400),
    dir_num VARCHAR(100),
    PRIMARY KEY (post_id)
)

-- Join Query UserName & Author
SELECT * FROM post 
LEFT JOIN category ON post.category = category.category_id 
LEFT JOIN users ON post.author = users.id;


-- Settings Table
CREATE TABLE setting (
    id INT AUTO_INCREMENT,
    title VARCHAR (100),
    fav_icon VARCHAR(200),
    logo VARCHAR(200),
    footer_des varchar(200),
    PRIMARY KEY (id)
)

-- Post Feed Back 
CREATE TABLE feedback(
    feedback_user_id INT AUTO_INCREMENT,
    feedback_user_name VARCHAR(100),
    feedback_user_email VARCHAR(200),
    feedback_user_comment VARCHAR(500),
    post_id INT,
    PRIMARY KEY (feedback_user_id)
)