CREATE TABLE CATEGORY(
   id_cat INT AUTO_INCREMENT,
   cat_label VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_cat)
);

CREATE TABLE USERS_LEVEL(
   id_user_level INT AUTO_INCREMENT,
   users_level_label VARCHAR(20) NOT NULL,
   PRIMARY KEY(id_user_level)
);

CREATE TABLE FILTER_TYPE(
   id_filter_type INT AUTO_INCREMENT,
   filter_type_label VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_filter_type)
);

CREATE TABLE FILTER_VALUES(
   id_filter_value INT AUTO_INCREMENT,
   filter_value VARCHAR(50) NOT NULL,
   id_filter_type INT NOT NULL,
   PRIMARY KEY(id_filter_value),
   UNIQUE(filter_value),
   FOREIGN KEY(id_filter_type) REFERENCES FILTER_TYPE(id_filter_type)
);

CREATE TABLE ARTICLES(
   id_article INT AUTO_INCREMENT,
   description VARCHAR(255) NOT NULL,
   id_cat INT NOT NULL,
   PRIMARY KEY(id_article),
   FOREIGN KEY(id_cat) REFERENCES CATEGORY(id_cat)
);

CREATE TABLE USERS(
   mail VARCHAR(50),
   passwd VARCHAR(100) NOT NULL,
   first_name VARCHAR(50) NOT NULL,
   last_name VARCHAR(50) NOT NULL,
   postal_code INT NOT NULL,
   city VARCHAR(50) NOT NULL,
   address VARCHAR(50) NOT NULL,
   phone_number VARCHAR(50),
   id_user_level INT NOT NULL,
   PRIMARY KEY(mail),
   UNIQUE(phone_number),
   FOREIGN KEY(id_user_level) REFERENCES USERS_LEVEL(id_user_level)
);

CREATE TABLE PRICES_HISTORY(
   id_price_history INT AUTO_INCREMENT,
   start_date DATE NOT NULL,
   end_date DATE,
   price DECIMAL(7,2),
   id_article INT NOT NULL,
   PRIMARY KEY(id_price_history),
   FOREIGN KEY(id_article) REFERENCES ARTICLES(id_article)
);

CREATE TABLE ORDERS(
   id_order INT AUTO_INCREMENT,
   date_ VARCHAR(50) NOT NULL,
   mail VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_order),
   FOREIGN KEY(mail) REFERENCES USERS(mail)
);

CREATE TABLE ARTICLES_ORDER(
   id_article INT,
   id_order INT,
   quantity INT,
   PRIMARY KEY(id_article, id_order),
   FOREIGN KEY(id_article) REFERENCES ARTICLES(id_article),
   FOREIGN KEY(id_order) REFERENCES ORDERS(id_order)
);

CREATE TABLE COMMENT(
   id_article INT,
   mail VARCHAR(50),
   comment_label VARCHAR(180),
   PRIMARY KEY(id_article, mail),
   FOREIGN KEY(id_article) REFERENCES ARTICLES(id_article),
   FOREIGN KEY(mail) REFERENCES USERS(mail)
);

CREATE TABLE FILTERED_BY(
   id_cat INT,
   id_filter_type INT,
   PRIMARY KEY(id_cat, id_filter_type),
   FOREIGN KEY(id_cat) REFERENCES CATEGORY(id_cat),
   FOREIGN KEY(id_filter_type) REFERENCES FILTER_TYPE(id_filter_type)
);

CREATE TABLE ARTICLES_FILTER_VALUES(
   id_article INT,
   id_filter_value INT,
   PRIMARY KEY(id_article, id_filter_value),
   FOREIGN KEY(id_article) REFERENCES ARTICLES(id_article),
   FOREIGN KEY(id_filter_value) REFERENCES FILTER_VALUES(id_filter_value)
);

CREATE TRIGGER valid_filter_value BEFORE INSERT ON ARTICLES_FILTER_VALUES FOR EACH ROW
IF NOT EXISTS( 
  SELECT
    1
  FROM
    (FILTER_VALUES AS fv
    INNER JOIN FILTER_TYPE AS ft ON fv.id_filter_type = ft.id_filter_type
    INNER JOIN FILTERED_BY AS fb ON ft.id_filter_type = fb.id_filter_type
    INNER JOIN ARTICLES AS a ON fb.id_cat = a.id_cat)
  WHERE
    fv.id_filter_value = NEW.id_filter_value
    AND a.id_article = NEW.id_article)
   BEGIN
   END


CREATE ASSERTION valid_filter_value CHECK (
  (
    SELECT
      id_cat as articleCat
    FROM
      ARTICLES_FILTER_VALUES
      INNER JOIN ARTICLES ON ARTICLES.id_article = ARTICLES_FILTER_VALUES.id_article
  ) = (
    SELECT
      id_cat
    FROM
      ARTICLES_FILTER_VALUES
      INNER JOIN FILTER_VALUES ON ARTICLES_FILTER_VALUES.id_filter_values = FILTER_VALUES.id_filter_value
      INNER JOIN FILTER_TYPE ON FILTER_VALUES.id_filter_type = FILTER_TYPE.id_filter_type
      INNER JOIN FILTERED_BY ON FILTER_TYPE.id_filter_type = FILTERED_BY.id_filter_type
      AND FILTERED_BY.id_cat = articleCat
  )
)

