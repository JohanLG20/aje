# Projet application web AJE

## Présentation du projet

Ceci est un projet d'application web pour une plateforme d'E-commerce fictive dans le cadre de la formation Kercode du GRETA de Vannes. L'application est centrée sur la vente de matériel de sport, que ça soit des équipements (type ballon, haltères ...) ou bien des vêtements. La structure de la base de donnée à été pensée pour être extensible au besoin.

## Liste des fonctionnalités offertes par l'application

A ce jour, l'application comprend :

- La possibilité d'ajouter, de modifier ou de supprimer un article
- L'ajout d'une promotion sur un article
- La prévisualition des performances du site, le chiffre d'affaire, le nombre d'articles vendus et le prix moyen d'un vente.
- La possibilité de créer un compte, modifier ses informations personnelles et supprimer son compte
- Une page d'accueil qui affiche dynamiquement les derniers articles entrés sur le site ainsi que les dernières promotions.
- Une fonctionnalité de recherche d'article, qui fonctionne sur les données propres aux articles (catégories, marque, nom, description, filtres ...)
- La possibilité de filtrer les résultats de la recherche en fonction des marques ou bien des catégories ainsi que le tri par ordre alphabétique ou bien par prix
- La visualisation d'un article qui présente ses informations
- Un système de panier accessible par tous et qui se sauvegarde même si un utilisateur se connecte
- Un système de paiement (accessible uniquement pour un utilisateur connecté) fictif avec un récapitulatif de la commande une fois terminé
- Un système de commentaire d'article, dont lequel un utilisateur ayant "payé" un article est autorisé à le commenter. Il peut également le modifier ou le supprimer
- Un système de modération où un administrateur est autorisé à supprimé n'importe quel commentaire contrevenant à la politique d'utilisation du site.

## Fonctionnalités prévues pour des version ultérieures

- Possibilité d'ajouter/supprimer des catégories
- Possibilité d'ajouter/retirer des filtres à des catégories
- Reformatter les urls pour les rendre SEO Friendly
- Afficher un historique des produits acheter par l'utilisateur
- Rendre la page d'acceuil éditable 
- Optimisation de l'affichage des images

## Comment installer le projet

Prérequis : Composer et un serveur web local opérationnel avec un base de données MySql ou MariaDB.

Ouvrez un terminal et lancez la commande git clone https://github.com/JohanLG20/aje.git. Celà créra un nouveau répertoire contenant les fichiers présents sur github. Rendez-vous dans le répertoire nouvellement créer et lancez la commande `composer install`. Renommez le fichier .env.exemple en .env. Créez une base de données nommée aje et importez-y les données présentent dans le fichier creationTable.sql.
Le script de création contient quelques articles pré-remplis, vous pourrez ensuite en rajouter d'autres. 

Problème connu : Lors de la sélection de la catégorie en mode administrateur, les filtres peuvent ne pas apparaître automatiquement. Dans ce cas, rendez-sur sur un gestionnaire de base de données (type phpmyadmin) et assurez-vous que le definer de la vue FILTER_VALUES_ASSOCIATIONS est un utilisateur présent dans la base de données. Si ce n'est pas le cas, vous pouvez changer le definer par votre utilisateur à vous.
