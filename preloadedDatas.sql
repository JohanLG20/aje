INSERT INTO `USER_LEVEL` (`users_level_label`) VALUES
('client'),
('moderator'),
('admin');

INSERT INTO `CATEGORY` (`id_category`, `cat_label`, `id_category_parent_of`) VALUES
(1, 'Textile', NULL),
(2, 'Haut', 1),
(3, 'Bas', 1),
(4, 'Chaussures', 1),
(5, 'Sandales', 4),
(6, 'Ceinture', 1),
(7, 'Leggings', 3);


INSERT INTO `FILTER_TYPE` (`id_filter_type`, `filter_type_label`, `filter_type_unit`) VALUES
(1, 'Couleur', NULL),
(2, 'Pointure', NULL),
(3, 'Taille universelle', NULL),
(4, 'Taille américaine', NULL),
(5, 'Forme des boucles', NULL);


INSERT INTO `FILTERED_BY` (`id_category`, `id_filter_type`) VALUES
(1, 1),
(2, 3),
(4, 2),
(5, 5);

INSERT INTO `CHOICE_` (`id_choice_`, `id_filter_type`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(13, 5),
(14, 5),
(15, 5),
(16, 5);

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

INSERT INTO `CHOICE_TXT` (`id_choice_`, `choice`) VALUES
(13, 'Ronde'),
(14, 'Carrée'),
(15, 'Ovale'),
(16, 'Tête de moineau'),
(17, 'XS'),
(18, 'S'),
(19, 'M'),
(20, 'L'),
(21, 'XL'),
(22, 'XXL');



INSERT INTO `BRAND` (`id_brand`, `brand_label`) VALUES
(3, 'Adidas'),
(4, 'Jordan\'s'),
(6, 'Lapierre'),
(2, 'Nike'),
(1, 'Puma'),
(5, 'Reebook'),
(7, 'Trocado');




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
                THEN (SELECT CONCAT(CR.min_, " - ", CR.max_)
                      FROM CHOICE_RANGE AS CR WHERE CR.id_choice_ = C.id_choice_)
             ELSE NULL
          END AS filter_value
FROM CHOICE_ AS C;
