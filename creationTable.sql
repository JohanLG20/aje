CREATE TABLE CATEGORY(
   id_category INT AUTO_INCREMENT,
   cat_label VARCHAR(50) NOT NULL,
   id_category_parent_of INT,
   PRIMARY KEY(id_category),
   FOREIGN KEY(id_category_parent_of) REFERENCES CATEGORY(id_category)
);

CREATE TABLE USER_LEVEL(
   id_user_level INT AUTO_INCREMENT,
   users_level_label VARCHAR(20) NOT NULL,
   PRIMARY KEY(id_user_level)
);

CREATE TABLE FILTER_TYPE(
   id_filter_type INT AUTO_INCREMENT,
   filter_type_label VARCHAR(50) NOT NULL,
   filter_type_unit VARCHAR(10),
   PRIMARY KEY(id_filter_type)
);

CREATE TABLE CHOICE_(
   id_choice_ INT AUTO_INCREMENT,
   id_filter_type INT NOT NULL,
   PRIMARY KEY(id_choice_),
   FOREIGN KEY(id_filter_type) REFERENCES FILTER_TYPE(id_filter_type)
);

CREATE TABLE BRAND(
   id_brand INT AUTO_INCREMENT,
   brand_label VARCHAR(50),
   PRIMARY KEY(id_brand),
   UNIQUE(brand_label)
);

CREATE TABLE ARTICLE(
   id_article INT AUTO_INCREMENT,
   article_name VARCHAR(50),
   description VARCHAR(255) NOT NULL,
   id_brand INT,
   id_category INT,
   PRIMARY KEY(id_article),
   FOREIGN KEY(id_brand) REFERENCES BRAND(id_brand),
   FOREIGN KEY(id_category) REFERENCES CATEGORY(id_category)
);

CREATE TABLE USER_(
   id_user_ INT AUTO_INCREMENT,
   mail VARCHAR(50) NOT NULL,
   passwd VARCHAR(255) NOT NULL,
   first_name VARCHAR(50) NOT NULL,
   last_name VARCHAR(50) NOT NULL,
   postal_code INT NOT NULL,
   city VARCHAR(50) NOT NULL,
   address VARCHAR(50) NOT NULL,
   phone_number VARCHAR(50) DEFAULT NULL,
   id_user_level INT NOT NULL,
   PRIMARY KEY(id_user_),
   UNIQUE(mail),
   UNIQUE(phone_number),
   FOREIGN KEY(id_user_level) REFERENCES USER_LEVEL(id_user_level)
);

CREATE TABLE PRICE_HISTORY(
   id_price_history INT AUTO_INCREMENT,
   start_date DATE NOT NULL,
   end_date DATE,
   price DECIMAL(7,2),
   id_article INT NOT NULL,
   PRIMARY KEY(id_price_history),
   FOREIGN KEY(id_article) REFERENCES ARTICLE(id_article)
);

CREATE TABLE CHOICE_TXT(
   id_choice_ INT,
   choice VARCHAR(30) NOT NULL,
   PRIMARY KEY(id_choice_),
   FOREIGN KEY(id_choice_) REFERENCES CHOICE_(id_choice_)
);

CREATE TABLE CHOICE_NUMBER(
   id_choice_ INT,
   choice INT NOT NULL,
   PRIMARY KEY(id_choice_),
   FOREIGN KEY(id_choice_) REFERENCES CHOICE_(id_choice_)
);

CREATE TABLE CHOICE_RANGE(
   id_choice_ INT,
   min_ DECIMAL(8,3) NOT NULL,
   max_ DECIMAL(8,3) NOT NULL,
   PRIMARY KEY(id_choice_),
   FOREIGN KEY(id_choice_) REFERENCES CHOICE_(id_choice_)
);

CREATE TABLE CHOICE_COLOR(
   id_choice_ INT,
   color_choice_label VARCHAR(30) NOT NULL,
   color_choice_hexa VARCHAR(7) NOT NULL,
   PRIMARY KEY(id_choice_),
   FOREIGN KEY(id_choice_) REFERENCES CHOICE_(id_choice_)
);

CREATE TABLE VALUES_(
   id_values_ INT AUTO_INCREMENT,
   id_article INT NOT NULL,
   id_choice_ INT NOT NULL,
   id_filter_type INT NOT NULL,
   PRIMARY KEY(id_values_),
   FOREIGN KEY(id_article) REFERENCES ARTICLE(id_article),
   FOREIGN KEY(id_choice_) REFERENCES CHOICE_(id_choice_),
   FOREIGN KEY(id_filter_type) REFERENCES FILTER_TYPE(id_filter_type)
);

CREATE TABLE ORDER_(
   id_order_ INT AUTO_INCREMENT,
   date_ VARCHAR(50) NOT NULL,
   id_user_ INT NOT NULL,
   PRIMARY KEY(id_order_),
   FOREIGN KEY(id_user_) REFERENCES USER_(id_user_)
);

CREATE TABLE ARTICLE_ORDER(
   id_article INT,
   id_order_ INT,
   quantity INT,
   PRIMARY KEY(id_article, id_order_),
   FOREIGN KEY(id_article) REFERENCES ARTICLE(id_article),
   FOREIGN KEY(id_order_) REFERENCES ORDER_(id_order_)
);

CREATE TABLE COMMENT(
   id_article INT,
   id_user_ INT,
   comment_label VARCHAR(180),
   PRIMARY KEY(id_article, id_user_),
   FOREIGN KEY(id_article) REFERENCES ARTICLE(id_article),
   FOREIGN KEY(id_user_) REFERENCES USER_(id_user_)
);

CREATE TABLE FILTERED_BY(
   id_category INT,
   id_filter_type INT,
   PRIMARY KEY(id_category, id_filter_type),
   FOREIGN KEY(id_category) REFERENCES CATEGORY(id_category),
   FOREIGN KEY(id_filter_type) REFERENCES FILTER_TYPE(id_filter_type)
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

