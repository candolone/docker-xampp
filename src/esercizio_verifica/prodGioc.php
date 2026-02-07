<?php

    session_start();
    
    if (isset($_SESSION['auth']) && $_SESSION['auth'] && $_POST['nomeGiocattolo'] && $_POST['nomeElfo']) 
    {
        $host = 'db'; 
        $dbname = 'babbonatale'; 
        $user = 'user';
        $password = 'user';
        $port = 3306;
        
        $connection = new mysqli($host, $user, $password, $dbname, $port);
        
        if ($connection->connect_error) {
            die("Errore di connessione: " . $connection->connect_error);
        }

        $nomeGiocattolo = $_POST['nomeGiocattolo'];
        $nomeElfo = $_POST['nomeElfo']; 

        $query = "INSERT INTO `giocattoli` (`nomeGiocattolo`, `nomeElfo`) VALUES ('$nomeGiocattolo', '$nomeElfo')";

        $results = $connection->query($query);

        if ($connection -> affected_rows > 0) 
        {
            echo "Giocattolo inserito correttamente";
        }

        echo '<br>';
        
        echo '<a href="dashboard.php">Torna al dashboard</a>';
        $connection->close();
    
    }

    

        

