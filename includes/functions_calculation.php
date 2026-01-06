<?php

function calculatePrice($price_per_day, $start_date, $end_date)
{
    try {
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        
        $difference = $start->diff($end);
        $days = $difference->days;
        
        if ($days == 0) {
            $days = 1;
        }
        
        $total_price = $price_per_day * $days;
        
        return round($total_price, 2);
        
    } catch (Exception $e) {
        die('Erreur calculatePrice : ' . $e->getMessage());
    }
}