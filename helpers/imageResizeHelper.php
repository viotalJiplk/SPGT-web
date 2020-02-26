<?php

$filenameWithPath = '../'.$_GET['fileName'];
$targetWidth = $_GET['targetWidth'];

// Content type
header('Content-Type: image/jpeg');

// Get new sizes
list($width, $height) = getimagesize($filenameWithPath);

$newwidth = $targetWidth;
$newheight = $targetWidth * $height / $width;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filenameWithPath);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

// Output
imagejpeg($thumb);



?>