<?php

use Illuminate\Support\Facades\File;

function deleteFileStoge($image)
{

    $imageThumb = dirname($image) . '/thumbs/' . basename($image);
    File::delete(public_path($image));
    File::delete(public_path($imageThumb));
}

function getFileVideo($url)
{
    $getID3 = new \getID3;

    if (!$url) return false;

    $file = $getID3->analyze(public_path($url));

    $durationInSeconds = floatval($file['playtime_seconds']);

    return [
        'name' => basename($url),
        'url' => $url,
        'duration' => $durationInSeconds,
    ];
}

function getFileDocument($url)
{
    if (!$url) return false;
    return [
        'name' => basename($url),
        'url' => $url,
        'size' => File::size(public_path($url)),
    ];
}

