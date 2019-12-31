CREATE DATABASE wordpress;
CREATE USER 'wp_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL ON wordpress.* TO 'wp_user'@'localhost' ;
FLUSH PRIVILEGES;
