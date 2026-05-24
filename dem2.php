<?php session_start();
include('connexion.php') ?>
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
    body{
        background-image: url('images/refrigeration-7363620_1280.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        }
    .img{
        text-align: center;
        margin-top: 20px;
    }
    .card{
        margin: 20px auto;
        width: 80%;
        max-width: 600px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 70px !important;
    }
    .fa-arrow-left{
        position: absolute;
        top: 30px;
        left: 30px;
        font-size: 24px;
        cursor: pointer;
        color: black;
        width: 60px !important;
        height: 60px !important;
    }
</style>    
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <Form action="" method="POST">
                    <div class="mb-3">
                        <label for="demande" class="form-label"><h3>Type de demande :</h3></label>
                        <select class="form-select" name="demande" required>
                            <option value=""></option>
                            <option value="183">Etude des projets de constructions</option>
                            <option value="287">Conception des plans</option>
                            <option value="927">Supervision des chantiers</option>
                        </select>
                        <label for="demm" class="form-label">Specifiez votre demande</label>
                        <textarea class="form-control" id="demm" name="demm" rows="3" required></textarea>
                        <br>
                        <button type="submit" class="btn btn-primary">Soumettre</button>
                    </div>
                </Form>   
            </div>
        </div>
    </div>        
    <script src="assets/js/utilities/popper.min.js"></script> 
  <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
  <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>
<?php
    $nom = $_SESSION['nom'];
    $demande = isset($_POST['demande']) ? $_POST['demande'] : '';
    $demm = isset($_POST['demm']) ? $_POST['demm'] : '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $nom != ''){
    if($demande != ''){
        $req = "SELECT * FROM client WHERE NOM_CLIENT = :nom";
        $stmt= $monPDO->prepare($req);
        $stmt->execute([':nom' => $nom]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        $check = $monPDO->prepare("SELECT * FROM demander WHERE ID = ? AND ID_SERVICE = ?");
        $check->execute([$client['ID'], $demande]);

        if ($check->rowCount() > 0) {
            header('location:dem2.php?error=1');
            exit();
        }

        $req2 = "INSERT INTO demander(ID, ID_SERVICE, NOM_DEMANDE)
                VALUES (:id, :id_service, :nom_demande)";
        $stmt2= $monPDO->prepare($req2);
        $stmt2->execute([
            ':id' => $client['ID'],
                ':id_service' => $demande,
                ':nom_demande' => $demm
            ]);
            header('location:dem2.php?success=1');
            exit();
    }
}
?>