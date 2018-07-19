USE atdpstore;

INSERT INTO Products
(Product_Name, Price, Image_Name, Rating)
VALUES
('Item 1','30.00','Image_Name.png','4'),
('Item 2','20.00','Image_Name.png','3.2'),
('Item 3','50.00','Image_Name.png','4.3'),
('Item 4','90.00','Image_Name.png','4.1'),
('Item 5','150.00','Image_Name.png','4.9'),
('Item 6','70.00','Image_Name.png','3.5');

INSERT INTO Properties
(Products_Product_Id, Property_Name, Property_Value)
VALUES
('1','Rating',''),
('2','Rating',''),
('4','Rating',''),
('5','Rating',''),
('6','Rating','');

CREATE TABLE IF NOT EXISTS `atdpstore`.`Properties` (
  `Property_Id` INT NOT NULL AUTO_INCREMENT,
  `Products_Product_Id` INT NOT NULL,
  `Property_Name` VARCHAR(45) NOT NULL,
  `Property_Value` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Property_Id`, `Products_Product_Id`),
  INDEX `fk_Types_Products1_idx` (`Products_Product_Id` ASC),
  CONSTRAINT `fk_Types_Products1`
    FOREIGN KEY (`Products_Product_Id`)
    REFERENCES `atdpstore`.`Products` (`Product_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
ENGINE = InnoDB;