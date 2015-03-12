
# Mock LDAP

This is a mock server that mimics the European Commission LDAP service.

The EC LDAP service provides the functionality to retrieve information about an
EC email address. It returns if the email address exists and some extra info
like the country the user is located in and the department he/she is working in.


## Installation

This mock server is build using the [Silex](http://silex.sensiolabs.org/) mini 
framework.


### Requirements

* Apache, Nginx, … (a web server that supports PHP).
* PHP 5.4 or higher.
* [composer](http://getcomposer.org/).


### Install required libraries

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


### Create an Apache vhost

The server is hosted over http. You can use Apache (or another web server that 
supports PHP).

Create a new virtual host (vhost) that points to the `web` directory within 
this repository. 
