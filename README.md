# Opening Gates International

**Tu guía confiable para encontrar empleo en Europa desde Centro y Sur América. Nos especializamos en brindar información precisa y útil sobre los procedimientos de visado y empleo en diversos países europeos.**



## Requisitos Previos

Asegúrate de tener Docker instalado en tu máquina.

- [Docker]

[https://docs.docker.com/engine/install/](https://docs.docker.com/engine/install/)



## Configuración del Entorno

1. Clona el repositorio

```bash
git clone https://github.com/dondiegorada/opengatesinternational.git
```

1. Navega al directorio del proyecto

```bash
cd opengatesinternational/
```

1. Crea el archivo de conexión DB → “**/class/db.class.php**”

```php
<?php

  class db extends mysqli {
    private $host;
    private $username;
    private $passwd;
    private $dbname;

   function __construct($host='host', $username='username', $passwd='password', $dbname='DBname') {
      $this->host = $host;
      $this->username = $username;
      $this->passwd = $passwd;
      $this->dbname = $dbname;
      parent::__construct($host, $username, $passwd, $dbname);
    }

    function getHost() {
      return $this->host;
    }

    function getUsername() {
      return $this->username;
    }

    function getPasswd() {
      return $this->passwd;
    }

    function getDbname() {
      return $this->dbname;
    }

    function setHost($host) {
      $this->host = $host;
    }

    function setUsername($username) {
      $this->username = $username;
    }

    function setPasswd($passwd) {
      $this->passwd = $passwd;
    }

    function setDbname($dbname) {
      $this->dbname = $dbname;
    }
  }
?>
```



## Levantar el Proyecto

Utiliza Docker para construir  la imagen de PHP v 8.2.7.

```bash
docker build -t oei .
```

Levanta los contenedores de MYSQL y PHP con el CLI de Docker.

```bash
# PHP
docker container run \
--name oei-web \
-dp 80:80 \
-v $(pwd):/var/www/html/app/ \
oei

#MYSQL
docker container run \
-dp 3306:3306 \
--name oei-db \
--env MARIADB_USER=johndev \
--env MARIADB_PASSWORD=ninguna \
--env MARIADB_ROOT_PASSWORD=root-secret-password \
--env MARIADB_DATABASE=oei \
mariadb:latest
```

Crea una red y agrega los contenedores.

```bash
docker network create oei-app

docker network connect oei-app [ID_CONTAINER] # ID_CONTENEDOR PHP
docker network connect oei-app [ID_CONTAINER] # ID_CONTENEDOR MYSQL

# Inspecciona la red
docker network inspect oei-app
```

Habilitar la extensión de MYSQL en el contenedor de PHP.

```bash
# Accede a el contendedor de PHP
docker exec -it [ID_CONTENEDOR] bash

# Instala extensión de MYSQL
docker-php-ext-install mysqli
```



## Acceder a la Aplicación

La aplicación esta disponible en http://localhost/app