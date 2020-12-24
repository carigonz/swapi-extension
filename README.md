# Swapi Vehicle Extension API

## Requirements

-   Only needs to [install Docker](https://www.docker.com/products/docker-desktop)

## Please follow this instruccion to get proyect installed locally. This instruccions were made in macOS environment.

First clone proyect.

`$ git clone https://github.com/carigonz/swapi-extension.git`

Create and copy config to .env file from .env.example

`$ touch .env`

Install dependencies via docker

`$ docker run --rm -v $(pwd):/app composer install`

Build and run project, this will take a while. Then check docker containers.

`$ docker-compose up --build `
`$ docker ps`

```
➜  swapi-extension git:(master) docker ps
CONTAINER ID   IMAGE          COMMAND                  CREATED              STATUS              PORTS                                      NAMES
2a07ba3e1c08   php_service    "docker-php-entrypoi…"   About a minute ago   Up About a minute   9000/tcp                                   app
b909d2364ac0   nginx:alpine   "/docker-entrypoint.…"   About a minute ago   Up About a minute   0.0.0.0:443->443/tcp, 0.0.0.0:88->80/tcp   webserver
c46f84af823e   mysql:5.7.22   "docker-entrypoint.s…"   About a minute ago   Up About a minute   0.0.0.0:1306->3306/tcp                     db
```

Create app key.

`$ php artisan key:generate`

Cache config for boost application’s load speed.

`$ docker-compose exec app php artisan config:cache`

Run migrations.

`$ docker-compose exec app php artisan migrate`

Now you should see land page in [http://localhost:88/](http://localhost:88/). Enjoy!

### [Swapi extension API Documentation](https://drive.google.com/file/d/16AkkX8KQnAfoHSnN72i_ZV4YSVWk-Do7/view?usp=sharing)

### [Original API Documentation](https://swapi.dev/documentation)
