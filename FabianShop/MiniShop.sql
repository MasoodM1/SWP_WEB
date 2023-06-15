drop database if exists MiniShop;
create database if not exists MiniShop;
use MiniShop;
drop table if exists User;
create table if not exists User (
    ID int not null Primary Key auto_increment,
    Username varchar(50),
    pwd varchar(50),
    email varchar(50)
);

drop table if exists Kategorie;
create table if not exists Kategorie (
    ID int not null Primary Key auto_increment,
    KatName varchar(50)
);

drop table if exists Artikel;
create table if not exists Artikel (
    ID int not null Primary Key auto_increment,
    ArtName varchar(50),
    Preis decimal(5, 2),
    Bild varchar(150),
    KatID int,
    FOREIGN KEY (KatID) REFERENCES Kategorie (ID)
);

drop table if exists Warenkorb;
create table if not exists Warenkorb (
    UserID int,
    ArtID int,
    Preis decimal(5, 2),
    Anzahl int,
    Primary Key(UserID, ArtID),
    FOREIGN KEY (UserID) REFERENCES User(ID),
    FOREIGN KEY (ArtID) REFERENCES Artikel(ID)
);

drop table if exists gekaufteArtikel;
create table if not exists gekaufteArtikel (
    UserID int,
    ArtID int,
    ArtName varchar(50),
    Bild varchar(50),
    Preis decimal(5,2),
    Anzahl int,
    Zeitpunkt timestamp,
    Primary Key (UserID, ArtID, Zeitpunkt),
    FOREIGN KEY (UserID) REFERENCES User (ID),
    FOREIGN KEY (ArtID) REFERENCES Artikel (ID)
);


-- Insert Testdata

INSERT INTO User (Username, pwd, email) VALUES
('test', '12345678', 'test@mail.com');

INSERT INTO Kategorie (KatName) VALUES
('Laptops'),
('Handys'),
('Tablets');

INSERT INTO Artikel (ArtName, Preis, Bild, KatID) VALUES
('MacBook Pro', 799.99, 'Bilder/MacBookPro.png', 1),
('iPhone 14', 1109.99, 'Bilder/iPhone14.png', 2),
('Galaxy Tab S6', 649.99, 'Bilder/GalaxyTabS6.png', 3);

INSERT INTO gekaufteArtikel (UserID, ArtID, ArtName, Bild, Preis, Anzahl, Zeitpunkt) VALUES
(1, 1, 'MacBook Pro', 'Bilder/MacBookPro.png', 799.99, 3, now());
