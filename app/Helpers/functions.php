<?php

use Illuminate\Support\Facades\File;

function deleteFileStoge($image)
{

    $imageThumb = dirname($image) . '/thumbs/' . basename($image);
    File::delete(public_path($image));
    File::delete(public_path($imageThumb));
}

function getFileVideo($input)
{
    if (!$input) return false;

    if (stripos($input, '<iframe') !== false) {

        $url = getYoutubeEmbedLink($input);
        $idEmbed = getIdEmbed($url);

        return [
            'name' => getVideoTitle($idEmbed),
            'url' => $url,
            'duration' => getDuration($idEmbed),
        ];

    } else {
        $path_parts = pathinfo($input);

        return [
            'name' => isset($path_parts['filename']) ? $path_parts['filename'] : 'Unknown',
            'url' => $input,
            'duration' => getVideoDuration(public_path($input)),
        ];
    }
}

function getVideoTitle($videoId)
{
    $apiKey = 'AIzaSyDXtNsNYwB0njxXdnHu8-tcE8xxRu_Zo4Y'; // Thay YOUR_YOUTUBE_API_KEY bằng API key của bạn
    $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id=' . $videoId . '&key=' . $apiKey;

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    // Kiểm tra xem có dữ liệu trả về không và trả về tiêu đề nếu có
    if (isset($data['items'][0]['snippet']['title'])) {
        return $data['items'][0]['snippet']['title'];
    } else {
        return null;
    }
}

function getIdEmbed($embedUrl)
{
    $parts = parse_url($embedUrl);
    $pathParts = pathinfo($parts['path']);
    if (isset($pathParts['filename'])) {
        return $pathParts['filename'];
    } else {
        return null;
    }
}

function getDuration($videoID)
{
    $apikey = "AIzaSyDXtNsNYwB0njxXdnHu8-tcE8xxRu_Zo4Y"; // Like this AIcvSyBsLA8znZn-i-aPLWFrsPOlWMkEyVaXAcv
    $dur = file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=$videoID&key=$apikey");
    $VidDuration = json_decode($dur, true);
    foreach ($VidDuration['items'] as $vidTime) {
        $VidDuration = $vidTime['contentDetails']['duration'];
    }

    preg_match_all('/(\d+)/', $VidDuration, $parts);

    $minutes = isset($parts[0][0]) ? intval($parts[0][0]) : 0;
    $seconds = isset($parts[0][1]) ? intval($parts[0][1]) : 0;
    $totalSeconds = $minutes * 60 + $seconds;

    return $totalSeconds;
}


function getYoutubeEmbedLink($input)
{

    if (strpos($input, '<iframe') !== false && strpos($input, 'src=') !== false) {
        $startPos = strpos($input, 'src="') + strlen('src="');
        $endPos = strpos($input, '"', $startPos);
        $src = substr($input, $startPos, $endPos - $startPos);
        return $src;
    }

    if (strpos($input, 'embed/') !== false) {
        $startPos = strpos($input, 'embed/') + strlen('embed/');
        $videoId = substr($input, $startPos);
        return 'https://www.youtube.com/embed/' . $videoId;
    }

    return null;
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


function getVideoDuration($filePath)
{

    $getID3 = new getID3();

    $fileInfo = $getID3->analyze($filePath);

    if (isset($fileInfo['playtime_seconds'])) {
        return $fileInfo['playtime_seconds'];
    } else {
        return false;
    }
}

