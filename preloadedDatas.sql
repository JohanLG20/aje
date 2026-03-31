INSERT INTO `USER_LEVEL` (`id_user_level`, `users_level_label`) VALUES
(1, 'client'),
(2, 'moderator'),
(3, 'admin');

INSERT INTO `CATEGORY`(`cat_label`) VALUES ('Sweat');
INSERT INTO `FILTER_TYPE`(`filter_type_label`) VALUES ('Couleur');
INSERT INTO `FILTERED_BY`(`id_category`, `id_filter_type`) VALUES (1,1);

INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('1');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('1');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('1');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('1');

INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice_`) VALUES ('Vert','#00ff00',1);
INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice_`) VALUES ('Blanc','#000000',2);
INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice_`) VALUES ('Rouge','#ff0000',3);
INSERT INTO `CHOICE_COLOR`(`color_choice_label`, `color_choice_hexa`, `id_choice_`) VALUES ('Bleu','#0000ff',4);

INSERT INTO `FILTER_TYPE`(`filter_type_label`) VALUES ('Pointure');

INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');
INSERT INTO `CHOICE_`(`id_filter_type`) VALUES ('2');

INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('5','38');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('6','39');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('7','40');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('8','41');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('9','42');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('10','43');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('11','44');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('12','45');
INSERT INTO `CHOICE_NUMBER`(`id_choice_`, `choice`) VALUES ('13','46');

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
