//Cascade
ALTER TABLE `soyo_user_site_information` ADD CONSTRAINT `user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `soyosystem`.`soyo_users`(`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;