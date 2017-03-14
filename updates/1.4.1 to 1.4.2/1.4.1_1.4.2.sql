INSERT INTO `business_settings` (`business_settings_id`, `type`, `status`, `value`) VALUES (NULL, 'home_def_currency', '', '1');
ALTER TABLE `currency_settings` ADD `exchange_rate_def` VARCHAR(100) NULL DEFAULT NULL AFTER `code`;
ALTER TABLE `user` ADD `country` VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE `user` ADD `state` VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE `vendor` ADD `country` VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE `vendor` ADD `city` VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE `vendor` ADD `zip` VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE `vendor` ADD `state` VARCHAR(100) NULL DEFAULT NULL;