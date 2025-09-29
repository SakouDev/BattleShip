<?php
require __DIR__ . "/includes/db_connect.php";

try {
    $db = connexion();
    echo "✅ Connexion réussie avec battleship_user";
} catch (Exception $e) {
    echo "❌ " . $e->getMessage();
}
