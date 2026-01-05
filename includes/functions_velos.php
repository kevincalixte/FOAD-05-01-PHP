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
