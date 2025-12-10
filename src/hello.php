<h1> Hello world! </h1>

<?php

$host = 'db'; 
$dbname = 'root_db'; 
$user = 'user';
$password = 'user';
$port = 3306;

$connection = new mysqli($host, $user, $password, $dbname, $port);

if ($connection->connect_error) {
    die("Errore di connessione: " . $connection->connect_error);
}

echo "Connessione al database riuscita con mysqli! <br>";

$email = "nicola@ciao.it";
$password = "ciaociao";

$query = "SELECT * FROM User WHERE email = '$email' AND password = '$password'";

echo $query;
echo "<br>";

//$connection->query($query);

$result = $connection->query($query);

//var_dump($result);
if($result -> num_rows > 0){
    echo "Login effettuato con successo! <br> <br>";
}else{
    echo "Login fallito! <br>";
}


$connection->close();

?>

Prova!