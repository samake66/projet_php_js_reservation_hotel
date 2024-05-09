<?php

include "header.php";

@$email=$_SESSION['login'];

  //requette
  $query="SELECT * FROM chambre";

  $statement=$pdo->prepare($query);
  $statement->setFetchMode(PDO::FETCH_ASSOC);
  $statement->execute();
  $chambres=$statement->fetchAll();
  ?>

  <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php
      foreach($chambres as $list_chambre){

        $id_chambre=$list_chambre['idchambre'];
        //requette nom de hotel
        $id_hotel=$list_chambre['hotel_idhotel'];
        $statement1=$pdo->query("select * from hotel where idhotel='$id_hotel'");
        //type de chambre
        $id_type=$list_chambre['type_idtype'];
        $statement2=$pdo->query("select name from type where idtype='$id_type'");
        //image de la chambre
        $query="SELECT * FROM image as i
          WHERE i.chambre_idchambre=$id_chambre ";
        $statement3=$pdo->query($query);


        //Recupere
        $hotel=$statement1->fetch(PDO::FETCH_ASSOC);
        $type=$statement2->fetch(PDO::FETCH_ASSOC);
        $image=$statement3->fetch(PDO::FETCH_ASSOC);
        ?>

      <div class="col">
        <h2>Hôtel: <?=$hotel['name']?></h2>
        <img src="<?=$image['name']?>" alt="<?=$image['name']?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h4>chambre <?=$list_chambre['name']?> de type: <?=$type['name']?></h4>
          <p class="card-text">(superficie: <?=$list_chambre['superficie'] ?>, prix: <?=$list_chambre['prix'] ?> $)</p>
          <a href="details.php?id=<?=$list_chambre['idchambre']?>" class="btn btn-primary" >voir l'ofrre</a>
          <?php
          if(isset($_SESSION['login_admin'])){ ?>
            <a href="supprimer_chambre.php?id=<?=$list_chambre['idchambre']?>" class="btn btn-primary">Supprimer</a>

        <?php
        } ?>
        </div>
      </div>
        <?php
      }?>
      
      </div>