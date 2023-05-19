<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>document</title>
    </head>
    <body>
        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project_tamu";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM tamu ORDER BY id  DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc())
            {
                echo '<img src="data:image/png;base64, '.base64_encode($row['photo']).'"> ' . implode(", ", $row);
            }
        } 
        else 
        {
            echo '<img src="error-image-generic.png">';
        }

        $conn->close();
        ?>
    </body>
</html>
