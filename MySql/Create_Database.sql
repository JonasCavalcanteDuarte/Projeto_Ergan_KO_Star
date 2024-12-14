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
alterado_por varchar(20),
loja_acesso varchar(10)
);

CREATE TABLE user_access_level(
level_access int primary key,
level_description varchar(35)
);

INSERT INTO user_access_level VALUES(1,'Nivel 1 (ADM Ergan E KO-Star)');
INSERT INTO user_access_level VALUES(2,'Nivel 2 (Leitor Ergan E KO-Star)');
INSERT INTO user_access_level VALUES(3,'Nivel 3 (ADM Somente uma loja)');
INSERT INTO user_access_level VALUES(4,'Nivel 4 (Leitor Somente uma loja)');

CREATE TABLE log_users (
id int primary key auto_increment,
id_user int,
nm_user varchar(100),
acao varchar(10), #Cadastrar, Editar, Excluir
alvo varchar(15), #Usuário, Produto, Credencial API
old_values varchar(1000), #Valores antigos do registro, se for um Cadastro não amazena
new_values varchar(1000), #Valores novos do registro, se for uma Exclusão não armazena
dh_execucao timestamp,
nm_loja varchar(10)
);

CREATE TABLE credenciais_amz(
nm_loja varchar(100),
client_id varchar(255),
client_secret varchar(255),
refresh_token varchar(1000),
dh_last_update timestamp,
alterado_por varchar(20)
);

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
acquisition_value VARCHAR(6),
dh_last_update timestamp,
alterado_por varchar(20)
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