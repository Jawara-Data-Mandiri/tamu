<?php
$photo = $_POST['photo'];
$url = $_POST['photoName'];

$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);

file_put_contents("picture/image/" . $url, $photo);
?>