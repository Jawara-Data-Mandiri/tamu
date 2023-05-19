<?php
    if(isset($_POST['tSubmit']))
    {
        $array = $_POST;
        echo(implode(", ", $array));
    }
?>