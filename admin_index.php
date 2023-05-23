<?php
require_once("connection.php");
$conn = OpenMYSQL();
session_start();

if(isset($_SESSION['admin'])) {
    $email = $_SESSION['admin'];
    if($result = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email`='$email' LIMIT 1")) {
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $nama = $row['name'];
                $email = $row['email'];
            }
        } else {
            $_SESSION['admin'] = null;
            header("Location: index.php");
            exit();
        }
        
    } else {
        echo("<script>alert('Query Error');</script>");
    }
} else {
    header("Location: index.php");
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        .header{
            background-color: #678052;
            height: 60px;
            width: 100vw;
        }
        .body{
            width: fit-content;
            display: flex;
        }
        .navbar{
            background-color: rgb(201, 201, 201);
            height: calc(100vh - 60px);
            width: 20vw;
        }
        .content{
            background-color: rgb(255, 255, 255);
            height: calc(100vh - 60px);
            width: 80vw;
            overflow: auto;
        }
        .header a{
            color: white;
            position: absolute;
            text-decoration: none;
            font-size: 30px;
            margin: 15px;
        }
        .navbar .button{
            background-color: rgba(0, 0, 0, 0.100);
            text-align: center;
            font-weight: bold;
            width: auto;
            margin: 2px 0;
            padding: 15px 0;
            cursor: pointer;
        }
        .navbar .button:hover{
            background-color: rgba(0, 0, 0, 0.200);
        }
        .navbar .profile{
            background-color: rgb(229, 229, 229);
            text-align: center;
            font-weight: bold;  
            padding: 20px 0;
            width: auto;
        }
        .navbar .profile img{
            width: 2.5vw;
            height: 2.5vw;
            background-color: rgb(247, 247, 247);
            border: 2.5px solid black;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 5px;
        }
        .profile-ch{
            display: inline-block;
            text-align: left;
            margin-left: 5px;
        }
        .profile-ch div:nth-child(1){
            text-align: center;
        }
        .profile-ch hr{
            margin: 5px 0;
        }
        .footer{
            position: absolute;
            background-color: rgba(0, 0, 0, 0.100);
            text-align: center;
            font-weight: bold;
            width: 20vw;
            padding: 20px 0;
            bottom: 0;
            font-weight: normal;
            color: rgb(50, 50, 50);
        }
        .table-tamu{
            border-collapse: collapse;
            margin: 20px;
            width: 95%;
            max-width: 95%;
        }
        .table-tamu td{
            padding: 10px 12px;
            text-align: left;
            border: 1px solid black;
        }
        .table-tamu tr:nth-child(1) td{
            background-color: #678052;
            color: white;
        }
        .qr-container{
            background-color: #678052;
            position: absolute;
            left: calc(120vw / 2);
            top: calc(100vh / 2);
            transform: translate(-50%, -50%);
            padding: 10px;
            border-radius: 5px;
        }
        .qr-container video{
            max-width: 25vw;
            border: 1px solid white;
        }
        .qr-scanner{
            height: calc(100vh - 50px);
            width: auto;
        }
        .qr-container hr{
            margin: 10px 0;
        }
        .qr-container p{
            display: none;
            max-width: 25vw;
            color: white;
            margin-bottom: 10px;
        }
        .qr-container button{
            background-color: transparent;
            border: 1px solid white;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            outline: none;
            transition: background-color 0.2s;
            transition: color 0.2s;
            cursor: pointer;
        }
        .qr-container button:hover{
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="#"><b>Admin Index</b></a>
    </div>
    <div class="body">
        <div class="navbar">
            <div class="profile">
                <img src="picture/guest.png" alt="">
                <span class="profile-ch">
                    <div><?= $nama ?></div><hr>
                    <div><?= $email ?></div>
                </span>
            </div>
            <div class="button tamu-button">List tamu</div>
            <div class="button qr-button">QR Check</div>
            <div class="button logout-button">Log Out</div>
            <div class="footer">
                <h4>Project Tamu 2023</h4>
            </div>
        </div>
        <div class="content">
            <div class="list-tamu" style="display: block;">
                <table class="table-tamu">
                    <tr>
                        <td>#</td>
                        <td>Nama</td>
                        <td>Jenis Kelamin</td>
                        <td>Nomer Handphone</td>
                        <td>Instansi</td>
                        <td>Alamat</td>
                        <td>Keperluan</td>
                    </tr>
                    <?php
                        if($result = mysqli_query($conn, "SELECT * FROM `tamu` WHERE 1")) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo("<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['gender'] . "</td>
                                    <td>" . $row['phone'] . "</td>
                                    <td>" . $row['instance'] . "</td>
                                    <td>" . $row['address'] . "</td>
                                    <td>" . $row['keperluan'] . "</td>
                                </tr>");
                            }
                        }
                    ?>
                </table>
            </div>
            <div class="qr-scanner" style="display: none;">
                <div class="qr-container">
                    <video id="video"></video> <br> <hr>
                    <p class="qr-warn"><small>QR Code tidak terdeteksi, coba jauhkan atau dekatkan kode ke kamera.</small></p>
                    <button>Capture</button>
                    <canvas id="canvas" style="display: none;" willReadFrequently></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            $(".tamu-button").click(() => {
                $(".list-tamu").css("display", "block");
                $(".qr-scanner").css("display", "none");
            });
            $(".qr-button").click(() => {
                $(".list-tamu").css("display", "none");
                $(".qr-scanner").css("display", "block");
            });

            var video = document.getElementById('video');
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var intervalId;

            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                    //intervalId = setInterval(tick, 100); // Mengambil gambar setiap 100ms
                })
                .catch(function(error) {
                    console.log('Kamera tidak dapat diakses:', error);
                });
            }

            $('button').click(() => {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                var imageData = context.getImageData(0, 0, canvas.width, canvas.height, { willReadFrequently: false });
                var code = jsQR(imageData.data, imageData.width, imageData.height);

                if (code) {
                    window.location.href = "data_tamu.php?token=" + code.data;
                } else {
                    $('.qr-warn').css("display", "block");
                }
            });
            $('.logout-button').click(() => {
                $.ajax({type: "POST", url: "admin_logout.php", success: () => {
                    window.location.href = "index.php";
                }});
            });
        });
    </script>
</body>
</html>

<?php CloseMYSQL($conn); ?>