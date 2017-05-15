
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- product
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_declination
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_declination`;

CREATE TABLE `product_declination`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_price
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_price`;

CREATE TABLE `product_price`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_stock
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_stock`;

CREATE TABLE `product_stock`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- product_shelf
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `product_shelf`;

CREATE TABLE `product_shelf`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- media
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `media`;

CREATE TABLE `media`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- currency
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- order_line
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `order_line`;

CREATE TABLE `order_line`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipment`;

CREATE TABLE `shipment`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipment_method
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipment_method`;

CREATE TABLE `shipment_method`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- shipment_weight_grid
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `shipment_weight_grid`;

CREATE TABLE `shipment_weight_grid`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- payment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- payment_method
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `payment_method`;

CREATE TABLE `payment_method`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user_address
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_address`;

CREATE TABLE `user_address`
(
    
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
