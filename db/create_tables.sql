/* sistema_financeiro: */

CREATE TABLE users (
    id_user int PRIMARY KEY,
    name varchar(100),
    email varchar(100),
    password varchar(255),
    class int
);

CREATE TABLE stocks (
    id_stock int PRIMARY KEY,
    ticker varchar(100),
    company varchar(100)
);

CREATE TABLE transactions (
    id_transaction int PRIMARY KEY,
    type varchar(100),
    quantity int,
    user_id int,
    stock_id int,
    cotation_id int,
    date_time datetime
);

CREATE TABLE cotations (
    id_cotation int PRIMARY KEY,
    stock_id int,
    value double,
    date_time datetime
);

CREATE TABLE classes (
    id_class int PRIMARY KEY,
    class varchar(255)
);
 
ALTER TABLE users ADD CONSTRAINT FK_users_2
    FOREIGN KEY (class)
    REFERENCES classes (id_class);
 
ALTER TABLE transactions ADD CONSTRAINT FK_transactions_2
    FOREIGN KEY (user_id)
    REFERENCES users (id_user);
 
ALTER TABLE transactions ADD CONSTRAINT FK_transactions_3
    FOREIGN KEY (stock_id)
    REFERENCES stocks (id_stock);
 
ALTER TABLE transactions ADD CONSTRAINT FK_transactions_4
    FOREIGN KEY (cotation_id)
    REFERENCES cotations (id_cotation);
 
ALTER TABLE transactions ADD CONSTRAINT FK_transactions_5
    FOREIGN KEY (stock_id???)
    REFERENCES ??? (???);
 
ALTER TABLE cotations ADD CONSTRAINT FK_cotations_2
    FOREIGN KEY (stock_id)
    REFERENCES stocks (id_stock);