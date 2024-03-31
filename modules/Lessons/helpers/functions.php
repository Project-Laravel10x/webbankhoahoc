<?php

use Modules\Video\src\Models\Video;

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

function formatTime($seconds)
{
    if ($seconds == 0) {
        return "Chưa có video bài giảng";
    }

    $minutes = floor($seconds / 60);
    $remainingSeconds = $seconds % 60;

    $formattedTime = '';
    if ($minutes > 0) {
        $formattedTime .= $minutes . ' phút';
    }

    if ($remainingSeconds > 0) {
        if ($minutes > 0) {
            $formattedTime .= ' ';
        }
        $formattedTime .= $remainingSeconds . ' giây';
    }

    return $formattedTime;
}

function getLessonsTable($lessons, $char = '', &$result = [])
{
    if (!empty($lessons)) {
        foreach ($lessons as $lesson) {
            $row = $lesson;
            $row['name'] = $char . $row['name'];
            unset($row['sub_lessons']);
            $result[] = $row;
            if (!empty($lesson['sub_lessons'])) {
                getLessonsTable($lesson['sub_lessons'], $char . '|-- ', $result);
            }
        }
    }
    return $result;
}

function countLessons($lessons = [])
{
    $sum = 0;

    foreach ($lessons as $lesson) {
        if ($lesson['parent_id'] != null) {
            ++$sum;
        }
    }

    return $sum;
}

function getUrlVideo($item)
{

    $video = Video::find($item['video_id']);

    if ($video == null) {
        return null;
    }

    return $video->url;
}
