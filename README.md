# feetō 🌱

#### Envie de partager vos savoirs sur les plantes ? Ou simplement besoin d'aide pour vous occuper des vôtres ? Bienvenue sur Feetō.

![image](https://user-images.githubusercontent.com/47384185/196681754-c1a3178b-65f9-43c9-b9ed-93a6dadd395a.png)

## Utilisation

1. Création d'un compte 
2. Visualisation des plantes déjà rentrées sur le site 
3. Possibilité de laisser un avis sur une plante et de créer une plante. 
4. Visualisation globale de tous les avis qu'on a laissé sur le site. 

# Côté technique et mise en place du projet

## Pré-requis 
* PHP 8.0
* Symfony 5.2
* Composer 
* npm 

## Installation des bundles nécessaires
* ``composer install`` pour la première utilisation
* ``composer update``

### Yarn 

Si vous possédez déjà Yarn vous pouvez directement faire : 
``yarn install`` pour installer les packages requis. 

Sinon : 
``npm install --global yarn``
``yarn install``

#### Pour actualiser les scripts et feuilles de styles modifiées depuis */assets* :
``yarn encore dev``

⚠️ N'oubliez pas de créeer un *.env.local* pour lancer le projet 

## Mise en place de la base de données 

### Migration 

Nous avons mis en place des fichiers de migrations que vous pouvez exécuter à l'aide de la commande : 
``php bin/console doctrine:migrations:migrate``

### Importer les fixtures 

Afin de partir d'une bases de données pré-remplie, vous pouvez exécuter la commande suivante pour déclencher les fixtures : 
``php bin/console doctrine:fixtures:load``
