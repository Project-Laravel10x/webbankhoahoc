<?php

use Modules\Courses\src\Models\Course;
use Modules\Lessons\src\Models\Lesson;

function getCategoriesCheckbox($categories, $old = [], $parentId = 0, $char = '')
{

    if ($categories) {
        foreach ($categories as $key => $category) {
            if ($category['parent_id'] == $parentId) {
                $checked = !empty($old) && in_array($category['id'], $old) ? 'checked' : '';
                echo '<label class="d-block"><input type="checkbox" name="categories[]" value="' . $category["id"] . '" ' . $checked . '>' . $char . $category['name'] . '</label>';
                unset($category[$key]);
                getCategoriesCheckbox($categories, $old, $category['id'], $char . '  |- ');
            }
        }
    }
}


function convestPrice($price)
{
    if (!$price) {
        $newPrice = 0;
    } else {
        $newPrice = (float)$price;
    }
    return $newPrice;
}

function checkSalePrice($price, $salePrice)
{
    if ($salePrice == 0) {
        return $price;
    } else {
        return $salePrice;
    }
}

 function isTrial($slug)
{
    return Lesson::where('slug', $slug)->firstOrFail()?->video?->url;
}

function checkCourseRegistration($student_id, $course_id)
{
    $isRegistered = Course::whereHas('students', function ($query) use ($student_id) {
        $query->where('student_id', $student_id);
    })->where('id', $course_id)->exists();

    return $isRegistered;
}



