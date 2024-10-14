# workshop2425-m2g_5_-supportpres
DESCRIPTION
![](/assets/payetonkawaBanner.png)

## Participants 👥
- BILLARD Mélissa
- BRACCIALES-COMBAS Lola
- CARRILHO LAMEIRA Rita
- COURTIN Amandine

## Technologie 
- Projet en [Techno](https://fastapi.tiangolo.com/)

## Base de données
- [MySQL](https://www.mysql.com/fr/)

**Nom BDD** : ``miaumiau``

## Installation
1. Clonez ce dépôt sur votre machine locale.
2. Assurez-vous d'avoir installé PHP, Composer et Symfony sur votre machine.
3. Exécutez la commande suivante pour installer les dépendances

```php
composer install
```

4. Configurez votre base de données dans le fichier .env.
5. Exécutez les migrations pour créer les tables de la base de données :

```php
php bin/console doctrine:migrations:migrate
```

6. Lancez le serveur de développement :

```php
symfony serve
```

7. Accédez à l'application en ouvrant votre navigateur et en visitant l'URL http://127.0.0.1:8000/

## configuration 
Le fichier de configuration principal se trouve dans le répertoire **`config/`**. Vous pouvez y ajuster divers paramètres de l'application.

## Structure projet 
- **src/**: Contient le code source de l'application Symfony.
- **templates/**: Contient les fichiers de templates Twig pour l'interface utilisateur.
- **public/**: Contient les fichiers accessibles publiquement (CSS, JavaScript, images, etc.).
- **tests/**: Contient les tests unitaires et fonctionnels.
- **var/**: Contient les fichiers générés par l'application (cache, logs, etc.).