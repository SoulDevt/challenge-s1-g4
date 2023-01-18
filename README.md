# Semaine de Challenge S1: Groupe 4 

## Membres du groupe:
- Nikola PANIC
- Souleymane GUEYE
- Sacha FRANCISCO-LEBLANC
- Mehdi SABER

## Installation

```bash
docker compose build --pull --no-cache
docker compose up -d
docker compose exec php sh -c '
    set -e
    apk add openssl
    php bin/console lexik:jwt:generate-keypair
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
'
```
ff
