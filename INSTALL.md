# Installation

This mock server is build using the [Silex](http://silex.sensiolabs.org/) PHP
micro framework.


## Requirements

* Apache, Nginx, … (a web server that supports PHP).
* PHP 5.4 or higher.
* [composer](http://getcomposer.org/).


## Install required libraries

You need [composer](http://getcomposer.org/) to install required libraries.

Open the root directory of this repository and run (if you installed composer 
globally):

```
$ composer install
```

You can also download composer as a phar file into the root of the project and
install the required libraries:

```
$ curl -sS https://getcomposer.org/installer | php
$ composer.phar install
```


## Create an Apache vhost

The server is hosted over http. You can use Apache (or another web server that 
supports PHP).

Create a new virtual host (vhost) that points to the `web` directory within 
this repository. 

Make sure that `mod_rewrite` is enabled and overrides are allowed:

```
  AllowOverride All 
```

See the (Silex documentation)[http://silex.sensiolabs.org/doc/web_servers.html] 
how to setup a vhost for Apache, Nginx, IIS or Lighttpd.
