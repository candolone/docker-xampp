<?php
session_start();
require "db.php"; 
if (!isset($_SESSION["username"]) || !isset($_GET['stanza'])) { header("Location: login.php"); exit; }
$username = $_SESSION["username"];
$stanza = $_GET['stanza'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['testo'])) {
    $t = htmlspecialchars($_POST['testo']);
    $stmt = $connection->prepare("INSERT INTO Messaggi (testo, nomeStanza, user) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $t, $stanza, $username);
    $stmt->execute();
    header("Location: chat.php?stanza=".urlencode($stanza)); exit;
}

$stmt = $connection->prepare("SELECT user, testo, data FROM Messaggi WHERE nomeStanza = ? ORDER BY data ASC");
$stmt->bind_param("s", $stanza);
$stmt->execute();
$messaggi = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">    <title>Chat: <?= htmlspecialchars($stanza) ?></title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: white; margin: 0; display: flex; flex-direction: column; height: 100vh; }
        header { background: #1e293b; padding: 0 2rem; border-bottom: 1px solid #334155; display: flex; align-items: center; justify-content: space-between; height: 60px; }
        .chat-area { flex-grow: 1; padding: 2rem; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem; }
        .msg { max-width: 70%; padding: 0.75rem 1rem; border-radius: 8px; position: relative; }
        .msg.mine { align-self: flex-end; background: #38bdf8; color: #0f172a; }
        .msg.others { align-self: flex-start; background: #334155; color: white; }
        .sender { font-size: 0.75rem; font-weight: bold; margin-bottom: 0.1rem; opacity: 0.9; }
        .timestamp { font-size: 0.65rem; opacity: 0.6; margin-bottom: 0.4rem; display: block; }
        .input-bar { background: #1e293b; padding: 1.5rem; border-top: 1px solid #334155; display: flex; gap: 1rem; }
        input { flex-grow: 1; padding: 0.75rem; background: #0f172a; border: 1px solid #334155; border-radius: 6px; color: white; }
        button { background: #38bdf8; border: none; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: bold; cursor: pointer; }
        button:hover{ background-color:rgb(255, 255, 255); /* Rosso quadratino */ color: #38bdf8 !important; /* Scritta bianca in contrasto */}

        /* MODIFICA TASTO ESCI */
        .btn-esci { 
            color: #94a3b8; 
            text-decoration: none; 
            padding: 8px 16px; 
            border-radius: 4px; 
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        .btn-esci:hover { 
            background-color: #ef4444; /* Rosso quadratino */
            color: #ffffff !important; /* Scritta bianca in contrasto */
        }
    </style>
</head>
<body>
    <header>
        <span>Stanza: <strong>#<?= htmlspecialchars($stanza) ?></strong></span>
        <a href="stanza.php" class="btn-esci">Esci</a>
    </header>
    <div class="chat-area">
        <?php while($m = $messaggi->fetch_assoc()): ?>
            <div class="msg <?= ($m['user'] === $username) ? 'mine' : 'others' ?>">
                <div class="sender"><?= htmlspecialchars($m['user']) ?></div>
                <span class="timestamp"><?= date("d/m/Y H:i", strtotime($m['data'])) ?></span>
                <div><?= htmlspecialchars($m['testo']) ?></div>
            </div>
        <?php endwhile; ?>
    </div>
    <form class="input-bar" method="POST">
        <input type="text" name="testo" placeholder="Scrivi un messaggio..." required autocomplete="off">
        <button type="submit">Invia</button>
    </form>
</body>
</html>