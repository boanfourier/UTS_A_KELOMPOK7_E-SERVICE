<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "db_eservice";

    $conn = new mysqli($host, $user, $pass, $db);

    if($conn->connect_errno) {
        echo $conn->connect_error;
    }
    
    date_default_timezone_set('Asia/Jakarta');


    function alert($a) {
        echo "<script>
            alert('".$a."');
        </script>";
    }

    function redir($r) {
        echo "<script>
            document.location.href = '".$r."';
        </script>";
    }

    function val($v) {
        global $conn;
        return $conn->real_escape_string($v);
    }

    
?>