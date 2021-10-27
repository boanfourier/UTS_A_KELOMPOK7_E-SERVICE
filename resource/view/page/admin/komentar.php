<?php include "middleware/admin.php"; ?>
<?php include "resource/view/template/header.php"; ?>
<?php include "resource/view/template/admin_header.php"; ?>

<div class="table-responsive">

    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Komentar</th>
                <th>User</th>
                <th>Created</th>
                <th class="text-center">
                    <i class="fa fa-cog"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $komentar_sql = "SELECT * FROM komentar ORDER by created_at DESC";
                $komentar = $conn->query($komentar_sql);
                while($ko = $komentar->fetch_array()) :
                    $postingan_id = $ko['posting_id'];
                    $postingan_sql = "SELECT * FROM posting WHERE id='$postingan_id'";
                    $postingan = $conn->query($postingan_sql);
                    $post = $postingan->fetch_array();

                    $user_id = $ko['user_id'];
                    $user_sql = "SELECT * FROM user WHERE id='$user_id'";
                    $user = $conn->query($user_sql);
                    $us = $user->fetch_array();
            ?>
            <tr>
                <td><?= $post['judul']; ?></td>
                <td><?= $ko['komentar']; ?></td>
                <td><?= $us['username']; ?></td>
                <td><?= $ko['created_at']; ?></td>
                <td class="text-center">
                    <a onclick="return confirm('Yakin?')" href="?page=admin-komentar-del&id_komentar=<?= $ko['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>                     
</div>
                            
<?php include "resource/view/template/admin_footer.php"; ?>
<?php include "resource/view/template/footer.php"; ?>
