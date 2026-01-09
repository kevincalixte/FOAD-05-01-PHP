<?php
require_once '../config/db_connect.php';
require_once '../includes/functions_reservation.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];
    
    if ($action == 'confirmer') {
        updateReservationStatus($pdo, $id, 'confirmee');
    } elseif ($action == 'refuser') {
        updateReservationStatus($pdo, $id, 'annulee');
    } elseif ($action == 'annuler') {
        cancelReservation($pdo, $id);
    } elseif ($action == 'terminer') {
        updateReservationStatus($pdo, $id, 'terminee');
    }
    
    header('Location: reservations.php');
    exit;
}

$reservations = getAllReservations($pdo);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des réservations</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Admin - Gestion des réservations</h1>
    
    <a href="../public/index.php">Client</a> | 
    <a href="index.php">Tableau de bord</a> | 
    <a href="velos.php">Gestion vélos</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vélo</th>
                <th>Prix vélo</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Prix total</th>
                <th>Statut</th>
                <th>Date création</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?php echo $reservation['id']; ?></td>
                    <td><?php echo $reservation['velo_name']; ?></td>
                    <td><?php echo $reservation['velo_price']; ?> €</td>
                    <td><?php echo $reservation['start_date']; ?></td>
                    <td><?php echo $reservation['end_date']; ?></td>
                    <td><?php echo $reservation['total_price']; ?> €</td>
                    <td><?php echo $reservation['status']; ?></td>
                    <td><?php echo $reservation['created_at']; ?></td>
                    <td>
                        <?php if ($reservation['status'] == 'en_attente'): ?>
                            <a href="?action=confirmer&id=<?php echo $reservation['id']; ?>" onclick="return confirm('Confirmer cette réservation ?')">Confirmer</a> |
                            <a href="?action=refuser&id=<?php echo $reservation['id']; ?>" onclick="return confirm('Refuser cette réservation ?')">Refuser</a>
                        <?php elseif ($reservation['status'] == 'confirmee'): ?>
                            <a href="?action=terminer&id=<?php echo $reservation['id']; ?>" onclick="return confirm('Marquer comme terminée ?')">Terminer</a> |
                            <a href="?action=annuler&id=<?php echo $reservation['id']; ?>" onclick="return confirm('Annuler cette réservation ?')">Annuler</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
