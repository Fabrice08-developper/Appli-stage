<?php
    session_start();
    include('connexion.php');
    $nom = $_SESSION['nom1'];
    $tech = 'technicien';
    $clt = 'client';

    $sql = "SELECT ID_TECH FROM technicien WHERE NOM_TECHNICIEN = :nom";
    $stmt = $monPDO->prepare($sql);
    $stmt->execute([
        ':nom' => $nom
    ]);
    $id = $stmt->fetch(PDO::FETCH_ASSOC);

    $identifiant = $_GET['id'];

    $rt = "SELECT * FROM client WHERE ID = :id";
    $stmt = $monPDO->prepare($rt);
    $stmt->execute([
        ':id' => $identifiant
    ]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql1 = "SELECT * FROM messages WHERE ID = :id AND ID_TECH = :idt";
    $stmt = $monPDO->prepare($sql1);
    $stmt->execute([
        ':id' => $identifiant,
        ':idt' => $id['ID_TECH']
    ]);
    $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $contenu = isset($_POST['contenu']) ? $_POST['contenu']:'';
        if($contenu !== ''){
            $sql0 ="INSERT INTO messages(ID, ID_TECH, s_role, CONTENU, DATE_ENVOI)
                    VALUES (:id, :idt, :role, :cont, NOW())";
            $stmt = $monPDO->prepare($sql0);
            $stmt->execute([
                ':id' => $identifiant,
                ':idt' => $id['ID_TECH'],
                ':role' => $tech,
                ':cont' => $contenu
            ]);
        }
        header("Location: conversation.php?id=" .$identifiant);
        exit();

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
        padding-top: 20px;
    }
    .card{
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
    <div class="container mt-4">
        <h2>Messagerie</h2>
        <div class="card">
            <div class="card-header">
                Conversation avec Le client <?= htmlspecialchars($client['NOM_CLIENT']); ?>
            </div>
            <div class="card-body" style="height: 400px; overflow-y: scroll;">
                <?php if(empty($msg)): ?>
                <h4>Aucun message.</h4>
                <?php else: ?>
                <?php for($i=0; $i < count($msg); $i++):?>

                    <?php if($msg[$i]['s_role'] == 'client'):?>
                    <div class="message mb-3">
                        <strong>Client <?= htmlspecialchars($client['NOM_CLIENT']); ?></strong>
                        <p><?= htmlspecialchars($msg[$i]['CONTENU']); ?></p>
                        <small class="text-muted"><?= htmlspecialchars($msg[$i]['DATE_ENVOI']); ?></small>
                    </div>
                    <?php endif?>

                    <?php if($msg[$i]['s_role'] == 'technicien'):?>
                    <div class="message mb-3 text-end">
                        <strong>Vous:</strong>
                        <p><?= htmlspecialchars($msg[$i]['CONTENU']); ?></p>
                        <small class="text-muted"><?= htmlspecialchars($msg[$i]['DATE_ENVOI']); ?></small>
                    </div>
                    <?php endif?>
                <?php endfor ?>
                <?php endif ?>
            </div>
            <div class="card-footer">
                <form method="POST" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" name="contenu" placeholder="Écrire un message...">
                        <button class="btn btn-primary" name="send" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</body>
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</html>
    