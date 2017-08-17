CREATE TABLE `CoinTransaction` (
  `ID` bigint NOT NULL AUTO_INCREMENT,
  `memberId` varchar(255) NOT NULL,
  `coinType` varchar(23) NOT NULL,
  `address` varchar(255) NOT NULL,
  `amount` decimal(19,2) NOT NULL DEFAULT 0,
  `confirmations` int NOT NULL DEFAULT 0,
  `mod_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
