USE atdpstore;

INSERT INTO Products
(Product_Name, Price, Image_Name, Rating, Product_Description)
VALUES
('Item 1','30.00','Image_Name.png','4','Default 1'),
('Item 2','20.00','Image_Name.png','3.2','Default 2'),
('Item 3','50.00','Image_Name.png','4.3','Default 3'),
('Item 4','90.00','Image_Name.png','4.1','Default 4'),
('Item 5','150.00','Image_Name.png','4.9','Default 5'),
('Item 6','70.00','Image_Name.png','3.5','Default 6');

INSERT INTO Customers
(First_Name, Username, Password, Email, IsAdmin)
VALUES
('Admin','admin','$2y$10$Z/FWH7GWpfLmjqPjbOmO1.5Iim81SenDoV9AJeiS.mqdJjnJh4CIi','web@serverintl.net','1');
