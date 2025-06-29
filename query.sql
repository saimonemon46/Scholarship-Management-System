
-- Students Table
CREATE TABLE student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15),
    gpa FLOAT,
    password VARCHAR(255) NOT NULL
);
-- Insert values into the student table
INSERT INTO student (name, email, phone_number, gpa, password)
VALUES
    ('Saimon', 'khansaimon695@gmail.com', '01622015799', 3.8, '$2y$10$xEedkZZ4HK3Yh6eOr0Yd..2kX0IBvYaUY93x47pa7jNvyjMubGUv2'),
    ('Emon', 'saimonemon46@gmail.com', '01622015799', 3.5, '$2y$10$xEedkZZ4HK3Yh6eOr0Yd..2kX0IBvYaUY93x47pa7jNvyjMubGUv2');

-- Scholarships Table
CREATE TABLE scholarship (
    scholarship_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    amount DECIMAL(10,2),
    deadline DATE
);


-- Insert values into the scholarship table
INSERT INTO scholarship (name, amount, deadline)
VALUES
    ('Academic Excellence Scholarship', 5000.00, '2024-05-01'),
    ('Community Service Award', 3000.00, '2024-06-15'),
    ('STEM Scholars Grant', 7000.00, '2024-07-30'),
    ('Art and Design Scholarship', 2500.00, '2024-04-10');


-- Admin Table
CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15)
);

-- Insert a value into the admin table
INSERT INTO admin (name, email, password, phone_number)
VALUES ('Saimon Hasan', 'khansaimon695@gmail.com', '$2y$10$xEedkZZ4HK3Yh6eOr0Yd..2kX0IBvYaUY93x47pa7jNvyjMubGUv2', '01622015799');



-- Applications Table
CREATE TABLE application (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    scholarship_id INT NOT NULL,
    submission_date DATE NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    FOREIGN KEY (student_id) REFERENCES student(student_id),
    FOREIGN KEY (scholarship_id) REFERENCES scholarship(scholarship_id)
);



-- Create the 'fund' table
CREATE TABLE fund (
    fund_id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10, 2) NOT NULL,
    provider TEXT NOT NULL,
    date_added DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
-- Insert values into the fund table
INSERT INTO fund (amount, provider, date_added)
VALUES
    (10000.00, 'National Education Foundation', '2023-12-01 10:00:00'),
    (5000.50, 'Community Support Initiative', '2023-12-05 14:30:00'),
    (7500.75, 'Private Donor', '2023-12-10 09:15:00'),
    (12000.00, 'Corporate Grant Program', '2023-12-20 16:45:00'),
    (3000.00, 'Local Charity', '2023-12-25 12:00:00');

-- Create the 'balance' table
CREATE TABLE balance (
    id INT PRIMARY KEY AUTO_INCREMENT,  -- You need an 'id' column for identifying the row
    bal DECIMAL(15, 2) NOT NULL DEFAULT 0.00  -- This is the balance column, initially set to 0.00
);
INSERT INTO balance (bal) VALUES (0.00);







