<?php include "middleware/user.php"; ?>
<?php include "resource/view/template/header.php"; ?>
<?php include "resource/view/template/nav_user.php"; ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#addPosting"> <i class="fa fa-pencil-alt"></i> Posting</a>

            <div class="modal fade" id="addPosting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Postingan Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" name="judul" class="form-control" placeholder="Masukan Judul" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" cols="30" rows="10" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="Gambar">Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="form-file" name="gambar">
                                        <label class="custom-file-label" for="customFile">Pilih Gambar</label>


                                    </div>
                                    <img id="img-preview" width="300px" class="img-thumbnail img-fluid mb-2" alt="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" name="btnPosting" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['btnPosting'])) {
                $judul = $_POST['judul'];
                $deskripsi = $_POST['deskripsi'];
                $status = 'unfinished';
                $createdBy = $_SESSION['user_id'];
                $created_at = date("Y-m-d H:i:s");

                if (empty($_FILES['gambar']['name'])) {

                    $sql_add_posting = "INSERT into 
                                                posting(judul,deskripsi,status,createdBy,created_at)
                                            VALUES
                                                ('$judul','$deskripsi','$status','$createdBy','$created_at')";
                    $add_posting = $conn->query($sql_add_posting);

                    if ($add_posting) {
                        alert('Berhasil Posting');
                    } else {
                        alert('Gagal Posting');
                    }
                } else {
                    $target = "asset/upload/posting/";
                    $temp = explode(".", $_FILES['gambar']['name']);
                    $new_file_name = time() . '.' . end($temp);
                    $gambar = $target . $new_file_name;
                    $imageFileType = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        alert('File harus berekstensi JPG, JPEG, PNG');
                    } else {
                        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar)) {

                            $sql_add_posting = "INSERT into 
                                                posting(judul,deskripsi,gambar,status,createdBy,created_at)
                                            VALUES
                                                ('$judul','$deskripsi','$gambar','$status','$createdBy','$created_at')";
                            $add_posting = $conn->query($sql_add_posting);

                            if ($add_posting) {
                                alert('Berhasil Posting');
                            } else {
                                alert('Gagal Posting');
                            }
                        } else {
                            alert('Gagal Upload Gambar');
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="row mt-2">
        <?php
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $sql_view_posting = "SELECT * FROM posting
                                    WHERE 
                                        judul LIKE '%$search%'

                                     ORDER by created_at DESC";
        } else {

            $sql_view_posting = "SELECT * FROM posting ORDER by created_at DESC";
        }

        $view_posting = $conn->query($sql_view_posting);
        ?>
        <?php
        if ($view_posting->num_rows < 1) : ?>
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Postingan tidak ada!</h2>
                    </div>
                </div>
            </div>
            <?php
        else :
            while ($vp = $view_posting->fetch_array()) :
                $user_avatar_id = $vp['createdby'];
                $sql_user_avatar = "SELECT * FROM user WHERE id = '$user_avatar_id'";
                $user_avatar = $conn->query($sql_user_avatar);
                $user_avatar_data = $user_avatar->fetch_array();
            ?>
                <div class="col-lg-8 mx-auto mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="avatar">
                                    <div class="d-flex">

                                        <div class="avatar-photo">
                                            <img src="<?= $user_avatar_data['foto']; ?>" width="50px" height="50px" class="rounded-circle" alt="">
                                        </div>
                                        <div class="avatar-data ml-2">
                                            <strong>
                                                <?= ucfirst($user_avatar_data['nama']); ?>
                                            </strong>
                                            <p>
                                                <?= $vp['created_at'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="edit">
                                
                                <?php if ($vp['createdby'] == $_SESSION['user_id']) : ?>
                                        <a href="" class="text-info" data-toggle="modal" data-target="#editPostingan<?= $vp['id']; ?>"><i class="fa fa-edit"></i></a>
                                        <div class="modal fade" id="editPostingan<?= $vp['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Postingan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="postingan_id" value="<?= $vp['id']; ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="judul">Judul</label>
                                                                <input type="text" name="judul" class="form-control" placeholder="Masukan Judul" value="<?= $vp['judul']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="deskripsi">Deskripsi</label>
                                                                <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" cols="30" rows="10" required><?= $vp['deskripsi'] ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="Gambar">Gambar</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input form-file" id="form-file" name="gambar">
                                                                    <label class="custom-file-label" for="customFile">Pilih
                                                                        Gambar</label>


                                                                </div>
                                                                <img id="img-preview" width="300px" class="img-thumbnail img-preview img-fluid mb-2" src="<?= $vp['gambar']; ?>" alt="">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="status">Status</label>
                                                                <select name="status" class="custom-select">
                                                                    <?php
                                                                    $status = ['unfinished', 'finished'];
                                                                    foreach ($status as $st) :
                                                                    ?>
                                                                        <option value="<?= $st ?>" <?= ($st == $vp['status']) ? 'selected' : ''; ?>><?= $st ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="btnEditPosting" class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    
                                    <?php
                                    if (isset($_POST['btnEditPosting'])) {

                                        $postingan_id = $_POST['postingan_id'];
                                        $judul = $_POST['judul'];
                                        $deskripsi = $_POST['deskripsi'];
                                        $status = $_POST['status'];
                                        $updated_at = date("Y-m-d H:i:s");


                                        if (empty($_FILES['gambar']['name'])) {

                                            $sql_edit_posting = "UPDATE 
                                                            posting
                                                        SET
                                                            judul = '$judul',
                                                            deskripsi = '$deskripsi',
                                                            status = '$status',
                                                            updated_at = '$updated_at'
                                                        WHERE id = '$postingan_id'";
                                            $edit_posting = $conn->query($sql_edit_posting);

                                            if ($edit_posting) {
                                                alert('Berhasil Edit Posting');
                                                redir('?page=user');
                                            } else {
                                                alert('Gagal Edit Posting');
                                                redir('?page=user');
                                            }
                                        } else {
                                            $check_gambar_sql = "SELECT * FROM posting WHERE id='$postingan_id'";
                                            $check_gambar = $conn->query($check_gambar_sql);
                                            $check_gambar_data = $check_gambar->fetch_array();



                                            $target = "asset/upload/posting/";
                                            $temp = explode(".", $_FILES['gambar']['name']);
                                            $new_file_name = time() . '.' . end($temp);
                                            $gambar = $target . $new_file_name;
                                            $imageFileType = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

                                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                                                alert('File harus berekstensi JPG, JPEG, PNG');
                                            } else {
                                                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar)) {

                                                    if ($check_gambar_data['gambar'] != null) {
                                                        unlink($check_gambar_data['gambar']);
                                                    }
                                                    $sql_edit_posting = "UPDATE 
                                                            posting
                                                        SET
                                                            judul = '$judul',
                                                            deskripsi = '$deskripsi',
                                                            status = '$status',
                                                            gambar = '$gambar',
                                                            updated_at = '$updated_at'
                                                        WHERE id = '$postingan_id'";
                                                    $edit_posting = $conn->query($sql_edit_posting);

                                                    if ($edit_posting) {
                                                        alert('Berhasil Edit Posting');
                                                        redir('?page=user');
                                                    } else {
                                                        alert('Gagal Edit Posting');
                                                        redir('?page=user');
                                                    }
                                                } else {
                                                    alert('Gagal Upload Gambar');
                                                    redir('?page=user');
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                <?php endif; ?>
                                
                            </div>
                                
                            </div>
                            <hr>
                            <p class="text-right">Status : 
                                <?php if($vp['status'] == 'unfinished') : ?>
                                    <span class="badge badge-secondary"><i class="fas fa-minus-circle"></i> <?= strtoupper($vp['status']); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-success"><i class="far fa-check-circle"></i> <?= strtoupper($vp['status']); ?></span>
                                <?php endif; ?>
                            </p>
                            <h4 class="text-center"><?= $vp['judul']; ?></h4>
                            <?php if ($vp['gambar'] != null) : ?>
                                <img src="<?= $vp['gambar'] ?>" class="img-fluid d-block mx-auto mb-2" alt="">
                            <?php endif; ?>

                            <div class="content text-justify">
                                <?= $vp['deskripsi'] ?>
                            </div>
                            <hr>


                            <div class="comment">

                                <?php
                                $post_id = $vp['id'];
                                $komentar_sql = "SELECT * FROM komentar WHERE posting_id = '$post_id' ORDER BY created_at DESC";
                                $komentar = $conn->query($komentar_sql);
                                $jml_komentar = $komentar->num_rows;
                                
                                ?>

                                <a class="btn btn-default mb-2" data-toggle="collapse" href="#collapseExample<?= $vp['id']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Komentar <?= $jml_komentar; ?>
                                </a>

                                <div class="collapse" id="collapseExample<?= $vp['id']; ?>">
                                    <form action="" method="post" class="mb-5">
                                        <input type="hidden" name="postn_id" value="<?= $post_id ?>">
                                        <textarea name="komentar" class="form-control" placeholder="Komentar" required></textarea>

                                        <button type="submit" name="btnKomentar" class="btn btn-primary mt-2 float-right">Kirim</button>
                                    </form>


                                    <?php if ($jml_komentar > 0) : ?>
                                        <?php 
                                            $no = 0;
                                            while ($kv = $komentar->fetch_array()) : 
                                                $no++;
                                                $avatar_komentar_id = $kv['user_id'];
                                                $avatar_komentar_sql = "SELECT * FROM user where id=$avatar_komentar_id";
                                                $avatar_komentar = $conn->query($avatar_komentar_sql);
                                                $avatar_komentar_data = $avatar_komentar->fetch_array();
                                        ?>
                                            
                                            <div class="card card-body <?= ($no % 2 == 0) ? 'bg-secondary text-white' : ''; ?> mb-2">
                                                <div class="d-flex justify-content-between">

                                                    <div class="avatar-komentar">
    
                                                        <strong><?= ucfirst($avatar_komentar_data['nama']); ?></strong>
                                                        <p><?= $kv['komentar']; ?></p>
                                                    </div>
                                                    <div class="waktu-komentar">
                                                        <p><?= $kv['created_at']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div> 
                            </div>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>


    </div>
</div>

<?php
if (isset($_POST['btnKomentar'])) {
    $postn_id = $_POST['postn_id'];
    $userid = $_SESSION['user_id'];
    $komentar = $_POST['komentar'];
    $waktu_komentar = date("Y-m-d H:i:s");

    $komentar_add_sql = "INSERT
                             into komentar(posting_id,user_id,komentar,created_at)
                        VALUES
                            ('$postn_id','$userid','$komentar','$waktu_komentar')";
    $komentar_add = $conn->query($komentar_add_sql);

    if ($komentar_add) {
        alert('Berhasil!');
        redir('?page=user');
    } else {
        alert('Gagal!');
        redir('?page=user');
    }
}
?>

<?php include "resource/view/template/footer.php"; ?>