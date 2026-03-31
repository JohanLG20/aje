INSERT INTO `USERS_LEVEL` (`id_user_level`, `users_level_label`) VALUES
(1, 'client'),
(2, 'moderator'),
(3, 'admin');

INSERT INTO `CATEGORY`(`cat_label`) VALUES ('Sweat');
INSERT INTO `FILTER_TYPE`(`filter_type_label`) VALUES ('Taille universelle de vêtements');
INSERT INTO `FILTERED_BY`(`id_cat`, `id_filter_type`) VALUES (1,1);

INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('1');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('1');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('1');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('1');

INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice`) VALUES ('Vert','#00ff00',1);
INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice`) VALUES ('Blanc','#000000',2);
INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice`) VALUES ('Rouge','#ff0000',3);
INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice`) VALUES ('Bleu','#0000ff',4);

INSERT INTO `FILTER_TYPE`(`filter_type_label`) VALUES ('Pointure');

INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICES`(`id_filter_type`) VALUES ('2');

INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('5','38');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('6','39');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('7','40');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('8','41');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('9','42');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('10','43');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('11','44');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('12','45');
INSERT INTO `CHOICE_NUMBER`(`id_choice`, `choice`) VALUES ('13','46');

CREATE VIEW FILTER_TYPES_ASSOCIATIONS 
AS
SELECT *, CASE
             WHEN EXISTS(SELECT *
                         FROM   CHOICE_COLOR AS CC
                         WHERE  CC.id_choice = C.id_choice) 
                THEN (SELECT CC.color_choice_label
                      FROM CHOICE_COLOR AS CC WHERE CC.id_choice = C.id_choice)
             WHEN EXISTS(SELECT *
                         FROM   CHOICE_TXT AS CT
                         WHERE  CT.id_choice = C.id_choice) 
                THEN (SELECT CT.choice
                      FROM CHOICE_TXT AS CT WHERE CT.id_choice = C.id_choice)
             WHEN EXISTS(SELECT *
                         FROM   CHOICE_NUMBER AS CN
                         WHERE  CN.id_choice = C.id_choice) 
                THEN (SELECT CN.choice
                      FROM CHOICE_NUMBER AS CN WHERE CN.id_choice = C.id_choice)
        	    WHEN EXISTS(SELECT *
                         FROM   CHOICE_RANGE AS CR
                         WHERE  CR.id_choice = C.id_choice) 
                THEN (SELECT CR.max_
                      FROM CHOICE_RANGE AS CR WHERE CR.id_choice = C.id_choice)
             ELSE NULL
          END AS filter_value
FROM CHOICES AS C;
