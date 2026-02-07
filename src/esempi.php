<?php

$a = "ciao";
$b = "mondo";
echo $a . $b . "\n"; //concatenazione

$username = "nicola";
$password = "ciaociao";

$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
    //interpolazione
echo $query;
