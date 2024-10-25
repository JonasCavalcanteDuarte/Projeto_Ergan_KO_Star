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
dh_criacao timestamp
);

CREATE TABLE credenciais_amz(
nm_loja varchar(100),
client_id varchar(255),
client_secret varchar(255),
refresh_token varchar(1000),
dh_last_update timestamp
);

CREATE TABLE products(
item_name varchar(4000),
listing_id varchar(20),
seller_sku varchar(100) primary key,
price varchar(6),
quantity int,
open_date timestamp,
image_url varchar(4000),
asin varchar(50),
product_id varchar(50),
fulfillment_channel varchar(200),
merchant_shipping_group varchar(200),
status varchar(100),
acquisition_value varchar(6)
);