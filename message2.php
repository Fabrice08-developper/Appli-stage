<?php
session_start();
include('connexion.php');

$sl = "SELECT * FROM client";
$stmt = $monPDO->prepare($sl);
$stmt->execute();
$client = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
</head>
<style>
    body{
          background-image: url('images/img7.jpg');
          background-repeat: no-repeat;
          background-size: cover;
          background-attachment: fixed;
          background-position: center;
          backdrop-filter: blur(5px);
      }

    .list-group-item {
        background-color: rgba(252, 254, 255, 0);
        border: none;
        margin-bottom: 10px;
        font-size: 18px;
        color: #50b3e9;
    }
    
    .list-group-item:hover {
        background-color: rgba(252, 254, 255, 0.1) !important;
        color: #fff !important;
    }
    .mb-3{
        margin-top: 20px;
        color: #070707;
    }
</style>
<body>
    <h4 class="mb-3">Clients</h4>
    <?php if (count($client) === 0): ?>
        <p>Aucun client trouvé.</p>
    <?php else: ?>
        <?php for($i=0; $i < count($client); $i++): ?>
        <div class="list-group shadow-sm">
            <a href="conversation.php?id=<?= $client[$i]['ID'] ?>" class="list-group-item list-group-item-action">
                <div>
                    <h6 class="mb-0"><?= htmlspecialchars($client[$i]['NOM_CLIENT']) ?></h6>
                    <small class="text-muted"><?= htmlspecialchars($client[$i]['EMAIL']) ?></small>
                </div>
            </a>
        </div>
        <?php endfor; ?>
    <?php endif; ?>
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>