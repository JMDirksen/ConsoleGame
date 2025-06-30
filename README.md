# Console Game

Work in progress


# Docker commands

Helpful docker commands


## Dev environment

```
docker pull php:8-apache
docker rm -f consolegame
docker run -d -p 80:80 --name consolegame -v .:/var/www --restart=always php:8-apache
```

http://localhost
