INSERT INTO `USER_LEVEL` (`users_level_label`) VALUES
('client'),
('moderator'),
('admin');
INSERT INTO `CATEGORY` (`cat_label`, `id_category_parent_of`) VALUES
('Sweat', NULL);
INSERT INTO `FILTER_TYPE`(`filter_type_label`) VALUES ('Couleur');
INSERT INTO `FILTER_TYPE`(`filter_type_label`) VALUES ('Pointure');
INSERT INTO `FILTERED_BY`(`id_category`, `id_filter_type`) VALUES (1,1);

INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('1','1');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('2','1');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('3','1');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('4','1');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('5','2');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('6','2');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('7','2');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('8','2');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('9','2');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('10','2');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('11','2');
INSERT INTO `CHOICE_`(`id_choice_`, `id_filter_type`) VALUES ('12','2');


INSERT INTO `CHOICE_COLOR`(`id_choice_`, `color_choice_label`, `color_choice_hexa`) VALUES ('1','Vert','#00ff00');
INSERT INTO `CHOICE_COLOR`(`id_choice_`, `color_choice_label`, `color_choice_hexa`) VALUES ('2','Bleu','#0000ff');
INSERT INTO `CHOICE_COLOR`(`id_choice_`, `color_choice_label`, `color_choice_hexa`) VALUES ('3','Rouge','#ff0000');
INSERT INTO `CHOICE_COLOR`(`id_choice_`, `color_choice_label`, `color_choice_hexa`) VALUES ('4','Blanc','#000000');

INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('5','38');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('6','39');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('7','40');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('8','41');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('9','42');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('10','43');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('11','44');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('12','45');



INSERT INTO `BRAND` (`id_brand`, `brand_label`) VALUES
(3, 'Adidas'),
(4, 'Jordan\'s'),
(6, 'Lapierre'),
(2, 'Nike'),
(1, 'Puma'),
(5, 'Reebook'),
(7, 'Trocado');

INSERT INTO `ARTICLE` (`id_article`, `article_name`, `description`, `id_brand`, `id_category`) VALUES
(1, 'Basket jordan&#039;s collection 2026', 'De super chaussures !', 4, 1);

INSERT INTO `PRICE_HISTORY` (`id_price_history`, `start_date`, `end_date`, `price`, `id_article`) VALUES
(1, '2026-04-05', NULL, 520.00, 1);

INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','1','1');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','2','1');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','3','1');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','4','1');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','5','2');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','6','2');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','7','2');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','8','2');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','9','2');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','10','2');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','11','2');
INSERT INTO `VALUES_`(`id_article`, `id_choice_`, `id_filter_type`) VALUES ('1','12','2');

CREATE VIEW FILTER_VALUES_ASSOCIATIONS 
AS
SELECT *, CASE
             WHEN EXISTS(SELECT *
                         FROM   CHOICE_COLOR AS CC
                         WHERE  CC.id_choice_ = C.id_choice_) 
                THEN (SELECT CC.color_choice_label
                      FROM CHOICE_COLOR AS CC WHERE CC.id_choice_ = C.id_choice_)
             WHEN EXISTS(SELECT *
                         FROM   CHOICE_TXT AS CT
                         WHERE  CT.id_choice_ = C.id_choice_) 
                THEN (SELECT CT.choice
                      FROM CHOICE_TXT AS CT WHERE CT.id_choice_ = C.id_choice_)
             WHEN EXISTS(SELECT *
                         FROM   CHOICE_NUMBER AS CN
                         WHERE  CN.id_choice_ = C.id_choice_) 
                THEN (SELECT CN.choice
                      FROM CHOICE_NUMBER AS CN WHERE CN.id_choice_ = C.id_choice_)
        	    WHEN EXISTS(SELECT *
                         FROM   CHOICE_RANGE AS CR
                         WHERE  CR.id_choice_ = C.id_choice_) 
                THEN (SELECT CR.max_
                      FROM CHOICE_RANGE AS CR WHERE CR.id_choice_ = C.id_choice_)
             ELSE NULL
          END AS filter_value
FROM CHOICE_ AS C;
