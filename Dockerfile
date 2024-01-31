FROM php:8.2.7-apache
RUN mkdir -p /var/www/html/app/
COPY ./ /var/www/html/app/
EXPOSE 80

# docker container run \
# -dp 8080:80 \
# --name phpmyadmin \
# --env PMA_ARBITRARY=1 \
# phpmyadmin:apache