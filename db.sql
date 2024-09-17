-- Set autocommit to ON
SET @@AUTOCOMMIT = 1;

-- Drop the 'care' database if it exists, then create it
DROP DATABASE IF EXISTS care;
CREATE DATABASE care;

-- Use the 'care' database
USE care;

-- Create the 'Therapist' table first
CREATE TABLE Therapist(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Create 'User' table with correct foreign key references and structure
CREATE TABLE User(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    daily_sleep_hours INT NOT NULL DEFAULT 6,
    sleep_hours_logs INT NOT NULL DEFAULT 0,
    therapist INT NOT NULL,
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_visit TIMESTAMP NULL, 
    needs_followup BOOLEAN NOT NULL DEFAULT 0,
    diaries VARCHAR(200) NULL,
    notes INT NULL,
    CONSTRAINT fk_user_therapist FOREIGN KEY (therapist) REFERENCES Therapist(id)
) AUTO_INCREMENT = 1;

-- Create the 'Notes' table with unique foreign key names
CREATE TABLE Notes(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user INT NOT NULL,
    therapist INT NOT NULL,
    note VARCHAR(200) NOT NULL,
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_notes_user FOREIGN KEY (user) REFERENCES User(id),
    CONSTRAINT fk_notes_therapist FOREIGN KEY (therapist) REFERENCES Therapist(id)
);

-- Create the 'Medication' table with unique foreign key names
CREATE TABLE Medication (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    medicine VARCHAR(100) NOT NULL,
    dose VARCHAR(100) NOT NULL,
    dose_per_day INT NOT NULL,
    dose_daily_logs INT NOT NULL DEFAULT 0,
    dose_weekly_logs INT NOT NULL DEFAULT 0,
    updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user INT NOT NULL,
    therapist INT NOT NULL,
    CONSTRAINT fk_medication_user FOREIGN KEY (user) REFERENCES User(id),
    CONSTRAINT fk_medication_therapist FOREIGN KEY (therapist) REFERENCES Therapist(id)
);

-- Create the 'Exercise' table with unique foreign key names
CREATE TABLE Exercise(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    exercise_type VARCHAR(100) NOT NULL,
    daily_duration INT NOT NULL DEFAULT 0,
    weekly_logs INT NOT NULL DEFAULT 0,
    user INT NOT NULL,
    CONSTRAINT fk_exercise_user FOREIGN KEY (user) REFERENCES User(id)
);

-- Create a user (if it doesn't exist) and grant privileges
REPAIR TABLE mysql.db;
CREATE USER IF NOT EXISTS 'dbadmin'@'localhost';
GRANT ALL PRIVILEGES ON care.* TO 'dbadmin'@'localhost';
FLUSH PRIVILEGES;

-- Insert therapist data
INSERT INTO Therapist (name, email, password) 
VALUES ('Millisa Anderson', 'milandr@gmail.com', 'password');

-- Insert user data
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit, diaries) 
VALUES ('Melly Carter', 'melcart@gmail.com', 7, 4, 1, NOW() - INTERVAL 2 DAY, 'melly_carter1.docx');
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit, diaries) 
VALUES ('William Anderson', 'wilander@gmail.com', 6, 7, 1, NOW() - INTERVAL 4 DAY, 'will_ander1.docx');
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit, diaries) 
VALUES ('Joseph Williams', 'joswil@gmail.com', 6, 2, 1, NOW() - INTERVAL 9 DAY, 'jose_will1.docx');
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Kerry Williams', 'kerwil@gmail.com', 6, 6, 1, NOW() - INTERVAL 11 DAY);
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Nomi Loue', 'nomlou@gmail.com', 6, 3, 1, NOW() - INTERVAL 10 DAY);
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Simon Colins', 'simcol@gmail.com', 8, 3, 1, NOW() - INTERVAL 8 DAY);
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Micheal Simon', 'micsim@gmail.com', 8, 6, 1, NOW() - INTERVAL 18 DAY);
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Kerry Simon', 'kersim@gmail.com', 8, 2, 1, NOW() - INTERVAL 12 DAY);
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Georgina Tally', 'geortal@gmail.com', 6, 4, 1, NOW() - INTERVAL 2 DAY);
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Emma William', 'emawil@gmail.com', 6, 7, 1, NOW() - INTERVAL 21 DAY);
INSERT INTO User (name, email, daily_sleep_hours, sleep_hours_logs, therapist, last_visit) 
VALUES ('Boler William', 'bolwil@gmail.com', 6, 7, 1, NOW() - INTERVAL 13 DAY);

-- Insert notes data
INSERT INTO Notes (user, therapist, note) VALUES (1, 1, 'melly_carter1.docx');

-- Insert medication data
INSERT INTO Medication(medicine, dose, dose_per_day, dose_daily_logs, dose_weekly_logs, user, therapist)
VALUES ('medicine 1', '35 mg', 2, 1, 5, 1, 1);
INSERT INTO Medication(medicine, dose, dose_per_day, dose_daily_logs, dose_weekly_logs, user, therapist)
VALUES ('medicine 2', '20 mg', 1, 1, 7, 3, 1);
INSERT INTO Medication(medicine, dose, dose_per_day, dose_daily_logs, dose_weekly_logs, user, therapist)
VALUES ('medicine 3', '50 mg', 3, 2, 7, 1, 1);
INSERT INTO Medication(medicine, dose, dose_per_day, dose_daily_logs, dose_weekly_logs, user, therapist)
VALUES ('medicine 4', '10 mg', 4, 4, 3, 2, 1);

-- Insert exercise data
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('running', 30, 5, 1);
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('swimming', 60, 5, 1);
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('other', 10, 5, 1);
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('boxing', 30, 5, 2);
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('running', 20, 5, 2);
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('mountain climbing', 60, 5, 2);
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('running', 30, 5, 3);
INSERT INTO Exercise(exercise_type, daily_duration, weekly_logs, user)
VALUES ('sky diving', 80, 7, 3);
