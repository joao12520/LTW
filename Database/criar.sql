.mode columns
.headers on

-- Apaga as tabelas caso já existam (13 tabelas)

DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS OrderClient;
DROP TABLE IF EXISTS OrderItem;
DROP TABLE IF EXISTS OrderReview;
DROP TABLE IF EXISTS OrderStatus;
DROP TABLE IF EXISTS Menu_Item;
DROP TABLE IF EXISTS Menu_Item_Review;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Opening_Hours;
DROP TABLE IF EXISTS Restaurant_Review;
DROP TABLE IF EXISTS CreditCard;
DROP TABLE IF EXISTS RestaurantFavorite;

-- Criar as tabelas na base de dados

CREATE TABLE Client (
    clientID NUMBER PRIMARY KEY NOT NULL,
    username VARCHAR(30) UNIQUE NOT NULL,
    password VARCHAR(256) NOT NULL,
    address VARCHAR(30) NOT NULL,
    phoneNumber NUMBER UNIQUE CHECK (phoneNumber > 0), -- VERIFY THIS LATER
    nif NUMBER UNIQUE CHECK (nif > 0), 
    profilePhoto VARCHAR(50),
    isAdmin NUMBER NOT NULL /** BOOL 0 => false 1 => true **/
);

CREATE TABLE OrderClient (
    orderID NUMBER  NOT NULL,
    restaurantID REFERENCES Restaurant(restaurantID),
    clientID REFERENCES Client(clientID),
    orderStatus VARCHAR(30) -- RECEIVED / BEING PREPARED / COMPLETE / DELIVERING
);

CREATE TABLE OrderItem (
    itemID REFERENCES Menu_Item(itemID) NOT NULL,
    quantity NUMBER NOT NULL,
    orderID REFERENCES OrderClient(orderID) NOT NULL
);

CREATE TABLE OrderReview (

    orderID REFERENCES PlacedOrder(orderID) NOT NULL,
    score NUMBER CHECK (score >= 0 AND score <= 5),
    comment VARCHAR(150)
);

CREATE TABLE Menu_Item (

    itemID NUMBER PRIMARY KEY NOT NULL,

    nameMenuItem VARCHAR(30) NOT NULL,

    categoryID REFERENCES Category(categoryID),
    
    price NUMBER CHECK (price > 0),
    stock NUMBER CHECK (stock > 0),
    description VARCHAR(100) NOT NULL,

    photo VARCHAR(100) NOT NULL,
    restaurantID REFERENCES Restaurant(restaurantID)
    
);

CREATE TABLE Menu_Item_Review ( 

    itemID REFERENCES Menu_Item(itemID) NOT NULL,
    score NUMBER CHECK (score >= 0 AND score <= 5),
    comment VARCHAR(150)
);

CREATE TABLE Category (  

    categoryID NUMBER PRIMARY KEY NOT NULL,
    nameCategory VARCHAR(30) NOT NULL
);

CREATE TABLE Restaurant (

    restaurantID NUMBER PRIMARY KEY NOT NULL,
    name VARCHAR(30) NOT NULL,
    categoryID REFERENCES Category(categoryID), /** ALTERAR PARA CATEGORIA **/
    location VARCHAR(50) NOT NULL,
    photo VARCHAR(50) NOT NULL,
    clientID REFERENCES Client(clientID) NOT NULL /** OWNER **/
);

CREATE TABLE RestaurantFavorite (
    id NUMBER PRIMARY KEY NOT NULL,
    restaurantID REFERENCES Restaurant(restaurantID) NOT NULL,
    clientID REFERENCES Client(clientID) NOT NULL
);

CREATE TABLE Opening_Hours (

    restaurantID REFERENCES Restaurant(restaurantID) not null,
    opening TIME NOT NULL,
    closing TIME NOT NULL
);

