<?php

function createReservation($pdo, $velo_id, $start_date, $end_date, $total_price)
{
    try {
        $sql = 'INSERT INTO reservations (velo_id, start_date, end_date, total_price, status)
                VALUES (:velo_id, :start_date, :end_date, :total_price, :status)';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':velo_id', $velo_id, PDO::PARAM_INT);
        $stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->bindValue(':total_price', $total_price, PDO::PARAM_STR);
        $stmt->bindValue(':status', 'en_attente', PDO::PARAM_STR);
        
        return $stmt->execute();
        
    } catch (PDOException $e) {
        die('Erreur createReservation : ' . $e->getMessage());
    }
}

function getAllReservations($pdo)
{
    try {
        $sql = 'SELECT r.*, v.name as velo_name, v.price as velo_price
                FROM reservations r
                JOIN velos v ON r.velo_id = v.id
                ORDER BY r.created_at DESC';
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        die('Erreur getAllReservations : ' . $e->getMessage());
    }
}

function checkAvailability($pdo, $velo_id, $start_date, $end_date)
{
    try {
        $sql = 'SELECT v.quantity,
                (SELECT COUNT(*) FROM reservations 
                 WHERE velo_id = :velo_id 
                 AND status IN ("en_attente", "confirmee")
                 AND (
                     (start_date <= :start_date AND end_date >= :start_date)
                     OR (start_date <= :end_date AND end_date >= :end_date)
                     OR (start_date >= :start_date AND end_date <= :end_date)
                 )) as reserved_count
                FROM velos v
                WHERE v.id = :velo_id';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':velo_id', $velo_id, PDO::PARAM_INT);
        $stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $available = $result['quantity'] - $result['reserved_count'];
            return $available > 0;
        }
        
        return false;
        
    } catch (PDOException $e) {
        die('Erreur checkAvailability : ' . $e->getMessage());
    }
}

function updateReservationStatus($pdo, $id, $status)
{
    try {
        $sql = 'UPDATE reservations 
                SET status = :status 
                WHERE id = :id';
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        
        return $stmt->execute();
        
    } catch (PDOException $e) {
        die('Erreur updateReservationStatus : ' . $e->getMessage());
    }
}

function cancelReservation($pdo, $id)
{
    return updateReservationStatus($pdo, $id, 'annulee');
}
