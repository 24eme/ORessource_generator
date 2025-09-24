# ORessource generator

Plateforme open source de génération d'instance du logiciel ORessource pour les ressourceries

## Installation

Cloner le dépot :

```
git clone https://github.com/24eme/ORessource_generator.git
cd ORessource_generator
```

Initier le fichier config/config.php :

```
cp config/config.php{.example,}
```

Paramétrer le fichier config/config.php :

```
<?php

$config = [
  'host' => 'localhost',
  'root' => "mariadbuser",
  'root_passwd' => "mariadbpassword",
  'oressource_path' => "/future/path/to/oressource"
];
```

Pour limiter les risques il est conseillé que l'utilisateur mariadb ait juste le droit de créer une base et un utilisateur;

Cloner le projet ORessource (en dehors du projet ORessource generator )

```
cd ..
git clone https://github.com/mart1ver/oressource
```

Paramétrer le chemin vers oressource dans config/config.php :

```
  'oressource_path' => "/future/path/to/oressource" #https://github.com/mart1ver/oressource
```

Copier le fichier de conf du projet oressource

```
cp ORessource_generator/data/oressource_dbconfig.php oressource/moteur/dbconfig.php
```

Tester le projet en local :

```
cd ORessource_generator
php -S localhost:8000 -t web
```
