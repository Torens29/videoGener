<?php

$dirGl = __DIR__;
$dir = str_replace("\\", "/", $dirGl);
$path = $dir . '/files';

$content = @file_get_contents($dir . '/files/output.txt');

if($content){
    $maxFrame = 0;
    $files = array($_FILES['img']);
    // $maxFrame = implode(", ", $files[0]['name']) ;
    foreach ($files[0]['name'] as $fileName){

        if ($fileName !=="" && file_exists($path . '/' . $fileName)) {
                $maxFrame += 50;
            }
    }

    
    preg_match_all("/frame=[0-9]+/", $content, $frames);
    $frames = array_reverse($frames);

    preg_match_all("/progress=[A-Za-z]+/", $content, $condition);

    echo (int)explode('frame=', array_pop($frames[0]))[1]/ $maxFrame * 100; 

    $condition = array_pop($condition[0]);
    if($condition == "progress=end"){
        $filesInDir = glob($path . '/*'); 
        foreach($filesInDir as $fileOnDir) {
            if(is_file($fileOnDir)) {
                unlink($fileOnDir); 
                // rmdir($path );
            }
        }
    }
    echo ' ' .  $condition;
    // echo "Duration: " . array_pop($frames[0]) . "<br>";
    // echo "Current Time: " . array_pop($condition[0]) . "<br>";
    // echo "maxFrame: " . $maxFrame . "";

}





// $ffmpeg_output = file_get_contents('./files/output.txt');
// if ($ffmpeg_output) {

//     preg_match("/Duration: (.*?), start:/", $ffmpeg_output, $a_match);
//     $duration_as_time = $a_match[1];
//     $time_array = array_reverse(explode(":", $duration_as_time));
//     $duration = floatval($time_array[0]);

//     if (!empty($time_array[1])) 
//         $duration += intval($time_array[1]) * 60;
//     if (!empty($time_array[2])) 
//         $duration += intval($time_array[2]) * 60 * 60;

//     preg_match_all("/time=(.*?) bitrate/", $ffmpeg_output, $a_match);
//         $raw_time = array_pop($a_match);
//     if (is_array($raw_time)) {
//         $raw_time = array_pop($raw_time);
//     }

//     $time_array = array_reverse(explode(":", $raw_time));
//     $encode_at_time = floatval($time_array[0]);

//     if (!empty($time_array[1])) 
//         $encode_at_time += intval($time_array[1]) * 60;
//     if (!empty($time_array[2])) 
//         $encode_at_time += intval($time_array[2]) * 60 * 60;
//     echo round(($encode_at_time / $duration) * 100);
// }

