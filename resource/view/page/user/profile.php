<?php include "middleware/user.php"; ?>
<?php include "resource/view/template/header.php"; ?>
<?php include "resource/view/template/nav_user.php"; ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <i class="fa fa-user"></i> Profile
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-2 mb-2">
                    <img src="<?= $avatar_data['foto']; ?>" class="img-fluid rounded-circle d-block mx-auto" style="width: 200px;" alt="">
                </div>
                <div class="col-lg-8">
                    <div class="text-center mb-2">
                        <a href="" class="btn btn-info" data-toggle="modal" data-target="#editProfile"><i class="fa fa-edit"></i> Edit Profile</a>
                        <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editProfilePassword"><i class="fa fa-lock"></i> Edit Password</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td><?= $avatar_data['nama']; ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td><?= $avatar_data['username']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $avatar_data['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= $avatar_data['username']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="form-file" name="foto">
                            <label class="custom-file-label" for="customFile">Pilih Foto</label>


                        </div>
                        <img id="img-preview" width="300px" class="img-thumbnail img-fluid mb-2" src="<?= $avatar_data['foto']; ?>" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" name="btnEditProfile" class="btn btn-info"><i class="fa fa-edit"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editProfilePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Password Baru</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                  

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                    <button type="submit" name="btnEditProfilePassword" class="btn btn-warning"><i class="fa fa-edit"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php
if (isset($_POST['btnEditProfile'])) {

    $avatar_id = $avatar_data['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];

    if(empty($_FILES['foto']['name'])) {
        $edit_profile_sql = "UPDATE user 
                                SET
                                    nama='$nama',
                                    username='$username'
                                WHERE id='$avatar_id'";
        $edit_profile = $conn->query($edit_profile_sql);
    
        if ($edit_profile) {
            alert('Berhasil');
            redir('?page=user-profile');
        } else {
            alert('Gagal');
            redir('?page=user-profile');
        }
    } else {
        if($avatar_data['foto'] != 'asset/upload/default.png') {
            unlink($avatar_data['foto']);
        }

        $target = "asset/upload/";
        $temp = explode(".", $_FILES['foto']['name']);
        $new_file_name = time().'.'.end($temp);
        $foto = $target.$new_file_name;
        $imageFileType = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
            alert('File harus berekstensi JPG, JPEG, PNG');
            redir('?page=user-profile');
        } else {
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
                          
                $edit_profile_sql = "UPDATE user 
                                SET
                                    nama='$nama',
                                    username='$username',
                                    foto='$foto'
                                WHERE id='$avatar_id'";
                $edit_profile = $conn->query($edit_profile_sql);
                if($edit_profile) {
                    alert('Berhasil!');
                    redir('?page=user-profile');
                } else {
                    alert('Gagal');
                    redir('?page=user-profile');
                }
            } else {
                alert('Gagal Upload Foto!');
                redir('?page=user-profile');
            }
        }

    }

}


if (isset($_POST['btnEditProfilePassword'])) {
    $avatar_id = $avatar_data['id'];
    $password = $_POST['password'];
    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql_edit_password = "UPDATE
                            user
                            SET
                                password='$pass'
                            WHERE id=$avatar_id";
    $edit_password = $conn->query($sql_edit_password);

    if($edit_password) {
        alert('Berhasil');
        redir('?page=user-profile');
    } else {
        alert('Gagal');
        redir('?page=user-profile');
    }
}
?>




<?php include "resource/view/template/footer.php"; ?>