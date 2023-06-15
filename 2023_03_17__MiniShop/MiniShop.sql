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
    Preis decimal(5,2),
    Anzahl int,
    Zeitpunkt timestamp,
    Primary Key (UserID, ArtID, Zeitpunkt),
    FOREIGN KEY (UserID) REFERENCES User (ID),
    FOREIGN KEY (ArtID) REFERENCES Artikel (ID)
);


-- Insert Testdata

INSERT INTO Kategorie (KatName) VALUES
('Electronics'),
('Clothing'),
('Books');

INSERT INTO Artikel (ArtName, Preis, Bild, KatID) VALUES
('iPhone X', 799.99, 'https://m.media-amazon.com/images/I/618FhkCB0ZL._AC_SL1500_.jpg', 1),
('T-shirt', 19.99, 'https://m.media-amazon.com/images/I/618FhkCB0ZL._AC_SL1500_.jpg', 2),
('The Great Gatsby', 12.99, 'https://m.media-amazon.com/images/I/618FhkCB0ZL._AC_SL1500_.jpg', 3);
