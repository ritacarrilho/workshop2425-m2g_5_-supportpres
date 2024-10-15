# Parent Watch 
Parent Watch est une application de surveillance dédiée aux parents, leur permettant de suivre l'activité de leurs enfants sur les réseaux sociaux. L'objectif est de garantir une utilisation sécurisée des réseaux sociaux tout en aidant les parents à mieux comprendre les habitudes numériques de leurs enfants.

![](/assets/banner-logo.jpg)

## Auteurs 👥
- BILLARD Mélissa
- BRACCIALE-COMBAS Lola
- CARRILHO LAMEIRA Rita
- COURTIN Amandine

## Fonctionnalités principales
- **Surveillance des réseaux sociaux** : Suivi des plateformes populaires comme Facebook, Instagram, TikTok, etc.

- **Suivi du temps d'écran** : Mesure du temps passé sur les applications.

- **Contrôle des contenus** : Notification des contenus inappropriés ou dangereux.

- **Rapports d'activité** : Génération de rapports hebdomadaires sur l'utilisation des réseaux sociaux.

- **Gestion multi-enfants** : Possibilité de gérer plusieurs profils d'enfants avec des paramètres de surveillance individualisés.

## Technologies

- Framework [Symfony](https://symfony.com/)
- PHP 8.1 ou supérieur
- Base de données [MySQL](https://www.mysql.com/fr/)

## Modélisation de la base de donnée
![](/assets/mcd.png)
![](/assets/mld.png)
![](/assets/mld-textuel.png)

## Installation
### 1. Cloner le dépôt
```php
git clone https://github.com/votre-utilisateur/votre-projet-symfony.git
cd votre-projet-symfony
```
### 2. Installer les dépendances
```php
composer install
```
### 3. Configurer l'environnement
```php
cp .env .env.local
DATABASE_URL="mysql://user:password@127.0.0.1:3306/nom_de_votre_db"
```
### 4. Créer la base de données
```php
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
### 5. Charger les données de test 
```php
php bin/console doctrine:fixtures:load
```
### 6. Démarrer le serveur de développement
```php
symfony server:start
```
L'application sera accessible à l'adresse `http://localhost:8000`.

## Test
Ce projet utilise PHPUnit pour les tests unitaires. Pour exécuter les tests, lancez la commande suivante :
```php
php bin/phpunit
```
## Intégration continue
Le projet **Parent Watch** utilise les `GitHub Actions` pour gérer l'intégration continue et le déploiement continu. Voici un aperçu du pipeline CI/CD et de la gestion des branches :

### 1. Gestion des branches :

- Chaque développeur crée et travaille sur une **branche feature** pour développer une nouvelle fonctionnalité ou corriger un bug.
- Une fois les développements terminés, la branche feature est **merge** avec la branche **main** après validation des pull requests.
- Si les **tests automatisés** passent et que le code est conforme aux standards, le code est ensuite poussé sur la **branche release** pour la mise en production.

### 2. Workflows GitHub Actions :

- **Tests automatisés** : À chaque pull request ou commit sur les branches feature et main, les tests unitaires sont exécutés pour vérifier la stabilité du code.
- **Analyse de code** : Le code est automatiquement analysé pour vérifier les vulnérabilités potentielles et assurer le respect des bonnes pratiques de développement.

### 3. Notifications et gestion des résultats :

- **En cas de succès** : Si le pipeline CI/CD réussit, une **release note** est automatiquement créée, et une notification est envoyée dans le **support Discord** pour informer l'équipe du succès du déploiement.
![](/assets/release-note.png)
- **En cas d'échec** : Si le pipeline CI/CD échoue, une notification détaillée est envoyée dans le **support Discord** pour alerter l'équipe de l'erreur.
![](/assets/support.png)

## Déploiement
```php
// Assurez-vous que les dépendances sont installées en production 
composer install --no-dev --optimize-autoloader
// Exécutez les migrations de base de données
php bin/console doctrine:migrations:migrate --no-interaction --env=prod
// Mettez à jour le cache en production 
php bin/console cache:clear --env=prod
```



