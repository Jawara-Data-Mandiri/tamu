<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>document</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <video id="video"></video>
        <button id="capture">Capture</button>
        <canvas id="canvas"></canvas>
    </body>
</html>
<script>
//$($document).ready(() => {
    //minta akses webcam lalu masukkan realtime stream nya ke dalam element
    navigator.getUserMedia({video: true}, (stream) => {
        var video = document.getElementById('video');
        video.srcObject = stream;
        video.play();
    }, (error) => {
        console.log('Error: ', error);
    });

    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');

    document.getElementById('capture').addEventListener('click', function() 
    {
        //dimasukin ke canvas kalo tombolnya di klik
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        var dataUrl = canvas.toDataURL('image/png');
        $.ajax({
            type: 'POST',
            url: 'save.php',
            data: { photo: dataUrl },
            success: () => {
                alert('Photo saved successfully!');
            }, error: () => {
                alert('Error saving photo!');
            }
        });
    });
//});
</script>