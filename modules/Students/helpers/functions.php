<?php

use Modules\Students\src\Models\Student;

function isClientActive($email)
{
    $checkActive = Student::where('email', $email)->where('is_active', 1)->count();

    if ($checkActive > 0) {
        return true;
    }

    return false;
}

