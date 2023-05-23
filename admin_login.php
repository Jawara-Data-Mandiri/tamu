<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body{
            background-color: #678052;
        }
        .container{
            position: absolute;
            left: 50%;
            top: 45%;
            transform: translate(-50%, -50%);

            background-color: white;
            padding: 20px;
            border-radius: 5px;
        }
        h2, hr, input{
            margin-bottom: 2vh;
        }
        input{
            border-radius: 10px;
            padding: 5px 10px;
            outline: none;
            border: 1px solid black;
        }
        label{
            margin-left: 5px;
        }
        input[type="email"], input[type="password"]{
            min-width: 15vw;
        }
        input[type="submit"]{
            margin-top: 10px;
            background-color: transparent;
            border: 1px solid #678052;
            color: #678052;
            padding: 5px 15px;
            border-radius: 20px;
            outline: none;
            transition: background-color 0.2s;
            transition: color 0.2s;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background-color: #678052;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post">
            <h2>Admin Login</h2> <hr>
            <label for="iEmail"><small>Email</small></label> <br>
            <input type="email" name="tMail" id="iEmail" required> <br>
            <label for="iPass"><small>Password</small></label> <br>
            <input type="password" name="tPass" id="iPass" required> <br>
            <input type="submit" name="tSubmit" value="Login">
        </form>
    </div>
    <?php
        require_once("connection.php");
        $conn = OpenMYSQL();

        if(isset($_POST['tSubmit'])) {
            $email = $_POST['tMail'];
            $pass = $_POST['tPass'];
            if($result = mysqli_query($conn, "SELECT * FROM `admin` WHERE `email`='$email' LIMIT 1")) {
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['password'] == $pass) {
                            echo("<script>alert('Selamat datang " . $row['name'] . "');</script>");
                            session_start();
                            $_SESSION['admin'] = $row['email'];
                            header("Location: admin_index.php");
                            exit();
                        } else {
                            echo("<script>alert('Password Salah');</script>");
                        }
                    }
                } else {
                    echo("<script>alert('Akun tidak ditemukan');</script>");
                }
                
            } else {
                echo("<script>alert('Query Error');</script>");
            }
        }

        CloseMYSQL($conn);
    ?>
</body>
</html>