<?php
require_once 'connec.php';
// CONNEXION À LA BASE DE DONNÉES AVEC PDO

if(isset($_SESSION['id'])){
    header('Location:accueil.php');
    exit;
}


if(!empty($_POST)){
    extract($_POST);

    $valid = (boolean) true;

    if(isset($_POST['inscription'])){
        $name = trim($name);
        $email = trim($email);
        $confmail = trim($confmail);
        $password = trim($password);
        $confpassword = trim($confpassword);

        if(empty($name)){
            $valid = false;
            $err_name = "Ce champ ne peut pas etre vide";
        }else{
            $stmt = $pdo->prepare("SELECT *
                   FROM client
                   WHERE name =?");

             $stmt->execute(array($idclient));

            $idclient = $stmt->fetch();

            if(isset($name['id'])){
                $valid = false;
                $err_name = "Ce nom est déja pris";
            }
        }
        if(empty($email)){
            $valid = false;
            $err_email = "Ce champ ne peut pas etre vide";
        }elseif($email <> $confmail){
            $valid = false;
            $err_email = "Le email est différent de la confirmation";
           
        }else{
            $stmt = $pdo->prepare("SELECT *
                   FROM client 
                   WHERE email =?");

            $stmt->execute(array($email));

            $stmt = $stmt->fetch();

            if(isset($stmt['id'])){
                $valid = false;
                $err_email = "Ce nom est déja pris";
            }
        } 
        
        if(empty($password)){
            $valid = false;
            $err_password = "Ce champ ne peut pas etre vide";
        }elseif($password <> $confpassword){
            $valid = false;
            $err_password = "Le mot de passe est différent de la confirmation";
        }

        if($valid){

            $cryto_password = crypt($password, 'J2ihDv8vVf7QZ9BsaRrKyqs2tkn55Yq');

            $statement=$pdo->prepare("INSERT INTO `client` (`name`, `email`, `password`) VALUES (:name, :email,:password)");
            $statement->bindValue(':name', $name, \PDO::PARAM_STR);
            $statement->bindValue(':email', $email, \PDO::PARAM_STR);
            $statement->bindValue(':password', $password, \PDO::PARAM_STR);
            $statement->execute();

            header("location:form_connexion.php?<= $email?>");
        }
    }

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Inscription</h1>
                <form method="post">
                    <div class="mb-3">
                        <?php if(isset($err_name)){ echo '<div>' . $err_name . '</div>'; }?>
                        <label class="form-label">Nom</label>
                        <input class="form-control" type="text" name="name" value="<?php if(isset($name)){ echo $name; }?>" placeholder="Nom">
                    </div>
                    <div class="mb-3">
                    <?php if(isset($err_email)){ echo '<div>' . $err_email . '</div>'; }?>
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" value="<?php if(isset($email)){ echo $email; }?>" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmation du mail</label>
                        <input class="form-control" type="email" name="confmail" value="<?php if(isset($confmail)){ echo $confmail; }?>" placeholder="Confirmation mail">
                    </div>
                    <div class="mb-3">
                    <?php if(isset($err_password)){ echo '<div>' . $err_password . '</div>'; }?>
                        <label class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="password" value="<?php if(isset($password)){ echo $password; }?>" placeholder="Mot de passe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmation du mot de passe</label>
                        <input class="form-control" type="password" name="confpassword" value="" placeholder="Confirmation du mot de passe">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="inscription" class="btn btn-primary">Inscription</button>
                    </div>
                </form>
            </div>
         </div> 
    </div>
</body>
</html>

