CREATE TABLE registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female') NOT NULL
);

CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    art_name VARCHAR(100) DEFAULT 'UNTITLED',
    image_data MEDIUMTEXT NOT NULL,  -- base64 image
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_user
        FOREIGN KEY (user_id)
        REFERENCES registration(id)
        ON DELETE CASCADE
);



--796f75726d6f6d