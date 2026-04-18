-- Catégories
INSERT INTO CATEGORY (cat_label, id_category_parent_of) VALUES
('Vêtements', NULL),
('Pantalons', 1),
('T-shirts', 1),
('Chaussures', NULL),
('Baskets', 4),
('Accessoires', NULL),
('Sacs', 6);

-- Marques
INSERT INTO BRAND (brand_label) VALUES
('Nike'),
('Adidas'),
('Zara'),
('Levi\'s'),
('New Balance');

-- Types de filtres
INSERT INTO FILTER_TYPE (filter_type_label, filter_type_unit) VALUES
('Taille', NULL),
('Couleur', NULL),
('Matière', NULL),
('Pointure', 'EU'),
('Poids', 'kg');

-- Informations articles
INSERT INTO ARTICLE_INFORMATIONS (article_name, description, image_repertory, id_category, id_brand) VALUES
('Jean slim 501', 'Jean slim coupe moderne', '6b96', 2, 4),
('T-shirt Col Rond', 'T-shirt basique col rond', '6b97', 3, 3),
('Basket Air Max', 'Basket running légère', '6b98', 5, 1),
('Jean bootcut', 'Jean coupe bootcut classique', '6b99', 2, 4),
('T-shirt Col V', 'T-shirt col V ajusté', '6b92', 3, 3),
('Basket Stan Smith', 'Basket lifestyle iconique', '6b94', 5, 2),
('Sac à dos urbain', 'Sac à dos 20L imperméable', '6b963', 7, 2),
('Basket 574', 'Basket confort quotidien', '6b90', 5, 5);

-- Articles
INSERT INTO ARTICLE (id_article_informations) VALUES
(1), (2), (3), (4), (5), (6), (7), (8);

-- Historique des prix (prix normaux, sans date de fin)
INSERT INTO PRICE_HISTORY (start_date, end_date, price, id_article) VALUES
('2024-01-01', NULL, 59.99, 1),
('2024-01-01', NULL, 19.99, 2),
('2024-01-01', NULL, 129.99, 3),
('2024-01-01', NULL, 69.99, 4),
('2024-01-01', NULL, 24.99, 5),
('2024-01-01', NULL, 89.99, 6),
('2024-01-01', NULL, 49.99, 7),
('2024-01-01', NULL, 109.99, 8);

-- Prix promotionnels (articles 1, 3 et 6 en promo)
INSERT INTO PRICE_HISTORY (start_date, end_date, price, id_article) VALUES
('2026-04-01', '2026-04-30', 44.99, 1),
('2026-04-10', '2026-04-25', 99.99, 3),
('2026-04-15', '2026-04-20', 69.99, 6);

-- Choix texte (tailles et matières)
INSERT INTO CHOICE_ (id_filter_type) VALUES
(1), (1), (1), (1), -- Tailles S, M, L, XL
(3), (3), (3),      -- Matières coton, laine, synthétique
(4), (4), (4);      -- Pointures 40, 42, 44

INSERT INTO CHOICE_TXT (id_choice_, choice) VALUES
(1, 'S'), (2, 'M'), (3, 'L'), (4, 'XL'),
(5, 'Coton'), (6, 'Laine'), (7, 'Synthétique');

INSERT INTO CHOICE_NUMBER (id_choice_, choice) VALUES
(8, 40), (9, 42), (10, 44);

-- Choix couleurs
INSERT INTO CHOICE_ (id_filter_type) VALUES
(2), (2), (2), (2); -- Couleurs

INSERT INTO CHOICE_COLOR (id_choice_, color_choice_label, color_choice_hexa) VALUES
(11, 'Bleu', '#0000FF'),
(12, 'Noir', '#000000'),
(13, 'Blanc', '#FFFFFF'),
(14, 'Rouge', '#FF0000');

-- Association filtres / catégories
INSERT INTO FILTERED_BY (id_category, id_filter_type) VALUES
(2, 1), -- Pantalons filtrés par taille
(2, 2), -- Pantalons filtrés par couleur
(2, 3), -- Pantalons filtrés par matière
(3, 1), -- T-shirts filtrés par taille
(3, 2), -- T-shirts filtrés par couleur
(3, 3), -- T-shirts filtrés par matière
(5, 2), -- Baskets filtrées par couleur
(5, 4), -- Baskets filtrées par pointure
(7, 5); -- Sacs filtrés par poids

-- Valeurs des articles
-- Jean slim 501 (article 1) : M, Bleu, Coton
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(1, 2, 1),  -- Taille M
(1, 11, 2), -- Couleur Bleu
(1, 5, 3);  -- Matière Coton

-- T-shirt Col Rond (article 2) : L, Blanc, Coton
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(2, 3, 1),  -- Taille L
(2, 13, 2), -- Couleur Blanc
(2, 5, 3);  -- Matière Coton

