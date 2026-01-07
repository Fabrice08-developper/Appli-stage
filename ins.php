<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<style>
    button{
        background: linear-gradient(to right, #031c3e, #9ad7e8) !important;
        text-transform: capitalize !important;
        width: 100% !important;
        height: 4rem !important;
        border-radius: 5px !important;
        margin-top: 1rem !important;
    }
    button:hover {
        transform: translateY(-2px);
    }
    button:active {
        transform: translateY(0);
        background-color: #031c3e;
    }
    .col-auto.mb-5 {
        background: url(images/OIP.webp) no-repeat center center/cover !important;
        padding: 20px !important;
        text-align: center !important;
        max-width: 40rem !important;
        height:  auto !important;
        box-shadow: 5px 4px 3px rgba(0, 0, 0, 0.2) !important;
        justify-content: center !important;
        margin: auto !important;
        margin-top: 5rem !important;
        border-radius: 10px !important;
    }
    body{
        background: linear-gradient(to right, #031c3e, #9ad7e8) !important;
    }
</style>
<body>
    <div class="container-fluid">
        <div class="col-auto mb-5">
            <form method="POST" action="">
                <h1>Inscription</h1>
                <div class="form-floating">
                    <input type="text" name="nom" class="form-control" id="floatingInputName" class="form-control" placeholder="Nom Complet" required>
                    <label for="floatingInputName"><i class="fas fa-user"></i> Nom Complet</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput"><i class="fas fa-at"></i> Adresse Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="pwd" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword"><i class="fas fa-lock"></i> Mot de passe</label>
                </div>
                <div class="form-floating">
                    <input type="date" class="form-control" name="date" id="floatingAge" placeholder="Date naissance" required>
                    <label for="floatingAge"><i class="fas fa-calendar"></i>Date de naissance</label>
                </div>
                <div class="col-auto">
                    <button type="submit"  style="text-decoration: none !important;">S'inscrire</button>
                </div>
                
            </form>
            <p>Déjà inscrit ? <a href="Login.php">Se connecter</a></p>
        </div>
    </div>

    
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>
<?php
    include('connexion.php');
    session_start(); 
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
    $date = isset($_POST['date']) ? $_POST['date'] : null;

    $hash = password_hash($pwd, PASSWORD_DEFAULT);
    $pwd = $hash;
    if($nom && $email && $pwd && $date){
        $req="INSERT INTO client(ID, NOM_CLIENT, EMAIL, PASS, DATE_NAISSANCE)
                VALUES (:id, :nom, :email, :pass, :date_naiss)";
        $stmt = $monPDO->prepare($req);
        $stmt->execute([
                ':id' => rand(1, 1000),
                ':nom' => $nom,
                ':email' => $email,
                ':pass' => $pwd,
                ':date_naiss' => $date
            ]);
            $_SESSION['nom'] = $nom;
            $_SESSION['email'] = $email;
            $_SESSION['date'] = $date;

            header("location: essai.php");
    }  
?>