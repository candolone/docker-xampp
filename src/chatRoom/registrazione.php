<?php
require "db.php"; 
$messaggio = ""; $tipo = ""; 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username']; $password = $_POST['password'];
    $stmt = $connection->prepare("SELECT user FROM Utenti WHERE user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        $messaggio = "Username già occupato."; $tipo = "error";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("INSERT INTO Utenti (user, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hash);
        if ($stmt->execute()) { $messaggio = "Account creato!"; $tipo = "success"; }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione | TechConnect</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f1f5f9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #1e293b; padding: 2.5rem; border-radius: 12px; border: 1px solid #334155; width: 100%; max-width: 400px; }
        h2 { text-align: center; margin-bottom: 1.5rem; }
        input { width: 100%; padding: 0.75rem; margin-bottom: 1rem; background: #0f172a; border: 1px solid #334155; border-radius: 6px; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 0.75rem; background: #6366f1; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer; }
        button:hover { background: #818cf8; }
        .msg { padding: 0.75rem; border-radius: 6px; margin-bottom: 1rem; text-align: center; }
        .error { background: rgba(248, 113, 113, 0.1); color: #f87171; }
        .success { background: rgba(52, 211, 153, 0.1); color: #34d399; }
        a { color: #6366f1; text-decoration: none; display: block; text-align: center; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Nuovo Account</h2>
        <?php if($messaggio): ?><div class="msg <?= $tipo ?>"><?= $messaggio ?></div><?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Scegli Username" required>
            <input type="password" name="password" placeholder="Scegli Password" required>
            <button type="submit">Crea Account</button>
        </form>
        <a href="login.php">Torna al login</a>
    </div>
</body>
</html>