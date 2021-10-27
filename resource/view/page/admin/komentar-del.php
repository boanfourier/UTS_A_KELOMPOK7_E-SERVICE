<?php
    $id = val($_GET['id_komentar']);

    $sql = "DELETE FROM komentar WHERE id = '$id'";

    $del_komentar = $conn->query($sql);

    if($del_komentar) {
        alert('Berhasil');
        redir('?page=admin-komentar');
    } else {
        alert('Gagal');
        redir('?page=admin-komentar');
    }
?>