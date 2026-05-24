<?php
    session_start();
    include('connexion.php');
    $nom = $_SESSION['nom'];
    $tech = 'technicien';
    $clt = 'client';

    $sql = "SELECT ID FROM client WHERE NOM_CLIENT = :nom";
    $stmt = $monPDO->prepare($sql);
    $stmt->execute([
        ':nom' => $nom
    ]);
    $id = $stmt->fetch(PDO::FETCH_ASSOC);

    $identifiant = $_GET['id'];

    $SQ = "SELECT * FROM technicien WHERE ID_TECH = :idt";
    $stmt = $monPDO->prepare($SQ);
    $stmt->execute([
        ':idt' => $identifiant
    ]);
    $techniciens = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql1 = "SELECT * FROM messages WHERE ID = :id AND ID_TECH = :idt";
    $stmt = $monPDO->prepare($sql1);
    $stmt->execute([
        ':id' => $id['ID'],
        ':idt' => $identifiant
    ]);
    $msg = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $contenu = isset($_POST['contenu']) ? $_POST['contenu']:'';
        if($contenu !== ''){
            $sql0 ="INSERT INTO messages(ID, ID_TECH, s_role, CONTENU, DATE_ENVOI)
                    VALUES (:id, :idt, :role, :cont, NOW())";
            $stmt = $monPDO->prepare($sql0);
            $stmt->execute([
                ':id' => $id['ID'],
                ':idt' => $identifiant,
                ':role' => $clt,
                ':cont' => $contenu
            ]);
        }
        header("Location: conversation2.php?id=" .$identifiant);
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
    <style>
        body{
            background-image: url('images/WhatsApp\ Image\ 2025-08-22\ at\ 21.25.46_91e5e87c.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            padding-top: 20px;
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
        .card{
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2>Messagerie</h2>
        <div class="card">
            <div class="card-header">
                Conversation avec Le Technicien <?= htmlspecialchars($techniciens['NOM_TECHNICIEN']) ?>
            </div>
            
            <div class="card-body" style="height: 400px; overflow-y: scroll;">
                <?php if(empty($msg)): ?>
                <h4>Aucun message.</h4>
                <?php else: ?>
                <?php for($i=0; $i < count($msg); $i++):?>

                    <?php if($msg[$i]['s_role'] == 'client'):?>
                    <div class="message mb-3 text-end">
                        <strong>Vous:</strong>
                        <p><?= htmlspecialchars($msg[$i]['CONTENU']); ?></p>
                        <small class="text-muted"><?= htmlspecialchars($msg[$i]['DATE_ENVOI']); ?></small>
                    </div>
                    <?php endif?>

                    <?php if($msg[$i]['s_role'] == 'technicien'):?>
                    <div class="message mb-3">
                        <strong>Technicien <?= htmlspecialchars($techniciens['NOM_TECHNICIEN']) ?></strong>
                        <p><?= htmlspecialchars($msg[$i]['CONTENU']); ?></p>
                        <small class="text-muted"><?= htmlspecialchars($msg[$i]['DATE_ENVOI']); ?></small>
                    </div>
                    <?php endif?>
                <?php endfor ?>
                <?php endif ?>
            </div>
            <div class="card-footer">
                <form method = "POST" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" name="contenu" placeholder="Écrire un message...">
                        <button class="btn btn-primary" name="send" type="submit">Envoyer</button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</body>
</html>
  