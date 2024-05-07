<?php
// CONNEXION À LA BASE DE DONNÉES AVEC PDO
include 'header.php';

$id_chambre=$_GET['id'];
$date_debut=$_GET['date_debut'];
$date_fin=$_GET['date_fin'];

$query="SELECT * FROM chambre WHERE idchambre=:id_chambre";
$statement=$pdo->prepare($query);
$statement->bindValue(':id_chambre', $id_chambre, \PDO::PARAM_INT);
$statement->execute();
$chambre= $statement->fetch();

$query="SELECT * FROM image WHERE chambre_idchambre=:id_chambre";
$statement=$pdo->prepare($query);
$statement->bindValue(':id_chambre', $id_chambre, \PDO::PARAM_INT);
$statement->execute();
$images= $statement->fetchAll();

//requette nom de hotel
$id_hotel=$chambre['hotel_idhotel'];
$statement1=$pdo->query("select * from hotel where idhotel='$id_hotel'");
//type de chambre
$id_type=$chambre['type_idtype'];
$statement2=$pdo->query("select name from type where idtype='$id_type'");
   //Recupere
$hotel=$statement1->fetch(PDO::FETCH_ASSOC);
$type=$statement2->fetch(PDO::FETCH_ASSOC);

?>
<div>
    <h3><?=$hotel['name'] ?></h3>
</div>
<div class="row row-cols-1 row-cols-md-4 g-4">
    
<?php
foreach($images as $image){ ?>
    <div class="col">
        <img src="<?=$image['name']?>" alt="<?=$image['name']?>" class="card-img-top" alt="...">
    </div>
<?php
}

?>
</div>
<div class="card-body">
    <h3>Chambre <?=$chambre['name']?> de type: <?=$type['name']?></h3>
    <p>Situé dans le 12ème arrondissement de Paris, le Grand Hotel Dore comporte une réception ouverte 24h/24.<br> Il vous accueille à 1,4 km de la salle AccorHotels Arena, à 2 km de la gare de Lyon et à 15 minutes à pied de la place de la Bastille.<br> La connexion Wi-Fi est disponible gratuitement.</p>
    <p class="card-text">(superficie: <?=$chambre['superficie'] ?> m2, prix: <?=$chambre['prix'] ?> $)</p>
    <p class="card-text">(Nombre d'enfant autorisé: <?=$chambre['nombre_enfant'] ?> , Nombre d'adulte autorisé: <?=$chambre['nombre_adulte'] ?> )</p>
    <a href="panier.php?id=<?=$id_chambre?>&amp;date_debut=<?=$date_debut?>&amp;date_fin=<?=$date_fin?>" class="btn btn-primary" >ajouter au panier</a>
</div>