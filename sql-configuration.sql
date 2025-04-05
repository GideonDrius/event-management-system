-- Create the database
CREATE DATABASE db_DePedro_capstone;

-- Use the created database
USE db_DePedro_capstone;

-- Create users table
CREATE TABLE Users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM  ('admin', 'organizer', 'attendee') NOT NULL

);

CREATE TABLE Venues(

    venue_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(255) NOT NULL,
    capacity INT NOT NULL,
    availability_status BOOLEAN DEFAULT TRUE    
);

CREATE TABLE Events(

    event_id INT PRIMARY KEY AUTO_INCREMENT,
    organizer_id INT,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    date DATE NOT NULL,
    time TIME NOT NULL,
    venue_id INT,
    status VARCHAR(50),
    FOREIGN KEY (organizer_id) REFERENCES Users(user_id), 
    FOREIGN KEY (venue_id) REFERENCES Venues(venue_id),    
);

CREATE TABLE Vendors(

    vendor_id INT  PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    service_type VARCHAR(100) NOT NULL,
    contact_info VARCHAR(255)         
);

CREATE TABLE Event_Vendors(

    id INT  PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    vendor_id INT,
    FOREIGN KEY (event_id) REFERENCES Events(event_id),
    FOREIGN KEY (vendor_id) REFERENCES Vendors(event_id),          
);

CREATE TABLE Tickets(

    ticket_id INT  PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    price DECIMAL (10, 2) NOT NULL,
    ticket_type ENUM('VIP', 'Regular') NOT NULL,
    availability INT NOT NULL,
    FOREIGN KEY (event_id) REFERENCES Events(event_id)         
);

CREATE TABLE Purchases(

    purchase_id INT  PRIMARY KEY AUTO_INCREMENT,
    ticket_id INT,
    user_id INT,
    purchase_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    payment_status VARCHAR(50),
    FOREIGN KEY (ticket_id) REFERENCES Tickets(ticket_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),      
);

CREATE TABLE Feedback(

    feedback_id INT  PRIMARY KEY AUTO_INCREMENT,
    event_id INT,
    user_id INT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comments TEXT,
    FOREIGN KEY (event_id) REFERENCES Events(event_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),      
);
