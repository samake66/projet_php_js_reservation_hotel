<?php include 'header.php'; ?>

<div class="container">
    <?php
    // Vérifier si l'ID de l'hôtel est passé en paramètre
    if(isset($_GET['id'])) {
        $hotel_id = $_GET['id'];
        
        // Requête SQL pour récupérer les informations sur les chambres de l'hôtel spécifié
        $sql = "SELECT c.*, i.name AS image_name, h.name AS hotel_name
                FROM chambre c
                INNER JOIN image i ON c.idchambre = i.chambre_idchambre
                INNER JOIN hotel h ON c.hotel_idhotel = h.idhotel
                WHERE c.hotel_idhotel = :hotel_id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['hotel_id' => $hotel_id]);
        
        // Tableau associatif pour stocker les informations sur chaque chambre
        $chambres = [];
        
        // Parcourir les résultats de la requête
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Créer un tableau pour chaque chambre avec ses informations propres
            $chambre_info = [
                'name' => $row['name'],
                'superficie' => $row['superficie'],
                'prix' => $row['prix'],
                'images' => [$row['image_name']], // Stocker les images dans un tableau
                'hotel_name' => $row['hotel_name']
            ];
            
            // Vérifier si la chambre existe déjà dans le tableau
            if (array_key_exists($row['idchambre'], $chambres)) {
                // Ajouter les informations de l'image à la chambre existante
                $chambres[$row['idchambre']]['images'][] = $row['image_name'];
            } else {
                // Ajouter la chambre au tableau
                $chambres[$row['idchambre']] = $chambre_info;
            }
        }
        
        // Afficher les informations sur chaque chambre
        echo "<h1 class='mt-5'>Chambres de l'hôtel {$chambres[array_key_first($chambres)]['hotel_name']}</h1>";
        foreach ($chambres as $chambre) {
            echo "<div class='card my-3'>";
            echo "<div class='card-body'>";
            echo "<h2 class='card-title'>Chambre: {$chambre['name']}</h2>";
            echo "<p class='card-text'><strong>Superficie:</strong> {$chambre['superficie']} m²</p>";
            echo "<p class='card-text'><strong>Prix:</strong> {$chambre['prix']} €</p>";
            echo "<p class='card-text'><strong>Images:</strong></p>";
            echo "<div class='row'>";
            foreach ($chambre['images'] as $image) {
                echo "<div class='col-md-4'>";
                echo "<img src='$image' alt='{$chambre['name']}' class='img-fluid mb-2'>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>Aucun ID d'hôtel spécifié.</p>";
    }
    ?>
</div>
