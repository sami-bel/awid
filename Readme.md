### Prerequisites

1. Télécharger et configuerer composer 
2. Installer PHP7.2, MYSQL, phpmyadmin, ...
3. Installer GIT

### Installing
###### 1. Récuperer le projet 

```
git clone https://github.com/sami-bel/awid.git
```
###### 2. Installer les vendor 

- Accéder au projet et lancer la commande suivante: 
```
composer update 
```
 ###### 3. configurer la connexion de la base de données 
 Dans le fichier .env modifier la ligne suivante en mettant le login et le mot de passe de la base de données
 
  "DATABASE_URL=mysql://root:root@127.0.0.1:3306/awid"
###### 4. créer la base de données : 
- Lancer les commandes suivants : 
```
php bin/console d:d:c
```

```
php bin/console  d:s:u --force
```
###### 5. Lancer le serveur : 
le site sera accessible sur 127.0.0.1:8000 en lançant la commande suivante :  
```
php bin/console server:run 
```




