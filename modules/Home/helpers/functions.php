<?php
function formatCurrency($amount, $currencyCode = 'VND')
{
    $formattedAmount = number_format($amount, 0, '.', '.');

    switch ($currencyCode) {
        case 'USD':
            $formattedAmount = '$' . $formattedAmount;
            break;
        case 'EUR':
            $formattedAmount = '€' . $formattedAmount;
            break;
        case 'GBP':
            $formattedAmount = '£' . $formattedAmount;
            break;
        case 'VND':
        default:
            $formattedAmount .= 'đ';
            break;
    }

    return $formattedAmount;
}

function sumDurations($courses)
{
    $sum = 0;

    foreach ($courses['lessons'] as $lesson) {
        $sum += $lesson['durations'];
    }

    return formatTime($sum);
}


