<?php
defined("DB_SERVER")? null : define("DB_SERVER", "127.0.0.1");
defined("DB_USER") ? null : define("DB_USER", "test");
defined("DB_PASS") ? null : define("DB_PASS", "test"); 
defined("DB_NAME") ? null : define("DB_NAME", "foodbank");

$connection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);

?>