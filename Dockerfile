FROM php:apache
RUN mkdir -p /var/www/html/app/
COPY ./ /var/www/html/app/
EXPOSE 80

# docker build -t oei .
# docker run --name oei-web -dp 80:80 -v $(pwd):/var/www/html/app/ oei

# docker container run \
# -dp 3306:3306 \
# --name oei-db \
# --env MARIADB_USER=johndev \
# --env MARIADB_PASSWORD=ninguna \
# --env MARIADB_ROOT_PASSWORD=root-secret-password \
# --env MARIADB_DATABASE=oei \
# mariadb:latest


# docker container run \
# -dp 8080:80 \
# --name phpmyadmin \
# --env PMA_ARBITRARY=1 \
# phpmyadmin:apache

# docker network create oei-app
# docker network connect oei-app [ID_CONTAINER]
# docker network inspect