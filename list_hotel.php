<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php

$statement = $pdo->query("select * from hotel");

$hotels = $statement->fetchAll(PDO::FETCH_ASSOC);


?>


<h1>Liste d'hotel </h1>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <?php

        foreach ($hotels as $hotel) { ?>
        
      <div class="col">
        <h2>Hôtel: <?=$hotel['name']?></h2>
        <img src="<?=$hotel['image']?>" alt="<?=$hotel['image']?>" class="card-img-top" alt="...">
        <div class="card-body">
          <p class="card-text"><?=$hotel['adresse']?></p>
          <a href="nos_chambre.php?id=<?=$hotel['idhotel']?>" class="btn btn-primary" >Voir nos chambres</a>
        </div>
      </div>
        <?php
        } ?>
    </div>