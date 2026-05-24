<?php

header('Content-Type: application/json');

    include('connexion.php');
session_start();

$sql="SELECT NOM_TECHNICIEN, COUNT(note.ID_TECH) AS demandes FROM technicien, note WHERE technicien.ID_TECH = note.ID_TECH
AND technicien.ID_TECH IN (SELECT ID_TECH FROM maitriser WHERE NUMERO = :num) GROUP BY technicien.ID_TECH";
$stmt=$monPDO->prepare($sql);
$stmt->execute([':num' => $_GET['num']]);
$tec=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $counts = [];

    foreach($tec as $tech){
        $labels[] = $tech['NOM_TECHNICIEN'];
        $counts[] = $tech['demandes'];
    }

    echo json_encode(['labels' => $labels, 'counts' => $counts]);


?>