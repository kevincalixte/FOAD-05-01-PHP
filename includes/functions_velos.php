<?php
function getAllVelos($pdo)
{
    try {
        $sql = 'SELECT * FROM velos';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('Erreur getAllVelos : ' . $e->getMessage());
    }
}
