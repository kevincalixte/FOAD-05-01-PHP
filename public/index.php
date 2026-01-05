<?php
require_once '../config/db_connect.php';
// echo 'Connecté à resavelo';
require_once '../includes/functions_velos.php';

$velos = getAllVelos($pdo);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des vélos</title>
</head>

<body>
    <h1>Liste des vélos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($velos as $velo): ?>
                <tr>
                    <td><?php echo $velo['id']; ?></td>
                    <td><?php echo $velo['name']; ?></td>
                    <td><?php echo $velo['price']; ?> €</td>
                    <td><?php echo $velo['quantity']; ?></td>
                    <td><?php echo $velo['description']; ?></td>
                    <td><img src="<?= '../assets/imgs/'.$velo['image_url'] ;?>" width="50" height="50"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>


<?php


if (!empty($velos)) {

    foreach ($velos as $velo) {
        // echo $velo['name'];
    }
} else {
    // echo 'Aucun vélo trouvé';
}
