-- Create Table users
CREATE TABLE users(
    user_id INT AUTO_INCREMENT,
    username VARCHAR(200),
    email VARCHAR (200),
    pass VARCHAR(200),
    repass VARCHAR(200),
    status VARCHAR(100),
    unique_id TEXT,
    user_img TEXT,
    PRIMARY KEY (user_id)
    )