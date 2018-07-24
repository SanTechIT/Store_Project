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
  `Product_Name` VARCHAR(45) NOT NULL,
  `Price` DECIMAL(12,2) NOT NULL,
  `Image_Name` VARCHAR(45) NOT NULL,
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
