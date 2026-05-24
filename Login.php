<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServXpert</title>
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
    <div class="col-auto mb-5">
            <form method="post">
                <h1>Connexion</h1>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                    <label for="floatingInput"><i class="fas fa-at"></i> Adresse Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="pswd" class="form-control" id="floatingPassword" placeholder="Password" required>
                    <label for="floatingPassword"><i class="fas fa-lock"></i> Mot de passe</label>
                </div>
                <div class="col-auto">
                    <button type="submit">Se connecter</button>
                </div>
            </form>
            <p>Vous n'avez pas de compte ? <a href="ins.php" style="text-decoration: none !important;">S'inscrire</a></p>
        </div>
    
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>
<?php
    include('connexion.php');
    $pswd = isset($_POST['pswd']) ? $_POST['pswd'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $pswd = $_POST['pswd'];

        $sql = "SELECT ID, NOM_CLIENT as nom, EMAIL as email, PASS as pswd, 'client' AS type FROM client WHERE EMAIL = ?
        UNION
        SELECT ID_TECH as ID, NOM_TECHNICIEN as nom, Email_tech as email, PASS AS pswd, 'technicien' AS type FROM technicien WHERE Email_tech = ?";

        $stmt = $monPDO->prepare($sql);
        $stmt->execute([$email, $email]);
        $user = $stmt->fetch(PDO ::FETCH_ASSOC);

        $rt= "SELECT * FROM technicien WHERE Email_tech = :email";
        $stmt= $monPDO->prepare($rt);
        $stmt->execute([':email' => $email]);
        $technicien = $stmt->fetch(PDO::FETCH_ASSOC);

        $rt1= "SELECT * FROM client WHERE EMAIL = :email";
        $stmt= $monPDO->prepare($rt1);
        $stmt->execute([':email' => $email]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pswd, $user['pswd'])) {
            $_SESSION['ID'] = $user['ID'];
            $_SESSION['type'] = $user['type'];
            
            if($user['type'] === 'client') {
                $_SESSION['nom'] = $client['NOM_CLIENT'];
                $_SESSION['email'] = $client['EMAIL'];
                $_SESSION['date'] = $client['DATE_NAISSANCE'];
                header("Location: accueil.php");
            } else if($user['type'] === 'technicien') {
                $_SESSION['nom1'] = $technicien['NOM_TECHNICIEN'];
                $_SESSION['email1'] = $technicien['Email_tech'];
                header("Location: page2.php");
                
        }
        exit();
        }else {
            echo "<script>alert('Email ou mot de passe incorrect');</script>";
        }
    }

    
?>