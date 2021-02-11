#
# TABLE STRUCTURE FOR: admin
#

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `about` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_reset_token` varchar(20) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `ip_address` varchar(14) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `about`, `email`, `password`, `password_reset_token`, `image`, `last_login`, `last_logout`, `ip_address`, `status`, `is_admin`) VALUES (1, 'Admin', 'admin', 'cbvcbvc', 'admin@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', '', NULL, '2021-03-06 04:11:53', '2021-03-02 23:46:37', '::1', 1, 1);


#
# TABLE STRUCTURE FOR: advertisement
#

DROP TABLE IF EXISTS `advertisement`;

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `script` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `serial_position` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (5, 'news-sidebar-top', 9, 'upload/advertisement/dff78ee612b37fc12c9e7fa94839d855.jpg', NULL, 'https://www.bdtask.com/', 1, 1, '2018-07-10 01:00:40');
INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (6, 'news-sidebar-bottom', 9, 'upload/advertisement/7fabc49dd69e0a0d6e111f3fcae0118a.jpg', NULL, 'https://www.bdtask.com/', 2, 1, '2018-07-10 01:02:18');
INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (7, 'news-top', 9, 'upload/advertisement/ff5a204fdd1722068e78222fd1d24a82.jpg', NULL, 'https://www.bdtask.com/', 3, 1, '2018-07-10 00:54:51');
INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (8, 'news-bottom', 9, '/upload/advertisement/1614672574_04f30fde1bca314f6013.png', NULL, 'https://www.bdtask.com/', 4, 1, '2021-03-02 14:09:34');
INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (9, 'news details-top', 26, '/upload/advertisement/1614672536_9bb671550e7dbf3570a2.png', NULL, 'https://www.bdtask.com/', 3, 1, '2021-03-02 14:08:57');
INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (10, 'news details-bottom', 26, '/upload/advertisement/1614672514_0ec53a71097b84c63a82.png', NULL, 'https://www.bdtask.com/', 4, 1, '2021-03-02 14:08:34');
INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (11, 'news details-sidebar-top', 26, '/upload/advertisement/1614672490_566192aff15693225bd1.png', NULL, 'https://www.bdtask.com/', 1, 1, '2021-03-02 14:08:11');
INSERT INTO `advertisement` (`id`, `name`, `page`, `image`, `script`, `url`, `serial_position`, `status`, `date`) VALUES (12, 'news details-sidebar-bottom', 26, '/upload/advertisement/1614657834_eb2d5f67f41ab46b4194.png', NULL, 'https://www.bdtask.com/', 2, 1, '2021-03-02 10:03:54');


#
# TABLE STRUCTURE FOR: coinpayments_payments
#

DROP TABLE IF EXISTS `coinpayments_payments`;

CREATE TABLE `coinpayments_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount1` double NOT NULL,
  `amount2` double NOT NULL,
  `buyer_name` varchar(100) NOT NULL,
  `currency1` varchar(100) NOT NULL,
  `currency2` varchar(100) NOT NULL,
  `fee` double NOT NULL,
  `ipn_id` text NOT NULL,
  `ipn_mode` varchar(20) NOT NULL,
  `ipn_type` varchar(20) NOT NULL,
  `ipn_version` varchar(20) NOT NULL,
  `merchant` text NOT NULL,
  `received_amount` double NOT NULL,
  `received_confirms` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `status_text` text NOT NULL,
  `txn_id` text NOT NULL,
  `user_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: crypto_payments
#

DROP TABLE IF EXISTS `crypto_payments`;

