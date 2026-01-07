<?php
    include('connexion.php');
$mp1= 'juin2009';
$pass = PASSWORD_HASH($mp1, PASSWORD_DEFAULT);

$sql = "UPDATE client SET PASS = :pass WHERE ID = :id_client";
$stmt= $monPDO->prepare($sql);
$stmt->execute([
    ':pass' => $pass,
    ':id_client' => 375
]);
