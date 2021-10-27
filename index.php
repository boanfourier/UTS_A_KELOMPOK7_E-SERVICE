<?php
    include "config/config.php";

    $page = !empty($_GET['page']) ? $_GET['page'] : 'beranda';
    
    // Route
    switch($page) {
        // Beranda
        case 'beranda' : include "resource/view/page/beranda.php"; break;
        case 'about' : include "resource/view/page/about.php"; break;
        case 'login' : include "resource/view/page/login.php"; break;
        case 'logout' : include "resource/view/page/logout.php"; break;
        case 'register' : include "resource/view/page/register.php"; break;

        // User
        case 'user' : include "resource/view/page/user/beranda.php"; break;
        case 'user-profile' : include "resource/view/page/user/profile.php"; break;
        // Admin
        case 'admin' : include "resource/view/page/admin/beranda.php"; break;
        case 'admin-posting' : include "resource/view/page/admin/posting.php"; break;
        case 'admin-posting-del' : include "resource/view/page/admin/posting-del.php"; break;
        case 'admin-komentar' : include "resource/view/page/admin/komentar.php"; break;
        case 'admin-komentar-del' : include "resource/view/page/admin/komentar-del.php"; break;
        case 'admin-user' : include "resource/view/page/admin/user.php"; break;
        case 'admin-user-del' : include "resource/view/page/admin/user-del.php"; break;
        
        default : include "resource/view/page/404.php";
    }
?>