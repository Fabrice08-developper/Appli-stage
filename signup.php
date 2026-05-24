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
        $req="INSERT INTO client(NOM_CLIENT, EMAIL, PASS, DATE_NAISSANCE)
                VALUES (:nom, :email, :pass, :date_naiss)";
        $stmt = $monPDO->prepare($req);
        $stmt->execute([
                ':nom' => $nom,
                ':email' => $email,
                ':pass' => $pwd,
                ':date_naiss' => $date
            ]);
            $_SESSION['nom'] = $nom;
            $_SESSION['email'] = $email;
            $_SESSION['date'] = $date;

            header("location: accueil.php");
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap');
    
    body{
        margin: 0;
        padding: 0;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #031c3e, #9ad7e8);
        font-family: 'Poppins', sans-serif;
        display: flex;
    }

    .main{
        width: 400px;
        height: 525px;
        background-image: url('OIP.webp') no-repeat center;
        border-radius: 10px;
        box-shadow: 0 15px 25px rgba(0,0,0,0.5);
        overflow: hidden;
        position: relative;
    }

    #chk{
        display: none;
    }

    .signup{
        position: relative;
        width: 100%;
        height: 100%;
    }

    label{
        color: #fff;
        font-size: 2.1em;
        justify-content: center;
        display: flex;
        margin: 60px;
        font-weight: bold;
        cursor: pointer;
        transition: .5s ease-in-out;
    }

    input{
        width: 60%;
        height: 20px;
        background: #e0dede;
        display: flex;
        margin: 20px auto;
        padding: 10px;
        border: none;
        outline: none;
        border-radius: 5px;
    }

    button{
        width: 60%;
        height: 40px;
        background: linear-gradient(135deg, #71b7e6, #031c3e);
        color: #fff;
        font-size: 1.1em;
        font-weight: bold;
        border: none;
        outline: none;
        border-radius: 5px;
        cursor: pointer;
        justify-content: center;
        display: block;
        margin: 10px auto;
        margin-top: 20px;
        transition: .2s ease-in;
    }

    .button:hover{
        background: linear-gradient(-135deg, #031c3e, #71b7e6 );
    }

    .login{
        height: 460px;
        background: #fff;
        border-radius: 60% / 10%;
        transform: translateY(-180px);
        transition: .8s ease-in-out;
    }

    .login label{
        color: #031c3e;
        transform: scale(0.6);
    }

    #chk:checked ~ .login{
        transform: translateY(-500px);
    }

    #chk:checked ~ .login label{
        transform: scale(1);
    }

    #chk:checked ~ .signup label{
        transform: scale(0.6);
    }

</style>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form action="" method="post" id="signup">
                <label for="chk" aria-hidden="true">Sign Up</label>
                <input type="text" name="nom" placeholder="User name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="pwd" placeholder="Password" required>
                <input type="date" name="date" required>
                <button>Sign Up</button>
            </form>
        </div>

        <div class="login" id="login">
            <form action="" method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email2" placeholder="Email" required="">
                <input type="password" name="pswd2" placeholder="Password" required="">
                <button>Login</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    $pswd2 = isset($_POST['pswd2']) ? $_POST['pswd2'] : '';
    $email2 = isset($_POST['email2']) ? $_POST['email2'] : '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email2 = $_POST['email2'];
        $pswd2 = $_POST['pswd2'];

        $sql = "SELECT ID, NOM_CLIENT as nom, EMAIL as email, PASS as pswd, 'client' AS type FROM client WHERE EMAIL = ?
        UNION
        SELECT ID_TECH as ID, NOM_TECHNICIEN as nom, Email_tech as email, PASS AS pswd, 'technicien' AS type FROM technicien WHERE Email_tech = ?
        UNION
        SELECT ID_AD as ID, NOM as nom, EMAIL as email, PASS as pswd, 'admin' AS type FROM administrateur WHERE EMAIL = ?";

        $stmt = $monPDO->prepare($sql);
        $stmt->execute([$email2, $email2, $email2]);
        $user = $stmt->fetch(PDO ::FETCH_ASSOC);

        $rt= "SELECT * FROM technicien WHERE Email_tech = :email";
        $stmt= $monPDO->prepare($rt);
        $stmt->execute([':email' => $email2]);
        $technicien = $stmt->fetch(PDO::FETCH_ASSOC);

        $rt1= "SELECT * FROM client WHERE EMAIL = :email";
        $stmt= $monPDO->prepare($rt1);
        $stmt->execute([':email' => $email2]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        $rt2= "SELECT * FROM administrateur WHERE EMAIL = :email";
        $stmt= $monPDO->prepare($rt2);
        $stmt->execute([':email' => $email2]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($pswd2, $user['pswd'])) {
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
                header("Location: accueil2.php");
                
            } else if($user['type'] === 'admin') {
                $_SESSION['nom2'] = $admin['NOM'];
                $_SESSION['email2'] = $admin['EMAIL'];
                header("Location: admin.php");
            }
            exit();
        }else {
            echo "<script>alert('Email ou mot de passe incorrect');</script>";
        }
    }
?>