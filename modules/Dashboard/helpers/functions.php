<?php

function totalOrderAmount($orders)
{
    $sum = 0;
    if ($orders) {
        foreach ($orders as $order) {
            $sum += $order->total;
        }
    }
    return $sum;
}
