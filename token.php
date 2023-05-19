

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-color: #678052;
            font-family: Arial, Helvetica, sans-serif;
        }
        .container{
            background-color: rgb(248, 247, 247);
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            border-radius: 10px;
        }
        img{
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            if(isset($_COOKIE["token"])) {
                echo '<img src="token_QR.php?token=' . $_COOKIE['token'] . '" /><br><hr>';
                echo("<h4>Tunjukkan qr code ini ke<br>petugas untuk konfirmasi</h4>");
            } else {
                //header("Location: /tamu");
                echo("Cookie tidak ditemukan");
            }
        ?>
    </div>
</body>
</html>