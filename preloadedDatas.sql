INSERT INTO `USERS_LEVEL` (`id_user_level`, `users_level_label`) VALUES
(1, 'client'),
(2, 'moderator'),
(3, 'admin');

INSERT INTO `CATEGORY`(`cat_label`) VALUES ('Sweat');
INSERT INTO `FILTER_TYPE`(`filter_type_label`) VALUES ('Taille universelle de vêtements');
INSERT INTO `FILTERED_BY`(`id_cat`, `id_filter_type`) VALUES (1,1);
INSERT INTO `FILTER_VALUES`( `filter_value`, `id_filter_type`) VALUES ('XS',1);
INSERT INTO `FILTER_VALUES`( `filter_value`, `id_filter_type`) VALUES ('S',1);
INSERT INTO `FILTER_VALUES`( `filter_value`, `id_filter_type`) VALUES ('M',1);
INSERT INTO `FILTER_VALUES`( `filter_value`, `id_filter_type`) VALUES ('L',1);
INSERT INTO `FILTER_VALUES`( `filter_value`, `id_filter_type`) VALUES ('XL',1);
INSERT INTO `FILTER_VALUES`( `filter_value`, `id_filter_type`) VALUES ('XXL',1);
INSERT INTO `FILTER_VALUES`( `filter_value`, `id_filter_type`) VALUES ('XXXL',1);

INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Jaune','#a674D3');
INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Noir','#000000');
INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Blanc','#ffffff');
INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Rouge','#ee0000');
INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Bleu','#00ee00');
INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Vert','#0000ee');
INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Orange','#FFA500');
INSERT INTO `COLORS`(`color_label`, `color_value`) VALUES ('Violet','#800080');

