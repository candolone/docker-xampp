<?php
session_start();
require "db.php"; 
$errore = ""; 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) 
{
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];
    $stmt = $connection->prepare("SELECT id, user, password FROM Utenti WHERE user = ?");
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) 
    {
        $row = $result->fetch_assoc();
        if (password_verify($password_input, $row['password'])) 
        {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['user'];
            header("Location: dashboard.php");
            exit;
        } else { $errore = "Password errata!"; }
    } else { $errore = "Utente non trovato!"; }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login | TechConnect</title>
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; background-color: #0f172a; color: #f1f5f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #1e293b; padding: 2.5rem; border-radius: 12px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); width: 100%; max-width: 400px; border: 1px solid #334155; }
        h2 { margin-top: 0; color: #f8fafc; text-align: center; }
        label { display: block; margin-bottom: 0.5rem; font-size: 0.875rem; color: #94a3b8; }
        input { width: 100%; padding: 0.75rem; margin-bottom: 1.25rem; background: #0f172a; border: 1px solid #334155; border-radius: 6px; color: white; box-sizing: border-box; transition: border 0.3s; }
        input:focus { outline: none; border-color: #38bdf8; }
        button { width: 100%; padding: 0.75rem; background: #38bdf8; color: #0f172a; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        button:hover { background: #7dd3fc; }
        .error { color: #f87171; background: rgba(248, 113, 113, 0.1); padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center; font-size: 0.875rem; }
        .footer { text-align: center; margin-top: 1.5rem; font-size: 0.875rem; }
        a { color: #38bdf8; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Accedi</h2>
        <?php if($errore): ?><div class="error"><?= $errore ?></div><?php endif; ?>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Entra nel sistema</button>
        </form>
        <div class="footer">Non hai un account? <a href="registrazione.php">Registrati</a></div>
    </div>
</body>
</html>