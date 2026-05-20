<?php
// Autoriser l'application HTML à envoyer des données
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Sécurité basique : on vérifie que la méthode est bien du POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le contenu JSON envoyé par le mode Admin
    $donneesrecues = file_get_contents('php://input');
    
    if ($donneesrecues) {
        // Écrire (et remplacer) le contenu dans tournoi_data.txt
        if (file_put_contents('tournoi_data.txt', $donneesrecues) !== false) {
            echo json_encode(["status" => "success", "message" => "Fichier mis à jour sur le serveur !"]);
            exit;
        }
    }
}

http_response_code(400);
echo json_encode(["status" => "error", "message" => "Impossible de sauvegarder."]);
?>