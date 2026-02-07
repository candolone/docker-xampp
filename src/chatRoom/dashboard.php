<?php
session_start();
if (!isset($_SESSION["user_id"])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: white; margin: 0; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .dash-container { background: #1e293b; padding: 3rem; border-radius: 16px; text-align: center; border: 1px solid #334155; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.5); }
        h1 { font-size: 2rem; margin-bottom: 0.5rem; }
        p { color: #94a3b8; margin-bottom: 2rem; }
        .btn-group { display: flex; flex-direction: column; gap: 1rem; }
        .btn { padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: bold; transition: 0.3s; }
        .primary { background: #38bdf8; color: #0f172a; }
        .primary:hover { background: #7dd3fc; transform: translateY(-2px); }
        .logout { color: #f87171; font-size: 0.875rem; margin-top: 2rem; display: inline-block; }
    </style>
</head>
<body>
    <div class="dash-container">
        <h1>Bentornato, <?= htmlspecialchars($_SESSION['username']) ?></h1>
        <p>Sistema di comunicazione attivo.</p>
        <div class="btn-group">
            <a href="stanza.php" class="btn primary">Accedi alle Stanze</a>
        </div>
        <a href="logout.php" class="logout">logout</a>
    </div>
</body>
</html>