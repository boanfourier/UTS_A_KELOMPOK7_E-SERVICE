<?php
    session_start();
    
    $auth_user = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    if($auth_user == null) {
        redir('?page=login');
    } else {
        $check_role_sql = "SELECT * FROM user WHERE id = '$auth_user'";
        $check_role = $conn->query($check_role_sql);
        $get_role = $check_role->fetch_array();
     
        if($get_role['role'] != 'admin') {
            redir('?page=login');
        }
    }

 
?>