CREATE TABLE `crypto_payments` (
  `paymentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `boxID` int(11) unsigned NOT NULL DEFAULT 0,
  `boxType` enum('paymentbox','captchabox') NOT NULL,
  `orderID` varchar(50) NOT NULL DEFAULT '',
  `userID` varchar(50) NOT NULL DEFAULT '',
  `countryID` varchar(3) NOT NULL DEFAULT '',
  `coinLabel` varchar(6) NOT NULL DEFAULT '',
  `amount` double(20,8) NOT NULL DEFAULT 0.00000000,
  `amountUSD` double(20,8) NOT NULL DEFAULT 0.00000000,
  `unrecognised` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `addr` varchar(34) NOT NULL DEFAULT '',
  `txID` char(64) NOT NULL DEFAULT '',
  `txDate` datetime DEFAULT NULL,
  `txConfirmed` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `txCheckDate` datetime DEFAULT NULL,
  `processed` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `processedDate` datetime DEFAULT NULL,
  `recordCreated` datetime DEFAULT NULL,
  PRIMARY KEY (`paymentID`),
  UNIQUE KEY `key3` (`boxID`,`orderID`,`userID`,`txID`,`amount`,`addr`),
  KEY `boxID` (`boxID`),
  KEY `boxType` (`boxType`),
  KEY `userID` (`userID`),
  KEY `countryID` (`countryID`),
  KEY `orderID` (`orderID`),
  KEY `amount` (`amount`),
  KEY `amountUSD` (`amountUSD`),
  KEY `coinLabel` (`coinLabel`),
  KEY `unrecognised` (`unrecognised`),
  KEY `addr` (`addr`),
  KEY `txID` (`txID`),
  KEY `txDate` (`txDate`),
  KEY `txConfirmed` (`txConfirmed`),
  KEY `txCheckDate` (`txCheckDate`),
  KEY `processed` (`processed`),
  KEY `processedDate` (`processedDate`),
  KEY `recordCreated` (`recordCreated`),
  KEY `key1` (`boxID`,`orderID`),
  KEY `key2` (`boxID`,`orderID`,`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

#
# TABLE STRUCTURE FOR: cryptolist
#

DROP TABLE IF EXISTS `cryptolist`;

CREATE TABLE `cryptolist` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `Id` int(11) NOT NULL,
  `Url` varchar(300) DEFAULT NULL,
  `ImageUrl` varchar(300) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Symbol` varchar(100) NOT NULL,
  `CoinName` varchar(100) DEFAULT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `Algorithm` varchar(100) DEFAULT NULL,
  `ProofType` varchar(100) DEFAULT NULL,
  `FullyPremined` varchar(100) DEFAULT NULL,
  `TotalCoinSupply` varchar(100) DEFAULT NULL,
  `PreMinedValue` varchar(100) DEFAULT NULL,
  `TotalCoinsFreeFloat` varchar(100) DEFAULT NULL,
  `SortOrder` int(11) DEFAULT NULL,
  `Sponsored` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cid`),
  UNIQUE KEY `Id` (`Id`),
  UNIQUE KEY `Symbol` (`Symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: dbt_affiliation
#

DROP TABLE IF EXISTS `dbt_affiliation`;

CREATE TABLE `dbt_affiliation` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `commission` double(19,8) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: dbt_balance
#

DROP TABLE IF EXISTS `dbt_balance`;

CREATE TABLE `dbt_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `balance` double(19,8) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_balance` (`id`, `user_id`, `currency_id`, `currency_symbol`, `balance`, `last_update`) VALUES (1, 'WM5PAU', 0, 'USD', '50000.00000000', '2021-03-03 18:45:15');
INSERT INTO `dbt_balance` (`id`, `user_id`, `currency_id`, `currency_symbol`, `balance`, `last_update`) VALUES (2, 'WM5PAU', 0, 'BTC', '50000.00000000', '2021-03-03 18:45:19');
INSERT INTO `dbt_balance` (`id`, `user_id`, `currency_id`, `currency_symbol`, `balance`, `last_update`) VALUES (3, '4YLXRA', 0, 'USD', '38350.00000000', '2021-03-04 10:37:51');
INSERT INTO `dbt_balance` (`id`, `user_id`, `currency_id`, `currency_symbol`, `balance`, `last_update`) VALUES (4, '4YLXRA', NULL, 'BTC', '10.00000000', '2021-03-03 22:34:34');
INSERT INTO `dbt_balance` (`id`, `user_id`, `currency_id`, `currency_symbol`, `balance`, `last_update`) VALUES (5, '4YLXRA', NULL, 'SPD', '1000.00000000', '2021-03-04 06:07:11');


#
# TABLE STRUCTURE FOR: dbt_balance_log
#

DROP TABLE IF EXISTS `dbt_balance_log`;

CREATE TABLE `dbt_balance_log` (
  `log_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `balance_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `transaction_amount` double(19,8) NOT NULL,
  `transaction_fees` double(19,8) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('1', 1, 'WM5PAU', NULL, 'USD', 'DEPOSIT', '50000.00000000', '0.00000000', '::1', '2021-02-27 03:49:33');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('2', 1, 'WM5PAU', NULL, 'USD', 'DEPOSIT', '100000.00000000', '20000.00000000', '::1', '2021-02-27 04:21:16');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('3', 1, 'WM5PAU', NULL, 'USD', 'DEPOSIT', '1000.00000000', '200.00000000', '::1', '2021-02-28 03:00:17');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('4', 3, '4YLXRA', NULL, 'USD', 'DEPOSIT', '10000.00000000', '2000.00000000', '::1', '2021-03-01 06:07:56');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('5', 3, '4YLXRA', NULL, 'USD', 'WITHDRAW', '1000.00000000', '100.00000000', '::1', '2021-03-01 06:09:44');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('6', 3, '4YLXRA', NULL, 'USD', 'DEPOSIT', '5000.00000000', '1000.00000000', '::1', '2021-03-02 06:37:03');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('7', 3, '4YLXRA', NULL, 'USD', 'WITHDRAW', '10000.00000000', '1000.00000000', '::1', '2021-01-01 22:10:20');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('8', 3, '4YLXRA', NULL, 'USD', 'WITHDRAW', '500.00000000', '50.00000000', '::1', '2021-03-03 06:45:38');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('9', 4, '4YLXRA', NULL, 'BTC', 'CREDITED', '10.00000000', '0.00000000', '::1', '2021-03-03 22:34:34');
INSERT INTO `dbt_balance_log` (`log_id`, `balance_id`, `user_id`, `currency_id`, `currency_symbol`, `transaction_type`, `transaction_amount`, `transaction_fees`, `ip`, `date`) VALUES ('10', 5, '4YLXRA', NULL, 'SPD', 'CREDITED', '1000.00000000', '0.00000000', '::1', '2021-03-04 06:07:11');


#
# TABLE STRUCTURE FOR: dbt_biding
#

DROP TABLE IF EXISTS `dbt_biding`;

CREATE TABLE `dbt_biding` (
  `id` bigint(22) NOT NULL AUTO_INCREMENT,
  `bid_type` varchar(50) NOT NULL,
  `bid_price` double(19,8) NOT NULL,
  `bid_qty` double(19,8) NOT NULL,
  `bid_qty_available` double(19,8) NOT NULL,
  `total_amount` double(19,8) NOT NULL,
  `amount_available` double(19,8) NOT NULL,
  `coin_id` varchar(50) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `market_id` int(100) DEFAULT NULL,
  `market_symbol` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `open_order` timestamp NOT NULL DEFAULT current_timestamp(),
  `fees_amount` double(19,8) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '"1=Complete, 2=Running"',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_biding` (`id`, `bid_type`, `bid_price`, `bid_qty`, `bid_qty_available`, `total_amount`, `amount_available`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `user_id`, `open_order`, `fees_amount`, `status`) VALUES ('1', 'BUY', '10000.00000000', '1.00000000', '0.00000000', '10000.00000000', '0.00000000', NULL, 'BTC', NULL, 'BTC_USD', 'WM5PAU', '2021-02-27 04:44:11', '0.00000000', 1);
INSERT INTO `dbt_biding` (`id`, `bid_type`, `bid_price`, `bid_qty`, `bid_qty_available`, `total_amount`, `amount_available`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `user_id`, `open_order`, `fees_amount`, `status`) VALUES ('2', 'SELL', '10000.00000000', '1.00000000', '0.00000000', '10000.00000000', '0.00000000', NULL, 'BTC', NULL, 'BTC_USD', 'WM5PAU', '2021-02-27 04:46:41', '0.00000000', 1);
INSERT INTO `dbt_biding` (`id`, `bid_type`, `bid_price`, `bid_qty`, `bid_qty_available`, `total_amount`, `amount_available`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `user_id`, `open_order`, `fees_amount`, `status`) VALUES ('3', 'BUY', '20000.00000000', '1.00000000', '0.00000000', '20000.00000000', '0.00000000', NULL, 'BTC', NULL, 'BTC_USD', 'WM5PAU', '2021-01-27 05:06:14', '0.00000000', 1);
INSERT INTO `dbt_biding` (`id`, `bid_type`, `bid_price`, `bid_qty`, `bid_qty_available`, `total_amount`, `amount_available`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `user_id`, `open_order`, `fees_amount`, `status`) VALUES ('4', 'SELL', '20000.00000000', '1.00000000', '0.00000000', '20000.00000000', '0.00000000', NULL, 'BTC', NULL, 'BTC_USD', 'WM5PAU', '2021-02-27 05:06:22', '0.00000000', 1);
INSERT INTO `dbt_biding` (`id`, `bid_type`, `bid_price`, `bid_qty`, `bid_qty_available`, `total_amount`, `amount_available`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `user_id`, `open_order`, `fees_amount`, `status`) VALUES ('5', 'BUY', '100.00000000', '1.00000000', '1.00000000', '100.00000000', '100.00000000', NULL, 'BTC', NULL, 'BTC_USD', '4YLXRA', '2021-03-03 22:37:51', '0.00000000', 2);


#
# TABLE STRUCTURE FOR: dbt_biding_log
#

DROP TABLE IF EXISTS `dbt_biding_log`;

CREATE TABLE `dbt_biding_log` (
  `log_id` bigint(22) NOT NULL AUTO_INCREMENT,
  `bid_id` bigint(22) NOT NULL,
  `bid_type` varchar(10) NOT NULL,
  `bid_price` double(19,8) NOT NULL,
  `complete_qty` double(19,8) NOT NULL,
  `complete_amount` double(19,8) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `coin_id` varchar(100) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `market_id` int(11) DEFAULT NULL,
  `market_symbol` varchar(100) NOT NULL,
  `success_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fees_amount` double(19,8) NOT NULL,
  `available_amount` double(19,8) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_biding_log` (`log_id`, `bid_id`, `bid_type`, `bid_price`, `complete_qty`, `complete_amount`, `user_id`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `success_time`, `fees_amount`, `available_amount`, `status`) VALUES ('1', '1', 'BUY', '10000.00000000', '1.00000000', '10000.00000000', 'WM5PAU', NULL, 'BTC', NULL, 'BTC_USD', '2021-01-01 05:56:09', '1000.00000000', '10000.00000000', 1);
INSERT INTO `dbt_biding_log` (`log_id`, `bid_id`, `bid_type`, `bid_price`, `complete_qty`, `complete_amount`, `user_id`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `success_time`, `fees_amount`, `available_amount`, `status`) VALUES ('2', '2', 'SELL', '10000.00000000', '1.00000000', '10000.00000000', 'WM5PAU', NULL, 'BTC', NULL, 'BTC_USD', '2021-01-02 12:10:54', '1000.00000000', '1000.00000000', 1);
INSERT INTO `dbt_biding_log` (`log_id`, `bid_id`, `bid_type`, `bid_price`, `complete_qty`, `complete_amount`, `user_id`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `success_time`, `fees_amount`, `available_amount`, `status`) VALUES ('3', '1', 'BUY', '10000.00000000', '1.00000000', '20000.00000000', 'WM5PAU', NULL, 'BTC', NULL, 'BTC_USD', '2021-02-02 12:11:42', '5000.00000000', '5000.00000000', 1);
INSERT INTO `dbt_biding_log` (`log_id`, `bid_id`, `bid_type`, `bid_price`, `complete_qty`, `complete_amount`, `user_id`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `success_time`, `fees_amount`, `available_amount`, `status`) VALUES ('4', '2', 'SELL', '10000.00000000', '1.00000000', '20000.00000000', 'WM5PAU', NULL, 'BTC', NULL, 'BTC_USD', '2021-02-02 12:11:45', '5000.00000000', '5000.00000000', 1);
INSERT INTO `dbt_biding_log` (`log_id`, `bid_id`, `bid_type`, `bid_price`, `complete_qty`, `complete_amount`, `user_id`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `success_time`, `fees_amount`, `available_amount`, `status`) VALUES ('5', '1', 'BUY', '10000.00000000', '1.00000000', '50000.00000000', 'WM5PAU', NULL, 'BTC', NULL, 'BTC_USD', '2021-03-02 12:43:29', '500.00000000', '0.00000000', 1);
INSERT INTO `dbt_biding_log` (`log_id`, `bid_id`, `bid_type`, `bid_price`, `complete_qty`, `complete_amount`, `user_id`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `success_time`, `fees_amount`, `available_amount`, `status`) VALUES ('6', '2', 'SELL', '10000.00000000', '1.00000000', '40000.00000000', 'WM5PAU', NULL, 'BTC', NULL, 'BTC_USD', '2021-03-02 12:43:34', '500.00000000', '0.00000000', 1);
INSERT INTO `dbt_biding_log` (`log_id`, `bid_id`, `bid_type`, `bid_price`, `complete_qty`, `complete_amount`, `user_id`, `coin_id`, `currency_symbol`, `market_id`, `market_symbol`, `success_time`, `fees_amount`, `available_amount`, `status`) VALUES ('7', '2', 'SELL', '10000.00000000', '1.00000000', '40000.00000000', 'WM5PAU', NULL, 'USD', NULL, 'BTC_USD', '2021-03-02 12:43:34', '500.00000000', '0.00000000', 1);


#
# TABLE STRUCTURE FOR: dbt_blocklist
#

DROP TABLE IF EXISTS `dbt_blocklist`;

CREATE TABLE `dbt_blocklist` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_mail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: dbt_chat
#

DROP TABLE IF EXISTS `dbt_chat`;

CREATE TABLE `dbt_chat` (
  `id` bigint(21) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: dbt_coinhistory
#

DROP TABLE IF EXISTS `dbt_coinhistory`;

CREATE TABLE `dbt_coinhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coin_symbol` varchar(100) NOT NULL,
  `market_symbol` varchar(100) NOT NULL,
  `last_price` double(19,8) NOT NULL,
  `total_coin_supply` double(19,8) NOT NULL,
  `price_high_1h` double(19,8) NOT NULL,
  `price_low_1h` double(19,8) NOT NULL,
  `price_change_1h` double(19,8) NOT NULL,
  `volume_1h` double(19,8) NOT NULL,
  `price_high_24h` double(19,8) NOT NULL,
  `price_low_24h` double(19,8) NOT NULL,
  `price_change_24h` double(19,8) NOT NULL,
  `volume_24h` double(19,8) NOT NULL,
  `open` double(19,8) NOT NULL,
  `close` double(19,8) NOT NULL,
  `volumefrom` double(19,8) NOT NULL,
  `volumeto` double(19,8) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_coinhistory` (`id`, `coin_symbol`, `market_symbol`, `last_price`, `total_coin_supply`, `price_high_1h`, `price_low_1h`, `price_change_1h`, `volume_1h`, `price_high_24h`, `price_low_24h`, `price_change_24h`, `volume_24h`, `open`, `close`, `volumefrom`, `volumeto`, `date`) VALUES (1, 'BTC', 'BTC_USD', '10000.00000000', '2.00000000', '10000.00000000', '10000.00000000', '0.00000000', '1.00000000', '10000.00000000', '10000.00000000', '0.00000000', '1.00000000', '10000.00000000', '10000.00000000', '2.00000000', '1.00000000', '2021-02-27 04:46:41');
INSERT INTO `dbt_coinhistory` (`id`, `coin_symbol`, `market_symbol`, `last_price`, `total_coin_supply`, `price_high_1h`, `price_low_1h`, `price_change_1h`, `volume_1h`, `price_high_24h`, `price_low_24h`, `price_change_24h`, `volume_24h`, `open`, `close`, `volumefrom`, `volumeto`, `date`) VALUES (2, 'BTC', 'BTC_USD', '20000.00000000', '3.00000000', '20000.00000000', '20000.00000000', '0.00000000', '2.00000000', '20000.00000000', '10000.00000000', '0.00000000', '2.00000000', '20000.00000000', '20000.00000000', '3.00000000', '2.00000000', '2021-02-27 05:06:22');


#
# TABLE STRUCTURE FOR: dbt_coinpair
#

DROP TABLE IF EXISTS `dbt_coinpair`;

CREATE TABLE `dbt_coinpair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `market_id` int(11) DEFAULT NULL,
  `market_symbol` varchar(100) NOT NULL,
  `coin_id` int(11) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `symbol` varchar(100) NOT NULL,
  `initial_price` double(19,8) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `symbol` (`symbol`),
  UNIQUE KEY `symbol_2` (`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (1, NULL, 'BTC', NULL, 'LTC', 'BTC/ LTC', 'Litecoin Exchange', 'LTC_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (2, NULL, 'BTC', NULL, 'DASH', 'BTC/ DASH', 'DASH Exchange', 'DASH_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (3, NULL, 'BTC', NULL, 'DOGE', 'BTC/ DOGE', 'Dogecoin (DOGE) Exchange', 'DOGE_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (4, NULL, 'USD', NULL, 'BTC', 'USDT/ BTC', 'Bitcoin (BTC) Exchange', 'BTC_USD', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (5, NULL, 'USD', NULL, 'LTC', 'USDT/ LTC', 'Litecoin (LTC) Exchange', 'LTC_USD', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (6, NULL, 'USD', NULL, 'DASH', 'USDT/ DASH', 'DigitalCash (DASH) Exchange', 'DASH_USD', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (7, NULL, 'USD', NULL, 'DOGE', 'USDT/ DOGE', 'Dfrtrft', 'DOGE_USD', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (8, NULL, 'LTC', NULL, 'BTC', 'LTC/ BTC', 'Bitcoin (BTC) Exchange', 'BTC_LTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (9, NULL, 'BTC', NULL, 'ETH', 'ETH/BTC', 'Bitcoin (BTC) Exchange	', 'ETH_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (10, NULL, 'BTC', NULL, 'XMR', 'XMR/BTC', 'Bitcoin (BTC) Exchange	', 'XMR_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (11, NULL, 'BTC', NULL, 'ZEC', 'ZEC/BTC', 'Bitcoin (BTC) Exchange	', 'ZEC_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (12, NULL, 'BTC', NULL, 'RDD', 'RDD/BTC', 'Bitcoin (BTC) Exchange	', 'RDD_BTC', '0.00000000', 0);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (13, NULL, 'BTC', NULL, 'VTC', 'VTC/BTC', 'Bitcoin (BTC) Exchange	', 'VTC_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (14, NULL, 'BTC', NULL, 'BCH', 'BCC/BTC', 'Bitcoin (BTC) Exchange	', 'BCH_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (15, NULL, 'BTC', NULL, 'USD', 'USD/BTC', 'Bitcoin (BTC) Exchange	', 'USD_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (16, NULL, 'USD', NULL, 'ETH', 'ETH/USDT', 'Bitcoin (BTC) Exchange	', 'ETH_USD', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (17, NULL, 'BTC', NULL, 'XRP', 'XRP/BTC', 'Bitcoin (BTC) Exchange	', 'XRP_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (18, NULL, 'BTC', NULL, 'XVG', 'XVG/BTC', 'Bitcoin (BTC) Exchange	', 'XVG_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (19, NULL, 'BTC', NULL, 'ETC', 'ETC/BTC', 'Bitcoin (BTC) Exchange', 'ETC_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (20, NULL, 'BTC', NULL, 'XLM', 'XLM/BTC', 'Bitcoin (BTC) Exchange	', 'XLM_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (21, NULL, 'BTC', NULL, 'XEM', 'XEM/BTC', 'Bitcoin (BTC) Exchange	', 'XEM_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (22, NULL, 'BTC', NULL, 'SC', 'SC/BTC', 'Bitcoin (BTC) Exchange	', 'SC_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (23, NULL, 'BTC', NULL, 'WAVES', 'WAVES/BTC', 'Bitcoin (BTC) Exchange	', 'WAVES_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (24, NULL, 'BTC', NULL, 'NEO', 'NEO/BTC', 'Bitcoin (BTC) Exchange	', 'NEO_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (25, NULL, 'BTC', NULL, 'GNT', 'GNT/BTC', 'Bitcoin (BTC) Exchange	', 'GNT_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (26, NULL, 'BTC', NULL, 'BAT', 'BAT/BTC', 'Bitcoin (BTC) Exchange	', 'BAT_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (27, NULL, 'BTC', NULL, 'OMG', 'OMG/BTC', 'Bitcoin (BTC) Exchange	', 'OMG_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (28, NULL, 'BTC', NULL, 'IOT', 'IOTA/BTC', 'Bitcoin (BTC) Exchange	', 'IOT_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (29, NULL, 'BTC', NULL, 'ONT', 'ONT/BTC', 'Bitcoin (BTC) Exchange	', 'ONT_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (30, NULL, 'BTC', NULL, 'ETN', 'ETN/BTC', 'Bitcoin (BTC) Exchange	', 'ETN_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (31, NULL, 'BTC', NULL, 'ADA', 'ADA/BTC', 'Bitcoin (BTC)Exchange', 'ADA_BTC', '0.00000000', 1);
INSERT INTO `dbt_coinpair` (`id`, `market_id`, `market_symbol`, `coin_id`, `currency_symbol`, `name`, `full_name`, `symbol`, `initial_price`, `status`) VALUES (32, NULL, 'RDD', NULL, 'LTC', 'cointest', 'cointest', 'LTC_RDD', '0.00000000', 1);


#
# TABLE STRUCTURE FOR: dbt_country
#

DROP TABLE IF EXISTS `dbt_country`;

CREATE TABLE `dbt_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=254 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (8, 'AQ', 'ANTARCTICA', 'Antarctica', 'ATA', NULL, 0);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', 'IOT', NULL, 246);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (44, 'CN', 'CHINA', 'China', 'CHN', 156, 86);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', 'CXR', NULL, 61);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', 'CCK', NULL, 672);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (99, 'IN', 'INDIA', 'India', 'IND', 356, 91);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (168, 'PE', 'PERU', 'Peru', 'PER', 604, 51);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (240, 'RS', 'SERBIA', 'Serbia', 'SRB', 688, 381);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (241, 'AP', 'ASIA PACIFIC REGION', 'Asia / Pacific Region', '0', 0, 0);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (242, 'ME', 'MONTENEGRO', 'Montenegro', 'MNE', 499, 382);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (243, 'AX', 'ALAND ISLANDS', 'Aland Islands', 'ALA', 248, 358);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (244, 'BQ', 'BONAIRE, SINT EUSTATIUS AND SABA', 'Bonaire, Sint Eustatius and Saba', 'BES', 535, 599);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (245, 'CW', 'CURACAO', 'Curacao', 'CUW', 531, 599);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (246, 'GG', 'GUERNSEY', 'Guernsey', 'GGY', 831, 44);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (247, 'IM', 'ISLE OF MAN', 'Isle of Man', 'IMN', 833, 44);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (248, 'JE', 'JERSEY', 'Jersey', 'JEY', 832, 44);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (249, 'XK', 'KOSOVO', 'Kosovo', '---', 0, 381);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (250, 'BL', 'SAINT BARTHELEMY', 'Saint Barthelemy', 'BLM', 652, 590);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (251, 'MF', 'SAINT MARTIN', 'Saint Martin', 'MAF', 663, 590);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (252, 'SX', 'SINT MAARTEN', 'Sint Maarten', 'SXM', 534, 1);
INSERT INTO `dbt_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES (253, 'SS', 'SOUTH SUDAN', 'South Sudan', 'SSD', 728, 211);


#
# TABLE STRUCTURE FOR: dbt_cryptocoin
#

DROP TABLE IF EXISTS `dbt_cryptocoin`;

CREATE TABLE `dbt_cryptocoin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `url` varchar(300) DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) NOT NULL,
  `coin_name` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `algorithm` varchar(100) DEFAULT NULL,
  `proof_type` varchar(100) DEFAULT NULL,
  `show_home` int(11) DEFAULT 0,
  `coin_position` int(11) DEFAULT 0,
  `premined_value` varchar(100) DEFAULT NULL,
  `total_coins_freefloat` varchar(100) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `sponsored` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Id` (`cid`),
  UNIQUE KEY `Symbol` (`symbol`)
) ENGINE=InnoDB AUTO_INCREMENT=2337 DEFAULT CHARSET=utf8;

INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (10, 7605, '/coins/eth/overview', '/upload/coinlist/eth_logo.png', 'ETH', 'ETH', 'Ethereum', 'Ethereum (ETH)', '', 'PoW', 1, 14, 'N/A', 'N/A', 2, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (11, 5038, '/coins/xmr/overview', './upload/coinlist/xmr.png', 'XMR', 'XMR', 'Monero', 'Monero (XMR)', '', 'PoW', 1, 15, 'N/A', 'N/A', 5, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (14, 4432, '/coins/doge/overview', './upload/coinlist/doge.png', 'DOGE', 'DOGE', 'Dogecoin', 'Dogecoin (DOGE)', '', 'PoW', 1, 5, 'N/A', 'N/A', 8, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (15, 24854, '/coins/zec/overview', './upload/coinlist/zec.png', 'ZEC', 'ZEC', 'ZCash', 'ZCash (ZEC)', '', 'PoW', 1, 16, 'N/A', 'N/A', 9, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (19, 2349, '/coins/ppc/overview', './upload/coinlist/peercoin-logo.png', 'PPC', 'PPC', 'PeerCoin', 'PeerCoin (PPC)', '', 'N/A', 1, 11, 'N/A', 'N/A', 14, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (117, 4524, '/coins/ftc/overview', './upload/coinlist/ftc.png', 'FTC', 'FTC', 'FeatherCoin', 'FeatherCoin (FTC)', '', 'PoW', 1, 9, 'N/A', 'N/A', 120, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (183, 4592, '/coins/rdd/overview', './upload/coinlist/rdd.png', 'RDD', 'RDD', 'ReddCoin', 'ReddCoin (RDD)', '', 'PoW/PoS', 1, 7, 'N/A', 'N/A', 188, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (202, 4614, '/coins/xlm/overview', './upload/coinlist/str.png', 'XLM', 'XLM', 'Stellar', 'Stellar (XLM)', '', 'N/A', 1, 20, 'N/A', 'N/A', 208, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (225, 5018, '/coins/vtc/overview', './upload/coinlist/vtc.png', 'VTC', 'VTC', 'VertCoin', 'VertCoin (VTC)', '', 'PoW', 1, 10, 'N/A', 'N/A', 232, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (247, 5285, '/coins/xem/overview', './upload/coinlist/xem.png', 'XEM', 'XEM', 'NEM', 'NEM (XEM)', '', 'PoI', 1, 21, 'N/A', 'N/A', 254, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (548, 20728, '/coins/unit/overview', './upload/coinlist/unit.png', 'UNIT', 'UNIT', 'Universal Currency', 'Universal Currency (UNIT)', '', 'PoW/PoS', 1, 13, 'N/A', 'N/A', 566, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (634, 22325, '/coins/mue/overview', './upload/coinlist/mue.png', 'MUE', 'MUE', 'MonetaryUnit', 'MonetaryUnit (MUE)', '', 'PoW', 1, 12, 'N/A', 'N/A', 655, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (1192, 127356, '/coins/iot/overview', './upload/coinlist/iota_logo.png', 'IOT', 'IOT', 'IOTA', 'IOTA (IOT)', '', 'Tangle', 1, 18, 'N/A', 'N/A', 1247, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (1296, 187440, '/coins/omg/overview', './upload/coinlist/omisego.png', 'OMG', 'OMG', 'OmiseGo', 'OmiseGo (OMG)', '', 'PoS', 1, 17, 'N/A', 'N/A', 1362, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (1356, 202330, '/coins/bch/overview', './upload/coinlist/bch.jpg', 'BCH', 'BCH', 'Bitcoin Cash / BCC', 'Bitcoin Cash / BCC (BCH)', '', 'PoW', 1, 2, 'N/A', 'N/A', 1425, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2041, 4433, '/coins/xvg/overview', './upload/coinlist/xvg.png', 'XVG', 'XVG', 'Verge', 'Verge (XVG)', '', 'PoW', 1, 22, 'N/A', 'N/A', 99, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2084, 3807, '/coins/dash/overview', './upload/coinlist/imageedit_27_4355944719.png', 'DASH', 'DASH', 'DigitalCash', 'DigitalCash (DASH)', '', 'PoW/PoS', 1, 4, 'N/A', 'N/A', 4, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2146, 792725, '/coins/spd/overview', './upload/coinlist/spd.png', 'SPD', 'SPD', 'Stipend', 'Stipend (SPD)', '', 'PoW/PoS', 1, 6, 'N/A', 'N/A', 2403, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2211, 1182, '/coins/btc/overview', './upload/coinlist/btc.png', 'BTC', 'BTC', 'Bitcoin', 'Bitcoin (BTC)', '', 'PoW', 1, 1, 'N/A', 'N/A', 1, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2216, 808414, '/coins/ont/overview', './upload/coinlist/ont.jpg', 'ONT', 'ONT', 'Ontology', 'Ontology (ONT)', '', 'N/A', 1, 19, 'N/A', 'N/A', 2446, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2243, 3808, '/coins/ltc/overview', './upload/coinlist/litecoin-logo.png', 'LTC', 'LTC', 'Litecoin', 'Litecoin (LTC)', '', 'PoW', 1, 3, 'N/A', 'N/A', 3, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2301, 166503, '/coins/eos/overview', './upload/coinlist/eos_1.png', 'EOS', 'EOS', 'EOS', 'EOS (EOS)', '', 'DPoS', 1, 23, 'N/A', 'N/A', 1274, '0', 1);
INSERT INTO `dbt_cryptocoin` (`id`, `cid`, `url`, `image`, `name`, `symbol`, `coin_name`, `full_name`, `algorithm`, `proof_type`, `show_home`, `coin_position`, `premined_value`, `total_coins_freefloat`, `rank`, `sponsored`, `status`) VALUES (2336, 1, '/coins/chf/overview', 'upload/advertisement/cc4cbceda63ec9bb5ba579af8f572e93.jpg', 'USD', 'USD', 'Dollar', 'USD Dollar', '', 'N/A', 0, 2000, 'N/A', 'N/A', 1, '0', 1);


#
# TABLE STRUCTURE FOR: dbt_deposit
#

DROP TABLE IF EXISTS `dbt_deposit`;

CREATE TABLE `dbt_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `amount` double(19,8) NOT NULL,
  `method_id` varchar(50) NOT NULL,
  `fees_amount` double(19,8) NOT NULL,
  `comment` text DEFAULT NULL,
  `deposit_date` datetime DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=Pending, 1= confirm, 2=Cancel',
  `ip` varchar(50) NOT NULL,
  `approved_cancel_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (1, 'WM5PAU', NULL, 'BTC', '7000.00000000', 'stripe', '700.00000000', NULL, '2021-01-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (2, 'WM5PAU', NULL, 'USD', '7000.00000000', 'stripe', '700.00000000', NULL, '2021-01-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (3, 'WM5PAU', NULL, 'BTC', '9500.00000000', 'stripe', '950.00000000', NULL, '2021-02-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (4, 'WM5PAU', NULL, 'USD', '9500.00000000', 'stripe', '950.00000000', NULL, '2021-02-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (5, 'WM5PAU', NULL, 'BTC', '15000.00000000', 'stripe', '1500.00000000', NULL, '2021-03-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (6, 'WM5PAU', NULL, 'USD', '15000.00000000', 'stripe', '1500.00000000', NULL, '2021-03-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (7, 'WM5PAU', NULL, 'BTC', '9500.00000000', 'stripe', '950.00000000', NULL, '2021-04-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (8, 'WM5PAU', NULL, 'USD', '9500.00000000', 'stripe', '950.00000000', NULL, '2021-04-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (9, 'WM5PAU', NULL, 'BTC', '17000.00000000', 'stripe', '1700.00000000', NULL, '2021-05-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (10, 'WM5PAU', NULL, 'USD', '17000.00000000', 'stripe', '1700.00000000', NULL, '2021-05-27 03:49:33', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (11, '4YLXRA', NULL, 'USD', '5000.00000000', 'stripe', '1000.00000000', NULL, '2021-03-02 06:37:03', NULL, 1, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (12, '4YLXRA', NULL, 'USD', '1001.00000000', 'bank', '200.20000000', '{\"currency_symbol\":\"USD\",\"acc_name\":\"Mehedi Hassan\",\"acc_no\":\"985124783654125\",\"branch_name\":\"Nikunjo\",\"swift_code\":\"2002\",\"abn_no\":\"2982\",\"country\":\"BD\",\"bank_name\":\"Islami Bank\",\"document\":null}', '2021-03-03 22:23:16', NULL, 0, '::1', NULL);
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (13, '4YLXRA', NULL, 'BTC', '10.00000000', 'admin', '0.00000000', 'test', '2021-03-03 22:34:34', '2021-03-03 22:34:34', 1, '::1', 'admin');
INSERT INTO `dbt_deposit` (`id`, `user_id`, `currency_id`, `currency_symbol`, `amount`, `method_id`, `fees_amount`, `comment`, `deposit_date`, `approved_date`, `status`, `ip`, `approved_cancel_by`) VALUES (14, '4YLXRA', NULL, 'SPD', '1000.00000000', 'admin', '0.00000000', 'dssdfsd', '2021-03-04 06:07:11', '2021-03-04 06:07:11', 1, '::1', 'admin');


#
# TABLE STRUCTURE FOR: dbt_fees
#

DROP TABLE IF EXISTS `dbt_fees`;

CREATE TABLE `dbt_fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(100) NOT NULL,
  `fees` double NOT NULL,
  `currency_id` int(11) NOT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_fees` (`id`, `level`, `fees`, `currency_id`, `currency_symbol`, `status`) VALUES (1, 'DEPOSIT', '20', 0, 'USD', 1);
INSERT INTO `dbt_fees` (`id`, `level`, `fees`, `currency_id`, `currency_symbol`, `status`) VALUES (2, 'WITHDRAW', '10', 0, 'USD', 1);


#
# TABLE STRUCTURE FOR: dbt_market
#

DROP TABLE IF EXISTS `dbt_market`;

CREATE TABLE `dbt_market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `full_name` varchar(300) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_market` (`id`, `name`, `full_name`, `symbol`, `status`) VALUES (1, 'BTC', 'BTC Market', 'BTC', 1);
INSERT INTO `dbt_market` (`id`, `name`, `full_name`, `symbol`, `status`) VALUES (2, 'USD', 'USDT Market', 'USD', 1);
INSERT INTO `dbt_market` (`id`, `name`, `full_name`, `symbol`, `status`) VALUES (3, 'LTC', 'LTC Market', 'LTC', 1);
INSERT INTO `dbt_market` (`id`, `name`, `full_name`, `symbol`, `status`) VALUES (4, 'Doge', 'Dogecoin Market', 'DOGE', 1);


#
# TABLE STRUCTURE FOR: dbt_payout_method
#

DROP TABLE IF EXISTS `dbt_payout_method`;

CREATE TABLE `dbt_payout_method` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(250) NOT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `method` varchar(250) NOT NULL,
  `wallet_id` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `dbt_payout_method` (`id`, `user_id`, `currency_symbol`, `method`, `wallet_id`, `status`) VALUES (1, '4YLXRA', 'USD', 'stripe', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', 1);
INSERT INTO `dbt_payout_method` (`id`, `user_id`, `currency_symbol`, `method`, `wallet_id`, `status`) VALUES (2, '4YLXRA', 'USD', 'bank', '{\"currency_symbol\":\"USD\",\"acc_name\":\"Mehedi Hassan\",\"acc_no\":\"985124783654125\",\"branch_name\":\"Nikunjo\",\"swift_code\":\"2002\",\"abn_no\":\"2982\",\"country\":\"BD\",\"bank_name\":\"Islami Bank\"}', 1);


#
# TABLE STRUCTURE FOR: dbt_security
#

DROP TABLE IF EXISTS `dbt_security`;

CREATE TABLE `dbt_security` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(20) NOT NULL,
  `data` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (1, 'url', '{\"url\":\"http:\\/\\/localhost\\/tradebox_ci4_final_test\\/\"}', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (2, 'login', '{\"duration\":\"30\",\"wrong_try\":\"3\",\"ip_block\":\"3\"}', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (3, 'https', '{\"cookie_secure\":0,\"cookie_http\":0}', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (4, 'xss_filter', '', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (5, 'csrf_token', '', 1);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (6, 'capture', '{\"site_key\":\"6Lddh0AUAAAAAJm25vFsAOOG0Hixa1ZVg17jQ9ca\",\"secret_key\":\"6Lddh0AUAAAAAHNQXul04PdL7ponU4N9QiKywGt-\"}', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (7, 'sms', '', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (8, 'encryption', '', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (9, 'password', '', 0);
INSERT INTO `dbt_security` (`id`, `keyword`, `data`, `status`) VALUES (10, 'email', '', 0);


#
# TABLE STRUCTURE FOR: dbt_sms_email_template
#

DROP TABLE IF EXISTS `dbt_sms_email_template`;

CREATE TABLE `dbt_sms_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_or_email` varchar(10) NOT NULL,
  `template_name` varchar(50) NOT NULL,
  `subject_en` varchar(300) NOT NULL,
  `subject_fr` varchar(300) NOT NULL,
  `template_en` varchar(300) NOT NULL,
  `template_fr` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (1, 'sms', 'transfer_verification', 'Transfer Verification Code', 'Transfer Verification Code', 'You are about to transfar %amount% to the account %receiver_id% Your code is %code%\r\n', 'Vous êtes sur le point de transférer% amount% sur le compte% receiver_id% Votre code est %code%\r\n');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (2, 'email', 'transfer_verification', 'Transfer Verification', 'Transfer Verification', 'You are about to transfar %amount% to the account %receiver_id%  Your code is %varify_code%', 'Vous êtes sur le point de transférer% amount% sur le compte% receiver_id% Votre code est % varify_code% ');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (3, 'sms', 'transfer_success', 'Transfer Confirm', 'Transfer Confirm', 'You successfully transfer The amount $%amount% to the account %receiver_id%. Your new balance is %new_balance%', 'You successfully transfer The amount $%amount% to the account %receiver_id%. Your new balance is %new_balance%');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (4, 'email', 'transfer_success', 'Tranfer Confirm', 'Tranfer Confirm', 'You successfully transfer The amount $%amount% to the account %receiver_id%. Your new balance is %new_balance%', 'You successfully transfer The amount $%amount% to the account %receiver_id%. Your new balance is %new_balance%');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (5, 'sms', 'withdraw_verification', '', '', 'You Withdraw The Amount Is %amount% The Verification Code is <h1>%varify_code%</h1>', 'You Withdraw The Amount Is %amount% The Verification Code is <h1>%varify_code%</h1>');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (6, 'email', 'withdraw_verification', '', '', 'You Withdraw The Amount Is %amount% The Verification Code is <h1>%varify_code%</h1>', 'You Withdraw The Amount Is %amount% The Verification Code is <h1>%varify_code%</h1>');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (7, 'sms', 'withdraw_success', 'Withdraw Success', 'Withdraw Success', 'Hi, %name% You successfully withdraw the amount is $%amount% from your account. Your new balance is $%new_balance%', 'Hi, %name% You successfully withdraw the amount is $%amount% from your account. Your new balance is $%new_balance%');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (8, 'email', 'withdraw_success', 'Withdraw', 'Withdraw', 'You successfully withdraw the amount is $%amount% from your account. Your new balance is $%new_balance%', 'You successfully withdraw the amount is $%amount% from your account. Your new balance is $%new_balance%');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (9, 'email', 'forgot_password', '', '', 'The Verification Code is <h1>%varify_code%</h1>', 'The Verification Code is <h1>%varify_code%</h1>');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (10, 'sms', 'deposit_success', 'Deposit', 'Deposit', 'Hi, %name% You Successfully  Deposit The Amount Is %amount%  date %date%', 'Hi, %name% You Successfully  Deposit The Amount Is %amount%  date %date%');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (11, 'email', 'deposit_success', 'Deposit', 'Deposit', 'You successfully deposit the amount is %amount%. ', 'You successfully deposit the amount is %amount%. ');
INSERT INTO `dbt_sms_email_template` (`id`, `sms_or_email`, `template_name`, `subject_en`, `subject_fr`, `template_en`, `template_fr`) VALUES (12, 'email', 'registered', 'Account Activation', 'Account Activation', 'Your account was created successfully, Please click on the link below to activate your account. %url%\r\n', 'Votre compte a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s, veuillez cliquer sur le lien ci-dessous pour activer votre compte.&nbsp;%url%\r\n');


#
# TABLE STRUCTURE FOR: dbt_theme
#

DROP TABLE IF EXISTS `dbt_theme`;

CREATE TABLE `dbt_theme` (
  `id` int(11) NOT NULL,
  `settings` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `dbt_theme` (`id`, `settings`, `status`) VALUES (1, '{\"menu_bg_color\":\"#03a9f4\",\"menu_font_color\":\"#ffffff\",\"footer_bg_color\":\"#0099de\",\"footer_font_color\":\"#ffffff\",\"btn_bg_color\":\"#03a9f4\",\"btn_font_color\":\"#ffffff\",\"theme_color\":\"#03a9f4\",\"newslatter_bg\":\"#faf7ff\",\"newslatter_font\":\"#fa0505\",\"newslatter_img\":\"assets\\/website\\/img\\/newslatter-bg.jpg\"}', 1);


#
# TABLE STRUCTURE FOR: dbt_transaction_setup
#

DROP TABLE IF EXISTS `dbt_transaction_setup`;

CREATE TABLE `dbt_transaction_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trntype` varchar(20) NOT NULL,
  `acctype` varchar(20) NOT NULL,
  `currency_symbol` varchar(20) NOT NULL,
  `lower` double(19,8) NOT NULL,
  `upper` double(19,8) NOT NULL,
  `duration` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: dbt_transfer
#

DROP TABLE IF EXISTS `dbt_transfer`;

CREATE TABLE `dbt_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_user_id` varchar(255) DEFAULT NULL,
  `receiver_user_id` varchar(255) DEFAULT NULL,
  `amount` double(19,8) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `fees` double(19,8) NOT NULL,
  `request_ip` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `comments` mediumtext DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='client to client transfer success, request data recorded.';

INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (1, 'TGBJSF', 'PKNHGF', '0.00000000', 'BTC', '0.00000000', NULL, '2021-01-01', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (2, 'TGBJSF', 'PKNHGF', '0.00000000', 'USD', '0.00000000', NULL, '2021-01-01', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (3, 'TGBJSF', 'PKNHGF', '2000.00000000', 'BTC', '200.00000000', NULL, '2021-02-02', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (4, 'TGBJSF', 'PKNHGF', '2000.00000000', 'USD', '200.00000000', NULL, '2021-02-02', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (5, 'TGBJSF', 'PKNHGF', '8000.00000000', 'BTC', '800.00000000', NULL, '2021-03-03', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (6, 'TGBJSF', 'PKNHGF', '8000.00000000', 'USD', '800.00000000', NULL, '2021-03-03', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (7, 'TGBJSF', 'PKNHGF', '5000.00000000', 'BTC', '500.00000000', NULL, '2021-04-03', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (8, 'TGBJSF', 'PKNHGF', '5000.00000000', 'USD', '500.00000000', NULL, '2021-04-03', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (9, 'TGBJSF', 'PKNHGF', '6500.00000000', 'BTC', '650.00000000', NULL, '2021-05-03', 'test manual input data', 1);
INSERT INTO `dbt_transfer` (`id`, `sender_user_id`, `receiver_user_id`, `amount`, `currency_symbol`, `fees`, `request_ip`, `date`, `comments`, `status`) VALUES (10, 'TGBJSF', 'PKNHGF', '6500.00000000', 'USD', '650.00000000', NULL, '2021-05-03', 'test manual input data', 1);


#
# TABLE STRUCTURE FOR: dbt_user
#

DROP TABLE IF EXISTS `dbt_user`;

CREATE TABLE `dbt_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password_reset_token` varchar(300) DEFAULT NULL,
  `googleauth` varchar(100) DEFAULT NULL,
  `referral_id` varchar(100) DEFAULT NULL,
  `referral_status` tinyint(1) NOT NULL DEFAULT 0,
  `language` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `image` varchar(300) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '"0=Deactivated account, 1=Activated account, 2=Pending account, 3=Suspend account"',
  `verified` int(11) NOT NULL DEFAULT 0 COMMENT '0= did not submit info, 1= verified, 2=Cancel, 3=processing',
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_date` datetime DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (1, 'WM5PAU', 'bdtask ', 'limited', NULL, 'bdtask.mehedi@gmail.com', 'ba00a31d74bca7ba203daa4b9c3e824e', '8801616347466', '1ca3bf0d4399810a3bbb61a8b49afd02', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:07:54', '2021-02-27 15:43:03', '::1');
INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (4, '4YLXRA', 'Hassan', 'Torun ', 'WM5PAU', 'mehedi.bpi@gmail.com', '5627d18099993c9a4bd65a9e815998e8', NULL, '95664ef4a32129574b3e9057b7ed87c6', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:08:02', '2021-04-04 18:56:30', '::1');
INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (5, 'TCAJ0L', 'Torun ', 'Hassan', NULL, 'turan.vuiyan@gmail.com', 'b98c2ad3ced003a0059b2f8fc9846f7c', NULL, '2b093a77607c468a11dd099e869f6438', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:08:08', '2021-03-04 18:56:05', '::1');
INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (7, 'WM5PAA', 'trader ', 'one', NULL, 'traderone@gmail.com', 'ba00a31d74bca7ba203daa4b9c3e824e', '8801611347466', '1ca3bf0d4399810a3bbb61a8b49afd02', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:08:13', '2021-04-27 09:43:03', '::1');
INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (8, 'WM5PAB', 'trader ', 'two', NULL, 'tradertwo@gmail.com', 'ba00a31d74bca7ba203daa4b9c3e824e', '8801612347466', '1ca3bf0d4399810a3bbb61a8b49afd02', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:08:23', '2021-03-27 09:43:03', '::1');
INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (9, 'WM5PAC', 'trader ', 'three', NULL, 'traderthree@gmail.com', 'ba00a31d74bca7ba203daa4b9c3e824e', '8801613347466', '1ca3bf0d4399810a3bbb61a8b49afd02', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:08:29', '2021-01-27 09:43:03', '::1');
INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (10, 'WM5PAD', 'trader ', 'four', NULL, 'tradertfour@gmail.com', 'ba00a31d74bca7ba203daa4b9c3e824e', '8801614347466', '1ca3bf0d4399810a3bbb61a8b49afd02', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:08:34', '2021-02-27 09:43:03', '::1');
INSERT INTO `dbt_user` (`id`, `user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `password_reset_token`, `googleauth`, `referral_id`, `referral_status`, `language`, `country`, `city`, `address`, `bio`, `image`, `status`, `verified`, `created`, `created_date`, `ip`) VALUES (11, 'WM5PAE', 'trader ', 'five', NULL, 'tradertfive@gmail.com', 'ba00a31d74bca7ba203daa4b9c3e824e', '8801615347466', '1ca3bf0d4399810a3bbb61a8b49afd02', NULL, NULL, 0, 'english', NULL, NULL, NULL, NULL, NULL, 1, 0, '2021-03-06 12:08:40', '2021-04-27 09:43:03', '::1');


#
# TABLE STRUCTURE FOR: dbt_user_log
#

DROP TABLE IF EXISTS `dbt_user_log`;

CREATE TABLE `dbt_user_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_type` varchar(50) NOT NULL COMMENT '"acc_update = User Account Update, login=User Login info, deposit=User Deposit info, transfer=User Transfer info, withdraw=User Withdraw info, open_order="',
  `access_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_agent` varchar(300) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (1, 'login', '2021-02-27 03:45:52', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.182\",\"platform\":\"Windows 10\"}', 'WM5PAU', '::1');
INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (2, 'login', '2021-02-28 02:59:31', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.190\",\"platform\":\"Windows 10\"}', 'WM5PAU', '::1');
INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (3, 'login', '2021-03-01 06:07:09', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.190\",\"platform\":\"Windows 10\"}', '4YLXRA', '::1');
INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (4, 'login', '2021-03-01 22:08:37', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.190\",\"platform\":\"Windows 10\"}', '4YLXRA', '::1');
INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (5, 'login', '2021-03-02 06:31:13', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.190\",\"platform\":\"Windows 10\"}', '4YLXRA', '::1');
INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (6, 'login', '2021-03-03 01:28:26', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.190\",\"platform\":\"Windows 10\"}', '4YLXRA', '::1');
INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (7, 'login', '2021-03-03 06:42:49', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.190\",\"platform\":\"Windows 10\"}', '4YLXRA', '::1');
INSERT INTO `dbt_user_log` (`log_id`, `log_type`, `access_time`, `user_agent`, `user_id`, `ip`) VALUES (8, 'login', '2021-03-03 22:20:45', '{\"device\":\"Chrome\",\"browser\":\"Chrome V-88.0.4324.190\",\"platform\":\"Windows 10\"}', '4YLXRA', '::1');


#
# TABLE STRUCTURE FOR: dbt_user_verify_doc
#

DROP TABLE IF EXISTS `dbt_user_verify_doc`;

CREATE TABLE `dbt_user_verify_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `verify_type` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `id_number` varchar(300) NOT NULL,
  `document1` varchar(300) NOT NULL,
  `document2` varchar(300) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: dbt_verify
#

DROP TABLE IF EXISTS `dbt_verify`;

CREATE TABLE `dbt_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(250) DEFAULT NULL,
  `session_id` varchar(250) DEFAULT NULL,
  `verify_code` varchar(250) DEFAULT NULL,
  `user_id` varchar(250) DEFAULT NULL,
  `data` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `dbt_verify` (`id`, `ip_address`, `session_id`, `verify_code`, `user_id`, `data`, `status`) VALUES (1, '::1', '1', 'H52P7K', '4YLXRA', '{\"user_id\":\"4YLXRA\",\"wallet_id\":\"pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7\",\"currency_symbol\":\"USD\",\"amount\":\"1000\",\"method\":\"stripe\",\"fees_amount\":100,\"comment\":\"\",\"request_date\":\"2021-03-01 06:09:44\",\"status\":2,\"ip\":\"::1\"}', 0);
INSERT INTO `dbt_verify` (`id`, `ip_address`, `session_id`, `verify_code`, `user_id`, `data`, `status`) VALUES (2, '::1', '1', 'LVYQFA', '4YLXRA', '{\"user_id\":\"4YLXRA\",\"wallet_id\":\"pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7\",\"currency_symbol\":\"USD\",\"amount\":\"1000\",\"method\":\"stripe\",\"fees_amount\":100,\"comment\":\"\",\"request_date\":\"2021-03-01 22:10:20\",\"status\":2,\"ip\":\"::1\"}', 0);
INSERT INTO `dbt_verify` (`id`, `ip_address`, `session_id`, `verify_code`, `user_id`, `data`, `status`) VALUES (3, '::1', '1', 'VMAOKJ', '4YLXRA', '{\"user_id\":\"4YLXRA\",\"wallet_id\":\"pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7\",\"currency_symbol\":\"USD\",\"amount\":\"500\",\"method\":\"stripe\",\"fees_amount\":50,\"comment\":\"\",\"request_date\":\"2021-03-03 06:45:38\",\"status\":2,\"ip\":\"::1\"}', 0);


#
# TABLE STRUCTURE FOR: dbt_withdraw
#

DROP TABLE IF EXISTS `dbt_withdraw`;

CREATE TABLE `dbt_withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `wallet_id` text NOT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `method` varchar(50) NOT NULL,
  `fees_amount` double NOT NULL,
  `comment` varchar(300) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `success_date` datetime DEFAULT NULL,
  `cancel_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=Cancel request, 1=Approved request, 2=Pending request',
  `ip` varchar(50) NOT NULL,
  `approved_cancel_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (1, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '4000', 'stripe', '400', '', '2021-01-01 06:09:44', '2021-01-01 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (2, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '4000', 'stripe', '400', '', '2021-01-01 22:10:20', '2021-01-01 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (3, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '7000', 'stripe', '700', '', '2021-02-01 06:09:44', '2021-02-01 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (4, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '7000', 'stripe', '700', '', '2021-02-01 22:10:20', '2021-02-01 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (5, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '6000', 'stripe', '600', '', '2021-03-01 06:09:44', '2021-03-03 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (6, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '6000', 'stripe', '600', '', '2021-03-01 22:10:20', '2021-03-03 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (7, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '10000', 'stripe', '1000', '', '2021-01-01 06:09:44', '2021-03-03 06:37:16', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (8, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '10000', 'stripe', '1000', '', '2021-01-01 22:10:20', '2021-03-03 06:47:10', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (9, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '5000', 'stripe', '500', '', '2021-02-01 06:09:44', '2021-02-01 06:11:00', NULL, 2, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (10, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '5000', 'stripe', '500', '', '2021-02-01 22:10:20', '2021-02-01 06:11:00', NULL, 2, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (11, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '11000', 'stripe', '1100', '', '2021-03-01 06:09:44', '2021-03-03 06:11:00', NULL, 2, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (12, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '11000', 'stripe', '1100', '', '2021-03-01 22:10:20', '2021-03-03 06:11:00', NULL, 2, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (13, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '9000', 'stripe', '900', '', '2021-04-01 06:09:44', '2021-04-03 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (14, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '9000', 'stripe', '900', '', '2021-04-01 22:10:20', '2021-04-03 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (15, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'BTC', '2500', 'stripe', '250', '', '2021-05-01 06:09:44', '2021-05-03 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (16, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '2500', 'stripe', '250', '', '2021-05-01 22:10:20', '2021-05-03 06:11:00', NULL, 1, '::1', NULL);
INSERT INTO `dbt_withdraw` (`id`, `user_id`, `wallet_id`, `currency_id`, `currency_symbol`, `amount`, `method`, `fees_amount`, `comment`, `request_date`, `success_date`, `cancel_date`, `status`, `ip`, `approved_cancel_by`) VALUES (17, '4YLXRA', 'pk_test_slNPQt5QauOfDsTC6kqA3lh0002wnChiH7', NULL, 'USD', '500', 'stripe', '50', '', '2021-03-03 06:45:38', '2021-03-03 06:47:35', NULL, 1, '::1', NULL);


#
# TABLE STRUCTURE FOR: earnings
#

DROP TABLE IF EXISTS `earnings`;

CREATE TABLE `earnings` (
  `earning_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(250) NOT NULL,
  `Purchaser_id` varchar(250) DEFAULT NULL,
  `earning_type` varchar(45) NOT NULL,
  `package_id` varchar(250) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `date` varchar(45) NOT NULL,
  `amount` varchar(45) NOT NULL,
  `comments` mediumtext DEFAULT NULL,
  PRIMARY KEY (`earning_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Weekly ROI, Monthly ROI, team bonous, direct referal bonous';

#
# TABLE STRUCTURE FOR: email_sms_gateway
#

DROP TABLE IF EXISTS `email_sms_gateway`;

CREATE TABLE `email_sms_gateway` (
  `es_id` int(11) NOT NULL AUTO_INCREMENT,
  `gatewayname` varchar(100) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `protocol` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `port` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `mailtype` varchar(100) DEFAULT NULL,
  `charset` varchar(100) DEFAULT NULL,
  `api` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`es_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `email_sms_gateway` (`es_id`, `gatewayname`, `title`, `protocol`, `host`, `port`, `user`, `userid`, `password`, `mailtype`, `charset`, `api`) VALUES (1, 'nexmo', 'Bdtask', NULL, NULL, NULL, NULL, NULL, 'TCtz6dx6s3G4nVQ1', NULL, NULL, '633b7084');
INSERT INTO `email_sms_gateway` (`es_id`, `gatewayname`, `title`, `protocol`, `host`, `port`, `user`, `userid`, `password`, `mailtype`, `charset`, `api`) VALUES (2, 'smtp', 'Bbtask mail', 'smtp', 'smtp.mailtrap.io', '2525', '199a525b4e1f88', '', '06f4bb0c453f48', 'html', 'utf-8', NULL);


#
# TABLE STRUCTURE FOR: external_api_setup
#

DROP TABLE IF EXISTS `external_api_setup`;

CREATE TABLE `external_api_setup` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `data` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `external_api_setup` (`id`, `name`, `data`, `status`) VALUES (1, 'coinmarketcap', '{\"api_key\":\"5cffd167-16c3-4c34-b345-6eef830ce5a3\"}', 1);
INSERT INTO `external_api_setup` (`id`, `name`, `data`, `status`) VALUES (2, 'maps', '{\"api_key\":\"AIzaSyAUmj7I0GuGJWRcol-pMUmM4rrnHS90DE8\"}', 1);
INSERT INTO `external_api_setup` (`id`, `name`, `data`, `status`) VALUES (3, 'Cryptocompare', '{\"api_key\":\"c124160ff7c3fbab3d5aa4c077e52f777e5296c1959326227f4187b3f7d7a695\"}', 1);


#
# TABLE STRUCTURE FOR: language
#

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phrase` text NOT NULL,
  `english` text DEFAULT NULL,
  `french` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=928 DEFAULT CHARSET=utf8;

INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (1, 'email', 'Email', 'E-mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (2, 'password', 'Password', 'Mot De Passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (3, 'login', 'Login', 'S\'identifier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (4, 'incorrect_email_password', 'Incorrect Email/Password!', 'Mot de passe ou email incorrect');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (5, 'user_role', 'User Role', 'RÃ´le Utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (6, 'please_login', 'Please Login', 'Veuillez Vous Connecter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (7, 'setting', 'Setting', 'Réglage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (8, 'profile', 'Profile', 'Profil');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (9, 'logout', 'Log Out', 'DÃ©connexion');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (10, 'please_try_again', 'Please Try Again', 'Essayez encore !');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (11, 'admin', 'Admin', 'Admin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (12, 'dashboard', 'Dashboard', 'Tableau de Bord');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (13, 'language_setting', 'Language Setting', 'Reglage Langue');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (14, 'status', 'Status', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (15, 'active', 'Active', 'Actif');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (16, 'inactive', 'Inactive', 'Inactif');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (17, 'cancel', 'Cancel', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (18, 'save', 'Save', 'Sauver');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (19, 'serial', 'Serial', 'En Série');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (20, 'action', 'Action', 'Action');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (21, 'edit', 'Edit ', 'Editer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (22, 'delete', 'Delete', 'Effacer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (23, 'save_successfully', 'Save Successfully!', 'Sauvegarde reussi');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (24, 'update_successfully', 'Update Successfully!', 'Mise Ã  jour reussi');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (25, 'delete_successfully', 'Delete Successfully', 'Supprimer Avec Succès');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (26, 'are_you_sure', 'Are You Sure', 'êtes-vous Sûr');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (27, 'ip_address', 'IP Address', 'Adresse IP');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (28, 'application_title', 'Application Title', 'Titre appli');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (29, 'favicon', 'Favicon', 'favicon');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (30, 'logo', 'Logo', 'Logo');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (31, 'footer_text', 'Footer Text', 'Titre Footer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (32, 'language', 'Language', 'Langue');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (33, 'website_title', 'Website Title', 'Titre site web');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (34, 'invalid_logo', 'Invalid Logo', 'Logo invalide');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (35, 'submit_successfully', 'Submit Successfully!', 'Envoi reussi');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (36, 'application_setting', 'Application Setting', 'Reglages appli');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (37, 'invalid_favicon', 'Invalid Favicon', 'Favicon Invalide');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (38, 'submit', 'Submit', 'Envoyez');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (39, 'site_align', 'Website Align', 'Alignement site');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (40, 'right_to_left', 'Right to Left', 'Doite vers la gauche');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (41, 'left_to_right', 'Left to Right', 'Gauche Vers la droite');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (42, 'subject', 'Subject', 'Sujet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (43, 'receiver_name', 'Send To', 'Nom BÃ©nÃ©ficiaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (44, 'select_user', 'Select User', 'Selectionner Utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (45, 'message_sent', 'Messages Sent', 'Message EnvoyÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (46, 'mail', 'Mail', 'Mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (47, 'send_mail', 'Send Mail', 'Envoyer Mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (48, 'mail_setting', 'Mail Setting', 'Reglage mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (49, 'protocol', 'Protocol', 'Protocole');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (50, 'mailpath', 'Mail Path', 'Repertoire Mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (51, 'mailtype', 'Mail Type', 'Type mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (52, 'validate_email', 'Validate Email Address', 'Validez votre Email');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (53, 'true', 'True', 'Vraie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (54, 'false', 'False', 'faux');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (55, 'attach_file', 'Attach File', 'Joindre un document');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (56, 'wordwrap', 'Enable Word Wrap', 'Wordwrap');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (57, 'send', 'Send', 'Envoyer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (58, 'app_setting', 'App Setting', 'Reglages appli');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (59, 'sms', 'SMS', 'SMS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (60, 'gateway_setting', 'Gateway Setting', 'Reglage portail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (61, 'time_zone', 'Time Zone', 'Time Zone');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (62, 'provider', 'Provider', 'Fournisseur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (63, 'sms_template', 'SMS Template', 'Template SMS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (64, 'template_name', 'Template Name', 'Nom du template');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (65, 'sms_schedule', 'SMS Schedule', 'Emploi du temps SMS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (66, 'schedule_name', 'Schedule Name', 'Nom d\'horaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (67, 'time', 'Time', 'Temps');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (68, 'already_exists', 'Already Exists', 'Existe dÃ©jÃ ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (69, 'send_custom_sms', 'Send Custom SMS', 'Envoyer SMS personalisÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (70, 'sms_sent', 'SMS Sent!', 'SMS envoyÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (71, 'custom_sms_list', 'Custom SMS List', 'List SMS personalisÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (72, 'reciver', 'Reciver', 'BÃ©nÃ©ficiaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (73, 'auto_sms_report', 'Auto SMS Report', 'Rapport SMS Auto');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (74, 'user_sms_list', 'User SMS List', 'Liste SMS utilisateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (75, 'send_sms', 'Send SMS', 'Envoyer SMS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (76, 'new_sms', 'New SMS', 'Nouveau Message');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (77, 'update', 'Update', 'Mettre à Jour');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (78, 'reset', 'Reset', 'Réinitialiser');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (79, 'messages', 'Messages', 'Messages');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (80, 'inbox', 'Inbox', 'Boite de rÃ©ception');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (81, 'sent', 'Sent', 'EnvoyÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (82, 'captcha', 'Captcha', 'Captcha');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (83, 'welcome_back', 'Welcome back ', 'Bienvenue Ã  nouveau !');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (84, 'inbox_message', 'Inbox Message', 'SMS Boite de rÃ©ception');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (85, 'image_upload_successfully', 'Image Upload Successfully.', 'Upload d\'image reussi');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (87, 'users', 'Users', 'Utilisateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (88, 'add_user', 'Add User', 'Ajouter utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (89, 'user_list', 'User List', 'Liste Utilisateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (90, 'firstname', 'First Name', 'Nom');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (91, 'lastname', 'Last Name', 'PrÃ©noms');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (92, 'about', 'About', 'A propos de nous');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (93, 'preview', 'Preview', 'Visualliser');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (94, 'last_login', 'Last Login', 'DerniÃ¨re connexion');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (95, 'last_logout', 'Last Logout', 'DerniÃ¨re DÃ©connexion');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (96, 'image', 'Image', 'Image');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (97, 'fullname', 'Full Name', 'Nom Complet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (98, 'new_message', 'New Message', 'Nouveau Message');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (99, 'message', 'Message', 'Message');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (100, 'sender_name', 'Sender Name', 'Nom de l\'expÃ©diteur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (101, 'sl_no', 'SL No.', 'NumÃ©ro SL');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (103, 'message_details', 'Message Details', 'DÃ©tails message');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (104, 'date', 'Date', 'Date');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (105, 'select_option', 'Select Option', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (106, 'edit_profile', 'Edit Profile', 'Editer Profile');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (107, 'edit_user', 'Edit User', 'Editer utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (108, 'sent_message', 'Sent Message', 'Message EnvoyÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (109, 'sub_admin', 'Sub Admin', 'Sub Administrateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (110, 'admin_list', 'Admin List', 'List Administrateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (111, 'add_admin', 'Add Admin', 'Ajouter Administrateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (112, 'edit_admin', 'Edit Admin', 'Modifier L\'administrateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (113, 'username', 'Username', 'Nom utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (114, 'sponsor_id', 'Sponsor ID', 'ID sponsor');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (115, 'mobile', 'Mobile', 'Mobile');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (116, 'register', 'Register', 'Enregistrer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (117, 'conf_password', 'Confirm Password', 'Reglage mot de passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (118, 'user_id', 'User ID', 'ID utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (119, 'package', 'Package', 'Pack');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (120, 'create', 'Create', 'CrÃ©er');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (121, 'package_name', 'Package Name', 'Nom du pack');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (122, 'package_deatils', 'Package Deatils', 'Detail pack');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (123, 'package_amount', 'Package Amount', 'Montant pack');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (124, 'daily_roi', 'Daily ROI', 'ROI journalier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (125, 'weekly_roi', 'Weekly ROI', 'ROI Hebdomadaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (126, 'monthly_roi', 'Monthly ROI', 'ROI Mensuel');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (127, 'yearly_roi', 'Yearly ROI', 'ROI annuel');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (128, 'total_percent', 'Total Percent', 'Poucentage Total');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (129, 'add_package', 'Add Package', 'Ajouter un Pack');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (130, 'edit_package', 'Edit Package', 'Editer Pack');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (131, 'package_list', 'Package List', 'Liste Packs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (132, 'withdraw', 'Withdraw', 'Se Désister');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (133, 'request', 'Request', 'RequÃªte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (134, 'success', 'Success', 'SuccÃ¨s ! ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (135, 'request_date', 'Request Date', 'Date RequÃªte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (136, 'payment_method', 'Payment Method', 'Methode de paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (137, 'amount', 'Amount', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (138, 'charge', 'Charge', 'Frais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (139, 'total', 'Total', 'Total');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (140, 'comments', 'Comments', 'Commentaires');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (141, 'pending', 'Pending', 'En cours');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (142, 'cancel_date', 'Cancel Date', 'Annuler date');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (143, 'block_list', 'Block List', 'Liste Noire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (144, 'commission', 'Commission', 'Commission');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (145, 'setup', 'Setup', 'Regler');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (146, 'setup_list', 'Setup List', 'Liste de reglage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (147, 'commission_list', 'Commission List', 'Liste Commission');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (148, 'level_name', 'Level Name', 'Nom du stage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (149, 'personal_invest', 'Personal Invest', 'Mon investissement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (150, 'total_invest', 'Total Invest', 'Total Investissement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (151, 'team_bonous', 'Team Bonous', 'Bonus d\'Equipe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (152, 'referral_bonous', 'Referral Bonous', 'Bonus parrainage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (154, 'form_submit_msg', 'Insert Successfully', 'Envoyer formulaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (155, 'transection_category', 'Transaction Category', 'CatÃ©gorie Transaction');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (156, 'transfer_add_msg', 'Transfer Successfully', 'Ajouter SMS transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (157, 'transfer', 'Transfer', 'Transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (158, 'deposit', 'Deposit', 'Dépôt');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (159, 'add_deposit', 'Add Deposit', 'Effectuer un Depot');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (160, 'deposit_list', 'Deposit List', 'Liste depot');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (161, 'team', 'Team', 'Equipe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (162, 'investment', 'Investment', 'Investissement personnel');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (163, 'notification', 'Notification', 'Notification');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (164, 'receiver_id', 'Receiver Id', 'ID BÃ©nÃ©ficiaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (165, 'comment', 'Comments', 'Commentaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (166, 'otp_send_to', 'OTP Send To', 'OTP envoyer Ã ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (167, 'transection', 'Transaction', 'Transactions');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (168, 'buy', 'Buy', 'Acheter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (170, 'deposit_amount', 'Deposit Amount', 'Montant Depot');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (171, 'deposit_method', 'Deposit Method', 'Methode depot');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (172, 'deposit_wallet_id', 'Deposit Wallet Id', 'Wallet ID');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (174, 'confirm_transfer', 'Confirm Transfer', 'Confirmer transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (175, 'transfer_amount', 'Transfer Amount', 'Montant Transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (176, 'enter_verify_code', 'Enter Verify Code', 'Entrer code de vÃ©rification');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (177, 'confirm', 'Confirm', 'Confirmer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (178, 'deopsit_add_msg', 'Deposit Add Successfully.', 'Depot effectuÃ© avec succÃ¨s');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (179, 'transfar_recite', 'Transfer Recite', 'ReÃ§u de transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (180, 'earn', 'Earn', 'Gagner');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (181, 'balance_is_unavailable', 'Balance Unavailable', 'Solde insuffisant');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (182, 'package_buy_successfully', 'Package Buy Successfully!', 'Achat du package reussi ! ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (184, 'withdraw_recite', 'Withdraw Recite', 'ReÃ§u de retrait');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (185, 'withdraw_confirm', 'withdraw Confirm', 'Confirmation Retrait');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (187, 'change_verify', 'Confirm Verify', 'Changer Verification');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (188, 'change_password', 'Password Change', 'Changer mot de passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (189, 'enter_confirm_password', 'Enter Confirm Password', 'Confirmer mot de passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (190, 'enter_new_password', 'Enter New Password', 'Entrer nouveau mot de passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (191, 'enter_old_password', 'Enter Old Password', 'Entrer ancien mot de passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (192, 'change', 'Change', 'Changement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (193, 'password_change_successfull', 'Password Change Successfully', 'Mot de passe changÃ© avec succÃ¨s');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (194, 'old_password_is_wrong', 'Old Password Is Wrong', 'Entrer ancien mot de passe incorrect');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (195, 'fees_setting', 'Fees Setting', 'Reglages frais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (196, 'level', 'Level', 'Stage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (197, 'select_level', 'Select Level', 'Selectionner stage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (198, 'fees_setting_successfully', 'Fees Setting Successfully', 'Reglages Frais reussi');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (199, 'bitcoin', 'Bitcoin', 'Bitcoin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (200, 'payeer', 'Payeer', 'Payeer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (201, 'name', 'Name', 'Nom');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (202, 'order_id', 'Order Id', 'ID de commande');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (203, 'fees', 'Fees', 'Frais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (204, 'period', 'Period', 'PÃ©riode');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (205, 'commission_ret', 'Commission Ret', 'Commission ret');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (206, 'title', 'Title', 'Titre');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (207, 'details', 'Details', 'Details');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (208, 'personal_info', 'Personal Information', 'Informations personnels');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (209, 'sponsor_info', 'Sponsor Information', 'Info Sponsor');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (210, 'affiliate_url', 'Affiliat Url', 'Lien parrainage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (211, 'copy', 'Copy', 'Copier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (212, 'my_payout', 'My Payout', 'Mes Paiements');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (213, 'personal_sales', 'Personal Sales', 'Ventes Personnelles');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (214, 'bank_details', 'Bank Details', 'Details de banque');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (215, 'beneficiary_name', 'Beneficiary Name', 'Nom Beneficiaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (216, 'bank_name', 'Bank Name', 'Nom de banque');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (217, 'branch', 'Branch', 'Branche');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (218, 'account_number', 'Account Number', 'NumÃ©ro de compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (219, 'ifsc_code', 'IFC Code', 'Code IFSC');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (220, 'account', 'Account', 'Compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (221, 'my_commission', 'My Commission', 'Mes commissions');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (222, 'finance', 'Finance', 'La Finance');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (223, 'exchange', 'Exchange', 'Echange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (224, 'bitcoin_setting', 'Bitcoin Setting', 'Reglages bitcoin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (225, 'payeer_setting', 'Payeer Setting', 'Reglages Payeer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (226, 'bank_information', 'Bank Information', 'Infos de banque');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (227, 'bitcoin_wallet_id', 'Bitcoin Wallet ID', 'Wallet Bitcoin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (228, 'payment_method_setting', 'Payment Method Setting', 'Reglage methode de paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (229, 'payeer_wallet_id', 'Payeer Wallet Id', 'ID Payeer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (230, 'my_package', 'My Package', 'Mes packs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (231, 'my_team', 'My Team', 'Mon Equipe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (232, 'receipt', 'Receipt', 'RÃ©Ã§u');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (233, 'withdraw_successfull', 'Withdraw Successfully', 'Retrait reussi !');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (234, 'team_bonus', 'Team Bonus', 'Bonus d\'Equipe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (235, 'withdraw_list', 'Withdraw List', 'Liste retraits');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (236, 'pending_withdraw', 'Pending Withdraw', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (237, 'reciver_account', 'Receiver Account', 'Compte BÃ©nÃ©ficiaire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (238, 'french', 'French', 'FranÃ§ais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (239, 'commission_setup', 'Commission Setup', 'Reglage commission');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (240, 'personal_investment', 'Personal Investment', 'Investissement personnel');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (241, 'total_investment', 'Total investment', 'Total Investissement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (242, 'transfer_list', 'Transfer List', 'Liste transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (243, 'form_to', 'From To', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (244, 'receive', 'Receive', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (245, 'wallet_id', 'Wallet Id', 'ID Wallet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (246, 'withdraw_details', 'Withdraw Details', 'Details retraits');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (247, 'generation_one', 'Generation One', 'GÃ©nÃ©ration 1');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (248, 'generation_two', 'Generation Two', 'GÃ©nÃ©ration 2');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (249, 'generation_three', 'Generation Three', 'GÃ©nÃ©ration 3');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (250, 'generation_four', 'Generation Four', 'GÃ©nÃ©ration 4');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (251, 'generation_five', 'Generation Five', 'GÃ©nÃ©ration 5');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (252, 'generation_empty_message', 'You Have No Generation', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (253, 'view', 'View', 'AperÃ§u');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (254, 'cancle', 'Cancel', 'Annuler');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (255, 'type', 'Type', 'Taper');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (256, 'your_total_balance_is', 'Your Total Balance Is', 'Votre montant total est de');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (257, 'bonus', 'Bonus', 'Bonus');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (258, 'personal_turnover', 'Sponser Turnover', 'Mon Chiffre d\'affaire perso');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (259, 'team_turnover', 'Team Turnover', 'Chiffre d\'affaire Equipe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (260, 'post_article', 'Post Article', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (261, 'article_list', 'Article List', 'LIste article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (262, 'add_article', 'Add Article', 'Ajouter article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (263, 'headline_en', 'Headline English', 'Titre EN');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (264, 'headline_fr', 'Headline French', 'Titre  FR');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (265, 'article_en', 'Article EN', 'Article EN');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (266, 'article_fr', 'Article FR', 'Article FR');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (267, 'edit_article', 'Edit Article', 'Editer article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (268, 'cat_list', 'Category List', 'Liste panier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (269, 'add_cat', 'Add Category', 'Ajouter au panier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (270, 'parent_cat', 'Parent Category', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (271, 'cat_name_en', 'Category Name English', 'Nom panier EN');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (272, 'cat_name_fr', 'Category Name French', 'Nom panier FR');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (273, 'cat_title_en', 'Category Title English', 'Titre Panier EN');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (274, 'cat_title_fr', 'Category Title French', 'Titre panier FR');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (275, 'select_cat', 'Select Category', 'Selectionner Cat');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (276, 'edit_cat', 'Edit Category', 'Editer Panier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (277, 'position_serial', 'Position Serial', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (278, 'currency_list', 'Currency List', 'Liste de devise');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (279, 'currency', 'Currency', 'Devise');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (280, 'cryptocurrency_name', 'CryptoCurrency  Name', 'Nom Crypto monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (281, 'select_cryptocurrency', 'Select Cryptocurrency', 'Selectionner Crypto');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (282, 'edit_currency', 'Edit Currency', 'Editer Devise');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (283, 'exchange_list', 'Exchange List', 'Liste Ã©changes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (284, 'add_exchange', 'Add Exchange', 'Ajouter Echange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (285, 'edit_exchange', 'Edit Exchange', 'Editer Echange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (286, 'wallet_data', 'Wallet ID', 'DonnÃ©es Wallet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (287, 'sell_adjustment', 'Sell Adjustment', 'Ajustement Vente');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (288, 'buy_adjustment', 'Buy Adjustment', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (289, 'exchange_wallet', 'Exchange Wallet', 'Wallet Echange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (290, 'exchange_wallet_list', 'Exchange Wallet List', 'Liste Wallet echange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (291, 'add_exchange_wallet', 'Add Exchange Wallet', 'Ajouter Wallet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (292, 'edit_exchange_wallet', 'Edit Exchange Wallet', 'Modifier Wallet echange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (293, 'local_currency_list', 'Local Currency List', 'LIste  Monnaies locales');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (294, 'local_currency', 'Local Currency', 'Devise Locale');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (295, 'add_local_currency', 'Add Local Currency', 'Ajouter Monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (296, 'edit_local_currency', 'Edit Local Currency', 'Editer Devise locale');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (297, 'currency_name', 'Currency Name', 'Nom devise');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (298, 'currency_iso_code', 'Currency ISO Code', 'Code ISO devise ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (299, 'usd_exchange_rate', 'USD Exchange Rate', 'Taux d\'echange USD');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (300, 'currency_symbol', 'Currency Symbol', 'Symboles Devise');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (301, 'symbol_position', 'Symbol Position', 'Position symbole');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (302, 'currency_position', 'Currency Position', 'Position devise');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (303, 'payment_gateway', 'Payment Gateway', 'Portail de paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (304, 'gateway_name', 'Gateway Name', 'Nom passerelle');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (305, 'gateway_setting', 'Gateway Setting', 'Reglage portail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (306, 'add_payment_gateway', 'Add Payment Gateway', 'Ajouter Methode paiment');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (307, 'public_key', 'Public Key', 'ClÃ© publique');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (308, 'private_key', 'Private Key', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (309, 'shop_id', 'Shop ID', 'ID shop');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (310, 'secret_key', 'Secret Key', 'ClÃ© secrete');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (311, 'edit_payment_gateway', 'Edit Payment Gateway', 'Editer Methode de paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (312, 'slider_list', 'Slider List', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (313, 'add_slider', 'Add Slider', 'Ajouter Slider');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (314, 'headline', 'Headline', 'Titre');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (315, 'edit_slider', 'Edit Slider', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (316, 'social_app', 'Social App', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (317, 'edit_social_app', 'Edit Social App', 'Editer RS appli');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (318, 'social_link', 'Social Link', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (319, 'add_link', 'Add Link', 'Ajouter Lien');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (320, 'link', 'Link', 'Lien');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (321, 'icon', 'Icon', 'IcÃ´ne');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (322, 'edit_social_link', 'Edit Social Link', 'Edit les liens RS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (323, 'transection_info', 'Transection Info', 'Info transaction');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (324, 'sell', 'Sell', 'Vendre');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (325, 'article', 'Article', 'Article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (326, 'coin_amount', 'Coin Amount', 'Montat Crypto');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (327, 'coin_name', 'Coin Name', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (328, 'buy_amount', 'Buy Amount', 'Montant achat');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (329, 'sell_amount', 'Sell Amount', 'Montant Ã  vendre');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (330, 'wallet_data', 'Wallet ID', 'DonnÃ©es Wallet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (331, 'usd_amount', 'USD Amount', 'Montant USD');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (332, 'rate_coin', 'Coin Rate', 'Taux coin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (333, 'local_amount', 'Local Amount', 'Montant Local');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (334, 'om_name', 'OM Name', 'Nom OM');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (335, 'om_mobile_no', 'OM Phone No', 'NÂ° OM');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (336, 'transaction_no', 'Transaction No', 'NÂ° de transaction');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (337, 'idcard_no', 'ID Card No', 'NÂ° CNI');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (338, 'buy_list', 'Buy List', 'Buy list');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (339, 'add_buy', 'Add Buy', 'Ajouter Achat');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (340, 'transection_type', 'Transection Type', 'Type de transaction');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (341, 'payment_successfully', 'Payment Successfully', 'Paiement effectuÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (342, 'payment_cancel', 'Payment Cancel', 'Paiement annulÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (343, 'payment_successfully', 'Payment Successfully', 'Paiement effectuÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (344, 'sell_list', 'Sell List', 'LIste de vente ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (345, 'add_sell', 'Add Sell', 'Ajouter Vente');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (346, 'edit_sell', 'Edit Sell', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (347, 'account_active_mail', 'Please check Email to activate your account', 'Activer votre mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (348, 'accept_terms_privacy', 'Crypto Privacy policy and Terms of Use', 'Accepter conditions et termes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (349, 'username_used', 'Username Already Used', 'Nom d\'utilisateur dÃ©jÃ  utilisÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (350, 'account_create_success_social', 'Account Created Successfully and Your Account activated', 'Compte crÃ©e avec succÃ¨s');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (351, 'email_used', 'Email Already Used', 'Adresse mail dÃ©jÃ  utilisÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (352, 'account_create_active_link', 'Account Created Successfully. Activation link send your Email address', 'Lien d\'activation');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (353, 'active_account', 'Active Account', 'Compte actif');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (354, 'wrong_try_activation', 'Wrong Try', 'Mauvaise activation');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (355, 'pay_now', 'Pay Now', 'Payer maintenant');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (356, 'payment_successfully', 'Payment Successfully', 'Paiement effectuÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (357, 'sell_successfully', 'Sell Successfully', 'Vente effectuÃ©e avec succÃ¨s');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (358, 'already_clicked', 'Already Clicked There', 'DÃ©ja ValidÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (359, 'user_info', 'User Info', 'info utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (360, 'user_id', 'User ID', 'ID utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (361, 'registered_ip', 'Registered IP', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (362, 'requested_ip', 'Requested IP', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (363, 'transaction_status', 'Transaction Status', 'Status de la transaction');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (364, 'receive_status', 'receive_status', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (365, 'receive_complete', 'Receive Complete', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (366, 'payment_status', 'Payment Status', 'Status de paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (367, 'payment_complete', 'Payment Complete', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (368, 'url', 'Url', 'URL');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (369, 'app_id', 'App Id', 'ID appli');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (370, 'app_secret', 'App Secret', 'Secret Appli');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (371, 'api_key', 'API Key', 'Clé API');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (372, 'app_name', 'App Name', 'Nom Appli');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (373, 'social_list', 'Social List', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (374, 'select_payment_method', 'Select Payment Method', 'Selectionner mode de paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (375, 'payable', 'Payable', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (376, 'rate', 'Rate', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (377, 'how_do_you_receive_money', 'How do you receive money', 'Comment ReÃ§evoir votre argent');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (378, 'withdraw_method', 'Withdraw Method', 'Methode de retrait');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (379, 'select_withdraw_method', 'Select Withdraw Method', 'Selectionner mÃ©thode de retrait');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (380, 'account_info', 'Account Info', 'Info compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (381, 'upload_docunemts', 'Upload Docunemts', 'Ajouter fichier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (382, 'my_generation', 'My Generation', 'Mon Equipe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (383, 'category', 'Category', 'CatÃ©gorie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (384, 'slider_h1_en', 'Slider H1 English', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (385, 'slider_h1_fr', 'Slider H1 French', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (386, 'slider_h2_en', 'Slider H2 English', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (387, 'slider_h2_fr', 'Slider H2 French', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (388, 'slider_h3_en', 'Slider H3 English', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (389, 'slider_h3_fr', 'Slider H3 French', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (390, 'complete', 'Complete', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (391, 'refresh_currency', 'Refresh Currency', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (392, 'cryptocurrency', 'Crypto Currency', 'Crypto Monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (393, 'symbol', 'Symbol', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (394, 'please_select_cryptocurrency_first', 'Please Select CryptoCurrency First', 'Veuillez choisir une crypto monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (395, 'please_select_diffrent_payment_method', 'Please select Diffrent Payment Method', 'Selectionner une autre mÃ©thode de paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (396, 'add_credit', 'Add Credit', 'Crediter Compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (397, 'credit', 'Credit', 'CrÃ©dit');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (398, 'credit_list', 'Credit List', 'Liste De Crédit');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (399, 'notes', 'Note', 'Notes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (400, 'my_level_info', 'My Level Info', 'Info Niveau');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (401, 'slider', 'Slider', 'Slider');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (402, 'exchange_setting', 'Exchange Setting', 'Reglage Echange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (403, 'exchange_all_request', 'Exchange all Request', 'Toutes requÃªtes echanges');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (404, 'total_user', 'Total User', 'Nombre d\'utilisateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (405, 'total_roi', 'Total ROI', 'Total ROI');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (406, 'total_commission', 'Total Commission', 'Total commission');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (407, 'download_pdf', 'Download PDF', 'TÃ©lÃ©charger ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (408, 'view_all_news', 'View all news', 'AperÃ§u News');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (409, 'download_company_brochure', 'Download Company Brochure', 'TÃ©lÃ©chargez notre brochure');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (410, 'get_in_touch', 'Get in touch', 'Contactez-nous');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (411, 'read_more', 'Read More', 'Lire plus');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (412, 'know_more', 'Know more', 'Savoir plus');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (413, 'choose_plan', 'Choose plan', 'acheter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (414, 'latest_jobs', 'Latest Jobs', 'Latest Jobs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (415, 'website', 'Website', 'website');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (416, 'chose_one_of_the_following_methods', 'Chose One of the Following Methods.', 'chose_one_of_the_following_methods.');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (417, 'sign_in_using_your_email_address', 'Sign in Using Your Email Address', 'Connectez-vous avec votre username ou email');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (418, 'forgot_password', 'Forgot Password', 'Mot De Passe Oublié');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (419, 'remember_me', 'Remember Me', 'Souviens-toi De Moi');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (420, 'username_or_email', 'Username or email', 'Username or email');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (421, 'dont_have_an_account', 'Don\'t have an account', 'Don\'t have an account');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (422, 'sign_up_now', 'Sign up Now', 'CrÃ©er un compte maintenant');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (423, 'send_code', 'Send Code', 'Send Code');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (424, 'sign_up', 'Sign Up', 'S\'inscrire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (425, 'already_user', 'Already User', 'Already User');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (426, 'sign_in_now', 'Sign In Now', 'Connectez-vous maintenant');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (427, 'sign_up_for_free', 'Sign Up For Free', 'CrÃ©er un compte gratuitement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (428, 'join_thousands_of_companies_that_Use_globalcrypt_every_day', 'Join Thousands of Companies that Use Global Crypto Every Day', 'Join Thousands of Companies that Use Global Crypto Every Day');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (429, 'your_password_at_global_crypto_are_encrypted_and_secured', 'Your Password At Global Crypto Are Encrypted And Secured', 'Votre Mot De Passe Chez Global Crypto Est Crypté Et Sécurisé');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (430, 'email_username_used', 'Email/Username Already Used', 'Email/Username Already Used');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (431, 'address', 'Address', 'Address');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (432, 'phone', 'Phone', 'Phone');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (433, 'admin_align', 'Admin Align', 'Admin Align');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (434, 'office_time', 'Office Time', 'Office Time');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (435, 'logo_web', 'WebSite Logo', 'WebSite Logo');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (436, 'dashboard_logo', 'Dashboard Logo', 'Dashboard Logo');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (437, 'advertisement', 'Advertisement', 'Advertisement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (438, 'script', 'Script', 'Script');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (439, 'add_advertisement', 'Add Advertisement', 'Add Advertisement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (440, 'page', 'Page', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (441, 'embed_code', 'Embed code', 'Embed code');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (442, 'add_type', 'Add Type', 'Add Type');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (443, 'edit_advertisement', 'Edit Advertisement', 'Edit Advertisement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (444, 'host', 'Host', 'Host');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (445, 'port', 'Port', 'Port');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (446, 'apikey', 'API Key', 'API Key');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (447, 'mail_type', 'Mail Type', 'Mail Type');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (448, 'charset', 'Charset', 'Charset');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (449, 'news', 'News', 'Nouvelles');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (450, 'news_list', 'News List', 'News List');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (451, 'edit_news', 'Edit News', 'Edit News');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (452, 'post_news', 'Post News', 'Post News');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (453, 'close', 'Close', 'Close');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (454, 'contact_us', 'Contact Us', 'Contact Us');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (455, 'watch_video', 'WATCH VIDEO', 'WATCH VIDEO');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (456, 'about_bitcoin', 'About Bitcoin', 'About Bitcoin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (457, 'get_start', 'Get Start', 'Get Start');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (458, 'cryptocoins', 'Crypto Coins', 'Crypto Coins');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (459, 'subscribe_to_our_newsletter', 'Subscribe to our newsletter!', 'Subscribe to our newsletter!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (460, 'email_newslatter', 'Email Newsletter', 'Email Newsletter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (461, 'services', 'Services', 'Services');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (462, 'our_company', 'Our Company', 'Our Company');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (463, 'sign_in', 'Sign In', 'Connectez-vous');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (464, 'join_the_new_yera_of_cryptocurrency_exchange', 'Join the new Yera of cryptocurrency exchange', 'Join the new Yera of cryptocurrency exchange');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (465, 'access_the_cryptocurrency_experience_you_deserve', 'Access the cryptocurrency experience you deserve', 'Access the cryptocurrency experience you deserve');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (466, 'home', 'Home', 'Accueil');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (467, 'scroll_to_top', 'Scroll to Top', 'Scroll to Top');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (468, 'ticker', 'Ticker', 'Ticker');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (469, 'price', 'Price', 'Prix');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (470, 'capitalization', 'Capitalization', 'Capitalization');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (471, '1d_change', '1D change', '1D change');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (472, 'graph_24h', 'Graph 24H', 'Graph 24H');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (473, 'recent_post', 'Recent Post', 'Recent Post');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (474, 'my_social_link', 'My Social link', 'My Social link');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (475, 'tell_us_about_your_project', 'Tell Us About Your Project', 'Tell Us About Your Project');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (476, 'company', 'Company', 'Company');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (477, 'reset_your_password', 'Reset Your Password', 'Réinitialisez Votre Mot De Passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (478, '24h_change', '24H change', '24H change');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (479, '24h_volume', '24H Volume', '24H Volume');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (480, 'latitudelongitude', 'Latitude, Longitude', 'Latitude, Longitude');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (481, 'send_money', 'Send Money', 'Send Money');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (482, 'article', 'Article', 'article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (483, 'contact', 'Contact', 'Contact');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (484, 'team', 'Team', 'team');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (485, 'client', 'Client', 'client');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (486, 'service', 'Service', 'service');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (487, 'testimonial', 'Testimonial', 'testimonial');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (488, 'faq', 'F.A.Q', 'faq');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (489, 'short_description_en', 'Short description english', 'Short Description');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (490, 'long_description_en', 'Long description English', 'Long Description');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (491, 'short_description_fr', 'Short description english', 'Short Description');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (492, 'long_description_fr', 'Long description English', 'Long Description');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (493, 'info', 'Information', 'Information');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (494, 'quote', 'Quote', 'Quote');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (495, 'question_fr', 'Question French', 'Question French');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (496, 'question_en', 'Question English', 'Question English');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (497, 'answer_en', 'Answer English', 'Answer English');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (498, 'answer_fr', 'Answer French', 'Answer French');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (499, 'content', 'Page Content', 'Page Content');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (500, 'add_content', 'Add Content', 'Add Content');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (501, 'edit_content', 'Edit Content', 'Edit Content');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (502, 'video', 'video (If Youtube Link)', 'video');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (503, 'add_faq', 'Add F.A.Q', 'Add faq');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (504, 'add_testimonial', 'Add Testimonial', 'Add testimonial');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (505, 'add_service', 'Add Service', 'Add service');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (506, 'add_client', 'Add Client', 'Add client');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (507, 'add_team', 'Add Team', 'Add team');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (508, 'add_contact', 'Add Contact', 'Add contact');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (509, 'add_article', 'Add Article', 'Add article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (510, 'edit_article', 'edit Article', 'edit article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (511, 'edit_contact', 'edit Contact', 'edit contact');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (512, 'edit_team', 'edit Team', 'edit team');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (513, 'edit_client', 'edit Client', 'edit client');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (514, 'edit_service', 'edit Service', 'edit service');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (515, 'edit_testimonial', 'edit Testimonial', 'edit testimonial');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (516, 'edit_faq', 'edit F.A.Q', 'edit faq');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (517, 'article_list', 'Article List', 'article');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (518, 'contact_list', 'Contact List', 'contact');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (519, 'team_list', 'Team List', 'team');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (520, 'client_list', 'Client List', 'client');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (521, 'service_list', 'Service List', 'service');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (522, 'testimonial_list', 'Testimonial List', 'testimonial');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (523, 'faq_list', 'F.A.Q List', 'faq');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (524, 'content_list', 'Page Content', 'Page Content');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (525, 'add_teammember', 'Add Teammember', 'Add Teammember');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (526, 'tooltip_package_name', 'Example: Silver Package', 'Example: Silver Package');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (527, 'tooltip_package_details', 'This is for Package Short Details', 'This is for Package Short Details.');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (528, 'tooltip_package_amount', 'Package Amount in Dollar. Example: 200', 'Package Amount in Dollar. Example: 200');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (529, 'tooltip_package_daily_roi', 'Please Set this field with Zero. Example: 0', 'Please Set this field with Zero. Example: 0');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (530, 'tooltip_package_weekly_roi', 'Who buy this package they will get weekly ROI in Dollar. Example: 5. They will get every week 5 till them package period', 'Who buy this package they will get weekly ROI in Dollar. Example: 5. They will get every week 5 till them package period');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (531, 'tooltip_package_monthly_roi', 'Sum of weekly ROI in a month', 'Sum of weekly ROI in a month');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (532, 'tooltip_package_yearly_roi', 'Sum of weekly ROI in a Year', 'Sum of weekly ROI in a Year');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (533, 'tooltip_package_total_percent_roi', 'Total Persent Of ROI', 'Total Persent Of ROI');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (534, 'tooltip_package_period', 'Package Period', 'Package Period');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (535, 'trading', 'Trading', 'Trade');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (536, 'trade_history', 'Trade History', 'Histoire Du Commerce');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (537, 'market', 'Market', 'Marché');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (538, 'coin_pair', 'Coin Pair', 'Coin Pair');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (539, 'pending_deposit', 'Pending Deposit', 'Demande de retrat en cours');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (540, 'email_and_sms_setting', 'Email And Sms Setting', 'Email And Sms Setting');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (541, 'email_and_sms_gateway', 'Email And Sms Gateway', 'Email And Sms Gateway');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (542, 'trade', 'Trade', 'Commerce');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (543, 'referral_id', 'Referral ID', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (544, 'please_enter_valid_email', 'Please Enter Valid Email !!!', 'Please Enter Valid Email !!!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (545, 'already_subscribe', 'This Email Address already subscribed', 'This Email Address already subscribed');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (546, 'message_send_successfuly', 'TMessage send successfuly', 'Message send successfuly');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (547, 'message_send_fail', 'Message send Fail', 'Message send Fail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (548, 'setup_payment_gateway', 'setup payment gateway', 'setup payment gateway');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (549, 'user_profile', 'User Profile', 'User Profile');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (550, 'client_id', 'Client Id', 'Client Id');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (551, 'client_secret', 'Client Secret', 'Client Secret');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (553, 'notice', 'Notice', 'Remarquer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (554, 'edit_notice', 'Edit Notice', 'Edit Notice');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (555, 'language_list', 'Language List', 'Language List');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (556, 'phrase_list', 'Phrase List', 'Phrase List');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (557, 'edit_phrase', 'Edit Phrase', 'Edit Phrase');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (558, 'label_added_successfully', 'Label added successfully!', 'Label added successfully!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (559, 'this_level_already_exist', 'This Level Already Exist!', 'This Level Already Exist!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (560, 'you_successfully_deposit_the_amount', 'You successfully deposit the amount', 'You successfully deposit the amount');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (561, 'your_new_balance_is', 'Your new balance is', 'Your new balance is');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (562, 'account_name', 'Account Name', 'Account Name');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (563, 'account_no', 'Account No', 'Account No');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (564, 'branch_name', 'Branch Name', 'Branch Name');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (565, 'swift_code', 'SWIFT Code', 'SWIFT Code');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (566, 'abn_no', 'ABN No', 'ABN No');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (567, 'country', 'Country', 'Country');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (568, 'bank_name', 'Bank Name', 'Bank Name');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (569, 'there_is_no_phone_number', 'There is no Phone number!!!', 'There is no Phone number!!!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (570, 'coinpair', 'Coinpair', 'Coinpair');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (571, 'edit_coinpair', 'Edit Coinpair', 'Edit Coinpair');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (572, 'edit_coin', 'Edit coin', 'Edit coin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (573, 'coin_market', 'Coin Market', 'Marché Aux Pièces');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (574, 'edit_market', 'Edit Market', 'Modifier Le Marché');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (575, 'leave_us_a_message', 'Leave us a message', 'Leave us a message');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (576, 'verify_type', 'verify type', 'verify type');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (577, 'gender', 'Gender', 'Gender');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (578, 'id_number', 'Id  Number', 'Id Number');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (579, 'verification_is_being_processed', 'Verification Is being Processed', 'Verification Is being Processed');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (580, 'cryptocoin', 'Cryptocoin', 'Cryptocoin french');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (581, 'please_setup_your_bank_account', 'Please setup bank account', 'Please setup bank account');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (582, 'this_gateway_deactivated', 'This Gateway Deactivated', 'This Gateway Deactivated');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (583, 'otp_send_to', 'OTP Send To', 'OTP Send To');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (584, 'your_weekly_limit_exceeded', 'Your weekly Limit exceeded', 'Your weekly exceeded ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (585, 'there_is_no_order_for_cancel', 'There is no order for cancel', 'There is no order for cancel');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (586, 'request_canceled', 'Request Canceled', 'Demande Annulée');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (587, 'referral_id_is_invalid', 'Referral ID is invalid', 'Referral ID is invalid');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (588, 'invalid_ip_address', 'Invalid IP address', 'Invalid IP address');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (589, 'please_activate_your_account', 'Please activate your account', 'Please activate your account');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (590, 'already_regsister', 'Already regsister!!!', 'Already regsister!!!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (591, 'this_account_is_now_pending', 'This account is now pending', 'This account is now pending');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (592, 'this_account_is_suspend', 'This account is suspend', 'This account is suspend');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (593, 'something_wrong', 'Something wrong !!!', 'Something wrong !!!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (594, 'password_missmatch', 'Password Missmatch', 'password missmatch');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (595, 'invalid_authentication_code', 'Invalid Authentication Code', 'Invalid Authentication Code');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (596, 'password_reset_code_send_check_your_email', 'Password reset code send.Check your email.', 'Password reset code send.Check your email.');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (597, 'email_required', 'email required', 'email required');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (598, 'password_changed', 'Password has been changed', 'Password has been changed');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (599, 'google_authenticator_disabled', 'Google Authenticator Disabled', 'Google Authenticator Disabled');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (600, 'google_authenticator_enabled', 'Google Authenticator Enabled', 'Google Authenticator Enabled');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (601, 'this_account_already_activated', 'This account already activated', 'This account already activated');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (602, 'total_balance', 'Total Balance', 'Total Balance');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (603, 'available_balance', 'Available Balance', 'Available balance');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (604, 'open', 'Open', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (605, 'qty', 'QTY', 'QTY');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (606, 'finished_trade', 'Finished Trade', 'Finished Trade');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (607, 'deposit_crypto_dollar', 'Deposit(Crypto/Dollar)', 'Deposit(Crypto/Dollar)');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (608, 'us_dollar', 'US Dollar', 'US Dollar');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (609, 'available', 'Available', 'Disponible');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (610, 'buy_orders', 'Buy Orders', 'Buy Orders');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (611, 'last_price', 'last price', 'last price');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (612, 'sell_orders', 'Sell Orders', 'Sell Orders');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (613, '1hr_change', '1hr Change', '1hr Change');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (614, '1hr_high', '1hr High', '1hr High');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (615, '1hr_low', '1hr Low', '1hr Low');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (616, '1hr_volume', '1hr Volume', '1hr Volume');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (617, 'estimated_open_price', 'Estimated open price', 'Estimated open price');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (618, 'open_fees', 'Open fees', 'Open fees');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (619, 'market_depth', 'Market Depth', 'Market Depth');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (620, 'coin', 'Coin', 'Pièce De Monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (621, 'market_price', 'Market Price', 'Market Price');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (622, 'volume', 'volume', 'volume');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (623, 'live_chat', 'Live Chat', 'Live Chat');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (624, 'market_trade_history', 'Market Trade History', 'Market Trade History');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (625, 'Notices', 'notices', 'notices');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (626, 'posted_by', 'Posted by', 'Posted by');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (627, 'latest_form_our_blog', 'Latest form our blog', 'Latest form our blog');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (628, 'auth_code', 'Auth Code', 'AuthCode');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (629, 'scan_this_barcode_using', 'Scan this BarCode using', 'Scan this BarCode using');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (630, 'google_authentication', 'Google Authentication', 'Google Authentication');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (631, 'install_google_authentication', 'Install Google Authentication', 'Install Google Authentication');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (632, 'if_you_are_unable_to_scan_the_qr_code_please_enter_this_code_manually_into_the_app.', 'If you are unable to scan the QR code, please enter this code manually into the app.', 'If you are unable to scan the QR code, please enter this code manually into the app.');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (633, 'open_order', 'Open Order', 'Open Order');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (634, 'complete_order', 'Complete Order', 'Complete Order');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (635, 'bank_setting', 'Bank Setup', 'Bank Setup');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (636, 'payout_setup', 'Payout Setup', 'Payout Setup');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (637, 'account_login', 'Account Login', 'Account Login');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (638, 'we_never_share_your_email_with_anyone_else', 'We\'ll never share your email with anyone else', 'We\'ll never share your email with anyone else');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (639, 'news_details', 'News Details', 'News Details');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (640, 'open_order_history', 'Open Order History', 'Open Order History');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (641, 'required_qty', 'Required QTY', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (642, 'available_qty', 'Available Quantity ', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (643, 'required_amount', 'Required Amount', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (644, 'available_amount', 'Available Amount', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (645, 'complete_qty', 'Complete QTY', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (646, 'complete_amount', 'complete amount', '');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (647, 'trade_time', 'Trade Time', 'Trade Time');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (648, 'running', 'Running', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (649, '24hr_change', '24hr Change', '24hr Change');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (650, '24hr_high', '24hr High', '24hr High');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (651, '24hr_low', '24hr Low', '1hr Low');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (652, '24hr_volume', '24hr Volume', '24hr Volume');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (653, 'post_comment', 'Post Comment', 'Post Comment');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (654, 'account_created', 'Account Created', 'Account Created');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (655, 'access_time', 'Access Time', 'Access Time');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (656, 'user_agent', 'User Agent', 'User Agent');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (657, 'passport', 'Passport', 'Passport');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (658, 'drivers_license', 'Driver\'s license', 'Driver\'s license');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (659, 'government_issued_id_card', 'Government-issued ID Card', 'Government-issued ID Card');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (660, 'given_name', 'Given Name', 'Given Name');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (661, 'surname', 'Surname', 'Surname');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (662, 'passport_nid_license_number', 'Passport/NID/License Number', 'Passport/NID/License Number');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (663, 'account_register', 'Account Register', 'Account Register');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (664, 'confirm_password', 'Confirm Password', 'Confirm Password');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (665, 'canceled', 'Canceled', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (666, 'completed', 'Completed', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (667, 'crypto_dollar_currency', 'Crypto/Dollar Currency', 'Crypto/Dollar Currency');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (668, 'withdraw_no', 'Withdraw No', 'Withdraw No');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (669, 'male', 'Male', 'Male');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (670, 'female', 'Female', 'Female');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (671, 'verify', 'Verify', 'Verify');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (672, 'server_problem', 'Server Problem', 'Server Problem');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (673, 'verified', 'Verified', 'Vérifié');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (674, 'footer_menu1', 'Footer menu 1', 'Footer menu 1');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (675, 'footer_menu2', 'Footer menu 2', 'Footer menu 2');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (676, 'footer_menu3', 'Social Service', 'Social Service');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (677, 'terms_of_use', 'Terms Of Use', 'Terms Of Use');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (678, 'receiver_not_valid', 'Receiver not valid!!!', 'Receiver not valid!!!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (679, 'first_name_required', 'Please enter your name!', 'Please enter your name!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (680, 'a_lowercase_letter', 'Please Enter a Lowercase letter !', 'Please enter a loswercase letter!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (681, 'password_required', 'Please enter your password!', 'Please enter yYour password!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (682, 'a_capital_uppercase_letter', 'Please Enter a Uppercase letter ! ', 'Please enter a upercase letter!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (683, 'a_number', 'Please Enter a Number!', 'Please enter a number!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (684, 'a_special', 'Please Enter a Special Character !', 'Please enter a  special character!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (685, 'please_enter_at_least_8_characters_input', 'Please enter at least eight characters!', 'Please enter at least eight characters!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (686, 'confirm_password_must_be_filled_out', 'Please enter Confirm password!', 'Please enter Confirm password!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (687, 'must_confirm_privacy_policy_and_terms_and_conditions', 'Must confirm privacy policy and terms and conditions', 'Must confirm privacy policy and terms and conditions');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (688, 'phone_required', 'Enter your phone number!', 'Enter your phone number!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (689, 'email_required', 'Enter your email address!', 'Enter your email address!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (690, 'comments_required', 'Enter your comments!', 'Enter your comments!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (691, 'first_name', 'Please enter your first name!', 'Please enter your first name!');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (692, 'c', NULL, NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (693, 'f_name', 'First Name', 'First Name');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (694, 'l_name', 'Last Name', 'Last Name');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (698, 'coin_full_name', 'Coin Full Name', 'Nom complet de la piÃ¨ce');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (699, 'coin_id', 'Coin Id', 'ID de piÃ¨ce');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (700, 'rank', 'Rank', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (701, 'show_home', 'Show Home', 'Afficher la maison');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (702, 'yes', 'Yes', 'Oui');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (703, 'no', 'No', 'Non');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (704, 'coin_image/icon/logo', 'Coin Image/Icon/Logo', 'Image de piÃ¨ce / icÃ´ne / logo');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (705, 'coin_icon', 'Coin Icon', 'IcÃ´ne de piÃ¨ce de monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (706, 'full_name', 'Full Name', 'Nom complet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (707, 'home_page/serial', 'Home Page/Serial', 'Page d\'accueil / SÃ©rie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (708, 'email_notification_settings', 'Email Notification Settings', 'Paramètres De Notification Par E-mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (709, 'payout', 'Payout', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (710, 'commissin', 'Commissin', 'Commission');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (711, 'team_bonnus', 'Team Bonnus', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (712, 'sms_sending', 'SMS Sending', 'Envoi De SMS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (713, 'exchange_market', 'Exchange Market', 'Marché Des Changes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (714, 'total_trade', 'Total Trade', 'Commerce Total');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (715, 'total_crypto_fees', 'Total Crypto Fees', 'Total Des Frais De Crypto');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (716, 'total_usd_fees', 'Total USD Fees', 'Frais Totaux En USD');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (717, 'referral_bonus_usd', 'Referral Bonus USD', 'Bonus De Parrainage USD');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (718, 'market_deposit', 'Market Deposit', 'DÃ©pÃ´t de marchÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (719, 'fees_collect', 'Fees Collect', 'Frais collectÃ©s');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (720, 'quantity', 'Quantity', 'QuantitÃ©');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (721, 'required', 'Required', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (722, 'history', 'history', 'histoire');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (723, 'back', 'Back', 'Retour');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (724, 'important', 'Important', 'Important');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (725, 'send_only', 'Send Only', 'Envoyer seulement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (726, 'deposit_address', 'deposit address', 'adresse de dÃ©pÃ´t');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (727, 'sending_any_other_coin_or_token_to_this_address_may_result_in_the_loss_of_your_deposit', 'Sending any other coin or token to this address may result in the loss of your deposit', 'L\'envoi de toute autre piÃ¨ce ou jeton Ã  cette adresse peut entraÃ®ner la perte de votre dÃ©pÃ´t');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (728, 'copy_address', 'Copy Address', 'Copier l\'adresse');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (729, 'payment_process', 'Payment Process', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (735, 'balance', 'Balance', 'Ã©quilibre');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (736, 'flag', 'Flag', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (737, 'menu_background_color', 'Menu Background Color', 'Couleur d\'arrière-plan du menu');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (738, 'menu_font_color', 'Menu Font Color', 'Couleur de la police du menu');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (739, 'footer_background_color', 'Footer Background Color', 'Couleur de fond du bas de page');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (740, 'footer_font_color', 'Footer Font Color', 'Couleur de la police du pied de page');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (741, 'button_background_color', 'Button Background Color', 'Couleur d\'arrière-plan du bouton');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (742, 'button_font_color', 'Button Font Color', 'Couleur de la police du bouton');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (743, 'theme_color', 'Theme Color', 'Couleur du thème');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (744, 'newsletter_background_color', 'Newsletter Background Color', 'Couleur d\'arrière-plan de la newsletter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (745, 'newsletter_font_color', 'Newsletter Font Color', 'Couleur de police de la newsletter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (746, 'newsletter_images', 'Newsletter Images', 'Images de la newsletter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (747, 'pending-withdraw', 'Pending withdraw', 'En attente de retrait');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (748, 'withdraw-list', 'Withdraw List', 'Retirer la liste');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (749, 'pending-deposit', 'Pending Deposit', 'Dépôt en attente');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (750, 'deposit-list', 'Deposit List', 'Liste de dépôt');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (751, 'add-credit', 'Add Credit', 'Ajouter un crédit');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (752, 'open-order', 'Open Order', 'Commande Ouverte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (753, 'trade-history', 'Trade History', 'Histoire Du Commerce');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (754, 'exchanger', 'Exchanger', 'Échangeur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (755, 'coin-pair', 'Coin Pair', 'Paire De Pièces');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (756, 'user', 'User', 'Utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (757, 'add-user', 'Add User', 'Ajouter un utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (758, 'user-list', 'user list', 'liste d\'utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (759, 'verify-user', 'Verify User', 'Vérifier L\'utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (760, 'subscriber-list', 'Subscriber List', 'Liste D\'abonnés');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (761, 'app-setting', 'App Setting', 'Réglage De L\'application');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (762, 'block-list', 'Block List', 'Liste De Blocage');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (763, 'fees-setting', 'Fees Setting', 'établissement Des Frais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (764, 'transaction-setup', 'Transaction Setup', 'Configuration De La Transaction');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (765, 'email-sms-gateway', 'Email Sms Gateway', 'Passerelle Sms Email');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (766, 'payment-gateway', 'Payment Gateway', 'Passerelle De Paiement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (767, 'affiliation', 'Affiliation', 'Affiliation');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (768, 'external-api-list', 'External Api List', 'Liste Des API Externes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (769, 'update-external-api', 'Update External Api', 'Mettre à Jour L\'API Externe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (770, 'phrase', 'Phrase', 'Phrase');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (771, 'edit-phrase', 'Edit Phrase', 'Modifier La Phrase');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (772, 'update-gateway', 'Update Gateway', 'Mettre à Jour La Passerelle');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (773, 'edit-user', 'Edit User', 'Modifier L\'utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (774, 'add-admin', 'Add Admin', 'Ajouter Un Administrateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (775, 'admin-list', 'Admin List', 'Liste D\'administrateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (776, 'cms', 'CMS', 'CMS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (777, 'themes-setting', 'Themes Setting', 'Réglage Des Thèmes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (778, 'page-content-list', 'Page Content List', 'Liste De Contenu De Page');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (779, 'faq-list', 'Faq List', 'Liste De Faq');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (780, 'notice-list', 'Notice List', 'Liste D\'avis');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (781, 'edit-page-content', 'Edit Page Content', 'Modifier Le Contenu De La Page');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (782, 'edit-faq', 'Edit Faq', 'Modifier La FAQ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (783, 'edit-notice', 'Edit Notice', 'Modifier L\'avis');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (784, 'add-page-content', 'Add Page Content', 'Ajouter Du Contenu De Page');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (785, 'add-faq', 'Add Faq', 'Ajouter Une FAQ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (786, 'news-list', 'News List', 'Liste De Nouvelles');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (787, 'add-news', 'Add News', 'Ajouter Des Nouvelles');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (788, 'edit-news', 'Edit News', 'Modifier Les Actualités');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (789, 'category-list', 'Category List', 'Liste Des Catégories');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (790, 'add-category', 'Add Category', 'Ajouter Une Catégorie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (791, 'edit-category', 'Edit Category', 'Modifier La Catégorie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (792, 'slider-list', 'Slider List', 'Liste De Curseurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (793, 'add-slider', 'Add Slider', 'Ajouter Un Curseur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (794, 'edit-slider', 'Edit Slider', 'Modifier Le Curseur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (795, 'social-link-list', 'Social Link List', 'Liste De Liens Sociaux');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (796, 'edit-social-link', 'Edit Social Link', 'Modifier Le Lien Social');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (797, 'advertisement-list', 'Advertisement List', 'Liste De Publicités');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (798, 'add-advertisement', 'Add Advertisement', 'Ajouter Une Publicité');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (799, 'edit-advertisement', 'Edit Advertisement', 'Modifier La Publicité');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (800, 'web-language-list', 'Web Language List', 'Liste Des Langues Web');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (801, 'autoupdate', 'Autoupdate', 'Mise à Jour Automatique');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (802, 'latest-version', 'Latest Version', 'Dernière Version');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (803, 'current-version', 'Current Version', 'Version Actuelle');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (804, 'subscriber', 'Subscriber', 'Abonné');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (805, 'affiliation-setup', 'Affiliation Setup', 'Configuration De L\'affiliation');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (806, 'external-api', 'External API', 'API Externe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (807, 'support', 'Support', 'Soutien');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (808, 'no-update-available', 'No Update Available', 'Pas De Mise A Jour Disponible');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (809, 'full-name', 'Full Name', 'Nom Complet');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (810, 'initial-price', 'Initial Price', 'Prix ?​initial');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (811, 'test_bdtask', 'Bdtask Limited', NULL);
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (812, 'email_sms_template', 'E-mail And SMS Template', 'E-mail And SMS Template');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (813, 'template-english', 'Template English', 'Modèle Anglais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (814, 'template-french', 'Template French', 'Modèle Français');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (815, 'template-name', 'Template Name', 'Nom Du Modèle');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (816, 'template-type', 'Template Type', 'Type De Modèle');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (817, 'template-update', 'Template-update', 'Template-update');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (818, 'email-sms-template', 'Email Sms Template', 'Modèle De Courrier électronique SMS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (819, 'transfer_verification', 'Transfer Verification', 'Vérification Du Transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (820, 'transfer_success', 'Transfer Success', 'Succès Du Transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (821, 'withdraw_verification', 'Withdraw Verification', 'Retirer La Vérification');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (822, 'withdraw_success', 'Withdraw Success', 'Retirer Le Succès');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (823, 'profile_update', 'Profile Update', 'Mise à Jour Du Profil');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (824, 'deposit_success', 'Deposit Success', 'Réussite Du Dépôt');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (825, 'registered', 'Registered', 'Inscrit');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (826, 'email_address', 'Email Address', 'Adresse E-mail');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (827, 'template_type', 'Template Type', 'Type De Modèle');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (828, 'subject_english', 'Subject English', 'Sujet Anglais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (829, 'subject_french', 'Subject French', 'Sujet Français');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (830, 'purchase_key', 'Purchase Key', 'Clé D\'achat');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (831, 'module', 'Module', 'Module');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (832, 'add_module', 'Add Module', 'Ajouter Un Module');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (833, 'overwrite', 'Overwrite', 'écraser');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (834, 'theme_uploaded_successfully', 'Theme Uploaded Successfully', 'Thème Téléchargé Avec Succès');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (835, 'there_was_a_problem_with_the_upload', 'There Was A Problem With The Upload', 'Il Y A Eu Un Problème Avec Le Téléchargement');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (836, 'invalid_purchase_key', 'Invalid Purchase Key', 'Clé D\'achat Invalide');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (837, 'buy_now', 'Buy Now', 'Acheter Maintenant');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (838, 'install', 'Install', 'Installer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (839, 'invalid_module', 'Invalid Module', 'Module Invalide');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (840, 'module_added_successfully', 'Module Added Successfully', 'Module Ajouté Avec Succès');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (841, 'no_tables_are_registered_in_config', 'No Tables Are Registered_in Config', 'Aucune Table N\'est Enregistrée Dans La Configuration');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (842, 'themes', 'Themes', 'Thèmes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (843, 'module_list', 'Module List', 'Liste Des Modules');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (844, 'theme_active_successfully', 'Theme Active Successfully', 'Thème Actif Avec Succès');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (845, 'theme_name', 'Theme Name', 'Nom Du Thème');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (846, 'upload', 'Upload', 'Télécharger');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (847, 'downloaded_successfully', 'Downloaded Successfully', 'Téléchargé Avec Succès');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (848, 'failed_try_again', 'Failed Try Again', 'échec Réessayer');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (849, 'no_theme_available', 'No Theme Available', 'Aucun Thème Disponible');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (850, 'download', 'Download', 'Télécharger');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (851, 'theme_list', 'Theme List', 'Liste De Thèmes');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (852, 'addon', 'Addon', 'Ajouter');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (853, 'add_theme', 'Add Theme', 'Ajouter Un Thème');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (854, 'download_theme', 'Download Theme', 'Télécharger Le Thème');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (855, 'uninstall', 'Uninstall', 'Désinstaller');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (856, 'please_wait', 'Please Wait', 'S\'il Vous Plaît, Attendez');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (857, 'current', 'Current', 'Actuel');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (858, 'back_to_home', 'Back To Home', 'De Retour à La Maison');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (859, 'trading_history', 'Trading History', 'Historique Du Trading');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (860, 'latest_news', 'Latest News', 'Dernières Nouvelles');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (861, 'create_an_account', 'Create An Account', 'Créer Un Compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (862, 'to__trade', 'To  Trade', 'échanger');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (863, 'log_in', 'Log In', 'S\'identifier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (864, 'white', 'WHITE', 'BLANC');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (865, 'dark', 'DARK', 'FONCÉ');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (866, 'enter_your_email_address_to_retrieve_your_password', 'Enter Your Email Address To Retrieve Your Password', 'Entrez Votre Adresse E-mail Pour Récupérer Votre Mot De Passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (867, 'retrieve_password', 'Retrieve Password', 'Récupérer Mot De Passe');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (868, 'not_a_member_yet', 'Not A Member Yet', 'Pas Encore Membre');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (869, 'total_users', 'Total Users', 'Nombre Total D\'utilisateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (870, 'all_users', 'All Users', 'Tous Les Utilisateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (871, 'all_markets', 'All Markets', 'Tous Les Marchés');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (872, 'method', 'Method', 'Méthode');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (873, 'slider_title_engnilsh', 'Slider Title Engnilsh', 'Titre Du Curseur Engnilsh');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (874, 'slider_h1', 'Slider H1', 'Curseur H1');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (875, 'sub_title_english', 'Sub Title English', 'Sous-titre Anglais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (876, 'slider_h2', 'Slider H2', 'Curseur H2');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (877, 'button_text', 'Button Text', 'Texte Du Bouton');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (878, 'slider_h3', 'Slider H3', 'Curseur H3');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (879, 'code', 'Code', 'Code');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (880, 'language_name', 'Language Name', 'Nom De La Langue');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (881, 'add_coin_pair', 'Add Coin Pair', 'Ajouter Une Paire De Pièces');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (882, 'cryptocoin_add', 'Cryptocoin Add', 'Ajout De Crypto-monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (883, 'add-coin-pair', 'Add-coin-pair', 'Ajouter Une Paire De Pièces');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (884, 'security', 'Security', 'Sécurité');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (885, 'edita_dmin', 'Edita Dmin', 'Edita Dmin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (886, 'edit-admin', 'Edit-admin', 'Edit-admin');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (887, 'article1_en', 'Article1 En', 'Article1 Fr');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (888, 'question_english', 'Question English', 'Question Anglais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (889, 'add-notice', 'Add-notice', 'Add-notice');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (890, 'edit-profile', 'Edit-profile', 'Editer Le Profil');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (891, '_phrase_name', ' Phrase Name', 'Nom De La Phrase');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (892, 'cryptocoin-edit', 'Cryptocoin-edit', 'Crypto-monnaie-modifier');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (893, 'edit-market', 'Edit-market', 'Edit-market');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (894, 'edit-coin-pair', 'Edit-coin-pair', 'Modifier La Paire De Pièces');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (895, 'transaction_type', 'Transaction Type', 'Type De Transaction');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (896, 'account_type', 'Account Type', 'Type De Compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (897, 'unverified', 'Unverified', 'Non Vérifié');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (898, 'limit_amount', 'Limit Amount', 'Montant Limite');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (899, 'percent', 'Percent', 'Pour Cent');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (900, 'fixed', 'Fixed', 'Fixé');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (901, 'api_name', 'API Name', 'Nom De L\'API');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (902, 'merchant_id', 'Merchant Id', 'Identifiant Du Marchand');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (903, 'email_gateway', 'Email Gateway', 'Passerelle De Messagerie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (904, 'sms_gateway', 'Sms Gateway', 'Passerelle Sms');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (906, 'credit-list', 'Credit-list', 'Liste De Crédit');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (907, 'cryptocoin-add', 'Cryptocoin-add', 'Ajout De Crypto-monnaie');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (909, 'see_all_users', 'See All Users', 'Voir Tous Les Utilisateurs');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (910, 'see_all_markets', 'See All Markets', 'Voir Tous Les Marchés');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (911, 'see_trade_history', 'See Trade History', 'Voir L\'historique Du Commerce');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (912, 'buy_&_sell', 'Buy & Sell', 'Acheter Vendre');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (913, 'deposit,_withdraw,_transfer', 'Deposit, Withdraw, Transfer', 'Dépôt, Retrait, Transfert');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (914, 'see_all_pending_withdraw', 'See All Pending Withdraw', 'Voir Tous Les Retraits En Attente');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (915, 'see_all_trade_history', 'See All Trade History', 'Voir Toute L\'histoire Du Commerce');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (916, 'user_growth_rate', 'USER GROWTH RATE', 'TAUX DE CROISSANCE DES UTILISATEURS');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (917, 'email_sms_settings', 'Email Sms Settings', 'Paramètres De Messagerie électronique');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (918, 'email-sms-settings', 'Email-sms-settings', 'Email-sms-settings');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (919, 'fees_collection', 'Fees Collection', 'Perception Des Frais');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (920, 'create_user', 'Create User', 'Créer Un Utilisateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (921, 'create_admin', 'Create Admin', 'Créer Un Administrateur');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (922, 'add-ons', 'Add-ons', 'Add-ons');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (923, 'max_sell_currency_amount', 'Max Sell Currency Amount', 'Montant Maximal De La Devise De Vente');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (924, 'max_buy_currency_amount', 'Max Buy Currency Amount', 'Montant Maximal De La Devise D\'achat');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (925, 'acount', 'Acount', 'Compte');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (926, 'google_capture', 'Google Capture', 'Google Capture');
INSERT INTO `language` (`id`, `phrase`, `english`, `french`) VALUES (927, 'setup_domain', 'Setup Domain', 'Domaine De Configuration');


#
# TABLE STRUCTURE FOR: message
#

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` varchar(250) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unseen, 1=seen, 2=delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (1, 1, 'WM5PAU', 'Deposit', 'Hi, bdtask  limited You Successfully  Deposit The Amount Is USD 50000  date 27 February 2021', '2021-02-27 03:50:14', 0, 0);
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (2, 1, 'WM5PAU', 'Deposit', 'Hi, bdtask  limited You Successfully  Deposit The Amount Is USD 100000  date 27 February 2021', '2021-02-27 04:22:33', 0, 0);
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (3, 1, 'WM5PAU', 'Deposit', 'Hi, bdtask  limited You Successfully  Deposit The Amount Is USD 1000  date 28 February 2021', '2021-02-28 03:00:45', 0, 0);
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (4, 1, '4YLXRA', 'Deposit', 'Hi, Torun Hassan  You Successfully  Deposit The Amount Is USD 10000  date 01 March 2021', '2021-03-01 06:08:31', 0, 0);
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (5, 1, '4YLXRA', 'Withdraw', 'Hi, Torun Hassan  You successfully withdraw the amount is $1000 from your account. Your new balance is $8900', '2021-03-01 06:11:06', 0, 0);
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (6, 1, '4YLXRA', 'Deposit', 'Hi, Torun Hassan  You Successfully  Deposit The Amount Is USD 5000  date 02 March 2021', '2021-03-02 06:37:38', 0, 0);
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (7, 1, '4YLXRA', 'Withdraw', 'Hi, Torun Hassan  You successfully withdraw the amount is $10000 from your account. Your new balance is $39000', '2021-03-03 06:47:16', 0, 0);
INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES (8, 1, '4YLXRA', 'Withdraw', 'Hi, Torun Hassan  You successfully withdraw the amount is $500 from your account. Your new balance is $38450', '2021-03-03 06:47:41', 0, 0);


#
# TABLE STRUCTURE FOR: module
#

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `directory` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: notifications
#

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `notification_type` varchar(45) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `details` mediumtext DEFAULT NULL,
  `status` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COMMENT='SMS and Email notified data will be stored in this table.';

INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (1, 'WM5PAU', '2021-02-27 03:50:14', 'deposit', 'Deposit', 'You successfully deposit the amount is USD 50000. ', '0');
INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (2, 'WM5PAU', '2021-02-27 04:22:32', 'deposit', 'Deposit', 'You successfully deposit the amount is USD 100000. ', '0');
INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (3, 'WM5PAU', '2021-02-28 03:00:44', 'deposit', 'Deposit', 'You successfully deposit the amount is USD 1000. ', '0');
INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (4, '4YLXRA', '2021-03-01 06:08:31', 'deposit', 'Deposit', 'You successfully deposit the amount is USD 10000. ', '0');
INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (5, '4YLXRA', '2021-03-01 06:11:05', 'withdraw', 'Withdraw', 'You successfully withdraw the amount is $1000 from your account. Your new balance is $8900', '0');
INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (6, '4YLXRA', '2021-03-02 06:37:38', 'deposit', 'Deposit', 'You successfully deposit the amount is USD 5000. ', '0');
INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (7, '4YLXRA', '2021-03-03 06:47:16', 'withdraw', 'Withdraw', 'You successfully withdraw the amount is $10000 from your account. Your new balance is $39000', '0');
INSERT INTO `notifications` (`notification_id`, `user_id`, `date`, `notification_type`, `subject`, `details`, `status`) VALUES (8, '4YLXRA', '2021-03-03 06:47:41', 'withdraw', 'Withdraw', 'You successfully withdraw the amount is $500 from your account. Your new balance is $38450', '0');


#
# TABLE STRUCTURE FOR: payeer_payments
#

DROP TABLE IF EXISTS `payeer_payments`;

CREATE TABLE `payeer_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `m_operation_id` int(11) NOT NULL,
  `m_operation_ps` int(11) NOT NULL,
  `m_operation_date` varchar(100) NOT NULL,
  `m_operation_pay_date` varchar(100) NOT NULL,
  `m_shop` int(11) NOT NULL,
  `m_orderid` varchar(300) NOT NULL,
  `m_amount` varchar(100) NOT NULL,
  `m_curr` varchar(100) NOT NULL,
  `m_desc` varchar(300) NOT NULL,
  `m_status` varchar(100) NOT NULL,
  `m_sign` text NOT NULL,
  `lang` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: payment_gateway
#

DROP TABLE IF EXISTS `payment_gateway`;

CREATE TABLE `payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identity` varchar(50) NOT NULL,
  `agent` varchar(100) NOT NULL,
  `public_key` text NOT NULL,
  `private_key` text NOT NULL,
  `shop_id` varchar(100) NOT NULL,
  `secret_key` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (1, 'bitcoin', 'GoUrl Payment', 'a:13:{s:7:\"bitcoin\";s:3:\"xvc\";s:11:\"bitcoincash\";s:0:\"\";s:8:\"litecoin\";s:0:\"\";s:4:\"dash\";s:0:\"\";s:8:\"dogecoin\";s:0:\"\";s:9:\"speedcoin\";s:50:\"43137AACNNeySpeedcoin77SPDPUBaJBxvUGvX7KgmBcx9CGvb\";s:8:\"reddcoin\";s:0:\"\";s:7:\"potcoin\";s:0:\"\";s:11:\"feathercoin\";s:0:\"\";s:8:\"vertcoin\";s:0:\"\";s:8:\"peercoin\";s:0:\"\";s:12:\"monetaryunit\";s:0:\"\";s:17:\"universalcurrency\";s:0:\"\";}', 'a:13:{s:7:\"bitcoin\";s:3:\"xvc\";s:11:\"bitcoincash\";s:0:\"\";s:8:\"litecoin\";s:0:\"\";s:4:\"dash\";s:0:\"\";s:8:\"dogecoin\";s:0:\"\";s:9:\"speedcoin\";s:50:\"43137AACNNeySpeedcoin77SPDPRVyzic8CEewfdazdv9HwdH2\";s:8:\"reddcoin\";s:0:\"\";s:7:\"potcoin\";s:0:\"\";s:11:\"feathercoin\";s:0:\"\";s:8:\"vertcoin\";s:0:\"\";s:8:\"peercoin\";s:0:\"\";s:12:\"monetaryunit\";s:0:\"\";s:17:\"universalcurrency\";s:0:\"\";}', '', '', '', 1);
INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (2, 'payeer', 'Payeer', '485146745', 'VsdHofTsuI6XOdjL', '', '', '', 1);
INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (4, 'phone', 'Mobile Money', '+880 1746 40 68 01', 'mobile', '', '', '', 1);
INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (5, 'paypal', 'Paypal', 'AfmTkhn-GYb_HAsPayWeLDVTG39jNjGsJ3siJSNDs6QGr52KDLnAT28fIv4TVni5P3Dax8w1y-Libl_j', 'EHGJveSf9GJcbyQwgYmouRi9baBPKLPqeSYjYesiG4UJTSnQ45q3gwQdkB6TvFQAjkYm42D1P_Hqn340', '', 'sandbox', '', 1);
INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (6, 'stripe', 'Stripe', 'pk_test_BPLwYal0sn4KkKaDTzuj5oRq', 'sk_test_6J6dcwXf8ruEZGCvlC09C9NK', '', '', '', 1);
INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (7, 'bank', 'Bank', '{\"ci_csrf_token\":\"\",\"id\":\"7\",\"identity\":\"bank\",\"agent\":\"Bank\",\"acc_name\":\"kanan tariq khan\",\"acc_no\":\"3646464643131313\",\"branch_name\":\"kaqbhsjkqbdq\",\"swift_code\":\"464kadh\",\"abn_no\":\"kfhw456454\",\"country\":\"PK\",\"bank_name\":\"mwezan\",\"status\":\"1\"}', '', '', '', '', 1);
INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (8, 'coinpayment', 'CoinPayments', '51fec43efdeb1323d1a0854ffa807b64abf822ca6dd79ba619cdb6de6783b892', 'D432e1907d50C5e399A7E6a34d50DE1B4dfe809980f3a4a295dc7Ac7889Bc3e8', '', '', '{\"marcent_id\":\"7bc213faca51052a85eccd6ce1c56eef\",\"ipn_secret\":\"TaR#@)1331\",\"debug_email\":\"tareq7500@gmail.com\",\"debuging_active\":1,\"withdraw\":\"0\"}', 1);
INSERT INTO `payment_gateway` (`id`, `identity`, `agent`, `public_key`, `private_key`, `shop_id`, `secret_key`, `data`, `status`) VALUES (9, 'token', 'Token', '51fec43efdeb1323d1a0854ffa807b64abf8', 'messege...', '', 'show', '', 1);


#
# TABLE STRUCTURE FOR: setting
#

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `logo_web` varchar(255) NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `time_zone` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `office_time` varchar(255) DEFAULT NULL,
  `update_notification` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `setting` (`setting_id`, `title`, `description`, `email`, `phone`, `logo`, `logo_web`, `favicon`, `language`, `site_align`, `footer_text`, `time_zone`, `latitude`, `office_time`, `update_notification`) VALUES (1, 'Crypto Currency Trading System', 'Bangladesh Office B-25, Mannan Plaza, 4th Floor, Khilkhet Dhaka-1229, Bangladesh', 'info@bdtask.com', '+8809666980047', '////upload/settings/5b3c74cacc762f373210b855dc9b885a.png', '////upload/settings/5b3c74cacc762f373210b855dc9b885a.png', '////upload/settings/6a32acfe674bbfb88ad1c8f3f1de332d.png', 'english', 'LTR', '2021 © Copyright bdtask Treading System', 'Asia/Dhaka', '40.6700, -73.9400', 'Monday - Friday: 08:00 - 22:00\r\nSaturday, Sunday: Closed', 1);


#
# TABLE STRUCTURE FOR: sms_email_send_setup
#

DROP TABLE IF EXISTS `sms_email_send_setup`;

CREATE TABLE `sms_email_send_setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method` text NOT NULL,
  `deposit` int(11) DEFAULT NULL,
  `transfer` int(11) DEFAULT NULL,
  `withdraw` int(11) DEFAULT NULL,
  `payout` int(11) DEFAULT NULL,
  `commission` int(11) DEFAULT NULL,
  `team_bonnus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `sms_email_send_setup` (`id`, `method`, `deposit`, `transfer`, `withdraw`, `payout`, `commission`, `team_bonnus`) VALUES (1, 'email', 1, 1, 1, NULL, NULL, NULL);
INSERT INTO `sms_email_send_setup` (`id`, `method`, `deposit`, `transfer`, `withdraw`, `payout`, `commission`, `team_bonnus`) VALUES (2, 'sms', NULL, NULL, NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: themes
#

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

INSERT INTO `themes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES (22, 'tradboxtheme', 1, '2021-01-19 06:54:13', '2021-01-19 06:56:10');


#
# TABLE STRUCTURE FOR: web_article
#

DROP TABLE IF EXISTS `web_article`;

CREATE TABLE `web_article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) DEFAULT NULL,
  `headline_en` varchar(300) DEFAULT NULL,
  `headline_fr` varchar(300) DEFAULT NULL,
  `article_image` varchar(100) DEFAULT NULL,
  `custom_url` varchar(300) NOT NULL,
  `article1_en` longtext NOT NULL,
  `article1_fr` longtext NOT NULL,
  `article2_en` longtext NOT NULL,
  `article2_fr` longtext NOT NULL,
  `video` varchar(300) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `page_content` int(11) DEFAULT 0 COMMENT 'if this is a Page content set 1 else 0',
  `position_serial` int(11) NOT NULL,
  `publish_date` datetime NOT NULL,
  `publish_by` varchar(20) NOT NULL,
  `edit_history` int(11) NOT NULL,
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (1, NULL, 'Contact', 'Contact Français Français Français Français Turkey', NULL, '', '1355 Market Street, Suite 900 San Francisco, CA 94103', '<div>\r\n                                            <p>Phone <font color=\"#72afd2\"><span xss=removed>+1 (514) 352-1010</span></font><br>Fax <span xss=removed>+1 (514) 352-7511</span></p></div>', '<ul class=\"opening_hours\">\r\n                                        <li>\r\n                                            <p>Monday-Wednesday</p>\r\n                                            <p>10 am - 6 pm</p></li>\r\n                                    </ul>', '', NULL, 12, 0, 0, '2020-09-15 12:02:49', 'admin@demo.com', 0);
INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (2, NULL, 'Marketing Consultancy', 'Lorem ipsum ', NULL, '', 'zsnsdfz\r\n', 'fbzdfzdxfzdz\r\n', '', '', NULL, 30, 0, 0, '2021-02-18 06:17:51', 'admin@demo.com', 0);
INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (3, NULL, NULL, NULL, NULL, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam finibus vestibulum lacus non sodales. Aenean pretium augue tellus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam finibus vestibulum lacus non sodales. Aenean pretium augue tellus.', '', '', NULL, 29, 0, 0, '2020-09-15 12:26:52', 'admin@demo.com', 0);
INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (4, NULL, NULL, NULL, NULL, '', 'Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. ', 'Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. ', '', '', NULL, 29, 0, 0, '2018-10-10 10:56:25', 'admin@demo.com', 0);
INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (5, NULL, NULL, NULL, NULL, '', 'Te cum mutat malorum. Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. ', 'Te cum mutat malorum. Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. ', '', '', NULL, 29, 0, 0, '2018-10-10 10:56:55', 'admin@demo.com', 0);
INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (6, NULL, NULL, NULL, NULL, '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iam id ipsum absurdum, maximum malum neglegi. Satisne ergo pudori consulat, si quis sine teste libidini pareat?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iam id ipsum absurdum, maximum malum neglegi. Satisne ergo pudori consulat, si quis sine teste libidini pareat?', '', '', NULL, 29, 0, 0, '2018-10-10 10:58:48', 'admin@demo.com', 0);
INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (7, 'Make Each <span>Price Spike</span> And Dip Count', 'Make Each <span>Price Spike</span> And Dip Count', 'Make Each <span>Price Spike</span> And Dip Count', '', '', '<p><span style=\"color: rgb(165, 165, 165); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 15px; text-align: center;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.</span><br></p>', '<p><span style=\"color: rgb(165, 165, 165); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 15px; text-align: center;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.</span><br></p>', '', '', '', 34, 1, 1, '2018-11-03 06:15:00', 'admin@demo.com', 0);
INSERT INTO `web_article` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `video`, `cat_id`, `page_content`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (9, NULL, 'dfgd', 'dfgdf', '', '', 'dfg\r\n', 'dfg\r\n', 'dfg\r\n', 'dfg\r\n', '', 21, 1, 1, '2021-02-23 11:50:05', 'admin@demo.com', 0);


#
# TABLE STRUCTURE FOR: web_category
#

DROP TABLE IF EXISTS `web_category`;

CREATE TABLE `web_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `cat_name_en` varchar(100) NOT NULL,
  `cat_name_fr` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `cat_image` varchar(300) DEFAULT NULL,
  `cat_title1_en` varchar(100) DEFAULT NULL,
  `cat_title1_fr` varchar(100) DEFAULT NULL,
  `cat_title2_en` varchar(300) DEFAULT NULL,
  `cat_title2_fr` varchar(300) DEFAULT NULL,
  `menu` int(11) DEFAULT NULL COMMENT 'Header menu=1',
  `position_serial` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (1, 'home', 'Home', 'Maison', 0, '', '', '', '', '', 1, 1, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (4, 'exchange', 'Exchange', 'Échange', 0, 'upload/1be637b8e76b153d9c74d35864db2c0d.jpg', 'Exchange', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that', '', 1, 4, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (8, 'about', 'About', 'Sur', 0, 'upload/5cfce2edf442b87cfb5b00212a9c75c6.png', 'About Us', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that', '', 0, NULL, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (9, 'news', 'News', 'Nouvelles', 0, 'upload/c2eea24dd0d9c5867e33facfadb0d869.jpg', 'Latest form our blog', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that', '', NULL, NULL, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (16, 'register', 'Register', 'Register', 0, '', '', '', '', '', 0, 0, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (17, 'forgot-password', 'Forgot Password', 'Mot de Passe oublié', 0, 'upload/660b9342724e8d4825348dbc07bd19b6.jpg', '', '', '', '', 0, NULL, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (19, 'btc', 'BTC', '', 9, '', '', '', '', '', 0, NULL, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (20, 'eth', 'ETH', 'ETH', 9, '', '', '', '', '', 0, 0, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (21, 'ltc', 'LTC', 'LTC', 9, '', '', '', '', '', 0, 0, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (22, 'dash', 'DASH', 'DASH', 9, '', '', '', '', '', 0, 0, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (24, 'blockchain', 'Blockchain', 'Blockchain', 9, '', '', '', '', '', 0, 0, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (25, 'trading', 'Trading', 'Trading', 9, '', '', '', '', '', 0, 0, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (26, 'news-details', 'News Details', 'News Details', 0, '', '', '', '', '', 0, 0, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (27, 'mining', 'Mining', '', 9, '', '', '', '', '', 0, NULL, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (28, 'terms', 'Terms', 'terms', 1, 'upload/a0bf9de900fce3b75bdc1a207d5eca0f.jpg', 'term title english', 'turki title', 'category title english', 'dsf', 2, NULL, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (29, 'notice', 'Notice', 'Noticeo', 0, '', '', '', '', '', 0, NULL, 1);
INSERT INTO `web_category` (`cat_id`, `slug`, `cat_name_en`, `cat_name_fr`, `parent_id`, `cat_image`, `cat_title1_en`, `cat_title1_fr`, `cat_title2_en`, `cat_title2_fr`, `menu`, `position_serial`, `status`) VALUES (30, 'faq', 'FAQ', 'FAQ', 0, '', 'zXCZXCzXC', 'zXCzXCzx', 'xCzxCzx', 'zxCzXCzX', 2, NULL, 1);


#
# TABLE STRUCTURE FOR: web_language
#

DROP TABLE IF EXISTS `web_language`;

CREATE TABLE `web_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `flag` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `web_language` (`id`, `name`, `flag`) VALUES (1, 'French', 'fr');


#
# TABLE STRUCTURE FOR: web_news
#

DROP TABLE IF EXISTS `web_news`;

CREATE TABLE `web_news` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) DEFAULT NULL,
  `headline_en` varchar(300) NOT NULL,
  `headline_fr` varchar(300) NOT NULL,
  `article_image` varchar(100) DEFAULT NULL,
  `custom_url` varchar(300) NOT NULL,
  `article1_en` longtext NOT NULL,
  `article1_fr` longtext NOT NULL,
  `article2_en` longtext NOT NULL,
  `article2_fr` longtext NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position_serial` int(11) NOT NULL,
  `publish_date` datetime NOT NULL,
  `publish_by` varchar(20) NOT NULL,
  `edit_history` int(11) NOT NULL,
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (1, 'true-flip-enters-the-slot-market-with-chains-code', 'True Flip enters the slot market with Chain’s Code', '', 'upload/news/42cf81dba6b110fbed82b4414279d8ef.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 19, NULL, 0, '2018-04-09 09:46:48', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (2, 'bitcoin-in-brief-monday-twitter-wields-the-banhammer', 'Bitcoin in Brief Monday: Twitter Wields the Banhammer', '', 'upload/news/4e9a8a65e73a4267e85cf6cbd3a6ccfe.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 19, NULL, 0, '2018-04-09 09:46:23', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (3, 'ethereum-price-technical-analysis-ethusd-eyes-more-gains', 'Ethereum Price Technical Analysis – ETH/USD Eyes More Gains', '', 'upload/news/22c6957a6c707bf5d1a8435b665a0cf3.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 20, NULL, 0, '2018-04-09 09:50:44', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (4, 'south-africa-puts-onus-on-taxpayers-to-declare-all-cryptocurrency-income', 'South Africa Puts Onus on Taxpayers to Declare All Cryptocurrency Income', '', 'upload/news/166e293c430bdf835f0c6d6a127e4e13.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 21, NULL, 0, '2018-07-10 09:11:16', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (5, 'neo-eos-litecoin-iota-and-stellar-technical-analysis-april-9-2018', 'NEO, EOS, Litecoin, IOTA and Stellar: Technical Analysis April 9, 2018', '', 'upload/news/b731dbe9143e088de015c0c844d40105.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 21, NULL, 0, '2018-07-10 09:11:02', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (6, 'why-invest-in-dash', 'Why Invest in Dash?', '', 'upload/news/9d5c09ab5b25569514fa852e2d2c1483.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 22, NULL, 0, '2018-07-10 09:10:50', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (7, 'asic-resistance-increasingly-hot-topic-in-crypto-as-monero-forks', 'ASIC Resistance Increasingly Hot Topic in Crypto as Monero Forks', '', 'upload/news/32083222f2430503659756a60d3b0b6b.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 19, NULL, 0, '2018-07-17 10:30:35', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (8, 'canadian-mining-giant-hyperblock-acquires-cryptoglobal-for-106-million', 'CANADIAN MINING GIANT HYPERBLOCK ACQUIRES CRYPTOGLOBAL FOR $106 MILLION', '', 'upload/news/e56c8562afa3795f3c4c3ecccc3bfa83.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 27, NULL, 0, '2018-07-17 10:30:23', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (9, 'how-can-blockchains-remove-the-pay-to-trade-barrier-in-the-market', 'How Can Blockchains Remove the ‘Pay to Trade’ Barrier in the Market?', '', 'upload/news/2ff94094fcfbe19daf303a479b9fad68.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 24, NULL, 0, '2018-07-10 09:13:25', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (10, 'how-blockchain-is-making-it-easier-to-get', 'How Blockchain Is Making It Easier to Get', '', 'upload/news/44807c1619ecc1f8374b8930477187aa.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 24, NULL, 0, '2018-07-10 09:13:16', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (11, 'ripple-price-technical-analysis-xrpusd', 'Ripple Price Technical Analysis – XRP/USD', '', 'upload/news/3c9de71155211697f38a3820ba36670d.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 25, NULL, 0, '2018-07-08 09:11:43', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (12, 'bitfinex-introduces-trading-for-12-altcoins', 'Bitfinex Introduces Trading for 12 Altcoins', '', 'upload/news/bced67e1ee1ed3b2f3d4a10f9f71e78e.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 25, NULL, 0, '2018-07-10 09:35:43', 'admin@demo.com', 0);
INSERT INTO `web_news` (`article_id`, `slug`, `headline_en`, `headline_fr`, `article_image`, `custom_url`, `article1_en`, `article1_fr`, `article2_en`, `article2_fr`, `cat_id`, `parent_id`, `position_serial`, `publish_date`, `publish_by`, `edit_history`) VALUES (13, 'bitcoin-cash-price-trend-including-tether', 'Bitcoin Cash Price Trend Including Tether', '', 'upload/news/0656fe700249acfe0a5535b4ae2c0088.jpg', '', '<div>Lorem ipsum dolor sit amet, quo omittam moderatius in, te cum mutat malorum. Autem ullum cu sed. Id per enim deserunt, vel an choro dolores voluptatum. His viderer civibus te, quis vero timeam te mel. Meis nulla nec id. Te eros ubique ius.</div><div><br></div><div>Pri nisl velit at. Ei lobortis forensibus dissentiunt sit, ius idque veritus in, in aeterno invenire usu. Esse inani inermis eam ea. Justo perfecto dignissim an pri, ea sit dico neglegentur, id mundi maiestatis vel. Eos eu stet dicit. Porro suscipiantur id usu, antiopam moderatius sit ne. Ei nulla torquatos ullamcorper sed, no stet graece instructior vel, eirmod vulputate an duo.</div><div><br></div><div>Splendide laboramus eam cu, veritus singulis vel et, essent assentior an vim. Prima paulo ut mei, no tota erat eam. Constituam consequuntur his ad. Ad ius libris labore, ex sumo regione eos. No ius vero apeirian.</div><div><br></div><div>Mollis integre persius ad nam. At agam constituam sit, an mea dolores iracundia conceptam, vis no atqui verear detracto. Et fugit ridens intellegam duo, eu facilisi erroribus duo. Et vix homero verear liberavisse, natum nonumes splendide usu at. Ea vis meliore offendit intellegebat. Ne mazim philosophia usu.</div><div><br></div><div>At mazim tacimates per. Ne reque tractatos mel, at eos case commodo. Cu animal constituam pri, ea nam ceteros copiosae philosophia. Ei modo fuisset pertinax vim, id vis tacimates interpretaris mediocritatem. Vel no esse scripserit, nostrum tacimates his te.</div><div><br></div><div>Corpora postulant voluptatum nam eu. Cum te agam delectus ullamcorper, nostrum perfecto an nam. Ne quo accusata adversarium, illud efficiantur te nam. At veri simul virtute mei, deleniti persecuti te mei. Ludus animal eam cu, an nulla prompta imperdiet vis. Est cu dicam soluta everti.</div><div><br></div><div>Aliquam feugait perfecto per ne, an adolescens sententiae vis, his no noster animal. At vim vidit apeirian appellantur, no graecis invidunt sea. Illud oblique ad ius, eum no partem consectetuer, equidem incorrupte cum cu. At usu docendi tibique evertitur. Duis deserunt pri at. Aeque tempor usu et, ex illum facer efficiendi nam.</div><div><br></div><div>Vel quodsi iracundia ne, eu audiam tibique mnesarchum est. Diam oporteat suavitate pri id. Eos latine euripidis ad, ad mei partem accommodare, nam at elitr vitae voluptaria. Id sea ceteros suscipiantur. Ne per viderer tacimates repudiare, sed id quaestio cotidieque. Ei hinc dolor putent usu, falli lucilius nam at.</div><div><br></div><div>Aperiam detracto qualisque cu sea, sea te deleniti scripserit. Option feugiat sit ei. Labore volumus instructior eos ne, id graecis antiopam assueverit vel, no appetere argumentum eloquentiam quo. Error option dolorum nam cu. Vim tantas populo et, te mea quem quando decore.</div><div><br></div><div>Duo ad elit aperiam. Et error aliquip mea. Cum ut facete assentior, ei vis dictas erroribus salutatus. Mea eu iusto volumus argumentum, sed eu quando regione indoctum.</div>', '', '', '', 25, NULL, 0, '2018-07-10 09:36:00', 'admin@demo.com', 0);


#
# TABLE STRUCTURE FOR: web_slider
#

DROP TABLE IF EXISTS `web_slider`;

CREATE TABLE `web_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_h1_en` varchar(900) DEFAULT NULL,
  `slider_h1_fr` varchar(900) DEFAULT NULL,
  `slider_h2_en` varchar(900) DEFAULT NULL,
  `slider_h2_fr` varchar(900) DEFAULT NULL,
  `slider_h3_en` varchar(900) DEFAULT NULL,
  `slider_h3_fr` varchar(900) DEFAULT NULL,
  `slider_img` varchar(300) DEFAULT NULL,
  `custom_url` varchar(300) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `web_slider` (`id`, `slider_h1_en`, `slider_h1_fr`, `slider_h2_en`, `slider_h2_fr`, `slider_h3_en`, `slider_h3_fr`, `slider_img`, `custom_url`, `status`) VALUES (1, 'The Feature of <span class=\"outrageous-orange\">Financing</span> <br>Technology is Here', '', 'It is a long established fact that a reader will be distracted by the readable content of a page when.<br> looking at its layout The point of using Lorem Ipsum is that', '', 'Get in touch', '', '/upload/slider/fe613a9078976e374e8ca75f866674d8.jpg', 'https://www.bdtask.com/', 1);
INSERT INTO `web_slider` (`id`, `slider_h1_en`, `slider_h1_fr`, `slider_h2_en`, `slider_h2_fr`, `slider_h3_en`, `slider_h3_fr`, `slider_img`, `custom_url`, `status`) VALUES (3, 'Take the world\'s  best <br><span class=\"navy-blue\">Cryptocurrency</span>  Site.', '', 'Miker Ipsum is simply dummy text of the printing and typesetting industry.<br> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '', 'Start Now', '', '/upload/slider/08b0d2fbc37ac78a04f04195fd471e3b.jpg', 'https://www.bdtask.com/', 1);


#
# TABLE STRUCTURE FOR: web_social_link
#

DROP TABLE IF EXISTS `web_social_link`;

CREATE TABLE `web_social_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `web_social_link` (`id`, `name`, `link`, `icon`, `status`, `date`) VALUES (1, 'Facebook', 'https://facebook.com', 'facebook', 1, '2020-12-07 23:52:22');
INSERT INTO `web_social_link` (`id`, `name`, `link`, `icon`, `status`, `date`) VALUES (2, 'twitter', 'https://twitter.com', 'tumblr', 1, '2018-07-10 00:12:09');
INSERT INTO `web_social_link` (`id`, `name`, `link`, `icon`, `status`, `date`) VALUES (3, 'linkedin', 'https:/linkdin.com', 'linkedin', 1, '2020-10-05 05:40:11');
INSERT INTO `web_social_link` (`id`, `name`, `link`, `icon`, `status`, `date`) VALUES (4, 'youtube', 'https://www.youtube.com', 'dribbble', 1, '2018-07-10 00:12:09');
INSERT INTO `web_social_link` (`id`, `name`, `link`, `icon`, `status`, `date`) VALUES (5, 'instagram', 'https://instagram.com', 'instagram', 1, '2018-02-01 01:58:56');


#
# TABLE STRUCTURE FOR: web_subscriber
#

DROP TABLE IF EXISTS `web_subscriber`;

CREATE TABLE `web_subscriber` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

