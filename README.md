# Altax server plugin

[![Build Status](https://travis-ci.org/kohkimakimoto/altax-server.png?branch=master)](https://travis-ci.org/kohkimakimoto/altax-server)

Running php built-in web server via [altax](https://github.com/kohkimakimoto/altax).

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

Edit your `.altax/config.php` file like the following 

    Task::register("server", "Altax\\Command\\ServerCommand");

Run the server task command

    $ altax server

## Usage

    $ altax server [-H|--host[="..."]] [-p|--port[="..."]] [-t|--docroot[="..."]] [script]

## Configuration

Exsample:

    Task::register("server", "Altax\\Command\\ServerCommand")
    ->config(array(
        "host" => "localhost",
        "port" => 1234,
        "docroot" => "/path/to/document/root",
        "script" => "/path/to/router/script.php",
        ));

### host

The host address of the server.

### port

The port of the server.

### docroot

The document root of the server.

### script

Router script of the server.

