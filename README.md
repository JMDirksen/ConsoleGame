# Console Game

Work in progress


# Docker commands

Helpful docker commands


## Dev environment

```
docker rm -f consolegame
docker run -d -p 80:80 --name consolegame -v .:/var/www php:8-apache
```

http://localhost
