# Semaine de Challenge S1: Groupe 4 

## Membres du groupe:
- Nikola PANIC
- Souleymane GUEYE
- Sacha FRANCISCO-LEBLANC
- Mehdi SABER

## Installation

Créez un fichier `.env` puis mettez-y les deux valeurs suivantes:

```
STRIPE_PUBLIC_KEY=""
STRIPE_SECRET_KEY=""
```

Puis exécutez en local:

```bash
docker compose build --pull --no-cache
docker compose up -d
```

Informations pour la bdd

```bash
adminer : PostgreSQL
mot de passe : voir docker
bd: app
server: database
```


## Fixture
```bash
docker compose exec php bin/console d:d:d
docker compose exec php bin/console d:d:c
docker-compose exec php bin/console make:migration  
docker-compose exec php bin/console doctrine:migrations:migrate
docker compose exec php bin/console d:f:l
```

