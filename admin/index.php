<?php
require_once '../config/db_connect.php';
require_once '../includes/functions_velos.php';
require_once '../includes/functions_reservation.php';

$velos = getAllVelos($pdo);
$reservations = getAllReservations($pdo);

$total_velos = count($velos);
$total_reservations = count($reservations);

$revenus_total = 0;
$reservations_en_attente = 0;
$reservations_confirmees = 0;
$reservations_terminees = 0;
$reservations_annulees = 0;

foreach ($reservations as $reservation) {
    if ($reservation['status'] == 'confirmee' || $reservation['status'] == 'terminee') {
        $revenus_total += $reservation['total_price'];
    }
    
    if ($reservation['status'] == 'en_attente') $reservations_en_attente++;
    if ($reservation['status'] == 'confirmee') $reservations_confirmees++;
    if ($reservation['status'] == 'terminee') $reservations_terminees++;
    if ($reservation['status'] == 'annulee') $reservations_annulees++;
}

$velos_count = [];
foreach ($reservations as $reservation) {
    if ($reservation['status'] == 'confirmee' || $reservation['status'] == 'terminee') {
        $velo_name = $reservation['velo_name'];
        if (!isset($velos_count[$velo_name])) {
            $velos_count[$velo_name] = 0;
        }
        $velos_count[$velo_name]++;
    }
}

arsort($velos_count);
$top_velos = array_slice($velos_count, 0, 5, true);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tableau de bord</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Admin - Tableau de bord</h1>

    <a href="../public/index.php">Client</a> | 
    <a href="reservations.php">Gestion réservations</a> | 
    <a href="velos.php">Gestion vélos</a>

    <h2>Statistiques générales</h2>
    
    <div>
        <div>
            <h3>Vélos</h3>
            <p>Total vélos : <?php echo $total_velos; ?></p>
        </div>
        
        <div>
            <h3>Réservations</h3>
            <p>Total réservations : <?php echo $total_reservations; ?></p>
            <p>En attente : <?php echo $reservations_en_attente; ?></p>
            <p>Confirmées : <?php echo $reservations_confirmees; ?></p>
            <p>Terminées : <?php echo $reservations_terminees; ?></p>
            <p>Annulées : <?php echo $reservations_annulees; ?></p>
        </div>
        
        <div>
            <h3>Revenus</h3>
            <p>Revenus totaux : <?php echo number_format($revenus_total, 2); ?> €</p>
        </div>
    </div>

    <h2>Top 5 vélos les plus loués</h2>
    
    <?php if (count($top_velos) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Vélo</th>
                    <th>Nombre de locations</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($top_velos as $velo_name => $count): ?>
                    <tr>
                        <td><?php echo $velo_name; ?></td>
                        <td><?php echo $count; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune location pour le moment</p>
    <?php endif; ?>

    <h2>Dernières réservations</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vélo</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Prix total</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $dernieres_reservations = array_slice($reservations, 0, 10);
            foreach ($dernieres_reservations as $reservation): 
            ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['velo_name']; ?></td>
                    <td><?php echo $reservation['start_date']; ?></td>
                    <td><?php echo $reservation['end_date']; ?></td>
                    <td><?php echo $reservation['total_price']; ?> €</td>
                    <td><?php echo $reservation['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>