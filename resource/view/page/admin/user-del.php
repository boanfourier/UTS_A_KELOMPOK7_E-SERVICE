<?php
    $id = val($_GET['id_user']);

    $check_sql = "SELECT * FROM user WHERE id='$id'";

    $check = $conn->query($check_sql);
    $che = $check->fetch_array();

    if($che['foto'] != 'asset/upload/default.png') {
        unlink($che['foto']);
    }

    $del_sql = "DELETE FROM user WHERE id='$id'";
    $del = $conn->query($del_sql);

    if($del) {
        alert('Berhasil');
        redir('?page=admin-user');
    } else {
        alert('Gagal');
        redir('?page=admin-user');
    }

?>