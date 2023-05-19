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

$name = $_POST['tName'];
$phone = $_POST['tPhone'];
$instance = $_POST['tInstansi'];
$address = $_POST['tAddress'];
$gender = $_POST['tGender'];
$keperluan = $_POST['tKeperluan'];
$photo = $_POST['tPhoto'];

//datanya diubah jadi base64 biar bisa masuk database
$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);
$photo = base64_decode($photo);

$stmt = $conn->prepare("INSERT INTO `tamu` (`name`, `phone`, `instance`, `address`, `gender`, `keperluan`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssb", $name, $phone, $instance, $address, $gender, $keperluan, $photo);
$stmt->execute();
$stmt->close();

$conn->close();
?>
