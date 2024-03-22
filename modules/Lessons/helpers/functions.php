<?php

function getLesson($lessons, $old = '', $module = '', $parentId = 0, $char = '',)
{
    if ($lessons) {
        foreach ($lessons as $key => $lesson) {
            $selected = '';
            if ($old == $lesson['id']) {
                $selected = ' selected';
            }

            if ($module == $lesson['position']) {
                $selected = ' selected';
            }

            if ($lesson['parent_id'] == $parentId) {
                echo '<option value="' . $lesson['id'] . '" ';
                echo $selected;
                echo '  >' . $char . $lesson['name'] . '</option>';
                unset($lesson[$key]);
                getCategories($lessons, $old, $lesson['id'], $char . '  |- ');
            }
        }
    }
}

function formatTime($seconds) {
    if ($seconds < 60) {
        return round($seconds) . ' giây';
    } else {
        $minutes = floor($seconds / 60);
        return $minutes . ' phút';
    }
}

