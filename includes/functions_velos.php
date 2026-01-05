<?php
function getAllVelos($pdo, $disponible = '', $prix_min = null, $prix_max = null)
{
    try {
        $sql = 'SELECT * FROM velos WHERE 1=1';

        if ($disponible == '1') {
            $sql .= ' AND quantity > 0';
        }

        if ($prix_min  !== null && $prix_min > 0) {
            $sql .= ' AND price >= ' . $prix_min;
        }

        if ($prix_max  !== null && $prix_max > 0) {
            $sql .= ' AND price <= ' . $prix_max;
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Erreur getAllVelos : ' . $e->getMessage());
    }
}

function getVeloById($pdo, $id)
{
    try {
        $sql = 'SELECT * FROM velos WHERE id=:id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Erreur getVeloById : ' . $e->getMessage());
    }
}

function updateVelo($pdo, $id, $data)
{

    try {
        $sql = 'UPDATE velos
        SET name = :name,
        price = :price,
        quantity = :quantity,
        description = :description
        WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':price', $data['price'], PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);
        $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);

        return  $stmt->execute();

    } catch (PDOException $e) {
        die('Erreur updateVelo : ' . $e->getMessage());
    }
}
