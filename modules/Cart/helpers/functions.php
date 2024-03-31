<?php

function sumCart($listCart)
{
    $sum = 0;
    foreach ($listCart as $course) {
        if ($course['attributes']['sale_price'] == 0) {
            $sum += $course['price'];
        } else {
            $sum += $course['attributes']['sale_price'];
        }
    }
    return $sum;
}

