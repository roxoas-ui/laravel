<?php
$db = 'C:/Users/roxoa/OneDrive/PROGRAMADOR JUNIOR/NOVO CONTROLE DE LICENCAS/backend/database/database.sqlite';
if (!file_exists($db)) {
    echo "DB file not found: $db\n";
    exit(1);
}
try {
    $pdo = new PDO('sqlite:' . $db);
    $stmt = $pdo->query("SELECT id, name, email, password, created_at FROM users");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
