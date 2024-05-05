<?php
include "connec.php";
session_start();

//les types
$query="SELECT * FROM type ";

  $statement=$pdo->prepare($query);
  $statement->setFetchMode(PDO::FETCH_ASSOC);
  $statement->execute();
  $types=$statement->fetchAll();

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <img class="img_nav" src="image/vip_hotel.jpeg" alt="">
    <a class="navbar-brand" href="accueil.php">HOME</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
          <a class="nav-link active" href="list_hotel.php"><i class="fa-sharp fa-regular fa-hotel"></i> Hotel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="list_chambre.php"><i class="fa-solid fa-bed"></i> Chambre</a>
        </li>
       
 
      </ul> 
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <?php
      if(isset($_SESSION['login'])){ ?>
        <button class="btn btn-outline-info"  type="button">
          <a href="deconnexion.php">Deconnexion</a>
        </button>
        <div>
          
          <p><i class="fa-solid fa-user"></i>Votre compte <br><?= $_SESSION['login']?></p>
        </div>
      </div>
    <?php
      } else{?>
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
       <button class="btn btn-outline-info"  type="button">
          <a href="form_connexion.php">Connexion</a>
        </button>
        <button class="btn btn-outline-info"  type="button">
          <a href="inscription.php">Inscription</a>
        </button>
      </div>
      <?php } ?>
    </div>
  </div>
</nav>
<div>
    <h1 class="grand_titre">Trouvez votre prochain séjour</h1>
    <h4>Recherchez des offres sur des hôtels, des hébergements indépendants et plus encore</h4>
</div>



<form class="row gx-3 gy-2 align-items-center" id="myForm" role="search" action="recherche.php" method="post">
  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputName">Ville</label>
    <input type="search" required="required" name="ville"  class="form-control" id="specificSizeInputName" placeholder="Ville ou code postal">
  </div>
  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername">date debut</label>
    <div class="input-group">
      <input type="date" name="date_debut" required="required" class="form-control" id="specificSizeInputGroupUsername" placeholder="Username">
    </div>
  </div>
  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername">date fin</label>
    <div class="input-group">
      <input type="date" name="date_fin" required="required" class="form-control" id="specificSizeInputGroupUsername" placeholder="Username">
    </div>
  </div>
  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeSelect">Preference</label>
    <select name="type" required="required" class="form-select" id="specificSizeSelect">
      <option selected>Choisissez un type</option> 
      <?php
      foreach($types as $type){ ?>
        <option value="<?=$type['idtype'] ?>"><?=$type['name'] ?></option>
      <?php
      }
      ?>
    </select>
  </div>
 
  <div class="btn btn-primary">
    <button type="submit" name="search" class="btn btn-primary">Search</button>
  </div>
</form>
<div>

</div>