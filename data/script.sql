#CREATE DATABASE IF NOT EXISTS `auto-sale-ads` CHARACTER SET utf8 COLLATE utf8_general_ci;
#USE `auto-sale-ads`;

CREATE TABLE advertisement
(
  id          INT AUTO_INCREMENT
    PRIMARY KEY,
  content     MEDIUMTEXT   NULL,
  description VARCHAR(255) NULL,
  dateCreate  DATETIME     NOT NULL,
  dateUpdate  DATETIME     NOT NULL,
  carId       INT          NOT NULL,
  price       INT          NOT NULL,
  userId      INT          NULL,
  CONSTRAINT UNIQ_C95F6AEEA73B87D5
  UNIQUE (carId)
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

INSERT INTO advertisement (id, content, description, dateCreate, dateUpdate, carId, price, userId) VALUES (1, null, null, '2017-11-26 19:11:34', '2017-11-27 08:09:41', 2, 1500000, null);
INSERT INTO advertisement (id, content, description, dateCreate, dateUpdate, carId, price, userId) VALUES (2, null, null, '2017-11-26 20:14:34', '2017-11-27 06:00:42', 3, 1300000, null);
INSERT INTO advertisement (id, content, description, dateCreate, dateUpdate, carId, price, userId) VALUES (4, null, null, '2017-11-26 20:30:37', '2017-11-27 05:10:00', 5, 120000, null);
INSERT INTO advertisement (id, content, description, dateCreate, dateUpdate, carId, price, userId) VALUES (5, null, null, '2017-11-26 20:48:05', '2017-11-27 05:59:32', 6, 265000, null);
INSERT INTO advertisement (id, content, description, dateCreate, dateUpdate, carId, price, userId) VALUES (6, null, null, '2017-11-27 05:56:42', '2017-11-27 05:56:42', 7, 375000, null);

CREATE TABLE car
(
  id          INT AUTO_INCREMENT
    PRIMARY KEY,
  brandId     INT          NOT NULL,
  modelId     INT          NOT NULL,
  bodyTypeId  INT          NOT NULL,
  yearIssue   INT          NOT NULL,
  mileage     INT          NOT NULL,
  buildId     INT          NOT NULL,
  description VARCHAR(255) NULL
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

CREATE INDEX IDX_773DE69D9CBEC244
  ON car (brandId);

CREATE INDEX IDX_773DE69DC44CFA21
  ON car (modelId);

CREATE INDEX IDX_773DE69DB589F9F2
  ON car (bodyTypeId);

CREATE INDEX IDX_773DE69D1BC271B6
  ON car (buildId);

ALTER TABLE advertisement
  ADD CONSTRAINT FK_C95F6AEEA73B87D5
FOREIGN KEY (carId) REFERENCES car (id);

INSERT INTO car (id, brandId, modelId, bodyTypeId, yearIssue, mileage, buildId, description) VALUES (2, 1, 6, 2, 2004, 200, 3, null);
INSERT INTO car (id, brandId, modelId, bodyTypeId, yearIssue, mileage, buildId, description) VALUES (3, 2, 11, 4, 2013, 75, 2, 'Черный, климат контроль, ABS');
INSERT INTO car (id, brandId, modelId, bodyTypeId, yearIssue, mileage, buildId, description) VALUES (5, 3, 16, 1, 2004, 202, 2, 'Серый металлик, климат контроль, кондиционер, блокировка задних дверей, обогрев зеркал, ABS, датчик дождя, датчик света, двигатель 1.6i');
INSERT INTO car (id, brandId, modelId, bodyTypeId, yearIssue, mileage, buildId, description) VALUES (6, 4, 21, 1, 2007, 155, 2, '1.8 л, 125 л.с., бензин, коробка механическая, привод передний, цвет серебристый');
INSERT INTO car (id, brandId, modelId, bodyTypeId, yearIssue, mileage, buildId, description) VALUES (7, 5, 29, 1, 2011, 110, 2, 'Коробка механическая, Привод передний, ПТС оригинал, цвет черный,     1.6 л, 123 л.с., бензин');

CREATE TABLE car_body_type
(
  id   INT AUTO_INCREMENT
    PRIMARY KEY,
  name VARCHAR(42) NOT NULL
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

ALTER TABLE car
  ADD CONSTRAINT FK_773DE69DB589F9F2
FOREIGN KEY (bodyTypeId) REFERENCES car_body_type (id);

INSERT INTO car_body_type (id, name) VALUES (1, 'седан');
INSERT INTO car_body_type (id, name) VALUES (2, 'хетчбэк');
INSERT INTO car_body_type (id, name) VALUES (3, 'кроссовер');
INSERT INTO car_body_type (id, name) VALUES (4, 'внедорожник');
INSERT INTO car_body_type (id, name) VALUES (5, 'универсал');
INSERT INTO car_body_type (id, name) VALUES (6, 'купе');
INSERT INTO car_body_type (id, name) VALUES (7, 'минивен');
INSERT INTO car_body_type (id, name) VALUES (8, 'пикап');
INSERT INTO car_body_type (id, name) VALUES (9, 'лимузин');
INSERT INTO car_body_type (id, name) VALUES (10, 'фургон');
INSERT INTO car_body_type (id, name) VALUES (11, 'кабриолет');

CREATE TABLE car_brand
(
  id   INT AUTO_INCREMENT
    PRIMARY KEY,
  name VARCHAR(42) NOT NULL
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

ALTER TABLE car
  ADD CONSTRAINT FK_773DE69D9CBEC244
FOREIGN KEY (brandId) REFERENCES car_brand (id);

INSERT INTO car_brand (id, name) VALUES (1, 'Audi');
INSERT INTO car_brand (id, name) VALUES (2, 'BMW');
INSERT INTO car_brand (id, name) VALUES (3, 'Citroen');
INSERT INTO car_brand (id, name) VALUES (4, 'Ford');
INSERT INTO car_brand (id, name) VALUES (5, 'Hyundai');

CREATE TABLE car_build
(
  id   INT AUTO_INCREMENT
    PRIMARY KEY,
  name VARCHAR(42) NOT NULL
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

ALTER TABLE car
  ADD CONSTRAINT FK_773DE69D1BC271B6
FOREIGN KEY (buildId) REFERENCES car_build (id);

INSERT INTO car_build (id, name) VALUES (1, 'новый');
INSERT INTO car_build (id, name) VALUES (2, 'не требует ремонта');
INSERT INTO car_build (id, name) VALUES (3, 'требует ремонта');
INSERT INTO car_build (id, name) VALUES (4, 'на запчасти');

CREATE TABLE car_model
(
  id      INT AUTO_INCREMENT
    PRIMARY KEY,
  name    VARCHAR(42) NOT NULL,
  brandId INT         NOT NULL,
  CONSTRAINT FK_83EF70E9CBEC244
  FOREIGN KEY (brandId) REFERENCES car_brand (id)
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

CREATE INDEX IDX_83EF70E9CBEC244
  ON car_model (brandId);

ALTER TABLE car
  ADD CONSTRAINT FK_773DE69DC44CFA21
FOREIGN KEY (modelId) REFERENCES car_model (id);

INSERT INTO car_model (id, name, brandId) VALUES (1, '80', 1);
INSERT INTO car_model (id, name, brandId) VALUES (2, 'A3', 1);
INSERT INTO car_model (id, name, brandId) VALUES (3, 'A4', 1);
INSERT INTO car_model (id, name, brandId) VALUES (4, 'A5', 1);
INSERT INTO car_model (id, name, brandId) VALUES (5, 'A6', 1);
INSERT INTO car_model (id, name, brandId) VALUES (6, 'Q3', 1);
INSERT INTO car_model (id, name, brandId) VALUES (7, 'Q5', 1);
INSERT INTO car_model (id, name, brandId) VALUES (8, 'Q7', 1);
INSERT INTO car_model (id, name, brandId) VALUES (9, 'X1', 2);
INSERT INTO car_model (id, name, brandId) VALUES (10, 'X3', 2);
INSERT INTO car_model (id, name, brandId) VALUES (11, 'X4', 2);
INSERT INTO car_model (id, name, brandId) VALUES (12, 'X5', 2);
INSERT INTO car_model (id, name, brandId) VALUES (13, 'X6', 2);
INSERT INTO car_model (id, name, brandId) VALUES (14, 'Berlingo', 3);
INSERT INTO car_model (id, name, brandId) VALUES (15, 'C-Crosser', 3);
INSERT INTO car_model (id, name, brandId) VALUES (16, 'C3', 3);
INSERT INTO car_model (id, name, brandId) VALUES (17, 'C3-Picasso', 3);
INSERT INTO car_model (id, name, brandId) VALUES (18, 'C4', 3);
INSERT INTO car_model (id, name, brandId) VALUES (19, 'C5', 3);
INSERT INTO car_model (id, name, brandId) VALUES (20, 'DS4', 3);
INSERT INTO car_model (id, name, brandId) VALUES (21, 'Focus', 4);
INSERT INTO car_model (id, name, brandId) VALUES (22, 'Kuga', 4);
INSERT INTO car_model (id, name, brandId) VALUES (23, 'Fiesta', 4);
INSERT INTO car_model (id, name, brandId) VALUES (24, 'Fusion', 4);
INSERT INTO car_model (id, name, brandId) VALUES (25, 'Mondeo', 4);
INSERT INTO car_model (id, name, brandId) VALUES (26, 'Explorer', 4);
INSERT INTO car_model (id, name, brandId) VALUES (27, 'Creta', 5);
INSERT INTO car_model (id, name, brandId) VALUES (28, 'Elantra', 5);
INSERT INTO car_model (id, name, brandId) VALUES (29, 'Solaris', 5);
INSERT INTO car_model (id, name, brandId) VALUES (30, 'Sonata', 5);
INSERT INTO car_model (id, name, brandId) VALUES (31, 'Tucson', 5);

CREATE TABLE role
(
  id   INT AUTO_INCREMENT
    PRIMARY KEY,
  name VARCHAR(42) NOT NULL
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

CREATE TABLE user
(
  id      INT AUTO_INCREMENT
    PRIMARY KEY,
  name    VARCHAR(42)  NOT NULL,
  email   VARCHAR(42)  NOT NULL,
  phone   VARCHAR(42)  NOT NULL,
  address VARCHAR(255) NOT NULL,
  roleId  INT          NOT NULL,
  CONSTRAINT FK_8D93D649B8C2FD88
  FOREIGN KEY (roleId) REFERENCES role (id)
)
  ENGINE = InnoDB
  COLLATE = utf8_unicode_ci;

CREATE INDEX IDX_8D93D649B8C2FD88
  ON user (roleId);


