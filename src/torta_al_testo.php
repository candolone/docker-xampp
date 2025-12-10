<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?<php>
    echo "<h1>Questa è la pagina risposta/<h1>";

    //array syoer-global (dizionario)

    $email = $_POST['email_post'];
    $password = $_POST['password_post'];
    $nome = $_POST['nome_post'];

    if($email == "ragione@lamia.sempre" && $password == "ciao" && $nome == "Ciao")
    {
        echo "LOGIN EFFETTUATA";
    }else
    {
        echo "LOGIN FALLITA";
    }


    </php>

    
</body>
</html>