# firmstep

## Assumptions

This guide assumes that [composer](https://getcomposer.org/) is installed in $PATH  
and Docker is installed, for further details, click [docker.com](https://www.docker.com/)

## Dependencies

The version of PHPUnit requires [PHP](http://www.php.net) 5.3.2 or above (at least 5.3.4 recommended to avoid potential bugs)

## Installation

1. Clone the repository

    ```shell
    $ git clone https://github.com/ankermarco/firmstep.git
    ```

2. Install the dependencies

    ```shell
    $ cd htdocs
    $ composer install -o --no-dev
    ```

3. Running docker-compose under docker folder to bootstrap the dev environment  
 ```shell
 $ cd ../docker
 $ docker-compose up -d
 ```
 
4. Add host entry to /etc/hosts file on Ubuntu, for windows, please click [here](https://support.rackspace.com/how-to/modify-your-hosts-file/)
```shell
$ sudo vim /etc/hosts
add "192.168.99.100 firmstep.local"
```

Run database migration and seeding the service table
```shell
$ cd htdocs
$ php artisan migrate
$ php artisan db:seed
```

Open your faviour browser and goto http://firmtest.local

### Unit Testing
There are unit tests included which use PHPUnit, they can be run with the following
```
php vendor/bin/phpunit
```

### Coding standard
The code is written to follow [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) standards, this can be tested using PHP_CodeSniffer  
```
php vendor/bin/phpcs --standard=PSR2 app/models/CustomerQueue.php
```
