

<?php
    include('connexion.php');
    session_start();

    header('Content-Type: application/json');

    $sqsl = "SELECT NOM_TECHNICIEN, COUNT(note.ID_TECH) AS demandes FROM technicien, note
        WHERE technicien.ID_TECH = note.ID_TECH AND technicien.ID_TECH IN( SELECT ID_TECH FROM maitriser ) GROUP BY technicien.ID_tech";
    $stmt=$monPDO->prepare($sqsl);
    $stmt->execute();
    $techs=$stmt->fetchAll(PDO::FETCH_ASSOC);

    $labels = [];
    $counts = [];

    foreach($techs as $tech){
        $labels[] = $tech['NOM_TECHNICIEN'];
        $counts[] = $tech['demandes'];
    }

    echo json_encode(['labels' => $labels, 'counts' => $counts]);
?>