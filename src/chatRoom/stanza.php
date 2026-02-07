<?php
session_start();
require "db.php"; 
if (!isset($_SESSION["username"])) { header("Location: login.php"); exit; }
$username = $_SESSION["username"];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["room_name"])) {
    $room_name = htmlspecialchars($_POST["room_name"]);
    try {
        $connection->begin_transaction();
        $stmt = $connection->prepare("INSERT INTO Stanze (nome, creatore) VALUES (?, ?)");
        $stmt->bind_param("ss", $room_name, $username);
        $stmt->execute();
        $stmt_p = $connection->prepare("INSERT INTO Partecipa (nome, user) VALUES (?, ?)");
        $stmt_p->bind_param("ss", $room_name, $username);
        $stmt_p->execute();
        $connection->commit();
        header("Location: stanza.php"); exit;
    } catch (Exception $e) { $connection->rollback(); $error = "Stanza già esistente."; }
}

$stmt = $connection->prepare("SELECT s.nome FROM Stanze s JOIN Partecipa p ON s.nome = p.nome WHERE p.user = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Stanze</title>
    <style>
        body { font-family: 'Inter', sans-serif; background: #0f172a; color: white; margin: 0; display: flex; height: 100vh; }
        .sidebar { width: 280px; background: #1e293b; border-right: 1px solid #334155; display: flex; flex-direction: column; }
        .sidebar-header { padding: 1.5rem; border-bottom: 1px solid #334155; font-weight: bold; }
        .list { flex-grow: 1; padding: 1rem; overflow-y: auto; }
        .room-item { display: block; padding: 0.75rem; color: #94a3b8; text-decoration: none; border-radius: 6px; margin-bottom: 0.25rem; }
        .room-item:hover { background: #334155; color: white; }
        .main { flex-grow: 1; display: flex; align-items: center; justify-content: center; }
        .create-card { background: #1e293b; padding: 2rem; border-radius: 12px; border: 1px solid #334155; width: 350px; }
        input { width: 100%; padding: 0.75rem; background: #0f172a; border: 1px solid #475569; border-radius: 6px; color: white; margin-bottom: 1rem; box-sizing: border-box; }
        button { width: 100%; padding: 0.75rem; background: #10b981; border: none; border-radius: 6px; color: white; font-weight: bold; cursor: pointer; }
        button:hover{ background-color:rgb(255, 255, 255); /* Rosso quadratino */ color: #10b981 !important; /* Scritta bianca in contrasto */}
        .logout { color: #f87171; font-size: 0.875rem; margin-top: 1rem; display: inline-block; }
        .logout { 
            color:hsl(0, 0.00%, 100.00%); 
            text-decoration: none; 
            padding: 8px 16px; 
            border-radius: 4px; 
            transition: all 0.2s ease;
            font-weight: 500;
        }
        /*hsl(215, 20.20%, 65.10%)*/
        .logout:hover { 
            background-color: #ef4444; /* Rosso quadratino */
            color: #ffffff !important; /* Scritta bianca in contrasto */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">Le tue Stanze</div>
        <div class="list">
            <?php while($row = $result->fetch_assoc()): ?>
                <a href="chat.php?stanza=<?= urlencode($row['nome']) ?>" class="room-item"># <?= htmlspecialchars($row['nome']) ?></a>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="main">
        <div class="create-card">
            <h3>Crea Nuova Stanza</h3>
            <form method="POST">
                <input type="text" name="room_name" placeholder="Nome stanza..." required>
                <button type="submit">Crea Stanza</button>
                <a href="logout.php" class="logout">LOGOUT</a>
            </form>
        </div>
    </div>
</body>

</html>


