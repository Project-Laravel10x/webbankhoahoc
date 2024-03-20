<?php

use Modules\Client\src\Models\Client;

function isClientActive($email)
{
    $checkActive = Client::where('email', $email)->where('is_active', 1)->count();

    if ($checkActive > 0) {
        return true;
    }

    return false;
}
