<?php
    include('connexion.php');
    session_start();
    $nom = $_SESSION['nom'];

    $sql = 'SELECT * FROM technicien';
    $stmt = $monPDO->prepare($sql);
    $stmt->execute();
    $tech = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $id = $_GET['id'];

    $sql2 = "SELECT * FROM service WHERE ID_TECH = :id";
    $stmt= $monPDO->prepare($sql2);
    $stmt->execute(['id'=> $id]);
    $serv = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $dem = isset($_POST['demande'])? $_POST['demande'] : '';
    $demm = isset($_POST['demm'])? $_POST['demm'] : '';
    $_SESSION['demand'] = $dem;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $nom != ''){
    if($dem != ''){
        $req = "SELECT * FROM client WHERE NOM_CLIENT = :nom";
        $stmt= $monPDO->prepare($req);
        $stmt->execute([':nom' => $nom]);
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        $check = $monPDO->prepare("SELECT * FROM demander WHERE ID = ? AND ID_SERVICE = ?");
        $check->execute([
            $client['ID'],
             $dem
        ]);

        if ($check->rowCount() > 0) {
            header('location:dem1.php?error=1');
            exit();
        }

        $req2 = " INSERT INTO demander(ID, ID_SERVICE, NOM_DEMANDE, STATUT)
                VALUES (:id, :id_service, :nom_demande, :statut)";
        $stmt2= $monPDO->prepare($req2);
        $stmt2->execute([
                ':id' => $client['ID'],
                ':id_service' => $dem,
                ':nom_demande' => $demm,
                ':statut' => 'en attente'
            ]);
            header('location:dem1.php?success=1');
            echo '<script>alert("Demande envoyée avec succès !");</script>';
            exit();
    }
}
?>

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

    option{
        color: black !important;
    }
</style>
<body>
    
    <div class="container">
        <?php if($id = 12):?>
            <div class="card">
                <div class="card-body">
                    <Form action="" method="POST">
                        <div class="mb-3">
                            <label for="demande" class="form-label"><h3>Type de demande :</h3></label>
                            <select class="form-select" name="demande" required>
                                <option value=""></option>
                                <?php for($i=0; $i<count($serv); $i++):?>
                                <option value="<?= $serv[$i]['ID_SERVICE'] ?>"><?= htmlspecialchars($serv[$i]['NOM_SERVICE'])?></option>
                                <?php endfor?>
                            </select>
                            <label for="demm" class="form-label">Specifiez votre demande</label>
                            <textarea class="form-control" id="demm" name="demm" rows="3" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                    </Form>   
                </div>
            </div>
        <?php elseif($id=581):?>
            <div class="card">
                <div class="card-body">
                    <Form action="" method="POST">
                        <div class="mb-3">
                            <label for="demande" class="form-label"><h3>Type de demande :</h3></label>
                            <select class="form-select" name="demande" required>
                                <option value=""></option>
                                <?php for($i=0; $i<count($serv); $i++):?>
                                <option value="<?= $serv[$i]['ID_SERVICE'] ?>"><?= htmlspecialchars($serv[$i]['NOM_SERVICE'])?></option>
                                <?php endfor?>
                            </select>
                            <label for="demm" class="form-label">Specifiez votre demande</label>
                            <textarea class="form-control" id="demm" name="demm" rows="3" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                    </Form>   
                </div>
            </div> 
        <?php elseif($id = 204):?>
            <div class="card">
                <div class="card-body">
                    <Form action="" method="POST">
                        <div class="mb-3">
                            <label for="demande" class="form-label"><h3>Type de demande :</h3></label>
                            <select class="form-select" name="demande" required>
                                <option value=""></option>
                                <?php for($i=0; $i<count($serv); $i++):?>
                                <option value="<?= $serv[$i]['ID_SERVICE'] ?>"><?= htmlspecialchars($serv[$i]['NOM_SERVICE'])?></option>
                                <?php endfor?>
                            </select>
                            <label for="demm" class="form-label">Specifiez votre demande</label>
                            <textarea class="form-control" id="demm" name="demm" rows="3" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                    </Form>   
                </div>
            </div>
        <?php elseif($id = 129):?>
           <div class="card">
                <div class="card-body">
                    <Form action="" method="POST">
                        <div class="mb-3">
                            <label for="demande" class="form-label"><h3>Type de demande :</h3></label>
                            <select class="form-select" name="demande" required>
                                <option value=""></option>
                                <?php for($i=0; $i<count($serv); $i++):?>
                                <option value="<?= $serv[$i]['ID_SERVICE'] ?>"><?= htmlspecialchars($serv[$i]['NOM_SERVICE'])?></option>
                                <?php endfor?>
                            </select>
                            <label for="demm" class="form-label">Specifiez votre demande</label>
                            <textarea class="form-control" id="demm" name="demm" rows="3" required></textarea>
                            <br>
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                    </Form>   
                </div>
            </div>
        <?php endif?>          
    </div>        
    <script src="assets/js/utilities/popper.min.js"></script> 
  <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
  <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>
