<?php
require_once '../config/db_connect.php';
// echo 'Connecté à resavelo';
require_once '../includes/functions_velos.php';

$disponible = $_GET['disponible'] ?? '';
$prix_min = $_GET['prix_min'] ?? null;
$prix_max = $_GET['prix_max'] ?? null;

$velos = getAllVelos($pdo, $disponible, $prix_min, $prix_max);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des vélos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col items-center justify-center my-15">
    <h1 class='text-blue-500 text-2xl p-10'>Liste des vélos</h1>

    <form method="GET" action="">
        <label>Disponibilité :
            <select name="disponible">
                <option value="">Tous</option>
                <option value="1">Disponibles</option>
            </select>
        </label>

        <label>Prix minimum :
            <input type="number" name="prix_min" placeholder="0€">
        </label>

        <label>Prix maximum :
            <input type="number" name="prix_max" placeholder="1000€">
        </label>

        <button type="submit">Filtrer</button>
        <a href="index.php">Réinitialiser</a>
    </form>

    <table class="border">
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
                    <td><img src="<?= '../assets/imgs/' . $velo['image_url']; ?>" width="50" height="50"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>