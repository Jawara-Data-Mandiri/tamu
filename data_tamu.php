<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        td{
            padding: 5px 15px;
        }
        body{
            background-color: #678052;
        }
        .container{
            background-color: white;
            color: black;
            height: fit-content;
            width: fit-content;
            padding: 15px;
            border-radius: 5px;

            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
        .qr{
            width: 10vw;
        }
        .photo{
            max-width: 30vw;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
        require_once("connection.php");
        $conn = OpenMYSQL();
        session_start();
        
        if(!isset($_SESSION['admin'])) {
            header("Location: index.php");
            exit();
        }

        if(isset($_GET['token'])) {
            $token = $_GET['token'];
            if($result = mysqli_query($conn, "SELECT * FROM `tamu` WHERE `token`='$token' LIMIT 1")) {
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    ?>
                        <table>
                            <tr>
                                <td>Nama:</td>
                                <td><?= $row['name'] ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin:</td>
                                <td><?= $row['gender'] ?></td>
                            </tr>
                            <tr>
                                <td>Nomer Handphone:</td>
                                <td><?= $row['phone'] ?></td>
                            </tr>
                            <tr>
                                <td>Instansi:</td>
                                <td><?= $row['instance'] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat:</td>
                                <td><?= $row['address'] ?></td>
                            </tr>
                            <tr>
                                <td>Keperluan:</td>
                                <td><?= $row['keperluan'] ?></td>
                            </tr>
                            <tr>
                                <td>Foto:</td>
                                <td>
                                    <img class="photo" src="data:image/png;base64, <?= file_get_contents("picture/image/" . $row['photo']) ?>" alt="Foto">
                                </td>
                            </tr>
                            <tr>
                                <td>QR:</td>
                                <td><img class="qr" src="token_QR.php?token=<?= $token ?>" /></td>
                            </tr>   
                        </table>
                    <?php
                } else {
                    echo("Data tamu itu tidak valid.");
                }
            }
        }
        CloseMYSQL($conn);
    ?>
    </div>
</body>
</html>