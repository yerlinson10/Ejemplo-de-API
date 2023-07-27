<?php
require 'flight/Flight.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=api','root',''));

Flight::route('/', function () {
    echo 'hello world!';
});

Flight::start();