CREATE TABLE Restaurant_Review ( 

    restaurantID REFERENCES Restaurant(restaurantID) NOT NULL,
    clientID REFERENCES Client(cliendID) NOT NULL,
    score NUMBER CHECK (score >= 0 AND score <= 5),
    comment VARCHAR(150),
    response VARCHAR(150)
);

CREATE TABLE CreditCard (
    cardNumber NUMBER UNIQUE PRIMARY KEY NOT NULL,
    expirationMonth VARCHAR(256) NOT NULL,
    expirationYear NUMBER NOT NULL,
    cvv VARCHAR(256) NOT NULL,
    clientID NUMBER REFERENCES Client(clientID) NOT NULL
);

/* CLIENTS */

INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (1, "Zediogo96", "c7a21a6be601b1f42a5da165c7cbdb25bb8c45eb6eb21f362d706444cfad5b87", "Rua Manuel Rocha Páris, Vereda 1, nº 30", 918072316, 223772674, "UserPhotos/1.jpg", 0);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (2, "AndreAvila", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1", "Rua Engenheiro Carvalho de Almada, nº2, 43", 968374324, 124475674, "UserPhotos/2.jpg", 1); 

/* Credit Cards */
INSERT INTO CreditCard(cardNumber, expirationMonth, expirationYear, cvv, clientID) VALUES (4000001234567899, 4, 23, "a3aaf5a0e9ad2901ab35ce73910be7fbbe1731a3ed1ff947a6ac395c5024a8b3", 1); 

/** OrderClient */
INSERT INTO OrderClient(orderID, restaurantID, clientID, orderStatus) VALUES (1, 1, 1, "Received");
INSERT INTO OrderClient(orderID, restaurantID, clientID, orderStatus) VALUES (2, 1, 2, "Being Prepared");

/** OrderItem */
INSERT INTO OrderItem(itemID, quantity, orderID) VALUES (1, 2, 1);
INSERT INTO OrderItem(itemID, quantity, orderID) VALUES (2, 1, 1);
INSERT INTO OrderItem(itemID, quantity, orderID) VALUES (11, 2, 2);
INSERT INTO OrderItem(itemID, quantity, orderID) VALUES (12, 1, 2);

/** OWNERS */

INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (4, "SrMachado4", "c7a21a6be601b1f42a5da165c7cbdb25bb8c45eb6eb21f362d706444cfad5b87", "Rua Joaquim António de Aguiar Ímpares de 1", 964324122, 0201233123,"UserPhotos/4.jpg", 1);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (5, "SrJoaquim5", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1","Rua Joaquim António de Aguiar Ímpares de 184", 964393812, 320049123,"UserPhotos/5.jpg", 1);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (6, "SrAlberto6", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1","Rua Senhora da Campanhã 105", 964100988, 301393040,"UserPhotos/6.jpg", 1);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto,isAdmin) VALUES (8, "ArmindaTorres1983", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1","Rua Linhas de Torres 41", 918103194, 303100102,"UserPhotos/7.jpg", 1);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (9, "AndréTavira9", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1","Rua Linhas de Torres 43", 913121133, 303100103,"UserPhotos/8.jpg", 1);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (10, "JoaquimMachado10", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1","Rua Linhas de Torres 44", 913404023, 303100104,"UserPhotos/9.jpg", 1);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto, isAdmin) VALUES (11, "DiogoCabelo11", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1","Rua Chaves de Oliveira 113", 913100001, 303100105,"UserPhotos/10.jpg", 1);
INSERT INTO Client(clientID, username, password, address, phoneNumber, nif, profilePhoto,isAdmin) VALUES (12, "Torres97", "599a4410e2af69d1585f16d82d4b5f0abf3ad09fa42b9d55d7b7a50671ccf8c1","Rua Doutor Lopo de Carvalho 30", 960908372, 303100106,"UserPhotos/11.jpg", 1);

/* RESTAURANTS */

INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (1, "McDonalds", 1, "Vila Nova de Gaia", "PhotosRestaurants/mcdonalds.jpg",4);
INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (2, "Sushi & Co", 2, "Cedofeita", "PhotosRestaurants/sushi&co.jpg",4);
INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (3, "TGB", 1, "São Bento", "PhotosRestaurants/TGB.jpg",6);
INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (4, "Nicolau (Porto)", 6, "Porto", "PhotosRestaurants/nicolau.jpg",7);
INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (5, "Italian Republic", 3, "Porto", "PhotosRestaurants/italianRepublic.jpg",8);
INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (6, "Tomatino", 3, "Via Catarina", "PhotosRestaurants/tomatino.jpg",9);
INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (7, "Pizza Hut", 3, "Vila Nova de Gaia", "PhotosRestaurants/pizzahut.jpg",10);
INSERT INTO Restaurant(restaurantID, name, categoryID, location, photo, clientID) VALUES (8, "Burger King", 1, "Vila Nova de Gaia", "PhotosRestaurants/bk.jpg",11);

/** OPENING HOURS */

INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (1, '08:30', '04:00');
INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (2, '09:00', '23:59');
INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (3, '10:00', '22:00');
INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (4, '09:30', '23:00');
INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (5, '09:00', '23:59');
INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (6, '10:00', '01:00');
INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (7, '11:30', '01:00');
INSERT INTO Opening_Hours(restaurantID, opening, closing) VALUES (8, '11:00', '02:00');

/* CATEGORY */

INSERT INTO Category(categoryID, nameCategory) VALUES (1, "Fast Food");
INSERT INTO Category(categoryID, nameCategory) VALUES (2, "Sushi");
INSERT INTO Category(categoryID, nameCategory) VALUES (3, "Italiano");
INSERT INTO Category(categoryID, nameCategory) VALUES (4, "Thailandese");
INSERT INTO Category(categoryID, nameCategory) VALUES (5, "Portuguese");
INSERT INTO Category(categoryID, nameCategory) VALUES (6, "Pequeno-Almoço");

/* Menu Items */

