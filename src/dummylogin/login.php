<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
</head>
<body>
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

        $email = htmlspecialchars($_POST['email_post']); //email_post è la chiave del nostro array
        $password = htmlspecialchars($_POST['password_post']);
        $nome = $_POST['nome_post'];

        $stmt = $connection->prepare("SELECT * FROM User WHERE email = ? AND password = ?");

        $stmt->bind_param("ss", $email, $password); //sostituisce rispetto all'ordine della query passandogli il tipo di dato s -> stringa 
        // e il valore della variabile

        $stmt->execute(); //esegue la query

        $result = $stmt->get_result();

        if ($result->num_rows > 0) 
        {   
            echo "utente trovato" . "<br>"; 
            if($email == 'anna.moretti@example.com')
            {
                $query = "SELECT * FROM User";
                $result = $connection->query($query);
                echo "La tabella user contiene le seguenti righe $result->num_rows:<br>";
                echo "<table>";

                while($row = $result->fetch_assoc()) //anche non essendoci nessun controllo smette l'esecuzione quando fetch_assoc ritorna null
                {
                    echo "<tr>";
                    echo "<td>". $row['nome'] . "</td>";
                    echo "<td>". $row['email'] . "</td>";
                    echo "<td>". $row['password'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";


            }
        }
        else
        {
            echo "utente non trovato";
        }

        $connection->close();
    ?>
</body>
</html>