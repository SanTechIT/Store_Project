-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema atdpstore
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema atdpstore
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `atdpstore` DEFAULT CHARACTER SET utf8 ;
USE `atdpstore` ;

-- -----------------------------------------------------
-- Table `atdpstore`.`Customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atdpstore`.`Customers` (
  `Customer_Id` INT NOT NULL AUTO_INCREMENT,
  `First_Name` VARCHAR(45) NOT NULL,
  `Username` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(255) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `IsAdmin` TINYINT NOT NULL,
  PRIMARY KEY (`Customer_Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atdpstore`.`Products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atdpstore`.`Products` (
  `Product_Id` INT NOT NULL AUTO_INCREMENT,
  `Product_Name` VARCHAR(1000) NOT NULL,
  `Price` DECIMAL(12,2) NOT NULL,
  `Image_Name` VARCHAR(127) NOT NULL,
  `Rating` DECIMAL(2,1) NOT NULL,
  `Product_Description` VARCHAR(3000) NOT NULL,
  PRIMARY KEY (`Product_Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atdpstore`.`Orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atdpstore`.`Orders` (
  `Order_Id` INT NOT NULL AUTO_INCREMENT,
  `Customers_Customer_Id` INT NOT NULL,
  `IsDone` TINYINT NOT NULL,
  PRIMARY KEY (`Order_Id`, `Customers_Customer_Id`),
  INDEX `fk_Orders_Customers1_idx` (`Customers_Customer_Id` ASC),
  CONSTRAINT `fk_Orders_Customers1`
    FOREIGN KEY (`Customers_Customer_Id`)
    REFERENCES `atdpstore`.`Customers` (`Customer_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atdpstore`.`Order_Items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atdpstore`.`Order_Items` (
  `Primary_Key` INT NOT NULL AUTO_INCREMENT,
  `Products_Product_Id` INT NOT NULL,
  `Amount` INT NOT NULL,
  `Total_Price` DECIMAL(12,2) NOT NULL,
  `Orders_Order_Id` INT NOT NULL,
  PRIMARY KEY (`Primary_Key`, `Products_Product_Id`, `Orders_Order_Id`),
  INDEX `fk_Order_Items_Products1_idx` (`Products_Product_Id` ASC),
  INDEX `fk_Order_Items_Orders1_idx` (`Orders_Order_Id` ASC),
  CONSTRAINT `fk_Order_Items_Products1`
    FOREIGN KEY (`Products_Product_Id`)
    REFERENCES `atdpstore`.`Products` (`Product_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Order_Items_Orders1`
    FOREIGN KEY (`Orders_Order_Id`)
    REFERENCES `atdpstore`.`Orders` (`Order_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `atdpstore`.`Types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `atdpstore`.`Types` (
  `Type_Id` INT NOT NULL AUTO_INCREMENT,
  `Type_Name` VARCHAR(45) NOT NULL,
  `Products_Product_Id` INT NOT NULL,
  PRIMARY KEY (`Type_Id`, `Products_Product_Id`),
  INDEX `fk_Types_Products1_idx` (`Products_Product_Id` ASC),
  CONSTRAINT `fk_Types_Products1`
    FOREIGN KEY (`Products_Product_Id`)
    REFERENCES `atdpstore`.`Products` (`Product_Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

/* Seed Product List */

INSERT INTO Products
(Product_Name, Price, Image_Name, Rating, Product_Description)
VALUES
('Intel Core i7-8700K 6-Core 3.7 GHz'
,'349.99',
'assets/19-117-827-Z01.jpg',
'4.8',
'<ul class="browser-default">
<li>Only Compatible with Intel 300 Series Motherboard</li>
<li>For A Great VR Experience</li>
<li>Max Turbo Frequency 4.7 GHz</li>
<li>Intel UHD Graphics 630</li>
<li>Unlocked Processor</li>
<li>DDR4 Support</li>
<li>Socket LGA 1151 (300 Series)</li>
<li>Cooling device not included - Processor Only</li>
</ul>
'),
('AMD RYZEN 7 2700X 8-Core 3.7 GHz',
'329.99','assets/19-113-499-V01.jpg',
'4.8',
'<ul class="browser-default">
<li>2nd Gen Ryzen</li>
<li>AMD StoreMI Technology</li>
<li>AMD SenseMI Technology</li>
<li>AMD Ryzen Master Utility</li>
<li>Socket AM4</li>
<li>Max Boost Frequency 4.3 GHz</li>
<li>DDR4 Support</li>
<li>Unlocked Processor</li>
<li>Thermal Design Power 105W</li>
<li>AMD Wraith Prism Cooler Included</li>
</ul>'),
/*

*/
('Intel Core i5-8600K 6-Core 3.6 GHz',
'249.99',
'assets/19-117-825-Z01.jpg',
'5',
'<ul class="browser-default">
                
  <li class="item">
      Only Compatible with Intel 300 Series Motherboard
  </li>
  <li class="item">
      For A Great VR Experience
  </li>
  <li class="item">
      Max Turbo Frequency 4.3 GHz
  </li>
  <li class="item">
      Intel UHD Graphics 630
  </li>
  <li class="item">
      Unlocked Processor
  </li>
  <li class="item">
      DDR4 Support
  </li>
  <li class="item">
      Socket LGA 1151 (300 Series)
  </li>
  <li class="item">
      Cooling device not included - Processor Only
  </li>
</ul>'),
/*

*/
('AMD RYZEN 5 2400G Quad-Core 3.6 GHz','159.99','assets/19-113-480-V01.jpg','4.3',
'<ul class="browser-default">            
  <li class="item">
      Built-In Radeon Vega RX 11 Graphics
  </li>
  <li class="item">
      4 Cores / 8 Threads Unlocked
  </li>
  <li class="item">
      Frequency: 3.9 GHz Max Boost
  </li>
  <li class="item">
      Socket Type: AM4
  </li>
  <li class="item">
      6MB total cache
  </li>
  <li class="item">
      AMD Wraith Stealth Cooler Included
  </li>
  </ul>
'),
('MSI X470 GAMING PRO CARBON AM4 AMD X470','179.99','assets/13-144-178-V01.jpg','4.9',
'<ul class="browser-default">    
  <li class="item">
      AMD X470
  </li>
  <li class="item">
      Supports AMD RYZEN Desktop processors and A-series/ Athlon Processors for Socket AM4
  </li>
  <li class="item">
      Supports 2667/ 2400/ 2133/ 1866 MHz (by JEDEC)*
  </li>
  <li class="item">
      Supports 3466/ 3200/ 3066/ 3000/ 2933/ 2800/ 2667 MHz (by A-XMP OC MODE)*
  </li>
  <li class="item">
      * A-series/ Athlon processors support up to 2400 MHz. And the supporting frequency of memory varies with installed processor.
  </li>
</ul>'
),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7',
'<ul class="browser-default">           
  <li class="item">
      Intel Z370
  </li>
  <li class="item">
      Only Support for 8th Generation Intel Core i7/i5/i3 processors in the LGA1151 package
  </li>
  <li class="item">
      * Not backward compatible with older generation of LGA 1151 CPUs
  </li>
  <li class="item">
      DDR4 4000(O.C.)/ 3866(O.C.)/ 3800(O.C.)
  </li>
</ul>'),
('G.SKILL TridentZ RGB Series 16GB (2x8GB)','204.99','assets/20-232-476-S01.jpg','4.3',
'<ul class="browser-default">     
  <li class="item">
      DDR4 3200 (PC4 25600)
  </li>
  <li class="item">
      Timing 16-18-18-38
  </li>
  <li class="item">
      CAS Latency 16
  </li>
  <li class="item">
      Voltage 1.35V
  </li>
</ul>'),
('G.SKILL Ripjaws V Series 16GB (2x8GB)','149.99','assets/20-231-888-01.jpg','4.2',
'<ul class="browser-default">         
  <li class="item">
      DDR4 2400 (PC4 19200)
  </li>
  <li class="item">
      Timing 15-15-15-35
  </li>
  <li class="item">
      CAS Latency 15
  </li>
  <li class="item">
      Voltage 1.2V
  </li>
</ul>'),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7',''),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7',''),
('GIGABYTE Z370 AORUS GAMING 1151 Z370','189.99','assets/13-145-043-V06.jpg','3.7','');


/* Seed Admin User */

INSERT INTO Customers
(First_Name, Username, Password, Email, IsAdmin)
VALUES
('Admin','admin','$2y$10$Z/FWH7GWpfLmjqPjbOmO1.5Iim81SenDoV9AJeiS.mqdJjnJh4CIi','web@serverintl.net','1');
