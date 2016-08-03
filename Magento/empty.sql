   ***********for categories********************
TRUNCATE TABLE `preffix_catalog_category_entity`;
TRUNCATE TABLE `preffix_catalog_category_entity_datetime`;
TRUNCATE TABLE `preffix_catalog_category_entity_decimal`;
TRUNCATE TABLE `preffix_catalog_category_entity_int`;
TRUNCATE TABLE `preffix_catalog_category_entity_text`;
TRUNCATE TABLE `preffix_catalog_category_entity_varchar`;
TRUNCATE TABLE `preffix_catalog_category_product`;
TRUNCATE TABLE `preffix_catalog_category_product_index`;

INSERT  INTO `preffix_catalog_category_entity`(`entity_id`,`entity_type_id`,`attribute_set_id`,`parent_id`,`created_at`,`updated_at`,`path`,`POSITION`,`level`,`children_count`) VALUES (1,3,0,0,'0000-00-00 00:00:00','2009-02-20 00:25:34','1',1,0,1),(2,3,3,0,'2009-02-20 00:25:34','2009-02-20 00:25:34','1/2',1,1,0);
INSERT  INTO `preffix_catalog_category_entity_int`(`value_id`,`entity_type_id`,`attribute_id`,`store_id`,`entity_id`,`value`) VALUES (1,3,32,0,2,1),(2,3,32,1,2,1);
INSERT  INTO `preffix_catalog_category_entity_varchar`(`value_id`,`entity_type_id`,`attribute_id`,`store_id`,`entity_id`,`value`) VALUES (1,3,31,0,1,'Root Catalog'),(2,3,33,0,1,'root-catalog'),(3,3,31,0,2,'Default Category'),(4,3,39,0,2,'PRODUCTS'),(5,3,33,0,2,'default-category');

    *****************for customers*****************


    SET FOREIGN_KEY_CHECKS=0;
-- reset customers

TRUNCATE preffix_customer_address_entity;
TRUNCATE preffix_customer_address_entity_datetime;
TRUNCATE preffix_customer_address_entity_decimal;
TRUNCATE preffix_customer_address_entity_int;
TRUNCATE preffix_customer_address_entity_text;
TRUNCATE preffix_customer_address_entity_varchar;
TRUNCATE preffix_customer_entity;
TRUNCATE preffix_customer_entity_datetime;
TRUNCATE preffix_customer_entity_decimal;
TRUNCATE preffix_customer_entity_int;
TRUNCATE preffix_customer_entity_text;
TRUNCATE preffix_customer_entity_varchar;
TRUNCATE preffix_log_customer;
TRUNCATE preffix_log_visitor;
TRUNCATE preffix_log_visitor_info;

ALTER TABLE preffix_customer_address_entity AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_address_entity_datetime AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_address_entity_decimal AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_address_entity_int AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_address_entity_text AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_address_entity_varchar AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_entity AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_entity_datetime AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_entity_decimal AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_entity_int AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_entity_text AUTO_INCREMENT=1;
ALTER TABLE preffix_customer_entity_varchar AUTO_INCREMENT=1;
ALTER TABLE preffix_log_customer AUTO_INCREMENT=1;
ALTER TABLE preffix_log_visitor AUTO_INCREMENT=1;
ALTER TABLE preffix_log_visitor_info AUTO_INCREMENT=1;
SET FOREIGN_KEY_CHECKS=1;




 *****************for orders*****************
 
   SET FOREIGN_KEY_CHECKS=0; 
TRUNCATE `preffix_sales_flat_creditmemo`; 
TRUNCATE `preffix_sales_flat_creditmemo_comment`; 
TRUNCATE `preffix_preffix_sales_flat_creditmemo_grid`; 
TRUNCATE `preffix_sales_flat_creditmemo_item`; 
TRUNCATE `preffix_sales_flat_invoice`; 
TRUNCATE `preffix_sales_flat_invoice_comment`; 
TRUNCATE `preffix_sales_flat_invoice_grid`; 
TRUNCATE `preffix_sales_flat_invoice_item`; 
TRUNCATE `preffix_sales_flat_order`; 
TRUNCATE `preffix_sales_flat_order_address`; 
TRUNCATE `preffix_sales_flat_order_grid`; 
TRUNCATE `preffix_sales_flat_order_item`; 
TRUNCATE `preffix_sales_flat_order_payment`; 
TRUNCATE `preffix_sales_flat_order_status_history`; 
TRUNCATE `preffix_sales_flat_quote`; 
TRUNCATE `preffix_sales_flat_quote_address`; 
TRUNCATE `preffix_sales_flat_quote_address_item`; 
TRUNCATE `preffix_sales_flat_quote_item`; 
TRUNCATE `preffix_sales_flat_quote_item_option`; 
TRUNCATE `preffix_sales_flat_quote_payment`; 
TRUNCATE `preffix_sales_flat_quote_shipping_rate`; 
TRUNCATE `preffix_sales_flat_shipment`; 
TRUNCATE `preffix_sales_flat_shipment_comment`; 
TRUNCATE `preffix_sales_flat_shipment_grid`; 
TRUNCATE `preffix_sales_flat_shipment_item`; 
TRUNCATE `preffix_sales_flat_shipment_track`; 
TRUNCATE `preffix_sales_invoiced_aggregated`; 
TRUNCATE `preffix_sales_invoiced_aggregated_order`; 
TRUNCATE `preffix_sales_payment_transaction`;
TRUNCATE `preffix_sales_order_aggregated_created`; 
TRUNCATE `preffix_sales_order_tax`;
TRUNCATE `preffix_sales_order_tax_item`;
TRUNCATE `preffix_sendfriend_log`; 
TRUNCATE `preffix_tag`; 
TRUNCATE `preffix_tag_relation`; 
TRUNCATE `preffix_tag_summary`; 
TRUNCATE `preffix_wishlist`; 
TRUNCATE `preffix_log_quote`; 
TRUNCATE `preffix_report_event`; 
ALTER TABLE `preffix_sales_flat_creditmemo` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_creditmemo_comment` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_creditmemo_grid` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_creditmemo_item` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_invoice` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_invoice_comment` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_invoice_grid` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_invoice_item` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_order` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_order_address` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_order_grid` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_order_item` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_order_payment` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_order_status_history` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_quote` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_quote_address` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_quote_address_item` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_quote_item` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_quote_item_option` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_quote_payment` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_quote_shipping_rate` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_shipment` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_shipment_comment` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_shipment_grid` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_shipment_item` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_flat_shipment_track` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_invoiced_aggregated` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_invoiced_aggregated_order` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_payment_transaction` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_order_aggregated_created` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_order_tax` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sales_order_tax_item` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_sendfriend_log` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_tag` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_tag_relation` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_tag_summary` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_wishlist` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_log_quote` AUTO_INCREMENT=1; 
ALTER TABLE `preffix_report_event` AUTO_INCREMENT=1; 
SET FOREIGN_KEY_CHECKS=1;