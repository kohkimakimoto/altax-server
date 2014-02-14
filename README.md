# Altax server plugin

[![Build Status](https://travis-ci.org/kohkimakimoto/altax-server.png?branch=master)](https://travis-ci.org/kohkimakimoto/altax-server)

Running php built-in web server via [altax](https://github.com/kohkimakimoto/altax).

> Note: It runs with altax version 3 which is in development stage. You shouldn't use it yet.

## Installation

Edit your `.altax/composer.json` file like the following

    {
      "require": {
        "kohkimakimoto/altax-server": "dev-master"
      }
    }

Run composer update 

    $ cd .altax
    $ composer update

Add the following line your `.altax/config.php` file.

    Task::register('server', 'Altax\Contrib\Server\Command\ServerCommand');

## Usage

Run the task command

    $ altax server [-H|--host[="..."]] [-p|--port[="..."]] [-t|--docroot[="..."]] [script]

## Configuration

Example:

```php
Task::register('server', 'Altax\Contrib\Server\Command\ServerCommand')
->config(array(
    "host" => "localhost",
    "port" => 1234,
    "docroot" => "/path/to/document/root",
    "script" => "/path/to/router/script.php",
    ));
```

### host

The host address of the server.

### port

The port of the server.

### docroot

The document root of the server.

### script

Router script of the server.

## See also

* [PHP: Built-in web server - Manual ](http://www.php.net/manual/en/features.commandline.webserver.php)
* [altax](https://github.com/kohkimakimoto/altax)



