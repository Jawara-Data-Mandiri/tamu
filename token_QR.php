<?php
    require_once('phpqrcode/qrlib.php');
        
    $param = $_GET['token'];
    
    ob_start("callback");
    
    $debugLog = ob_get_contents();
    ob_end_clean();
    
    QRcode::png($param);
?>