-- Restaurante 1 McDonalds */

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (1, "McRoyal Bacon", 1, 6.25, 100, "The sandwich that defies the most daring tastes with a 100% Grilled Beef Royal Burger, crispy bacon strips, and the signature McBacon™ sauce. A reference for bacon lovers.", "MenuRestPhotos/McDonalds/1.jpg", 1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (2, "McVeggie", 1, 6.25, 50, "What is a McVeggie? The McVeggie crumb-coated patty is made up of a mixed vegetable blend that includes potato (100 per cent Australian, yay), peas, corn, carrot and onion. It comes in a sesame seed bun with cheese, lettuce, herbs and spices, mayonnaise and of course, Macca's iconic pickles.", "MenuRestPhotos/McDonalds/2.jpg", 1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (3, "CBO", 1, 7.25, 30, "CBO (Chicken, Bacon and Onion) from France, a square bun topped with toasted onions and sesame seeds, bacon and pepper flavored cheese, two half strips of bacon, lettuce, crispy fried onion straws and McDonald's signature CBO sauce.", "MenuRestPhotos/McDonalds/3.jpeg",1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (4, "Grand Big Mac", 1, 7.5, 20, "Two 100% beef patties, a slice of cheese, lettuce, onion, pickles, and Big Mac® sauce in a sesame topped bun.", "MenuRestPhotos/McDonalds/4.jpg",1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (5, "McSpicy", 1, 5, 20, "Hot and spicy 100% chicken breast in a crispy coating, served with crunchy lettuce and a classic sandwich sauce. Served in a sesame seed bun.","MenuRestPhotos/McDonalds/5.jpg",1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (6, "Filet-o-fish", 1, 5.5, 35, "Delicious white Hoki or Pollock fish in crispy breadcrumbs, with cheese and tartare sauce, in a steamed bun. ", "MenuRestPhotos/McDonalds/6.jpeg" ,1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (7, "McChicken Sandwish", 1, 6.35, 40, "Crispy coated chicken with lettuce and our sandwich sauce, in a soft, sesame-topped bun. A true classic.", "MenuRestPhotos/McDonalds/7.jpg",1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (8, "CheeseBurger", 1, 2.15, 200, "Sometimes you just want to reach for a classic. A classic 100% beef patty, and cheese; with onions, pickles, mustard and a dollop of tomato ketchup, in a soft bun. Delicious.","MenuRestPhotos/McDonalds/8.jpeg", 1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (9, "Crispy McFillet", 1, 6.75, 20, "100% chicken breast fillet in a crispy, crunchy coating. Served with iceberg lettuce, black pepper mayo and a delicious sourdough-style sesame topped bun. ", "MenuRestPhotos/McDonalds/9.jpeg" , 1);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (10, "Chicken Legend", 1, 6.5, 60, "Succulent chicken breast fillet in a crispy coating, with lettuce and smoky BBQ sauce, all in a warm, toasted bakehouse roll. Simply delicious." , "MenuRestPhotos/McDonalds/10.jpeg",1);

-- Restaurante 2 Sushi & Co

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (11, "Crepes de Camarão", 2, 5, 80, "4 Unidades. Incluí molho agridoce", "MenuRestPhotos/Sushi&Co/1.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (12, "Menu 10 Peças", 2, 10, 30, "5 variedades de sushi frio fusão à escolha do sushiman. Inclui uramakis, futomakis, gunkans, soja, gengibre, wasabi e pauzinhos. Não inclui sashimi nem sushi quente.", "MenuRestPhotos/Sushi&Co/2.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (13, "Menu 16 Peças", 2, 15, 40, "8 variedades de sushi frio fusão à escolha do sushiman. Inclui uramakis, futomakis, gunkans, soja, gengibre, wasabi e pauzinhos. Não inclui sashimi nem sushi quente. Recomendado para 1 pessoa. ", "MenuRestPhotos/Sushi&Co/3.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (14, "Menu 24 Peças", 2, 20, 76, "8 variedades de sushi frio fusão à escolha do sushiman. Inclui uramakis, futomakis, gunkans, soja, gengibre, wasabi e pauzinhos. Não inclui sashimi nem sushi quente.", "MenuRestPhotos/Sushi&Co/4.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (15, "Menu Almoço ", 2, 10, 40, "7 variedades de sushi frio à escolha do sushiman. Inclui gengibre, wasabi, soja e pauzinhos. ", "MenuRestPhotos/Sushi&Co/5.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (16, "Hot Camarão ", 2, 8, 19, "5 peças de sushi quente com tempura de camarão e maionese japonesa.", "MenuRestPhotos/Sushi&Co/6.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (17, "Temaki de Atum com Filadélfia ", 2, 6.25, 53, "Cone de alga recheado com arroz de sushi, pedaços de atum com queijo Filadélfia, sésamo e cebolete. ", "MenuRestPhotos/Sushi&Co/7.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (18, "Sashimi Atum ", 2, 6, 51, "6 fatias. Acompanhado com molho de soja e Wasabi.", "MenuRestPhotos/Sushi&Co/8.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (19, "Nigiris de Salmão", 2, 5, 10, "Salmão de qualidade envolvido em pasta de arroz", "MenuRestPhotos/Sushi&Co/9.jpg", 2);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (20, "California Roll", 2, 7.5, 46, "8 uramakis com salmão, abacate, manga, queijo Filadélfia e sésamos.", "MenuRestPhotos/Sushi&Co/10.jpg", 2);


-- Restaurante 3 TGB

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (21, "TGB Burger", 1, 6.25, 46, "Pão, hamburguer com carne 100% bovino, alface, tomate, queijo americano, bacon e molho TGB", "MenuRestPhotos/TGB/1.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (22, "Cheeseburger", 1, 5.2, 10, "Pão, hamburguer com carne 100% bovino, alface, tomate, queijo americano e molho TGB", "MenuRestPhotos/TGB/2.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (23, "Truffle - Grande", 1, 7.5, 20, "Pão, hamburguer com carne 100% bovino, alface, queijo americano, cogumelos salteados, cebola caramelizada e maionese de trufa", "MenuRestPhotos/TGB/3.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (24, "Epic Chicken", 1, 6.5, 23, "250g de frango frito.", "MenuRestPhotos/TGB/4.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (25, "Pulled Pork Burger", 1, 6.2, 44, "Pão, carne de porco desfiada, aros de cebola e molho barbecue.", "MenuRestPhotos/TGB/5.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (26, "Blue Mountain - Grande", 1, 7.5, 35, "Pão, hamburger com carne 100% bovino, rúcula, queijo gorgonzola, bacon, cebola caramelizada e mostarda Horseradish", "MenuRestPhotos/TGB/6.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (27, "BBQ Burger - Grande", 1, 7.5, 68, "Pão, hamburger com carne 100% bovino, bacon, aros de cebola e molho barbecue", "MenuRestPhotos/TGB/7.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (28, "Frango Crunchy", 1, 9.5, 78, "Pão, peito de frango crocante (panado), queijo americano, alface, tomate e maionese", "MenuRestPhotos/TGB/8.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (29, "Big Box Burger", 1, 7.5, 10, "Inclui 6 burgers e 4 acompanhamentos à escolha", "MenuRestPhotos/TGB/9.jpg", 3);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (30, "BLT", 1, 7.5, 98, "Pão, peito de frango assado, alface, tomate, e molho TGB", "MenuRestPhotos/TGB/10.jpg", 3);

-- Restaurante 4 Nicolau (Porto)

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (31, "Ovos Nicolau", 6, 8.5, 60, "tosta c/abacate, ovos escalfados e granola salgada.", "MenuRestPhotos/Nicolau/1.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (32, "Panqueca Nicolau", 6, 8.2, 60, "Panqueca Nicolau.", "MenuRestPhotos/Nicolau/2.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (33, "French Toast Nicolau", 6, 6.5, 60, "C/ fruta fresca, iogurte, maple syrup e pistachios.", "MenuRestPhotos/Nicolau/3.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (34, "Taça de Açaí", 6, 7.2, 60, "Com fruta e a nossa granola.", "MenuRestPhotos/Nicolau/4.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (35, "Panqueca Red Velvet", 6, 8, 50, "Deliciosa panqueca com morangos e mirtílos.", "MenuRestPhotos/Nicolau/7.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (36, "Granola Nicolau", 6, 6, 45, "Com iogurte grego, mel e fruta.", "MenuRestPhotos/Nicolau/6.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (37, "Bagel Nicolau", 6, 7, 50, "Com queijo creme e salmão fumado.", "MenuRestPhotos/Nicolau/7.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (38, "Tosta Nicolau (Vegan)", 6, 8.5, 50, "Tosta Simples com abacate fatiado c/ azeite e flor de sal.","MenuRestPhotos/Nicolau/8.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (39, "Tosta Amélia", 6, 6, 60, "Tosta c/ húmus de beterraba, abacate fatiado e granola salgada", "MenuRestPhotos/Nicolau/9.jpg",4);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (40, "Panqueca Fit de Trigo Sarraceno", 6, 8, 60, "Servida com fruta da época e maple syrup", "MenuRestPhotos/Nicolau/10.jpg",4);

-- Restaurante 5 Italian Republic

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (41, "Spaghetti alla Carbonara", 3, 12.45, 60, "Spaghetti com bacon envolto em creme de natas e ovo", "MenuRestPhotos/ItalianRepublic/1.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (42, "Pizza Margherita", 3, 9.45, 60, "Tomate, basílico e queijo mozzarella.", "MenuRestPhotos/ItalianRepublic/2.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (43, "Crostini", 3, 6.95, 60, "Fatia de pão levemente tostado com mozzarela fresca, rucula, presunto e pesto.", "MenuRestPhotos/ItalianRepublic/3.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (44, "Focaccia", 3, 3.95, 60, "Pão Italian Republic ligeiramente macio , aromatizado com alecrim acompanhado com emulsão de azeite extra virgem e vinagre balsãmico ", "MenuRestPhotos/ItalianRepublic/4.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (45, "Bistecca de Vitela Grelhada", 3, 15.95, 60, "Bife de Picanha Grelhado com molho barbecue aromatizado com pesto italiano e com duas guarnições à escolha: risotto de tomate cherry ou linguine al pesto ou batata frita ou salada de alfaces verde aromatizada com vinagre balsâmico", "MenuRestPhotos/ItalianRepublic/5.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (46, "Frango Al Mattone", 3, 11.95, 60, "Frango marinado e grelhado com molho de churrasco e com duas guarnicões à escolha : risotto de tomate cherry ou linguine al pesto ou batata frita ou salada de alfaces verdes aromatizada com vinagre balsãmico ", "MenuRestPhotos/ItalianRepublic/6.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (47, "Firenze", 3, 10.95, 60, "Hambúrguer de vaca, tomate assado, beringela grelhada, queijo cheddar, pesto e manjericão.", "MenuRestPhotos/ItalianRepublic/7.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (48, "Bari (Vegetariano)", 3, 8.5, 60, "Cogumelo portobello grelhado, espinafres salteados, mozzarella fresca, courgette, beringela, tomate cereja e manjericão", "MenuRestPhotos/ItalianRepublic/8.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (49, "Spaghetti alla Bolognese", 3, 12.45, 60, "Spaghetti com carne picada e molho tomate.", "MenuRestPhotos/ItalianRepublic/9.jpg",5);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (50, "Pizza Parma", 3, 11.95, 60, "Tomate, basílico, queijo mozzarella, folhas de rúcula e presunto.", "MenuRestPhotos/ItalianRepublic/10.jpg",5);

-- Restaurant 6 Tomatino

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (51, "Gamberetti", 3, 9.8, 100 ,"Camarão salteado em azeite e alho. Com ou sem picante. Não é possível atribuir pontos na app Tomatino.", "MenuRestPhotos/Tomatino/1.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (52, "Carbonara", 3, 8.75, 100 ,"Molho de natas e ovo, tiras de bacon e sem faltar, a pimenta preta moída. Aspecto cremoso e finalizado com o queijo Parmesão.", "MenuRestPhotos/Tomatino/2.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (53, "Bolognesa", 3, 7.95, 100 ,"Molho bolonhesa, envolvido nas nossas massas e complementado pelo nosso queijo Parmesão.", "MenuRestPhotos/Tomatino/3.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (54, "Di Mare", 3, 8.75, 100 ,"Cocktail de marisco em azeite aromatizado ao alho, tomate e salsa. Molho de Tomate com ervas aromáticas. Com ou sem picante.", "MenuRestPhotos/Tomatino/4.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (55, "Sardegna", 3, 8.95, 50 ,"Atum e a azeitona salteados em azeite aromatizado ao alho,molho de tomate a envolver. Com ou sem oicante.", "MenuRestPhotos/Tomatino/5.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (56, "Pomodoro", 3, 6.85, 100 ,"Molho de Tomate com pedaços de tomate fresco com lascas de queijo Parmigiano Reggiano.", "MenuRestPhotos/Tomatino/6.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (57, "Alfredo di Roma", 3, 8.75  , 100 ,"Frango alourado no momento, temperado com sal e pimenta preta do moinho. Adicionamos os brócolos e envolvemos com o nosso delicioso molho Alfredo.", "MenuRestPhotos/Tomatino/7.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (58, "Campania", 3, 7.5, 100 ,"Salteado de legumes (courgete, beringela, cenoura, cogumelos frescos e azeitona) envolvido em molho de tomate.", "MenuRestPhotos/Tomatino/8.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (59, "Padovana", 3, 9.25, 100 ,"Tiras de frango salteadas em azeite aromatizado ao alho e temperadas com sal e pimenta preta envolvida em molho de Tomate.", "MenuRestPhotos/Tomatino/9.jpg",6);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (60, "Toscania", 3, 9.15, 100 ,"Tiras de vaca salteadas em azeite aromatizado ao alho e temperadas com sal e pimenta preta. Envolvido em molho de natas e cogumelos.", "MenuRestPhotos/Tomatino/10.jpg",6);

-- Restaurant 7 Pizza Hut

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (61, "My Box", 3, 10.95, 100 ,"1 Pan Pizza Individual (Cheeseham, Serrana ou Veggie Lovers); 2 Pães de Alho Simples; 4 Nuggets c/ Molho Barbecue ou 4 Nuggets c/ Molho Mostarda e Mel ou Batatas Country.", "MenuRestPhotos/PizzaHut/1.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (62, "Margarita", 3, 7.75, 100 ,"Molho de Tomate, Queijo 100% Mozzarella e Oregãos", "MenuRestPhotos/PizzaHut/2.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (63, "Serrana", 3, 9.75, 100 ,"Molho de Tomate, Queijo 100% Mozzarella, Oregãos, Chouriço, Cogumelos Frescos e Azeitonas", "MenuRestPhotos/PizzaHut/3.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (64, "Bacon Lovers", 3, 10.75, 100 ,"Molho de Tomate, Queijo 100% Mozzarella, Oregãos, Bacon Extra e Mozzarella Extra", "MenuRestPhotos/PizzaHut/4.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (65, "Barbecue", 3, 11.75, 100 ,"Molho Barbecue, Queijo 100% Mozzarella, Orégãos, Bacon, Carna de Vaca e Cebola", "MenuRestPhotos/PizzaHut/5.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (66, "Tropical", 3, 10.75, 100 ,"Molho de Tomate, Queijo 100% Mozzarella, Oregãos, Ananás, Fiambre e Cogumelos Frescos", "MenuRestPhotos/PizzaHut/6.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (67, "Cheeseham", 3, 9.75, 100 ,"Molho de Tomate, Queijo 100% Mozzarella, Oregãos, Fiambre e Mozzarella Extra", "MenuRestPhotos/PizzaHut/7.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (68, "Havaiana", 3, 11.75, 100 ,"* ESPECIALIDADE * Molho de Tomate, Queijo 100% Mozzarella, Oregãos, Atum, Camarão, Ananás e Mozzarella Extra", "MenuRestPhotos/PizzaHut/8.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (69, "Veggie Lovers", 3, 9.75, 100 ,"Molho de Tomate, Queijo 100% Mozzarella, Oregãos, Mistura de Vegetais, Milho, Tomate e Azeitonas", "MenuRestPhotos/PizzaHut/9.jpg",7);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (70, "Suprema", 3, 11.75, 100 ,"* ESPECIALIDADE * Molho de Tomate, Queijo 100% Mozzarella, Oregãos, Pepperoni, Carne de Vaca, Mistura de Pimentos, Cogumelos Frescos e Cebola", "MenuRestPhotos/PizzaHut/10.jpg",7);

-- Restaurant 8 Burger King

INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (71, "Whopper", 1, 5.95, 80 ,"O WHOPPER ® será sempre o nosso número um. Suculenta carne de vaca grelhada de excelente qualidade, tomate e alface fresca, cebola suave e picles saborosos acompanhados com maionese e ketchup. Não esquecer o pão fofo com sementes, que fazem no seu conjunto um hambúrguer de sabor único e que reconhecerias de olhos fechados.", "MenuRestPhotos/BK/1.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (72, "Big King XXL", 1, 7.8, 80 ,"Mas podemos pedir sempre mais, acreditamos que isso te irá deixar satisfeito. Um hambúrguer que dá o tamanho... XXL. Imagina 2 hambúrgueres grelhados com triplo queijo derretido sobre eles, cebola às rodelas, alface, picles e molho Big King®.", "MenuRestPhotos/BK/2.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (73, "Steakhouse", 1, 6.95, 80 ,"Se os ingredientes fossem convidados para uma festa não saberíamos qual seria o convidado principal. Cebola frita, bacon crocante, molho barbecue delicioso...fecha a boca... queijo cheddar derretido, suculenta carne nas brasas, tomates frescos e pão levemente torrado completam esta autêntica dança de sabores.", "MenuRestPhotos/BK/3.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (74, "Double Cheeseburger", 1, 4.6, 80 ,"Guarda lugar para o Double Cheeseburger, duas carnes grelhadas com queijo americano derretido por cima e como acompanhantes indispensáveis: picles, mostarda e ketchup.", "MenuRestPhotos/BK/4.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (75, "The King Ovo - Double", 1, 7.95, 80 ,"Desfruta do incrível The KING OVO com carne grelhada, maionese, tomate, bacon, cebola crocante, ketchup e queijo americano. E o toque final: um delicioso ovo estrelado. Viva o KING!", "MenuRestPhotos/BK/5.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (76, "Long Texas", 1, 5.95, 80 ,"2 peças de carne 100% de vaca, cobertas com 2 fatias de queijo cheddar, aros de cebola crocantes e um delicioso molho barbecue em pão comprido.", "MenuRestPhotos/BK/6.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (77, "Chicken Tendercrisp", 1, 6.95, 100 ,"100% peito de frango panado como só na BURGER KING®® sabemos fazer. Alfaces frescas, tomates cortados na hora e uma camada de maionese para adicionar ainda mais sabor dentro de um pão crocante, é certo que irás repetir…", "MenuRestPhotos/BK/7.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (78, "Crispy Chicken", 1, 4.45, 100 ,"Crocante por fora, suave por dentro. O melhor frango com um panado crocante, tomate acabado de cortar, alface fresca e maionese num pão de sementes acabado de torrar. Uma verdadeira obra de arte.", "MenuRestPhotos/BK/8.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (79, "LongChicken", 1, 5.95, 100 ,"Um dos mais pedidos nos nossos restaurantes, por que será? Pão de sementes alongado com um panado de frango crocante, alface e maionese. Todo ele um clássico!", "MenuRestPhotos/BK/9.jpg",8);
INSERT INTO Menu_Item(itemID, nameMenuItem, categoryID, price, stock, description, photo, restaurantID) VALUES (80, "Double Cheese Bacon XXL", 1, 7.85, 100 ,"Duplica o teu hambúrguer de queijo, adiciona bacon e agora aumenta o seu tamanho... nós sabemos, é impressionante. Carne grelhada como gostamos na BURGER KING®, picles, ketchup e mostarda compõem esta obra de arte.", "MenuRestPhotos/BK/10.jpg",8);

/* Restaurant Reviews */

INSERT INTO Restaurant_Review(restaurantID, clientID, score, comment, response) VALUES (1, 1, 5, "Very good service, delivery was really quick!", "Dear Zediogo96, your evaluation increased our gratitude and happiness, we hope for you in the near future.");
INSERT INTO Restaurant_Review(restaurantID, clientID, score, comment) VALUES (1, 2, 4, "Delivery took a bit of time, but it still was a good meal!");
INSERT INTO Restaurant_Review(restaurantID, clientID, score, comment) VALUES (1, 3, 4, "This is my favorite restaurant so far!");

/* php --version
sqlite3 --version
wget "https://web.fe.up.pt/~arestivo/page/exercises/php/test.zip"
unzip test.zip
sqlite3 example.db < example.sql
php -S localhost:9000 */