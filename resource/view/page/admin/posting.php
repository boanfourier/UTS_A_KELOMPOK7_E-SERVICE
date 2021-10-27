<?php include "middleware/admin.php"; ?>
<?php include "resource/view/template/header.php"; ?>
<?php include "resource/view/template/admin_header.php"; ?>

<div class="table-responsive">

    <table class="table table-bordered" id="dataTable">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Created</th>
                <th>Updated</th>
                <th class="text-center">
                    <i class="fa fa-cog"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $posting_sql = "SELECT * FROM posting ORDER by created_at";
                $posting = $conn->query($posting_sql);
                while($po = $posting->fetch_array()) :
            ?>
            <tr>
                <td><?= $po['judul']; ?></td>
                <td class="text-center">
                    <?php if($po['gambar'] == null) : ?>
                    Tidak ada
                    <?php else: ?>
                    <img src="<?= $po['gambar']; ?>" width="200px" class="mx-auto d-block" alt="">
                    <?php endif; ?>
                </td>
                <td><?= $po['deskripsi']; ?></td>
                <td><?= $po['created_at']; ?></td>
                <td><?= $po['updated_at']; ?></td>
                <td>
                    <a href="?page=admin-posting-del&id_posting=<?= $po['id']; ?>" onclick="return confirm('Yakin?')" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>                     
</div>
                            
<?php include "resource/view/template/admin_footer.php"; ?>
<?php include "resource/view/template/footer.php"; ?>
