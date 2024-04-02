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
        return "Chưa có video";
    }

    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    $formattedTime = '';

    if ($hours > 0) {
        $formattedTime .= $hours . ' giờ ';
    }

    if ($minutes > 0) {
        $formattedTime .= $minutes . ' phút ';
    }

    if ($seconds > 0) {
        $formattedTime .= $seconds . ' giây';
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
//    dd($lessons->toArray());
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

function getYoutubeEmbedLinkFromIframe($html) {
    // Tìm vị trí của chuỗi 'src=' trong đoạn mã HTML
    $startPos = strpos($html, 'src="') + strlen('src="');
    $endPos = strpos($html, '"', $startPos);

    // Trích xuất phần đường dẫn từ thuộc tính src của thẻ iframe
    $src = substr($html, $startPos, $endPos - $startPos);

    // Trả về phần đường dẫn
    return $src;
}
