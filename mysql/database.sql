DROP TABLE _user;
DROP TABLE discussion;
DROP TABLE message;
DROP TABLE stream;
DROP TABLE product;
DROP TABLE game;

CREATE TABLE _user (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE discussion (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    _user VARCHAR(50) NOT NULL REFERENCES _user(name),
    lastTime DATETIME NOT NULL,
    type INT NOT NULL
);

CREATE TABLE message (
    id INT NOT NULL,
    discussion INT NOT NULL REFERENCES discussion(id),
    responding INT NOT NULL,
    _user VARCHAR(50) NOT NULL REFERENCES _user(name),
    content VARCHAR(500) NOT NULL,
    PRIMARY KEY(id, discussion)
);

CREATE TABLE stream (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    platform INT NOT NULL,
    link VARCHAR(100) NOT NULL,
    _user VARCHAR(50) NOT NULL REFERENCES _user(name),
    discussion INT NOT NULL REFERENCES discussion(id)
);

CREATE TABLE product(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    _user VARCHAR(50) NOT NULL REFERENCES _user(name),
    type VARCHAR(10) NOT NULL,
    description VARCHAR(240) NOT NULL,
    link VARCHAR(450)
);

CREATE TABLE game(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    _user VARCHAR(50) NOT NULL REFERENCES _user(name),
    description VARCHAR(240) NOT NULL,
    releaseDate DATE NOT NULL,
    genre VARCHAR(50) NOT NULL,
    physical BOOLEAN NOT NULL,
    digital BOOLEAN NOT NULL, 
    visits INT NOT NULL,
    link VARCHAR(450)
);

INSERT INTO game VALUES( 0, "Devil May Cry", 4.99, "Andres", "Killing Demons for Cash", "2020-04-12", "action", FALSE , TRUE, 0, NULL);
INSERT INTO game VALUES( 0, "Hades", 25.99, "Andres", "Swords and Sandals", "2021-05-11", "adventure", FALSE , TRUE, 0, NULL);
INSERT INTO game VALUES( 0, "Cowboy Bebop", 22.00, "Andres", "Space Cowboys", "2021-03-05", "action", TRUE , FALSE, 0, NULL);
INSERT INTO game VALUES( 0, "Evangelion", 10.00, "Andres", "Robot Bible", "2021-05-01", "horror", TRUE , TRUE, 0, NULL);

INSERT INTO discussion VALUES (1, "Discussion 1", "User 1", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 1, 0, "User 1", "Message 1");
INSERT INTO message VALUES (2, 1, 0, "User 2", "Message 2");
INSERT INTO message VALUES (3, 1, 1, "User 3", "Message 3");
INSERT INTO message VALUES (4, 1, 3, "User 4", "Message 4");
INSERT INTO message VALUES (5, 1, 0, "User 5", "Message 5");
INSERT INTO message VALUES (6, 1, 0, "User 6", "Message 6");
INSERT INTO message VALUES (7, 1, 0, "User 7", "Message 7");
INSERT INTO message VALUES (8, 1, 0, "User 8", "Message 8");
INSERT INTO message VALUES (9, 1, 6, "User 9", "Message 9");
INSERT INTO message VALUES (10, 1, 0, "User 10", "Message 10");
INSERT INTO message VALUES (11, 1, 0, "User 11", "Message 11");

INSERT INTO discussion VALUES (2, "Discussion 2", "User 2", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 2, 0, "User 1"," Message 1");
INSERT INTO message VALUES (2, 2, 0, "User 2", "Message 2");
INSERT INTO message VALUES (3, 2, 0, "User 3", "Message 3");

INSERT INTO discussion VALUES (3, "Discussion 3", "User 3", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 3, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (4, "Discussion 4", "User 4", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 4, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (5, "Discussion 5", "User 5", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 5, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (6, "Discussion 6", "User 6", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 6, 0, "User 6", "Message 1");
INSERT INTO message VALUES (2, 6, 0, "User 3"," Message 2");
INSERT INTO message VALUES (3, 6, 2, "User 4", "Message 3");
INSERT INTO message VALUES (4, 6, 0, "User 5", "Message 4");

INSERT INTO discussion VALUES (7, "Discussion 7", "User 7", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 7, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (8, "Discussion 8", "User 8", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 8, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (9, "Discussion 9", "User 9", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 9, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (10, "Discussion 10", "User 10", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 10, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (11, "Discussion 11", "User 11", "2021-04-13 15:00:00", 0);
INSERT INTO message VALUES (1, 11, 0, "User 1", "Message 1");

INSERT INTO discussion VALUES (12, "Comments", "User 1", "2021-04-13 15:00:00", 1);
INSERT INTO message VALUES (1, 12, 0, "User 1", "Message 1");
INSERT INTO stream VALUES (1, "Facebook", 1, "1131916223489418", "User 1", 12);
