# README

## Start up the engine

```
ddev start
```

## Setup WordPress

```
ddev wp core download --path=htdocs --locale=fr_FR
ddev wp config create --dbhost=db --dbname=db --dbuser=db --dbpass=db --locale=fr_FR
ddev wp core install --url=lesson-wp-stack-2026.ddev.site --title="WP Playground" --admin_user=admin --admin_password=admin --admin_email=lhall@amphibee.fr
```
