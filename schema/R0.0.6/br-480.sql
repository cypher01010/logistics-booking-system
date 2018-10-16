ALTER TABLE `delivery`

ADD `sender_postal_code` varchar(32) DEFAULT NULL,
ADD `sender_blk_street_name` varchar(128) DEFAULT NULL,
ADD `sender_bldg_name` varchar(128) DEFAULT NULL,
ADD `sender_unit_no` varchar(32) DEFAULT NULL;
