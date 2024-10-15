USE watcher_db;

DROP TABLE IF EXISTS Utilization;
DROP TABLE IF EXISTS Logging;
DROP TABLE IF EXISTS Viewing;
DROP TABLE IF EXISTS UsageHistory;
DROP TABLE IF EXISTS ViewedContent;
DROP TABLE IF EXISTS Application;
DROP TABLE IF EXISTS Device;
DROP TABLE IF EXISTS Child;
DROP TABLE IF EXISTS Guardian;

CREATE TABLE Guardian(
   guardian_id INT,
   email VARCHAR(200) NOT NULL,
   phone VARCHAR(200),
   name VARCHAR(200) NOT NULL,
   firstname VARCHAR(200) NOT NULL,
   password VARCHAR(200) NOT NULL,
   gender INT,
   lang VARCHAR(200) NOT NULL,
   PRIMARY KEY(guardian_id),
   UNIQUE(email),
   UNIQUE(phone)
);

CREATE TABLE Child(
   child_id VARCHAR(50),
   name VARCHAR(200) NOT NULL,
   firstname VARCHAR(200) NOT NULL,
   gender INT NOT NULL,
   birthdate DATE NOT NULL,
   guardian_id INT NOT NULL,
   PRIMARY KEY(child_id),
   FOREIGN KEY(guardian_id) REFERENCES Guardian(guardian_id)
);

CREATE TABLE Device(
   device_id VARCHAR(50),
   name VARCHAR(50) NOT NULL,
   type INT NOT NULL,
   child_id VARCHAR(50) NOT NULL,
   PRIMARY KEY(device_id),
   FOREIGN KEY(child_id) REFERENCES Child(child_id)
);

CREATE TABLE Application(
   app_id VARCHAR(50),
   name VARCHAR(50) NOT NULL,
   category INT NOT NULL,
   age_rating INT NOT NULL,
   PRIMARY KEY(app_id)
);

CREATE TABLE UsageHistory(
   history_id VARCHAR(50),
   usage_date DATE NOT NULL,
   usage_time_ INT,
   PRIMARY KEY(history_id)
);

CREATE TABLE ViewedContent(
   content_id VARCHAR(50),
   title VARCHAR(50) NOT NULL,
   url VARCHAR(50),
   view_date DATE,
   PRIMARY KEY(content_id)
);

CREATE TABLE Utilization(
   child_id VARCHAR(50),
   app_id VARCHAR(50),
   PRIMARY KEY(child_id, app_id),
   FOREIGN KEY(child_id) REFERENCES Child(child_id),
   FOREIGN KEY(app_id) REFERENCES Application(app_id)
);

CREATE TABLE Logging(
   device_id VARCHAR(50),
   app_id VARCHAR(50),
   history_id VARCHAR(50),
   PRIMARY KEY(device_id, app_id, history_id),
   FOREIGN KEY(device_id) REFERENCES Device(device_id),
   FOREIGN KEY(app_id) REFERENCES Application(app_id),
   FOREIGN KEY(history_id) REFERENCES UsageHistory(history_id)
);

CREATE TABLE Viewing(
   child_id VARCHAR(50),
   app_id VARCHAR(50),
   content_id VARCHAR(50),
   PRIMARY KEY(child_id, app_id, content_id),
   FOREIGN KEY(child_id) REFERENCES Child(child_id),
   FOREIGN KEY(app_id) REFERENCES Application(app_id),
   FOREIGN KEY(content_id) REFERENCES ViewedContent(content_id)
);

INSERT INTO Guardian (guardian_id, email, phone, name, firstname, password, gender, lang)
VALUES 
(1, '$2y$10$qiPU6ZUn5vuSbL4ShZN8K.M/9teCkbY2KUlYCIcVp9Q5ciaL40c.i', '$2y$10$ig49PtBierXF8wkOkiR11.GZgXs3U1n2PC2S3fOix3WqG38VFz5Oq', '$2y$10$LsyxLw7uG6ZE4i/mySFsh..JGP6VQgqQad3z2DCxrqQkI8dQsZGh.', '$2y$10$C7XQVBhNYvazVZufDwogiuiF6tcJt2gvtH3R21wusk2NY8qif5H9e', '$2y$10$qHJUef1mMLl3aZOiObFOf.FDE5zc5pAhh7vMHglwMahrPs3BD3OEC', 1, '$2y$10$oxahobxnIfZsznV1S2dMVepIxj/8kwFPmBVO2c7vW1utAX9AY5QrK'),
(2, '$2y$10$j5Yn0LLgotN4AarfAlLXGOiUcTIcv.RnxBu8Sa9EeYpZQsT4kmCBK', '$2y$10$LgdlMrEPgqq.DVCZEL9M9OI1NQ8MrRY3t81r6yxLG13sjhUv1ri8K', '$2y$10$UBWQWuod2cZ772eNhv6LYOqVdCNBulvlJFl2h3LRM8ZaFhe3eH9mC', '$2y$10$07WJiJYyfkQ9iEeJ8rI8iu4r8EfelG5Tuxuy3jGM8CqEt73WYnzBK', '$2y$10$Ysm.atLGHgtY2wZK.EI7MOdXjhGJLTqR92gN7xhnGIEWP8Pbdy1Pq', 2, '$2y$10$8b3Hqm5UeFjpRu4F4bOH/.kWE97.gKiL7.nzJkfPrx/WdyDkgpPpu');

INSERT INTO Child (child_id, name, firstname, gender, birthdate, guardian_id)
VALUES 
('C001', '$2y$10$XE1MqgGw0QI5z1bflIK13Oo2lGKt3G0xmS/CIKlZngDd9K.PQcnr6', '$2y$10$ZbVKfUvnEwi8a/E.1GQUGOv77yMFy8Cuy/UNTZOu5UYa9MSNWDvAO', 1, '2012-06-15', 1),
('C002', '$2y$10$KGbdz16SKsUDGhnM5oNFquH/rebLa9vY1q94Tm34mcWq5TlQ/pK8C', '$2y$10$d1/ES.E4PDPhu/3cl8zi3uaY5X79kHDXm1tT2czhlX0Zo6SXLVEFe', 2, '2010-09-22', 2);

INSERT INTO Device (device_id, name, type, child_id)
VALUES 
('D001', 'iPad', 1, 'C001'),
('D002', 'Samsung Galaxy', 2, 'C002');

INSERT INTO Application (app_id, name, category, age_rating)
VALUES 
('A001', 'YouTube Kids', 1, 3),
('A002', 'Minecraft', 2, 7);

INSERT INTO UsageHistory (history_id, usage_date, usage_time_)
VALUES 
('H001', '2024-01-15', 120),
('H002', '2024-01-16', 90);

INSERT INTO ViewedContent (content_id, title, url, view_date)
VALUES 
('V001', 'Educational Video', 'https://example.com/video1', '2024-01-15'),
('V002', 'Cartoon Episode', 'https://example.com/video2', '2024-01-16');

INSERT INTO Utilization (child_id, app_id)
VALUES 
('C001', 'A001'),
('C002', 'A002');

INSERT INTO Logging (device_id, app_id, history_id)
VALUES 
('D001', 'A001', 'H001'),
('D002', 'A002', 'H002');

INSERT INTO Viewing (child_id, app_id, content_id)
VALUES 
('C001', 'A001', 'V001'),
('C002', 'A002', 'V002');