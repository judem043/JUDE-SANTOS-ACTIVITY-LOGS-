create table search_users_data (
	id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	email VARCHAR(255),
	gender VARCHAR(255),
	expertise VARCHAR(255),
	yearsOfExperience VARCHAR(255),
	nationality VARCHAR(255),
	address VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    email VARCHAR(255) NOT NULL UNIQUE

);
