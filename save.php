<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_tamu";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo -1;
}

//---
$name = $_POST['tName'];
$phone = $_POST['tPhone'];
$instance = $_POST['tInstansi'];
$address = $_POST['tAddress'];
$gender = $_POST['tGender'];
$keperluan = $_POST['tKeperluan'];
$photo = $_POST['photo'];
$url = $_POST['photoName'];
$token = $_POST['token'];

//---
$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);

//---
if($result = $conn->query("SELECT * FROM `tamu` WHERE `name`='$name'")) {
    if($result->num_rows) {
        echo 1;
    } else {
        if(file_put_contents("picture/image/" . $url, $photo)) {
            if($conn->query("INSERT INTO `tamu` (`name`, `phone`, `instance`, `address`, `gender`, `keperluan`, `photo`, `token`) VALUES ('$name', '$phone', '$instance', '$address', '$gender', '$keperluan', '$url', '$token')")) {
                setcookie('token', $token, time() + (86400 * 30), "/");//1 bulan akan expired
                echo 4;
            } else echo 0;
        } else echo 3;
    }
} else echo 2;

$conn->close();
?>