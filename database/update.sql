ALTER TABLE `soyo_device_paramters` ADD `category` VARCHAR(50) NOT NULL AFTER `device_id`, ADD `unique_id` VARCHAR(50) NOT NULL AFTER `category`;
	