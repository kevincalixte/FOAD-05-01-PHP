<?php
require_once '../config/db_connect.php';
// echo 'Connecté à resavelo';
require_once '../includes/functions_velos.php';

if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $data = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
        'description' => $_POST['description']
    ];

    if (updateVelo($pdo, $id, $data)) {
        header('Location: index.php');
        exit;
    } else {
        echo "La modification a échouée";
    }
}

$id_velo = $_GET['id'] ?? null;
$velo = getVeloById($pdo, $id_velo);

if (!$velo) {
    die('Velo introuvable');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un vélo - <?= $id_velo ?></title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <h1>Modifier un vélo - <?= $id_velo ?></h1>

    <form action="" method="POST">

        <label for="id">Id : </label>
        <input type='text' name='id' value=<?php echo $velo['id']; ?>></input>
        <label for="name">Name : </label>
        <input type='text' name='name' value='<?php echo $velo['name']; ?>'></input>
        <label for="price">Price : </label>
        <input type='text' name='price' value=<?php echo $velo['price'] . ' €' ?>></input>
        <label for="quantity">Quantity : </label>
        <input type='text' name='quantity' value=<?php echo $velo['quantity']; ?>></input>
        <label for="description">Description : </label>
        <textarea name='description'><?php echo $velo['description']; ?></textarea>
        <div><img src="<?= '../assets/imgs/' . $velo['image_url']; ?>" width="50" height="50">
            <input type="file" name='image'>
        </div>
        <button type="submit" name='modifier'>Modifier</button>

    </form>


</body>

</html>