<?php
require_once '../config/db_connect.php';
require_once '../includes/functions_velos.php';
require_once '../includes/functions_reservation.php';
require_once '../includes/functions_calculation.php';

$message = '';
$error = '';

if (isset($_POST['reserver'])) {
    $velo_id = $_POST['velo_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    if (empty($start_date) || empty($end_date)) {
        $error = 'Veuillez remplir toutes les dates';
    } elseif ($start_date >= $end_date) {
        $error = 'La date de fin doit être après la date de début';
    } else {
        $velo = getVeloById($pdo, $velo_id);
        
        if (!$velo) {
            $error = 'Vélo introuvable';
        } else {
            $available = checkAvailability($pdo, $velo_id, $start_date, $end_date);
            
            if (!$available) {
                $error = 'Ce vélo n\'est pas disponible pour ces dates';
            } else {
                $total_price = calculatePrice($velo['price'], $start_date, $end_date);
                
                if (createReservation($pdo, $velo_id, $start_date, $end_date, $total_price)) {
                    $message = 'Réservation créée avec succès';
                } else {
                    $error = 'Erreur lors de la création de la réservation';
                }
            }
        }
    }
}

$velo_id = $_GET['velo_id'] ?? null;
$velo = null;

if ($velo_id) {
    $velo = getVeloById($pdo, $velo_id);
}

$velos = getAllVelos($pdo);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver un vélo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <h1>Réserver un vélo</h1>
    
    <a href="index.php">Retour au catalogue</a>

    <?php if ($message): ?>
        <div style="color: green; padding: 10px; border: 1px solid green; margin: 10px 0;">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div style="color: red; padding: 10px; border: 1px solid red; margin: 10px 0;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="velo_id">Choisir un vélo :</label>
        <select name="velo_id" id="velo_id" required>
            <option value="">-- Sélectionner un vélo --</option>
            <?php foreach ($velos as $v): ?>
                <option value="<?php echo $v['id']; ?>" <?php echo ($velo && $velo['id'] == $v['id']) ? 'selected' : ''; ?>>
                    <?php echo $v['name']; ?> - <?php echo $v['price']; ?> €/jour
                </option>
            <?php endforeach; ?>
        </select>

        <label for="start_date">Date de début :</label>
        <input type="date" name="start_date" id="start_date" required min="<?php echo date('Y-m-d'); ?>">

        <label for="end_date">Date de fin :</label>
        <input type="date" name="end_date" id="end_date" required min="<?php echo date('Y-m-d'); ?>">

        <button type="submit" name="reserver">Réserver</button>
    </form>

    <?php if ($velo): ?>
        <div style="margin-top: 20px; padding: 10px; border: 1px solid #ccc;">
            <h2>Détails du vélo sélectionné</h2>
            <p><strong>Nom :</strong> <?php echo $velo['name']; ?></p>
            <p><strong>Prix :</strong> <?php echo $velo['price']; ?> €/jour</p>
            <p><strong>Description :</strong> <?php echo $velo['description']; ?></p>
            <p><strong>Quantité disponible :</strong> <?php echo $velo['quantity']; ?></p>
            <?php if ($velo['image_url']): ?>
                <img src="<?php echo '../assets/imgs/' . $velo['image_url']; ?>" width="200" alt="<?php echo $velo['name']; ?>">
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>

</html>
