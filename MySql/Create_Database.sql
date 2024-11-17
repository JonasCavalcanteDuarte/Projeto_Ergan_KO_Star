CREATE DATABASE projeto_ergan_ko_star;

USE projeto_ergan_ko_star;

CREATE TABLE log_APIS (
id int primary key auto_increment,
nm_loja varchar(10),
nm_table varchar(20),
nm_process varchar(30),
nm_API varchar(100),
nm_report varchar(60),
ds_resp_API varchar(10),
nu_status_code int,
ds_body varchar(1000),
dh_request timestamp,
dh_expire_token timestamp
);

CREATE TABLE users(
id int primary key auto_increment,
nome varchar(100) not null,
email varchar(100) not null unique,
senha varchar(255) not null,
nivel int,
dh_criacao timestamp,
dh_ultima_modificacao timestamp,
criado_por varchar(20),
alterado_por varchar(20)
);

CREATE TABLE credenciais_amz(
nm_loja varchar(100),
client_id varchar(255),
client_secret varchar(255),
refresh_token varchar(1000),
dh_last_update timestamp
);

/*
INSERT INTO credenciais_amz VALUES('Ergan','amzn1.application-oa2-client.d056c9cf2aa44b7999cd16e7672b36c6','amzn1.oa2-cs.v1.02aacb3ac03c25452e7bf34970a510d6f14120ff7778c3ddc2b76b8711f312c1','Atzr|IwEBIBrgZQ9fT2X7-8u8yWo1FBRDyJjil-8IajGqaY0EI8-Q-cw126-c_q2X1UzQZegQF4Ulv36ZrI-C4dwQtdkZN3oNT7TB_utoOOaZSjuLFIAKmTuMhk0A6RtEalSja9AlfHCs0gWRVXVZQXTE126PNTwG1ich-oNqM8RiRpbMn2GGSoGJPRwLH-ul_Wj5DEQHL_YeTScD4KEcmrI4Cc5ICWoLEanx2k1IksoPevF0WRFOsesicUNjS7I0dVrNNHM9un4S2igQGybIUmvI2R7EuwzULzbVdZOHaWTkZd33-5TP8jQ_W9KK1OgA1j63MEeJjh9JYQOUoQeU5QxNgGEpZKBy',null);
INSERT INTO credenciais_amz VALUES('KO-Star','amzn1.application-oa2-client.e82405001127446e84d73dc8702f26fe','amzn1.oa2-cs.v1.06071247b6faac257d2454921478c0ef4a72772514b5a77ae568bde10f2dfa84','Atzr|IwEBIEF_S_Pnrk8yrvjA4DWGtGazE3s44UMq1sadwT40pDAG_EYP4CL9_Q-Svmec9Cu3Vo3v1U3Xe7DrXiaPQAtzUDLvLmjTuFl-IrYxXtGMSjdGTpAKzAEoPZN95GXClh8rdmsg5-UtKi97vQfwyMFdahbqg8uQ7_3Lo__GhFtZkYr5xbtToLQjFqUCmjgYYZANaORfiQQUsN07fYBuO6HNJSlKVpxdrnzkCN6k5bECT2c6IARTLcjYJwCczRW_u85k0h8o2-rmFRH2jv7_SchX1RWjp4bC2-i4m4egtwv6jPHHrNWv4beHTcfA_nPfJMxpRzQ',null);
*/

CREATE TABLE products(
item_name varchar(4000),
listing_id varchar(20),
seller_sku varchar(100),
price varchar(6),
quantity int,
open_date timestamp,
image_url varchar(4000),
asin varchar(50),
product_id varchar(50),
fulfillment_channel varchar(200),
merchant_shipping_group varchar(200),
status varchar(100),
nm_loja VARCHAR(20)
);

ALTER TABLE products
ADD CONSTRAINT PK_Composta_P PRIMARY KEY CLUSTERED (nm_loja, seller_sku);

CREATE TABLE products_acquisition_value(
loja VARCHAR(20),
seller_sku VARCHAR(100),
asin VARCHAR(50),
acquisition_value VARCHAR(6)
);

ALTER TABLE products_acquisition_value
ADD CONSTRAINT PK_Composta_PAV PRIMARY KEY CLUSTERED (loja, seller_sku);

DELIMITER //
CREATE TRIGGER Products_Acquisition_Value_BI
BEFORE INSERT ON products
FOR EACH ROW
BEGIN
	SELECT acquisition_value INTO @X FROM products_acquisition_value WHERE seller_sku = NEW.seller_sku;
	REPLACE INTO products_acquisition_value VALUES (NEW.nm_loja, NEW.seller_sku, NEW.asin, @X);
    SET @X = NULL;
END;
//
DELIMITER ;

CREATE TABLE order_details(
amazon_order_id varchar(50),
merchant_order_id varchar(50),
purchase_date timestamp,
last_updated_date timestamp,
order_status varchar(50),
fulfillment_channel varchar(20),
sales_channel varchar(30),
product_name varchar(1000),
sku varchar(50),
asin varchar(50),
item_status varchar(30),
quantity int,
currency varchar(5),
item_price float,
item_tax float,
shipping_price float,
shipping_tax float,
ship_city varchar(20),
ship_state varchar(20),
ship_postal_code varchar(10),
ship_country varchar(20),
payment_method_details varchar(30),
ship_county varchar(30),
nm_loja VARCHAR(20)
);

ALTER TABLE order_details
ADD CONSTRAINT PK_Composta_OD PRIMARY KEY CLUSTERED (nm_loja, sku, amazon_order_id);