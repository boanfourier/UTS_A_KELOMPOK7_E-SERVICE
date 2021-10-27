<?php
    $id = val($_GET['id_posting']);

    $sql_posting_get = "SELECT * FROM posting WHERE id = '$id'";
    $posting_get = $conn->query($sql_posting_get);
    $posting_get_data = $posting_get->fetch_array();
    
    unlink($posting_get_data['gambar']);

    $sql_posting_del = "DELETE FROM posting WHERE id = '$id'";
    $posting_del = $conn->query($sql_posting_del);

    if($posting_del) {
        alert('Berhasil');
        redir('?page=admin-posting');
    } else {
        alert('Gagal');
        redir('?page=admin-posting');
    }

?>