-- Basket Air Max (article 3) : Blanc, pointure 42
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(3, 13, 2), -- Couleur Blanc
(3, 9, 4);  -- Pointure 42

-- Jean bootcut (article 4) : XL, Noir, Laine
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(4, 4, 1),  -- Taille XL
(4, 12, 2), -- Couleur Noir
(4, 6, 3);  -- Matière Laine

-- T-shirt Col V (article 5) : S, Rouge, Synthétique
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(5, 1, 1),  -- Taille S
(5, 14, 2), -- Couleur Rouge
(5, 7, 3);  -- Matière Synthétique

-- Basket Stan Smith (article 6) : Blanc, pointure 40
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(6, 13, 2), -- Couleur Blanc
(6, 8, 4);  -- Pointure 40

-- Sac à dos urbain (article 7) : Noir
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(7, 12, 2); -- Couleur Noir

-- Basket 574 (article 8) : Bleu, pointure 44
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(8, 11, 2), -- Couleur Bleu
(8, 10, 4); -- Pointure 44



INSERT INTO BRAND (brand_label) VALUES ('Jordan');

-- Informations communes à toutes les variantes
INSERT INTO ARTICLE_INFORMATIONS (article_name, description, image_repertory, id_category, id_brand)
VALUES ('Air Jordan 1 Retro High', 'La légendaire basket montante Air Jordan 1 dans son coloris Chicago', 'img/baskets/air-jordan-1', 5, 6);

-- 10 variantes (une par pointure)
INSERT INTO ARTICLE (id_article_informations) VALUES
(2), (2), (2), (2), (2), (2), (2), (2), (2), (2);

-- Prix normaux pour chaque variante (id_article 13 à 22)
INSERT INTO PRICE_HISTORY (start_date, end_date, price, id_article) VALUES
('2024-01-01', NULL, 180.00, 9),
('2024-01-01', NULL, 180.00, 10),
('2024-01-01', NULL, 180.00, 11),
('2024-01-01', NULL, 180.00, 12),
('2024-01-01', NULL, 180.00, 13),
('2024-01-01', NULL, 180.00, 14),
('2024-01-01', NULL, 180.00, 15),
('2024-01-01', NULL, 180.00, 16),
('2024-01-01', NULL, 180.00, 17),
('2024-01-01', NULL, 180.00, 18);

-- Promotion sur quelques pointures
INSERT INTO PRICE_HISTORY (start_date, end_date, price, id_article) VALUES
('2026-04-01', '2026-06-30', 149.99, 13),
('2026-04-01', '2026-06-30', 149.99, 14);

-- Types de filtres (si pas déjà présents)
-- Pointure id 4, Couleur id 2 (déjà existants dans notre script précédent)

-- Choix de pointures
INSERT INTO CHOICE_ (id_filter_type) VALUES
(4), (4), (4), (4), (4), (4), (4), (4), (4), (4);

INSERT INTO CHOICE_NUMBER (id_choice_, choice) VALUES
(11, 38),
(12, 39),
(13, 40),
(14, 41),
(15, 42),
(16, 43),
(17, 44),
(18, 45),
(19, 46),
(20, 47);

-- Choix de couleurs (rouge et blanc, coloris Chicago)
INSERT INTO CHOICE_ (id_filter_type) VALUES (2), (2);
INSERT INTO CHOICE_COLOR (id_choice_, color_choice_label, color_choice_hexa) VALUES
(21, 'Rouge', '#FF0000'),
(22, 'Blanc', '#FFFFFF');

-- Association pointure + couleur à chaque variante
INSERT INTO VALUES_ (id_article, id_choice_, id_filter_type) VALUES
(9, 11, 4), (9, 21, 2), -- Pointure 38, Rouge/Blanc
(10, 12, 4), (10, 21, 2), -- Pointure 39, Rouge/Blanc
(11, 13, 4), (11, 21, 2), -- Pointure 40, Rouge/Blanc
(12, 14, 4), (12, 21, 2), -- Pointure 41, Rouge/Blanc
(13, 15, 4), (13, 21, 2), -- Pointure 42, Rouge/Blanc
(14, 16, 4), (14, 21, 2), -- Pointure 43, Rouge/Blanc
(15, 17, 4), (15, 21, 2), -- Pointure 44, Rouge/Blanc
(16, 18, 4), (16, 21, 2), -- Pointure 45, Rouge/Blanc
(17, 19, 4), (17, 21, 2), -- Pointure 46, Rouge/Blanc
(18, 20, 4), (18, 21, 2); -- Pointure 47, Rouge/Blanc

-- Filtre pointure pour la catégorie Baskets si pas déjà présent
INSERT IGNORE INTO FILTERED_BY (id_category, id_filter_type) VALUES (5, 4);


