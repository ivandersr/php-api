API base developed without frameworks.
Run it as any other PHP project. I advise running an apache docker container extending any php-apache like the following. Clone this project into the "/projects" folder if you decided to run using this.

```
#Dockerfile
FROM php:8.4-apache

RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite

# composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
```
```
#compose.yml
services:
  php:
    build: 
      context: .
      dockerfile: Dockerfile
    ports: 
      - 80:80
    volumes:
      - ./projects:/var/www/html

  db:
    image: mysql
    ports:
      - 3306:3306
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: api
      MYSQL_USER: admin
      MYSQL_PASSWORD: admin
```
